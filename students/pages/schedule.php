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
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/styler.css">


</head>

<body>
<nav>

<div class="head">

  <h4>CONSULTIFY</h4>

</div>

<ul class="nav-links">

  <li><a href="../index.php">Home</a></li>

  <li><a href="subject.php">Faculty</a></li>

  <li><a class="active" href="schedule.php">Schedule</a></li>

  <li><a href="../chatroom/users.php">Message</a></li>

  <?php
  $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
  if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
  }
  ?>
  <li><a href="../../logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a></li>
</ul>

</nav>
<div class="iframe">
  <iframe src="schedule/schedules.php" height="800" width="1300" frameborder="0"></iframe>
</div>

    <section class="footer">
    <div class="box-container">
      <div class="box">
        <h2>You are logged in as
          <?php echo $fetch['fname']; ?>
          <?php echo $fetch['lname']; ?>
        </h2>
        <a href="../index.php">HOME</a>
        <a href="../login.php">LOGOUT</a>
      </div>
    </div>

    <div class="credit"> copyright @ 2023</div>
<br><br>
</body>
</html>