<?php
// require_once __DIR__ . '../vendor/autoload.php';
require '../bootstrap.php';
use GraphQL\Type\Schema;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Error\DebugFlag;
use GraphQL\GraphQL;

class QueryResolver {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function categories() {
        $stmt = $this->pdo->query('SELECT * FROM categories');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function products() {
        $stmt = $this->pdo->query('SELECT * FROM products');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}



try {


$database = Database::getInstance();
$pdo = $database->getConnection();
$queryResolver = new QueryResolver($pdo);

$rootResolver = [
'categories' => [$queryResolver, 'categories'],
'products' => [$queryResolver, 'products']
];
// echo json_encode($rootResolver['products']());

// Define schema
$schema = new Schema([
'query' => new ObjectType([
'name' => 'Query',
'fields' => $rootResolver,
])
]);

// Read the GraphQL query from the request body
$input = json_decode(file_get_contents('php://input'), true);
$query = isset($input['query']) ? $input['query'] : '';


// Execute the query
$result = GraphQL::executeQuery($schema, $query);

// Convert the result to JSON and return
header('Content-Type: application/json');
echo $rootresolver;
echo json_encode($result->toArray());
} catch (\Exception $e) {
// Handle exceptions
header('Content-Type: application/json');
$error = FormattedError::createFromException($e);
echo json_encode(['errors' => [$error]]);
}
?>