<?php
require 'auth.php';

if (!$auth->isLogged()) {
    header('Location: login.php');
    exit();
}

$user = $auth->getCurrentUser();
$uid  = $user['id'];

// Check if user has any kana progress
$stmtKana = $dbh->prepare('SELECT COUNT(*) FROM user_kana_progress WHERE user_fk = ?');
$stmtKana->execute([$uid]);
$hasKanaProgress = $stmtKana->fetchColumn() > 0;

// Check if user has any listening progress
$stmtListen = $dbh->prepare('SELECT COUNT(*) FROM user_listening_progress WHERE user_fk = ?');
$stmtListen->execute([$uid]);
$hasListeningProgress = $stmtListen->fetchColumn() > 0;

$kanaTarget     = $hasKanaProgress     ? 'kana-learning-home.php'  : 'select-kana-level.php';
$listenTarget   = $hasListeningProgress ? 'listening-home.php'      : 'select-listening-level.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Exercise - Japanese Kickstart</title>
    <link rel="stylesheet" href="global-styles.css">
</head>
<body class="dark-mode">

<?php
$pageTitle = "Select Exercise";
include 'menu-bar.php';
?>

<main>
    <div class="page-content">

        <h2 class="page-heading">What would you like to practice?</h2>

        <div style="display:flex;flex-direction:column;gap:12px;">

            <div class="exercise-btn-row">
                <a href="<?= htmlspecialchars($kanaTarget) ?>" class="btn btn-primary">あ Kana</a>
                <button class="info-icon-btn" data-tooltip="kana-info" aria-label="Info about Kana">i</button>
            </div>
            <div class="info-tooltip" id="kana-info">
                Learn to recognize Kana, the Japanese equivalent of an alphabet
            </div>

            <div class="exercise-btn-row">
                <a href="<?= htmlspecialchars($listenTarget) ?>" class="btn btn-primary">
                    <!-- speaker-icon.svg -->
                    <svg height="24" width="24" xmlns="http://www.w3.org/2000/svg" style="filter: invert(1)">
                        <image height="24" width="24" href="speaker-icon.svg"/>
                    </svg>
                    Listening
                </a>
                <button class="info-icon-btn" data-tooltip="listening-info" aria-label="Info about Listening">i</button>
            </div>
            <div class="info-tooltip" id="listening-info">
                Learn to identify the different sounds in Japanese by listening to real phrases. (You should have a decent understanding of kana for these exercises.)
            </div>

        </div>

    </div>
</main>

<script src="global-scripts.js"></script>
</body>
</html>
