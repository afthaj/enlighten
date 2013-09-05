<?php
  require_once('constants/connectvars.php');

  session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['adminID'])) {
    if (isset($_COOKIE['adminID']) && isset($_COOKIE['username'])) {
      $_SESSION['adminID'] = $_COOKIE['adminID'];
      $_SESSION['username'] = $_COOKIE['username'];
	  $_SESSION['firstname'] = $_COOKIE['firstName'];
	  $_SESSION['lastname'] = $_COOKIE['lastName'];
	  $_SESSION['privilegeLevel'] = $_COOKIE['privilegeLevel'];
    }
  } else {
	  
	  $_SESSION['adminID'] = $_COOKIE['adminID'];
      $_SESSION['username'] = $_COOKIE['username'];
	  $_SESSION['firstname'] = $_COOKIE['firstName'];
	  $_SESSION['lastname'] = $_COOKIE['lastName'];
	  $_SESSION['privilegeLevel'] = $_COOKIE['privilegeLevel'];
	  
	  // Connect to the database
	  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	  if (isset($_POST['submit'])) {
		// Grab the profile data from the POST
		$old_password = mysqli_real_escape_string($dbc, trim($_POST['oldpassword']));
		$new_password = mysqli_real_escape_string($dbc, trim($_POST['newpassword']));
		$retype_new_password = mysqli_real_escape_string($dbc, trim($_POST['retypenewpassword']));
		
		if (!empty($old_password) && !empty($new_password) && !empty($retype_new_password)) {
			
			if ($new_password == $retype_new_password) {
				
				$query2 = "SELECT * FROM admin WHERE adminID = '" . $_SESSION['adminID'] . "' AND password = SHA('$old_password')";
				$data2 = mysqli_query($dbc, $query2);
				$result2 = mysqli_fetch_array($data2);
				
				if($result2 != NULL){
					
					$query = "UPDATE admin SET password = SHA('$new_password') WHERE adminID = '" . $_SESSION['adminID'] . "'";
					mysqli_query($dbc, $query);
					// Confirm success with the user
					$error_msg = 'Your password has been successfully updated. Would you like to <a href="adminViewAndEditProfile.php">view</a> your profile?';
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
  <title>Change Password | UAS Admin</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
  <link rel="stylesheet" type="text/css" href="css/applicationForm.css" />
  
  <script src="js/formscripts.js"></script>
  
<script language="JavaScript" type="text/javascript">
var d=new Date();
var monthname=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
//Ensure correct for language. English is "January 1, 2004"
var TODAY = monthname[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear();
</script>

</head>

<body>
  <div id="main">
    <div id="header">
      <div id="logo">
		<p>
		<?php 
                if (isset($_SESSION['adminID'])) {
                    echo '<p id="loginIndicator">You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' | <a href="logout.php">Log Out</a></p>';
                    } else {
                        echo '<p id="loginIndicator">You are not currently logged in. | <a href="adminLogin.php">Login</a></p>';
                        }
          ?>
          </p>
        <div id="logo_text">
          <?php
          require_once('constants/headerconstants.php');
          
          echo '<img src="' . ADMINNAME . '">';
		  echo '<br />';
          echo '<img src="' . TAGLINE . '">';
          ?>
          <h5>
			<script language="JavaScript" type="text/javascript">document.write(TODAY);</script>
          </h5>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <li><a href="adminIndex.php">Admin Home</a></li>
          <li><a href="adminAdminUsers.php">Admin Users</a></li>
          <li><a href="adminSponsors.php">Sponsors</a></li>
          <li><a href="adminStudents.php">Students</a></li>
          <li><a href="adminPendingSponsorships.php">Pending Sponsorships</a></li>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">      
      <div id="content">
      
      <h1>Change Password</h1>

		<?php
			// Confirm the successful log-in
			if (isset($_SESSION['adminID'])) {
				
				echo '<p>You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <a href="logout.php">Log Out</a> - <a href="adminViewAndEditProfile.php">Back to View/Edit Profile</a></p>';
			
				if (!empty($error_msg)){
						echo '<p class="error_message">' . $error_msg . '</p>';
						}
		?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="register" name="adminChangePasswordForm" id="adminChangePasswordForm">
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
              <input type="submit" name="submit" value="Change Password">
            </p>
        </form>
      <?php
		} else {
			// If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
			echo '<p>You must login to view this page. <a href="adminLogin.php">Login</a></p>';
		}
	  ?>
      </div>
    </div>
	
    <div id="content_footer"></div>
    <div id="footer">
    <?php
	require_once('constants/footerconstants.php');
	
	echo '<p align="center">' . COPYRIGHT1 . '</p>';
	echo '<p align="center">' . COPYRIGHT2 . '</p>';
	?>
    </div>
  </div>
</body>
</html>
