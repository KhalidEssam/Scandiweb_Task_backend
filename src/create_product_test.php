<?php
// create_product.php <name>

require_once __DIR__ . '/../bootstrap.php';

$productId = 'nast_niky_shoes';

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