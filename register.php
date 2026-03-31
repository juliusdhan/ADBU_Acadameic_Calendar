<?php

require 'includes/db.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name  = $_POST['first_name'];
    $last_name   = $_POST['last_name'];
    $email       = $_POST['email'];
    $department  = $_POST['department'];
    $student_id  = $_POST['student_id'];
    $password    = md5($_POST['password']);

    $query = "INSERT INTO users (first_name, last_name, email, department, student_id, password)
              VALUES ('$first_name', '$last_name', '$email', '$department', '$student_id', '$password')";

    if ($conn->query($query)) {
        $success = "Registration successful. You can now login.";
    } else {
        $error = "Registration failed. Try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register – ADBU Academic Calendar</title>
    <script>
        tailwind.config = { darkMode: 'class' }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen text-white relative">

    <!-- ── Background image layer ── -->
    <div class="fixed inset-0 z-0 overflow-hidden">
        <!-- Replace URL with your own image e.g. assets/campus.jpg -->
        <img
            src="assets/adbu-slider.webp"
            alt="background"
            class="w-full h-full object-cover"
        />
        <!-- Dark overlay -->
        <div class="absolute inset-0 bg-[#050816]/70"></div>
    </div>

    <!-- ── Floating card ── -->
    <div class="relative z-10 min-h-screen flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-sm md:max-w-7xl bg-white/5 border border-cyan-400/20 rounded-2xl backdrop-blur-xl shadow-2xl overflow-hidden">

            <div class="flex flex-col md:flex-row">

                <!-- ── LEFT PANEL (branding) ── -->
                <div class="flex flex-col items-center justify-center text-center p-4 md:p-24 md:w-1/2 border-b md:border-b-0 md:border-r border-cyan-400/20">

                    <img src="assets/adbu-logo.png" alt="ADBU Logo"
                         class="w-24 md:w-36 mb-6 bg-white rounded-full p-1">

                    <h1 class="text-xl md:text-3xl font-bold text-cyan-400 uppercase leading-tight mb-3">
                        ADBU Academic Calendar Portal
                    </h1>

                    <!-- Gradient divider -->
                    <div class="w-12 h-[3px] rounded-full my-4"
                         style="background: linear-gradient(90deg, #007cf0, #00dfd8);"></div>

                    <p class="text-gray-400 text-sm md:text-lg max-w-xs">
                        Create your account to access the academic calendar system of
                        Assam Don Bosco University.
                    </p>

                </div>

                <!-- ── RIGHT PANEL (form) ── -->
                <div class="flex items-center justify-center p-4 md:p-24 md:w-1/2">

                    <div class="w-full">

                        <h2 class="text-2xl md:text-3xl font-semibold text-cyan-400 mb-8 text-center">
                            Student Registration
                        </h2>

                        <!-- Error message -->
                        <?php if (!empty($error)): ?>
                            <div class="bg-red-500/20 text-red-300 px-4 py-3 rounded-lg mb-6 text-sm text-center border border-red-500/30">
                                <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Success message -->
                        <?php if (!empty($success)): ?>
                            <div class="bg-green-500/20 text-green-300 px-4 py-3 rounded-lg mb-6 text-sm text-center border border-green-500/30">
                                <?php echo htmlspecialchars($success); ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" class="space-y-5">

                            <!-- First + Last Name -->
                            <div class="grid grid-cols-2 gap-4">
                                <input
                                    type="text"
                                    name="first_name"
                                    placeholder="First Name"
                                    required
                                    class="w-full px-4 py-3 md:py-4 md:text-lg bg-black/30 border border-cyan-400/20 rounded-xl focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 text-white placeholder-gray-500 transition-all">

                                <input
                                    type="text"
                                    name="last_name"
                                    placeholder="Last Name"
                                    required
                                    class="w-full px-4 py-3 md:py-4 md:text-lg bg-black/30 border border-cyan-400/20 rounded-xl focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 text-white placeholder-gray-500 transition-all">
                            </div>

                            <!-- Email -->
                            <input
                                type="email"
                                name="email"
                                placeholder="Email ID"
                                required
                                class="w-full px-4 py-3 md:py-4 md:text-lg bg-black/30 border border-cyan-400/20 rounded-xl focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 text-white placeholder-gray-500 transition-all">

                            <!-- Department -->
                            <input
                                type="text"
                                name="department"
                                placeholder="Department"
                                required
                                class="w-full px-4 py-3 md:py-4 md:text-lg bg-black/30 border border-cyan-400/20 rounded-xl focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 text-white placeholder-gray-500 transition-all">

                            <!-- Student ID -->
                            <input
                                type="text"
                                name="student_id"
                                placeholder="Student ID"
                                required
                                class="w-full px-4 py-3 md:py-4 md:text-lg bg-black/30 border border-cyan-400/20 rounded-xl focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 text-white placeholder-gray-500 transition-all">

                            <!-- Password -->
                            <input
                                type="password"
                                name="password"
                                placeholder="Password"
                                required
                                class="w-full px-4 py-3 md:py-4 md:text-lg bg-black/30 border border-cyan-400/20 rounded-xl focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 text-white placeholder-gray-500 transition-all">

                            <!-- Submit -->
                            <button
                                type="submit"
                                class="w-full py-3 md:py-4 md:text-lg font-semibold rounded-xl bg-gradient-to-r from-blue-500 to-cyan-400 hover:opacity-90 hover:shadow-lg hover:shadow-cyan-500/30 transition-all duration-200">
                                Register
                            </button>

                            <!-- Login link -->
                            <p class="text-sm md:text-base text-gray-400 text-center pt-2">
                                Already have an account?
                                <a href="login.php" class="text-cyan-400 hover:underline font-medium">
                                    Login
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