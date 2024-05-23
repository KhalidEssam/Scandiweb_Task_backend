<?php

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class MutationType {
    protected $mutationResolvers;

    public function __construct(array $mutationResolvers)
    {
        $this->mutationResolvers = $mutationResolvers;
    }

    public function getType()
    {
        return new ObjectType([
            'name' => 'Mutation',
            'fields' => [
                'createOrder' => [
                    'type' => new ObjectType([
                        'name' => 'Order',
                        'fields' => [
                            'id' => Type::nonNull(Type::id()),
                            'status' => Type::nonNull(Type::string()),
                        ],
                    ]),
                    'args' => [
                        'input' => Type::nonNull(new InputObjectType([
                            'name' => 'CreateOrderInput',
                            'fields' => [
                                'items' => Type::nonNull(Type::listOf(new InputObjectType([
                                    'name' => 'OrderItemInput',
                                    'fields' => [
                                        'id' => Type::nonNull(Type::string()),
                                        'name' => Type::nonNull(Type::string()),
                                        'inStock' => Type::nonNull(Type::boolean()),
                                        'gallery' => Type::listOf(Type::string()),
                                        'description' => Type::string(),
                                        'category' => Type::nonNull(Type::string()),
                                        'attributes' => Type::listOf(new InputObjectType([
                                            'name' => 'AttributeInput',
                                            'fields' => [
                                                'id' => Type::nonNull(Type::string()),
                                                'displayValue' => Type::string(),
                                                'value' => Type::string(),
                                                'isSelected' => Type::boolean(),
                                            ],
                                        ])),
                                        'prices' => Type::listOf(new InputObjectType([
                                            'name' => 'PriceInput',
                                            'fields' => [
                                                'amount' => Type::nonNull(Type::float()),
                                                'currency' => new InputObjectType([
                                                    'name' => 'CurrencyInput',
                                                    'fields' => [
                                                        'label' => Type::nonNull(Type::string()),
                                                        'symbol' => Type::nonNull(Type::string()),
                                                    ],
                                                ]),
                                            ],
                                        ])),
                                        'brand' => Type::string(),
                                        'count' => Type::nonNull(Type::int()),
                                    ],
                                ]))),
                                'totalPrice' => Type::nonNull(Type::float()),
                            ],
                        ])),
                    ],
                    'resolve' => function ($root, $args) {
                        // Resolver logic here
                        return $this->mutationResolvers['createOrder']->resolve($args);
                    },
                ],
            ],
        ]);
    }
}