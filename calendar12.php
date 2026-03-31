<?php
include 'includes/db.php';
include 'includes/header.php';

$events = [];

$query = "SELECT start_date FROM events";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $events[] = $row['start_date'];
}
?>

<section class="px-4 py-2  md:px-10 md:py-8">

    <div class="page-header flex justify-between items-center  mb-6">
        <div>
            <h1 class="md:text-3xl font-bold text-cyan-400 uppercase">
                Calendar View
            </h1>
        </div>
        <button onclick="goToday()" class="add-btn">
            Today
        </button>
    </div>

    <div class="calendar-container p-6 w-full p">
        <hr class="mb-6">

        <!-- Month Navigation -->
        <div class="flex justify-between items-center mb-6">
            <button onclick="prevMonth()" class="nav-btn">◀</button>
            <h2 id="monthTitle" class="text-xl text-cyan-300 font-semibold"></h2>
            <button onclick="nextMonth()" class="nav-btn">▶</button>
        </div>

        <!-- Wrapper keeps day names + grid in one aligned block -->
        <div id="cal-wrapper" style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 14px;">

            <!-- Day Name Headers — part of the SAME grid as date cells -->
            <div class="day-name text-xs sm:text-sm text-center pb-2">Sun</div>
            <div class="day-name text-xs sm:text-sm text-center pb-2">Mon</div>
            <div class="day-name text-xs sm:text-sm text-center pb-2">Tue</div>
            <div class="day-name text-xs sm:text-sm text-center pb-2">Wed</div>
            <div class="day-name text-xs sm:text-sm text-center pb-2">Thu</div>
            <div class="day-name text-xs sm:text-sm text-center pb-2">Fri</div>
            <div class="day-name text-xs sm:text-sm text-center pb-2">Sat</div>

            <!-- Calendar date cells injected here by JS -->

        </div>

    </div>

</section>

<style>
    /* Each cell is a perfect square */
    .cal-cell {
        position: relative;
        width: 100%;
        aspect-ratio: 1 / 1;
    }

    /* Inner content layer */
    .cal-cell .cell-inner {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
        padding: 8px 10px;
        border-radius: 0.75rem;
        border: 1px solid transparent;
        background: rgba(15, 25, 45, 0.8);
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .cal-cell:hover .cell-inner {
        border-color: #22d3ee;
        box-shadow: 0 0 8px rgba(0, 255, 255, 0.2);
    }

    /* Day number */
    .day-num {
        font-size: clamp(0.65rem, 1.4vw, 1rem);
        font-weight: 600;
        color: #e5e7eb;
        line-height: 1;
    }

    /* Today highlight */
    .cal-cell.is-today .cell-inner {
        border-color: #22d3ee !important;
        box-shadow: 0 0 14px rgba(0, 255, 255, 0.55);
    }

    /* Event badge */
    .event-badge {
        position: absolute;
        bottom: 6px;
        right: 6px;
        background-color: #22d3ee;
        color: #000;
        font-weight: 700;
        border-radius: 50%;
        width:  clamp(14px, 2vw, 22px);
        height: clamp(14px, 2vw, 22px);
        font-size: clamp(0.5rem, 1vw, 0.7rem);
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<script>
    const events = <?php echo json_encode($events); ?>;
</script>

<script>
    // Target the shared grid wrapper (day names already in it)
    const wrapper    = document.getElementById("cal-wrapper");
    const monthTitle = document.getElementById("monthTitle");

    let currentDate = new Date();

    // Remove only date cells (not the 7 day-name divs)
    function clearDateCells() {
        const cells = wrapper.querySelectorAll(".cal-cell, .empty-cell");
        cells.forEach(c => c.remove());
    }

    function renderCalendar() {
        clearDateCells();

        const year  = currentDate.getFullYear();
        const month = currentDate.getMonth();

        monthTitle.textContent = currentDate.toLocaleString("default", {
            month: "long",
            year: "numeric"
        });

        const firstDay = new Date(year, month, 1).getDay();
        const lastDate = new Date(year, month + 1, 0).getDate();
        const today    = new Date();

        // Empty spacer cells
        for (let i = 0; i < firstDay; i++) {
            const empty = document.createElement("div");
            empty.classList.add("empty-cell");
            wrapper.appendChild(empty);
        }

        // Date cells
        for (let day = 1; day <= lastDate; day++) {

            const date =
                year + "-" +
                String(month + 1).padStart(2, '0') + "-" +
                String(day).padStart(2, '0');

            const count = events.filter(d => d === date).length;

            const box = document.createElement("div");
            box.classList.add("cal-cell");

            const inner = document.createElement("div");
            inner.className = "cell-inner";

            const num = document.createElement("div");
            num.className = "day-num";
            num.textContent = day;
            inner.appendChild(num);

            if (count > 0) {
                const badge = document.createElement("span");
                badge.className = "event-badge";
                badge.textContent = count;
                inner.appendChild(badge);
            }

            if (
                day   === today.getDate()  &&
                month === today.getMonth() &&
                year  === today.getFullYear()
            ) {
                box.classList.add("is-today");
            }

            box.appendChild(inner);
            wrapper.appendChild(box);
        }
    }

    function prevMonth() {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    }

    function nextMonth() {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    }

    function goToday() {
        currentDate = new Date();
        renderCalendar();
    }

    renderCalendar();
</script>

<?php include 'includes/footer.php'; ?>