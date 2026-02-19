<header>
    <button id="home-btn" class="icon-btn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 9L12 2L21 9V20A2 2 0 0 1 19 22H5A2 2 0 0 1 3 20V9Z"/>
            <path d="M9 22V12H15V22"/>
        </svg>
    </button>

    <h1><?php echo $pageTitle ?? "no page title"; ?></h1>
    
    <button id="menu-btn" class="icon-btn">
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
        <button id="close-side-menu-btn">&times;</button>
    </div>

    <div class="side-menu-content">
        
        <div class="side-menu-group">
            <h3>Account</h3>
            <a class="side-menu-link" href="./profile?tab=account_info">Go to profile</a>
            <a class="side-menu-link" href="./profile?tab=my_progress">My Progress</a>
        </div>

        <div class="side-menu-group">
            <h3>Exercises</h3>
            <a class="side-menu-link" href="./kana-home">Kana</a>
            <a class="side-menu-link" href="./listening-home">Listening</a>
            <a class="side-menu-link" href="./grammar-home">Grammar</a>
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
            
            <div class="side-menu-toggle">
                <span>Audio</span>
                <div class="toggle-container">
                    <input type="checkbox" id="master-audio-toggle" checked>
                    <label for="master-audio-toggle" class="toggle-switch"></label>
                </div>
            </div>

            <div id="audio-subsettings" class="sub-menu">
                <div class="side-menu-toggle">
                    <span>Sound Effects</span>
                    <div class="toggle-container">
                        <input type="checkbox" id="sfx-toggle" checked>
                        <label for="sfx-toggle" class="toggle-switch"></label>
                    </div>
                </div>
                <div class="side-menu-toggle">
                    <span>Exercise Sound</span>
                    <div class="toggle-container">
                        <input type="checkbox" id="exercise-sound-toggle" checked>
                        <label for="exercise-sound-toggle" class="toggle-switch"></label>
                    </div>
                </div>
            </div>
        </div>

        <?php if (isset($isExercisePage) && $isExercisePage): ?>
        <div class="side-menu-group" id="exercise-settings-group">
            <h3>Exercise Settings</h3>
            <div class="side-menu-toggle">
                <span>Show Romaji</span>
                <div class="toggle-container">
                    <input type="checkbox" id="show-romaji-toggle">
                    <label for="show-romaji-toggle" class="toggle-switch"></label>
                </div>
            </div>
            </div>
        <?php endif; ?>

        <div class="side-menu-group">
            <h3>Attribution</h3>
            <div class="attribution-text">
                Made by: Creator 1, Creator 2, Creator 3
            </div>
            <a class="side-menu-link" href="./attribution">See all attribution</a>
        </div>

    </div>
</div>