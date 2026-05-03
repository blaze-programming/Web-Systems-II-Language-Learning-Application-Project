<?php
// auth.php
session_start();

// Autoload composer dependencies
require_once __DIR__ . '/vendor/autoload.php'; 

// Fetch environment variables
$host = getenv('DB_HOST') ?? '127.0.0.1';
$port = getenv('DB_PORT') ?? '3306';
$user = getenv('DB_USERNAME') ?? 'root';
$pass = getenv('DB_PASSWORD') ?? '';
$dbname = getenv('DB_DATABASE') ?? 'WebSystems2Local';

try {
    // Create PDO Connection
    $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Initialize PHPAuth
$config = new PHPAuth\Config($dbh);
$auth   = new PHPAuth\Auth($dbh, $config);
?>
