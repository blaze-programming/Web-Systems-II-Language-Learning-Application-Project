<?php
// logout.php
require 'auth.php';

if ($auth->isLogged()) {
    $hash = $_COOKIE[$config->cookie_name];
    
    // Destroy the session in the database
    $auth->logout($hash);
    
    // Remove the cookie from the browser
    setcookie($config->cookie_name, '', time() - 3600, $config->cookie_path, $config->cookie_domain, $config->cookie_secure, $config->cookie_http);
}

header('Location: home.php');
exit();
