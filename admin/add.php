<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $professor_id = $_POST['professor_id'];
    $booking_day = $_POST['booking_day'];

    // Insert data into the database
    $sql = "INSERT INTO professor_availability (professor_id, booking_day) VALUES ('$professor_id', '$booking_day')";
    if (mysqli_query($conn, $sql)) {
        header("Location: schedule.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
