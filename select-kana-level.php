<?php
require 'auth.php';

if (!$auth->isLogged()) {
    header('Location: login.php');
    exit();
}

$user = $auth->getUser($_COOKIE[$config->cookie_name]);
$uid  = $user['uid'];

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
    } else {
        // Familiar: progress 50, last_encountered = now
        $stmt = $dbh->prepare(
            'INSERT INTO user_kana_progress (user_fk, kana_fk, kana_type, progress, last_time_encountered)
             VALUES (?, ?, ?, 50, NOW())'
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

        <h2 class="page-heading">Are you familiar with Kana?</h2>
        <p class="page-subtext">Kana is the Japanese phonetic alphabet, consisting of hiragana and katakana.</p>

        <form method="POST" style="display:flex;flex-direction:column;gap:16px;">
            <button type="submit" name="kana_level" value="no" class="btn btn-outline">
                No — Start from the beginning
            </button>
            <button type="submit" name="kana_level" value="yes" class="btn btn-primary">
                Yes — I already know some Kana
            </button>
        </form>

    </div>
</main>

<script src="global-scripts.js"></script>
</body>
</html>

