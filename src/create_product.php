<?php
// create_product.php <name>

require_once __DIR__ . '/../bootstrap.php';


$product = new Product();
// $product->setName('$argv[1]');
$product->setId('nast_niky_shoes');
$product->setName('nast niky shoes');
$product->setInStock(true);
$product->setDescription('nast niky shoes');
$product->setBrand('nast niky');



// $entityManager->persist($product);

$entityManager->persist($product);
$entityManager->flush();


echo "Created Product with name " . $product->getId() . "\n";