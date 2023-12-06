<?php
session_start();

$recordsPerPage = 5;
$offset = 0;
$page = 1;

if (isset($_GET["page"]) && is_numeric($_GET["page"])) {
    $page = $_GET["page"];
    $offset = ($page - 1) * $recordsPerPage;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "chatapp";


    $conn = new mysqli($hostname, $username, $password, $database);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $name = $_POST["search"];


    $query = "SELECT name, level, concern FROM consult WHERE name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->bind_result($name, $level, $concern);

    if ($stmt->fetch()) {


        $stmt->close();

        $professor = $_POST["professor"];
        $remark = $_POST["remark"];

        $insertQuery = "INSERT INTO consult_report (name, professor, level, concern, remark) VALUES (?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("sssss", $name, $professor, $level, $concern, $remark);

        if ($insertStmt->execute()) {
            echo "<script>
            alert('Remark successfully inserted.'); // You can customize this line
          </script>";
        } else {
            echo "<script>
            alert('Error inserting remark: " . $conn->error . "'); // You can customize this line
          </script>";
        }

        $insertStmt->close();
    } else {
        echo "Student with the provided student name not found.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Consultation Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container-report {
            width: 500px;
            float: left;
            margin-right: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .container-table {
            width: 700px;
            float: left;
            padding: 1px;
            background-color: #fff;
            border-radius: 0px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .student-table {
            width: 100%;
            border-collapse: collapse;
        }

        .student-table th {
            background-color: lightblue;
            text-align: center;
            padding: 5px;
        }

        .student-table td {
            border: 0px solid #ccc;
            padding: 5px;
        }

        .pagination {
            margin-top: 20px;
        }

        .pagination a {
            display: inline-block;
            padding: 5px 10px;
            margin-right: 5px;
            border: 1px solid #ccc;
            text-decoration: none;
            background-color: lightblue;
            color: #333;
            border-radius: 5px;
        }

        .pagination a:hover {
            background-color: #555;
            color: #fff;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            text-align: left;
        }

        .form-group {
            margin-bottom: 10px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"] {
            width: 95%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        textarea {
            width: 95%;
            height: 150px;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <br>

    <div class="container-report">
        <h2>Consultation Report</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="search">Student Name:</label>
                <input type="text" id="search" name="search">
            </div>
            <div class="form-group">
                <input type="text" id="professor" name="professor" value="Melchor Erise" hidden>
            </div>
            <div class="form-group">
                <label for="remark">Remark:</label>
                <textarea id="remark" name="remark"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>

    <div class="container-table">
        <h2>Consultation Data</h2>
        <?php
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $database = "chatapp";

        // Create a database connection
        $conn = new mysqli($hostname, $username, $password, $database);

        $totalRecordsQuery = "SELECT COUNT(*) AS total_records FROM consult_report";
        $totalRecordsResult = $conn->query($totalRecordsQuery);
        $totalRecords = $totalRecordsResult->fetch_assoc()['total_records'];

        // Calculate the total number of pages
        $totalPages = ceil($totalRecords / $recordsPerPage);

        $professorFilter = "Melchor Erise"; // Replace with the actual professor name you want to filter
        
        // Query to fetch a specific range of records based on pagination with a professor filter
        $tableQuery = "SELECT * FROM consult_report WHERE professor = ? LIMIT $recordsPerPage OFFSET $offset";
        $tableStmt = $conn->prepare($tableQuery);
        $tableStmt->bind_param("s", $professorFilter);
        $tableStmt->execute();
        $tableResult = $tableStmt->get_result();

        if ($tableResult->num_rows > 0) {
            echo "<table class='student-table'>";
            echo "<tr><th>Name</th><th>Year & Course</th><th>Area of Concern</th><th>Remark</th></tr>";
            while ($row = $tableResult->fetch_assoc()) {
                echo "<tr><td>" . $row["name"] . "</td><td>" . $row["level"] . "</td><td>" . $row["concern"] . "</td><td>" . $row["remark"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No student records found.";
        }


        if ($totalPages > 1) {
            echo "<div class='pagination'>";
            if ($page > 1) {
                echo "<a href='?page=" . ($page - 1) . "'>Previous</a>";
            }
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<a href='?page=" . $i . "'>$i</a>";
            }
            if ($page < $totalPages) {
                echo "<a href='?page=" . ($page + 1) . "'>Next</a>";
            }
            echo "</div>";
        }
        ?>
    </div>
</body>

</html>

<?php
$conn->close();
?>