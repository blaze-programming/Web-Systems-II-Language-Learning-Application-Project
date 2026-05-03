document.addEventListener("DOMContentLoaded", () => {

    // --- Dark Mode Persistence ---
    const savedTheme = localStorage.getItem("theme");
    const themeToggle = document.getElementById("theme-toggle");
    if (savedTheme === "light") {
        document.body.classList.remove("dark-mode");
        if (themeToggle) themeToggle.checked = false;
    } else {
        document.body.classList.add("dark-mode");
        if (themeToggle) themeToggle.checked = true;
    }

    if (themeToggle) {
        themeToggle.addEventListener("change", () => {
            if (themeToggle.checked) {
                document.body.classList.add("dark-mode");
                localStorage.setItem("theme", "dark");
            } else {
                document.body.classList.remove("dark-mode");
                localStorage.setItem("theme", "light");
            }
        });
    }

    // --- Back Button ---
    const backBtn = document.getElementById("back-btn");
    if (backBtn) {
        backBtn.addEventListener("click", () => {
            if (document.referrer && document.referrer !== window.location.href) {
                history.back();
            } else {
                window.location.href = "home.php";
            }
        });
    }

    // --- Side Menu ---
    const menuBtn = document.getElementById("menu-btn");
    const closeMenuBtn = document.getElementById("close-side-menu-btn");
    const sideMenu = document.getElementById("side-menu");
    const sideMenuOverlay = document.getElementById("side-menu-overlay");

    if (menuBtn && sideMenu && sideMenuOverlay) {
        menuBtn.addEventListener("click", () => {
            sideMenu.classList.add("open");
            sideMenuOverlay.classList.add("open");
        });

        const closeMenu = () => {
            sideMenu.classList.remove("open");
            sideMenuOverlay.classList.remove("open");
        };

        if (closeMenuBtn) closeMenuBtn.addEventListener("click", closeMenu);
        sideMenuOverlay.addEventListener("click", closeMenu);
    }

    // --- Info Icon Tooltips ---
    document.querySelectorAll(".info-icon-btn").forEach((btn) => {
        const tooltipId = btn.dataset.tooltip;
        const tooltip = document.getElementById(tooltipId);
        if (!tooltip) return;

        const toggle = () => {
            const isVisible = tooltip.classList.toggle("visible");
            btn.classList.toggle("active", isVisible);
        };

        btn.addEventListener("click", (e) => {
            e.stopPropagation();
            toggle();
        });

        btn.addEventListener("mouseenter", () => {
            tooltip.classList.add("visible");
            btn.classList.add("active");
        });

        btn.addEventListener("mouseleave", () => {
            tooltip.classList.remove("visible");
            btn.classList.remove("active");
        });
    });

    // --- Audio Toggle Logic ---
    const masterAudioToggle = document.getElementById("master-audio-toggle");
    const audioSubsettings = document.getElementById("audio-subsettings");

    if (masterAudioToggle && audioSubsettings) {
        masterAudioToggle.addEventListener("change", (e) => {
            if (e.target.checked) {
                audioSubsettings.classList.remove("hidden");
            } else {
                audioSubsettings.classList.add("hidden");
            }
        });

        if (!masterAudioToggle.checked) {
            audioSubsettings.classList.add("hidden");
        }
    }

    // --- Tab Switching ---
    document.querySelectorAll(".tab-btn").forEach((btn) => {
        btn.addEventListener("click", () => {
            const targetPanel = btn.dataset.tab;
            document.querySelectorAll(".tab-btn").forEach(b => b.classList.remove("active"));
            document.querySelectorAll(".tab-panel").forEach(p => p.classList.remove("active"));
            btn.classList.add("active");
            const panel = document.getElementById(targetPanel);
            if (panel) panel.classList.add("active");
        });
    });

    // Activate first tab on load if tabs exist
    const firstTab = document.querySelector(".tab-btn");
    if (firstTab) firstTab.click();
});