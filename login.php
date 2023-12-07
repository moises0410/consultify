<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>CONSULTIFY</title>

   <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js
"></script>
   <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css
" rel="stylesheet">

   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="css/style1.css">

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

      if ($pass) {
         $status = "Active Now";
         $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
         if ($sql2) {
            $_SESSION['unique_id'] = $row['unique_id'];
         }
      }

      if ($row['user_type'] == 'user') {
         if ($note == "approved") {
            ?>
            <script>
               const Toast = Swal.mixin({
                  toast: true,
                  position: "top-right",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.onmouseenter = Swal.stopTimer;
                     toast.onmouseleave = Swal.resumeTimer;
                  }
               });
               Toast.fire({
                  icon: "success",
                  title: "Login Success!"
               }).then(function () {
                  window.location = "students/index.php";
               });
            </script>
            <?php
         } elseif ($note == "pending") {
            ?>
            <script>
               const Toast = Swal.mixin({
                  toast: true,
                  position: "top-right",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.onmouseenter = Swal.stopTimer;
                     toast.onmouseleave = Swal.resumeTimer;
                  }
               });
               Toast.fire({
                  icon: "success",
                  title: "Your account is still pending for approval"
               }).then(function () {
                  window.location = "login.php";
               });
            </script>
            <?php
         }
      } elseif ($row['lname'] == 'Ballita') {
         if ($note == "approved") {
            ?>
            <script>
               const Toast = Swal.mixin({
                  toast: true,
                  position: "top-right",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.onmouseenter = Swal.stopTimer;
                     toast.onmouseleave = Swal.resumeTimer;
                  }
               });
               Toast.fire({
                  icon: "success",
                  title: "Login Success!"
               }).then(function () {
                  window.location = "professors/may.php";
               });
            </script>
            <?php
         } elseif ($note == "pending") {
            ?>
            <script>
               const Toast = Swal.mixin({
                  toast: true,
                  position: "top-right",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.onmouseenter = Swal.stopTimer;
                     toast.onmouseleave = Swal.resumeTimer;
                  }
               });
               Toast.fire({
                  icon: "success",
                  title: "Your account is still pending for approval"
               }).then(function () {
                  window.location = "login.php";
               });
            </script>
            <?php
         }
      } elseif ($row['lname'] == 'Santiago') {
         if ($note == "approved") {
            ?>
            <script>
               const Toast = Swal.mixin({
                  toast: true,
                  position: "top-right",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.onmouseenter = Swal.stopTimer;
                     toast.onmouseleave = Swal.resumeTimer;
                  }
               });
               Toast.fire({
                  icon: "success",
                  title: "Login Success!"
               }).then(function () {
                  window.location = "professors/myles.php";
               });
            </script>
            <?php
         } elseif ($note == "pending") {
            ?>
            <script>
               const Toast = Swal.mixin({
                  toast: true,
                  position: "top-right",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.onmouseenter = Swal.stopTimer;
                     toast.onmouseleave = Swal.resumeTimer;
                  }
               });
               Toast.fire({
                  icon: "success",
                  title: "Your account is still pending for approval"
               }).then(function () {
                  window.location = "login.php";
               });
            </script>
            <?php
         }
      } elseif ($row['lname'] == 'Nazarrea') {
         if ($note == "approved") {
            ?>
            <script>
               const Toast = Swal.mixin({
                  toast: true,
                  position: "top-right",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.onmouseenter = Swal.stopTimer;
                     toast.onmouseleave = Swal.resumeTimer;
                  }
               });
               Toast.fire({
                  icon: "success",
                  title: "Login Success!"
               }).then(function () {
                  window.location = "professors/dennis.php";
               });
            </script>
            <?php
         } elseif ($note == "pending") {
            ?>
            <script>
               const Toast = Swal.mixin({
                  toast: true,
                  position: "top-right",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.onmouseenter = Swal.stopTimer;
                     toast.onmouseleave = Swal.resumeTimer;
                  }
               });
               Toast.fire({
                  icon: "success",
                  title: "Your account is still pending for approval"
               }).then(function () {
                  window.location = "login.php";
               });
            </script>
            <?php
         }
      } elseif ($row['lname'] == 'Erise') {
         if ($note == "approved") {
            ?>
            <script>
               const Toast = Swal.mixin({
                  toast: true,
                  position: "top-right",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.onmouseenter = Swal.stopTimer;
                     toast.onmouseleave = Swal.resumeTimer;
                  }
               });
               Toast.fire({
                  icon: "success",
                  title: "Login Success!"
               }).then(function () {
                  window.location = "professors/erise.php";
               });
            </script>
            <?php
         } elseif ($note == "pending") {
            ?>
            <script>
               const Toast = Swal.mixin({
                  toast: true,
                  position: "top-right",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.onmouseenter = Swal.stopTimer;
                     toast.onmouseleave = Swal.resumeTimer;
                  }
               });
               Toast.fire({
                  icon: "success",
                  title: "Your account is still pending for approval"
               }).then(function () {
                  window.location = "login.php";
               });
            </script>
            <?php
         }
      } elseif ($row['lname'] == 'Nicolas') {
         if ($note == "approved") {
            ?>
            <script>
               const Toast = Swal.mixin({
                  toast: true,
                  position: "top-right",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.onmouseenter = Swal.stopTimer;
                     toast.onmouseleave = Swal.resumeTimer;
                  }
               });
               Toast.fire({
                  icon: "success",
                  title: "Login Success!"
               }).then(function () {
                  window.location = "professors/vin.php";
               });
            </script>
            <?php
         } elseif ($note == "pending") {
            ?>
            <script>
               const Toast = Swal.mixin({
                  toast: true,
                  position: "top-right",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.onmouseenter = Swal.stopTimer;
                     toast.onmouseleave = Swal.resumeTimer;
                  }
               });
               Toast.fire({
                  icon: "success",
                  title: "Your account is still pending for approval"
               }).then(function () {
                  window.location = "login.php";
               });
            </script>
            <?php
         }
      } elseif ($row['lname'] == 'Alejandro') {
         if ($note == "approved") {
            ?>
            <script>
               const Toast = Swal.mixin({
                  toast: true,
                  position: "top-right",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.onmouseenter = Swal.stopTimer;
                     toast.onmouseleave = Swal.resumeTimer;
                  }
               });
               Toast.fire({
                  icon: "success",
                  title: "Login Success!"
               }).then(function () {
                  window.location = "professors/leo.php";
               });
            </script>
            <?php
         } elseif ($note == "pending") {
            ?>
            <script>
               const Toast = Swal.mixin({
                  toast: true,
                  position: "top-right",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.onmouseenter = Swal.stopTimer;
                     toast.onmouseleave = Swal.resumeTimer;
                  }
               });
               Toast.fire({
                  icon: "success",
                  title: "Your account is still pending for approval"
               }).then(function () {
                  window.location = "login.php";
               });
            </script>
            <?php
         }
      } elseif ($row['lname'] == 'Carreon') {
         if ($note == "approved") {
            ?>
            <script>
               const Toast = Swal.mixin({
                  toast: true,
                  position: "top-right",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.onmouseenter = Swal.stopTimer;
                     toast.onmouseleave = Swal.resumeTimer;
                  }
               });
               Toast.fire({
                  icon: "success",
                  title: "Login Success!"
               }).then(function () {
                  window.location = "professors/amante.php";
               });
            </script>
            <?php
         } elseif ($note == "pending") {
            ?>
            <script>
               const Toast = Swal.mixin({
                  toast: true,
                  position: "top-right",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.onmouseenter = Swal.stopTimer;
                     toast.onmouseleave = Swal.resumeTimer;
                  }
               });
               Toast.fire({
                  icon: "success",
                  title: "Your account is still pending for approval"
               }).then(function () {
                  window.location = "login.php";
               });
            </script>
            <?php
         }
      } elseif ($row['lname'] == 'Delos Reyes') {
         if ($note == "approved") {
            ?>
            <script>
               const Toast = Swal.mixin({
                  toast: true,
                  position: "top-right",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.onmouseenter = Swal.stopTimer;
                     toast.onmouseleave = Swal.resumeTimer;
                  }
               });
               Toast.fire({
                  icon: "success",
                  title: "Login Success!"
               }).then(function () {
                  window.location = "professors/amy.php";
               });
            </script>
            <?php
         } elseif ($note == "pending") {
            ?>
            <script>
               const Toast = Swal.mixin({
                  toast: true,
                  position: "top-right",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.onmouseenter = Swal.stopTimer;
                     toast.onmouseleave = Swal.resumeTimer;
                  }
               });
               Toast.fire({
                  icon: "success",
                  title: "Your account is still pending for approval"
               }).then(function () {
                  window.location = "login.php";
               });
            </script>
            <?php
         }
      } elseif ($row['lname'] == 'Albina') {
         if ($note == "approved") {
            ?>
            <script>
               const Toast = Swal.mixin({
                  toast: true,
                  position: "top-right",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.onmouseenter = Swal.stopTimer;
                     toast.onmouseleave = Swal.resumeTimer;
                  }
               });
               Toast.fire({
                  icon: "success",
                  title: "Login Success!"
               }).then(function () {
                  window.location = "professors/earl.php";
               });
            </script>
            <?php
         } elseif ($note == "pending") {
            ?>
            <script>
               const Toast = Swal.mixin({
                  toast: true,
                  position: "top-right",
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                     toast.onmouseenter = Swal.stopTimer;
                     toast.onmouseleave = Swal.resumeTimer;
                  }
               });
               Toast.fire({
                  icon: "success",
                  title: "Your account is still pending for approval"
               }).then(function () {
                  window.location = "login.php";
               });
            </script>
            <?php
         }
      }
   }
}
?>