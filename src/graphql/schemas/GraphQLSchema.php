<?php

declare(strict_types=1);


use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;


abstract class GraphQLSchema {
    protected $queryResolvers;
    protected $mutationResolvers;

    public function __construct(array $queryResolvers , array $mutationResolvers ) 
    {
        $this->queryResolvers = $queryResolvers;
        $this->mutationResolvers = $mutationResolvers;
    }

    abstract public function getQueryType();
    abstract public function getMutationType();
}

class GeneralSchema extends GraphQLSchema {
    
    public function getQueryType()
    {

        $newcategoryType = new CategoryType();
        $categoryObjectType = $newcategoryType->getType();

        $newproductType = new ProductType($this->queryResolvers);
        $productObjectType = $newproductType->getType();


        return new ObjectType([
        'name' => 'Query',
        'fields' => [
        'categories' => [
        'type' => Type::listOf($categoryObjectType),
        'resolve' => function ($parent, $args, $context) {
            
        return $this->queryResolvers['Category']->resolve();
        }
        ],
        'products' => [
        'type' => Type::listOf($productObjectType),
        'resolve' => function ($parent, $args, $context) {
        return $this->queryResolvers['Product']->resolve();
        }
        ],
        ],
        ]);
    }
    public function getMutationType()
    {
    $newMutationType = new MutationType($this->mutationResolvers);
    return $newMutationType->getType();
    }

}