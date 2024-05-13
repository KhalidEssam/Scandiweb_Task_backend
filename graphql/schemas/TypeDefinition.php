<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
class BaseType
{
    protected $name;
    protected $fields;

    public function __construct(string $name, array $fields)
    {
        $this->name = $name;
        $this->fields = $fields;
    }

    public function getType(): ObjectType
    {
        return new ObjectType([
            'name' => $this->name,
            'fields' => $this->fields,
        ]);
    }
}

class CategoryType extends BaseType
{
public function __construct()
{
$name = 'Category';
$fields = [
'id' => Type::int(),
'name' => Type::string(),
];

parent::__construct($name, $fields);
}
}

class CurrencyType extends BaseType
{
public function __construct()
{
$name = 'Currency';
$fields = [
'label' => Type::string(),
'symbol' => Type::string(),
];

parent::__construct($name, $fields);
}
}

class PriceType extends BaseType
{
    public function __construct()
    {
        $name = 'Price';
        $fields = [
            'amount' => Type::float(),
            'currency' => [
                'type' => (new CurrencyType())->getType(),
                'resolve' => function ($parent) {
                    return [
                        'label' => $parent['currency_name'],
                        'symbol' => $parent['symbol']
                    ];
                }
            ],
        ];

        parent::__construct($name, $fields);
    }
}

class ItemType extends BaseType
{
    public function __construct()
    {
        $name = 'Item';
        $fields = [
            'id' => Type::string(),
            'displayValue' => Type::string(),
        ];

        parent::__construct($name, $fields);
    }
}

class AttributeSetType extends BaseType
{
    public function __construct()
    {
        $name = 'AttributeSet';
        $fields = [
            'id' => Type::string(),
            'items' => [
                'type' => Type::listOf((new ItemType())->getType()),
                'resolve' => function ($parent, $args, $context) {
                    $items = [];
                    foreach ($parent['items'] as $item) {
                        $itemObject = [
                            'id' => $item['id'],
                            'displayValue' => $item['id'],
                        ];
                        $items[] = $itemObject;
                    }
                    return $items;
                }
            ],
        ];

        parent::__construct($name, $fields);
    }
}


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
'resolve' => function ($product, $args ) {
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
'type' => (new AttributeSetType())->getType(),
'resolve' => function ($product, $args ) {
$attributesData = $this->queryResolvers['Attribute']->resolve($product['id']);
return [
'id' => $attributesData['id'],
'items' => array_map(function ($value) {
return ['id' => $value];
}, $attributesData['value'])
];
},
],
];

parent::__construct($name, $fields);
}
}