<?php 
   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "heading.php";
   include_once("heading.php");
?>
<html>
<head>
<style>

body {
	background-image: url();
	background-color: whitesmoke;
}
</body>
</style>
</head>

<body>

<nav class="navbar navbar-default navbar-static-top">
	  <div class="container">
	  <h3><a href="../login.php"><img src="../images/back.jpg" width="25" height="25"></a> &nbsp; ADMIN</h3>
	  </div>
	</nav>
	
	<div class="content">
		<div class="form">
		<form class="form-horizontal" method="post" action="admin_page.php">
			<fieldset>

			<legend>Login Panel</legend>

			
			<br><div class="form-group">
			  <label class="col-md-4 control-label" for="username">Username</label>  
			  <div class="col-md-5">
			  <input id="username" name="username" type="text" placeholder="" class="form-control input-md" required="">
				
			  </div>
			</div>

			
			<div class="form-group">
			  <label class="col-md-4 control-label" for="password">Password</label>
			  <div class="col-md-5">
				<input id="password" name="password" type="password" placeholder="" class="form-control input-md" required="">
				
			  </div>
			</div>

			
			<div class="form-group" align="right">
			  <label class="col-md-4 control-label" for="login"></label>
			  <div class="col-md-5">
				<input type="submit" name="lgn" class="btn btn-success " value="Login">
			  </div>
			</div>

			</fieldset>
		</form>
		</div>
		</div>
	</div>
</body>
</html>
