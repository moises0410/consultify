<?php
include 'config.php';
session_start();

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['unique_id'] = $row['unique_id'];
        $note = $row['note'];

        if ($user_pass === $enc_pass) {
         $status = "Active Now";
         $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
         if ($sql2) {
             $_SESSION['unique_id'] = $row['unique_id'];
             echo "success";
         }
     }

        if ($row['user_type'] == 'user') {
            if ($note == "approved") {
                echo '<script type="text/javascript">';
                echo 'alert("Login Success");';
                echo 'window.location.href = "students/index.php";';
                echo '</script>';
            } elseif ($note == "pending") {
                echo '<script type="text/javascript">';
                echo 'alert("Your account is still pending for approval");';
                echo 'window.location.href = "login.php";';
                echo '</script>';
            }
        } elseif ($row['lname'] == 'Ballita') {
            if ($note == "approved") {
                echo '<script type="text/javascript">';
                echo 'alert("Login Success");';
                echo 'window.location.href = "professors/may.php";';
                echo '</script>';
            } elseif ($note == "pending") {
                echo '<script type="text/javascript">';
                echo 'alert("Your account is still pending for approval");';
                echo 'window.location.href = "login.php";';
                echo '</script>';
            }
        } elseif ($row['lname'] == 'Santiago') {
         if ($note == "approved") {
            echo '<script type="text/javascript">';
            echo 'alert("Login Success");';
            echo 'window.location.href = "professors/myles.php";';
            echo '</script>';
         } elseif ($note == "pending") {
            echo '<script type="text/javascript">';
            echo 'alert("Your account is still pending for approval");';
            echo 'window.location.href = "login.php";';
            echo '</script>';
         }
      } elseif ($row['lname'] == 'Nazarrea') {
         if ($note == "approved") {
            echo '<script type="text/javascript">';
            echo 'alert("Login Success");';
            echo 'window.location.href = "professors/dennis.php";';
            echo '</script>';
         } elseif ($note == "pending") {
            echo '<script type="text/javascript">';
            echo 'alert("Your account is still pending for approval");';
            echo 'window.location.href = "login.php";';
            echo '</script>';
         }
      } elseif ($row['lname'] == 'Erise') {
         if ($note == "approved") {
            echo '<script type="text/javascript">';
            echo 'alert("Login Success");';
            echo 'window.location.href = "professors/erise.php";';
            echo '</script>';
         } elseif ($note == "pending") {
            echo '<script type="text/javascript">';
            echo 'alert("Your account is still pending for approval");';
            echo 'window.location.href = "login.php";';
            echo '</script>';
         }
      } elseif ($row['lname'] == 'Nicolas') {
         if ($note == "approved") {
            echo '<script type="text/javascript">';
            echo 'alert("Login Success");';
            echo 'window.location.href = "professors/vin.php";';
            echo '</script>';
         } elseif ($note == "pending") {
            echo '<script type="text/javascript">';
            echo 'alert("Your account is still pending for approval");';
            echo 'window.location.href = "login.php";';
            echo '</script>';
         }
      } elseif ($row['lname'] == 'Alejandro') {
         if ($note == "approved") {
            echo '<script type="text/javascript">';
            echo 'alert("Login Success");';
            echo 'window.location.href = "professors/leo.php";';
            echo '</script>';
         } elseif ($note == "pending") {
            echo '<script type="text/javascript">';
            echo 'alert("Your account is still pending for approval");';
            echo 'window.location.href = "login.php";';
            echo '</script>';
         }
      }
         $user_pass = $_POST['password'];
         $enc_pass = $row['password'];
 
     } else {
         $message[] = 'incorrect email or password!';
     }
 }
 ?>
 

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>CONSULTIFY</title>
   
   <link rel="stylesheet" href="css/style1.css">
   <link rel="stylesheet" href="style2.css">
</head>

<body>
<nav>
<div class="head">

<h4>CONSULTIFY</h4>

</div>
<ul class="nav-links">
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <li><a href="admin/admin.php"><img src="images/adm.png" width="40" height="40"></a></li>
</ul>

</nav>
   <div class="form-container">
      <form action="" method="post" enctype="multipart/form-data">
         <h3 style="color:blue;">CONSULTIFY</h3>
         <?php
         if (isset($message)) {
            foreach ($message as $message) {
               echo '<div class="message">' . $message . '</div>';
            }
         }
         ?>
         <input type="email" name="email" placeholder="enter email" class="box" required>
         <input type="password" name="password" placeholder="enter password" class="box" required>
         <input type="submit" name="submit" value="login now" class="btn">

         <p>Not yet signed up? Sign Up as <a href="register/register.php">Student</a> or <a
               href="register/register1.php"> Professor </a> </p>

      </form>

   </div>

</body>

</html>