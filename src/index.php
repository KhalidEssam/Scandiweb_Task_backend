<?php
require '../bootstrap.php';

$database = Database::getInstance();
$pdo = $database->getConnection();

$stmt = $pdo->query('SELECT * FROM categories');
$rootResolver = [
'categories' => function () use ($pdo) {
$stmt = $pdo->query('SELECT * FROM categories');
return $stmt->fetchAll(PDO::FETCH_ASSOC);
},
'products' => function () use ($pdo) {
$stmt = $pdo->query('SELECT * FROM products');
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TEST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <?php foreach ($stmt as $item): ?>
        <h1>
            <?php echo $item['name']; ?>
        </h1>
        <?php endforeach; ?>
    </div>
</body>

</html>