<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
<link rel="stylesheet" href="global-styles.css">
</head>

<body class="dark-mode">

<?php 
$pageTitle = "Register";
include 'menu-bar.php';
?>

<main>

<h2>Create Account</h2>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $result = $auth->register(
        $_POST['email'],
        $_POST['password'],
        $_POST['password']
    );

    if ($result['error']) {
        echo "<p style='color:red'>" . $result['message'] . "</p>";
    } else {
        echo "<p style='color:green'>Account created!</p>";
    }

}

?>

<form method="POST">

<label>Email</label><br>
<input type="email" name="email" required><br><br>

<label>Password</label><br>
<input type="password" name="password" required><br><br>

<button type="submit">Register</button>

</form>

</main>

<script src="global-scripts.js"></script>

</body>
</html>
