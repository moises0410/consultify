<?php

include 'config.php';
session_start();
$unique_id = $_SESSION['unique_id'];
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:../login.php');
};
if(!isset($unique_id)){
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
    
    <link rel="stylesheet" href="../css/style1.css" />
    <link rel="stylesheet" href="../css/style2.css" />
    <link rel="stylesheet" href="../css/style3.css" />


    <title>Home</title>

  </head>

  <body>

    <nav>

      <div class="head">

        <h4>CONSULTIFY</h4>

      </div>

      <ul class="nav-links">

        <li><a class="active" href="index.php">Home</a></li>

        <li><a href="pages/subject.php">Faculty</a></li>

        <li><a href="pages/schedule/index.php">Schedule</a></li>

        <li><a href="chatroom/users.php">Message</a></li>

        <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
        <li><a href="../logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a></li>

      </ul>

    </nav>

       
<div class="container">

<div class="profile">
   <?php
      $select = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>
   <img src="chatroom/images/<?php echo $row['img']; ?>" alt="">
   <h3><?php echo $fetch['fname']; ?> <?php echo $fetch['lname']; ?></h3>
   <h3><?php echo $fetch['stud_id']; ?></h3>
   <h3><?php echo $fetch['course']; ?></h3>
   <h3><?php echo $fetch['year']; ?></h3>
   <a href="update_profile.php" class="btn">update profile</a>
</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src="../images/banner.png" alt="Consultify" width="900" height="500">
</div>



<section class="footer">
 <div class="box-container">
     <div class="box">
         <h2>You are logged in as <?php echo $fetch['fname']; ?> <?php echo $fetch['lname']; ?></h2>
         <a href="index.php">HOME</a>
         <a href="../login.php">LOGOUT</a>
     </div>
 </div>

 <div class="credit"> copyright @ 2023</div>
</section>
</body>
</html>