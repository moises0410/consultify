<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete data from the database
    $sql = "DELETE FROM schedule WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: schedule.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
