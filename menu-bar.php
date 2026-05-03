<header>
    <button id="back-btn" class="icon-btn" aria-label="Go back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
    </button>

    <h1><?php echo htmlspecialchars($pageTitle ?? "Japanese Kickstart"); ?></h1>

    <button id="menu-btn" class="icon-btn" aria-label="Open menu">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
    </button>
</header>

<div id="side-menu-overlay"></div>
<div id="side-menu">
    <div class="side-menu-header">
        <h2>Menu</h2>
        <button id="close-side-menu-btn" aria-label="Close menu">&times;</button>
    </div>

    <div class="side-menu-content">

        <div class="side-menu-group">
            <h3>Navigation</h3>
            <a class="side-menu-link" href="home.php">🏠 Home</a>
            <a class="side-menu-link" href="profile.php">👤 My Profile</a>
            <?php if (isset($auth) && $auth->isLogged()): ?>
                <a class="side-menu-link" href="logout.php">🚪 Logout</a>
            <?php else: ?>
                <a class="side-menu-link" href="login.php">🔑 Login</a>
            <?php endif; ?>
        </div>

        <div class="side-menu-group">
            <h3>Exercises</h3>
            <a class="side-menu-link" href="kana-learning-home.php">✍️ Kana</a>
            <a class="side-menu-link" href="listening-home.php">🎧 Listening</a>
        </div>

        <div class="side-menu-group">
            <h3>Settings</h3>
            <div class="side-menu-toggle">
                <span>Dark Mode</span>
                <div class="toggle-container">
                    <input type="checkbox" id="theme-toggle" checked>
                    <label for="theme-toggle" class="toggle-switch"></label>
                </div>
            </div>
        </div>

        <div class="side-menu-group">
            <h3>Contributors</h3>
            <div class="attribution-text">
                Aram A.<br>
                Juan P.<br>
                Hayden G.
            </div>
        </div>

    </div>
</div>