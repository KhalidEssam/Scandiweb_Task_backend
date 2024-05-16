<?php

class CategoryNameQueryResolver extends AbstractQueryResolver {
    public function resolve($categoryId) {
    $query = $this->entityManager->createQuery('
        SELECT c 
        FROM CategoryEntity c
        WHERE c.id = :category_id
    ')->setParameter('category_id', $categoryId);   
        // Execute the query
        $Category = $query->getSingleResult();
        
        return $Category->getName();
    }
}