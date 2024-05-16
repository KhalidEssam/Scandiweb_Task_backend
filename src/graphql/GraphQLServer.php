<?php

require_once __DIR__ . '/../../bootstrap.php';

use GraphQL\Server\StandardServer;
use GraphQL\Type\Schema;

class GraphQLServer
{
    private $pdo;
    private $queryResolvers;
    private $schema;
    private $queryType;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function createSchema($queryType): void
    {
        $this->queryType =  $queryType ;

        $this->schema = new Schema([
            'query' => $this->queryType,
        ]);
    }

    public function handleRequest(): void
    {
        try {
            // Read the GraphQL query from the request body
            $input = json_decode(file_get_contents('php://input'), true);
            $query = isset($input['query']) ? $input['query'] : '';

            // Execute the query
            $result = GraphQL\GraphQL::executeQuery($this->schema, $query, null);

            // Convert the result to JSON and return
            header('Content-Type: application/json');
            echo json_encode($result->toArray());
        } catch (\Exception $e) {
            // Handle exceptions
            header('Content-Type: application/json');
            $error = FormattedError::createFromException($e);
            echo json_encode(['errors' => [$error]]);
        }
    }
}