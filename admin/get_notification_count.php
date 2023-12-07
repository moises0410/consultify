<?php
// get_notification_count.php
include 'config.php'; // Include your database configuration

// Your query to get the notification count
$query = "SELECT COUNT(*) as count FROM consult";
$result = mysqli_query($conn, $query);

if ($result) {
   $row = mysqli_fetch_assoc($result);
   echo $row['count'];
} else {
   echo '0';
}
?>
