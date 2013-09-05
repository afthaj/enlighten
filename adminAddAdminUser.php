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
		$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
		$password = mysqli_real_escape_string($dbc, trim($_POST['password']));
		
		$title = mysqli_real_escape_string($dbc, trim($_POST['title']));
		$firstName = mysqli_real_escape_string($dbc, trim($_POST['firstName']));
		$lastName = mysqli_real_escape_string($dbc, trim($_POST['lastName']));
		$nationalID = mysqli_real_escape_string($dbc, trim($_POST['nationalID']));
		$emailAddress = mysqli_real_escape_string($dbc, trim($_POST['emailAddress']));
		
		$privilegeLevel = mysqli_real_escape_string($dbc, trim($_POST['privilegeLevel']));
		
		// Insert the new admin user data in to the database
		if (!empty($username) && !empty($password) && !empty($firstName) && !empty($lastName) && !empty($nationalID) && !empty($emailAddress) && !empty($privilegeLevel)) {
			
			$query = "INSERT INTO admin (username, password, joinDate, title, firstName, lastName, nationalID, emailAddress, privilegeLevel) VALUES ('$username', SHA('$password'), NOW(), '$title', '$firstName', '$lastName', '$nationalID', '$emailAddress', '$privilegeLevel')";
			
			mysqli_query($dbc, $query);
			
			  // Code to send the email
			  $to = $emailAddress;
			  $subject = 'You have been added as an Admin User for Enlighten';
			  $msg = "Dear $firstName $lastName.\n\nYou have been added as an Admin User in the Enlighten Sponsorship System.\n\nYour Username is:  $username.\nYour Password is:  $password.\n\nPlease keep this information with you and use it to login to the Enlighten Admin Panel.";
			  
			  mail($to, $subject, $msg, 'From: Enlighten Admin');
	
			// Confirm success with the user
			$error_msg = 'The new Admin User has been added.';
			  mysqli_close($dbc);
		  } else {
			$error_msg = 'You must enter all of the profile data.';
		  }
	  }
}
?>

<!DOCTYPE HTML>
<html>

<head>
  <title>Add Admin User | UAS Admin</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
  <link rel="stylesheet" type="text/css" href="css/applicationForm.css" />
  
  <script src="js/formscripts.js"></script>
  <script type="text/javascript" src="js/jquery-1.4.2.js"></script>
  
  <script language="JavaScript" type="text/javascript">
