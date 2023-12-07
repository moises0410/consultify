<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
  header("location: login.php");
}
?>
<?php include_once "header.php"; ?>
<body>
  <nav>
    <div class="head">
      <h4>PROFESSOR</h4>
    </div>
    <ul class="nav-links">
      <li><a href="../earl.php">Home</a></li>
      <li><a href="../consult_earl.php">Consultation</a></li>
      <li><a href="../reports_earl.php">Report</a></li>
      <li><a class="active" href="users.php">Message</a></li>
      
      <?php 
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }
      ?>
      <li><a href="logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a></li>
    </ul>
  </nav>

  <div>
    <section class="chat-area">
      <header>
        <?php
        $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
        if (mysqli_num_rows($sql) > 0) {
          $row = mysqli_fetch_assoc($sql);
        } else {
          header("location: users.php");
        }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="../../uploaded_img/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span>
            <?php echo $row['fname'] . " " . $row['lname'] ?>
          </span>
          <p>
            <?php echo $row['status']; ?>
          </p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>

</html>