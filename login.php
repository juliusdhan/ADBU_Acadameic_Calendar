<?php

require 'includes/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $password = md5($_POST['password']);

    /* ---------------- ADMIN LOGIN ---------------- */
    $adminQuery = $conn->query("SELECT * FROM admins 
                                WHERE username='$username' 
                                AND password='$password'");

    if ($adminQuery && $adminQuery->num_rows > 0) {
        $_SESSION['admin'] = $username;
        header("Location: admin/dashboard.php");
        exit();
    }

    /* ---------------- USER LOGIN ---------------- */
    $userQuery = $conn->query("SELECT * FROM users 
                               WHERE email='$username' 
                               AND password='$password'");

    if ($userQuery && $userQuery->num_rows > 0) {
        $user = $userQuery->fetch_assoc();
        $_SESSION['user'] = $user['first_name'];
        $_SESSION['user_email'] = $user['email'];
        header("Location: index.php");
        exit();
    }

    $error = "Invalid username or password";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – ADBU Academic Calendar</title>
    <script>
        tailwind.config = { darkMode: 'class' }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<!--
    Background: fixed full-screen image with dark overlay
    The login card floats on top with backdrop-blur for the frosted glass effect
-->
<body class="min-h-screen text-white relative overflow-hidden">

    <!-- ── Background image layer ── -->
    <div class="fixed inset-0 z-0">
        <!-- Replace the URL below with your own image, e.g. assets/campus.jpg -->
        <img
            src="assets/adbu-slider.webp"
            alt="background"
            class="w-full h-full object-cover"
        />
        <!-- Dark overlay so text stays readable -->
        <div class="absolute inset-0 bg-[#050816]/70"></div>
    </div>

    <!-- ── Floating card: centered on screen ── -->
    <div class="relative z-10 min-h-screen flex items-center justify-center px-4 py-10">

        <!--
            Mobile  : full width, normal padding
            Desktop : much wider (max-w-4xl), two-column layout
        -->
        <div class="w-full max-w-sm md:max-w-7xl bg-white/5 border border-cyan-400/20 rounded-2xl backdrop-blur-xl shadow-2xl overflow-hidden">

            <div class="flex flex-col md:flex-row">

                <!-- ── LEFT PANEL (branding) ── -->
                <div class="flex flex-col items-center justify-center text-center p-2 md:p-14 md:w-1/2 border-b md:border-b-0 md:border-r border-cyan-400/20">

                    <img src="assets/adbu-logo.png" alt="ADBU Logo"
                         class="w-24 md:w-36 mb-6 bg-white rounded-full p-1">

                    <h1 class="text-xl md:text-3xl font-bold text-cyan-400 uppercase leading-tight mb-3">
                        ADBU Academic Calendar Portal
                    </h1>

                    <!-- Gradient divider -->
                    <div class="w-12 h-[3px] rounded-full my-4"
                         style="background: linear-gradient(90deg, #007cf0, #00dfd8);"></div>

                    <p class="text-gray-400 text-sm md:text-lg max-w-xs">
                        Welcome to the academic calendar management system of
                        Assam Don Bosco University.
                    </p>

                </div>

                <!-- ── RIGHT PANEL (form) ── -->
                <div class="flex items-center justify-center p-2 md:p-24 md:w-1/2">

                    <div class="w-full">

                        <h2 class="text-2xl md:text-3xl font-semibold text-cyan-400 mb-4 text-center">
                            Sign In
                        </h2>

                        <!-- Error message -->
                        <?php if (!empty($error)): ?>
                            <div class="bg-red-500/20 text-red-300 px-4 py-3 rounded-lg mb-6 text-sm text-center border border-red-500/30">
                                <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" class="space-y-6">

                            <!-- Username -->
                            <div>
                                <label class="block text-sm md:text-base mb-2 text-gray-300">
                                    Username / Email
                                </label>
                                <input
                                    type="text"
                                    name="username"
                                    required
                                    placeholder="Enter your username"
                                    class="w-full px-4 py-3 md:py-4 md:text-lg bg-black/30 border border-cyan-400/20 rounded-xl focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 text-white placeholder-gray-500 transition-all">
                            </div>

                            <!-- Password -->
                            <div>
                                <label class="block text-sm md:text-base mb-2 text-gray-300">
                                    Password
                                </label>
                                <input
                                    type="password"
                                    name="password"
                                    required
                                    placeholder="Enter your password"
                                    class="w-full px-4 py-3 md:py-4 md:text-lg bg-black/30 border border-cyan-400/20 rounded-xl focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 text-white placeholder-gray-500 transition-all">
                            </div>

                            <!-- Submit -->
                            <button
                                type="submit"
                                class="w-full py-3 md:py-4 md:text-lg font-semibold rounded-xl bg-gradient-to-r from-blue-500 to-cyan-400 hover:opacity-90 hover:shadow-lg hover:shadow-cyan-500/30 transition-all duration-200">
                                Login
                            </button>

                            <!-- Register link -->
                            <p class="text-sm md:text-base text-gray-400 text-center pt-2">
                                Don't have an account?
                                <a href="register.php" class="text-cyan-400 hover:underline font-medium">
                                    Register here
                                </a>
                            </p>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>