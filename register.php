<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
// register.php
require 'auth.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];

    // PHPAuth register function
    $result = $auth->register($email, $password, $password_repeat);

    if ($result['error']) {
        $message = "<div style='color: red;'>{$result['message']}</div>";
    } else {
        $message = "<div style='color: green;'>Registration successful! You can now <a href='login.php'>log in</a>.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Language Learning App</title>
</head>
<body>
    <h2>Create an Account</h2>
    <?= $message ?>
    <form method="POST" action="register.php">
        <div>
            <label>Email:</label><br>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Password:</label><br>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>Repeat Password:</label><br>
            <input type="password" name="password_repeat" required>
        </div>
        <br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
