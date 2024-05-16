<?php

declare(strict_types=1);

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