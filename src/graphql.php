<?php

declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';

use GraphQL\Server\StandardServer;
use GraphQL\Type\Schema;

try {
// database connection class
$database = Database::getInstance();
$pdo = $database->getConnection();
// print_r($entityManager);
// Resolvers array
$queryResolvers = [
'Category' => new CategoryQueryResolver( $entityManager ),
'Product' => new ProductQueryResolver( $entityManager ),
'Gallery' => new GalleryQueryResolver( $entityManager ),
'CategoryName' => new CategoryNameQueryResolver( $entityManager ),
'Price' => new PriceQueryResolver( $entityManager ),
'Attribute' => new AttributeQueryResolver( $entityManager )
];

$server = new GraphQLServer($pdo);
$GraphQLSchema = new GeneralSchema($queryResolvers);
$queryType = $GraphQLSchema->getQueryType();
$server->createSchema($queryType);
$server->handleRequest();
} catch (Exception $e) {
// Handle exceptions
header('Content-Type: application/json');
$error = FormattedError::createFromException($e);
echo json_encode(['errors' => [$error]]);
}