<?php

declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';

use GraphQL\Server\StandardServer;
use GraphQL\Type\Schema;

// Allow requests from any origin
header("Access-Control-Allow-Origin: *");

// Allow the Content-Type header in requests
header("Access-Control-Allow-Headers: Content-Type");

try {
    // database connection class
    $database = Database::getInstance();
    $pdo = $database->getConnection();

    // Resolvers array
    $queryResolvers = [
        'Category' => new CategoryQueryResolver($entityManager),
        'Product' => new ProductQueryResolver($entityManager),
        'Gallery' => new GalleryQueryResolver($entityManager),
        'CategoryName' => new CategoryNameQueryResolver($entityManager),
        'Price' => new PriceQueryResolver($entityManager),
        'Attribute' => new AttributeQueryResolver($entityManager)
    ];

    
    // Mutation resolvers
    $orderservice= new OrderService($entityManager);

    $mutationResolvers = [
        'createOrder' => new CreateOrder($entityManager , $orderservice ),
    ];

    // Schema Initialization
    $GraphQLSchema = new GeneralSchema($queryResolvers, $mutationResolvers);

    $queryType = $GraphQLSchema->getQueryType();
    $mutationType = $GraphQLSchema->getMutationType();
    // Server Initialization
    $server = new GraphQLServer($pdo);
    $server->createSchema($queryType, $mutationType);
    $server->handleRequest();

} catch (Exception $e) {
    // Handle exceptions
    header('Content-Type: application/json');
    $error = FormattedError::createFromException($e);
    echo json_encode(['errors' => [$error]]);
}