<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="border-b border-cyan-400/30 bg-[rgba(10,20,40,0.6)] backdrop-blur-lg">

    <div class="w-full px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <!-- Logo + Title -->

        <div class="flex items-center gap-4">

            <img src="../assets/adbu-logo.png" class="w-auto  h-24 w-24">

            <h1 class="text-xl md:text-2xl font-bold text-cyan-400">
                ADBU Academic Calendar
            </h1>

        </div>


        <!-- Navigation -->

        <nav class="flex flex-wrap items-center gap-6 text-sm md:text-lg">

            <a href="dashboard.php" class="hover:text-cyan-300">
                Dashboard
            </a>

            <a href="../calendar.php" class="hover:text-cyan-300">
                Academic Calendar
            </a>

            <a href="../events.php" class="hover:text-cyan-300">
                All Events
            </a>

        </nav>


        <!-- Admin Info -->

        <div class="flex items-center gap-4 ">

            <span class="text-gray-300 text-sm md:text-xl">

                Admin:
                <span class="text-cyan-300 font-semibold">
                    <?php echo $_SESSION['admin']; ?>
                </span>

            </span>

            <a href="../logout.php"
                class="px-3 py-1 border border-cyan-400 rounded-lg hover:bg-cyan-400 hover:text-black px-4 py-2 rounded-lg">

                Logout

            </a>

        </div>

    </div>

</header>