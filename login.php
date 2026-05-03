<?php
// login.php
require 'auth.php';

$error = '';

// Redirect if already logged in
if ($auth->isLogged()) {
    header('Location: home.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    $result = $auth->login($email, $password, $remember);

    if ($result['error']) {
        $error = $result['message'];
    } else {
        header('Location: select-exercise.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Japanese Kickstart</title>
    <link rel="stylesheet" href="global-styles.css">
</head>
<body class="dark-mode">

<?php
$pageTitle = "Login";
include 'menu-bar.php';
?>

<main>
    <div class="page-content">

        <?php if ($error): ?>
            <div class="error-msg"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php" style="display:flex;flex-direction:column;gap:16px;">

            <input class="form-input" type="email" id="email" name="email" required
                   placeholder="Email"
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

            <input class="form-input" type="password" id="password" name="password" required
                   placeholder="Password">

            <div style="display:flex;align-items:center;justify-content:space-between;gap:16px;">
                <button type="button" class="btn-text-link" onclick="window.location.href='register.php'">
                    Create<br>Account
                </button>
                <button type="submit" class="btn btn-outline" style="width:auto;padding:16px 32px;">
                    Login
                </button>
            </div>

        </form>

    </div>
</main>

<script src="global-scripts.js"></script>
</body>
</html>
