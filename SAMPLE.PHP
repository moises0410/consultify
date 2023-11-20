<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "chatapp";

    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stud_id = $_POST["search"];
    $concern = $_POST["concern"];

    // Retrieve the selected professor's name (you need to add this part)
    $professor = $_POST["professor"]; // Assuming you have an input field for selecting the professor.

    $query = "SELECT fname, lname, stud_id, course, year FROM users WHERE stud_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $stud_id);
    $stmt->execute();
    $stmt->bind_result($fname, $lname, $stud_id, $course, $year);

    if ($stmt->fetch()) {
        $stmt->close();

        $name = $fname . ' ' . $lname;
        $stud_no = $stud_id;
        $level = $course . ' ' . $year;

        $insertQuery = "INSERT INTO consult (name, stud_no, level, concern, professor) VALUES (?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("sssss", $name, $stud_no, $level, $concern, $professor); // Bind the $professor variable.

        if ($insertStmt->execute()) {
            echo "Consultation Successfully booked!";
        } else {
            echo "Error inserting remark: " . $conn->error;
        }

        $insertStmt->close();
    } else {
        echo "Student with the provided student number not found.";
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
            float: center;
            margin-right: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
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
        <h2>Booking: </h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="search">Student Number:</label>
                <input type="text" id="search" name="search">
            </div>
            <div class="form-group">
                <label for="professor">Professor Name:</label>
                <?php
                $mysqli = new mysqli("localhost", "root", "", "chatapp");

                $query = "SELECT user_id, concat(fname,'&nbsp;',lname) as professor_name FROM users WHERE user_type = 'professor'";
                $stmt = $mysqli->prepare($query);

                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    extract($row);
                    echo "<input type=text id=professor name=professor 'professor_id={$user_id}' value=$professor_name>";
                }
                $stmt->close();
                ?>

            </div>
            <div class="form-group">
                <label for="concern">Area of Concern:</label>
                <textarea id="concern" name="concern"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</body>

</html>