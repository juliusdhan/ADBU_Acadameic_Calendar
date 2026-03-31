<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Academic Calendar - Assam Don Bosco University</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Anti-flash: apply saved theme before page renders -->
    <script>
        (function() {
            if (localStorage.getItem('theme') === 'light') {
                document.documentElement.classList.add('light-mode');
            }
        })();
    </script>
    <script src="js/script.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            background: linear-gradient(to bottom right, #0a0f1f, #050816);
            color: white;
        }

        body.light {
            background: linear-gradient(to bottom right, #e8f0fe, #f0f4ff);
            color: #0a0f1f;
        }

        body.light header {
            border-color: rgba(6, 182, 212, 0.25);
            background-color: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(8px);
        }

        body.light .nav-link {
            color: #1e3a5f;
        }

        body.light .nav-link:hover {
            color: #0891b2;
        }

        body.light .title-text {
            color: #0e7490;
        }

        body.light .dropdown-box {
            background: rgba(255, 255, 255, 0.97) !important;
            border-color: rgba(6, 182, 212, 0.3) !important;
        }

        body.light .dropdown-box a {
            color: #1e3a5f !important;
        }

        body.light .dropdown-label {
            color: #0e7490 !important;
        }
    </style>
</head>

<body class="text-white transition-colors duration-300">

    <header class="border-b border-cyan-400/40 transition-colors duration-300">
        <div class="w-full py-2 px-6 md:px-24 md:py-4">

            <!-- ══════════ MOBILE ══════════ -->

            <!-- Logo -->
            <div class="flex justify-center lg:hidden">
                <img src="assets/adbu-logo.png" alt="ADBU Logo" class="h-20">
            </div>

            <!-- Title + toggle + hamburger row -->
            <div class="grid grid-cols-3 items-center mt-2 lg:hidden">

                <!-- Left: theme toggle -->
                <div class="flex justify-start">
                    <button id="themeToggleMobile" class="text-cyan-400 text-xl leading-none focus:outline-none">
                        <span id="mobileThemeIcon">🌙</span>
                    </button>
                </div>

                <!-- Center: title -->
                <div class="flex justify-center">
                    <h1 class="title-text text-xl font-bold text-cyan-400 whitespace-nowrap">
                        ADBU Academic Calendar
                    </h1>
                </div>

                <!-- Right: hamburger -->
                <div class="flex justify-end">
                    <button id="menuToggle" class="text-cyan-400 text-2xl focus:outline-none">
                        ☰
                    </button>
                </div>

            </div>

            <!-- ══════════ DESKTOP ══════════ -->
            <div class="hidden lg:flex items-center justify-between ">

                <!-- Logo — left -->
                <!-- Logo + Title together on the LEFT -->
                <div class="flex items-center gap-4">
                    <img src="assets/adbu-logo.png" alt="ADBU Logo" class="h-20 w-20">
                    <h1 class="title-text text-3xl font-bold uppercase text-cyan-400 whitespace-nowrap">
                        ADBU Academic Calendar
                    </h1>
                </div>

                <!-- Nav — right -->
                <nav class="flex gap-6 text-lg items-center">

                    <a href="index.php" class="nav-link hover:text-cyan-300 text-2xl font-semibold transition-colors">Dashboard</a>
                    <a href="events.php" class="nav-link hover:text-cyan-300 text-2xl font-semibold transition-colors">All Events</a>
                    <a href="calendar.php" class="nav-link hover:text-cyan-300 text-2xl font-semibold transition-colors">Calendar View</a>

                    <?php if (isset($_SESSION['admin'])): ?>

                        <a href="admin/dashboard.php" class="nav-link hover:text-cyan-300 text-2xl font-semibold transition-colors">Admin Dashboard</a>

                        <!-- Admin avatar dropdown -->
                        <div class="relative">
                            <button id="desktopAvatarBtn"
                                class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-white font-bold text-lg border-2 border-cyan-400/50 hover:border-cyan-300 hover:scale-105 transition-all focus:outline-none">
                                <?php echo strtoupper(substr($_SESSION['admin'], 0, 1)); ?>
                            </button>
                            <div id="desktopDropdownMenu"
                                class="dropdown-box hidden absolute right-0 top-12 w-52 rounded-xl border border-cyan-400/20 bg-[#0a1428]/95 backdrop-blur-xl shadow-2xl overflow-hidden z-50">
                                <div class="dropdown-label px-4 py-3 text-xs uppercase tracking-widest text-cyan-400 border-b border-cyan-400/10">Signed in as</div>
                                <a href="#" class="flex items-center gap-3 px-4 py-3 text-cyan-300 font-semibold hover:bg-cyan-400/10 transition-colors">
                                    <svg class="w-4 h-4 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <?php echo htmlspecialchars($_SESSION['admin']); ?>
                                </a>
                                <a href="../logout.php" class="flex items-center gap-3 px-4 py-3 text-red-400 hover:bg-red-400/10 border-t border-cyan-400/10 transition-colors">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                                    </svg>
                                    Logout
                                </a>
                            </div>
                        </div>

                    <?php elseif (isset($_SESSION['user'])): ?>

                        <!-- User avatar dropdown -->
                        <div class="relative">
                            <button id="desktopAvatarBtn"
                                class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-white font-bold text-lg border-2 border-cyan-400/50 hover:border-cyan-300 hover:scale-105 transition-all focus:outline-none">
                                <?php echo strtoupper(substr($_SESSION['user'], 0, 1)); ?>
                            </button>
                            <div id="desktopDropdownMenu"
                                class="dropdown-box hidden absolute right-0 top-12 w-52 rounded-xl border border-cyan-400/20 bg-[#0a1428]/95 backdrop-blur-xl shadow-2xl overflow-hidden z-50">
                                <div class="dropdown-label px-4 py-3 text-xs uppercase tracking-widest text-cyan-400 border-b border-cyan-400/10">Signed in as</div>
                                <a href="#" class="flex items-center gap-3 px-4 py-3 text-cyan-300 font-semibold hover:bg-cyan-400/10 transition-colors">
                                    <svg class="w-4 h-4 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <?php echo htmlspecialchars($_SESSION['user']); ?>
                                </a>
                                <a href="logout.php" class="flex items-center gap-3 px-4 py-3 text-red-400 hover:bg-red-400/10 border-t border-cyan-400/10 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                                    </svg>
                                    Logout
                                </a>
                            </div>
                        </div>

                    <?php else: ?>

                        <a href="login.php" class="nav-link hover:text-cyan-300 text-2xl transition-colors">Login</a>

                    <?php endif; ?>

                    <!-- Theme toggle desktop -->
                    <button id="themeToggle"
                        class="ml-2 p-2 rounded-full bg-white/10 hover:bg-white/20 transition-colors focus:outline-none">
                        <span id="themeIcon" class="text-2xl leading-none">🌙</span>
                    </button>

                </nav>
            </div>

            <!-- ══════════ MOBILE MENU ══════════ -->
            <div id="mobileMenu" class="hidden mt-4 flex-col gap-3 text-center lg:hidden text-lg">

                <a href="index.php" class="nav-link hover:text-cyan-300 transition-colors">Dashboard</a>
                <a href="events.php" class="nav-link hover:text-cyan-300 transition-colors">All Events</a>
                <a href="calendar.php" class="nav-link hover:text-cyan-300 transition-colors">Calendar View</a>

                <?php if (isset($_SESSION['admin'])): ?>

                    <a href="admin/dashboard.php" class="nav-link hover:text-cyan-300 transition-colors">Admin Dashboard</a>

                    <div class="flex flex-col items-center gap-2">
                        <button id="mobileAvatarBtn"
                            class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-white font-bold text-lg border-2 border-cyan-400/50 hover:border-cyan-300 transition-all focus:outline-none">
                            <?php echo strtoupper(substr($_SESSION['admin'], 0, 1)); ?>
                        </button>
                        <div id="mobileDropdownMenu"
                            class="hidden w-48 mx-auto rounded-xl border border-cyan-400/20 bg-[#0a1428]/95 backdrop-blur-xl shadow-xl overflow-hidden">
                            <div class="px-4 py-3 text-xs uppercase tracking-widest text-cyan-400 border-b border-cyan-400/10">
                                <?php echo htmlspecialchars($_SESSION['admin']); ?>
                            </div>
                            <a href="../logout.php" class="flex items-center justify-center gap-2 px-4 py-3 text-red-400 hover:bg-red-400/10 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                                </svg>
                                Logout
                            </a>
                        </div>
                    </div>

                <?php elseif (isset($_SESSION['user'])): ?>

                    <div class="flex flex-col items-center gap-2">
                        <button id="mobileAvatarBtn"
                            class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-white font-bold text-lg border-2 border-cyan-400/50 hover:border-cyan-300 transition-all focus:outline-none">
                            <?php echo strtoupper(substr($_SESSION['user'], 0, 1)); ?>
                        </button>
                        <div id="mobileDropdownMenu"
                            class="hidden w-48 mx-auto rounded-xl border border-cyan-400/20 bg-[#0a1428]/95 backdrop-blur-xl shadow-xl overflow-hidden">
                            <div class="px-4 py-3 text-xs uppercase tracking-widest text-cyan-400 border-b border-cyan-400/10">
                                <?php echo htmlspecialchars($_SESSION['user']); ?>
                            </div>
                            <a href="logout.php" class="flex items-center justify-center gap-2 px-4 py-3 text-red-400 hover:bg-red-400/10 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                                </svg>
                                Logout
                            </a>
                        </div>
                    </div>

                <?php else: ?>

                    <a href="login.php" class="nav-link hover:text-cyan-300 transition-colors">Login</a>

                <?php endif; ?>

            </div>

        </div>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // ── Mobile hamburger ──────────────────────────────
            const menuToggle = document.getElementById('menuToggle');
            const mobileMenu = document.getElementById('mobileMenu');
            if (menuToggle) {
                menuToggle.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                    mobileMenu.classList.toggle('flex');
                });
            }

            // ── Desktop avatar dropdown ───────────────────────
            const desktopAvatarBtn = document.getElementById('desktopAvatarBtn');
            const desktopDropdownMenu = document.getElementById('desktopDropdownMenu');
            if (desktopAvatarBtn && desktopDropdownMenu) {
                desktopAvatarBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    desktopDropdownMenu.classList.toggle('hidden');
                });
                document.addEventListener('click', () => {
                    desktopDropdownMenu.classList.add('hidden');
                });
            }

            // ── Mobile avatar dropdown ────────────────────────
            const mobileAvatarBtn = document.getElementById('mobileAvatarBtn');
            const mobileDropdownMenu = document.getElementById('mobileDropdownMenu');
            if (mobileAvatarBtn && mobileDropdownMenu) {
                mobileAvatarBtn.addEventListener('click', () => {
                    mobileDropdownMenu.classList.toggle('hidden');
                });
            }

            // ── Dark / Light mode ─────────────────────────────
            const body = document.body;
            const themeIcon = document.getElementById('themeIcon');
            const mobileIcon = document.getElementById('mobileThemeIcon');

            function applyTheme(theme) {
                if (theme === 'light') {
                    body.classList.add('light');
                    if (themeIcon) themeIcon.textContent = '☀️';
                    if (mobileIcon) mobileIcon.textContent = '☀️';
                } else {
                    body.classList.remove('light');
                    if (themeIcon) themeIcon.textContent = '🌙';
                    if (mobileIcon) mobileIcon.textContent = '🌙';
                }
            }

            function toggleTheme() {
                const newTheme = body.classList.contains('light') ? 'dark' : 'light';
                localStorage.setItem('theme', newTheme);
                applyTheme(newTheme);
            }

            applyTheme(localStorage.getItem('theme') || 'dark');

            const toggleBtn = document.getElementById('themeToggle');
            const toggleBtnMobile = document.getElementById('themeToggleMobile');
            if (toggleBtn) toggleBtn.addEventListener('click', toggleTheme);
            if (toggleBtnMobile) toggleBtnMobile.addEventListener('click', toggleTheme);

        });
    </script>

</body>