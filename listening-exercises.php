<?php
require 'auth.php';

if (!$auth->isLogged()) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listening Exercises - Japanese Kickstart</title>
    <link rel="stylesheet" href="global-styles.css">
</head>
<body class="dark-mode">

<?php
$pageTitle = "Listening Exercise";
include 'menu-bar.php';
?>

<main>
    <div class="page-content" style="align-items:center;gap:24px;">

        <p class="page-subtext">Press the speaker to hear the audio, then type what you hear.</p>

        <button class="speaker-btn" id="play-btn" aria-label="Play audio">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                <path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path>
                <path d="M19.07 4.93a10 10 0 0 1 0 14.14"></path>
            </svg>
        </button>

        <div class="form-group" style="width:100%;">
            <label class="form-label" for="answer-input">What do you hear?</label>
            <input class="form-input" type="text" id="answer-input"
                   placeholder="Type the sounds you hear..." autocomplete="off">
        </div>

    </div>
</main>

<script>
document.getElementById('play-btn').addEventListener('click', () => {
    // Audio playback will be implemented with exercise data
    console.log('Play audio');
});
</script>
<script src="global-scripts.js"></script>
</body>
</html>
