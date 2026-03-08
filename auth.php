<?php

// Load Composer dependencies (PHPAuth and others)
require_once __DIR__ . '/vendor/autoload.php';

// Get database credentials from DigitalOcean environment variables
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$user = getenv('DB_USERNAME');
$pass = getenv('DB_PASSWORD');
$dbname = getenv('DB_DATABASE');

try {

    // Create PDO database connection
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

        // Required for DigitalOcean Managed Databases
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
    ];

    $pdo = new PDO($dsn, $user, $pass, $options);

} catch (PDOException $e) {

    die("Database connection failed: " . $e->getMessage());

}

// Start PHPAuth
$config = new PHPAuth\Config($pdo);
$auth = new PHPAuth\Auth($pdo, $config);

?>