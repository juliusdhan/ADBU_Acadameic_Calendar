<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<?php
$query = "SELECT * FROM events ORDER BY start_date ASC";
$result = $conn->query($query);
?>

<div class="w-full px-4 py-2 md:px-10 md:py-8">

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-cyan-400 uppercase">
                All Events
            </h1>


        </div>

        <?php if (isset($_SESSION['admin'])): ?>
            <a href="admin/add_event.php" class="add-btn">
                + Add Event
            </a>
        <?php endif; ?>

    </div>


    <!-- Events Table -->
    <div class="overflow-x-auto card">

        <table class="w-full text-left">

            <thead class="border-b border-cyan-400/30 text-cyan-300 hidden md:table-header-group">
                <tr>
                    <th class="p-4 text-xl md:text-2xl">EVENT</th>
                    <th class="p-4 text-xl md:text-2xl">CATEGORY</th>
                    <th class="p-4 text-xl md:text-2xl">START DATE</th>
                    <th class="p-4 text-xl md:text-2xl">END DATE</th>
                    <th class="p-4 text-xl md:text-2xl">DESCRIPTION</th>

                    <?php if (isset($_SESSION['admin'])): ?>
                        <th class="p-4 text-center text-xl md:text-2xl">ACTION</th>
                    <?php endif; ?>
                </tr>
            </thead>


            <tbody>

                <?php while ($event = $result->fetch_assoc()): ?>

                    <tr class="border-b border-white/10 hover:bg-cyan-400/5">

                        <!-- Desktop Event -->
                        <td class="p-4 font-semibold text-cyan-300 uppercase hidden md:table-cell text-lg md:text-xl">
                            <?php echo htmlspecialchars($event['title']); ?>
                        </td>

                        <!-- Desktop Category -->
                        <td class="p-4 hidden md:table-cell ">
                            <span class="px-3 py-1 text-xs rounded-full bg-gradient-to-r from-blue-500 to-cyan-400 text-white text-lg md:text-xl">
                                <?php echo htmlspecialchars($event['category']); ?>
                            </span>
                        </td>

                        <!-- Desktop Start -->
                        <td class="p-4 text-white hidden md:table-cell text-lg md:text-xl">
                            <?php echo date("M d, Y", strtotime($event['start_date'])); ?>
                        </td>

                        <!-- Desktop End -->
                        <td class="p-4 text-white hidden md:table-cell text-lg md:text-xl">
                            <?php echo date("M d, Y", strtotime($event['end_date'])); ?>
                        </td>

                        <!-- Desktop Description -->
                        <td class="p-4 text-white hidden md:table-cell text-lg md:text-xl">
                            <?php echo htmlspecialchars($event['description']); ?>
                        </td>


                        <!-- Mobile Layout -->
                        <td class="p-4 md:hidden">

                            <div class="space-y-2">

                                <div class="flex justify-between items-center">

                                    <div class="text-cyan-300 font-semibold uppercase text-lg md:text-xl">
                                        <?php echo htmlspecialchars($event['title']); ?>
                                    </div>

                                    <span class="px-3 py-1 text-xs rounded-full bg-gradient-to-r from-blue-500 to-cyan-400 text-white text-lg md:text-xl">
                                        <?php echo htmlspecialchars($event['category']); ?>
                                    </span>

                                </div>

                                <div class="text-sm text-white text-lg md:text-xl">
                                    <?php echo date("M d, Y", strtotime($event['start_date'])); ?>
                                    <span class="mx-1">→</span>
                                    <?php echo date("M d, Y", strtotime($event['end_date'])); ?>
                                </div>

                                <div class="text-sm text-white text-lg md:text-xl">
                                    <?php echo htmlspecialchars($event['description']); ?>
                                </div>

                            </div>

                        </td>

                    </tr>

                <?php endwhile; ?>

            </tbody>

        </table>

    </div>

</div>

<?php include 'includes/footer.php'; ?>