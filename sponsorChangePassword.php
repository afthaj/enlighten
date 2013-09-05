<?php
  require_once('constants/connectvars.php');

  session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['sponsorID'])) {
    if (isset($_COOKIE['sponsorID']) && isset($_COOKIE['username'])) {
      $_SESSION['sponsorID'] = $_COOKIE['sponsorID'];
      $_SESSION['username'] = $_COOKIE['username'];
	  $_SESSION['firstname'] = $_COOKIE['firstName'];
	  $_SESSION['lastname'] = $_COOKIE['lastName'];
    }
  } else {
	  
	  $_SESSION['sponsorID'] = $_COOKIE['sponsorID'];
      $_SESSION['username'] = $_COOKIE['username'];
	  $_SESSION['firstname'] = $_COOKIE['firstName'];
	  $_SESSION['lastname'] = $_COOKIE['lastName'];
	  
	  // Connect to the database
	  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	  if (isset($_POST['submit'])) {
		// Grab the profile data from the POST
		$old_password = mysqli_real_escape_string($dbc, trim($_POST['oldpassword']));
		$new_password = mysqli_real_escape_string($dbc, trim($_POST['newpassword']));
		$retype_new_password = mysqli_real_escape_string($dbc, trim($_POST['retypenewpassword']));
		
		if (!empty($old_password) && !empty($new_password) && !empty($retype_new_password)) {
			
			if ($new_password == $retype_new_password) {
				
				$query2 = "SELECT * FROM sponsor WHERE sponsorID = '" . $_SESSION['sponsorID'] . "' AND password = SHA('$old_password')";
				$data2 = mysqli_query($dbc, $query2);
				$result2 = mysqli_fetch_array($data2);
				
				if($result2 != NULL){
					
					$query = "UPDATE sponsor SET password = SHA('$new_password') WHERE sponsorID = '" . $_SESSION['sponsorID'] . "'";
					mysqli_query($dbc, $query);
					// Confirm success with the user
					$error_msg = 'Your password has been successfully updated. Would you like to <a href="sponsorViewAndEditProfile.php">view</a> your profile?';
					mysqli_close($dbc);
					
					} else {
						$error_msg = 'Your existing password did not match';
						mysqli_close($dbc);
						}
				
				} else {
					$error_msg = 'The new password you retyped did not match. Please retype your new password.';
					mysqli_close($dbc);
					}
			} else {
				$error_msg = 'Please enter values for all the fields';
				mysqli_close($dbc);
				}
		} else {
				$error_msg = '';
				mysqli_close($dbc);
			  }
	  }
?>

<!DOCTYPE HTML>
<html>

<head>
<title>Change Password | Enlight</title>

<?php require_once("include/pagehead.php");?>

</head>

<body>
  <div class="container container-fluid" id="main">
    
	<?php include("include/header.php");?>
	
    <div id="content_header"></div>
    <div class="span12" id="site_content">      
      <div id="content">
      
      <h1>Change Password</h1>
      
		<?php
			// Confirm the successful log-in
			if (isset($_SESSION['sponsorID'])) {
			echo '<p>You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <a class="btn btn-primary" href="sponsorViewAndEditProfile.php"><i class="icon-white icon-arrow-left"></i> Back to View/Edit Profile</a></p>';
			
			if (!empty($error_msg)){
					echo '<p class="error_message">' . $error_msg . '</p>';
					}
		?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="register" name="applicantChangePasswordForm" id="applicantChangePasswordForm">
          <fieldset class="row4">
            <legend>Login Details</legend>
            <p>
              <label for="oldpassword">Old Password :</label>
              <input type="password" id="oldpassword" name="oldpassword" size="20" onBlur="validateNonEmpty(this, document.getElementById('oldpassword_help'))"/>
              <span id="oldpassword_help" class="helpText"></span>
            </p>
            <p>
              <label for="newpassword">New Password :</label>
              <input type="password" id="newpassword" name="newpassword" size="20" onBlur="validateNonEmpty(this, document.getElementById('newpassword_help'))"/>
              <span id="newpassword_help" class="helpText"></span>
            </p>
            <p>
              <label for="retypenewpassword">Retype Password</label>
              <input type="password" name="retypenewpassword" id="retypenewpassword" onBlur="validateRetypePassword(this, document.getElementById('newpassword'), document.getElementById('retypenewpassword_help'))" maxlength="10"/>
              <span id="retypenewpassword_help" class="helpText"></span>
            </p>
            </fieldset>
            <p>
			<br />
              <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="submit" class="btn btn-primary" name="submit" value="Change Password">
            </p>
        </form>
      <?php
		} else {
			// If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
			echo '<p>You must login to view this page. <a href="login.php">Login</a></p>';
		}
	  ?>
      </div>
    </div>
	
    <div id="content_footer"></div>
    <?php include("include/footer.php");?>
  </div>
</body>
</html>
