<?php
session_start();
include "db.php";

if (isset($_GET['date'])) {
    $date = $_GET['date'];
}

$duration = 15;
$cleanup = 5;
$start_time = "08:00:00";
$end_time = "17:00:00";

$alreadyBookedTimeSlots = getBookedTimeSlots($date);

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $stud_no = $_POST['stud_no'];
    $level = $_POST['level'];
    $concern = $_POST['concern'];
    $professor = $_POST['professor'];
    $time = $_POST['time'];

    $mysqli = new mysqli('localhost', 'root', "", "chatapp");

    // Insert into consult table
    $stmt = $mysqli->prepare("INSERT INTO consult(name, stud_no, level, concern, professor, date, time) VALUES(?,?,?,?,?,?,?)");
    $stmt->bind_param('sssssss', $name, $stud_no, $level, $concern, $professor, $date, $time);
    $stmt->execute();
    $stmt->close();

    // Fetch available time slots for a professor
    $mysqli = new mysqli('localhost', 'root', "", "chatapp");
    $query = "SELECT start_time, end_time FROM professor_schedule WHERE date = ? AND professor_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ss', $date, $professor);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $start_time = date("h:iA", strtotime($row['start_time']));
        $end_time = date("h:iA", strtotime($row['end_time']));
    }

    $stmt->close();
    $mysqli->close();
}

// Function to fetch available time slots for a professor
$timeslots = getAllProfessorsTimeSlots($duration, $cleanup, $start_time, $end_time, $date);

function getAllProfessorsTimeSlots($duration, $cleanup, $start, $end, $date)
{
    $mysqli = new mysqli('localhost', 'root', "", "chatapp");

    $query = "SELECT professor_id, start_time, end_time FROM professor_schedule WHERE date = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $date);
    $stmt->execute();
    $result = $stmt->get_result();

    $slots = array();

    while ($row = $result->fetch_assoc()) {
        $professor = $row['professor_id'];
        $start_time = date("h:iA", strtotime($row['start_time']));
        $end_time = date("h:iA", strtotime($row['end_time']));
        $slots[$professor][] = $start_time . "-" . $end_time;
    }

    $stmt->close();
    $mysqli->close();

    return $slots;
}

function getBookedTimeSlots($date)
{
    $mysqli = new mysqli('localhost', 'root', "", "chatapp");

    $query = "SELECT professor, time FROM consult WHERE date = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $date);
    $stmt->execute();
    $result = $stmt->get_result();

    $bookedTimeSlots = array();

    while ($row = $result->fetch_assoc()) {
        $professor = $row['professor'];
        $time = $row['time'];
        $bookedTimeSlots[$professor][] = $time;
    }

    $stmt->close();
    $mysqli->close();

    return $bookedTimeSlots;
}
?>

<!doctype html>
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
    <style>
        .book {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            margin: 10px 0;
            cursor: pointer;
        }

        /* Style the modal */


        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .modal-title {
            font-size: 18px;
        }

        /* Style form inputs and labels */
        form label,
        form input,
        form select {
            display: block;
            margin: 10px 0;
            width: 100%;

        }

        /* Style the submit button */
        button[type="submit"] {
            background-color: #337ab7;
            color: white;
            padding: 10px 20px;
            cursor: pointer;
        }

        /* Right-align the submit button */
        .pull-right {
            text-align: right;
        }
    </style>

   <div class="container">
    <h2 class="text-center">
        <?php echo date('m-d-Y', strtotime($date)); ?>
    </h2>
    <div class="row">
        <div class="col-md-12">
            <?php echo isset($msg) ? $msg : ""; ?>
        </div>
        <?php
        foreach ($timeslots as $professor => $professorTimeslots) {
            foreach ($professorTimeslots as $ts) {
                $buttonClass = in_array($ts, $alreadyBookedTimeSlots[$professor] ?? []) ? 'booked' : 'book';
                ?>
                <div class="col-md-2">
                    <div class="form-group">
                        <button class="btn btn-success book <?php echo $buttonClass; ?>" data-timeslot="<?php echo $ts; ?>">
                            <?php echo $ts; ?>
                        </button>
                    </div>
                </div>
            <?php }
        } ?>
    </div>
    <br><br><br>
    <div class="form-group pull-left">
        <a href="schedules.php"><button class=" btn btn-success">BACK
            </button></a>
    </div>
</div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Booking: <span id="slot"></span></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="post">
                                <label for="name">Student Name</label>
                                <input type="text" name="name" id="name" required>

                                <label for="stud_no">Student Number:</label>
                                <input type="text" name="stud_no" id="stud_no" required>

                                <label for="level">Year & Course:</label>
                                <input type="text" name="level" id="level" required>

                                <label for="concern">Area of Concern:</label>
                                <input type="text" name="concern" id="concern">

                                <label for="professor">Professor Name:</label>
                                <select name="professor" id="professor">
                                    <?php
                                    $mysqli = new mysqli("localhost", "root", "", "chatapp");

                                    $query = "SELECT user_id, concat(fname, ' ', lname) as professor_name FROM users WHERE user_type = 'professor'";
                                    $stmt = $mysqli->prepare($query);

                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['user_id'] . '">' . $row['professor_name'] . '</option>';
                                    }

                                    $stmt->close();
                                    ?>
                                </select>


                                <div class="form-group">
                                    <label for=""> Time</label>
                                    <input type="text" name="time" id="time" class="form-control">
                                </div>


                                <div class="form-group pull-right">
                                    <button class="btn btn-primary" type="submit" name="submit">Book Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

        <script>
            $(".book").click(function () {
                var timeslot = $(this).attr('data-timeslot');
                if ($(this).hasClass('booked')) {
                    alert("This time slot is already booked.");
                } else {
                    $("#slot").html(timeslot);
                    $("#time").val(timeslot); // Set the value of the time input field
                    $("#myModal").modal("show");
                }
            });
        </script>


</body>

</html>