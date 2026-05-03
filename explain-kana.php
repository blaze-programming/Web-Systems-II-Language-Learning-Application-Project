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
    <title>What is Kana - Japanese Kickstart</title>
    <link rel="stylesheet" href="global-styles.css">
    <style>
        .video-wrap {
            width: 100%;
            aspect-ratio: 16 / 9;
            border-radius: 8px;
            overflow: hidden;
            background-color: #000;
        }
        .video-wrap iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body class="dark-mode">

<?php
$pageTitle = "What is Kana";
include 'menu-bar.php';
?>

<main>
    <div class="page-content">

        <h2 class="page-heading">What is Kana?</h2>

        <div class="video-wrap">
            <iframe
                src="https://www.youtube.com/embed/6p9Il_j0zjc"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>

        <a href="kana-learning-home.php" class="btn btn-primary">Continue to Kana Exercises</a>

    </div>
</main>

<script src="global-scripts.js"></script>
</body>
</html>



