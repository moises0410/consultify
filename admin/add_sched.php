<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $day = $_POST['day'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $status = $_POST['status'];
    $professor = $_POST['professor'];

    // Insert data into the database
    $sql = "INSERT INTO schedule (day, date, time, status, professor) VALUES ('$day', '$date', '$time', '$status', '$professor')";
    if (mysqli_query($conn, $sql)) {
        header("Location: schedule.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
