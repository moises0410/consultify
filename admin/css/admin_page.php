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
            <li><a class="active" href="admin_page.php"><i class="fas fa-home"></i>Dashboard</a></li>
            <li><a href="request.php"><i class="fas fa-user"></i>Pending Request</a></li>
            <li><a href="#"><i class="fas fa-address-card"></i>Message Report</a></li>
            <li><a href="#"><i class="fas fa-address-card"></i>Scheduling Report</a></li>
            <li><a href="admin.php"><i class="fas fa-project-diagram"></i>Logout</a></li>

        </ul> 

    </div>
    <div class="container">
    <div class="row">
            <div class="col-xl-12">
                <h1 class="text-center pt-5"> USER REPORT</h1>
                <br>
                <table class="table table-bordered">
                    
                     <thead>
                        <tr>
                          <th>#</th>
                            <th>FirstName</th>
                            <th>LastName</th>
                            <th>Student Number</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>Email</th>
                        </tr>
                    
                     </thead>
                    <tbody>
                        <?php 
                        $n=1;
                        $sql="SELECT * FROM users";
                        $result = mysqli_query($conn, $sql);
                        while($row=mysqli_fetch_assoc($result))
                        {
                        ?>
                        <tr> 
                            
                            <td><?php echo $row['unique_id']; ?></td>
                            <td><?php echo $row['fname']; ?></td>
                            <td><?php echo $row['lname']; ?></td>
                            <td><?php echo $row['stud_id']; ?></td>
                            <td><?php echo $row['course']; ?></td>
                            <td><?php echo $row['year']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                        </tr>
                        <?php
                        $n++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>
</div>

</body>
</html>
