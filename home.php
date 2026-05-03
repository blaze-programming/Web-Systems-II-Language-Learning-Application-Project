<?php
require 'auth.php';
$isLoggedIn = $auth->isLogged();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Japanese Kickstart</title>
    <link rel="stylesheet" href="global-styles.css">
</head>
<body class="dark-mode">

<?php
$pageTitle = "Japanese Kickstart";
include 'menu-bar.php';
?>

<main>
    <div class="page-content" style="justify-content: center; flex-grow: 1;">
        <p class="page-subtext" style="font-size:1.1rem; margin-top: 20px;">
            Welcome to Japanese Kickstart, here you can kickstart your language learning journey. By practicing the most important concepts for beginners including learning the alphabet and understanding the spoken sounds of the language.
        </p>

        <a href="<?= $isLoggedIn ? 'select-exercise.php' : 'login.php' ?>" class="btn btn-primary" style="margin-top: 10px;">
            Start Learning
        </a>
    </div>
</main>

<script src="global-scripts.js"></script>
</body>
</html>
