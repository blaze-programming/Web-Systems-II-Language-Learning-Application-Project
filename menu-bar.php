<header>
    <button id="back-btn" class="icon-btn" aria-label="Go back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
    </button>

    <h1><?php echo htmlspecialchars($pageTitle ?? "Japanese Kickstart"); ?></h1>

    <button id="menu-btn" class="icon-btn" aria-label="Open menu">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="3"></circle>
            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
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
            <a class="side-menu-link" href="home.php">
                <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" style="filter: brightness(0) invert(1)">
                    <image height="16" width="16" href="home-icon.svg"/>
                </svg>  
                Home
            </a>
            <a class="side-menu-link" href="profile.php">
                <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" style="filter: brightness(0) invert(1)">
                    <image height="16" width="16" href="profile-icon.svg"/>
                </svg>  
                My Profile
            </a>
            <?php if (isset($auth) && $auth->isLogged()): ?>
                <a class="side-menu-link" href="logout.php">
                    <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" style="filter: brightness(0) invert(1)">
                        <image height="16" width="16" href="logout-icon.svg"/>
                    </svg>  
                    Logout
                </a>
            <?php else: ?>
                <a class="side-menu-link" href="login.php">
                    <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" style="filter: brightness(0) invert(1)">
                        <image height="16" width="16" href="login-icon.svg"/>
                    </svg>  
                    Login
                </a>
            <?php endif; ?>
        </div>

        <div class="side-menu-group">
            <h3>Exercises</h3>
            <a class="side-menu-link" href="kana-learning-home.php">あ Kana</a>
            <a class="side-menu-link" href="listening-home.php">
                <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" style="filter: invert(1)">
                    <image height="16" width="16" href="speaker-icon.svg"/>
                </svg>    
                Listening
            </a>
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