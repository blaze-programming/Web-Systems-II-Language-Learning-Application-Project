<?php
require 'auth.php';

if (!$auth->isLogged()) {
    header('Location: login.php');
    exit();
}

$user = $auth->getCurrentUser();
$uid  = $user['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['level'])) {
    $level = $_POST['level'];

    // Fetch all listening exercise IDs
    $exerciseIds = $dbh->query('SELECT id FROM listening_exercise')->fetchAll(PDO::FETCH_COLUMN);

    // Clear existing progress
    $dbh->prepare('DELETE FROM user_listening_progress WHERE user_fk = ?')->execute([$uid]);

    if ($level === 'beginner') {
        // All exercises at 0
        $stmt = $dbh->prepare(
            'INSERT INTO user_listening_progress (user_fk, listening_exercise_fk, progress, last_time_encountered)
             VALUES (?, ?, 0, NULL)'
        );
        foreach ($exerciseIds as $eid) {
            $stmt->execute([$uid, $eid]);
        }
        header('Location: explain-listening-exercises.php');

    } elseif ($level === 'intermediate') {
        // Half at 50, half at 0
        $total    = count($exerciseIds);
        $halfMark = (int)ceil($total / 2);
        $stmt50   = $dbh->prepare(
            'INSERT INTO user_listening_progress (user_fk, listening_exercise_fk, progress, last_time_encountered)
             VALUES (?, ?, 50, NOW())'
        );
        $stmt0    = $dbh->prepare(
            'INSERT INTO user_listening_progress (user_fk, listening_exercise_fk, progress, last_time_encountered)
             VALUES (?, ?, 0, NULL)'
        );
        foreach ($exerciseIds as $i => $eid) {
            if ($i < $halfMark) {
                $stmt50->execute([$uid, $eid]);
            } else {
                $stmt0->execute([$uid, $eid]);
            }
        }
        header('Location: listening-home.php');

    } else {
        // Expert — all at 50
        $stmt = $dbh->prepare(
            'INSERT INTO user_listening_progress (user_fk, listening_exercise_fk, progress, last_time_encountered)
             VALUES (?, ?, 50, NOW())'
        );
        foreach ($exerciseIds as $eid) {
            $stmt->execute([$uid, $eid]);
        }
        header('Location: listening-home.php');
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listening Level - Japanese Kickstart</title>
    <link rel="stylesheet" href="global-styles.css">
</head>
<body class="dark-mode">

<?php
$pageTitle = "Listening Level";
include 'menu-bar.php';
?>

<main>
    <div class="page-content">

        <h2 class="page-heading">Select your listening level</h2>

        <form method="POST" style="display:flex;flex-direction:column;gap:16px;">
            <button type="submit" name="level" value="beginner" class="btn btn-outline">
                Beginner — Start from scratch
            </button>
            <button type="submit" name="level" value="intermediate" class="btn btn-outline">
                Intermediate — I know some phrases
            </button>
            <button type="submit" name="level" value="expert" class="btn btn-primary">
                Expert — I'm comfortable with Japanese sounds
            </button>
        </form>

    </div>
</main>

<script src="global-scripts.js"></script>
</body>
</html>
