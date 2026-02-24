<?php
session_start();

// If form submitted, store level and redirect
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["kana_level"])) {
        $_SESSION["kana_level"] = $_POST["kana_level"];

        // Redirect based on level
        if ($_POST["kana_level"] === "beginner") {
            header("Location: explain-kana.php");
        } elseif ($_POST["kana_level"] === "intermediate") {
            header("Location: determine-kana-knowledge.php");
        } else {
            header("Location: kana-learning-home.php");
        }
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Kana Level</title>

    <link rel="stylesheet" href="global-styles.css">
    <script defer src="global-scripts.js"></script>
</head>
<body>

<?php include("menu-bar.php"); ?>

<div class="page-container">

    <h1 class="page-title">Select your proficiency with kana</h1>

    <form method="POST" class="level-form">

        <button type="submit" name="kana_level" value="beginner" class="level-card">
            Little/No kana knowledge
        </button>

        <button type="submit" name="kana_level" value="intermediate" class="level-card">
            Some kana knowledge
        </button>

        <button type="submit" name="kana_level" value="expert" class="level-card">
            Most/All kana knowledge
        </button>

    </form>

</div>

</body>
</html>
