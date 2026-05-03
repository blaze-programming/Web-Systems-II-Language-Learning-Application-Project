<?php
require 'auth.php';

if (!$auth->isLogged()) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Listening Exercises - Japanese Kickstart</title>
    <link rel="stylesheet" href="global-styles.css">
</head>
<body class="dark-mode">

<?php
$pageTitle = "Listening Exercises";
include 'menu-bar.php';
?>

<main>
    <div class="page-content">

        <h2 class="page-heading">How the Exercises Work</h2>

        <p class="page-subtext">
            When you hear people speak other languages, it is very hard to lock onto what they are actually saying when you are not accustomed to the sound of the language. It is for this reason that many new learners can hear a native speaker say something that should be recognizable, but isn't. These exercises challenge you to listen to simple sentences and phrases and to just type the sounds you hear, not worrying about the meaning or the correct characters.
        </p>

        <a href="listening-home.php" class="btn btn-primary">Let's Go →</a>

    </div>
</main>

<script src="global-scripts.js"></script>
</body>
</html>
