document.addEventListener("DOMContentLoaded", function () {

    // ── Hamburger menu ──────────────────────────────────────
    const toggle = document.getElementById("menuToggle");
    const menu   = document.getElementById("mobileMenu");

    if (toggle && menu) {
        toggle.addEventListener("click", function () {
            menu.classList.toggle("hidden");
            menu.classList.toggle("flex");  // ← this was missing
        });
    }

    // ── Desktop avatar dropdown ─────────────────────────────
    const desktopAvatarBtn    = document.getElementById("desktopAvatarBtn");
    const desktopDropdownMenu = document.getElementById("desktopDropdownMenu");
    if (desktopAvatarBtn && desktopDropdownMenu) {
        desktopAvatarBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            desktopDropdownMenu.classList.toggle("hidden");
        });
        document.addEventListener("click", () => {
            desktopDropdownMenu.classList.add("hidden");
        });
    }

    // ── Mobile avatar dropdown ──────────────────────────────
    const mobileAvatarBtn    = document.getElementById("mobileAvatarBtn");
    const mobileDropdownMenu = document.getElementById("mobileDropdownMenu");
    if (mobileAvatarBtn && mobileDropdownMenu) {
        mobileAvatarBtn.addEventListener("click", () => {
            mobileDropdownMenu.classList.toggle("hidden");
        });
    }

    // ── Dark / Light mode ───────────────────────────────────
    const body       = document.body;
    const themeIcon  = document.getElementById("themeIcon");
    const mobileIcon = document.getElementById("mobileThemeIcon");

    function applyTheme(theme) {
        if (theme === "light") {
            body.classList.add("light");
            if (themeIcon)  themeIcon.textContent  = "☀️";
            if (mobileIcon) mobileIcon.textContent = "☀️";
        } else {
            body.classList.remove("light");
            if (themeIcon)  themeIcon.textContent  = "🌙";
            if (mobileIcon) mobileIcon.textContent = "🌙";
        }
    }

    function toggleTheme() {
        const newTheme = body.classList.contains("light") ? "dark" : "light";
        localStorage.setItem("theme", newTheme);
        applyTheme(newTheme);
    }

    applyTheme(localStorage.getItem("theme") || "dark");

    const toggleBtn       = document.getElementById("themeToggle");
    const toggleBtnMobile = document.getElementById("themeToggleMobile");
    if (toggleBtn)       toggleBtn.addEventListener("click", toggleTheme);
    if (toggleBtnMobile) toggleBtnMobile.addEventListener("click", toggleTheme);

});