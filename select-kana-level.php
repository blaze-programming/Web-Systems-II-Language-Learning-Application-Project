<?php
require 'auth.php';

if (!$auth->isLogged()) {
    header('Location: login.php');
    exit();
}

$user = $auth->getCurrentUser();
$uid  = $user['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kana_level'])) {
    $level = $_POST['kana_level'];

    // Fetch all kana IDs
    $kanaRows = $dbh->query('SELECT id FROM kana')->fetchAll(PDO::FETCH_COLUMN);

    // Clear existing progress for this user
    $dbh->prepare('DELETE FROM user_kana_progress WHERE user_fk = ?')->execute([$uid]);

    if ($level === 'no') {
        // Beginner: progress 0, no last_time_encountered
        $stmt = $dbh->prepare(
            'INSERT INTO user_kana_progress (user_fk, kana_fk, kana_type, progress, last_time_encountered)
             VALUES (?, ?, ?, 0, NULL)'
        );
        foreach ($kanaRows as $kanaId) {
            $stmt->execute([$uid, $kanaId, 'hiragana']);
            $stmt->execute([$uid, $kanaId, 'katakana']);
        }
        header('Location: explain-kana.php');
    } elseif ($level === 'some') {
        // Some knowledge: progress 25, last_encountered = now
        $stmt = $dbh->prepare(
            'INSERT INTO user_kana_progress (user_fk, kana_fk, kana_type, progress, last_time_encountered)
             VALUES (?, ?, ?, 25, NOW())'
        );
        foreach ($kanaRows as $kanaId) {
            $stmt->execute([$uid, $kanaId, 'hiragana']);
            $stmt->execute([$uid, $kanaId, 'katakana']);
        }
        header('Location: kana-learning-home.php');
    } else {
        // Most/All knowledge: progress 80, last_encountered = now
        $stmt = $dbh->prepare(
            'INSERT INTO user_kana_progress (user_fk, kana_fk, kana_type, progress, last_time_encountered)
             VALUES (?, ?, ?, 80, NOW())'
        );
        foreach ($kanaRows as $kanaId) {
            $stmt->execute([$uid, $kanaId, 'hiragana']);
            $stmt->execute([$uid, $kanaId, 'katakana']);
        }
        header('Location: kana-learning-home.php');
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kana Level - Japanese Kickstart</title>
    <link rel="stylesheet" href="global-styles.css">
</head>
<body class="dark-mode">

<?php
$pageTitle = "Kana Level";
include 'menu-bar.php';
?>

<main>
    <div class="page-content">

        <h2 class="page-heading">Are you Familliar with kana?</h2>

        <form method="POST" style="display:flex;flex-direction:column;gap:16px;">
            <button type="submit" name="kana_level" value="no" class="btn btn-outline" style="font-size:1.25em;">
                No
            </button>
            <button type="submit" name="kana_level" value="yes" class="btn btn-outline" style="font-size:1.25em;">
                Yes
            </button>
        </form>

    </div>
</main>

<script src="global-scripts.js"></script>
</body>
</html>

