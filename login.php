<?php
// login.php
require 'auth.php';

$message = '';

// Redirect if already logged in
if ($auth->isLogged()) {
    header('Location: dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? true : false;

    // PHPAuth login function
    $result = $auth->login($email, $password, $remember);

    if ($result['error']) {
        $message = "<div style='color: red;'>{$result['message']}</div>";
    } else {
        // Set the authentication cookie
        setcookie($config->cookie_name, $result['hash'], $result['expire'], $config->cookie_path, $config->cookie_domain, $config->cookie_secure, $config->cookie_http);
        
        header('Location: dashboard.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Language Learning App</title>
</head>
<body>
    <h2>Login</h2>
    <?= $message ?>
    <form method="POST" action="login.php">
        <div>
            <label>Email:</label><br>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Password:</label><br>
            <input type="password" name="password" required>
        </div>
        <div>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember Me</label>
        </div>
        <br>
        <button type="submit">Log In</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
</body>
</html>