//--------------- LOCALIZEABLE GLOBALS ---------------
var d=new Date();
var monthname=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
//Ensure correct for language. English is "January 1, 2004"
var TODAY = monthname[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear();
//---------------   END LOCALIZEABLE   ---------------
</script>

</head>

<body>
  <div id="main">
    <div id="header">
      <div id="logo">
      	<p>
		<?php 
                if (isset($_SESSION['adminID'])) {
                    echo '<p id="loginIndicator">You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' | <a href="logout.php">Log Out</a> | <a href="adminViewAndEditProfile.php">View Profile</a></p>';
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
      <h1>Add Admin User</h1>
      
     <?php
			// If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
			if (isset($_SESSION['adminID'])) {
				
				if ($_SESSION['privilegeLevel'] == "01") {
				
					echo '<p>You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <a href="logout.php">Log Out</a></p>';
					
					if (!empty($error_msg)){
						echo '<p class="error_message">' . $error_msg . '</p>';
						}
	  ?>
      <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" class="register" id="adminAddAdminUserForm" name="adminAddAdminUserForm">
      <fieldset class="row3">
      <legend>Log In Details</legend>
        <p>
          <label for="username">User Name *</label>
          <input type="text" class="long" id="username" name="username" onBlur="validateNonEmpty(this, document.getElementById('username_help'))" value="<?php if (!empty($username)) echo $username; ?>"/>
          <span id="username_help" class="helpText"></span>
        </p>
        <p>
          <label for="password">Password *</label>
          <input type="text" class="long" id="password" name="password" onBlur="validateNonEmpty(this, document.getElementById('password_help'))"/>
          <span id="password_help" class="helpText"></span>
        </p>
      </fieldset>
            <fieldset class="row2">
            <legend>Personal Details</legend>
            <p>
              <label for="title">Title</label>
              <select id="title" name="title">
                  <option value="Mr" <?php if (!empty($title) && $title == 'Mr') echo 'selected = "selected"'; ?>>Mr</option>
                  <option value="Rev" <?php if (!empty($title) && $title == 'Rev') echo 'selected = "selected"'; ?>>Rev</option>
                  <option value="Mrs" <?php if (!empty($title) && $title == 'Mrs') echo 'selected = "selected"'; ?>>Mrs</option>
                  <option value="Miss" <?php if (!empty($title) && $title == 'Miss') echo 'selected = "selected"'; ?>>Miss</option>
                  <option value="Ms" <?php if (!empty($title) && $title == 'Ms') echo 'selected = "selected"'; ?>>Ms</option>
              </select>
            </p>
            <p>
              <label for="firstName">First Name *</label>
              <input type="text" class="long" id="firstName" name="firstName" onBlur="validateNonEmpty(this, document.getElementById('firstName_help'))" value="<?php if (!empty($firstName)) echo $firstName; ?>"/>
              <span id="firstName_help" class="helpText"></span>
            </p>
            <p>
              <label for="lastName">Last Name *</label>
              <input type="text" class="long" id="lastName" name="lastName" onBlur="validateNonEmpty(this, document.getElementById('firstName_help'))" value="<?php if (!empty($lastName)) echo $lastName; ?>"/>
              <span id="lastName_help" class="helpText"></span>
            </p>
            <p>
              <label for="nationalID">NIC Number *</label>
              <input type="text" class="long" maxlength="10" id="nationalID" onBlur="validateNICNumber(this, document.getElementById('nationalID_help'))" name="nationalID" value="<?php if (!empty($nationalID)) echo $nationalID; ?>"/>
              <span id="nationalID_help" class="helpText"></span>
            </p>
            <p>
                <label for="emailAddress">Email Address *</label>
                <input class="short" type="text" id="emailAddress" name="emailAddress" onBlur="validateEmail(this, document.getElementById('emailAddress_help'))" value="<?php if (!empty($emailAddress)) echo $emailAddress; ?>"/>
                <span id="emailAddress_help" class="helpText"></span>
            </p>
            <p>
            <br />
            </p>
            <p>
              <label for="privilegeLevel">Privilege Level *</label>
              <select id="privilegeLevel" name="privilegeLevel">
                  <option value="01" <?php if (!empty($privilegeLevel) && $privilegeLevel == '01') echo 'selected = "selected"'; ?>>Enlighten Administrator</option>                  
                  <option value="02" <?php if (!empty($privilegeLevel) && $privilegeLevel == '02') echo 'selected = "selected"'; ?>>Data Entry Operator</option>
              </select>
            </p>
            </fieldset>
			<p>
			<br />
			<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			<input name="submit" id="submit" type="submit" value="Add User" />
			<input name="cancel" id="cancel" type="button" value="Cancel" />
			</p>
      </form>
      <?php
				} else {
					echo '<p class="error_message">You do not have sufficient privileges to add a new Admin User</p>';
					}
		} else {
			// If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
			echo '<p>You must login to view this page - <a href="adminLogin.php">Login</a></p>';
		}
	  ?>
      </div>
    </div>
	
    <div id="content_footer"></div>
    <div id="footer">
    <?php
	require_once('constants/footerconstants.php');
	
	echo '<p align=center>' . COPYRIGHT1 . '</p>';
	echo '<p align=center>' . COPYRIGHT2 . '</p>';
	?>
    </div>
  </div>
</body>
</html>
