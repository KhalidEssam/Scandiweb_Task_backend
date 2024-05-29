<?php


abstract class PDOAbstractQueryResolver {
    protected $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    abstract public function resolve($productId);
}
?>