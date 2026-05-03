<?php
require 'auth.php';

if (!$auth->isLogged()) {
    header('Location: login.php');
    exit();
}

$user = $auth->getCurrentUser();
$uid  = $user['id'];

// --- Handle AJAX progress update ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax_update'])) {
    $kanaId   = (int)($_POST['kana_id']   ?? 0);
    $kanaType = $_POST['kana_type'] === 'katakana' ? 'katakana' : 'hiragana';
    if ($kanaId > 0) {
        $dbh->prepare(
            'UPDATE user_kana_progress
             SET progress = LEAST(progress + 1, 100), last_time_encountered = NOW()
             WHERE user_fk = ? AND kana_fk = ? AND kana_type = ?'
        )->execute([$uid, $kanaId, $kanaType]);
    }
    echo json_encode(['ok' => true]);
    exit();
}

// --- Load a random kana that the user has progress records for ---
$allKana = $dbh->prepare(
    'SELECT k.id, k.romaji, k.hiragana, k.katakana, ukp.kana_type
     FROM user_kana_progress ukp
     JOIN kana k ON k.id = ukp.kana_fk
     WHERE ukp.user_fk = ?
       AND k.hiragana IS NOT NULL AND k.hiragana != ""
       AND k.katakana IS NOT NULL AND k.katakana != ""
       AND k.romaji   IS NOT NULL AND k.romaji   != ""
     ORDER BY RAND()
     LIMIT 1'
);
$allKana->execute([$uid]);
$target = $allKana->fetch(PDO::FETCH_ASSOC);

// If no progress yet, redirect to level selection
if (!$target) {
    header('Location: select-kana-level.php');
    exit();
}

// Exercise types: [given_type => asked_type]
$exerciseTypes = [
    ['from' => 'romaji',   'to' => 'katakana'],
    ['from' => 'romaji',   'to' => 'hiragana'],
    ['from' => 'katakana', 'to' => 'hiragana'],
    ['from' => 'hiragana', 'to' => 'katakana'],
    ['from' => 'katakana', 'to' => 'romaji'],
    ['from' => 'hiragana', 'to' => 'romaji'],
];
$exercise = $exerciseTypes[array_rand($exerciseTypes)];
$fromType = $exercise['from'];
$toType   = $exercise['to'];

$prompt  = $target[$fromType];
$correct = $target[$toType];

// Fetch 5 different wrong options
$wrongOptions = $dbh->prepare(
    'SELECT DISTINCT k.' . $toType . ' AS val
     FROM kana k
     WHERE k.id != ?
       AND k.' . $toType . ' IS NOT NULL AND k.' . $toType . ' != ""
     ORDER BY RAND()
     LIMIT 5'
);
$wrongOptions->execute([$target['id']]);
$wrongs = $wrongOptions->fetchAll(PDO::FETCH_COLUMN);

// Build the 6-option array and shuffle
$options = array_merge([$correct], $wrongs);
shuffle($options);

$labels = ['romaji' => 'Rōmaji', 'hiragana' => 'Hiragana', 'katakana' => 'Katakana'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kana Exercises - Japanese Kickstart</title>
    <link rel="stylesheet" href="global-styles.css">
</head>
<body class="dark-mode">

<?php
$pageTitle = "Kana Exercise";
include 'menu-bar.php';
?>

<main>
    <div class="page-content">

        <p class="page-subtext" style="margin-bottom:0;">
            <?= htmlspecialchars($labels[$fromType]) ?> →
            <?= htmlspecialchars($labels[$toType]) ?>
        </p>

        <p class="exercise-prompt"><?= htmlspecialchars($prompt) ?></p>

        <div class="options-grid" id="options-grid">
            <?php foreach ($options as $opt): ?>
            <button
                class="option-btn"
                data-value="<?= htmlspecialchars($opt) ?>"
                onclick="checkAnswer(this)"
            ><?= htmlspecialchars($opt) ?></button>
            <?php endforeach; ?>
        </div>

        <div id="feedback-btn" style="display:none;">
            <button id="continue-btn" class="btn btn-success" style="display:none;"
                    onclick="nextQuestion()">Continue →</button>
            <button id="retry-btn" class="btn btn-danger" style="display:none;"
                    onclick="retryQuestion()">Try Again</button>
        </div>

    </div>
</main>

<script>
const correctAnswer = <?= json_encode($correct) ?>;
const kanaId        = <?= (int)$target['id'] ?>;
const kanaType      = <?= json_encode($target['kana_type']) ?>;
let   answered      = false;

function checkAnswer(btn) {
    if (answered) return;
    answered = true;

    const allBtns = document.querySelectorAll('.option-btn');
    allBtns.forEach(b => b.disabled = true);

    const feedbackDiv  = document.getElementById('feedback-btn');
    const continueBtn  = document.getElementById('continue-btn');
    const retryBtn     = document.getElementById('retry-btn');
    feedbackDiv.style.display = 'block';

    if (btn.dataset.value === correctAnswer) {
        btn.classList.add('correct');
        continueBtn.style.display = 'block';
        // Report progress to server
        fetch(window.location.href, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `ajax_update=1&kana_id=${kanaId}&kana_type=${encodeURIComponent(kanaType)}`
        });
    } else {
        btn.classList.add('wrong');
        retryBtn.style.display = 'block';
    }
}

function nextQuestion() {
    window.location.reload();
}

function retryQuestion() {
    const allBtns = document.querySelectorAll('.option-btn');
    allBtns.forEach(b => {
        b.disabled = false;
        b.classList.remove('correct', 'wrong');
    });
    document.getElementById('feedback-btn').style.display = 'none';
    document.getElementById('retry-btn').style.display = 'none';
    answered = false;
}
</script>

<script src="global-scripts.js"></script>
</body>
</html>
