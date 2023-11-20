<?php
session_start();

$default_professor_id = 68;
$professor_id = isset($_GET['professor_id']) ? $_GET['professor_id'] : $default_professor_id;
$professor_name = get_prof_name($professor_id);
function get_prof_name($professor_id)
{
    $mysqli = new mysqli("localhost", "root", "", "chatapp");

    $query = "SELECT concat(fname,' ',lname) as professor_name FROM users WHERE user_type = 'professor' and user_id=? LIMIT 1";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $professor_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        extract($row);
        $faculty_name = "{$professor_name}";
    }
    $stmt->close();
    return $faculty_name;

}

function build_calendar($month, $year, $professor_id)
{

    $professor_name = get_prof_name($professor_id);
    $mysqli = new mysqli("localhost", "root", "", "chatapp");
    $stmt = $mysqli->prepare('select * from consult where professor = ? AND MONTH(date) =? AND YEAR(date) =?');
    $stmt->bind_param('sss', $professor_id, $month, $year);
    $appointment = array();
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $appointment[] = $row['date'];
            }
            $stmt->close();
        }
    }
    $availableDays = get_available_days_from_database($professor_id);
    $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    $numberDays = date('t', $firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);
    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday'];
    $dateToday = date("Y-m-d");

    $prev_month = date('m', mktime(0, 0, 0, $month - 1, 1, $year));
    $prev_year = date('Y', mktime(0, 0, 0, $month - 1, 1, $year));
    $next_month = date('m', mktime(0, 0, 0, $month + 1, 1, $year));
    $next_year = date('Y', mktime(0, 0, 0, $month + 1, 1, $year));
    $calendar = "<center><h3>$monthName $year</h3></center>";
    $calendar .= "&nbsp; <a class='btn btn-primary btn-xs' href='?month=" . $prev_month . "&year=" . $prev_year . "'> < </a>
    &nbsp; ";
    $calendar .= "<a class='btn btn-primary btn-xs' href='?month=" . date('m') . "&year=" . date('Y') . "'>PRESENT</a> &nbsp; ";
    $calendar .= "<a class='btn btn-primary btn-xs'href='?month=" . $next_month . "&year=" . $next_year . "'> > </a><br>";
    $calendar .= "<br><table class='table table-bordered'>";
    $calendar .= "<tr>";
    foreach ($daysOfWeek as $day) {
        $calendar .= "<th class='header'>$day</th>";
    }

    $calendar .= "</tr><tr>";
    $currentDay = 1;
    if ($daysOfWeek > 0) {
        for ($k = 0; $k < $dayOfWeek; $k++) {
            $calendar .= "<td class='empty'></td>";
        }
    }
   
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
    while ($currentDay <= $numberDays) {
        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }
    
        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";
        $dayname = strtolower(date('l', strtotime($date)));
        $eventNum = 0;
        $today = $date == date('Y-m-d') ? "today" : "";

            if (in_array($dayname, $availableDays)) {
                $calendar .= "<td><h4>$currentDay</h4> <p></p>";
            } elseif ($date < date('Y-m-d')) {
                $calendar .= "<td><h4>$currentDay</h4> ";
            } else {

            $totalbookings = checkSlots($mysqli, $date, $professor_id);
            if ($totalbookings == 4) {
                $calendar .= "<td class='$today'><h4>$currentDay</h4> <a href='#' class='btn btn-danger btn-xs'>Fully Booked</a>";
            } else {
                $availableslots = 4 - $totalbookings;
                $calendar .= "<td class='$today'><h4>$currentDay</h4> <a href='timeslots.php?prof_id=" . $professor_id . "&date=" . $date . "' class='btn btn-success btn-xs'>Book</a>
            <br><small><i>$availableslots slots available</i></small>";
            }
        }
    
        $currentDay++;
        $dayOfWeek++;
    }

    if ($dayOfWeek < 7) {
        $remainingDays = 7 - $dayOfWeek;
        for ($i = 0; $i < $remainingDays; $i++) {
            $calendar .= "<td class='empty'></td>";
        }
    }

    $calendar .= "</tr></table>";

    echo $calendar;

}

