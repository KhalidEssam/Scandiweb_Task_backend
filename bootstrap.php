<?php

// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;




require_once __DIR__ . '/vendor/autoload.php';



// $database = Database::getInstance();
// $pdo = $database->getConnection();

// Doctrine DBAL configuration
$config = new Configuration();

// Create the database connection
$connectionParams = [
// 'pdo' => $pdo,
'host' => 'localhost',
'user' => 'khaledesam',
'password' => 'Kh1597562016',
'dbname' => 'dummy_ecommerce',
'driver' => 'pdo_mysql', // Specify the PDO driver for MySQL
];



// print_r($connection);



// Set up Doctrine ORM
$config = ORMSetup::createXMLMetadataConfiguration(
paths: array(__DIR__."/models/ORMEntities/"),
isDevMode: false,
);

// Create the database connection
$connection = DriverManager::getConnection($connectionParams, $config);

// Create the EntityManager
$entityManager = new EntityManager($connection, $config);