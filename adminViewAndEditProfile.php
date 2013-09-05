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
		$title = mysqli_real_escape_string($dbc, trim($_POST['title']));
		$firstName = mysqli_real_escape_string($dbc, trim($_POST['firstName']));
		$otherNames = mysqli_real_escape_string($dbc, trim($_POST['otherNames']));
		$lastName = mysqli_real_escape_string($dbc, trim($_POST['lastName']));
		$nationalID = mysqli_real_escape_string($dbc, trim($_POST['nationalID']));
		$gender = mysqli_real_escape_string($dbc, trim($_POST['gender']));
		$contactAddress = mysqli_real_escape_string($dbc, trim($_POST['contactAddress']));
		$telephoneNumber = mysqli_real_escape_string($dbc, trim($_POST['telephoneNumber']));
		$emailAddress = mysqli_real_escape_string($dbc, trim($_POST['emailAddress']));
		
		// Update the profile data in the database
		
		if (!empty($firstName) && !empty($lastName)) {
			
			$query = "UPDATE admin SET title = '$title',  firstName = '$firstName', otherNames = '$otherNames', lastName = '$lastName', nationalID = '$nationalID', gender = '$gender', contactAddress = '$contactAddress', telephoneNumber = '$telephoneNumber', emailAddress = '$emailAddress' WHERE adminID = '" . $_SESSION['adminID'] . "'";
			
			mysqli_query($dbc, $query);
  
			// Confirm success with the user
			$error_msg = 'Your profile has been successfully updated. Would you like to <a href="adminViewAndEditProfile.php">view</a> your profile?';
			mysqli_close($dbc);
			} else {
				$error_msg = 'You must enter all of the profile data.';
				}
		
	  } 
	  // End of check for form submission
	  else {
		// Grab the profile data from the database
		$query = "SELECT * FROM admin WHERE adminID ='" . $_SESSION['adminID'] . "'";
		$data = mysqli_query($dbc, $query);
		$row = mysqli_fetch_array($data);
	
		if ($row != NULL) {
			
			$error_msg = '';
			
			$title = $row['title'];
			$firstName = $row['firstName'];
			$otherNames = $row['otherNames'];
			$lastName = $row['lastName'];
			$nationalID = $row['nationalID'];
			$gender = $row['gender'];
			$contactAddress = $row['contactAddress'];
			$telephoneNumber = $row['telephoneNumber'];
			$emailAddress = $row['emailAddress'];
		} else {
		  $error_msg = 'There was a problem accessing your profile.';
		}
		mysqli_close($dbc);
	  }
	}
?>

<!DOCTYPE HTML>
<html>

<head>
  <title>View and Edit Profile | Enlighten Admin</title>
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
      <h1>View and Edit Profile</h1>
      
     <?php
			// If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
			if (isset($_SESSION['adminID'])) {
				
				echo '<p>You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <a href="logout.php">Log Out</a></p>';
				
				if (!empty($error_msg)){
					echo '<p class="error_message">' . $error_msg . '</p>';
					}
	  ?>
      <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" class="register" id="editProfileForm" name="editProfileForm">
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
                    <label for="firstName">First Name</label>
                    <input type="text" class="long" id="firstName" name="firstName" onBlur="validateNonEmpty(this, document.getElementById('firstName_help'))" value="<?php if (!empty($firstName)) echo $firstName; ?>"/>
                    <span id="firstName_help" class="helpText"></span>
            </p>
            <p>
                    <label for="otherNames">Other Names</label>
                    <input type="text" class="long" id="otherNames" name="otherNames" value="<?php if (!empty($otherNames)) echo $otherNames; ?>"/>
            </p>
            <p>
                    <label for="lastName">Last Name</label>
                    <input type="text" class="long" id="lastName" name="lastName" onBlur="validateNonEmpty(this, document.getElementById('firstName_help'))" value="<?php if (!empty($lastName)) echo $lastName; ?>"/>
                    <span id="lastName_help" class="helpText"></span>
            </p>
            <p>
                    <label for="nationalID">NIC Number</label>
                    <input type="text" class="long" maxlength="10" id="nationalID" onBlur="validateNICNumber(this, document.getElementById('nationalID_help'))" name="nationalID" value="<?php if (!empty($nationalID)) echo $nationalID; ?>"/>
                    <span id="nationalID_help" class="helpText"></span>
            </p>
            <p>
                <label for="gender">Gender</label>
                <select name="gender" id="gender">
                <option value="M" <?php if (!empty($gender) && $gender == 'M') echo 'selected = "selected"'; ?>>Male</option>
                <option value="F" <?php if (!empty($gender) && $gender == 'F') echo 'selected = "selected"'; ?>>Female</option>
            </select>
            </p>
            <p>
                    <label for="contactAddress">Contact Address </label>
                    <textarea rows="2" cols="35" id="contactAddress" name="contactAddress" onBlur="validateNonEmpty(this, document.getElementById('contactAddress_help'))"><?php if (!empty($contactAddress)) echo $contactAddress; ?></textarea>
                    <span id="contactAddress_help" class="helpText"></span>
            </p>
            <p>
                <label for="telephoneNumber">Telephone Number</label>
                <input class="short" type="text" maxlength="13" id="telephoneNumber" name="telephoneNumber" onBlur="validatePhoneNumber(this, document.getElementById('telephoneNumber_help'))" value="<?php if (!empty($telephoneNumber)) echo $telephoneNumber; ?>"/>
                <span id="telephoneNumber_help" class="helpText"></span>
            </p>
            <p>
                <label for="emailAddress">Email Address</label>
                <input class="short" type="text" id="emailAddress" name="emailAddress" onBlur="validateEmail(this, document.getElementById('emailAddress_help'))" value="<?php if (!empty($emailAddress)) echo $emailAddress; ?>"/>
                <span id="emailAddress_help" class="helpText"></span>
            </p>
            </fieldset>
            <fieldset class="row3">
            <legend>Log In Details</legend>
            <p>
            <ul>
            	<li>If you want to change your password click <a href="adminChangePassword.php">here</a>.</li>
            </ul>
            </p>
            </fieldset>
			<p>
			<br />
			<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			<input name="submit" id="submit" type="submit" value="Edit Profile" />
			<input name="cancel" id="cancel" type="button" value="Cancel" />
			</p>
      </form>
      <?php
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
