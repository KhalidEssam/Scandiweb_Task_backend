<?php
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

abstract class MutationType {
    protected $mutationResolvers;

    public function __construct(array $mutationResolvers)
    {
        $this->mutationResolvers = $mutationResolvers;
    }

    abstract public function getType();
}