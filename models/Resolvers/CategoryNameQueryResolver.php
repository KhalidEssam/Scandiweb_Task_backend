<?php

class CategoryNameQueryResolver extends AbstractQueryResolver {
    public function resolve($categoryId) {
        // echo $categoryId;
        $stmt = $this->pdo->prepare('SELECT name FROM categories WHERE id = :category_id');
        $stmt->execute(['category_id' => $categoryId]);
        $category_name = $stmt->fetchColumn();
        // echo $category_name;
        return $category_name;
    }
}