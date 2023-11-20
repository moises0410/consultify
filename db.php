<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbanme = "chatapp";
$conn = new mysqli($servername,$username,$password,$dbanme);

if($conn->connect_error){
    die("Connection Failed:" .$conn->connect_error);

}

?>