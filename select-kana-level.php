<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["kana_level"])) {

    $_SESSION["kana_level"] = $_POST["kana_level"];

    switch ($_POST["kana_level"]) {
        case "beginner":
            header("Location: explain-kana.php");
            break;

        case "intermediate":
            header("Location: determine-kana-knowledge.php");
            break;

        case "expert":
            header("Location: kana-learning-home.php");
            break;

        default:
            header("Location: home.php");
            break;
    }

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Kana Level</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="global-styles.css">
</head>

<body class="dark-mode">

<?php 
    $pageTitle = "Choose Your Level";
    include 'menu-bar.php'; 
?>

<main class="kana-level-container">

    <h1 class="kana-title">
        Choose your starting point
    </h1>

    <form method="POST" class="kana-level-form">

        <button type="submit" name="kana_level" value="beginner" class="kana-card">
            <strong>Beginner</strong><br>
            <span class="kana-subtext">Just getting started</span>
        </button>

        <button type="submit" name="kana_level" value="intermediate" class="kana-card">
            <strong>Intermediate</strong><br>
            <span class="kana-subtext">Some kana experience</span>
        </button>

        <button type="submit" name="kana_level" value="expert" class="kana-card">
            <strong>Advanced</strong><br>
            <span class="kana-subtext">Comfortable with kana</span>
        </button>

    </form>

    <div class="back-home">
        <a href="home.php" class="side-menu-link">
            ← Back to Home
        </a>
    </div>

</main>

<footer></footer>

<script src="global-scripts.js"></script>
</body>
</html>
