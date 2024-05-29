<?php



class PDOCategoryQueryResolver extends PDOAbstractQueryResolver {
    public function resolve($productId = 0) {
        $stmt = $this->pdo->query('SELECT * FROM categories');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}