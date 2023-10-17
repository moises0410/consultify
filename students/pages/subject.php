<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}


?>
     <?php
      $select = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
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

    <link rel="stylesheet" href="css/demo.css"/>

<link rel="stylesheet" href="css/theme3.css"/>

    <title>Subject</title>

  </head>

  <body>

    <nav>

      <div class="head">

        <h4>CONSULTIFY</h4>

      </div>

      <ul class="nav-links">

        <li><a href="../index.php">Home</a></li>

        <li><a class="active" href="subject.php">Faculty</a></li>

        <li><a href="schedule/index.php">Schedule</a></li>

        <li><a href="../chatroom/users.php">Message</a></li>

        <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
        <li><a href="../logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a></li>
      </ul>

    </nav>

    <!-- subjects and calendar-->
    <br><br><br>
<table> 
  <tr>
    <th class="links">
<h1> MY COURSE: </h1>
    <br><br>
    <a href="">JAS - GCAS 14 (FSA / PM07000830)</a>
<br><br>
<a href=""> JAS - MGT 205 (SAT / PM02300530)</a>
<br><br>
<a href=""> JAS - IT 227LEC (THU / PM02000400)</a>
<br><br>
<a href=""> JAS - IT 227LAB (THU / AM10300130)</a>
<br><br>
<a href=""> JAS - IT 226 (SAT / AM10300130)</a>
<br><br>
<a href=""> JAS - IT 225 (SAT / PM05300830)</a>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</th>
<th>
<p style="font-size:30px" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Maylane E. Ballita </p>
  <h1 align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; IT225: Capstone Project & Reasearch 2 </h1>

  <div id="caleandar">

  </div>

    <script type="text/javascript" src="js/caleandar.js"></script>
    <script type="text/javascript" src="js/demo.js"></script>
</th>
</tr>
</table>  

<section class="footer">
 <div class="box-container">
     <div class="box">
         <h2>You are logged in as <?php echo $fetch['fname']; ?> <?php echo $fetch['lname']; ?></h2>
         <a href="../index.php">HOME</a>
         <a href="../login.php">LOGOUT</a>
     </div>
 </div>

 <div class="credit"> copyright @ 2023</div>
  </body>

</html>