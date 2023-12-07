<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $professor_id = $_POST['professor_id'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Insert data into the database
    $sql = "INSERT INTO professor_schedule (professor_id, date, start_time, end_time) VALUES ('$professor_id', '$date', '$start_time', '$end_time')";
    if (mysqli_query($conn, $sql)) {
        header("Location: schedule.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
