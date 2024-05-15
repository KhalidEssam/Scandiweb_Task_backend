<?php



class CategoryQueryResolver extends AbstractQueryResolver {
    public function resolve($productId ) {
        $stmt = $this->pdo->query('SELECT * FROM categories');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}