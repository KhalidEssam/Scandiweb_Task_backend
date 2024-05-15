<?php
// create_product.php <name>

require_once __DIR__ . '/../bootstrap.php';


// $product = new Product();
// // $product->setName('$argv[1]');
// $product->setId('X_BOX SERIES S');
// $product->setName('X_BOX SERIES S');
// $product->setInStock(true);
// $product->setDescription('X_BOX SERIES S');
// $product->setBrand('X_BOX');



// // $entityManager->persist($product);

// $entityManager->persist($product);
// $entityManager->flush();


// echo "Created Product with name " . $product->getId() . "\n";

$query = $entityManager->createQuery('SELECT p FROM PriceEntity p');

// Execute the query
$products = $query->getResult();


foreach ($products as $product) {
    // echo $product->getlabel() .  $product->getSymbol()  . "\n";
    echo $product->getAmount(). "\n";

}