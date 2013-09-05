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
    }
  } else {
	  $_SESSION['adminID'] = $_COOKIE['adminID'];
      $_SESSION['username'] = $_COOKIE['username'];
	  $_SESSION['firstname'] = $_COOKIE['firstName'];
	  $_SESSION['lastname'] = $_COOKIE['lastName'];
	  
	  // Connect to the database
	  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	  if (isset($_GET['sponsorshipID'])) {
		  $sponsorshipID = $_GET['sponsorshipID'];
		  
		  $query = "SELECT * FROM student AS st, sponsorship AS sps WHERE sps.studentID = st.studentID AND sponsorshipID = '$sponsorshipID'";
		  
		  $data = mysqli_query($dbc, $query);
		  $row = mysqli_fetch_array($data);
		  
		  if ($row != NULL) {
			  
			  $studentID = $row['studentID'];
			  
			  $studentfirstName = $row['firstName'];
			  $studentotherNames = $row['otherNames'];
			  $studentlastName = $row['lastName'];
			  $dateOfBirth = $row['dateOfBirth'];
			  $studentcontactAddress = $row['contactAddress'];
			  $currentGrade = $row['currentGrade'];
			  
			  }
		  mysqli_close($dbc);
		  
		  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			  
		  $query2 = "SELECT * FROM sponsorship AS sps, sponsor AS sp WHERE sps.sponsorID = sp.sponsorID AND sponsorshipID = '$sponsorshipID'";
		  
		  $data2 = mysqli_query($dbc, $query2);
		  $row2 = mysqli_fetch_array($data2);
		  
		  if ($row2 != NULL) {
			  
			  $title = $row2['title'];
			  $sponsorfirstName = $row2['firstName'];
			  $sponsorlastName = $row2['lastName'];
			  $gender = $row2['gender'];
			  $sponsorcontactAddress = $row2['contactAddress'];
			  $emailAddress = $row2['emailAddress'];
			  $telephoneNumber1 = $row2['telephoneNumber1'];
			  $telephoneNumber2 = $row2['telephoneNumber2'];
			  
			  }
		  }
	  
	  if (isset($_POST['submit'])) {
			
			$studentID = $_POST['studentID'];
			$sponsorshipID = $_POST['sponsorshipID'];
			
			$query = "UPDATE sponsorship SET progress = '02' WHERE sponsorshipID = '$sponsorshipID'";
			mysqli_query($dbc, $query) or die('Error querying database.');
			
			$query3 = "UPDATE student SET sponsorshipProgress = '02' WHERE studentID = '$studentID'";
			mysqli_query($dbc, $query3) or die('Error querying database.');
			
			// Code to send the email
			$query4 = "SELECT * FROM sponsor AS sp, sponsorship AS sps WHERE sp.sponsorID = sps.sponsorID AND sponsorshipID = '$sponsorshipID'";
			$data4 = mysqli_query($dbc, $query4);
			$row4 = mysqli_fetch_array($data4);
			
			$firstName = $row4['firstName'];
			$lastName = $row4['lastName'];
			$emailAddress = $row4['emailAddress'];
			
			$to = $emailAddress;
			$subject = 'Your Sponsorship Request has been approved';
			$msg = "Dear $firstName $lastName.\n\nYour sponsorship request has been approved. Please log in to the system to check the details of the request and to check further details of the sponsorship process.\n\nThank you for your generosity in making a child's dream of education a reality.";
			
			mail($to, $subject, $msg, 'From: Enlighten Admin');
			
			$error_msg = 'The Sponsorship Request has been approved.';
			mysqli_close($dbc);
			
		  }
  }
?>

<!DOCTYPE HTML>
<html>

