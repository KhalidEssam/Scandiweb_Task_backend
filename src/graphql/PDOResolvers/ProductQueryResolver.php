<?php


class PDOProductQueryResolver extends PDOAbstractQueryResolver {
    public function resolve($productId =0) {
        $stmt = $this->pdo->query('SELECT * FROM products');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}