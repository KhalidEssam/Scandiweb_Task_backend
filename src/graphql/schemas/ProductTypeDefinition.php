<?php

declare(strict_types=1);

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ProductType extends BaseType
{

    private $queryResolvers;

    public function __construct($queryResolvers)
    {
    $this->queryResolvers = $queryResolvers;
    $name = 'Product';
    $fields = [
    'id' => Type::string(),
    'name' => Type::string(),
    'inStock' => Type::boolean(),
    'gallery' => [
        'type' => Type::listOf(Type::string()), // Assuming gallery is a list of strings (image URLs)
        'resolve' => function ($product, $args ) {
            return $this->queryResolvers['Gallery']->resolve($product['id']);
        },
    ],
    'description' => Type::string(),
    'category' => [
        'type' => Type::string(),
        'resolve' => function ($product, $args) {
            return $this->queryResolvers['CategoryName']->resolve($product['category_id']);
        },
    ],
    'brand' => Type::string(),
    'prices' => [
        'type' => (new PriceType())->getType(),
        'resolve' => function ($product, $args ) {
            return $this->queryResolvers['Price']->resolve($product['price_id']);
        },
    ],
    'attributes' => [
        'type' => Type::listOf((new AttributeSetType())->getType()),
        'resolve' => function ($product, $args ) {
            $attributesData = $this->queryResolvers['Attribute']->resolve($product['id']);
            $attributes = [];

            // Group attributes by ID
            $groupedAttributes = [];
            foreach ($attributesData['id'] as $key => $id) {
                $groupedAttributes[$id][] = [
                'displayValue' => $attributesData['displayValue'][$key],
                'value' => $attributesData['value'][$key],
                'id' => $attributesData['displayValue'][$key],
                ];
            }

            // Construct AttributeSet for each group
            foreach ($groupedAttributes as $id => $items) {
                $attributeSet = [
                'id' => $id,
                'items' => $items,
                ];
                $attributes[] = $attributeSet;
            }

            return $attributes;
        },
    ],
    ];

    parent::__construct($name, $fields);
    }
}