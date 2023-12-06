<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:../login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:../login.php');
}

?>
<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link

      href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"

      rel="stylesheet"

    />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

    <link rel="stylesheet" href="css/styler.css" />
    
    <link rel="stylesheet" href="css/styles.css" />
    
    <link rel="stylesheet" href="css/style.css" />


    <title>Subject</title>

  </head>

  <body>

  <nav>

<div class="head">

  <h4>PROFESSOR</h4>

</div>

<ul class="nav-links">

<li><a href="myles.php">Home</a></li>

<li><a class="active" href="consult_myles.php">Consultation</a></li>

<li><a href="reports_myles.php">Report</a></li>

<li><a href="chat_myles/users.php">Message</a></li>
  <?php 
      $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
      if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
      }
    ?>
  <li><a href="../logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a></li>

</ul>

</nav>
<br><br>
<iframe src="frame_prof_consult/myles.php" height="400" width="1270" frameborder = "0"></iframe>

<section class="footer">
 <div class="box-container">
     <div class="box">
     <?php
      $select = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>
         <h2>You are logged in as <?php echo $fetch['fname']; ?> <?php echo $fetch['lname']; ?></h2>
         <a href="myles.php">HOME</a>
         <a href="../logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">LOGOUT</a>
     </div>
 </div>

 <div class="credit"> copyright @ 2023</div>
  </body>

</html>