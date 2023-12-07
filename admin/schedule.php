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
    <link rel="stylesheet" href="css/sched.css">
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
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

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
                            <a href="schedule.php" class="nav-link active">
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
        <?php
        // Include the database connection file
        include 'config.php';

        // Fetch data from the database
        $result = mysqli_query($conn, "SELECT * FROM professor_availability");
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Available Consultation Day</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Professor</th>
                                <th>Booking Day</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['professor_id'] . "</td>";
                                echo "<td>" . $row['booking_day'] . "</td>";
                                echo "<td>  
                                            <a href='delete.php?id=" . $row['id'] . "'>Delete</a>
                                      </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <form action="add.php" method="post">
                        <select name="professor_id" required>
                            <?php
                            $mysqli = new mysqli("localhost", "root", "", "chatapp");

                            $query = "SELECT user_id, concat(fname,' ',lname) as professor_name FROM users WHERE user_type = 'professor'";
                            $stmt = $mysqli->prepare($query);

                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($row = $result->fetch_assoc()) {
                                extract($row);
                                echo "<option value='{$user_id}'>$professor_name</option>";
                            }
                            $stmt->close();
                            ?>
                        </select>
                        <select name="booking_day" required>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <div class="container">
                <div class="card-header">
                    <h3 class="card-title">Insert Professor Time</h3>
                </div>
                <?php
                include 'config.php';

                $result = mysqli_query($conn, "SELECT * FROM professor_schedule");
                ?>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Professor</th>
                            <th>Date</th>
                            <th>Start of Time</th>
                            <th>End of Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['professor_id'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>" . $row['start_time'] . "</td>";
                            echo "<td>" . $row['end_time'] . "</td>";
                            echo "<td>  
                                            <a href='delete_time.php?id=" . $row['id'] . "'>Delete</a>
                                      </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <form action="add_time.php" method="post">
                    <select name="professor_id" required>
                        <?php
                        $mysqli = new mysqli("localhost", "root", "", "chatapp");

                        $query = "SELECT user_id, concat(fname,' ',lname) as professor_name FROM users WHERE user_type = 'professor'";
                        $stmt = $mysqli->prepare($query);

                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            extract($row);
                            echo "<option value='{$user_id}'>$professor_name</option>";
                        }
                        $stmt->close();
                        ?>
                    </select>

                    <input type="date" id="date" name="date">
                    <input type="time" id="start_time" name="start_time">
                    <input type="time" id="end_time" name="end_time">

                    <button type="submit">Submit</button>
                </form>

            </div>

            <div class="container">
                <div class="card-header">
                    <h3 class="card-title">SCHEDULE</h3>
                </div>
                <?php
                include 'config.php';

                $result = mysqli_query($conn, "SELECT * FROM schedule");
                ?>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Professor</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['day'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>" . $row['time'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td>" . $row['professor'] . "</td>";
                            echo "<td>  
                                            <a href='delete_sched.php?id=" . $row['id'] . "'>Delete</a>
                                      </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <form action="add_sched.php" method="post">
                    <select name="day" required>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>
                    <input type="text" name="date" placeholder="mm/dd/yyyy" required>
                    <input type="text" name="time" placeholder="--:-- --" required>
                    <select name="status" required>
                        <option value="Available">Available</option>
                        <option value="Booked">Booked</option>
                    </select>
                    <select name="professor" required>
                        <option value="Maylane Ballita">Maylane Ballita</option>
                        <option value="Milagros Santiago">Milagros Santiago</option>
                        <option value="Dennis Nazarrea">Dennis Nazarrea</option>
                        <option value="Melchor Erise">Melchor Erise</option>
                        <option value="Leonard Alejandro">Leonard Alejandro</option>
                        <option value="Melvin Nicolas">Melvin Nicolas</option>
                    </select>
                    <button type="submit">Submit</button>
                </form>
            </div>
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
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,

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
        $(document).ready(function () {

            let notificationCount = 0;

            function updateNotificationCount() {

                $.ajax({
                    url: 'get_notification_count.php',
                    method: 'GET',
                    success: function (response) {

                        notificationCount = parseInt(response);
                        $('#notification-count').text(notificationCount);
                    },
                    error: function (error) {
                        console.error('Error fetching notification count:', error);
                    }
                });
            }

            updateNotificationCount();
            $('#notification-icon').on('click', function () {

                console.log('Notification icon clicked!');
                notificationCount++;

                $('#notification-count').text(notificationCount);
            });

            setInterval(updateNotificationCount, 100);
        });
    </script>
</body>

</html>