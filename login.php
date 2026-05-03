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

        <h2 class="page-heading">Welcome back</h2>

        <?php if ($error): ?>
            <div class="error-msg"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php" style="display:flex;flex-direction:column;gap:16px;">

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input class="form-input" type="email" id="email" name="email" required
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input class="form-input" type="password" id="password" name="password" required>
            </div>

            <div style="display:flex;align-items:center;gap:8px;">
                <input type="checkbox" id="remember" name="remember" style="display:inline-block;width:auto;">
                <label for="remember" style="font-size:0.9rem;">Remember me</label>
            </div>

            <button type="submit" class="btn btn-primary">Log In</button>

        </form>

        <button class="btn btn-outline" onclick="window.location.href='register.php'">
            Create an Account
        </button>

    </div>
</main>

<script src="global-scripts.js"></script>
</body>
</html>
