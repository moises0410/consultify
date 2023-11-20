<?php
include 'config.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ADMIN</title>
	<link rel="stylesheet" href="css/admin3.css">
  <link rel="stylesheet" href="css/admin.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <h2>ADMIN</h2>
        <ul>
            <li><a href="admin_page.php"><i class="fas fa-home"></i>Dashboard</a></li>
            <li><a class="active" href="request.php"><i class="fas fa-user"></i>Pending Request</a></li>
            <li><a href="#"><i class="fas fa-address-card"></i>Message Report</a></li>
            <li><a href="#"><i class="fas fa-address-card"></i>Scheduling Report</a></li>
            <li><a href="admin.php"><i class="fas fa-project-diagram"></i>Logout</a></li>
        </ul> 

    </div>

    <div class="container">


<div class="row">
            <div class="col-xl-12">
                <h1 class="text-center pt-5"> USER REGISTRATION</h1>
                <table class="table table-bordered">
                    
                        <tr>
                            <th>#</th>
                            <th>FirstName</th>
                            <th>LastName</th>
                            <th>Student Number</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                   
                    
                        <?php 
                        $query = "SELECT * FROM users WHERE note = 'pending' ORDER BY unique_id ASC";
                        $result = mysqli_query($conn,$query);
                        while($row = mysqli_fetch_array($result)){
                        ?>
                        <tr> 
                            <td><?php echo $row['unique_id']; ?></td>
                            <td><?php echo $row['fname']; ?></td>
                            <td><?php echo $row['lname']; ?></td>
                            <td><?php echo $row['stud_id']; ?></td>
                            <td><?php echo $row['course']; ?></td>
                            <td><?php echo $row['year']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                        <td>
                        <form action ="request.php" method ="POST">
                                    <input type = "hidden" name ="unique_id" value =  "<?php echo $row['unique_id'];?>"/> 
                                    <input type = "submit" name ="approve" value = "Approve" class="btn"/>
                                    <input type = "submit" name ="deny" value = "Deny" class="btn"/> 
                        </form>
                        </td>
                        </tr>
                        
                          
                        <?php
                        
                        }
                        ?>
           </div>
        <?php

        if(isset($_POST['approve'])){
            $unique_id = $_POST['unique_id'];

            $select = "UPDATE users SET note = 'approved' WHERE unique_id = '$unique_id'";
            $result = mysqli_query($conn, $select);

            echo '<script type = "text/javascript">';
            echo 'alert("User Approved!");';
            echo 'window.location.href = "request.php"';
            echo '</script>';
        }
        if(isset($_POST['deny'])){
            $unique_id = $_POST['unique_id'];

            $select = "DELETE FROM users WHERE unique_id = '$unique_id'";
            $result = mysqli_query($conn, $select);

            echo '<script type = "text/javascript">';
            echo 'alert("User Denied!");';
            echo 'window.location.href = "request.php"';
            echo '</script>';
        }
        ?>

</body>
</html>