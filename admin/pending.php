<?php
include 'config.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ADMIN</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
    <img src="admin.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ADMIN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pending.php" class="nav-link active">
              <i class="nav-icon fas fa-hourglass-half"></i>
              <p>
                Pending Request
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="message.php" class="nav-link">
              <i class="nav-icon fas fa-comment"></i>
              <p>
                Messages Report
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="booking.php" class="nav-link">
              <i class="nav-icon fa fa-calendar"></i>
              <p>
                Booking Report
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="history.php" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Consultation History
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="schedule.php" class="nav-link">
              <i class="nav-icon fas fa-calendar-plus"></i>
              <p>
                Schedule Data
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">PENDING REQUEST</h3>
        </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                  <thead>
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
                  </thead>
                  <tbody>
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
                            <td><form action="pending.php" method="POST">
                                <input type="hidden" name="unique_id" value="<?php echo $row['unique_id']; ?>" />
                                <button type="submit" name="approve" class="btn btn-success">Approve</button>
                                <button type="submit" name="deny" class="btn btn-danger">Deny</button>
                            </form></td>
                        </tr>
                        <?php
                        
                        }
                        ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body --><?php

        if(isset($_POST['approve'])){
            $unique_id = $_POST['unique_id'];

            $select = "UPDATE users SET note = 'approved' WHERE unique_id = '$unique_id'";
            $result = mysqli_query($conn, $select);

            echo '<script type = "text/javascript">';
            echo 'alert("User Approved!");';
            echo 'window.location.href = "pending.php"';
            echo '</script>';
        }
        if(isset($_POST['deny'])){
            $unique_id = $_POST['unique_id'];

            $select = "DELETE FROM users WHERE unique_id = '$unique_id'";
            $result = mysqli_query($conn, $select);

            echo '<script type = "text/javascript">';
            echo 'alert("User Denied!");';
            echo 'window.location.href = "pending.php"';
            echo '</script>';
        }
        ?>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
