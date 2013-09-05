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
		$firstName = mysqli_real_escape_string($dbc, trim($_POST['firstName']));
		$otherNames = mysqli_real_escape_string($dbc, trim($_POST['otherNames']));
		$lastName = mysqli_real_escape_string($dbc, trim($_POST['lastName']));
		$dateOfBirth = mysqli_real_escape_string($dbc, trim($_POST['dateOfBirth']));
		$contactAddress = mysqli_real_escape_string($dbc, trim($_POST['contactAddress']));
		$currentGrade = mysqli_real_escape_string($dbc, trim($_POST['currentGrade']));
		
		$guardianName = mysqli_real_escape_string($dbc, trim($_POST['guardianName']));
		$guardianTelephoneNumber = mysqli_real_escape_string($dbc, trim($_POST['guardianTelephoneNumber']));
		$guardianContactAddress = mysqli_real_escape_string($dbc, trim($_POST['guardianContactAddress']));
		
		// Insert the new admin user data in to the database
		if (!empty($firstName) && !empty($lastName) && !empty($dateOfBirth) && !empty($contactAddress) && !empty($currentGrade)) {
			
			$query = "INSERT INTO student (firstName, lastName, dateOfBirth, contactAddress, currentGrade, sponsorshipProgress, guardianName, guardianTelephoneNumber, guardianContactAddress) VALUES ('$firstName', '$lastName', '$dateOfBirth', '$contactAddress', '$currentGrade', '00', '$guardianName', '$guardianTelephoneNumber', '$guardianContactAddress')";
			
			mysqli_query($dbc, $query);
	
			// Confirm success with the Admin
			$error_msg = 'The new Student has been added.';
			  mysqli_close($dbc);
		  } else {
			$error_msg = 'You must enter all of the data.';
		  }
	  }
}
?>

<!DOCTYPE HTML>
<html>

<head>
  <title>Add Student | Enlighten Admin</title>
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
      <h1>Add Student</h1>
      
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
      
            <fieldset class="row2">
            <legend>Student Details</legend>
            <p>
              <label for="firstName">First Name *</label>
              <input type="text" class="long" id="firstName" name="firstName" onBlur="validateNonEmpty(this, document.getElementById('firstName_help'))" value="<?php if (!empty($firstName)) echo $firstName; ?>"/>
              <span id="firstName_help" class="helpText"></span>
            </p>
            <p>
              <label for="otherNames">Other Name *</label>
              <input type="text" class="long" id="otherNames" name="otherNames" value="<?php if (!empty($otherNames)) echo $otherNames; ?>"/>
            </p>
            <p>
              <label for="lastName">Last Name *</label>
              <input type="text" class="long" id="lastName" name="lastName" onBlur="validateNonEmpty(this, document.getElementById('firstName_help'))" value="<?php if (!empty($lastName)) echo $lastName; ?>"/>
              <span id="lastName_help" class="helpText"></span>
            </p>
            <p>
              <label for="dateOfBirth">Date Of Birth *</label>
              <input type="text" class="long" maxlength="10" id="dateOfBirth" name="dateOfBirth" value="<?php if (!empty($dateOfBirth)) echo $dateOfBirth; ?>"/>
              <span id="dateOfBirth_help" class="helpText"></span>
            </p>
            <p>
              <label for="contactAddress">Contact Address *</label>
              <textarea rows="2" cols="35" id="contactAddress" name="contactAddress" onBlur="validateNonEmpty(this, document.getElementById('contactAddress_help'))"><?php if (!empty($contactAddress)) echo $contactAddress; ?></textarea>
              <span id="contactAddress_help" class="helpText"></span>
            </p>
            <p>
              <label for="currentGrade">Current Grade *</label>
              <select id="currentGrade" name="currentGrade">
                  <option value="1" <?php if (!empty($currentGrade) && $currentGrade == '1') echo 'selected = "selected"'; ?>>Grade 1</option>                  
                  <option value="2" <?php if (!empty($currentGrade) && $currentGrade == '2') echo 'selected = "selected"'; ?>>Grade 2</option>
                  <option value="3" <?php if (!empty($currentGrade) && $currentGrade == '3') echo 'selected = "selected"'; ?>>Grade 3</option>                  
                  <option value="4" <?php if (!empty($currentGrade) && $currentGrade == '4') echo 'selected = "selected"'; ?>>Grade 4</option>
                  <option value="5" <?php if (!empty($currentGrade) && $currentGrade == '5') echo 'selected = "selected"'; ?>>Grade 5</option>                  
                  <option value="6" <?php if (!empty($currentGrade) && $currentGrade == '6') echo 'selected = "selected"'; ?>>Grade 6</option>
                  <option value="7" <?php if (!empty($currentGrade) && $currentGrade == '7') echo 'selected = "selected"'; ?>>Grade 7</option>                  
                  <option value="8" <?php if (!empty($currentGrade) && $currentGrade == '8') echo 'selected = "selected"'; ?>>Grade 8</option>
                  <option value="9" <?php if (!empty($currentGrade) && $currentGrade == '9') echo 'selected = "selected"'; ?>>Grade 9</option>                  
                  <option value="10" <?php if (!empty($currentGrade) && $currentGrade == '10') echo 'selected = "selected"'; ?>>Grade 10</option>
                  <option value="11" <?php if (!empty($currentGrade) && $currentGrade == '11') echo 'selected = "selected"'; ?>>Grade 11</option>                  
                  <option value="12" <?php if (!empty($currentGrade) && $currentGrade == '12') echo 'selected = "selected"'; ?>>Grade 12</option>
              </select>
            </p>
            </fieldset>
            <fieldset class="row2">
            <legend>Guardian Details</legend>
            <p>
              <label for="guardianName">Guardian's Name</label>
              <input type="text" class="long" id="guardianName" name="guardianName" value="<?php if (!empty($guardianName)) echo $guardianName; ?>"/>
            </p>
            <p>
              <label for="guardianTelephoneNumber">Guardian's Telephone Number</label>
              <input type="text" class="long" id="guardianTelephoneNumber" name="guardianTelephoneNumber" value="<?php if (!empty($guardianTelephoneNumber)) echo $guardianTelephoneNumber; ?>"/>
            </p>
            <p>
                    <label for="guardianContactAddress">Guardian's Contact Address </label>
                    <textarea rows="2" cols="35" id="guardianContactAddress" name="guardianContactAddress"><?php if (!empty($guardianContactAddress)) echo $guardianContactAddress; ?></textarea>
            </p>
            <p>
              <input class="short" type="hidden" id="studentID" name="studentID" value="<?php if (!empty($studentID)) echo $studentID; ?>"/>
            </p>
            <p>
            <br />
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
					echo '<p class="error_message">You do not have sufficient privileges to add a new Sponsor</p>';
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
