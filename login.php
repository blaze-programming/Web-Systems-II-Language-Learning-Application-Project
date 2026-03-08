<?php require_once 'auth.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="global-styles.css">
</head>

<body class="dark-mode">

<?php 
$pageTitle = "Login";
include 'menu-bar.php';
?>

<main>

<h2>Login</h2>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $result = $auth->login($_POST['email'], $_POST['password']);

    if ($result['error']) {
        echo "<p style='color:red'>" . $result['message'] . "</p>";
    } else {
        echo "<p style='color:green'>Login successful!</p>";
    }

}

?>

<form method="POST">

<label>Email</label><br>
<input type="email" name="email" required><br><br>

<label>Password</label><br>
<input type="password" name="password" required><br><br>

<button type="submit">Login</button>

</form>

</main>

<script src="global-scripts.js"></script>

</body>
</html>