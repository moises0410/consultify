<?php

$sname= "localhost";
$unmae= "root";
$password = "";
$db_name = "professor";
$db_main = "";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);
$conn_teacher_db = mysqli_connect($sname, $unmae, $password, $db_main);
if (!$conn) {
	echo "Connection failed!";
}