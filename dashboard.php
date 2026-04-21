<?php
// dashboard.php
require 'auth.php';

// Check if the user is NOT logged in
if (!$auth->isLogged()) {
    // Redirect to login page
    header('Location: login.php');
    exit();
}

// Get the logged-in user's ID
$userId = $auth->getCurrentUID();
// You can use $userId to fetch specific language learning progress from your database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to your Language Learning Dashboard!</h1>
    <p>You are successfully logged in (User ID: <?= htmlspecialchars($userId) ?>).</p>
    
    <form method="POST" action="logout.php">
        <button type="submit">Log Out</button>
    </form>
</body>
</html>
