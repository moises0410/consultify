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

  <link rel="stylesheet" href="css/email.css">

  <script src="email/prof.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
  </script>
  <script type="text/javascript">
    (function () {
      emailjs.init("mKzS-1C2eIV80WSWh");
    })();
  </script>

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
              <a href="index.php" class="nav-link">
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
              <a href="email.php" class="nav-link active">
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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <style>
        h3 {
          text-align: center;
        }
      </style>
      <br>
      <h3> Email Form - Professor</h3>

      <div class="main-container">
        <div class="form-container">

          <div class="form-group">
            <h5 for="name">Professor Name</h5>
            <input type="text" class="form-control" id="name" placeholder="Enter professor name" />
          </div>

          <div class="form-group">
            <h5 for="email">Email</h5>
            <input type="text" class="form-control" id="email" placeholder="Enter email" />
          </div>

          <div class="form-group">
            <h5 for="sname">Student Name</h5>
            <input type="text" class="form-control" id="sname" placeholder="Enter student name" />
          </div>

          <div class="form-group">
            <h5 for="date">Date</h5>
            <input type="date" class="form-control" id="date" placeholder="Enter date" />
          </div>

          <div class="time-container">
            <h5 for="time">Time</h5>
            <input type="text" class="form-control" id="time" placeholder="Enter time" />
          </div>

          <div class="message-container">
            <h5 for="message">Message</h5>
            <textarea class="form-control" id="message" rows="3" placeholder="..."></textarea>
          </div>
          <br>
          <button class="btn btn-primary" onclick="sendMail()">Submit</button>
        </div>
      </div>
      <iframe src="email2.php" height="750" width="1012" frameborder="0"></iframe>
    </div>
  </div>
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->


  <script src="plugins/jquery/jquery.min.js"></script>

  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

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

  <script src="dist/js/adminlte.min.js"></script>


  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
   $(document).ready(function() {

      let notificationCount = 0;

      function updateNotificationCount() {

         $.ajax({
            url: 'get_notification_count.php', 
            method: 'GET',
            success: function(response) {

               notificationCount = parseInt(response);
               $('#notification-count').text(notificationCount);
            },
            error: function(error) {
               console.error('Error fetching notification count:', error);
            }
         });
      }

      updateNotificationCount();
      $('#notification-icon').on('click', function() {

         console.log('Notification icon clicked!');
         notificationCount++;

         $('#notification-count').text(notificationCount);
      });

      setInterval(updateNotificationCount, 100); 
   });
</script>
</body>
</html>