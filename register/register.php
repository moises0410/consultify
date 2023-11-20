<?php
session_start();
if (isset($_SESSION['unique_id'])) {
  header("location: ../students/index.php");
}
?>

<?php include_once "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Student Registration</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">

          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First name" required>
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name" required>
          </div>
        </div>
        <div class="field input">
          <label>Student Number</label>
          <input type="text" name="stud_id" placeholder="Enter your student number" required>
        </div>

        <div class="name-details">
          <div class="input-group">
            <label for="course">Course</label>
            <select id="course" name="course" required>
              <option value=""></option>
              <option value="BSIT">BSIT</option>
              <option value="BSCS">BSCS</option>
            </select>
          </div>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <div class="input-group">
            <label for="year">Year</label>
            <select id="year" name="year" required>
              <option value=""></option>
              <option value="1ST YEAR">1ST YEAR</option>
              <option value="2ND YEAR">2ND YEAR</option>
              <option value="3RD YEAR">3RD YEAR</option>
              <option value="4TH YEAR">4TH YEAR</option>
            </select>
          </div>
        </div>

        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>

        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter new password" required
            pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$"
            title="Password must contain at least 8 characters, including at least one digit, one lowercase letter, one uppercase letter, and one special character">
          <i class="fas fa-eye"></i>
        </div>

        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg">
        </div>
        
        <label>User Type</label>
        <select name="user_type">
          <option value="user">Student</option>
        </select>

        <div class="field button">
          <input type="submit" name="submit" value="Submit">
        </div>
      </form>
      <div class="link">Already signed up? <a href="../login.php">Login now</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>

</html>