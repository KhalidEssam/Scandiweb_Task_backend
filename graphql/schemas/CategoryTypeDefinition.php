<?php

declare(strict_types=1);

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

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