<!DOCTYPE html>
<html>

<head>
    <title>Academic Calendar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        tailwind.config = {
            darkMode: 'class', 
        }
    </script>


    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Optional Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-gradient-to-br from-[#0a0f1f] to-[#050816] text-white">

    <header class="border-b border-cyan-400/40">

        <div class="w-full  py-4 px-12 md:py-8">

            <!-- MOBILE LOGO -->
            <div class="flex justify-center lg:hidden">
                <img src="assets/adbu-logo.png" alt="Logo" class="h-12 bg-white">
            </div>

            <!-- MOBILE TITLE + TOGGLE -->
            <div class="flex items-center justify-between mt-2 lg:hidden">

                <h1 class="text-xl font-bold text-cyan-400">
                    ADBU Academic Calendar
                </h1>

                <button id="menuToggle" class="text-cyan-400 text-2xl">
                    ☰
                </button>

            </div>


            <!-- DESKTOP HEADER -->
            <div class="hidden lg:flex items-center  justify-between">

                <!-- Logo -->
                <img src="assets/adbu-logo.png" class="h-16 w-auto bg-white">

                <!-- Title -->
                <h1 class="text-2xl font-bold text-cyan-400">
                    ADBU Academic Calendar
                </h1>

                <!-- Menu -->
                <nav class="flex gap-6 text-lg items-center">

                    <a href="index.php" class="hover:text-cyan-300">Dashboard</a>

                    <a href="events.php" class="hover:text-cyan-300">All Events</a>

                    <a href="calendar.php" class="hover:text-cyan-300">Calendar View</a>


                    <?php if (isset($_SESSION['admin'])): ?>

                        <a href="admin/dashboard.php" class="hover:text-cyan-300">Admin Dashboard</a>

                        <span class="text-cyan-400 font-semibold">
                            <?php echo $_SESSION['admin']; ?>
                        </span>

                        <a href="../logout.php" class="hover:text-red-400">
                            Logout
                        </a>


                    <?php elseif (isset($_SESSION['user'])): ?>

                        <span class="text-cyan-400 font-semibold">
                            <?php echo $_SESSION['user']; ?>
                        </span>

                        <a href="logout.php" class="hover:text-red-400">
                            Logout
                        </a>

                    <?php else: ?>

                        <a href="login.php" class="hover:text-cyan-300">Login</a>

                    <?php endif; ?>


                </nav>

            </div>


            <!-- MOBILE MENU -->
            <div id="mobileMenu" class="hidden mt-4 flex flex-col gap-3 text-center lg:hidden text-lg">

                <a href="index.php" class="hover:text-cyan-300">Dashboard</a>
                <a href="events.php" class="hover:text-cyan-300">All Events</a>
                <a href="calendar.php" class="hover:text-cyan-300">Calendar View</a>

                <?php if (isset($_SESSION['admin'])): ?>

                    <a href="admin/dashboard.php" class="hover:text-cyan-300">Admin Dashboard</a>

                    <span class="text-cyan-400 font-semibold">
                        <?php echo $_SESSION['admin']; ?>
                    </span>

                    <a href="../logout.php" class="hover:text-red-400">
                        Logout
                    </a>


                <?php elseif (isset($_SESSION['user'])): ?>

                    <span class="text-cyan-400 font-semibold">
                        <?php echo $_SESSION['user']; ?>
                    </span>

                    <a href="logout.php" class="hover:text-red-400">
                        Logout
                    </a>

                <?php else: ?>

                    <a href="login.php" class="hover:text-cyan-300">Login</a>

                <?php endif; ?>

            </div>

        </div>

    </header>