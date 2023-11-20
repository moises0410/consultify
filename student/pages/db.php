<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbanme = "chatapp";
$conn = new mysqli($servername,$username,$password,$dbanme);

if($conn->connect_error){
    die("Connection Failed:" .$conn->connect_error);

}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"]; 
    $stud_no = $_POST["stud_no"];
    $level = $_POST["level"];
    $concern = $_POST["concern"];
    $professor = $_POST["professor"];
    $date = $_POST["date"];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];

    $sql = "INSERT INTO `booking`(`name`, `stud_no`, `level`, `concern`, `professor`, `date`, `start_time`, `end_time`)
     VALUES ('$name','$stud_no','$level','$concern','$professor','$date','$start_time','$end_time')";

     if($conn->query($sql) == TRUE){
      echo '<script type="text/javascript">';
      echo 'alert("Successfuly Booked!");';
      echo 'window.location.href = "sched.php";';
      echo '</script>';
     }else{
        echo "Error: " .$sql . "<br>" .$conn->error; 
     }
}
$conn->close();
?>