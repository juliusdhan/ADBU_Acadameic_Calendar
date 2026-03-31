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


<section class=" dashboard px-4 py-2 md:px-10 md:py-8">

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
        <hr class="h-6">

        <!-- Month Navigation -->

        <div class="flex justify-between items-center mb-4">

            <button onclick="prevMonth()" class="nav-btn">
                ◀
            </button>

            <h2 id="monthTitle" class="text-xl text-cyan-300 font-semibold"></h2>

            <button onclick="nextMonth()" class="nav-btn">
                ▶
            </button>

        </div>


        <!-- Day Names -->

        <div class="grid grid-cols-7 text-center mb-2">

            <div class="day-name text-xs sm:text-sm">Sun</div>
            <div class="day-name text-xs sm:text-sm">Mon</div>
            <div class="day-name text-xs sm:text-sm">Tue</div>
            <div class="day-name text-xs sm:text-sm">Wed</div>
            <div class="day-name text-xs sm:text-sm">Thu</div>
            <div class="day-name text-xs sm:text-sm">Fri</div>
            <div class="day-name text-xs sm:text-sm">Sat</div>

        </div>


        <!-- Calendar Grid -->

        <div id="calendar" class="grid grid-cols-7 gap-2"></div>

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

            box.className =
                "relative flex flex-col items-center justify-start rounded-xl p-2 min-h-[70px] sm:min-h-[95px] bg-[rgba(15,25,45,0.8)] border border-transparent hover:border-cyan-400 transition";


            let num = document.createElement("div");
            num.className = "text-sm sm:text-base font-semibold text-gray-200";
            num.textContent = day;

            box.appendChild(num);


            if (count > 0) {

                let badge = document.createElement("span");

                badge.className =
                    "absolute bottom-1 right-1 bg-cyan-400 text-black text-xs px-2 py-[2px] rounded-full";

                badge.textContent = count;

                box.appendChild(badge);

            }


            if (
                day === today.getDate() &&
                month === today.getMonth() &&
                year === today.getFullYear()
            ) {

                box.classList.add(
                    "border-cyan-400",
                    "shadow-[0_0_12px_rgba(0,255,255,0.6)]"
                );

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