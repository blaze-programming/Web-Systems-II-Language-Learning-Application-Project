<?php
require 'auth.php';

if (!$auth->isLogged()) {
    header('Location: login.php');
    exit();
}

$user = $auth->getCurrentUser();
$uid  = $user['id'];

// Calculate average progress across all listening exercises for this user
$stmt = $dbh->prepare(
    'SELECT AVG(ulp.progress) AS avg_progress
     FROM user_listening_progress ulp
     WHERE ulp.user_fk = ?'
);
$stmt->execute([$uid]);
$avgProgress = (float)($stmt->fetchColumn() ?? 0);
$avgProgress = round(min(100, max(0, $avgProgress)));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listening Home - Japanese Kickstart</title>
    <link rel="stylesheet" href="global-styles.css">
</head>
<body class="dark-mode">

<?php
$pageTitle = "Listening";
include 'menu-bar.php';
?>

<main>
    <div class="page-content">

        <h2 class="page-heading">Listening Exercises</h2>

        <div class="card" style="display:flex;flex-direction:column;gap:8px;">
            <div style="display:flex;justify-content:space-between;font-size:0.85rem;color:var(--focus-color);">
                <span>Overall Progress</span>
                <span><?= $avgProgress ?>%</span>
            </div>
            <div class="progress-bar-wrap">
                <div class="progress-bar-fill" style="width:<?= $avgProgress ?>%;"></div>
            </div>
        </div>

        <a href="listening-exercises.php" class="btn btn-primary">▶ Start Exercises</a>

    </div>
</main>

<script src="global-scripts.js"></script>
</body>
</html>
