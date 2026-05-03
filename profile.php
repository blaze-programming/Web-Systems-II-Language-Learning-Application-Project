<?php
require 'auth.php';

if (!$auth->isLogged()) {
    header('Location: login.php');
    exit();
}

$user  = $auth->getCurrentUser();
$uid   = $user['id'];
$error = '';
$success = '';

// --- Handle POST actions ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'update_email') {
        $newEmail = trim($_POST['new_email'] ?? '');
        if ($newEmail) {
            $result = $auth->setEmail($uid, $newEmail);
            if ($result['error']) {
                $error = $result['message'];
            } else {
                $success = 'Email updated successfully.';
                $user = $auth->getUser($_COOKIE[$config->cookie_name]);
            }
        }
    }

    if ($action === 'update_password') {
        $current  = $_POST['current_password'] ?? '';
        $newPass  = $_POST['new_password'] ?? '';
        $newPass2 = $_POST['new_password_repeat'] ?? '';
        $result = $auth->changePassword($uid, $current, $newPass, $newPass2);
        if ($result['error']) {
            $error = $result['message'];
        } else {
            $success = 'Password updated successfully.';
        }
    }

    if ($action === 'delete_account') {
        $hash = $_COOKIE[$config->cookie_name];
        $auth->logout($hash);
        setcookie($config->cookie_name, '', time() - 3600, $config->cookie_path,
                  $config->cookie_domain, $config->cookie_secure, $config->cookie_http);
        $stmt = $dbh->prepare('DELETE FROM phpauth_users WHERE id = ?');
        $stmt->execute([$uid]);
        header('Location: home.php');
        exit();
    }

    if ($action === 'reset_kana') {
        $dbh->prepare('DELETE FROM user_kana_progress WHERE user_fk = ?')->execute([$uid]);
        $success = 'Kana progress reset.';
    }

    if ($action === 'reset_listening') {
        $dbh->prepare('DELETE FROM user_listening_progress WHERE user_fk = ?')->execute([$uid]);
        $success = 'Listening progress reset.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Japanese Kickstart</title>
    <link rel="stylesheet" href="global-styles.css">
</head>
<body class="dark-mode">

<?php
$pageTitle = "Profile";
include 'menu-bar.php';
?>

<main>
    <div class="page-content">

        <?php if ($error): ?>
            <div class="error-msg"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="success-msg"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <div class="tabs">
            <button class="tab-btn" data-tab="tab-account">Account Info</button>
            <button class="tab-btn" data-tab="tab-progress">Learning Progress</button>
        </div>

        <!-- Account Info Tab -->
        <div class="tab-panel" id="tab-account">

            <div class="card">
                <p style="font-size:0.8rem;color:var(--focus-color);margin-bottom:4px;">Current Email</p>
                <p style="font-weight:600;"><?= htmlspecialchars($user['email']) ?></p>
            </div>

            <form method="POST" style="display:flex;flex-direction:column;gap:12px;">
                <input type="hidden" name="action" value="update_email">
                <div class="form-group">
                    <label class="form-label" for="new_email">New Email</label>
                    <input class="form-input" type="email" id="new_email" name="new_email" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Email</button>
            </form>

            <form method="POST" style="display:flex;flex-direction:column;gap:12px;">
                <input type="hidden" name="action" value="update_password">
                <div class="form-group">
                    <label class="form-label" for="current_password">Current Password</label>
                    <input class="form-input" type="password" id="current_password" name="current_password" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="new_password">New Password</label>
                    <input class="form-input" type="password" id="new_password" name="new_password" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="new_password_repeat">Confirm New Password</label>
                    <input class="form-input" type="password" id="new_password_repeat" name="new_password_repeat" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Password</button>
            </form>

            <form method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This cannot be undone.');">
                <input type="hidden" name="action" value="delete_account">
                <button type="submit" class="btn btn-danger">Delete Account</button>
            </form>

        </div>

        <!-- Learning Progress Tab -->
        <div class="tab-panel" id="tab-progress">

            <div class="card" style="display:flex;flex-direction:column;gap:10px;">
                <p style="font-weight:600;">Kana Progress</p>
                <p style="font-size:0.85rem;color:var(--focus-color);">Reset all your kana learning progress back to zero.</p>
                <form method="POST" onsubmit="return confirm('Reset all kana progress?');">
                    <input type="hidden" name="action" value="reset_kana">
                    <button type="submit" class="btn btn-danger btn-sm">Reset Kana Progress</button>
                </form>
            </div>

            <div class="card" style="display:flex;flex-direction:column;gap:10px;">
                <p style="font-weight:600;">Listening Progress</p>
                <p style="font-size:0.85rem;color:var(--focus-color);">Reset all your listening exercise progress back to zero.</p>
                <form method="POST" onsubmit="return confirm('Reset all listening progress?');">
                    <input type="hidden" name="action" value="reset_listening">
                    <button type="submit" class="btn btn-danger btn-sm">Reset Listening Progress</button>
                </form>
            </div>

        </div>

    </div>
</main>

<script src="global-scripts.js"></script>
</body>
</html>
