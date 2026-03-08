<?php require_once 'auth.php'; ?>

<?php

$sql = file_get_contents('database_mysql.sql');

try {
    $pdo->exec($sql);
    echo "PHPAuth tables installed successfully!";
} catch (PDOException $e) {
    echo "Error installing tables: " . $e->getMessage();
}

?>