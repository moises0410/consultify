<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  header('location:login.php');
}
;

if (isset($_GET['logout'])) {
  unset($user_id);
  session_destroy();
  header('location:login.php');
}


?>
<?php
$select = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('query failed');
if (mysqli_num_rows($select) > 0) {
  $fetch = mysqli_fetch_assoc($select);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link rel="stylesheet" href="css/sched.css">

</head>
<body>
<div class="head">

    <div class="background">
        <div class="booking-form">
            <h2>Schedule your Consultation</h2>
            <form action="db.php" method="post">
                <label for="name">Student Name:</label>
                <input type="text" name="name" id="name" required>

                <label for="stud_no">Student Number:</label>
                <input type="text" name="stud_no" id="stud_no" required>

                <label for="level">Year & Course:</label>
                <input type="text" name="level" id="level" required>

                <label for="concern">Area of Concern:</label>
                <input type="text" name="concern" id="concern">

                <label for="professor">Professor Name:</label>
                <select name="professor" id="professor">
                    <option value=""></option>
                    <option value="Maylane Ballita">Maylane Ballita</option>
                    <option value="Milagros Santiago">Milagros Santiago</option>
                    <option value="Leonard Alejandro">Leonard Alejandro</option>
                    <option value="Melvin Nicolas">Melvin Nicolas</option>
                    <option value="Dennis Nazarrea">Dennis Nazarrea</option>
                    <option value="Melchor Erise">Melchor Erise</option>

                </select>

                <label for="date">Consultation Date:</label>
                <input type="date" name="date" id="date" required>

                <label for="start_time">Choose a start consultation time: </label>
                <input id="start_time" type="time" name="start_time" />

                <label for="end_time">Choose an end consultation time: </label>
                <input id="end_time" type="time" name="end_time" />

                <button type="submit" name="send">Book Now</button>
            </form>
        </div>
    </div>
<br><br>
</body>
</html>