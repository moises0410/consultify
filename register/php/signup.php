<?php
session_start();
include_once "config.php";

$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$stud_id = mysqli_real_escape_string($conn, $_POST['stud_id']);
$course = mysqli_real_escape_string($conn, $_POST['course']);
$year = mysqli_real_escape_string($conn, $_POST['year']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$user_type = $_POST['user_type'];

if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){
            echo '<script type="text/javascript">';
            echo 'alert("Email Already Taken!");';
            echo 'window.location.href = "../register.php";';
            echo '</script>';
        }else{
            if(isset($_FILES['image'])){
                $img_name = $_FILES['image']['name'];
                $img_type = $_FILES['image']['type'];
                $tmp_name = $_FILES['image']['tmp_name'];
                
                $img_explode = explode('.',$img_name);
                $img_ext = end($img_explode);

                $extensions = ["jpeg", "png", "jpg"];
                if(in_array($img_ext, $extensions) === true){
                    $types = ["image/jpeg", "image/jpg", "image/png"];
                    if(in_array($img_type, $types) === true){
                        $time = time();
                        $new_img_name = $time.$img_name;
                        if(move_uploaded_file($tmp_name,"../../uploaded_img/".$new_img_name)){
                            $ran_id = rand(time(), 100000000);
                            $status = "Active now";
                            $hashed_password = md5($password);
                            $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, stud_id, course, year, email, password, img, status, user_type, note)
                            VALUES ({$ran_id}, '{$fname}', '{$lname}', '{$stud_id}', '{$course}', '{$year}', '{$email}', '{$hashed_password}', '{$new_img_name}', '{$status}', '{$user_type}', 'pending')");
                            if ($insert_query) {
                                $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                if (mysqli_num_rows($select_sql2) > 0) {
                                    $result = mysqli_fetch_assoc($select_sql2);
                                    $_SESSION['unique_id'] = $result['unique_id'];
                                    echo '<script type="text/javascript">';
                                    echo 'alert("Your account is now pending for approval");';
                                    echo 'window.location.href = "../register.php";';
                                    echo '</script>';
                                } else {
                                    echo "This email address does not exist!";
                                }
                            } else {
                                echo "Something went wrong. Please try again!";
                            }
                        } else {
                            echo "File upload failed. Make sure the 'images' directory exists.";
                        }
                    } else {
                        echo "Please upload an image file - jpeg, png, jpg";
                    }
                } else {
                    echo "Please upload an image file - jpeg, png, jpg";
                }
            }
        }
    } else {
        echo "$email is not a valid email!";
    }
} else {
    echo "All input fields are required!";
}
?>