<?php
require __DIR__ . '/../../../bootstrap.php';

abstract class AbstractQueryResolver {
    // protected $pdo;
    protected $entityManager;

    public function __construct(Doctrine\ORM\EntityManager $entityManager ) {
        // $this->pdo = $pdo;
        $this->entityManager = $entityManager;
    }

    abstract public function resolve($productId);
}
?>