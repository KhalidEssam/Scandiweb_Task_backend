<?php

declare(strict_types=1);


use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;


abstract class GraphQLSchema {
    protected $queryResolvers;
    public function __construct(array $queryResolvers)
    {
        $this->queryResolvers = $queryResolvers;
    }





    abstract public function getQueryType();
}

class GeneralSchema extends GraphQLSchema {
    
    public function getQueryType()
    {
        $newpriceType = new PriceType();
        $priceObjectType = $newpriceType->getType();

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
            
        return $this->queryResolvers['Category']->resolve('0');
        }
        ],
        'products' => [
        'type' => Type::listOf($productObjectType),
        'resolve' => function ($parent, $args, $context) {
        return $this->queryResolvers['Product']->resolve(0);
        }
        ],
        ],
        ]);
    }

}