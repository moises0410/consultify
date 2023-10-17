<?php
include 'config.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');


if(isset($_POST['submit'])){
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['user_id'];
      $_SESSION['unique_id'] = $row['unique_id'];
      $note = $row['note'];

      if($row['user_type'] == 'user'){
         if($note == "approved"){
            echo '<script type="text/javascript">';
            echo 'alert("Login Success");';
            echo 'window.location.href = "students/index.php";';
            echo '</script>';
         }
         elseif($note == "pending"){
            echo '<script type="text/javascript">';
            echo 'alert("Your account is still pending for approval");';
            echo 'window.location.href = "login.php";';
            echo '</script>';
         }
      }
      elseif($row['user_type'] == 'admin'){
         header('location: admin_page.php');
      }
      elseif($row['user_type'] == 'professor'){
         if($note == "approved"){
            echo '<script type="text/javascript">';
            echo 'alert("Login Success");';
            //echo 'console.log("' . $_SESSION['user_id'] . '");';
            echo 'window.location.href = "professors/professor_page.php";';
            echo '</script>';
         }
         elseif($note == "pending"){
            echo '<script type="text/javascript">';
            echo 'alert("Your account is still pending for approval");';
            echo 'window.location.href = "login.php";';
            echo '</script>';
         }
      }

      $user_pass = $_POST['password']; 
      $enc_pass = $row['password'];

      if ($user_pass === $enc_pass){
         $status = "Active Now";
         $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
         if($sql2){
            $_SESSION['unique_id'] = $row['unique_id'];
            echo "success";
         }
      }
   }
   else{
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

   <style>
.form-container{
  background-image: url("images/au.jpeg");
  height: 100%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3 style="color:blue;">CONSULTIFY</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="email" name="email" placeholder="enter email" class="box" required>
      <input type="password" name="password" placeholder="enter password" class="box" required>
      <input type="submit" name="submit" value="login now" class="btn">
      <p>Not yet signed up? <a href="register/register.php">Signup now </a></p>
      <h5><a href="admin/admin.php"> Admin </a></h5>
   </form>

</div>

</body>
</html>