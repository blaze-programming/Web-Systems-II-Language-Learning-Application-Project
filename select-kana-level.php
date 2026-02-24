<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["kana_level"])) {

    $_SESSION["kana_level"] = $_POST["kana_level"];

    if ($_POST["kana_level"] === "beginner") {
        header("Location: explain-kana.php");
    } elseif ($_POST["kana_level"] === "intermediate") {
        header("Location: determine-kana-knowledge.php");
    } else {
        header("Location: kana-learning-home.php");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Kana Level</title>
    <link rel="stylesheet" href="global-styles.css">
</head>

<body class="dark-mode">

<?php 
    $pageTitle = "Select Kana Level";
    include 'menu-bar.php'; 
?>

<main class="kana-level-container">

    <h1 class="kana-title">
        Select your proficiency with kana
    </h1>

    <form method="POST" class="kana-level-form">

        <button type="submit" name="kana_level" value="beginner" class="kana-card">
            Little/No kana knowledge
        </button>

        <button type="submit" name="kana_level" value="intermediate" class="kana-card">
            Some kana knowledge
        </button>

        <button type="submit" name="kana_level" value="expert" class="kana-card">
            Most/All kana knowledge
        </button>

    </form>

</main>

<footer></footer>

<script src="global-scripts.js"></script>
</body>
</html>
