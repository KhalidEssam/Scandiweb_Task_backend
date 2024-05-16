<?php

// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;




require_once __DIR__ . '/vendor/autoload.php';


$dotenv = DotenvVault\DotenvVault::createImmutable(__DIR__);
$dotenv->safeLoad();



// $database = Database::getInstance();
// $pdo = $database->getConnection();

// Doctrine DBAL configuration
$config = new Configuration();




// Create the database connection
$connectionParams = [
// 'pdo' => $pdo,
'host' => $_SERVER['DB_HOST'],
'user' => $_SERVER['DB_USERNAME'],
'password' => $_SERVER['DB_PASSWORD'],
'dbname' => $_SERVER['DB_DATABASE'],
'driver' => $_SERVER['DB_DRIVER'], // Specify the PDO driver for MySQL
];



// print_r($connection);



// Set up Doctrine ORM
$config = ORMSetup::createXMLMetadataConfiguration(
paths: array(__DIR__."/src/models/ORMEntities/"),
isDevMode: false,
);

// Create the database connection
$connection = DriverManager::getConnection($connectionParams, $config);
$message = "Connected to the database successfully!";
// Create the EntityManager
$entityManager = new EntityManager($connection, $config);