function get_available_days_from_database($professor_id)
{
    $mysqli = new mysqli("localhost", "root", "", "chatapp");

    $query = "SELECT booking_day FROM professor_availability WHERE professor_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $professor_id);
    $stmt->execute();

    $result = $stmt->get_result();

    $availableDays = array();
    while ($row = $result->fetch_assoc()) {
        $availableDays[] = strtolower($row['booking_day']);
    }

    $stmt->close();
    $mysqli->close();

    return $availableDays;
}
function checkSlots($mysqli, $date, $professor_id)
{
    $stmt = $mysqli->prepare("SELECT * FROM consult WHERE professor = ? AND date = ?");
    $stmt->bind_param('ss', $professor_id, $date);
    $totalbookings = 0;
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $totalbookings++;
            }
            $stmt->close();
        }
    }
    return $totalbookings;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Georgia', sans-serif;
            margin: 0;
            padding: 4px;
            scroll-padding-top: 1rem;
            scroll-behavior: smooth;
            list-style: none;
            text-decoration: none;
            box-sizing: border-box;
        }

        form {
            top: 50%;
            /* Center vertically */
            left: 50%;
            /* Center horizontally */
            transform: translate(10%, -5%);
            /* Centering with translate */
            width: 800px;
            border: 0px;
            padding: 5px;
            background: white;
            border-radius: 10px;

        }

        body {
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        label {
            color: #050404;
            font-size: 10px;
            padding: 10px;
        }

        h1 {
            text-align: center;
            margin-bottom: 50px;
        }

        h2 {
            text-align: center;
            margin-bottom: 70px;
        }

        h4 {
            text-align: center;
            font-size: 15px;
            font-weight: 100;
        }

        input {
            display: inline;
            border: 2px solid #ccc;
            height: 5%;
            width: 100%;
            padding: 10px;
            margin: 10px auto;
            border-radius: 5px;
        }


        button:hover {
            opacity: .7;
        }

        .ca {
            font-size: 14px;
            display: inline-block;
            padding: 10px;
            text-decoration: none;
            color: #444;
        }

        .ca:hover {
            text-decoration: underline;
        }

        /*Variables */
        :root {
            --main-color: red;
            --text-color: black;
            --bg-color: white;
        }

        section {
            padding: 4rem 0 2rem;
        }

        img {
            width: 100%;
        }

        body {
            color: var(--text-color);
        }

        .container {
            max-width: 1268px;
            margin-left: auto;
            margin-right: auto;
        }

        header {
            display: block;
            border-bottom: 2px solid #ff0000;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 100;
        }

        .scrolling-header {
            transition: all .5s ease !important;
        }

        .btn {
            text-align: center;
            font-weight: 400;
        }

        .btn:hover {
            background: black;
        }

        @media(max-width: 700px) {
            .home-text h1 {
                font-size: 20px;
            }
        }

        h3 {
            text-align: center;
            font-weight: 600;
            margin: 0px 0;
        }

        .fa-heart-o {
            color: #f44336;
        }

        @media only screen and (max-width: 760px),
        (min-device-width: 802px) and (max-device-width: 1020px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;

            }



            .empty {
                display: none;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            th {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #ccc;
            }

            td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
            }

            /*
        Label the data
        */
            td:nth-of-type(1):before {
                content: "Sunday";
            }

            td:nth-of-type(2):before {
                content: "Monday";
            }

            td:nth-of-type(3):before {
                content: "Tuesday";
            }

            td:nth-of-type(4):before {
                content: "Wednesday";
            }

            td:nth-of-type(5):before {
                content: "Thursday";
            }

            td:nth-of-type(6):before {
                content: "Friday";
            }

            td:nth-of-type(7):before {
                content: "Saturday";
            }


        }

        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
            body {
                padding: 0;
                margin: 0;
            }
        }

        @media only screen and (min-device-width: 802px) and (max-device-width: 1020px) {
            body {
                width: 495px;
            }
        }

        @media (min-width:641px) {
            table {
                table-layout: fixed;
            }

            td {
                width: 33%;
            }
        }

        .row {
            margin-top: 20px;
        }

        .today {
            background: lightblue;
        }

        .btn-booked {
            background: rgb(62, 146, 248);
            font-size: 12px;
        }

        .btn-close {
            color: #eee;
            background: rgb(0, 0, 0);
            font-size: 12px;
        }
    </style>

</head>

<body>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            list-style: none;
            text-decoration: none;
        }

        body {
            background-color: #f3f5f9;
        }

        .wrapper {
            display: flex;
            position: relative;
        }


        .wrapper .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 200px;
            height: 100%;
            background: #2c3e50;
            padding: 10px 0px;
        }

        .wrapper .sidebar h1 {
            color: #fff;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 30px;
        }

        .wrapper .sidebar ul li {
            padding: 15px;
            border-bottom: 1px solid #bdb8d7;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .wrapper .sidebar ul li a {
            color: #fff;
            display: block;
            font-size: 15px;
        }

        .wrapper .sidebar ul li a .fas {
            width: 25px;
        }

        .wrapper .sidebar ul li:hover {
            background-color: #594f8d;
        }

        .wrapper .sidebar ul li:hover a {
            color: #fff;
        }

        .prof {
            color: white;
        }

        .sched {
            font-family: "Verdana", sans-serif;
            font-weight: bold;
            color: black;
            transform: translate(13%, 10%);
        }
    </style>
    <h2 class="sched">SCHEDULE YOUR CONSULTATION NOW FOR <br />
        <?php echo $professor_name; ?>
    </h2>
    <div class="wrapper">
        <div class="sidebar">
            <h4 class="prof">Choose a Professor</h4>
            <ul>
                <?php
                $mysqli = new mysqli("localhost", "root", "", "chatapp");

                $query = "SELECT user_id, concat(fname,' ',lname) as professor_name FROM users WHERE user_type = 'professor'";
                $stmt = $mysqli->prepare($query);

                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    extract($row);
                    echo "<li><a href='schedules.php?professor_id={$user_id}'><i class='fas fa-user'></i>$professor_name</a></li>";
                }
                $stmt->close();
                ?>

            </ul>
        </div>

        <form action="" method="post">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error">
                    <?php echo $_GET['error']; ?>
                </p>
            <?php } ?>
            <br>
            <?php if (isset($_GET['success'])) { ?>
                <p class="success">
                    <?php echo $_GET['success']; ?>
                </p>
            <?php } ?>
            <div class="table">
                <div class="order">
                    <table>
                        <?php
                        $dateComponents = getDate();
                        if (isset($_GET['month']) && isset($_GET['year'])) {
                            $month = $_GET['month'];
                            $year = $_GET['year'];
                        } else {
                            $month = $dateComponents['mon'];
                            $year = $dateComponents['year'];
                        }
                        echo build_calendar($month, $year, $professor_id);
                        ?>
                    </table>
                </div>
            </div>

        </form>

</body>

</html>