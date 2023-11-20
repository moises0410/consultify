<?php
session_start();
include "db.php";

if (isset($_GET['date'])) {
    $date = $_GET['date'];
}

$alreadyBookedTimeSlots = array(); // Initialize the array


if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $stud_no = $_POST['stud_no'];
    $level = $_POST['level'];
    $concern = $_POST['concern'];
    $professor = $_POST['professor'];
    $time = $_POST['time'];

    $mysqli = new mysqli('localhost', 'root', "", "chatapp");
    $stmt = $mysqli->prepare("INSERT INTO consult(name, stud_no, level, concern, professor, date, time) VALUES(?,?,?,?,?,?,?)");
    $stmt->bind_param('sssssss', $name, $stud_no, $level, $concern, $professor, $date, $time);
    $stmt->execute();
    $stmt->close();


    $query = "SELECT time FROM consult WHERE date = ? AND professor = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ss', $date, $professor);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Adjust this logic to consider available days
    while ($row = $result->fetch_assoc()) {
        // Add booked timeslots to the array.
        $alreadyBookedTimeSlots[] = $row['time'];
    }
    
    $stmt->close();
    $mysqli->close();
}

$duration = 30;
$cleanup = 0;
$start = "13:00";
$end = "15:00";

function timeslots($duration, $cleanup, $start, $end)
{
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT" . $duration . "M");
    $cleanupInterval = new DateInterval("PT" . $cleanup . "M");
    $slots = array();

    for ($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)) {
        $endPeriod = clone $intStart;
        $endPeriod->add($interval);
        if ($endPeriod > $end) {
            break;
        }

        $slots[] = $intStart->format("H:iA") . "-" . $endPeriod->format("H:iA");
    }

    return $slots;
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
            $timeslots = timeslots($duration, $cleanup, $start, $end);
            foreach ($timeslots as $ts) {
                $buttonClass = in_array($ts, $alreadyBookedTimeSlots) ? 'booked' : 'book';
                ?>
                <div class="col-md-2">
                    <div class="form-group">
                        <button class="btn btn-success book <?php echo $buttonClass; ?>" data-timeslot="<?php echo $ts; ?>">
                            <?php echo $ts; ?>
                        </button>

                    </div>
                </div>
            <?php } ?>
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
                    $("#time").val(timeslot);
                    $("#myModal").modal("show");
                }
            });

            // Disable clicking on booked time slots
            $(".booked").click(function () {
                alert("This time slot is already booked.");
                return false; // Prevent the click event from executing
            });
        </script>

</body>

</html>