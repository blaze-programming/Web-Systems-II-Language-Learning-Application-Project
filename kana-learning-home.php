<?php
require 'auth.php';

if (!$auth->isLogged()) {
    header('Location: login.php');
    exit();
}

$user = $auth->getUser($_COOKIE[$config->cookie_name]);
$uid  = $user['uid'];

// Fetch all kana with the user's hiragana progress
$hiraganaRows = $dbh->prepare(
    'SELECT k.id, k.romaji, k.hiragana, COALESCE(ukp.progress, 0) AS progress
     FROM kana k
     LEFT JOIN user_kana_progress ukp
       ON ukp.kana_fk = k.id AND ukp.user_fk = ? AND ukp.kana_type = "hiragana"
     WHERE k.hiragana IS NOT NULL AND k.hiragana != ""
     ORDER BY k.id'
);
$hiraganaRows->execute([$uid]);
$hiraganaList = $hiraganaRows->fetchAll(PDO::FETCH_ASSOC);

// Fetch all kana with the user's katakana progress
$katakanaRows = $dbh->prepare(
    'SELECT k.id, k.romaji, k.katakana, COALESCE(ukp.progress, 0) AS progress
     FROM kana k
     LEFT JOIN user_kana_progress ukp
       ON ukp.kana_fk = k.id AND ukp.user_fk = ? AND ukp.kana_type = "katakana"
     WHERE k.katakana IS NOT NULL AND k.katakana != ""
     ORDER BY k.id'
);
$katakanaRows->execute([$uid]);
$katakanaList = $katakanaRows->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kana Home - Japanese Kickstart</title>
    <link rel="stylesheet" href="global-styles.css">
</head>
<body class="dark-mode">

<?php
$pageTitle = "Kana";
include 'menu-bar.php';
?>

<main>
    <div class="page-content">

        <a href="kana-exercises.php" class="btn btn-primary">▶ Start Kana Exercises</a>

        <a href="explain-kana.php" class="btn btn-outline btn-sm" style="width:auto;align-self:center;">
            ← What is Kana?
        </a>

        <?php if (!empty($hiraganaList)): ?>
        <div class="kana-section-title">Hiragana</div>
        <div class="kana-grid">
            <?php foreach ($hiraganaList as $k): ?>
            <div class="kana-cell">
                <span class="kana-romaji"><?= htmlspecialchars($k['romaji']) ?></span>
                <span class="kana-char"><?= htmlspecialchars($k['hiragana']) ?></span>
                <div class="kana-cell-progress">
                    <div class="kana-cell-progress-fill"
                         style="width:<?= min(100, (float)$k['progress']) ?>%"></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($katakanaList)): ?>
        <div class="kana-section-title">Katakana</div>
        <div class="kana-grid">
            <?php foreach ($katakanaList as $k): ?>
            <div class="kana-cell">
                <span class="kana-romaji"><?= htmlspecialchars($k['romaji']) ?></span>
                <span class="kana-char"><?= htmlspecialchars($k['katakana']) ?></span>
                <div class="kana-cell-progress">
                    <div class="kana-cell-progress-fill"
                         style="width:<?= min(100, (float)$k['progress']) ?>%"></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (empty($hiraganaList) && empty($katakanaList)): ?>
        <p class="page-subtext">No kana data found. Please make sure the database is populated.</p>
        <?php endif; ?>

    </div>
</main>

<script src="global-scripts.js"></script>
</body>
</html>
