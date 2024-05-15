<?php

declare(strict_types=1);

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

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