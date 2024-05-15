<?php

declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';

use GraphQL\Server\StandardServer;
use GraphQL\Type\Schema;

try {
// database connection class
$database = Database::getInstance();
$pdo = $database->getConnection();

// Resolvers array
$queryResolvers = [
'Category' => new CategoryQueryResolver($pdo),
'Product' => new ProductQueryResolver($pdo),
'Gallery' => new GalleryQueryResolver($pdo),
'CategoryName' => new CategoryNameQueryResolver($pdo),
'Price' => new PriceQueryResolver($pdo),
'Attribute' => new AttributeQueryResolver($pdo)
];

$server = new GraphQLServer($pdo);
$GraphQLSchema = new GeneralSchema($queryResolvers);
$queryType = $GraphQLSchema->getQueryType();
$server->createSchema($queryType);
$server->handleRequest();
} catch (\Exception $e) {
// Handle exceptions
header('Content-Type: application/json');
$error = FormattedError::createFromException($e);
echo json_encode(['errors' => [$error]]);
}