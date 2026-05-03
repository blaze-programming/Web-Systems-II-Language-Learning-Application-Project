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
                src="https://www.youtube.com/embed/4Irzvrcpf4Q"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>

        <p class="page-subtext">
            Japanese does not have a traditional alphabet like English. It uses 3 different writing systems.
            Kanji is where every word has a unique symbol, which takes years to master. And also Hiragana and
            Katakana. These are more like a traditional alphabet. These are the kana. Each kana represents a
            sound. Learning the kana is the first step to being able to read, write, speak, and understand
            Japanese. Hiragana and katakana have the same set of sounds, but they are used in different
            places. Hiragana is used for words or grammar which do not have a kanji writing. Katakana is used
            mostly to write loan words, which are words from other languages. Lastly there is romaji. This
            uses English characters to show the nearest English pronunciation to a kana.
        </p>

        <a href="kana-learning-home.php" class="btn btn-primary">Continue to Kana Exercises</a>

    </div>
</main>

<script src="global-scripts.js"></script>
</body>
</html>



