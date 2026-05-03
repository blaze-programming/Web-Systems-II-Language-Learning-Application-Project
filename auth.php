<?php
// auth.php
session_start();

// Autoload composer dependencies
require_once __DIR__ . '/vendor/autoload.php'; 

// Local connection settings (used by default)
$host   = '127.0.0.1';
$port   = '3306';
$user   = 'root';
$pass   = '';
$dbname = 'WebSystems2Local';

// Override with environment variables when deployed
if (getenv('DB_HOST'))     $host   = getenv('DB_HOST');
if (getenv('DB_PORT'))     $port   = getenv('DB_PORT');
if (getenv('DB_USERNAME')) $user   = getenv('DB_USERNAME');
if (getenv('DB_PASSWORD')) $pass   = getenv('DB_PASSWORD');
if (getenv('DB_DATABASE')) $dbname = getenv('DB_DATABASE');

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
