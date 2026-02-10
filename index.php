<?php
// DigitalOcean App Platform injects DB credentials automatically 
// if you've added a database component to your app.
// Note: Replace 'db' with the actual name you gave your database component.

$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$user = getenv('DB_USERNAME');
$pass = getenv('DB_PASSWORD');
$dbname = getenv('DB_DATABASE');

echo "<h1>Web Systems II test</h1>";

// 1. Check PHP version
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";

// 2. Try Database Connection
try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // This line is crucial for DigitalOcean Managed Databases:
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
    ];
    
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    echo "<p style='color: green;'>✅ Successfully connected to the Managed MySQL Database!</p>";
} catch (\PDOException $e) {
    echo "<p style='color: red;'>❌ Database Connection Failed: " . $e->getMessage() . "</p>";
}

// 3. Show Apache info
echo "<p><strong>Server Software:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
echo "<footer>Contributers: Aram A.,Juan P.</footer>"
?>
