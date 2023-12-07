<?php
session_start();
if (isset($_SESSION['unique_id'])) {
  header("location: ../login.php");
}
?>

<?php include_once "header.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* Styles for the modal */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0, 0, 0);
      background-color: rgba(0, 0, 0, 0.4);
      padding-top: 60px;
    }

    .modal-content {
      background-color: #fefefe;
      margin: 5% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }

    h2,
    h3,
    p {
      font-family: 'Times New Roman', serif;
    }

    p {
      font-style: italic;
    }
  </style>
</head>

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
          <input type="password" name="password" placeholder="Enter new password" required>
          <i class="fas fa-eye"></i>
        </div>

        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg">
        </div>

        <div class="field input">
          <input type="text" name="user_type" id="user_type" value="user" hidden>
        </div>

        <!-- data privacy -->
        <label for="dataPrivacyCheckbox">I agree to the data privacy policy:</label>
        <input type="checkbox" id="dataPrivacyCheckbox" name="dataPrivacy" value="accept" required>

        <br>
        <a href="#" id="dataPrivacyLink">Data Privacy</a>

        <!-- Modal for data privacy details -->
        <div id="dataPrivacyModal" class="modal">
          <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Data Privacy Policy</h2>

            <p>
              This Data Privacy Policy explains how we collect, use, and protect your personal information.
            </p>

            <h3>1. Information We Collect</h3>
            <p>
              We may collect personal information such as your name, email address, and other relevant details when you
              interact with our services.
            </p>

            <h3>2. How We Use Your Information</h3>
            <p>
              We use the collected information to provide and improve our services, personalize your experience, and
              communicate with you.
            </p>

            <h3>3. Data Security</h3>
            <p>
              We take appropriate measures to protect your personal information from unauthorized access, disclosure,
              alteration, or destruction.
            </p>

            <h3>4. Sharing of Information</h3>
            <p>
              We do not sell, trade, or otherwise transfer your personal information to third parties without your
              consent.
            </p>

            <h3>5. Cookies</h3>
            <p>
              We use cookies to enhance your experience on our site. You can control cookies through your browser
              settings.
            </p>

            <h3>6. Your Rights</h3>
            <p>
              You have the right to access, correct, or delete your personal information. To exercise these rights,
              please contact us.
            </p>

            <h3>7. Changes to this Policy</h3>
            <p>
              We may update this Data Privacy Policy from time to time. Any changes will be posted on this page.
            </p>
            <br>
            <p>
              By using our services, you agree to the terms outlined in this Data Privacy Policy.
            </p>
          </div>
        </div>

        <!-- submit button -->
        <div class="field button">
          <input type="submit" name="submit" value="Submit" onclick="validateForm()">
        </div>
      </form>
      <div class="link">Already signed up? <a href="../login.php">Login now</a></div>
  </div>
  </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>
  <script>
    function validateForm() {
      var dataPrivacyCheckbox = document.getElementById('dataPrivacyCheckbox');

      if (!dataPrivacyCheckbox.checked) {
        alert("Please agree to the data privacy policy before submitting.");
        return false;
      }

      // Additional form validation logic can be added here if needed.

      // If all validations pass, proceed with form submission.
      document.querySelector('form').submit();
    }

    // JavaScript to handle modal functionality
    var modal = document.getElementById('dataPrivacyModal');
    var link = document.getElementById('dataPrivacyLink');

    link.onclick = function () {
      modal.style.display = 'block';
    }

    function closeModal() {
      modal.style.display = 'none';
    }

    // Close modal if the user clicks outside of it
    window.onclick = function (event) {
      if (event.target === modal) {
        modal.style.display = 'none';
      }
    }
  </script>
</body>

</html>