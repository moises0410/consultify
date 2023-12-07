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
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
              <a href="booking.php" class="nav-link" id="notification-icon">
                <i class="nav-icon fas fa-bell"></i>
                <span class="badge badge-warning navbar-badge" id="notification-count">0</span>
                <p>
                  Notifications
                </p>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="index.php" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pending.php" class="nav-link">
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
              <a href="email.php" class="nav-link">
                <i class="nav-icon fas fa-envelope"></i>
                <p>
                  Email Notification
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
    <div class="content-wrapper">
      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

          <!-- Student Card -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-red text-uppercase mb-1">Registered Student</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">

                      <?php

                      $query = "SELECT user_id FROM users WHERE user_type = 'user' ORDER BY user_id";
                      $query_run = mysqli_query($conn, $query);
                      $row = mysqli_num_rows($query_run);
                      echo '<h5> Total Student: ' . $row . '</h5>';
                      ?>

                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-user fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Professor Card  -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Registered Professor</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">

                      <?php

                      $query = "SELECT user_id FROM users WHERE user_type = 'professor' ORDER BY user_id";
                      $query_run = mysqli_query($conn, $query);
                      $row = mysqli_num_rows($query_run);
                      echo '<h5> Total Professor: ' . $row . '</h5>';
                      ?>

                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-user fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Pending Requests Card -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">

                      <?php
                      $query = "SELECT user_id FROM users WHERE note = 'pending' ORDER BY user_id";
                      $query_run = mysqli_query($conn, $query);
                      $row = mysqli_num_rows($query_run);
                      echo '<h5> Total Pending: ' . $row . '</h5>';
                      ?>

                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-hourglass fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <!-- Booking Card -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-green text-uppercase mb-1">Consultation Schedule</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">

                      <?php
                      $query = "SELECT id FROM consult ORDER BY id";
                      $query_run = mysqli_query($conn, $query);
                      $row = mysqli_num_rows($query_run);
                      echo '<h5> Total Booking: ' . $row . '</h5>';
                      ?>

                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-calendar-plus fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Main content -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">STUDENT REPORT</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
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
                $n = 1;
                $sql = "SELECT * FROM users WHERE user_type='user'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                  <tr>

                    <td>
                      <?php echo $row['unique_id']; ?>
                    </td>
                    <td>
                      <?php echo $row['fname']; ?>
                    </td>
                    <td>
                      <?php echo $row['lname']; ?>
                    </td>
                    <td>
                      <?php echo $row['stud_id']; ?>
                    </td>
                    <td>
                      <?php echo $row['course']; ?>
                    </td>
                    <td>
                      <?php echo $row['year']; ?>
                    </td>
                    <td>
                      <?php echo $row['email']; ?>
                    </td>
                  </tr>
                  <?php
                  $n++;
                }
                ?>
              </tbody>

            </table>
          </div>
          <!-- /.card-body -->
          <iframe src="index2.php" height="600" width="1000" frameborder="0"></iframe>
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
        "buttons": ["copy", "excel", "pdf", "print", "colvis"]
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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
   $(document).ready(function() {
      // Initial notification count
      let notificationCount = 0;

      // Function to update the notification count
      function updateNotificationCount() {
         // Make an AJAX request to get the latest count from your server
         // Replace the URL with the actual endpoint to fetch notification count
         $.ajax({
            url: 'get_notification_count.php', // Replace with your actual endpoint
            method: 'GET',
            success: function(response) {
               // Update the notification count on success
               notificationCount = parseInt(response);
               $('#notification-count').text(notificationCount);

               // You can also add more logic to display notifications or update UI here
            },
            error: function(error) {
               console.error('Error fetching notification count:', error);
            }
         });
      }

      // Call the updateNotificationCount function on page load
      updateNotificationCount();

      // Add an event listener for the notification icon click
      $('#notification-icon').on('click', function() {
         // Your logic to display notifications or redirect to a notifications page
         console.log('Notification icon clicked!');

         // Simulate incrementing the notification count
         notificationCount++;

         // Update the notification count in the UI
         $('#notification-count').text(notificationCount);
      });

      // Periodically update the notification count (e.g., every minute)
      setInterval(updateNotificationCount, 100); // Adjust the interval as needed
   });
</script>
</body>

</html>