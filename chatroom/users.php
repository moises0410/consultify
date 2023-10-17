<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<body>
<body>
  <nav>
    <div class="head">
      <h4>CONSULTIFY</h4>
    </div>
    <ul class="nav-links">
      <li><a href="../index.php">Home</a></li>
      <li><a href="../pages/subject.php">Subject</a></li>
      <li><a href="../schedule/index.php">Schedule</a></li>
      <li><a class="active" href="users.php">Message</a></li>
      <li><a href="../pages/about.php">About</a></li>
      <?php 
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }
      ?>
      <li><a href="logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a></li>
    </ul>
  </nav>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <img src="../images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>
  
  <script src="javascript/users.js"></script>

</body>
</html>
