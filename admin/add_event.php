<?php

require '../includes/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $category = $_POST['category'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $description = $_POST['description'];

    $query = "INSERT INTO events (title, category, start_date, end_date, description)
VALUES ('$title','$category','$start_date','$end_date','$description')";

    if ($conn->query($query)) {
        $message = "Event added successfully!";
    } else {
        $message = "Error adding event.";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Event</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-[radial-gradient(circle_at_top_left,#0a0f1f,#050816_60%)] text-white min-h-screen">

    <?php include 'header.php'; ?>


    <div class="max-w-4xl mx-auto px-4 py-10">

        <div class="bg-[rgba(20,30,60,0.5)] border border-cyan-400/30 rounded-xl p-8">

            <h2 class="text-2xl font-bold text-cyan-400 mb-6 text-2xl md:text-3xl">
                Add New Event
            </h2>


            <?php if (!empty($message)): ?>

                <div class="bg-green-500/20 text-green-300 p-3 rounded mb-6 text-xl md:text-2xl">
                    <?php echo $message; ?>
                </div>

            <?php endif; ?>


            <form method="POST" class="space-y-6">


                <!-- Event Title -->

                <div>

                    <label class="block text-xl md:text-2xl mb-1 text-gray-300">
                        Event Title
                    </label>

                    <input type="text" name="title" required
                        class="w-full px-4 py-2 bg-black/30 border border-cyan-400/20 rounded-lg focus:outline-none focus:border-cyan-400">

                </div>


                <!-- Category -->

                <div>

                    <label class="block text-xl md:text-2xl mb-1 text-gray-300">
                        Category
                    </label>

                    <select name="category" required
                        class="w-full px-4 py-2 bg-black/30 border border-cyan-400/20 rounded-lg focus:outline-none focus:border-cyan-400">

                        <option value="">Select Category</option>
                        <option value="Semester">Semester</option>
                        <option value="Exam">Exam</option>
                        <option value="Holiday">Holiday</option>
                        <option value="Registration">Registration</option>
                        <option value="Deadline">Deadline</option>
                        <option value="Other">Other</option>

                    </select>

                </div>


                <!-- Date Row -->

                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <label class="block text-sm mb-1 text-gray-300 text-xl md:text-2xl">
                            Start Date
                        </label>

                        <input type="date" name="start_date" required
                            class="w-full px-4 py-2 bg-black/30 border border-cyan-400/20 rounded-lg">

                    </div>


                    <div>

                        <label class="block text-sm mb-1 text-gray-300 text-xl md:text-2xl">
                            End Date
                        </label>

                        <input type="date" name="end_date" required
                            class="w-full px-4 py-2 bg-black/30 border border-cyan-400/20 rounded-lg">

                    </div>

                </div>


                <!-- Description -->

                <div>

                    <label class="block text-sm mb-1 text-gray-300 text-xl md:text-2xl">
                        Description
                    </label>

                    <textarea name="description" rows="4"
                        class="w-full px-4 py-2 bg-black/30 border border-cyan-400/20 rounded-lg focus:outline-none focus:border-cyan-400"></textarea>

                </div>


                <!-- Buttons -->

                <div class="flex flex-col md:flex-row gap-4">

                    <button type="submit"
                        class="bg-gradient-to-r from-blue-500 to-cyan-400 px-6 py-2 rounded-lg">

                        Add Event

                    </button>


                    <a href="dashboard.php"
                        class="border border-cyan-400 px-6 py-2 rounded-lg text-center">

                        Cancel

                    </a>

                </div>


            </form>

        </div>

    </div>

</body>

</html>

<?php include '../includes/footer.php'; ?>