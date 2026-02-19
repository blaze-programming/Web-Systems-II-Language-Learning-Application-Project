document.addEventListener("DOMContentLoaded", () => {
    const menuBtn = document.getElementById("menu-btn");
    const closeMenuBtn = document.getElementById("close-side-menu-btn");
    const sideMenu = document.getElementById("side-menu");
    const sideMenuOverlay = document.getElementById("side-menu-overlay");

    // Open Menu
    menuBtn.addEventListener("click", () => {
        sideMenu.classList.add("open"); // Assuming you use an .open class to slide it in
        sideMenuOverlay.classList.add("visible");
    });

    // Close Menu
    const closeMenu = () => {
        sideMenu.classList.remove("open");
        sideMenuOverlay.classList.remove("visible");
    };

    closeMenuBtn.addEventListener("click", closeMenu);
    sideMenuOverlay.addEventListener("click", closeMenu);

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
        
        // Trigger once on load to ensure correct initial state
        if (!masterAudioToggle.checked) {
            audioSubsettings.classList.add("hidden");
        }
    }
});