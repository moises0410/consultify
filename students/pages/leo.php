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

  <meta charset="UTF-8" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

  <link rel="stylesheet" href="css/styler.css" />

  <link rel="stylesheet" href="css/styles.css" />

  <link rel="stylesheet" href="css/style.css" />

  <link rel="stylesheet" href="css/admin3.css" />

  <title>Faculty</title>

</head>

<body>

  <nav>

    <div class="head">

      <h4>CONSULTIFY</h4>

    </div>

    <ul class="nav-links">

      <li><a href="../index.php">Home</a></li>

      <li><a class="active" href="subject.php">Faculty</a></li>

      <li><a href="schedule.php">Schedule</a></li>

      <li><a href="../chatroom/users.php">Message</a></li>

      <?php
      $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
      if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
      }
      ?>
      <li><a href="../logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a></li>
    </ul>

  </nav>
  <br><br>
  <div class="wrapper">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div class="sidebar">
      <h1>PROFESSORS</h1>
      <ul>
        <li><a href="subject.php"><i class="fas fa-home"></i>Maylane E. Ballita</a></li>
        <li><a href="myles.php"><i class="fas fa-user"></i>Milagros M. Santiago</a></li>
        <li><a href="leo.php"><i class="fas fa-address-card"></i>Leonard L. Alejandro</a></li>
        <li><a href="dennis.php"><i class="fas fa-address-card"></i>Dennis Nazarrea</a></li>
        <li><a href="melvin.php"><i class="fas fa-address-card"></i>Melvin D. Nicolas</a></li>
        <li><a href="erise.php"><i class="fas fa-address-card"></i>Melchor G. Erise</a></li>
      </ul>
    </div>
    
<style>
  .styled-table {
    border-collapse: collapse;
    margin: 25px 80px;
    font-size: 15px;
    font-family: sans-serif;
    min-width: 900px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: blue;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}
</style>
<table class="styled-table">
      <thead>
        <tr>

          <th>Day</th>
          <th>Date</th>
          <th>Time</th>
          <th>Status</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $n = 1;
        $sql = "SELECT * FROM schedule WHERE professor='Leonard Alejandro'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          ?>
          <tr>

            <td>
              <?php echo $row['day']; ?>
            </td>
            <td>
              <?php echo $row['date']; ?>
            </td>
            <td>
              <?php echo $row['time']; ?>
            </td>
            <td>
              <?php echo $row['status']; ?>
            </td>

          </tr>
          <?php
          $n++;
        }
        ?>
      </tbody>

    </table>

  </div>
  <br><br><br>
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
</body>

</html>