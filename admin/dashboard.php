<?php
include '../includes/db.php';
include '../includes/auth.php';
include 'header.php';
?>

<?php
// require '../config/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

$totalEvents = $conn->query("SELECT COUNT(*) as total FROM events")->fetch_assoc()['total'];

$upcomingEvents = $conn->query("SELECT COUNT(*) as total FROM events 
                                WHERE start_date >= CURDATE()")->fetch_assoc()['total'];

$categories = $conn->query("SELECT COUNT(DISTINCT category) as total FROM events")
    ->fetch_assoc()['total'];

$recentEvents = $conn->query("SELECT * FROM events ORDER BY start_date DESC LIMIT 5");
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-[radial-gradient(circle_at_top_left,#0a0f1f,#050816_60%)] text-white min-h-screen">

    <div class="container mx-auto px-4 py-8">

        <!-- HEADER -->

        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">

            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-cyan-400">Admin Dashboard</h1>
            </div>

            <div class="mt-4 md:mt-0 flex gap-4">

                <a href="add_event.php"
                    class="bg-gradient-to-r from-blue-500 to-cyan-400 px-4 py-2 rounded-lg">
                    Add Event
                </a>

                

            </div>

        </div>


        <!-- STAT CARDS -->

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">

            <div class="bg-[rgba(20,30,60,0.5)] border border-cyan-400/30 rounded-xl p-6 text-center">
                <p class="text-gray-400 text-xl md:text-2xl">Total Events</p>
                <h2 class="text-3xl font-bold text-cyan-400"><?php echo $totalEvents; ?></h2>
            </div>

            <div class="bg-[rgba(20,30,60,0.5)] border border-cyan-400/30 rounded-xl p-6 text-center">
                <p class="text-gray-400 text-xl md:text-2xl">Upcoming Events</p>
                <h2 class="text-3xl font-bold text-cyan-400"><?php echo $upcomingEvents; ?></h2>
            </div>

            <div class="bg-[rgba(20,30,60,0.5)] border border-cyan-400/30 rounded-xl p-6 text-center">
                <p class="text-gray-400 text-xl md:text-2xl">Categories</p>
                <h2 class="text-3xl font-bold text-cyan-400"><?php echo $categories; ?></h2>
            </div>

            <div class="bg-[rgba(20,30,60,0.5)] border border-cyan-400/30 rounded-xl p-6 text-center">
                <p class="text-gray-400 text-xl md:text-2xl">Admin</p>
                <h2 class="text-xl font-semibold text-cyan-300">
                    <?php echo $_SESSION['admin']; ?>
                </h2>
            </div>

        </div>


        <!-- RECENT EVENTS -->

        <div class="bg-[rgba(20,30,60,0.5)] border border-cyan-400/30 rounded-xl p-6">

            <h2 class="text-xl md:text-2xl font-semibold text-cyan-400 mb-4">
                Recent Events
            </h2>

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="border-b border-cyan-400/30">

                        <tr>
                            <th class="p-3 text-xl md:text-2xl">Event</th>
                            <th class="p-3 text-xl md:text-2xl">Category</th>
                            <th class="p-3 text-xl md:text-2xl">Start Date</th>
                            <th class="p-3 text-xl md:text-2xl">End Date</th>
                            <th class="p-3 text-xl md:text-2xl">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($event = $recentEvents->fetch_assoc()): ?>

                            <tr class="border-b border-white/10 hover:bg-cyan-400/5">

                                <td class="p-3 text-cyan-300 uppercase text-xl md:text-2xl">
                                    <?php echo $event['title']; ?>
                                </td>

                                <td class="p-3 text-xl md:text-2xl">
                                    <?php echo $event['category']; ?>
                                </td>

                                <td class="p-3 text-xl md:text-2xl">
                                    <?php echo $event['start_date']; ?>
                                </td>

                                <td class="p-3 text-xl md:text-2xl">
                                    <?php echo $event['end_date']; ?>
                                </td>

                                <td class="p-3 text-xl md:text-2xl">

                                    <a href="delete_event.php?id=<?php echo $event['id']; ?>"
                                        onclick="return confirm('Are you sure you want to delete this event?')"
                                        class="text-red-400 hover:text-red-300 font-semibold">

                                        Delete

                                    </a>

                                </td>

                            </tr>

                        <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>

<?php include '../includes/footer.php'; ?>