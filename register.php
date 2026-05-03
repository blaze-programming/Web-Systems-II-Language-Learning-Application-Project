<?php
// register.php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'auth.php';

$error   = '';
$success = '';

// Redirect if already logged in
if ($auth->isLogged()) {
    header('Location: home.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email           = $_POST['email'] ?? '';
    $password        = $_POST['password'] ?? '';
    $password_repeat = $_POST['password_repeat'] ?? '';

    $result = $auth->register($email, $password, $password_repeat);

    if ($result['error']) {
        $error = $result['message'];
    } else {
        $success = 'Registration successful! You can now log in.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Japanese Kickstart</title>
    <link rel="stylesheet" href="global-styles.css">
</head>
<body class="dark-mode">

<?php
$pageTitle = "Create Account";
include 'menu-bar.php';
?>

<main>
    <div class="page-content">

        <h2 class="page-heading">Create an Account</h2>

        <?php if ($error): ?>
            <div class="error-msg"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success-msg"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST" action="register.php" style="display:flex;flex-direction:column;gap:16px;">

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input class="form-input" type="email" id="email" name="email" required
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input class="form-input" type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="password_repeat">Confirm Password</label>
                <input class="form-input" type="password" id="password_repeat" name="password_repeat" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>

        </form>

        <button class="btn btn-outline" onclick="window.location.href='login.php'">
            Already have an account? Log In
        </button>

    </div>
</main>

<script src="global-scripts.js"></script>
</body>
</html>