<head>
  <title>View Sponsorship | Enlighten</title>
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
                    echo '<p id="loginIndicator">You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' | <a href="logout.php">Log Out</a> | <a href="sponsorViewAndEditProfile.php">View Profile</a></p>';
                    } else {
                        echo '<p id="loginIndicator">You are not currently logged in. | <a href="login.php">Login</a></p>';
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
      <h1>View Sponsorship Details</h1>
      
     <?php
	  if (isset($_SESSION['adminID'])) {
		  
			  echo '<p>You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <a href="logout.php">Log Out</a></p>';
			  
			  if (!empty($error_msg)){
				  echo '<p class="error_message">' . $error_msg . '</p>';
				  }
	  ?>
      <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" class="register" id="adminAddAdminUserForm" name="adminAddAdminUserForm">
            <fieldset class="row2">
            <legend>Student Details</legend>
            <p>
              <label for="studentfirstName">First Name</label>
              <input type="text" class="long" id="studentfirstName" name="studentfirstName" value="<?php if (!empty($studentfirstName)) echo $studentfirstName; ?>" readonly="readonly"/>
            </p>
            <p>
              <label for="studentotherNames">Other Names</label>
              <input type="text" class="long" id="studentotherNames" name="studentotherNames" value="<?php if (!empty($studentotherNames)) echo $studentotherNames; ?>" readonly="readonly"/>
            </p>
            <p>
              <label for="studentlastName">Last Name</label>
              <input type="text" class="long" id="studentlastName" name="studentlastName" value="<?php if (!empty($studentlastName)) echo $studentlastName; ?>" readonly="readonly"/>
            </p>
            <p>
                    <label for="studentcontactAddress">Contact Address </label>
                    <textarea rows="2" cols="35" id="studentcontactAddress" name="studentcontactAddress" readonly="readonly"><?php if (!empty($studentcontactAddress)) echo $studentcontactAddress; ?></textarea>
            </p>
            <p>
                <label for="dateOfBirth">Date of Birth</label>
                <input type="text" id="dateOfBirth" name="dateOfBirth" size="11" maxlength="10" value="<?php if (!empty($dateOfBirth)) echo $dateOfBirth; ?>" readonly="readonly"/>
            </p>
            <p>
                <label for="currentGrade">Current Grade</label>
                <input type="text" id="currentGrade" name="currentGrade" size="11" maxlength="10" value="<?php if (!empty($currentGrade)) echo $currentGrade; ?>" readonly="readonly"/>
            </p>
            <p>
              <input class="short" type="hidden" id="studentID" name="studentID" value="<?php if (!empty($studentID)) echo $studentID; ?>"/>
            </p>
            <p>
              <input class="short" type="hidden" id="sponsorshipID" name="sponsorshipID" value="<?php if (!empty($sponsorshipID)) echo $sponsorshipID; ?>"/>
            </p>
            </fieldset>
            <fieldset class="row2">
            <legend>Sponsor Details</legend>
            <p>
              <label for="title">Title</label>
              <select id="title" name="title" readonly="readonly">
                  <option value="Mr" <?php if (!empty($title) && $title == 'Mr') echo 'selected = "selected"'; ?>>Mr</option>
                  <option value="Rev" <?php if (!empty($title) && $title == 'Rev') echo 'selected = "selected"'; ?>>Rev</option>
                  <option value="Mrs" <?php if (!empty($title) && $title == 'Mrs') echo 'selected = "selected"'; ?>>Mrs</option>
                  <option value="Miss" <?php if (!empty($title) && $title == 'Miss') echo 'selected = "selected"'; ?>>Miss</option>
                  <option value="Ms" <?php if (!empty($title) && $title == 'Ms') echo 'selected = "selected"'; ?>>Ms</option>
              </select>
            </p>
            <p>
              <label for="sponsorfirstName">First Name</label>
              <input type="text" class="long" id="sponsorfirstName" name="sponsorfirstName" value="<?php if (!empty($sponsorfirstName)) echo $sponsorfirstName; ?>" readonly="readonly"/>
            </p>
            <p>
              <label for="sponsorlastName">Last Name</label>
              <input type="text" class="long" id="sponsorlastName" name="sponsorlastName" value="<?php if (!empty($sponsorlastName)) echo $sponsorlastName; ?>" readonly="readonly"/>
            </p>
            <p>
                <label for="gender">Gender</label>
                <select name="gender" id="gender" readonly="readonly">
                <option value="M" <?php if (!empty($gender) && $gender == 'M') echo 'selected = "selected"'; ?>>Male</option>
                <option value="F" <?php if (!empty($gender) && $gender == 'F') echo 'selected = "selected"'; ?>>Female</option>
            </select>
            </p>
            <p>
                    <label for="sponsorcontactAddress">Contact Address</label>
                    <textarea rows="2" cols="35" id="sponsorcontactAddress" name="sponsorcontactAddress" readonly="readonly"><?php if (!empty($sponsorcontactAddress)) echo $sponsorcontactAddress; ?></textarea>
            </p>
            <p>
                <label for="emailAddress">Email Address</label>
                <input class="short" type="text" id="emailAddress" name="emailAddress" value="<?php if (!empty($emailAddress)) echo $emailAddress; ?>" readonly="readonly"/>
            </p>
            <p>
                <label for="telephoneNumber1">Telephone Number 1</label>
                <input class="short" type="text" maxlength="13" id="telephoneNumber1" name="telephoneNumber1" value="<?php if (!empty($telephoneNumber1)) echo $telephoneNumber1; ?>" readonly="readonly"/>
            </p>
            <p>
                <label for="telephoneNumber2">Telephone Number 2</label>
                <input class="short" type="text" maxlength="13" id="telephoneNumber2" name="telephoneNumber2" value="<?php if (!empty($telephoneNumber2)) echo $telephoneNumber2; ?>" readonly="readonly"/>
            </p>
            <p>
              <input class="short" type="hidden" id="studentID" name="studentID" value="<?php if (!empty($studentID)) echo $studentID; ?>"/>
            </p>
            </fieldset>
			<p>
			<br />
			<input type="submit" name="submit" id="submit" value="Approve Sponsorship Request" />
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
