<?php


class ProductQueryResolver extends AbstractQueryResolver {
    public function resolve($productId) {
        $stmt = $this->pdo->query('SELECT * FROM products');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}