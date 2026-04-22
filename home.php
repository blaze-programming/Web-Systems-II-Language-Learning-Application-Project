<?php
require 'auth.php';

if (!$auth->isLogged()) {
    header('Location: login.php');
    exit();
}

// ✅ Get current user from session
$user = $auth->getUser($_COOKIE['phpauth_session_cookie']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="global-styles.css">
</head>
<body class="dark-mode">

    <?php 
        $pageTitle = "Home";
        include 'menu-bar.php'; 
    ?>

    <main>

        <!-- ✅ Example of using the user -->
        <h2>Welcome, <?= htmlspecialchars($user['email']) ?>!</h2>

    </main>

    <footer>

    </footer>

    <script src="global-scripts.js"></script>
</body>

</html>
