<?php
  require_once('constants/connectvars.php');

  // Start the session
  session_start();

  // Clear the error message
  $error_msg = "";

  //log user in via SESSION or COOKIES
  require_once("include/logUserIn.php");
  
?>

<!DOCTYPE HTML>
<html>

<head>
	<title>Log In | Enlighten</title>
  
	<?php require_once("include/pagehead.php");?>

</head>

<body>
  <div class="container-fluid" id="main">
  
	<div class="row-fluid">
		<?php include("include/header.php");?>
	</div>
  
    <div class="row-fluid" id="site_content">
		<div id="content">

		<form class="form-signin" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="sponsorLoginForm" name="sponsorLoginForm" >
 
		 <h2 class="form-signin-heading">Log In</h2>
 
		 <?php
		 // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
		 if (empty($_SESSION['sponsorID'])) {
 
		 if (!empty($error_msg)){
				echo '<p class="error_message">' . $error_msg . '</p>';
				}
		?>
		
		<p>
		<input type="text" name="username" id="username" maxlength="10" onBlur="validateNonEmpty(this, document.getElementById('username_help'))" value="<?php if (!empty($username)) echo $username; ?>" placeholder="User Name" />
		<br />
		<span id="username_help" class="helpText"></span>
		</p>
		
		<p>
		<input type="password" name="password" id="password"  onblur="validateNonEmpty(this, document.getElementById('password_help'))" maxlength="10" placeholder="Password" />
		<br />
		<span id="password_help" class="helpText"></span>
		</p>
		
		<input type="submit" class="btn btn-primary submit" value="Log In" name="submit"/>
		</p>
		</form>
		<?php
		} else {
		 // Confirm the successful log-in
		 echo('<p>You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <a href="logout.php">Log Out</a></p>');
		}
		?>
		</div>
		
	</div>
		
	<div class="row-fluid">
		<?php include("include/footer.php");?>
	</div>
  </div>
</body>
</html>
