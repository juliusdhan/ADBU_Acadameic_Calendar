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

<style>
    /* Top gradient line */
    .calendar-line {
        height: 5px;
        width: 100%;
        background: linear-gradient(90deg, #1e90ff, #00e5ff);
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 0 10px #00e5ff, 0 0 20px #1e90ff;
    }

    /* Week boxes */
    .week-box {
        background: linear-gradient(90deg, #1e90ff, #00e5ff);
        border-radius: 10px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: white;
        letter-spacing: 1px;
        box-shadow: 0 0 8px #00e5ff;
    }

    @media (max-width: 640px) {
        .date-box {
            min-height: 62px !important;
            padding: 4px !important;
            border-radius: 6px;
        }

        .date-number {
            font-size: 0.7rem;
        }

        .event-badge {
            font-size: 9px;
            padding: 1px 4px;
            bottom: 3px;
            right: 3px;
        }

        .week-box {
            height: 32px;
            font-size: 0.7rem;
            border-radius: 6px;
        }
    }

    /* Date boxes */
    .date-box {
        background: #0f1a2e;
        border-radius: 10px;
        padding: 10px;
        min-height: 115px;
        border: 1px solid transparent;
        transition: 0.3s;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        position: relative;
    }

    .date-box:hover {
        border: 1px solid #22d3ee;
        transform: translateY(-3px);
        box-shadow: 0 0 10px rgba(34, 211, 238, 0.4);
    }

    .date-number {
        color: #e5e7eb;
        font-weight: 600;
    }

    .event-badge {
        position: absolute;
        bottom: 6px;
        right: 6px;
        background: #22d3ee;
        color: black;
        font-size: 11px;
        padding: 2px 6px;
        border-radius: 20px;
    }

    .today {
        border: 1px solid #22d3ee;
        box-shadow: 0 0 12px rgba(0, 255, 255, 0.6);
    }
</style>


<section class="dashboard px-4 py-2 md:px-10 md:py-8">

    <div class="page-header flex justify-between items-center mb-6">

        <div>
            <h1 class="md:text-3xl font-bold text-cyan-400 uppercase">
                Calendar View
            </h1>
        </div>

        <button onclick="goToday()" class="add-btn">
            Today
        </button>

    </div>


    <div class="calendar-container p-4">

        <div class="calendar-line"></div>


        <!-- Month navigation -->

        <div class="flex justify-between items-center mb-4">

            <button onclick="prevMonth()" class="nav-btn">
                ◀
            </button>

            <h2 id="monthTitle" class="text-xl md:text-3xl text-cyan-300 font-bold"></h2>

            <button onclick="nextMonth()" class="nav-btn">
                ▶
            </button>

        </div>


        <!-- Week header -->

        <div class="grid grid-cols-7 gap-2 mb-2">

            <div class="week-box text-base md:text-xl">Sun</div>
            <div class="week-box text-base md:text-xl">Mon</div>
            <div class="week-box text-base md:text-xl">Tue</div>
            <div class="week-box text-base md:text-xl">Wed</div>
            <div class="week-box text-base md:text-xl">Thu</div>
            <div class="week-box text-base md:text-xl">Fri</div>
            <div class="week-box text-base md:text-xl">Sat</div>

        </div>


        <!-- Calendar grid -->

        <div id="calendar" class="grid grid-cols-7 gap-2 text-base md:text-xl"></div>

    </div>

</section>


<script>
    const events = <?php echo json_encode($events); ?>;
</script>


<script>
    const calendar = document.getElementById("calendar");
    const monthTitle = document.getElementById("monthTitle");

    let currentDate = new Date();


    function renderCalendar() {

        calendar.innerHTML = "";

        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        monthTitle.textContent =
            currentDate.toLocaleString("default", {
                month: "long",
                year: "numeric"
            });

        const firstDay = new Date(year, month, 1).getDay();
        const lastDate = new Date(year, month + 1, 0).getDate();

        const today = new Date();

        for (let i = 0; i < firstDay; i++) {

            let empty = document.createElement("div");
            calendar.appendChild(empty);

        }

        for (let day = 1; day <= lastDate; day++) {

            let date =
                year + "-" +
                String(month + 1).padStart(2, '0') + "-" +
                String(day).padStart(2, '0');

            let count = events.filter(d => d === date).length;

            let box = document.createElement("div");
            box.className = "date-box";

            let num = document.createElement("div");
            num.className = "date-number";
            num.textContent = day;

            box.appendChild(num);

            if (count > 0) {

                let badge = document.createElement("span");
                badge.className = "event-badge";
                badge.textContent = count;

                box.appendChild(badge);

            }

            if (
                day === today.getDate() &&
                month === today.getMonth() &&
                year === today.getFullYear()
            ) {
                box.classList.add("today");
            }

            calendar.appendChild(box);

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