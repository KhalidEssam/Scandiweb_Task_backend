<?php

declare(strict_types=1);

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ItemType extends BaseType
{
    public function __construct()
    {
        $name = 'Item';
        $fields = [
            'id' => Type::string(),
            'displayValue' => Type::string(),
            'value' => Type::string(),
        ];

        parent::__construct($name, $fields);
    }
}