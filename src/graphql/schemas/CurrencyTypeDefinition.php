<?php

declare(strict_types=1);

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;


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