<?php
require_once 'includes/auth.php'; 
include 'includes/db.php';
include 'includes/header.php';
include 'includes/theme.php';

$totalQuery = $conn->query("SELECT COUNT(*) AS total FROM events");
$total = $totalQuery->fetch_assoc()['total'];

$currentQuery = $conn->query("
    SELECT * FROM events 
    WHERE CURDATE() BETWEEN start_date AND end_date
");

$upcomingQuery = $conn->query("
    SELECT * FROM events 
    WHERE start_date > CURDATE() 
    ORDER BY start_date ASC 
    LIMIT 5
");

$categoryQuery = $conn->query("SELECT COUNT(DISTINCT category) AS total_cat FROM events");
$totalCategories = $categoryQuery->fetch_assoc()['total_cat'];
?>

<section class="dashboard md:mx-10">

    <div class="page-header mb-6">
        <h1 class="text-2xl md:text-4xl md:font-bold">Dashboard</h1>
        <p class="subtitle text-base md:text-2xl">Overview of your academic calendar</p>
    </div>

    <!-- Stats -->
    <div class="cards items-center justify-between mx-auto">

        <div class="card stat-card">
            <div class="stat-content">
                <h3 class="text-base md:pl-4 md:text-2xl font-semibold">Events this Month</h3>
                <p class="number  md:pl-4"><?php echo $total; ?></p>
            </div>
        </div>

        <div class="card stat-card">
            <div class="stat-content">
                <h3 class="md:text-2xl font-semibold  md:pl-4">Today's Events</h3>
                <p class="number  md:pl-4"><?php echo $currentQuery->num_rows; ?></p>
            </div>
        </div>

        <div class="card stat-card">
            <div class="stat-content">
                <h3 class="text-base md:text-2xl font-semibold  md:pl-4">Upcoming Events</h3>
                <p class="number  md:pl-4"><?php echo $upcomingQuery->num_rows; ?></p>
            </div>
        </div>

    </div>

    <!-- Today's Events -->
    <div class="section mt-8">

        <div class="flex justify-between items-center ml-4 mt-2 mb-4">
            <h2 class="text-xl md:text-3xl font-semibold text-cyan-400">Today's Events</h2>
            <a href="events.php" class="text-sm md:text-xl text-cyan-300 hover:text-cyan-200">View All →</a>
        </div>

        <?php if ($currentQuery->num_rows > 0): ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <?php while ($event = $currentQuery->fetch_assoc()): ?>

                    <div class="event-card border border-cyan-400/30 rounded-xl p-4 hover:shadow-lg transition">

                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-base md:text-2xl font-semibold text-cyan-300 uppercase tracking-wide">
                                <?php echo htmlspecialchars($event['title']); ?>
                            </h3>
                            <span class="text-base md:text-2xl px-3 py-1 rounded-full bg-gradient-to-r from-blue-500 to-cyan-400 text-white">
                                <?php echo htmlspecialchars($event['category']); ?>
                            </span>
                        </div>

                        <p class="event-desc text-lg mb-2">
                            <?php echo htmlspecialchars($event['description']); ?>
                        </p>

                        <div class="event-date text-lg">
                            <?php echo date("M d, Y", strtotime($event['start_date'])); ?>
                            -
                            <?php echo date("M d, Y", strtotime($event['end_date'])); ?>
                        </div>

                    </div>

                <?php endwhile; ?>

            </div>

        <?php else: ?>
            <p class="text-gray-400 ml-4">No events available Today.</p>
        <?php endif; ?>

    </div>

    <!-- Upcoming Events -->
    <div class="section mt-8">

        <div class="flex justify-between items-center ml-4 mt-2 mb-4">
            <h2 class="text-xl md:text-3xl font-semibold text-cyan-400">Upcoming Events</h2>
            <a href="events.php" class="text-sm md:text-xl text-cyan-300 hover:text-cyan-200">View All →</a>
        </div>

        <?php if ($upcomingQuery->num_rows > 0): ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <?php while ($event = $upcomingQuery->fetch_assoc()): ?>

                    <div class="event-card border border-cyan-400/30 rounded-xl p-4 hover:shadow-lg transition">

                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-semibold text-cyan-300 uppercase tracking-wide">
                                <?php echo htmlspecialchars($event['title']); ?>
                            </h3>
                            <span class="text-lg px-3 py-1 rounded-full bg-gradient-to-r from-blue-500 to-cyan-400 text-white">
                                <?php echo htmlspecialchars($event['category']); ?>
                            </span>
                        </div>

                        <p class="event-desc text-lg mb-2">
                            <?php echo htmlspecialchars($event['description']); ?>
                        </p>

                        <div class="event-date text-lg">
                            <?php echo date("M d, Y", strtotime($event['start_date'])); ?>
                            -
                            <?php echo date("M d, Y", strtotime($event['end_date'])); ?>
                        </div>

                    </div>

                <?php endwhile; ?>

            </div>

        <?php else: ?>
            <p class="text-gray-400 ml-4">No upcoming events available.</p>
        <?php endif; ?>

    </div>

</section>

<?php include 'includes/footer.php'; ?>