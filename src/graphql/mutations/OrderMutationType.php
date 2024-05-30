<?php

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class OrderMutationType extends MutationType {

    public function getType()
    {
        return new ObjectType([
            'name' => 'Mutation',
            'fields' => [
                'createOrder' => [
                    'type' => $this->getOrderType(),
                    'args' => [
                        'input' => Type::nonNull($this->getCreateOrderInputType()),
                    ],
                    'resolve' => function ($root, $args) {
                    //     return[
                    //         'id' => 1,
                    //         'status' => 'pending',
                    // ];
                        return $this->mutationResolvers['createOrder']->resolve($args);
                    },
                ],
            ],
        ]);
    }

    protected function getOrderType()
    {

        return new ObjectType([
            'name' => 'Order',
            'fields' => [
                'id' => Type::nonNull(Type::id()),
                'status' => Type::nonNull(Type::string()),
            ],
        ]);
    }

    protected function getCreateOrderInputType()
    {
        return new InputObjectType([
            'name' => 'CreateOrderInput',
            'fields' => [
                'items' => Type::nonNull(Type::listOf($this->getOrderItemInputType())),
                'totalPrice' => Type::nonNull(Type::float()),
            ],
        ]);
    }

    protected function getOrderItemInputType()
    {

        return new InputObjectType([
            'name' => 'OrderItemInput',
            'fields' => [
                'id' => Type::nonNull(Type::string()),
                'name' => Type::nonNull(Type::string()),
                'inStock' => Type::nonNull(Type::boolean()),
                'attributes' => Type::listOf($this->getAttributeInputType()),
                'prices' => Type::listOf($this->getPriceInputType()),
                'count' => Type::nonNull(Type::int()),
            ],
        ]);
    }
    

    protected function getAttributeInputType()
    {
        return new InputObjectType([
            'name' => 'AttributeInput',
            'fields' => (new AttributeSetType())->getItemFields(),
        ]);
    }

    protected function getPriceInputType()
    {
        return new InputObjectType([

            'name' => 'PriceInput',
            'fields' => 
            [
                'amount' => Type::nonNull(Type::float()),
                'currency' => $this->getCurrencyInputType(),
            ],
        ]);
    }

    protected function getCurrencyInputType()
    {
        return new InputObjectType([
            'name' => 'CurrencyInput',
            'fields' => [
                'label' => Type::nonNull(Type::string()),
                'symbol' => Type::nonNull(Type::string()),
            ],
        ]);
    }
}