<?php

declare(strict_types=1);

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ItemType extends BaseType
{
    
    public function __construct($fields)
    {
        $name = 'Item';
        parent::__construct($name, $fields);
    }
}