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


    <link rel="stylesheet" href="css/style1.css">

    <style>
        .form-container {
            background-image: url("../images/au.jpeg");
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
            <h3>ADMIN</h3>
            <?php
            if (isset($message)) {
                foreach ($message as $message) {
                    echo '<div class="message">' . $message . '</div>';
                }
            }
            ?>
            <input type="username" name="username" placeholder="enter email" class="box" required>
            <input type="password" name="password" placeholder="enter password" class="box" required>
            <input type="submit" name="submit" value="login now" class="btn">
            <br>
            <h4>
                <a href="../login.php">BACK</a>
            </h4>

        </form>

    </div>
</body>
</html>

<?php
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $connect = mysqli_connect("localhost", "root", "") or die("Couldn't connect to the database!");
        mysqli_select_db($connect, "chatapp") or die("Couldn't find the database!");

        $query = mysqli_query($connect, "SELECT * FROM admin WHERE username='$username'");
        $numrows = mysqli_num_rows($query);

        if ($numrows !== 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $dbusername = $row['username'];
                $dbpassword = $row['password'];
            }
            if ($username == $dbusername && $password == $dbpassword) {
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
                  title: "Welcome Admin!"
               }).then(function () {
                  window.location = "index.php";
                  $_SESSION['username'] = $username;
               });
            </script>
            <?php
            } else {
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
                  icon: "error",
                  title: "Login Unsuccessful!"
               }).then(function () {
                  window.location = "admin.php";
               });
            </script>
            <?php
            }
        } else {
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
                  icon: "warning",
                  title: "That user doesn't exist!"
               }).then(function () {
                  window.location = "admin.php";
               });
            </script>
            <?php
        }
    } else {
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
                  icon: "info",
                  title: "Please enter both username and password!"
               }).then(function () {
                  window.location = "admin.php";
               });
            </script>
            <?php
    }
}
?>