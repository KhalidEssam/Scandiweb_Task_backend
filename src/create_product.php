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

// $query = $entityManager->createQuery('SELECT p FROM Product p');

// // Execute the query
// $products = $query->getResult();


// foreach ($products as $product) {
//     // echo $product->getlabel() .  $product->getSymbol()  . "\n";
//     echo $product->getId(). "\n";

// }

$productId = 'nast_niky_shoes';
// // $query = $entityManager->createQuery('
// // SELECT a.name AS id, ai.displayValue AS displayValue, ai.value AS value,
// // FROM Product_Attribute pa
// // JOIN pa.attribute_id a
// // JOIN pa.attribute_item_id ai
// // WHERE pa.product_id = :product_id
// // ')->setParameter('product_id', $productId);

// $query = $entityManager->createQuery('
// SELECT a.name AS id, ai.displayValue AS attribute_item_value , ai.value AS attribute_value
// FROM Product_Attribute pa
// JOIN pa.attribute_id a
// JOIN pa.attribute_item_id ai
// WHERE pa.product_id = :product_id
// ')->setParameter('product_id', $productId);

// $result = $query->getResult();

// print_r($result);

$order = new OrderEntity();
$order->setTotalPrice(400.00);
// Set other properties of the order entity as needed
$entityManager->persist($order);

// Create OrderDetailEntity for each item
$orderDetail = new OrderDetailEntity();
$orderDetail->setOrder($order);
$product = $entityManager->getRepository(Product::class)->find($productId);
$orderDetail->setProduct($product);
// Set other properties of the order detail entity based on $item
$entityManager->persist($orderDetail);


$entityManager->flush();