<?php
  require_once('connectvars.php');

  session_start();
  
  // Clear the error message
  $error_msg = "";

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['applicantID'])) {
    if (isset($_COOKIE['applicantID']) && isset($_COOKIE['username'])) {
      $_SESSION['applicantID'] = $_COOKIE['applicantID'];
      $_SESSION['username'] = $_COOKIE['username'];
	  $_SESSION['firstname'] = $_COOKIE['firstName'];
	  $_SESSION['lastname'] = $_COOKIE['lastName'];
	  $_SESSION['nationalID'] = $_COOKIE['nationalID'];
	  $_SESSION['ALIndexNumber'] = $_COOKIE['ALIndexNumber'];
	  
	  $firstName = $_COOKIE['firstName'];
	  $lastName = $_COOKIE['lastName'];
	  $nationalID = $_COOKIE['nationalID'];
	  $ALIndexNumber = $_COOKIE['ALIndexNumber'];
    }
  } else {
	  $firstName = $_SESSION['firstname'];
	  $lastName = $_SESSION['lastname'];
	  $nationalID = $_SESSION['nationalID'];
	  $ALIndexNumber = $_SESSION['ALIndexNumber'];
	  
	  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if (isset($_POST['submit'])) {
	// Grab the profile data from the POST
	$title = mysqli_real_escape_string($dbc, trim($_POST['title']));
	$firstName = mysqli_real_escape_string($dbc, trim($_POST['firstName']));
	$otherNames = mysqli_real_escape_string($dbc, trim($_POST['otherNames']));
	$lastName = mysqli_real_escape_string($dbc, trim($_POST['lastName']));
	$nationalID = mysqli_real_escape_string($dbc, trim($_POST['nationalID']));
	$dateOfBirth = mysqli_real_escape_string($dbc, trim($_POST['dateOfBirth']));
	$age = mysqli_real_escape_string($dbc, trim($_POST['age']));
	$gender = mysqli_real_escape_string($dbc, trim($_POST['gender']));
	$contactAddress = mysqli_real_escape_string($dbc, trim($_POST['contactAddress']));
	$telHome = mysqli_real_escape_string($dbc, trim($_POST['telHome']));
	$telMobile = mysqli_real_escape_string($dbc, trim($_POST['telMobile']));
	$emailAddress = mysqli_real_escape_string($dbc, trim($_POST['emailAddress']));
	$adminDistrict = mysqli_real_escape_string($dbc, trim($_POST['adminDistrict']));
	$nationality = mysqli_real_escape_string($dbc, trim($_POST['nationality']));
	$race = mysqli_real_escape_string($dbc, trim($_POST['race']));
	$religion = mysqli_real_escape_string($dbc, trim($_POST['religion']));
	$ALIndexNumber = mysqli_real_escape_string($dbc, trim($_POST['ALIndexNumber']));
	$OLIndexNumber = mysqli_real_escape_string($dbc, trim($_POST['OLIndexNumber']));
	$phyDisabilityFlag = mysqli_real_escape_string($dbc, trim($_POST['phyDisabilityFlag']));
	$ALYear = mysqli_real_escape_string($dbc, trim($_POST['ALYear']));
	$OLYear = mysqli_real_escape_string($dbc, trim($_POST['OLYear']));

	$c1 = mysqli_real_escape_string($dbc, trim($_POST['c1']));
	$u1 = mysqli_real_escape_string($dbc, trim($_POST['u1']));
	$c2 = mysqli_real_escape_string($dbc, trim($_POST['c2']));
	$u2 = mysqli_real_escape_string($dbc, trim($_POST['u2']));
	$c3 = mysqli_real_escape_string($dbc, trim($_POST['c3']));
	$u3 = mysqli_real_escape_string($dbc, trim($_POST['u3']));
	$c4 = mysqli_real_escape_string($dbc, trim($_POST['c4']));
	$u4 = mysqli_real_escape_string($dbc, trim($_POST['u4']));
	$c5 = mysqli_real_escape_string($dbc, trim($_POST['c5']));
	$u5 = mysqli_real_escape_string($dbc, trim($_POST['u5']));
	$c6 = mysqli_real_escape_string($dbc, trim($_POST['c6']));
	$u6 = mysqli_real_escape_string($dbc, trim($_POST['u6']));
	$c7 = mysqli_real_escape_string($dbc, trim($_POST['c7']));
	$u7 = mysqli_real_escape_string($dbc, trim($_POST['u7']));
	$c8 = mysqli_real_escape_string($dbc, trim($_POST['c8']));
	$u8 = mysqli_real_escape_string($dbc, trim($_POST['u8']));
	$c9 = mysqli_real_escape_string($dbc, trim($_POST['c9']));
	$u9 = mysqli_real_escape_string($dbc, trim($_POST['u9']));
	$c10 = mysqli_real_escape_string($dbc, trim($_POST['c10']));
	$u10 = mysqli_real_escape_string($dbc, trim($_POST['u10']));
	$c11 = mysqli_real_escape_string($dbc, trim($_POST['c11']));
	$u11 = mysqli_real_escape_string($dbc, trim($_POST['u11']));
	$c12 = mysqli_real_escape_string($dbc, trim($_POST['c12']));
	$u12 = mysqli_real_escape_string($dbc, trim($_POST['u12']));
	$c13 = mysqli_real_escape_string($dbc, trim($_POST['c13']));
	$u13 = mysqli_real_escape_string($dbc, trim($_POST['u13']));
	$c14 = mysqli_real_escape_string($dbc, trim($_POST['c14']));
	$u14 = mysqli_real_escape_string($dbc, trim($_POST['u14']));
	$c15 = mysqli_real_escape_string($dbc, trim($_POST['c15']));
	$u15 = mysqli_real_escape_string($dbc, trim($_POST['u15']));
	$c16 = mysqli_real_escape_string($dbc, trim($_POST['c16']));
	$u16 = mysqli_real_escape_string($dbc, trim($_POST['u16']));
	$c17 = mysqli_real_escape_string($dbc, trim($_POST['c17']));
	$u17 = mysqli_real_escape_string($dbc, trim($_POST['u17']));
	$c18 = mysqli_real_escape_string($dbc, trim($_POST['c18']));
	$u18 = mysqli_real_escape_string($dbc, trim($_POST['u18']));
	$c19 = mysqli_real_escape_string($dbc, trim($_POST['c19']));
	$u19 = mysqli_real_escape_string($dbc, trim($_POST['u19']));
	$c20 = mysqli_real_escape_string($dbc, trim($_POST['c20']));
	$u20 = mysqli_real_escape_string($dbc, trim($_POST['u20']));
	
	$preference01 = $c1.$u1;
	$preference02 = $c2.$u2;
	$preference03 = $c3.$u3;
	$preference04 = $c4.$u4;
	$preference05 = $c5.$u5;
	$preference06 = $c6.$u6;
	$preference07 = $c7.$u7;
	$preference08 = $c8.$u8;
	$preference09 = $c9.$u9;
	$preference10 = $c10.$u10;
	$preference11 = $c11.$u11;
	$preference12 = $c12.$u12;
	$preference13 = $c13.$u13;
	$preference14 = $c14.$u14;
	$preference15 = $c15.$u15;
	$preference16 = $c16.$u16;
	$preference17 = $c17.$u17;
	$preference18 = $c18.$u18;
	$preference19 = $c19.$u19;
	$preference20 = $c20.$u20;
	
	if (!empty($firstName) && !empty($lastName) && !empty($nationalID) && !empty($emailAddress) && !empty($ALIndexNumber) && !empty($ALYear) && !empty($OLIndexNumber) && !empty($OLYear) && !empty($adminDistrict) && !empty($preference01)) {
	
		// Make sure this user has not submitted an application already
		$query = "SELECT * FROM application WHERE applicantID = '" . $_SESSION['applicantID'] . "'";
		$data = mysqli_query($dbc, $query);
		
		if (mysqli_num_rows($data) == 0) {
			// The user has not submitted an application previously. Therefore, the user can submit an application.
			
			// Checking to see if the ALIndexNumber and Year provided match with the Examination Department's database
			$query6 = "SELECT * FROM ALResult WHERE indexNumber = '$ALIndexNumber' AND year = '$ALYear'";
			$data2 = mysqli_query($dbc, $query6);
			$row6 = mysqli_fetch_array($data2);
			
			if ($row6 != NULL) {
				//The Information provided is correct. Therefore the user can submit the application.
				
				$query2 = "INSERT INTO application (applicantID, dateSubmitted, title, firstName, otherNames, lastName, nationalID, dateOfBirth, age, gender, contactAddress, telHome, telMobile, emailAddress, adminDistrict, nationality, race, religion, zScore, ALIndexNumber, ALYear, OLIndexNumber, OLYear, phyDisabilityFlag, numberOfAttempts, applicationProgress) VALUES ('" . $_SESSION['applicantID'] . "', NOW(), '$title', '$firstName', '$otherNames', '$lastName', '$nationalID', '$dateOfBirth', '$age', '$gender', '$contactAddress', '$telHome', '$telMobile', '$emailAddress', '$adminDistrict', '$nationality', '$race', '$religion', '" . $row6['zScore'] . "', '$ALIndexNumber', '$ALYear', '$OLIndexNumber', '$OLYear', '$phyDisabilityFlag', '" . $row6['numberOfAttempts'] . "', '01')";
				
				$query5 = "INSERT INTO preferences (ALIndexNumber, preference01, preference02, preference03, preference04, preference05, preference06, preference07, preference08, preference09, preference10, preference11, preference12, preference13, preference14, preference15, preference16, preference17, preference18, preference19, preference20) VALUES ('$ALIndexNumber', '$preference01', '$preference02', '$preference03', '$preference04', '$preference05', '$preference06', '$preference07', '$preference08', '$preference09', '$preference10', '$preference11', '$preference12', '$preference13', '$preference14', '$preference15', '$preference16', '$preference17', '$preference18', '$preference19', '$preference20')";
				
				mysqli_query($dbc, $query2);
				mysqli_query($dbc, $query5);
				
				  // Code to send the confirmation email
				  $to = $emailAddress;
				  $subject = 'Your University Application has been successfully submitted';
				  $msg = "Dear $firstName $lastName.\n\nThank you for using the University Admission System. Your application has been successfully submitted.\n\nYour Index Number is $ALIndexNumber.\n\nKindly check back with the UAS to view the outcome of the application.\n\nPlease make sure you attach the Application ID to your Supporting Documentation and submit the documents to the UGC within 10 working days of submitting the application.\n\nCAUTION: Applications without Supporting Documents will be discarded.";
				  
				  mail($to, $subject, $msg, 'From: UAS Admin');
		  
				// Confirm success with the user
				$error_msg = 'Your application has been successfully submitted. You can <a href="viewAndEditApplication.php">edit</a> the application until the submission deadline. An email has been sent to the email address you provided with important details.';
		  
				mysqli_close($dbc);
				
				} else {
					//The Information provided is NOT correct. Therefore the user can NOT submit the application.
					$error_msg = 'The AL Index Number you provided does not match with the Department of Examination Database. Please apply with a valid AL Index Number and AL Year combination';
					}
			} else {
			  // The user has already submitted an application, therefore display an error message
			  $error_msg = 'You have already submitted an application. A user can only submit one application per year. Please visit the <a href="viewAndEditApplication.php">View/Edit Application page</a> to make any necessary changes.';
			  }
		} else {
			$error_msg = 'You must enter all of the marked fields';
			}
  } else {
	  //checking to see if the user has already submitted an application
	  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	  $query = "SELECT * FROM application WHERE applicantID = '" . $_SESSION['applicantID'] . "'";
	  $data = mysqli_query($dbc, $query);
	  $row = mysqli_fetch_array($data);
	  if ($row != NULL) {
		  $applicationID = $row['applicationID'];
		  $application_error_msg = 'You have already submitted an application. A user can only submit one application per year. Please visit the <a href="viewAndEditApplication.php">View/Edit Submitted Application page</a> to make any necessary changes.';
		  } else {
			  $applicationID = '';
			  $application_error_msg = '';
			  // Check if the deadline has passed.
			  // If it has passed, don't show the application. Give an error message saying the deadline has passed.
			  // If it has not passed, show the amount of days left for the deadline.
			  
			  $query7 = "SELECT deadline, datediff(deadline, NOW()) AS days FROM deadline";
			  $data7 = mysqli_query($dbc, $query7);
			  
			  while ($row7 = mysqli_fetch_array($data7)) {
				  
				  $deadline = $row7['deadline'];
				  $days = $row7['days'];
			  
				  if ($days > 1) {
					  $deadline_error_msg1 = "Deadline - ".$deadline." - Not passed yet. $days days until deadline.";
					  } elseif ($days < 1) {
						  $deadline_error_msg2 = "The deadline has passed. You cannot submit an application now.";
						  } else {
							  $deadline_error_msg3 = "Deadline - ".$deadline." - Deadline is TODAY.";
							  }
				  }
			  }
	  }
	  
}
				
?>

<!DOCTYPE HTML>
<html>

<head>
  <title>Apply for University Entrance | UAS</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
  <link rel="stylesheet" type="text/css" href="css/applicationForm.css" />
  
  <script src="js/formscripts.js"></script>
  <script type="text/javascript" src="js/jquery-1.4.2.js"></script>
  <script type="text/javascript" src="js/formToWizard.js"></script>
  <script type="text/javascript">
      $(document).ready(function(){
          $("#applicationForm").formToWizard({ submitButton: 'submit' })
      });
  </script>
  
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
                if (isset($_SESSION['applicantID'])) {
                    echo '<p id="loginIndicator">You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' | <a href="logout.php">Log Out</a> | <a href="viewAndEditProfile.php">View Profile</a></p>';
                    } else {
                        echo '<p id="loginIndicator">You are not currently logged in. | <a href="login.php">Login</a></p>';
                        }
          ?>
          </p>
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1>UAS</h1>
          <h4>University Admission System for Undergraduate Degrees in Sri Lanka</h4>
          <!--displaying the date-->
          <h5><script language="JavaScript" type="text/javascript">document.write(TODAY);</script></h5>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li><a href="index.php">Home</a></li>
          <li><a href="signUpForm.php">Sign Up</a></li>
          <li><a href="info.php">Information on Admissions</a></li>
          <li><a href="applications.php">Applications</a></li>
          <li><a href="checkProgress.php">Check Application Progress</a></li>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
      <div id="content">
      <h1>Application for University Admission</h1>
      		<?php
			if (isset($_SESSION['applicantID'])) {
				echo '<p>You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <a href="logout.php">Log Out</a></p>';
				
				if (!empty($error_msg)){
					echo '<p class="error_message">' . $error_msg . '</p>';
					}
						
				if (empty($deadline_error_msg2) && empty($application_error_msg)) {
					
					if (!empty($deadline_error_msg1)) {
						echo '<p class="deadline_error_message1">' . $deadline_error_msg1 . '</p>';
					} elseif (!empty($deadline_error_msg3)) {
						echo '<p class="deadline_error_message2">' . $deadline_error_msg3 . '</p>';
						}
							
			  ?>
					  <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" class="register" id="applicationForm" name="applicationForm">
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
								  <label for="otherNames">Other Names</label>
								  <input type="text" id="otherNames" name="otherNames" value="<?php if (!empty($otherNames)) echo $otherNames; ?>"/>
						  </p>
						  <p>
								  <label for="lastName">Last Name *</label>
								  <input type="text" class="long" id="lastName" name="lastName" onBlur="validateNonEmpty(this, document.getElementById('lastName_help'))" value="<?php if (!empty($lastName)) echo $lastName; ?>"/>
								  <span id="lastName_help" class="helpText"></span>
						  </p>
						  <p>
								  <label for="nationalID">NIC Number *</label>
								  <input type="text" class="long" maxlength="10" id="nationalID" name="nationalID" onBlur="validateNICNumber(this, document.getElementById('nationalID_help'))" value="<?php if (!empty($nationalID)) echo $nationalID; ?>"/>
								  <span id="nationalID_help" class="helpText"></span>
						  </p>
						  <p>
							  <label for="dateOfBirth">Date of Birth</label>
							  <input type="text" id="dateOfBirth" name="dateOfBirth" onBlur="validateDate(this, document.getElementById('dateOfBirth_help'))" size="11" maxlength="10" value="<?php if (!empty($dateOfBirth)) echo $dateOfBirth; ?>"/>
							  <span id="dateOfBirth_help" class="helpText"></span>
						  </p>
						  <p>
							  <label for="age">Age </label>
							  <input type="text" class="long" maxlength="2" id="age" name="age" onBlur="validateNonEmpty(this, document.getElementById('age_help'))" value="<?php if (!empty($age)) echo $age; ?>"/>
							  <span id="age_help" class="helpText"></span>
						  </p>
						  <p>
							  <label for="gender">Gender</label>
							  <select name="gender" id="gender">
								<option value="">--Choose one--</option>
								<option value="M" <?php if (!empty($gender) && $gender == 'M') echo 'selected = "selected"'; ?>>Male</option>
								<option value="F" <?php if (!empty($gender) && $gender == 'F') echo 'selected = "selected"'; ?>>Female</option>
							  </select>
							  <span id="gender_help" class="helpText"></span>
						  </p>
						  <p>
							  <label for="contactAddress">Contact Address </label>
							  <textarea rows="2" cols="33" id="contactAddress" name="contactAddress" onBlur="validateNonEmpty(this, document.getElementById('contactAddress_help'))"><?php if (!empty($contactAddress)) echo $contactAddress; ?></textarea>
							  <span id="contactAddress_help" class="helpText"></span>
						  </p>
						  <p>
							  <label for="telHome">Telephone Number (Home)</label>
							  <input class="short" type="text" maxlength="10" id="telHome" name="telHome" onBlur="validatePhoneNumber(this, document.getElementById('telHome_help'))" value="<?php if (!empty($telHome)) echo $telHome; ?>"/>
							  <span id="telHome_help" class="helpText"></span>
						  </p>
						  <p>
							  <label for="telMobile">Telephone Number (Mobile)</label>
							  <input class="short" type="text" maxlength="10" id="telMobile" name="telMobile" onBlur="validatePhoneNumber(this, document.getElementById('telMobile_help'))" value="<?php if (!empty($telMobile)) echo $telMobile; ?>"/>
							  <span id="telMobile_help" class="helpText"></span>
						  </p>
						  <p>
							  <label for="emailAddress">Email Address *</label>
							  <input class="short" type="text" id="emailAddress" name="emailAddress" onBlur="validateEmail(this, document.getElementById('emailAddress_help'))" value="<?php if (!empty($emailAddress)) echo $emailAddress; ?>"/>
							  <span id="emailAddress_help" class="helpText"></span>
						  </p>
						  <p>
							  <label for="adminDistrict">Administrative District *</label>
							  <select name="adminDistrict" id="adminDistrict">
								  <option value="">--Choose one--</option>
								  <option value="01" <?php if (!empty($adminDistrict) && $adminDistrict == '01') echo 'selected = "selected"'; ?>>Colombo</option>
								  <option value="02" <?php if (!empty($adminDistrict) && $adminDistrict == '02') echo 'selected = "selected"'; ?>>Gampaha</option>
								  <option value="03" <?php if (!empty($adminDistrict) && $adminDistrict == '03') echo 'selected = "selected"'; ?>>Kalutara</option>
								  <option value="04" <?php if (!empty($adminDistrict) && $adminDistrict == '04') echo 'selected = "selected"'; ?>>Matale</option>
								  <option value="05" <?php if (!empty($adminDistrict) && $adminDistrict == '05') echo 'selected = "selected"'; ?>>Kandy</option>
								  <option value="06" <?php if (!empty($adminDistrict) && $adminDistrict == '06') echo 'selected = "selected"'; ?>>Nuwara Eliya</option>
								  <option value="07" <?php if (!empty($adminDistrict) && $adminDistrict == '07') echo 'selected = "selected"'; ?>>Galle</option>
							  </select>
						  </p>
						  
						  <p><br /><br /></p>
						  
						  <p>
								<label for="nationality">Nationality</label>
								<select name="nationality" id="nationality">
								  <option value="">--Choose one--</option>
								  <option value="Sri Lankan" <?php if (!empty($nationality) && $nationality == 'Sri Lankan') echo 'selected = "selected"'; ?>>Sri Lankan </option>
								  <option value="Other" <?php if (!empty($nationality) && $nationality == 'Other') echo 'selected = "selected"'; ?>>Other</option>
								</select>
						  </p>
						   <p>
							  <label for="race">Race</label>
							  <input name="race" id="race" type="text" class="long" value="<?php if (!empty($race)) echo $race; ?>"/>
						  </p>
						   <p>
								<label for="religion">Religion</label>
								<select name="religion" id="religion">
								  <option value="">--Choose one--</option>
								  <option value="Buddhism" <?php if (!empty($religion) && $religion == 'Buddhism') echo 'selected = "selected"'; ?>>Buddhism</option>
								  <option value="Christianity" <?php if (!empty($religion) && $religion == 'Christianity') echo 'selected = "selected"'; ?>>Christianity</option>
								  <option value="Islam" <?php if (!empty($religion) && $religion == 'Islam') echo 'selected = "selected"'; ?>>Islam</option>
								  <option value="Hinduism" <?php if (!empty($religion) && $religion == 'Hinduism') echo 'selected = "selected"'; ?>>Hinduism</option>
								</select>
						  </p>
						  <p>
								<label for="phyDisabilityFlag">Physically disabled?</label>
								<select name="phyDisabilityFlag" id="phyDisabilityFlag">
								  <option value="">-Choose one-</option>
								  <option value="Y" <?php if (!empty($phyDisabilityFlag) && $phyDisabilityFlag == 'Y') echo 'selected = "selected"'; ?>>Yes</option>
								  <option value="N" <?php if (!empty($phyDisabilityFlag) && $phyDisabilityFlag == 'N') echo 'selected = "selected"'; ?>>No</option>
								</select>
						  </p>
						</fieldset>
						
						<fieldset class="row4">
							<legend>A/L and O/L Information</legend>
							<p>
								<label for="ALIndexNumber">A/L Index Number *</label>
								<input name="ALIndexNumber" id="ALIndexNumber" type="text" class="short" maxlength="8" onBlur="validateALIndexNumber(this, document.getElementById('ALIndexNumber_help'))" value="<?php if (!empty($ALIndexNumber)) echo $ALIndexNumber; ?>"/>
								<span id="ALIndexNumber_help" class="helpText"></span>
							</p>
							<p>
								<label for="ALYear">A/L Year *</label>
								<input name="ALYear" id="ALYear" type="text" class="short" maxlength="4" onBlur="validateYear(this, document.getElementById('ALYear_help'))" value="<?php if (!empty($ALYear)) echo $ALYear; ?>"/> 
								<span id="ALYear_help" class="helpText"></span>
							</p>
							
							<p><br /><br /></p>
							 
							 <p>
							  <label for="OLIndexNumber">O/L Index Number *</label>
							  <input name="OLIndexNumber" id="OLIndexNumber" type="text" class="short" maxlength="10" onBlur="validateOLIndexNumber(this, document.getElementById('OLIndexNumber_help'))" value="<?php if (!empty($OLIndexNumber)) echo $OLIndexNumber; ?>"/>
							  <span id="OLIndexNumber_help" class="helpText"></span>
							</p>
							<p>
								<label for="OLYear">O/L Year *</label>
								<input name="OLYear" id="OLYear" type="text" class="short" maxlength="4" onBlur="validateYear(this, document.getElementById('OLYear_help'))" value="<?php if (!empty($OLYear)) echo $OLYear; ?>"/> 
								<span id="OLYear_help" class="helpText"></span>
							</p>
						 </p>
					  </fieldset>
					  
					  <fieldset class="row4">
					  <legend>Preference of Course of Study:</legend>
					  <p>
					  <table width="80%" border="0">
					   <tr align="center">
						 <td>No.</td>
						 <td>Course</td>
						 <td>University</td>
					   </tr>
					   <tr align="center">
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
					   </tr>
					   <tr align="center">
						 <td>1. </td>
						 <td>
						 <select name="c1" id="c1">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($c1) && $c1 == '001') echo 'selected = "selected"'; ?>>Medicine</option>
							<option value="002" <?php if (!empty($c1) && $c1 == '002') echo 'selected = "selected"'; ?>>Dental Surgery</option>
							<option value="003" <?php if (!empty($c1) && $c1 == '003') echo 'selected = "selected"'; ?>>Veterinary Science</option>
							<option value="004" <?php if (!empty($c1) && $c1 == '004') echo 'selected = "selected"'; ?>>Agriculture</option>
							<option value="005" <?php if (!empty($c1) && $c1 == '005') echo 'selected = "selected"'; ?>>Food Science and Nutrition</option>
							<option value="006" <?php if (!empty($c1) && $c1 == '006') echo 'selected = "selected"'; ?>>Biological Science</option>
							<option value="007" <?php if (!empty($c1) && $c1 == '007') echo 'selected = "selected"'; ?>>Applied Sciences - Bio.Sci</option>
							<option value="008" <?php if (!empty($c1) && $c1 == '008') echo 'selected = "selected"'; ?>>Engineering</option>
							<option value="009" <?php if (!empty($c1) && $c1 == '009') echo 'selected = "selected"'; ?>>Engineering - EM</option>
							<option value="010" <?php if (!empty($c1) && $c1 == '010') echo 'selected = "selected"'; ?>>Engineering - TM</option>
							<option value="011" <?php if (!empty($c1) && $c1 == '011') echo 'selected = "selected"'; ?>>Quantity Surveying</option>
							<option value="012" <?php if (!empty($c1) && $c1 == '012') echo 'selected = "selected"'; ?>>Computer Science</option>
							<option value="013" <?php if (!empty($c1) && $c1 == '013') echo 'selected = "selected"'; ?>>Physical Science</option>
							<option value="014" <?php if (!empty($c1) && $c1 == '014') echo 'selected = "selected"'; ?>>Surveying Science</option>
							<option value="015" <?php if (!empty($c1) && $c1 == '015') echo 'selected = "selected"'; ?>>Applied Sciences - Phy.Sci</option>
						</select>
						</td>
						 <td>
						 <select name="u1" id="u1">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($u1) && $u1 == '001') echo 'selected = "selected"'; ?>>University of Colombo</option>
							<option value="002" <?php if (!empty($u1) && $u1 == '002') echo 'selected = "selected"'; ?>>University of  Peradeniya</option>
							<option value="003" <?php if (!empty($u1) && $u1 == '003') echo 'selected = "selected"'; ?>>University of Sri Jayawardenapura</option>
							<option value="004" <?php if (!empty($u1) && $u1 == '004') echo 'selected = "selected"'; ?>>University of Kelaniya</option>
							<option value="005" <?php if (!empty($u1) && $u1 == '005') echo 'selected = "selected"'; ?>>University of Jaffna</option>
							<option value="006" <?php if (!empty($u1) && $u1 == '006') echo 'selected = "selected"'; ?>>University of Ruhuna (Matara)</option>
							<option value="007" <?php if (!empty($u1) && $u1 == '007') echo 'selected = "selected"'; ?>>University of Moratuwa</option>
							<option value="008" <?php if (!empty($u1) && $u1 == '008') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Batticaloa)</option>
							<option value="009" <?php if (!empty($u1) && $u1 == '009') echo 'selected = "selected"'; ?>>South Eastern University of Sri Lanka (Oluvil)</option>
							<option value="010" <?php if (!empty($u1) && $u1 == '010') echo 'selected = "selected"'; ?>>Rajarata University of Sri Lanka (Mihintale)</option>
							<option value="011" <?php if (!empty($u1) && $u1 == '011') echo 'selected = "selected"'; ?>>Sabaragamuwa University of Sri Lanka (Belihuloya)</option>
							<option value="012" <?php if (!empty($u1) && $u1 == '012') echo 'selected = "selected"'; ?>>Wayamba University of Sri Lanka (Kuliyapitiya)</option>
							<option value="013" <?php if (!empty($u1) && $u1 == '013') echo 'selected = "selected"'; ?>>Institute of Indigenous Medicine</option>
							<option value="014" <?php if (!empty($u1) && $u1 == '014') echo 'selected = "selected"'; ?>>Gampaha Wickramarachchi Ayurveda Institute</option>
							<option value="015" <?php if (!empty($u1) && $u1 == '015') echo 'selected = "selected"'; ?>>University of Jaffna (Vavuniya Campus)</option>
							<option value="016" <?php if (!empty($u1) && $u1 == '016') echo 'selected = "selected"'; ?>>University of Colombo (Sripalee Campus)</option>
							<option value="017" <?php if (!empty($u1) && $u1 == '017') echo 'selected = "selected"'; ?>>University of Colombo School of Computing</option>
							<option value="018" <?php if (!empty($u1) && $u1 == '018') echo 'selected = "selected"'; ?>>Uva Wellassa University of Sri Lanka (Badulla)</option>
							<option value="019" <?php if (!empty($u1) && $u1 == '019') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Trincomalee Campus)</option>
							<option value="020" <?php if (!empty($u1) && $u1 == '020') echo 'selected = "selected"'; ?>>Swami Vipulananda Institute of Aesthetic Studies (Eastern)</option>
							<option value="021" <?php if (!empty($u1) && $u1 == '021') echo 'selected = "selected"'; ?>>University of the Visual and Performing Arts</option>
						</select>
						 </td>
					   </tr>
					   <tr align="center">
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
					   </tr>
					   <tr align="center">
						 <td>2. </td>
						 <td>
						 <select name="c2" id="c2">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($c2) && $c2 == '001') echo 'selected = "selected"'; ?>>Medicine</option>
							<option value="002" <?php if (!empty($c2) && $c2 == '002') echo 'selected = "selected"'; ?>>Dental Surgery</option>
							<option value="003" <?php if (!empty($c2) && $c2 == '003') echo 'selected = "selected"'; ?>>Veterinary Science</option>
							<option value="004" <?php if (!empty($c2) && $c2 == '004') echo 'selected = "selected"'; ?>>Agriculture</option>
							<option value="005" <?php if (!empty($c2) && $c2 == '005') echo 'selected = "selected"'; ?>>Food Science and Nutrition</option>
							<option value="006" <?php if (!empty($c2) && $c2 == '006') echo 'selected = "selected"'; ?>>Biological Science</option>
							<option value="007" <?php if (!empty($c2) && $c2 == '007') echo 'selected = "selected"'; ?>>Applied Sciences - Bio.Sci</option>
							<option value="008" <?php if (!empty($c2) && $c2 == '008') echo 'selected = "selected"'; ?>>Engineering</option>
							<option value="009" <?php if (!empty($c2) && $c2 == '009') echo 'selected = "selected"'; ?>>Engineering - EM</option>
							<option value="010" <?php if (!empty($c2) && $c2 == '010') echo 'selected = "selected"'; ?>>Engineering - TM</option>
							<option value="011" <?php if (!empty($c2) && $c2 == '011') echo 'selected = "selected"'; ?>>Quantity Surveying</option>
							<option value="012" <?php if (!empty($c2) && $c2 == '012') echo 'selected = "selected"'; ?>>Computer Science</option>
							<option value="013" <?php if (!empty($c2) && $c2 == '013') echo 'selected = "selected"'; ?>>Physical Science</option>
							<option value="014" <?php if (!empty($c2) && $c2 == '014') echo 'selected = "selected"'; ?>>Surveying Science</option>
							<option value="015" <?php if (!empty($c2) && $c2 == '015') echo 'selected = "selected"'; ?>>Applied Sciences - Phy.Sci</option>
						</select>
						</td>
						 <td>
						 <select name="u2" id="u2">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($u2) && $u2 == '001') echo 'selected = "selected"'; ?>>University of Colombo</option>
							<option value="002" <?php if (!empty($u2) && $u2 == '002') echo 'selected = "selected"'; ?>>University of  Peradeniya</option>
							<option value="003" <?php if (!empty($u2) && $u2 == '003') echo 'selected = "selected"'; ?>>University of Sri Jayawardenapura</option>
							<option value="004" <?php if (!empty($u2) && $u2 == '004') echo 'selected = "selected"'; ?>>University of Kelaniya</option>
							<option value="005" <?php if (!empty($u2) && $u2 == '005') echo 'selected = "selected"'; ?>>University of Jaffna</option>
							<option value="006" <?php if (!empty($u2) && $u2 == '006') echo 'selected = "selected"'; ?>>University of Ruhuna (Matara)</option>
							<option value="007" <?php if (!empty($u2) && $u2 == '007') echo 'selected = "selected"'; ?>>University of Moratuwa</option>
							<option value="008" <?php if (!empty($u2) && $u2 == '008') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Batticaloa)</option>
							<option value="009" <?php if (!empty($u2) && $u2 == '009') echo 'selected = "selected"'; ?>>South Eastern University of Sri Lanka (Oluvil)</option>
							<option value="010" <?php if (!empty($u2) && $u2 == '010') echo 'selected = "selected"'; ?>>Rajarata University of Sri Lanka (Mihintale)</option>
							<option value="011" <?php if (!empty($u2) && $u2 == '011') echo 'selected = "selected"'; ?>>Sabaragamuwa University of Sri Lanka (Belihuloya)</option>
							<option value="012" <?php if (!empty($u2) && $u2 == '012') echo 'selected = "selected"'; ?>>Wayamba University of Sri Lanka (Kuliyapitiya)</option>
							<option value="013" <?php if (!empty($u2) && $u2 == '013') echo 'selected = "selected"'; ?>>Institute of Indigenous Medicine</option>
							<option value="014" <?php if (!empty($u2) && $u2 == '014') echo 'selected = "selected"'; ?>>Gampaha Wickramarachchi Ayurveda Institute</option>
							<option value="015" <?php if (!empty($u2) && $u2 == '015') echo 'selected = "selected"'; ?>>University of Jaffna (Vavuniya Campus)</option>
							<option value="016" <?php if (!empty($u2) && $u2 == '016') echo 'selected = "selected"'; ?>>University of Colombo (Sripalee Campus)</option>
							<option value="017" <?php if (!empty($u2) && $u2 == '017') echo 'selected = "selected"'; ?>>University of Colombo School of Computing</option>
							<option value="018" <?php if (!empty($u2) && $u2 == '018') echo 'selected = "selected"'; ?>>Uva Wellassa University of Sri Lanka (Badulla)</option>
							<option value="019" <?php if (!empty($u2) && $u2 == '019') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Trincomalee Campus)</option>
							<option value="020" <?php if (!empty($u2) && $u2 == '020') echo 'selected = "selected"'; ?>>Swami Vipulananda Institute of Aesthetic Studies (Eastern)</option>
							<option value="021" <?php if (!empty($u2) && $u2 == '021') echo 'selected = "selected"'; ?>>University of the Visual and Performing Arts</option>
						</select>
						 </td>
					   </tr>
					   <tr align="center">
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
					   </tr>
					   <tr align="center">
						 <td>3. </td>
						 <td>
						 <select name="c3" id="c3">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($c3) && $c3 == '001') echo 'selected = "selected"'; ?>>Medicine</option>
							<option value="002" <?php if (!empty($c3) && $c3 == '002') echo 'selected = "selected"'; ?>>Dental Surgery</option>
							<option value="003" <?php if (!empty($c3) && $c3 == '003') echo 'selected = "selected"'; ?>>Veterinary Science</option>
							<option value="004" <?php if (!empty($c3) && $c3 == '004') echo 'selected = "selected"'; ?>>Agriculture</option>
							<option value="005" <?php if (!empty($c3) && $c3 == '005') echo 'selected = "selected"'; ?>>Food Science and Nutrition</option>
							<option value="006" <?php if (!empty($c3) && $c3 == '006') echo 'selected = "selected"'; ?>>Biological Science</option>
							<option value="007" <?php if (!empty($c3) && $c3 == '007') echo 'selected = "selected"'; ?>>Applied Sciences - Bio.Sci</option>
							<option value="008" <?php if (!empty($c3) && $c3 == '008') echo 'selected = "selected"'; ?>>Engineering</option>
							<option value="009" <?php if (!empty($c3) && $c3 == '009') echo 'selected = "selected"'; ?>>Engineering - EM</option>
							<option value="010" <?php if (!empty($c3) && $c3 == '010') echo 'selected = "selected"'; ?>>Engineering - TM</option>
							<option value="011" <?php if (!empty($c3) && $c3 == '011') echo 'selected = "selected"'; ?>>Quantity Surveying</option>
							<option value="012" <?php if (!empty($c3) && $c3 == '012') echo 'selected = "selected"'; ?>>Computer Science</option>
							<option value="013" <?php if (!empty($c3) && $c3 == '013') echo 'selected = "selected"'; ?>>Physical Science</option>
							<option value="014" <?php if (!empty($c3) && $c3 == '014') echo 'selected = "selected"'; ?>>Surveying Science</option>
							<option value="015" <?php if (!empty($c3) && $c3 == '015') echo 'selected = "selected"'; ?>>Applied Sciences - Phy.Sci</option>
						</select>
						</td>
						 <td>
						 <select name="u3" id="u3">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($u3) && $u3 == '001') echo 'selected = "selected"'; ?>>University of Colombo</option>
							<option value="002" <?php if (!empty($u3) && $u3 == '002') echo 'selected = "selected"'; ?>>University of  Peradeniya</option>
							<option value="003" <?php if (!empty($u3) && $u3 == '003') echo 'selected = "selected"'; ?>>University of Sri Jayawardenapura</option>
							<option value="004" <?php if (!empty($u3) && $u3 == '004') echo 'selected = "selected"'; ?>>University of Kelaniya</option>
							<option value="005" <?php if (!empty($u3) && $u3 == '005') echo 'selected = "selected"'; ?>>University of Jaffna</option>
							<option value="006" <?php if (!empty($u3) && $u3 == '006') echo 'selected = "selected"'; ?>>University of Ruhuna (Matara)</option>
							<option value="007" <?php if (!empty($u3) && $u3 == '007') echo 'selected = "selected"'; ?>>University of Moratuwa</option>
							<option value="008" <?php if (!empty($u3) && $u3 == '008') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Batticaloa)</option>
							<option value="009" <?php if (!empty($u3) && $u3 == '009') echo 'selected = "selected"'; ?>>South Eastern University of Sri Lanka (Oluvil)</option>
							<option value="010" <?php if (!empty($u3) && $u3 == '010') echo 'selected = "selected"'; ?>>Rajarata University of Sri Lanka (Mihintale)</option>
							<option value="011" <?php if (!empty($u3) && $u3 == '011') echo 'selected = "selected"'; ?>>Sabaragamuwa University of Sri Lanka (Belihuloya)</option>
							<option value="012" <?php if (!empty($u3) && $u3 == '012') echo 'selected = "selected"'; ?>>Wayamba University of Sri Lanka (Kuliyapitiya)</option>
							<option value="013" <?php if (!empty($u3) && $u3 == '013') echo 'selected = "selected"'; ?>>Institute of Indigenous Medicine</option>
							<option value="014" <?php if (!empty($u3) && $u3 == '014') echo 'selected = "selected"'; ?>>Gampaha Wickramarachchi Ayurveda Institute</option>
							<option value="015" <?php if (!empty($u3) && $u3 == '015') echo 'selected = "selected"'; ?>>University of Jaffna (Vavuniya Campus)</option>
							<option value="016" <?php if (!empty($u3) && $u3 == '016') echo 'selected = "selected"'; ?>>University of Colombo (Sripalee Campus)</option>
							<option value="017" <?php if (!empty($u3) && $u3 == '017') echo 'selected = "selected"'; ?>>University of Colombo School of Computing</option>
							<option value="018" <?php if (!empty($u3) && $u3 == '018') echo 'selected = "selected"'; ?>>Uva Wellassa University of Sri Lanka (Badulla)</option>
							<option value="019" <?php if (!empty($u3) && $u3 == '019') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Trincomalee Campus)</option>
							<option value="020" <?php if (!empty($u3) && $u3 == '020') echo 'selected = "selected"'; ?>>Swami Vipulananda Institute of Aesthetic Studies (Eastern)</option>
							<option value="021" <?php if (!empty($u3) && $u3 == '021') echo 'selected = "selected"'; ?>>University of the Visual and Performing Arts</option>
						</select>
						 </td>
					   </tr>
					   <tr align="center">
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
					   </tr>
					   <tr align="center">
						 <td>4. </td>
						 <td>
						 <select name="c4" id="c4">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($c4) && $c4 == '001') echo 'selected = "selected"'; ?>>Medicine</option>
							<option value="002" <?php if (!empty($c4) && $c4 == '002') echo 'selected = "selected"'; ?>>Dental Surgery</option>
							<option value="003" <?php if (!empty($c4) && $c4 == '003') echo 'selected = "selected"'; ?>>Veterinary Science</option>
							<option value="004" <?php if (!empty($c4) && $c4 == '004') echo 'selected = "selected"'; ?>>Agriculture</option>
							<option value="005" <?php if (!empty($c4) && $c4 == '005') echo 'selected = "selected"'; ?>>Food Science and Nutrition</option>
							<option value="006" <?php if (!empty($c4) && $c4 == '006') echo 'selected = "selected"'; ?>>Biological Science</option>
							<option value="007" <?php if (!empty($c4) && $c4 == '007') echo 'selected = "selected"'; ?>>Applied Sciences - Bio.Sci</option>
							<option value="008" <?php if (!empty($c4) && $c4 == '008') echo 'selected = "selected"'; ?>>Engineering</option>
							<option value="009" <?php if (!empty($c4) && $c4 == '009') echo 'selected = "selected"'; ?>>Engineering - EM</option>
							<option value="010" <?php if (!empty($c4) && $c4 == '010') echo 'selected = "selected"'; ?>>Engineering - TM</option>
							<option value="011" <?php if (!empty($c4) && $c4 == '011') echo 'selected = "selected"'; ?>>Quantity Surveying</option>
							<option value="012" <?php if (!empty($c4) && $c4 == '012') echo 'selected = "selected"'; ?>>Computer Science</option>
							<option value="013" <?php if (!empty($c4) && $c4 == '013') echo 'selected = "selected"'; ?>>Physical Science</option>
							<option value="014" <?php if (!empty($c4) && $c4 == '014') echo 'selected = "selected"'; ?>>Surveying Science</option>
							<option value="015" <?php if (!empty($c4) && $c4 == '015') echo 'selected = "selected"'; ?>>Applied Sciences - Phy.Sci</option>
						</select>
						</td>
						 <td>
						 <select name="u4" id="u4">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($u4) && $u4 == '001') echo 'selected = "selected"'; ?>>University of Colombo</option>
							<option value="002" <?php if (!empty($u4) && $u4 == '002') echo 'selected = "selected"'; ?>>University of  Peradeniya</option>
							<option value="003" <?php if (!empty($u4) && $u4 == '003') echo 'selected = "selected"'; ?>>University of Sri Jayawardenapura</option>
							<option value="004" <?php if (!empty($u4) && $u4 == '004') echo 'selected = "selected"'; ?>>University of Kelaniya</option>
							<option value="005" <?php if (!empty($u4) && $u4 == '005') echo 'selected = "selected"'; ?>>University of Jaffna</option>
							<option value="006" <?php if (!empty($u4) && $u4 == '006') echo 'selected = "selected"'; ?>>University of Ruhuna (Matara)</option>
							<option value="007" <?php if (!empty($u4) && $u4 == '007') echo 'selected = "selected"'; ?>>University of Moratuwa</option>
							<option value="008" <?php if (!empty($u4) && $u4 == '008') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Batticaloa)</option>
							<option value="009" <?php if (!empty($u4) && $u4 == '009') echo 'selected = "selected"'; ?>>South Eastern University of Sri Lanka (Oluvil)</option>
							<option value="010" <?php if (!empty($u4) && $u4 == '010') echo 'selected = "selected"'; ?>>Rajarata University of Sri Lanka (Mihintale)</option>
							<option value="011" <?php if (!empty($u4) && $u4 == '011') echo 'selected = "selected"'; ?>>Sabaragamuwa University of Sri Lanka (Belihuloya)</option>
							<option value="012" <?php if (!empty($u4) && $u4 == '012') echo 'selected = "selected"'; ?>>Wayamba University of Sri Lanka (Kuliyapitiya)</option>
							<option value="013" <?php if (!empty($u4) && $u4 == '013') echo 'selected = "selected"'; ?>>Institute of Indigenous Medicine</option>
							<option value="014" <?php if (!empty($u4) && $u4 == '014') echo 'selected = "selected"'; ?>>Gampaha Wickramarachchi Ayurveda Institute</option>
							<option value="015" <?php if (!empty($u4) && $u4 == '015') echo 'selected = "selected"'; ?>>University of Jaffna (Vavuniya Campus)</option>
							<option value="016" <?php if (!empty($u4) && $u4 == '016') echo 'selected = "selected"'; ?>>University of Colombo (Sripalee Campus)</option>
							<option value="017" <?php if (!empty($u4) && $u4 == '017') echo 'selected = "selected"'; ?>>University of Colombo School of Computing</option>
							<option value="018" <?php if (!empty($u4) && $u4 == '018') echo 'selected = "selected"'; ?>>Uva Wellassa University of Sri Lanka (Badulla)</option>
							<option value="019" <?php if (!empty($u4) && $u4 == '019') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Trincomalee Campus)</option>
							<option value="020" <?php if (!empty($u4) && $u4 == '020') echo 'selected = "selected"'; ?>>Swami Vipulananda Institute of Aesthetic Studies (Eastern)</option>
							<option value="021" <?php if (!empty($u4) && $u4 == '021') echo 'selected = "selected"'; ?>>University of the Visual and Performing Arts</option>
						</select>
						 </td>
					   </tr>
					   <tr align="center">
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
					   </tr>
					   <tr align="center">
						 <td>5. </td>
						 <td>
						 <select name="c5" id="c5">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($c5) && $c5 == '001') echo 'selected = "selected"'; ?>>Medicine</option>
							<option value="002" <?php if (!empty($c5) && $c5 == '002') echo 'selected = "selected"'; ?>>Dental Surgery</option>
							<option value="003" <?php if (!empty($c5) && $c5 == '003') echo 'selected = "selected"'; ?>>Veterinary Science</option>
							<option value="004" <?php if (!empty($c5) && $c5 == '004') echo 'selected = "selected"'; ?>>Agriculture</option>
							<option value="005" <?php if (!empty($c5) && $c5 == '005') echo 'selected = "selected"'; ?>>Food Science and Nutrition</option>
							<option value="006" <?php if (!empty($c5) && $c5 == '006') echo 'selected = "selected"'; ?>>Biological Science</option>
							<option value="007" <?php if (!empty($c5) && $c5 == '007') echo 'selected = "selected"'; ?>>Applied Sciences - Bio.Sci</option>
							<option value="008" <?php if (!empty($c5) && $c5 == '008') echo 'selected = "selected"'; ?>>Engineering</option>
							<option value="009" <?php if (!empty($c5) && $c5 == '009') echo 'selected = "selected"'; ?>>Engineering - EM</option>
							<option value="010" <?php if (!empty($c5) && $c5 == '010') echo 'selected = "selected"'; ?>>Engineering - TM</option>
							<option value="011" <?php if (!empty($c5) && $c5 == '011') echo 'selected = "selected"'; ?>>Quantity Surveying</option>
							<option value="012" <?php if (!empty($c5) && $c5 == '012') echo 'selected = "selected"'; ?>>Computer Science</option>
							<option value="013" <?php if (!empty($c5) && $c5 == '013') echo 'selected = "selected"'; ?>>Physical Science</option>
							<option value="014" <?php if (!empty($c5) && $c5 == '014') echo 'selected = "selected"'; ?>>Surveying Science</option>
							<option value="015" <?php if (!empty($c5) && $c5 == '015') echo 'selected = "selected"'; ?>>Applied Sciences - Phy.Sci</option>
						</select>
						</td>
						 <td>
						 <select name="u5" id="u5">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($u5) && $u5 == '001') echo 'selected = "selected"'; ?>>University of Colombo</option>
							<option value="002" <?php if (!empty($u5) && $u5 == '002') echo 'selected = "selected"'; ?>>University of  Peradeniya</option>
							<option value="003" <?php if (!empty($u5) && $u5 == '003') echo 'selected = "selected"'; ?>>University of Sri Jayawardenapura</option>
							<option value="004" <?php if (!empty($u5) && $u5 == '004') echo 'selected = "selected"'; ?>>University of Kelaniya</option>
							<option value="005" <?php if (!empty($u5) && $u5 == '005') echo 'selected = "selected"'; ?>>University of Jaffna</option>
							<option value="006" <?php if (!empty($u5) && $u5 == '006') echo 'selected = "selected"'; ?>>University of Ruhuna (Matara)</option>
							<option value="007" <?php if (!empty($u5) && $u5 == '007') echo 'selected = "selected"'; ?>>University of Moratuwa</option>
							<option value="008" <?php if (!empty($u5) && $u5 == '008') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Batticaloa)</option>
							<option value="009" <?php if (!empty($u5) && $u5 == '009') echo 'selected = "selected"'; ?>>South Eastern University of Sri Lanka (Oluvil)</option>
							<option value="010" <?php if (!empty($u5) && $u5 == '010') echo 'selected = "selected"'; ?>>Rajarata University of Sri Lanka (Mihintale)</option>
							<option value="011" <?php if (!empty($u5) && $u5 == '011') echo 'selected = "selected"'; ?>>Sabaragamuwa University of Sri Lanka (Belihuloya)</option>
							<option value="012" <?php if (!empty($u5) && $u5 == '012') echo 'selected = "selected"'; ?>>Wayamba University of Sri Lanka (Kuliyapitiya)</option>
							<option value="013" <?php if (!empty($u5) && $u5 == '013') echo 'selected = "selected"'; ?>>Institute of Indigenous Medicine</option>
							<option value="014" <?php if (!empty($u5) && $u5 == '014') echo 'selected = "selected"'; ?>>Gampaha Wickramarachchi Ayurveda Institute</option>
							<option value="015" <?php if (!empty($u5) && $u5 == '015') echo 'selected = "selected"'; ?>>University of Jaffna (Vavuniya Campus)</option>
							<option value="016" <?php if (!empty($u5) && $u5 == '016') echo 'selected = "selected"'; ?>>University of Colombo (Sripalee Campus)</option>
							<option value="017" <?php if (!empty($u5) && $u5 == '017') echo 'selected = "selected"'; ?>>University of Colombo School of Computing</option>
							<option value="018" <?php if (!empty($u5) && $u5 == '018') echo 'selected = "selected"'; ?>>Uva Wellassa University of Sri Lanka (Badulla)</option>
							<option value="019" <?php if (!empty($u5) && $u5 == '019') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Trincomalee Campus)</option>
							<option value="020" <?php if (!empty($u5) && $u5 == '020') echo 'selected = "selected"'; ?>>Swami Vipulananda Institute of Aesthetic Studies (Eastern)</option>
							<option value="021" <?php if (!empty($u5) && $u5 == '021') echo 'selected = "selected"'; ?>>University of the Visual and Performing Arts</option>
						</select>
						 </td>
					   </tr>
					   <tr align="center">
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
					   </tr>
					   <tr align="center">
						 <td>6. </td>
						 <td>
						 <select name="c6" id="c6">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($c6) && $c6 == '001') echo 'selected = "selected"'; ?>>Medicine</option>
							<option value="002" <?php if (!empty($c6) && $c6 == '002') echo 'selected = "selected"'; ?>>Dental Surgery</option>
							<option value="003" <?php if (!empty($c6) && $c6 == '003') echo 'selected = "selected"'; ?>>Veterinary Science</option>
							<option value="004" <?php if (!empty($c6) && $c6 == '004') echo 'selected = "selected"'; ?>>Agriculture</option>
							<option value="005" <?php if (!empty($c6) && $c6 == '005') echo 'selected = "selected"'; ?>>Food Science and Nutrition</option>
							<option value="006" <?php if (!empty($c6) && $c6 == '006') echo 'selected = "selected"'; ?>>Biological Science</option>
							<option value="007" <?php if (!empty($c6) && $c6 == '007') echo 'selected = "selected"'; ?>>Applied Sciences - Bio.Sci</option>
							<option value="008" <?php if (!empty($c6) && $c6 == '008') echo 'selected = "selected"'; ?>>Engineering</option>
							<option value="009" <?php if (!empty($c6) && $c6 == '009') echo 'selected = "selected"'; ?>>Engineering - EM</option>
							<option value="010" <?php if (!empty($c6) && $c6 == '010') echo 'selected = "selected"'; ?>>Engineering - TM</option>
							<option value="011" <?php if (!empty($c6) && $c6 == '011') echo 'selected = "selected"'; ?>>Quantity Surveying</option>
							<option value="012" <?php if (!empty($c6) && $c6 == '012') echo 'selected = "selected"'; ?>>Computer Science</option>
							<option value="013" <?php if (!empty($c6) && $c6 == '013') echo 'selected = "selected"'; ?>>Physical Science</option>
							<option value="014" <?php if (!empty($c6) && $c6 == '014') echo 'selected = "selected"'; ?>>Surveying Science</option>
							<option value="015" <?php if (!empty($c6) && $c6 == '015') echo 'selected = "selected"'; ?>>Applied Sciences - Phy.Sci</option>
						</select>
						</td>
						 <td>
						 <select name="u6" id="u6">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($u6) && $u6 == '001') echo 'selected = "selected"'; ?>>University of Colombo</option>
							<option value="002" <?php if (!empty($u6) && $u6 == '002') echo 'selected = "selected"'; ?>>University of  Peradeniya</option>
							<option value="003" <?php if (!empty($u6) && $u6 == '003') echo 'selected = "selected"'; ?>>University of Sri Jayawardenapura</option>
							<option value="004" <?php if (!empty($u6) && $u6 == '004') echo 'selected = "selected"'; ?>>University of Kelaniya</option>
							<option value="005" <?php if (!empty($u6) && $u6 == '005') echo 'selected = "selected"'; ?>>University of Jaffna</option>
							<option value="006" <?php if (!empty($u6) && $u6 == '006') echo 'selected = "selected"'; ?>>University of Ruhuna (Matara)</option>
							<option value="007" <?php if (!empty($u6) && $u6 == '007') echo 'selected = "selected"'; ?>>University of Moratuwa</option>
							<option value="008" <?php if (!empty($u6) && $u6 == '008') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Batticaloa)</option>
							<option value="009" <?php if (!empty($u6) && $u6 == '009') echo 'selected = "selected"'; ?>>South Eastern University of Sri Lanka (Oluvil)</option>
							<option value="010" <?php if (!empty($u6) && $u6 == '010') echo 'selected = "selected"'; ?>>Rajarata University of Sri Lanka (Mihintale)</option>
							<option value="011" <?php if (!empty($u6) && $u6 == '011') echo 'selected = "selected"'; ?>>Sabaragamuwa University of Sri Lanka (Belihuloya)</option>
							<option value="012" <?php if (!empty($u6) && $u6 == '012') echo 'selected = "selected"'; ?>>Wayamba University of Sri Lanka (Kuliyapitiya)</option>
							<option value="013" <?php if (!empty($u6) && $u6 == '013') echo 'selected = "selected"'; ?>>Institute of Indigenous Medicine</option>
							<option value="014" <?php if (!empty($u6) && $u6 == '014') echo 'selected = "selected"'; ?>>Gampaha Wickramarachchi Ayurveda Institute</option>
							<option value="015" <?php if (!empty($u6) && $u6 == '015') echo 'selected = "selected"'; ?>>University of Jaffna (Vavuniya Campus)</option>
							<option value="016" <?php if (!empty($u6) && $u6 == '016') echo 'selected = "selected"'; ?>>University of Colombo (Sripalee Campus)</option>
							<option value="017" <?php if (!empty($u6) && $u6 == '017') echo 'selected = "selected"'; ?>>University of Colombo School of Computing</option>
							<option value="018" <?php if (!empty($u6) && $u6 == '018') echo 'selected = "selected"'; ?>>Uva Wellassa University of Sri Lanka (Badulla)</option>
							<option value="019" <?php if (!empty($u6) && $u6 == '019') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Trincomalee Campus)</option>
							<option value="020" <?php if (!empty($u6) && $u6 == '020') echo 'selected = "selected"'; ?>>Swami Vipulananda Institute of Aesthetic Studies (Eastern)</option>
							<option value="021" <?php if (!empty($u6) && $u6 == '021') echo 'selected = "selected"'; ?>>University of the Visual and Performing Arts</option>
						</select>
						 </td>
					   </tr>
					   <tr align="center">
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
					   </tr>
					   <tr align="center">
						 <td>7. </td>
						 <td>
						 <select name="c7" id="c7">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($c7) && $c7 == '001') echo 'selected = "selected"'; ?>>Medicine</option>
							<option value="002" <?php if (!empty($c7) && $c7 == '002') echo 'selected = "selected"'; ?>>Dental Surgery</option>
							<option value="003" <?php if (!empty($c7) && $c7 == '003') echo 'selected = "selected"'; ?>>Veterinary Science</option>
							<option value="004" <?php if (!empty($c7) && $c7 == '004') echo 'selected = "selected"'; ?>>Agriculture</option>
							<option value="005" <?php if (!empty($c7) && $c7 == '005') echo 'selected = "selected"'; ?>>Food Science and Nutrition</option>
							<option value="006" <?php if (!empty($c7) && $c7 == '006') echo 'selected = "selected"'; ?>>Biological Science</option>
							<option value="007" <?php if (!empty($c7) && $c7 == '007') echo 'selected = "selected"'; ?>>Applied Sciences - Bio.Sci</option>
							<option value="008" <?php if (!empty($c7) && $c7 == '008') echo 'selected = "selected"'; ?>>Engineering</option>
							<option value="009" <?php if (!empty($c7) && $c7 == '009') echo 'selected = "selected"'; ?>>Engineering - EM</option>
							<option value="010" <?php if (!empty($c7) && $c7 == '010') echo 'selected = "selected"'; ?>>Engineering - TM</option>
							<option value="011" <?php if (!empty($c7) && $c7 == '011') echo 'selected = "selected"'; ?>>Quantity Surveying</option>
							<option value="012" <?php if (!empty($c7) && $c7 == '012') echo 'selected = "selected"'; ?>>Computer Science</option>
							<option value="013" <?php if (!empty($c7) && $c7 == '013') echo 'selected = "selected"'; ?>>Physical Science</option>
							<option value="014" <?php if (!empty($c7) && $c7 == '014') echo 'selected = "selected"'; ?>>Surveying Science</option>
							<option value="015" <?php if (!empty($c7) && $c7 == '015') echo 'selected = "selected"'; ?>>Applied Sciences - Phy.Sci</option>
						</select>
						</td>
						 <td>
						 <select name="u7" id="u7">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($u7) && $u7 == '001') echo 'selected = "selected"'; ?>>University of Colombo</option>
							<option value="002" <?php if (!empty($u7) && $u7 == '002') echo 'selected = "selected"'; ?>>University of  Peradeniya</option>
							<option value="003" <?php if (!empty($u7) && $u7 == '003') echo 'selected = "selected"'; ?>>University of Sri Jayawardenapura</option>
							<option value="004" <?php if (!empty($u7) && $u7 == '004') echo 'selected = "selected"'; ?>>University of Kelaniya</option>
							<option value="005" <?php if (!empty($u7) && $u7 == '005') echo 'selected = "selected"'; ?>>University of Jaffna</option>
							<option value="006" <?php if (!empty($u7) && $u7 == '006') echo 'selected = "selected"'; ?>>University of Ruhuna (Matara)</option>
							<option value="007" <?php if (!empty($u7) && $u7 == '007') echo 'selected = "selected"'; ?>>University of Moratuwa</option>
							<option value="008" <?php if (!empty($u7) && $u7 == '008') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Batticaloa)</option>
							<option value="009" <?php if (!empty($u7) && $u7 == '009') echo 'selected = "selected"'; ?>>South Eastern University of Sri Lanka (Oluvil)</option>
							<option value="010" <?php if (!empty($u7) && $u7 == '010') echo 'selected = "selected"'; ?>>Rajarata University of Sri Lanka (Mihintale)</option>
							<option value="011" <?php if (!empty($u7) && $u7 == '011') echo 'selected = "selected"'; ?>>Sabaragamuwa University of Sri Lanka (Belihuloya)</option>
							<option value="012" <?php if (!empty($u7) && $u7 == '012') echo 'selected = "selected"'; ?>>Wayamba University of Sri Lanka (Kuliyapitiya)</option>
							<option value="013" <?php if (!empty($u7) && $u7 == '013') echo 'selected = "selected"'; ?>>Institute of Indigenous Medicine</option>
							<option value="014" <?php if (!empty($u7) && $u7 == '014') echo 'selected = "selected"'; ?>>Gampaha Wickramarachchi Ayurveda Institute</option>
							<option value="015" <?php if (!empty($u7) && $u7 == '015') echo 'selected = "selected"'; ?>>University of Jaffna (Vavuniya Campus)</option>
							<option value="016" <?php if (!empty($u7) && $u7 == '016') echo 'selected = "selected"'; ?>>University of Colombo (Sripalee Campus)</option>
							<option value="017" <?php if (!empty($u7) && $u7 == '017') echo 'selected = "selected"'; ?>>University of Colombo School of Computing</option>
							<option value="018" <?php if (!empty($u7) && $u7 == '018') echo 'selected = "selected"'; ?>>Uva Wellassa University of Sri Lanka (Badulla)</option>
							<option value="019" <?php if (!empty($u7) && $u7 == '019') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Trincomalee Campus)</option>
							<option value="020" <?php if (!empty($u7) && $u7 == '020') echo 'selected = "selected"'; ?>>Swami Vipulananda Institute of Aesthetic Studies (Eastern)</option>
							<option value="021" <?php if (!empty($u7) && $u7 == '021') echo 'selected = "selected"'; ?>>University of the Visual and Performing Arts</option>
						</select>
						 </td>
					   </tr>
					   <tr align="center">
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
					   </tr>
					   <tr align="center">
						 <td>8. </td>
						 <td>
						 <select name="c8" id="c8">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($c8) && $c8 == '001') echo 'selected = "selected"'; ?>>Medicine</option>
							<option value="002" <?php if (!empty($c8) && $c8 == '002') echo 'selected = "selected"'; ?>>Dental Surgery</option>
							<option value="003" <?php if (!empty($c8) && $c8 == '003') echo 'selected = "selected"'; ?>>Veterinary Science</option>
							<option value="004" <?php if (!empty($c8) && $c8 == '004') echo 'selected = "selected"'; ?>>Agriculture</option>
							<option value="005" <?php if (!empty($c8) && $c8 == '005') echo 'selected = "selected"'; ?>>Food Science and Nutrition</option>
							<option value="006" <?php if (!empty($c8) && $c8 == '006') echo 'selected = "selected"'; ?>>Biological Science</option>
							<option value="007" <?php if (!empty($c8) && $c8 == '007') echo 'selected = "selected"'; ?>>Applied Sciences - Bio.Sci</option>
							<option value="008" <?php if (!empty($c8) && $c8 == '008') echo 'selected = "selected"'; ?>>Engineering</option>
							<option value="009" <?php if (!empty($c8) && $c8 == '009') echo 'selected = "selected"'; ?>>Engineering - EM</option>
							<option value="010" <?php if (!empty($c8) && $c8 == '010') echo 'selected = "selected"'; ?>>Engineering - TM</option>
							<option value="011" <?php if (!empty($c8) && $c8 == '011') echo 'selected = "selected"'; ?>>Quantity Surveying</option>
							<option value="012" <?php if (!empty($c8) && $c8 == '012') echo 'selected = "selected"'; ?>>Computer Science</option>
							<option value="013" <?php if (!empty($c8) && $c8 == '013') echo 'selected = "selected"'; ?>>Physical Science</option>
							<option value="014" <?php if (!empty($c8) && $c8 == '014') echo 'selected = "selected"'; ?>>Surveying Science</option>
							<option value="015" <?php if (!empty($c8) && $c8 == '015') echo 'selected = "selected"'; ?>>Applied Sciences - Phy.Sci</option>
						</select>
						</td>
						 <td>
						 <select name="u8" id="u8">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($u8) && $u8 == '001') echo 'selected = "selected"'; ?>>University of Colombo</option>
							<option value="002" <?php if (!empty($u8) && $u8 == '002') echo 'selected = "selected"'; ?>>University of  Peradeniya</option>
							<option value="003" <?php if (!empty($u8) && $u8 == '003') echo 'selected = "selected"'; ?>>University of Sri Jayawardenapura</option>
							<option value="004" <?php if (!empty($u8) && $u8 == '004') echo 'selected = "selected"'; ?>>University of Kelaniya</option>
							<option value="005" <?php if (!empty($u8) && $u8 == '005') echo 'selected = "selected"'; ?>>University of Jaffna</option>
							<option value="006" <?php if (!empty($u8) && $u8 == '006') echo 'selected = "selected"'; ?>>University of Ruhuna (Matara)</option>
							<option value="007" <?php if (!empty($u8) && $u8 == '007') echo 'selected = "selected"'; ?>>University of Moratuwa</option>
							<option value="008" <?php if (!empty($u8) && $u8 == '008') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Batticaloa)</option>
							<option value="009" <?php if (!empty($u8) && $u8 == '009') echo 'selected = "selected"'; ?>>South Eastern University of Sri Lanka (Oluvil)</option>
							<option value="010" <?php if (!empty($u8) && $u8 == '010') echo 'selected = "selected"'; ?>>Rajarata University of Sri Lanka (Mihintale)</option>
							<option value="011" <?php if (!empty($u8) && $u8 == '011') echo 'selected = "selected"'; ?>>Sabaragamuwa University of Sri Lanka (Belihuloya)</option>
							<option value="012" <?php if (!empty($u8) && $u8 == '012') echo 'selected = "selected"'; ?>>Wayamba University of Sri Lanka (Kuliyapitiya)</option>
							<option value="013" <?php if (!empty($u8) && $u8 == '013') echo 'selected = "selected"'; ?>>Institute of Indigenous Medicine</option>
							<option value="014" <?php if (!empty($u8) && $u8 == '014') echo 'selected = "selected"'; ?>>Gampaha Wickramarachchi Ayurveda Institute</option>
							<option value="015" <?php if (!empty($u8) && $u8 == '015') echo 'selected = "selected"'; ?>>University of Jaffna (Vavuniya Campus)</option>
							<option value="016" <?php if (!empty($u8) && $u8 == '016') echo 'selected = "selected"'; ?>>University of Colombo (Sripalee Campus)</option>
							<option value="017" <?php if (!empty($u8) && $u8 == '017') echo 'selected = "selected"'; ?>>University of Colombo School of Computing</option>
							<option value="018" <?php if (!empty($u8) && $u8 == '018') echo 'selected = "selected"'; ?>>Uva Wellassa University of Sri Lanka (Badulla)</option>
							<option value="019" <?php if (!empty($u8) && $u8 == '019') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Trincomalee Campus)</option>
							<option value="020" <?php if (!empty($u8) && $u8 == '020') echo 'selected = "selected"'; ?>>Swami Vipulananda Institute of Aesthetic Studies (Eastern)</option>
							<option value="021" <?php if (!empty($u8) && $u8 == '021') echo 'selected = "selected"'; ?>>University of the Visual and Performing Arts</option>
						</select>
						 </td>
					   </tr>
					   <tr align="center">
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
					   </tr>
					   <tr align="center">
						 <td>9. </td>
						 <td>
						 <select name="c9" id="c9">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($c9) && $c9 == '001') echo 'selected = "selected"'; ?>>Medicine</option>
							<option value="002" <?php if (!empty($c9) && $c9 == '002') echo 'selected = "selected"'; ?>>Dental Surgery</option>
							<option value="003" <?php if (!empty($c9) && $c9 == '003') echo 'selected = "selected"'; ?>>Veterinary Science</option>
							<option value="004" <?php if (!empty($c9) && $c9 == '004') echo 'selected = "selected"'; ?>>Agriculture</option>
							<option value="005" <?php if (!empty($c9) && $c9 == '005') echo 'selected = "selected"'; ?>>Food Science and Nutrition</option>
							<option value="006" <?php if (!empty($c9) && $c9 == '006') echo 'selected = "selected"'; ?>>Biological Science</option>
							<option value="007" <?php if (!empty($c9) && $c9 == '007') echo 'selected = "selected"'; ?>>Applied Sciences - Bio.Sci</option>
							<option value="008" <?php if (!empty($c9) && $c9 == '008') echo 'selected = "selected"'; ?>>Engineering</option>
							<option value="009" <?php if (!empty($c9) && $c9 == '009') echo 'selected = "selected"'; ?>>Engineering - EM</option>
							<option value="010" <?php if (!empty($c9) && $c9 == '010') echo 'selected = "selected"'; ?>>Engineering - TM</option>
							<option value="011" <?php if (!empty($c9) && $c9 == '011') echo 'selected = "selected"'; ?>>Quantity Surveying</option>
							<option value="012" <?php if (!empty($c9) && $c9 == '012') echo 'selected = "selected"'; ?>>Computer Science</option>
							<option value="013" <?php if (!empty($c9) && $c9 == '013') echo 'selected = "selected"'; ?>>Physical Science</option>
							<option value="014" <?php if (!empty($c9) && $c9 == '014') echo 'selected = "selected"'; ?>>Surveying Science</option>
							<option value="015" <?php if (!empty($c9) && $c9 == '015') echo 'selected = "selected"'; ?>>Applied Sciences - Phy.Sci</option>
						</select>
						</td>
						 <td>
						 <select name="u9" id="u9">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($u9) && $u9 == '001') echo 'selected = "selected"'; ?>>University of Colombo</option>
							<option value="002" <?php if (!empty($u9) && $u9 == '002') echo 'selected = "selected"'; ?>>University of  Peradeniya</option>
							<option value="003" <?php if (!empty($u9) && $u9 == '003') echo 'selected = "selected"'; ?>>University of Sri Jayawardenapura</option>
							<option value="004" <?php if (!empty($u9) && $u9 == '004') echo 'selected = "selected"'; ?>>University of Kelaniya</option>
							<option value="005" <?php if (!empty($u9) && $u9 == '005') echo 'selected = "selected"'; ?>>University of Jaffna</option>
							<option value="006" <?php if (!empty($u9) && $u9 == '006') echo 'selected = "selected"'; ?>>University of Ruhuna (Matara)</option>
							<option value="007" <?php if (!empty($u9) && $u9 == '007') echo 'selected = "selected"'; ?>>University of Moratuwa</option>
							<option value="008" <?php if (!empty($u9) && $u9 == '008') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Batticaloa)</option>
							<option value="009" <?php if (!empty($u9) && $u9 == '009') echo 'selected = "selected"'; ?>>South Eastern University of Sri Lanka (Oluvil)</option>
							<option value="010" <?php if (!empty($u9) && $u9 == '010') echo 'selected = "selected"'; ?>>Rajarata University of Sri Lanka (Mihintale)</option>
							<option value="011" <?php if (!empty($u9) && $u9 == '011') echo 'selected = "selected"'; ?>>Sabaragamuwa University of Sri Lanka (Belihuloya)</option>
							<option value="012" <?php if (!empty($u9) && $u9 == '012') echo 'selected = "selected"'; ?>>Wayamba University of Sri Lanka (Kuliyapitiya)</option>
							<option value="013" <?php if (!empty($u9) && $u9 == '013') echo 'selected = "selected"'; ?>>Institute of Indigenous Medicine</option>
							<option value="014" <?php if (!empty($u9) && $u9 == '014') echo 'selected = "selected"'; ?>>Gampaha Wickramarachchi Ayurveda Institute</option>
							<option value="015" <?php if (!empty($u9) && $u9 == '015') echo 'selected = "selected"'; ?>>University of Jaffna (Vavuniya Campus)</option>
							<option value="016" <?php if (!empty($u9) && $u9 == '016') echo 'selected = "selected"'; ?>>University of Colombo (Sripalee Campus)</option>
							<option value="017" <?php if (!empty($u9) && $u9 == '017') echo 'selected = "selected"'; ?>>University of Colombo School of Computing</option>
							<option value="018" <?php if (!empty($u9) && $u9 == '018') echo 'selected = "selected"'; ?>>Uva Wellassa University of Sri Lanka (Badulla)</option>
							<option value="019" <?php if (!empty($u9) && $u9 == '019') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Trincomalee Campus)</option>
							<option value="020" <?php if (!empty($u9) && $u9 == '020') echo 'selected = "selected"'; ?>>Swami Vipulananda Institute of Aesthetic Studies (Eastern)</option>
							<option value="021" <?php if (!empty($u9) && $u9 == '021') echo 'selected = "selected"'; ?>>University of the Visual and Performing Arts</option>
						</select>
						 </td>
					   </tr>
					   <tr align="center">
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
					   </tr>
					   <tr align="center">
						 <td>10. </td>
						 <td>
						 <select name="c10" id="c10">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($c10) && $c10 == '001') echo 'selected = "selected"'; ?>>Medicine</option>
							<option value="002" <?php if (!empty($c10) && $c10 == '002') echo 'selected = "selected"'; ?>>Dental Surgery</option>
							<option value="003" <?php if (!empty($c10) && $c10 == '003') echo 'selected = "selected"'; ?>>Veterinary Science</option>
							<option value="004" <?php if (!empty($c10) && $c10 == '004') echo 'selected = "selected"'; ?>>Agriculture</option>
							<option value="005" <?php if (!empty($c10) && $c10 == '005') echo 'selected = "selected"'; ?>>Food Science and Nutrition</option>
							<option value="006" <?php if (!empty($c10) && $c10 == '006') echo 'selected = "selected"'; ?>>Biological Science</option>
							<option value="007" <?php if (!empty($c10) && $c10 == '007') echo 'selected = "selected"'; ?>>Applied Sciences - Bio.Sci</option>
							<option value="008" <?php if (!empty($c10) && $c10 == '008') echo 'selected = "selected"'; ?>>Engineering</option>
							<option value="009" <?php if (!empty($c10) && $c10 == '009') echo 'selected = "selected"'; ?>>Engineering - EM</option>
							<option value="010" <?php if (!empty($c10) && $c10 == '010') echo 'selected = "selected"'; ?>>Engineering - TM</option>
							<option value="011" <?php if (!empty($c10) && $c10 == '011') echo 'selected = "selected"'; ?>>Quantity Surveying</option>
							<option value="012" <?php if (!empty($c10) && $c10 == '012') echo 'selected = "selected"'; ?>>Computer Science</option>
							<option value="013" <?php if (!empty($c10) && $c10 == '013') echo 'selected = "selected"'; ?>>Physical Science</option>
							<option value="014" <?php if (!empty($c10) && $c10 == '014') echo 'selected = "selected"'; ?>>Surveying Science</option>
							<option value="015" <?php if (!empty($c10) && $c10 == '015') echo 'selected = "selected"'; ?>>Applied Sciences - Phy.Sci</option>
						</select>
						</td>
						 <td>
						 <select name="u10" id="u10">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($u10) && $u10 == '001') echo 'selected = "selected"'; ?>>University of Colombo</option>
							<option value="002" <?php if (!empty($u10) && $u10 == '002') echo 'selected = "selected"'; ?>>University of  Peradeniya</option>
							<option value="003" <?php if (!empty($u10) && $u10 == '003') echo 'selected = "selected"'; ?>>University of Sri Jayawardenapura</option>
							<option value="004" <?php if (!empty($u10) && $u10 == '004') echo 'selected = "selected"'; ?>>University of Kelaniya</option>
							<option value="005" <?php if (!empty($u10) && $u10 == '005') echo 'selected = "selected"'; ?>>University of Jaffna</option>
							<option value="006" <?php if (!empty($u10) && $u10 == '006') echo 'selected = "selected"'; ?>>University of Ruhuna (Matara)</option>
							<option value="007" <?php if (!empty($u10) && $u10 == '007') echo 'selected = "selected"'; ?>>University of Moratuwa</option>
							<option value="008" <?php if (!empty($u10) && $u10 == '008') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Batticaloa)</option>
							<option value="009" <?php if (!empty($u10) && $u10 == '009') echo 'selected = "selected"'; ?>>South Eastern University of Sri Lanka (Oluvil)</option>
							<option value="010" <?php if (!empty($u10) && $u10 == '010') echo 'selected = "selected"'; ?>>Rajarata University of Sri Lanka (Mihintale)</option>
							<option value="011" <?php if (!empty($u10) && $u10 == '011') echo 'selected = "selected"'; ?>>Sabaragamuwa University of Sri Lanka (Belihuloya)</option>
							<option value="012" <?php if (!empty($u10) && $u10 == '012') echo 'selected = "selected"'; ?>>Wayamba University of Sri Lanka (Kuliyapitiya)</option>
							<option value="013" <?php if (!empty($u10) && $u10 == '013') echo 'selected = "selected"'; ?>>Institute of Indigenous Medicine</option>
							<option value="014" <?php if (!empty($u10) && $u10 == '014') echo 'selected = "selected"'; ?>>Gampaha Wickramarachchi Ayurveda Institute</option>
							<option value="015" <?php if (!empty($u10) && $u10 == '015') echo 'selected = "selected"'; ?>>University of Jaffna (Vavuniya Campus)</option>
							<option value="016" <?php if (!empty($u10) && $u10 == '016') echo 'selected = "selected"'; ?>>University of Colombo (Sripalee Campus)</option>
							<option value="017" <?php if (!empty($u10) && $u10 == '017') echo 'selected = "selected"'; ?>>University of Colombo School of Computing</option>
							<option value="018" <?php if (!empty($u10) && $u10 == '018') echo 'selected = "selected"'; ?>>Uva Wellassa University of Sri Lanka (Badulla)</option>
							<option value="019" <?php if (!empty($u10) && $u10 == '019') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Trincomalee Campus)</option>
							<option value="020" <?php if (!empty($u10) && $u10 == '020') echo 'selected = "selected"'; ?>>Swami Vipulananda Institute of Aesthetic Studies (Eastern)</option>
							<option value="021" <?php if (!empty($u10) && $u10 == '021') echo 'selected = "selected"'; ?>>University of the Visual and Performing Arts</option>
						</select>
						 </td>
					   </tr>
					   <tr align="center">
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
					   </tr>
					   <tr align="center">
						 <td>11. </td>
						 <td>
						 <select name="c11" id="c11">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($c11) && $c11 == '001') echo 'selected = "selected"'; ?>>Medicine</option>
							<option value="002" <?php if (!empty($c11) && $c11 == '002') echo 'selected = "selected"'; ?>>Dental Surgery</option>
							<option value="003" <?php if (!empty($c11) && $c11 == '003') echo 'selected = "selected"'; ?>>Veterinary Science</option>
							<option value="004" <?php if (!empty($c11) && $c11 == '004') echo 'selected = "selected"'; ?>>Agriculture</option>
							<option value="005" <?php if (!empty($c11) && $c11 == '005') echo 'selected = "selected"'; ?>>Food Science and Nutrition</option>
							<option value="006" <?php if (!empty($c11) && $c11 == '006') echo 'selected = "selected"'; ?>>Biological Science</option>
							<option value="007" <?php if (!empty($c11) && $c11 == '007') echo 'selected = "selected"'; ?>>Applied Sciences - Bio.Sci</option>
							<option value="008" <?php if (!empty($c11) && $c11 == '008') echo 'selected = "selected"'; ?>>Engineering</option>
							<option value="009" <?php if (!empty($c11) && $c11 == '009') echo 'selected = "selected"'; ?>>Engineering - EM</option>
							<option value="010" <?php if (!empty($c11) && $c11 == '010') echo 'selected = "selected"'; ?>>Engineering - TM</option>
							<option value="011" <?php if (!empty($c11) && $c11 == '011') echo 'selected = "selected"'; ?>>Quantity Surveying</option>
							<option value="012" <?php if (!empty($c11) && $c11 == '012') echo 'selected = "selected"'; ?>>Computer Science</option>
							<option value="013" <?php if (!empty($c11) && $c11 == '013') echo 'selected = "selected"'; ?>>Physical Science</option>
							<option value="014" <?php if (!empty($c11) && $c11 == '014') echo 'selected = "selected"'; ?>>Surveying Science</option>
							<option value="015" <?php if (!empty($c11) && $c11 == '015') echo 'selected = "selected"'; ?>>Applied Sciences - Phy.Sci</option>
						</select>
						</td>
						 <td>
						 <select name="u11" id="u11">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($u11) && $u11 == '001') echo 'selected = "selected"'; ?>>University of Colombo</option>
							<option value="002" <?php if (!empty($u11) && $u11 == '002') echo 'selected = "selected"'; ?>>University of  Peradeniya</option>
							<option value="003" <?php if (!empty($u11) && $u11 == '003') echo 'selected = "selected"'; ?>>University of Sri Jayawardenapura</option>
							<option value="004" <?php if (!empty($u11) && $u11 == '004') echo 'selected = "selected"'; ?>>University of Kelaniya</option>
							<option value="005" <?php if (!empty($u11) && $u11 == '005') echo 'selected = "selected"'; ?>>University of Jaffna</option>
							<option value="006" <?php if (!empty($u11) && $u11 == '006') echo 'selected = "selected"'; ?>>University of Ruhuna (Matara)</option>
							<option value="007" <?php if (!empty($u11) && $u11 == '007') echo 'selected = "selected"'; ?>>University of Moratuwa</option>
							<option value="008" <?php if (!empty($u11) && $u11 == '008') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Batticaloa)</option>
							<option value="009" <?php if (!empty($u11) && $u11 == '009') echo 'selected = "selected"'; ?>>South Eastern University of Sri Lanka (Oluvil)</option>
							<option value="010" <?php if (!empty($u11) && $u11 == '010') echo 'selected = "selected"'; ?>>Rajarata University of Sri Lanka (Mihintale)</option>
							<option value="011" <?php if (!empty($u11) && $u11 == '011') echo 'selected = "selected"'; ?>>Sabaragamuwa University of Sri Lanka (Belihuloya)</option>
							<option value="012" <?php if (!empty($u11) && $u11 == '012') echo 'selected = "selected"'; ?>>Wayamba University of Sri Lanka (Kuliyapitiya)</option>
							<option value="013" <?php if (!empty($u11) && $u11 == '013') echo 'selected = "selected"'; ?>>Institute of Indigenous Medicine</option>
							<option value="014" <?php if (!empty($u11) && $u11 == '014') echo 'selected = "selected"'; ?>>Gampaha Wickramarachchi Ayurveda Institute</option>
							<option value="015" <?php if (!empty($u11) && $u11 == '015') echo 'selected = "selected"'; ?>>University of Jaffna (Vavuniya Campus)</option>
							<option value="016" <?php if (!empty($u11) && $u11 == '016') echo 'selected = "selected"'; ?>>University of Colombo (Sripalee Campus)</option>
							<option value="017" <?php if (!empty($u11) && $u11 == '017') echo 'selected = "selected"'; ?>>University of Colombo School of Computing</option>
							<option value="018" <?php if (!empty($u11) && $u11 == '018') echo 'selected = "selected"'; ?>>Uva Wellassa University of Sri Lanka (Badulla)</option>
							<option value="019" <?php if (!empty($u11) && $u11 == '019') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Trincomalee Campus)</option>
							<option value="020" <?php if (!empty($u11) && $u11 == '020') echo 'selected = "selected"'; ?>>Swami Vipulananda Institute of Aesthetic Studies (Eastern)</option>
							<option value="021" <?php if (!empty($u11) && $u11 == '021') echo 'selected = "selected"'; ?>>University of the Visual and Performing Arts</option>
						</select>
						 </td>
					   </tr>
					   <tr align="center">
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
					   </tr>
					   <tr align="center">
						 <td>12. </td>
						 <td>
						 <select name="c12" id="c12">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($c12) && $c12 == '001') echo 'selected = "selected"'; ?>>Medicine</option>
							<option value="002" <?php if (!empty($c12) && $c12 == '002') echo 'selected = "selected"'; ?>>Dental Surgery</option>
							<option value="003" <?php if (!empty($c12) && $c12 == '003') echo 'selected = "selected"'; ?>>Veterinary Science</option>
							<option value="004" <?php if (!empty($c12) && $c12 == '004') echo 'selected = "selected"'; ?>>Agriculture</option>
							<option value="005" <?php if (!empty($c12) && $c12 == '005') echo 'selected = "selected"'; ?>>Food Science and Nutrition</option>
							<option value="006" <?php if (!empty($c12) && $c12 == '006') echo 'selected = "selected"'; ?>>Biological Science</option>
							<option value="007" <?php if (!empty($c12) && $c12 == '007') echo 'selected = "selected"'; ?>>Applied Sciences - Bio.Sci</option>
							<option value="008" <?php if (!empty($c12) && $c12 == '008') echo 'selected = "selected"'; ?>>Engineering</option>
							<option value="009" <?php if (!empty($c12) && $c12 == '009') echo 'selected = "selected"'; ?>>Engineering - EM</option>
							<option value="010" <?php if (!empty($c12) && $c12 == '010') echo 'selected = "selected"'; ?>>Engineering - TM</option>
							<option value="011" <?php if (!empty($c12) && $c12 == '011') echo 'selected = "selected"'; ?>>Quantity Surveying</option>
							<option value="012" <?php if (!empty($c12) && $c12 == '012') echo 'selected = "selected"'; ?>>Computer Science</option>
							<option value="013" <?php if (!empty($c12) && $c12 == '013') echo 'selected = "selected"'; ?>>Physical Science</option>
							<option value="014" <?php if (!empty($c12) && $c12 == '014') echo 'selected = "selected"'; ?>>Surveying Science</option>
							<option value="015" <?php if (!empty($c12) && $c12 == '015') echo 'selected = "selected"'; ?>>Applied Sciences - Phy.Sci</option>
						</select>
						</td>
						 <td>
						 <select name="u12" id="u12">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($u12) && $u12 == '001') echo 'selected = "selected"'; ?>>University of Colombo</option>
							<option value="002" <?php if (!empty($u12) && $u12 == '002') echo 'selected = "selected"'; ?>>University of  Peradeniya</option>
							<option value="003" <?php if (!empty($u12) && $u12 == '003') echo 'selected = "selected"'; ?>>University of Sri Jayawardenapura</option>
							<option value="004" <?php if (!empty($u12) && $u12 == '004') echo 'selected = "selected"'; ?>>University of Kelaniya</option>
							<option value="005" <?php if (!empty($u12) && $u12 == '005') echo 'selected = "selected"'; ?>>University of Jaffna</option>
							<option value="006" <?php if (!empty($u12) && $u12 == '006') echo 'selected = "selected"'; ?>>University of Ruhuna (Matara)</option>
							<option value="007" <?php if (!empty($u12) && $u12 == '007') echo 'selected = "selected"'; ?>>University of Moratuwa</option>
							<option value="008" <?php if (!empty($u12) && $u12 == '008') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Batticaloa)</option>
							<option value="009" <?php if (!empty($u12) && $u12 == '009') echo 'selected = "selected"'; ?>>South Eastern University of Sri Lanka (Oluvil)</option>
							<option value="010" <?php if (!empty($u12) && $u12 == '010') echo 'selected = "selected"'; ?>>Rajarata University of Sri Lanka (Mihintale)</option>
							<option value="011" <?php if (!empty($u12) && $u12 == '011') echo 'selected = "selected"'; ?>>Sabaragamuwa University of Sri Lanka (Belihuloya)</option>
							<option value="012" <?php if (!empty($u12) && $u12 == '012') echo 'selected = "selected"'; ?>>Wayamba University of Sri Lanka (Kuliyapitiya)</option>
							<option value="013" <?php if (!empty($u12) && $u12 == '013') echo 'selected = "selected"'; ?>>Institute of Indigenous Medicine</option>
							<option value="014" <?php if (!empty($u12) && $u12 == '014') echo 'selected = "selected"'; ?>>Gampaha Wickramarachchi Ayurveda Institute</option>
							<option value="015" <?php if (!empty($u12) && $u12 == '015') echo 'selected = "selected"'; ?>>University of Jaffna (Vavuniya Campus)</option>
							<option value="016" <?php if (!empty($u12) && $u12 == '016') echo 'selected = "selected"'; ?>>University of Colombo (Sripalee Campus)</option>
							<option value="017" <?php if (!empty($u12) && $u12 == '017') echo 'selected = "selected"'; ?>>University of Colombo School of Computing</option>
							<option value="018" <?php if (!empty($u12) && $u12 == '018') echo 'selected = "selected"'; ?>>Uva Wellassa University of Sri Lanka (Badulla)</option>
							<option value="019" <?php if (!empty($u12) && $u12 == '019') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Trincomalee Campus)</option>
							<option value="020" <?php if (!empty($u12) && $u12 == '020') echo 'selected = "selected"'; ?>>Swami Vipulananda Institute of Aesthetic Studies (Eastern)</option>
							<option value="021" <?php if (!empty($u12) && $u12 == '021') echo 'selected = "selected"'; ?>>University of the Visual and Performing Arts</option>
						</select>
						 </td>
					   </tr>
					   <tr align="center">
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
					   </tr>
					   <tr align="center">
						 <td>13. </td>
						 <td>
						 <select name="c13" id="c13">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($c13) && $c13 == '001') echo 'selected = "selected"'; ?>>Medicine</option>
							<option value="002" <?php if (!empty($c13) && $c13 == '002') echo 'selected = "selected"'; ?>>Dental Surgery</option>
							<option value="003" <?php if (!empty($c13) && $c13 == '003') echo 'selected = "selected"'; ?>>Veterinary Science</option>
							<option value="004" <?php if (!empty($c13) && $c13 == '004') echo 'selected = "selected"'; ?>>Agriculture</option>
							<option value="005" <?php if (!empty($c13) && $c13 == '005') echo 'selected = "selected"'; ?>>Food Science and Nutrition</option>
							<option value="006" <?php if (!empty($c13) && $c13 == '006') echo 'selected = "selected"'; ?>>Biological Science</option>
							<option value="007" <?php if (!empty($c13) && $c13 == '007') echo 'selected = "selected"'; ?>>Applied Sciences - Bio.Sci</option>
							<option value="008" <?php if (!empty($c13) && $c13 == '008') echo 'selected = "selected"'; ?>>Engineering</option>
							<option value="009" <?php if (!empty($c13) && $c13 == '009') echo 'selected = "selected"'; ?>>Engineering - EM</option>
							<option value="010" <?php if (!empty($c13) && $c13 == '010') echo 'selected = "selected"'; ?>>Engineering - TM</option>
							<option value="011" <?php if (!empty($c13) && $c13 == '011') echo 'selected = "selected"'; ?>>Quantity Surveying</option>
							<option value="012" <?php if (!empty($c13) && $c13 == '012') echo 'selected = "selected"'; ?>>Computer Science</option>
							<option value="013" <?php if (!empty($c13) && $c13 == '013') echo 'selected = "selected"'; ?>>Physical Science</option>
							<option value="014" <?php if (!empty($c13) && $c13 == '014') echo 'selected = "selected"'; ?>>Surveying Science</option>
							<option value="015" <?php if (!empty($c13) && $c13 == '015') echo 'selected = "selected"'; ?>>Applied Sciences - Phy.Sci</option>
						</select>
						</td>
						 <td>
						 <select name="u13" id="u13">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($u13) && $u13 == '001') echo 'selected = "selected"'; ?>>University of Colombo</option>
							<option value="002" <?php if (!empty($u13) && $u13 == '002') echo 'selected = "selected"'; ?>>University of  Peradeniya</option>
							<option value="003" <?php if (!empty($u13) && $u13 == '003') echo 'selected = "selected"'; ?>>University of Sri Jayawardenapura</option>
							<option value="004" <?php if (!empty($u13) && $u13 == '004') echo 'selected = "selected"'; ?>>University of Kelaniya</option>
							<option value="005" <?php if (!empty($u13) && $u13 == '005') echo 'selected = "selected"'; ?>>University of Jaffna</option>
							<option value="006" <?php if (!empty($u13) && $u13 == '006') echo 'selected = "selected"'; ?>>University of Ruhuna (Matara)</option>
							<option value="007" <?php if (!empty($u13) && $u13 == '007') echo 'selected = "selected"'; ?>>University of Moratuwa</option>
							<option value="008" <?php if (!empty($u13) && $u13 == '008') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Batticaloa)</option>
							<option value="009" <?php if (!empty($u13) && $u13 == '009') echo 'selected = "selected"'; ?>>South Eastern University of Sri Lanka (Oluvil)</option>
							<option value="010" <?php if (!empty($u13) && $u13 == '010') echo 'selected = "selected"'; ?>>Rajarata University of Sri Lanka (Mihintale)</option>
							<option value="011" <?php if (!empty($u13) && $u13 == '011') echo 'selected = "selected"'; ?>>Sabaragamuwa University of Sri Lanka (Belihuloya)</option>
							<option value="012" <?php if (!empty($u13) && $u13 == '012') echo 'selected = "selected"'; ?>>Wayamba University of Sri Lanka (Kuliyapitiya)</option>
							<option value="013" <?php if (!empty($u13) && $u13 == '013') echo 'selected = "selected"'; ?>>Institute of Indigenous Medicine</option>
							<option value="014" <?php if (!empty($u13) && $u13 == '014') echo 'selected = "selected"'; ?>>Gampaha Wickramarachchi Ayurveda Institute</option>
							<option value="015" <?php if (!empty($u13) && $u13 == '015') echo 'selected = "selected"'; ?>>University of Jaffna (Vavuniya Campus)</option>
							<option value="016" <?php if (!empty($u13) && $u13 == '016') echo 'selected = "selected"'; ?>>University of Colombo (Sripalee Campus)</option>
							<option value="017" <?php if (!empty($u13) && $u13 == '017') echo 'selected = "selected"'; ?>>University of Colombo School of Computing</option>
							<option value="018" <?php if (!empty($u13) && $u13 == '018') echo 'selected = "selected"'; ?>>Uva Wellassa University of Sri Lanka (Badulla)</option>
							<option value="019" <?php if (!empty($u13) && $u13 == '019') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Trincomalee Campus)</option>
							<option value="020" <?php if (!empty($u13) && $u13 == '020') echo 'selected = "selected"'; ?>>Swami Vipulananda Institute of Aesthetic Studies (Eastern)</option>
							<option value="021" <?php if (!empty($u13) && $u13 == '021') echo 'selected = "selected"'; ?>>University of the Visual and Performing Arts</option>
						</select>
						 </td>
					   </tr>
					   <tr align="center">
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
					   </tr>
					   <tr align="center">
						 <td>14. </td>
						 <td>
						 <select name="c14" id="c14">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($c14) && $c14 == '001') echo 'selected = "selected"'; ?>>Medicine</option>
							<option value="002" <?php if (!empty($c14) && $c14 == '002') echo 'selected = "selected"'; ?>>Dental Surgery</option>
							<option value="003" <?php if (!empty($c14) && $c14 == '003') echo 'selected = "selected"'; ?>>Veterinary Science</option>
							<option value="004" <?php if (!empty($c14) && $c14 == '004') echo 'selected = "selected"'; ?>>Agriculture</option>
							<option value="005" <?php if (!empty($c14) && $c14 == '005') echo 'selected = "selected"'; ?>>Food Science and Nutrition</option>
							<option value="006" <?php if (!empty($c14) && $c14 == '006') echo 'selected = "selected"'; ?>>Biological Science</option>
							<option value="007" <?php if (!empty($c14) && $c14 == '007') echo 'selected = "selected"'; ?>>Applied Sciences - Bio.Sci</option>
							<option value="008" <?php if (!empty($c14) && $c14 == '008') echo 'selected = "selected"'; ?>>Engineering</option>
							<option value="009" <?php if (!empty($c14) && $c14 == '009') echo 'selected = "selected"'; ?>>Engineering - EM</option>
							<option value="010" <?php if (!empty($c14) && $c14 == '010') echo 'selected = "selected"'; ?>>Engineering - TM</option>
							<option value="011" <?php if (!empty($c14) && $c14 == '011') echo 'selected = "selected"'; ?>>Quantity Surveying</option>
							<option value="012" <?php if (!empty($c14) && $c14 == '012') echo 'selected = "selected"'; ?>>Computer Science</option>
							<option value="013" <?php if (!empty($c14) && $c14 == '013') echo 'selected = "selected"'; ?>>Physical Science</option>
							<option value="014" <?php if (!empty($c14) && $c14 == '014') echo 'selected = "selected"'; ?>>Surveying Science</option>
							<option value="015" <?php if (!empty($c14) && $c14 == '015') echo 'selected = "selected"'; ?>>Applied Sciences - Phy.Sci</option>
						</select>
						</td>
						 <td>
						 <select name="u14" id="u14">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($u14) && $u14 == '001') echo 'selected = "selected"'; ?>>University of Colombo</option>
							<option value="002" <?php if (!empty($u14) && $u14 == '002') echo 'selected = "selected"'; ?>>University of  Peradeniya</option>
							<option value="003" <?php if (!empty($u14) && $u14 == '003') echo 'selected = "selected"'; ?>>University of Sri Jayawardenapura</option>
							<option value="004" <?php if (!empty($u14) && $u14 == '004') echo 'selected = "selected"'; ?>>University of Kelaniya</option>
							<option value="005" <?php if (!empty($u14) && $u14 == '005') echo 'selected = "selected"'; ?>>University of Jaffna</option>
							<option value="006" <?php if (!empty($u14) && $u14 == '006') echo 'selected = "selected"'; ?>>University of Ruhuna (Matara)</option>
							<option value="007" <?php if (!empty($u14) && $u14 == '007') echo 'selected = "selected"'; ?>>University of Moratuwa</option>
							<option value="008" <?php if (!empty($u14) && $u14 == '008') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Batticaloa)</option>
							<option value="009" <?php if (!empty($u14) && $u14 == '009') echo 'selected = "selected"'; ?>>South Eastern University of Sri Lanka (Oluvil)</option>
							<option value="010" <?php if (!empty($u14) && $u14 == '010') echo 'selected = "selected"'; ?>>Rajarata University of Sri Lanka (Mihintale)</option>
							<option value="011" <?php if (!empty($u14) && $u14 == '011') echo 'selected = "selected"'; ?>>Sabaragamuwa University of Sri Lanka (Belihuloya)</option>
							<option value="012" <?php if (!empty($u14) && $u14 == '012') echo 'selected = "selected"'; ?>>Wayamba University of Sri Lanka (Kuliyapitiya)</option>
							<option value="013" <?php if (!empty($u14) && $u14 == '013') echo 'selected = "selected"'; ?>>Institute of Indigenous Medicine</option>
							<option value="014" <?php if (!empty($u14) && $u14 == '014') echo 'selected = "selected"'; ?>>Gampaha Wickramarachchi Ayurveda Institute</option>
							<option value="015" <?php if (!empty($u14) && $u14 == '015') echo 'selected = "selected"'; ?>>University of Jaffna (Vavuniya Campus)</option>
							<option value="016" <?php if (!empty($u14) && $u14 == '016') echo 'selected = "selected"'; ?>>University of Colombo (Sripalee Campus)</option>
							<option value="017" <?php if (!empty($u14) && $u14 == '017') echo 'selected = "selected"'; ?>>University of Colombo School of Computing</option>
							<option value="018" <?php if (!empty($u14) && $u14 == '018') echo 'selected = "selected"'; ?>>Uva Wellassa University of Sri Lanka (Badulla)</option>
							<option value="019" <?php if (!empty($u14) && $u14 == '019') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Trincomalee Campus)</option>
							<option value="020" <?php if (!empty($u14) && $u14 == '020') echo 'selected = "selected"'; ?>>Swami Vipulananda Institute of Aesthetic Studies (Eastern)</option>
							<option value="021" <?php if (!empty($u14) && $u14 == '021') echo 'selected = "selected"'; ?>>University of the Visual and Performing Arts</option>
						</select>
						 </td>
					   </tr>
					   <tr align="center">
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
					   </tr>
					   <tr align="center">
						 <td>15. </td>
						 <td>
						 <select name="c15" id="c15">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($c15) && $c15 == '001') echo 'selected = "selected"'; ?>>Medicine</option>
							<option value="002" <?php if (!empty($c15) && $c15 == '002') echo 'selected = "selected"'; ?>>Dental Surgery</option>
							<option value="003" <?php if (!empty($c15) && $c15 == '003') echo 'selected = "selected"'; ?>>Veterinary Science</option>
							<option value="004" <?php if (!empty($c15) && $c15 == '004') echo 'selected = "selected"'; ?>>Agriculture</option>
							<option value="005" <?php if (!empty($c15) && $c15 == '005') echo 'selected = "selected"'; ?>>Food Science and Nutrition</option>
							<option value="006" <?php if (!empty($c15) && $c15 == '006') echo 'selected = "selected"'; ?>>Biological Science</option>
							<option value="007" <?php if (!empty($c15) && $c15 == '007') echo 'selected = "selected"'; ?>>Applied Sciences - Bio.Sci</option>
							<option value="008" <?php if (!empty($c15) && $c15 == '008') echo 'selected = "selected"'; ?>>Engineering</option>
							<option value="009" <?php if (!empty($c15) && $c15 == '009') echo 'selected = "selected"'; ?>>Engineering - EM</option>
							<option value="010" <?php if (!empty($c15) && $c15 == '010') echo 'selected = "selected"'; ?>>Engineering - TM</option>
							<option value="011" <?php if (!empty($c15) && $c15 == '011') echo 'selected = "selected"'; ?>>Quantity Surveying</option>
							<option value="012" <?php if (!empty($c15) && $c15 == '012') echo 'selected = "selected"'; ?>>Computer Science</option>
							<option value="013" <?php if (!empty($c15) && $c15 == '013') echo 'selected = "selected"'; ?>>Physical Science</option>
							<option value="014" <?php if (!empty($c15) && $c15 == '014') echo 'selected = "selected"'; ?>>Surveying Science</option>
							<option value="015" <?php if (!empty($c15) && $c15 == '015') echo 'selected = "selected"'; ?>>Applied Sciences - Phy.Sci</option>
						</select>
						</td>
						 <td>
						 <select name="u15" id="u15">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($u15) && $u15 == '001') echo 'selected = "selected"'; ?>>University of Colombo</option>
							<option value="002" <?php if (!empty($u15) && $u15 == '002') echo 'selected = "selected"'; ?>>University of  Peradeniya</option>
							<option value="003" <?php if (!empty($u15) && $u15 == '003') echo 'selected = "selected"'; ?>>University of Sri Jayawardenapura</option>
							<option value="004" <?php if (!empty($u15) && $u15 == '004') echo 'selected = "selected"'; ?>>University of Kelaniya</option>
							<option value="005" <?php if (!empty($u15) && $u15 == '005') echo 'selected = "selected"'; ?>>University of Jaffna</option>
							<option value="006" <?php if (!empty($u15) && $u15 == '006') echo 'selected = "selected"'; ?>>University of Ruhuna (Matara)</option>
							<option value="007" <?php if (!empty($u15) && $u15 == '007') echo 'selected = "selected"'; ?>>University of Moratuwa</option>
							<option value="008" <?php if (!empty($u15) && $u15 == '008') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Batticaloa)</option>
							<option value="009" <?php if (!empty($u15) && $u15 == '009') echo 'selected = "selected"'; ?>>South Eastern University of Sri Lanka (Oluvil)</option>
							<option value="010" <?php if (!empty($u15) && $u15 == '010') echo 'selected = "selected"'; ?>>Rajarata University of Sri Lanka (Mihintale)</option>
							<option value="011" <?php if (!empty($u15) && $u15 == '011') echo 'selected = "selected"'; ?>>Sabaragamuwa University of Sri Lanka (Belihuloya)</option>
							<option value="012" <?php if (!empty($u15) && $u15 == '012') echo 'selected = "selected"'; ?>>Wayamba University of Sri Lanka (Kuliyapitiya)</option>
							<option value="013" <?php if (!empty($u15) && $u15 == '013') echo 'selected = "selected"'; ?>>Institute of Indigenous Medicine</option>
							<option value="014" <?php if (!empty($u15) && $u15 == '014') echo 'selected = "selected"'; ?>>Gampaha Wickramarachchi Ayurveda Institute</option>
							<option value="015" <?php if (!empty($u15) && $u15 == '015') echo 'selected = "selected"'; ?>>University of Jaffna (Vavuniya Campus)</option>
							<option value="016" <?php if (!empty($u15) && $u15 == '016') echo 'selected = "selected"'; ?>>University of Colombo (Sripalee Campus)</option>
							<option value="017" <?php if (!empty($u15) && $u15 == '017') echo 'selected = "selected"'; ?>>University of Colombo School of Computing</option>
							<option value="018" <?php if (!empty($u15) && $u15 == '018') echo 'selected = "selected"'; ?>>Uva Wellassa University of Sri Lanka (Badulla)</option>
							<option value="019" <?php if (!empty($u15) && $u15 == '019') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Trincomalee Campus)</option>
							<option value="020" <?php if (!empty($u15) && $u15 == '020') echo 'selected = "selected"'; ?>>Swami Vipulananda Institute of Aesthetic Studies (Eastern)</option>
							<option value="021" <?php if (!empty($u15) && $u15 == '021') echo 'selected = "selected"'; ?>>University of the Visual and Performing Arts</option>
						</select>
						 </td>
					   </tr>
					   <tr align="center">
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
					   </tr>
					   <tr align="center">
						 <td>16. </td>
						 <td>
						 <select name="c16" id="c16">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($c16) && $c16 == '001') echo 'selected = "selected"'; ?>>Medicine</option>
							<option value="002" <?php if (!empty($c16) && $c16 == '002') echo 'selected = "selected"'; ?>>Dental Surgery</option>
							<option value="003" <?php if (!empty($c16) && $c16 == '003') echo 'selected = "selected"'; ?>>Veterinary Science</option>
							<option value="004" <?php if (!empty($c16) && $c16 == '004') echo 'selected = "selected"'; ?>>Agriculture</option>
							<option value="005" <?php if (!empty($c16) && $c16 == '005') echo 'selected = "selected"'; ?>>Food Science and Nutrition</option>
							<option value="006" <?php if (!empty($c16) && $c16 == '006') echo 'selected = "selected"'; ?>>Biological Science</option>
							<option value="007" <?php if (!empty($c16) && $c16 == '007') echo 'selected = "selected"'; ?>>Applied Sciences - Bio.Sci</option>
							<option value="008" <?php if (!empty($c16) && $c16 == '008') echo 'selected = "selected"'; ?>>Engineering</option>
							<option value="009" <?php if (!empty($c16) && $c16 == '009') echo 'selected = "selected"'; ?>>Engineering - EM</option>
							<option value="010" <?php if (!empty($c16) && $c16 == '010') echo 'selected = "selected"'; ?>>Engineering - TM</option>
							<option value="011" <?php if (!empty($c16) && $c16 == '011') echo 'selected = "selected"'; ?>>Quantity Surveying</option>
							<option value="012" <?php if (!empty($c16) && $c16 == '012') echo 'selected = "selected"'; ?>>Computer Science</option>
							<option value="013" <?php if (!empty($c16) && $c16 == '013') echo 'selected = "selected"'; ?>>Physical Science</option>
							<option value="014" <?php if (!empty($c16) && $c16 == '014') echo 'selected = "selected"'; ?>>Surveying Science</option>
							<option value="015" <?php if (!empty($c16) && $c16 == '015') echo 'selected = "selected"'; ?>>Applied Sciences - Phy.Sci</option>
						</select>
						</td>
						 <td>
						 <select name="u16" id="u16">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($u16) && $u16 == '001') echo 'selected = "selected"'; ?>>University of Colombo</option>
							<option value="002" <?php if (!empty($u16) && $u16 == '002') echo 'selected = "selected"'; ?>>University of  Peradeniya</option>
							<option value="003" <?php if (!empty($u16) && $u16 == '003') echo 'selected = "selected"'; ?>>University of Sri Jayawardenapura</option>
							<option value="004" <?php if (!empty($u16) && $u16 == '004') echo 'selected = "selected"'; ?>>University of Kelaniya</option>
							<option value="005" <?php if (!empty($u16) && $u16 == '005') echo 'selected = "selected"'; ?>>University of Jaffna</option>
							<option value="006" <?php if (!empty($u16) && $u16 == '006') echo 'selected = "selected"'; ?>>University of Ruhuna (Matara)</option>
							<option value="007" <?php if (!empty($u16) && $u16 == '007') echo 'selected = "selected"'; ?>>University of Moratuwa</option>
							<option value="008" <?php if (!empty($u16) && $u16 == '008') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Batticaloa)</option>
							<option value="009" <?php if (!empty($u16) && $u16 == '009') echo 'selected = "selected"'; ?>>South Eastern University of Sri Lanka (Oluvil)</option>
							<option value="010" <?php if (!empty($u16) && $u16 == '010') echo 'selected = "selected"'; ?>>Rajarata University of Sri Lanka (Mihintale)</option>
							<option value="011" <?php if (!empty($u16) && $u16 == '011') echo 'selected = "selected"'; ?>>Sabaragamuwa University of Sri Lanka (Belihuloya)</option>
							<option value="012" <?php if (!empty($u16) && $u16 == '012') echo 'selected = "selected"'; ?>>Wayamba University of Sri Lanka (Kuliyapitiya)</option>
							<option value="013" <?php if (!empty($u16) && $u16 == '013') echo 'selected = "selected"'; ?>>Institute of Indigenous Medicine</option>
							<option value="014" <?php if (!empty($u16) && $u16 == '014') echo 'selected = "selected"'; ?>>Gampaha Wickramarachchi Ayurveda Institute</option>
							<option value="015" <?php if (!empty($u16) && $u16 == '015') echo 'selected = "selected"'; ?>>University of Jaffna (Vavuniya Campus)</option>
							<option value="016" <?php if (!empty($u16) && $u16 == '016') echo 'selected = "selected"'; ?>>University of Colombo (Sripalee Campus)</option>
							<option value="017" <?php if (!empty($u16) && $u16 == '017') echo 'selected = "selected"'; ?>>University of Colombo School of Computing</option>
							<option value="018" <?php if (!empty($u16) && $u16 == '018') echo 'selected = "selected"'; ?>>Uva Wellassa University of Sri Lanka (Badulla)</option>
							<option value="019" <?php if (!empty($u16) && $u16 == '019') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Trincomalee Campus)</option>
							<option value="020" <?php if (!empty($u16) && $u16 == '020') echo 'selected = "selected"'; ?>>Swami Vipulananda Institute of Aesthetic Studies (Eastern)</option>
							<option value="021" <?php if (!empty($u16) && $u16 == '021') echo 'selected = "selected"'; ?>>University of the Visual and Performing Arts</option>
						</select>
						 </td>
					   </tr>
					   <tr align="center">
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
					   </tr>
					   <tr align="center">
						 <td>17. </td>
						 <td>
						 <select name="c17" id="c17">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($c17) && $c17 == '001') echo 'selected = "selected"'; ?>>Medicine</option>
							<option value="002" <?php if (!empty($c17) && $c17 == '002') echo 'selected = "selected"'; ?>>Dental Surgery</option>
							<option value="003" <?php if (!empty($c17) && $c17 == '003') echo 'selected = "selected"'; ?>>Veterinary Science</option>
							<option value="004" <?php if (!empty($c17) && $c17 == '004') echo 'selected = "selected"'; ?>>Agriculture</option>
							<option value="005" <?php if (!empty($c17) && $c17 == '005') echo 'selected = "selected"'; ?>>Food Science and Nutrition</option>
							<option value="006" <?php if (!empty($c17) && $c17 == '006') echo 'selected = "selected"'; ?>>Biological Science</option>
							<option value="007" <?php if (!empty($c17) && $c17 == '007') echo 'selected = "selected"'; ?>>Applied Sciences - Bio.Sci</option>
							<option value="008" <?php if (!empty($c17) && $c17 == '008') echo 'selected = "selected"'; ?>>Engineering</option>
							<option value="009" <?php if (!empty($c17) && $c17 == '009') echo 'selected = "selected"'; ?>>Engineering - EM</option>
							<option value="010" <?php if (!empty($c17) && $c17 == '010') echo 'selected = "selected"'; ?>>Engineering - TM</option>
							<option value="011" <?php if (!empty($c17) && $c17 == '011') echo 'selected = "selected"'; ?>>Quantity Surveying</option>
							<option value="012" <?php if (!empty($c17) && $c17 == '012') echo 'selected = "selected"'; ?>>Computer Science</option>
							<option value="013" <?php if (!empty($c17) && $c17 == '013') echo 'selected = "selected"'; ?>>Physical Science</option>
							<option value="014" <?php if (!empty($c17) && $c17 == '014') echo 'selected = "selected"'; ?>>Surveying Science</option>
							<option value="015" <?php if (!empty($c17) && $c17 == '015') echo 'selected = "selected"'; ?>>Applied Sciences - Phy.Sci</option>
						</select>
						</td>
						 <td>
						 <select name="u17" id="u17">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($u17) && $u17 == '001') echo 'selected = "selected"'; ?>>University of Colombo</option>
							<option value="002" <?php if (!empty($u17) && $u17 == '002') echo 'selected = "selected"'; ?>>University of  Peradeniya</option>
							<option value="003" <?php if (!empty($u17) && $u17 == '003') echo 'selected = "selected"'; ?>>University of Sri Jayawardenapura</option>
							<option value="004" <?php if (!empty($u17) && $u17 == '004') echo 'selected = "selected"'; ?>>University of Kelaniya</option>
							<option value="005" <?php if (!empty($u17) && $u17 == '005') echo 'selected = "selected"'; ?>>University of Jaffna</option>
							<option value="006" <?php if (!empty($u17) && $u17 == '006') echo 'selected = "selected"'; ?>>University of Ruhuna (Matara)</option>
							<option value="007" <?php if (!empty($u17) && $u17 == '007') echo 'selected = "selected"'; ?>>University of Moratuwa</option>
							<option value="008" <?php if (!empty($u17) && $u17 == '008') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Batticaloa)</option>
							<option value="009" <?php if (!empty($u17) && $u17 == '009') echo 'selected = "selected"'; ?>>South Eastern University of Sri Lanka (Oluvil)</option>
							<option value="010" <?php if (!empty($u17) && $u17 == '010') echo 'selected = "selected"'; ?>>Rajarata University of Sri Lanka (Mihintale)</option>
							<option value="011" <?php if (!empty($u17) && $u17 == '011') echo 'selected = "selected"'; ?>>Sabaragamuwa University of Sri Lanka (Belihuloya)</option>
							<option value="012" <?php if (!empty($u17) && $u17 == '012') echo 'selected = "selected"'; ?>>Wayamba University of Sri Lanka (Kuliyapitiya)</option>
							<option value="013" <?php if (!empty($u17) && $u17 == '013') echo 'selected = "selected"'; ?>>Institute of Indigenous Medicine</option>
							<option value="014" <?php if (!empty($u17) && $u17 == '014') echo 'selected = "selected"'; ?>>Gampaha Wickramarachchi Ayurveda Institute</option>
							<option value="015" <?php if (!empty($u17) && $u17 == '015') echo 'selected = "selected"'; ?>>University of Jaffna (Vavuniya Campus)</option>
							<option value="016" <?php if (!empty($u17) && $u17 == '016') echo 'selected = "selected"'; ?>>University of Colombo (Sripalee Campus)</option>
							<option value="017" <?php if (!empty($u17) && $u17 == '017') echo 'selected = "selected"'; ?>>University of Colombo School of Computing</option>
							<option value="018" <?php if (!empty($u17) && $u17 == '018') echo 'selected = "selected"'; ?>>Uva Wellassa University of Sri Lanka (Badulla)</option>
							<option value="019" <?php if (!empty($u17) && $u17 == '019') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Trincomalee Campus)</option>
							<option value="020" <?php if (!empty($u17) && $u17 == '020') echo 'selected = "selected"'; ?>>Swami Vipulananda Institute of Aesthetic Studies (Eastern)</option>
							<option value="021" <?php if (!empty($u17) && $u17 == '021') echo 'selected = "selected"'; ?>>University of the Visual and Performing Arts</option>
						</select>
						 </td>
					   </tr>
					   <tr align="center">
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
					   </tr>
					   <tr align="center">
						 <td>18. </td>
						 <td>
						 <select name="c18" id="c18">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($c18) && $c18 == '001') echo 'selected = "selected"'; ?>>Medicine</option>
							<option value="002" <?php if (!empty($c18) && $c18 == '002') echo 'selected = "selected"'; ?>>Dental Surgery</option>
							<option value="003" <?php if (!empty($c18) && $c18 == '003') echo 'selected = "selected"'; ?>>Veterinary Science</option>
							<option value="004" <?php if (!empty($c18) && $c18 == '004') echo 'selected = "selected"'; ?>>Agriculture</option>
							<option value="005" <?php if (!empty($c18) && $c18 == '005') echo 'selected = "selected"'; ?>>Food Science and Nutrition</option>
							<option value="006" <?php if (!empty($c18) && $c18 == '006') echo 'selected = "selected"'; ?>>Biological Science</option>
							<option value="007" <?php if (!empty($c18) && $c18 == '007') echo 'selected = "selected"'; ?>>Applied Sciences - Bio.Sci</option>
							<option value="008" <?php if (!empty($c18) && $c18 == '008') echo 'selected = "selected"'; ?>>Engineering</option>
							<option value="009" <?php if (!empty($c18) && $c18 == '009') echo 'selected = "selected"'; ?>>Engineering - EM</option>
							<option value="010" <?php if (!empty($c18) && $c18 == '010') echo 'selected = "selected"'; ?>>Engineering - TM</option>
							<option value="011" <?php if (!empty($c18) && $c18 == '011') echo 'selected = "selected"'; ?>>Quantity Surveying</option>
							<option value="012" <?php if (!empty($c18) && $c18 == '012') echo 'selected = "selected"'; ?>>Computer Science</option>
							<option value="013" <?php if (!empty($c18) && $c18 == '013') echo 'selected = "selected"'; ?>>Physical Science</option>
							<option value="014" <?php if (!empty($c18) && $c18 == '014') echo 'selected = "selected"'; ?>>Surveying Science</option>
							<option value="015" <?php if (!empty($c18) && $c18 == '015') echo 'selected = "selected"'; ?>>Applied Sciences - Phy.Sci</option>
						</select>
						</td>
						 <td>
						 <select name="u18" id="u18">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($u18) && $u18 == '001') echo 'selected = "selected"'; ?>>University of Colombo</option>
							<option value="002" <?php if (!empty($u18) && $u18 == '002') echo 'selected = "selected"'; ?>>University of  Peradeniya</option>
							<option value="003" <?php if (!empty($u18) && $u18 == '003') echo 'selected = "selected"'; ?>>University of Sri Jayawardenapura</option>
							<option value="004" <?php if (!empty($u18) && $u18 == '004') echo 'selected = "selected"'; ?>>University of Kelaniya</option>
							<option value="005" <?php if (!empty($u18) && $u18 == '005') echo 'selected = "selected"'; ?>>University of Jaffna</option>
							<option value="006" <?php if (!empty($u18) && $u18 == '006') echo 'selected = "selected"'; ?>>University of Ruhuna (Matara)</option>
							<option value="007" <?php if (!empty($u18) && $u18 == '007') echo 'selected = "selected"'; ?>>University of Moratuwa</option>
							<option value="008" <?php if (!empty($u18) && $u18 == '008') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Batticaloa)</option>
							<option value="009" <?php if (!empty($u18) && $u18 == '009') echo 'selected = "selected"'; ?>>South Eastern University of Sri Lanka (Oluvil)</option>
							<option value="010" <?php if (!empty($u18) && $u18 == '010') echo 'selected = "selected"'; ?>>Rajarata University of Sri Lanka (Mihintale)</option>
							<option value="011" <?php if (!empty($u18) && $u18 == '011') echo 'selected = "selected"'; ?>>Sabaragamuwa University of Sri Lanka (Belihuloya)</option>
							<option value="012" <?php if (!empty($u18) && $u18 == '012') echo 'selected = "selected"'; ?>>Wayamba University of Sri Lanka (Kuliyapitiya)</option>
							<option value="013" <?php if (!empty($u18) && $u18 == '013') echo 'selected = "selected"'; ?>>Institute of Indigenous Medicine</option>
							<option value="014" <?php if (!empty($u18) && $u18 == '014') echo 'selected = "selected"'; ?>>Gampaha Wickramarachchi Ayurveda Institute</option>
							<option value="015" <?php if (!empty($u18) && $u18 == '015') echo 'selected = "selected"'; ?>>University of Jaffna (Vavuniya Campus)</option>
							<option value="016" <?php if (!empty($u18) && $u18 == '016') echo 'selected = "selected"'; ?>>University of Colombo (Sripalee Campus)</option>
							<option value="017" <?php if (!empty($u18) && $u18 == '017') echo 'selected = "selected"'; ?>>University of Colombo School of Computing</option>
							<option value="018" <?php if (!empty($u18) && $u18 == '018') echo 'selected = "selected"'; ?>>Uva Wellassa University of Sri Lanka (Badulla)</option>
							<option value="019" <?php if (!empty($u18) && $u18 == '019') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Trincomalee Campus)</option>
							<option value="020" <?php if (!empty($u18) && $u18 == '020') echo 'selected = "selected"'; ?>>Swami Vipulananda Institute of Aesthetic Studies (Eastern)</option>
							<option value="021" <?php if (!empty($u18) && $u18 == '021') echo 'selected = "selected"'; ?>>University of the Visual and Performing Arts</option>
						</select>
						 </td>
					   </tr>
					   <tr align="center">
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
					   </tr>
					   <tr align="center">
						 <td>19. </td>
						 <td>
						 <select name="c19" id="c19">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($c19) && $c19 == '001') echo 'selected = "selected"'; ?>>Medicine</option>
							<option value="002" <?php if (!empty($c19) && $c19 == '002') echo 'selected = "selected"'; ?>>Dental Surgery</option>
							<option value="003" <?php if (!empty($c19) && $c19 == '003') echo 'selected = "selected"'; ?>>Veterinary Science</option>
							<option value="004" <?php if (!empty($c19) && $c19 == '004') echo 'selected = "selected"'; ?>>Agriculture</option>
							<option value="005" <?php if (!empty($c19) && $c19 == '005') echo 'selected = "selected"'; ?>>Food Science and Nutrition</option>
							<option value="006" <?php if (!empty($c19) && $c19 == '006') echo 'selected = "selected"'; ?>>Biological Science</option>
							<option value="007" <?php if (!empty($c19) && $c19 == '007') echo 'selected = "selected"'; ?>>Applied Sciences - Bio.Sci</option>
							<option value="008" <?php if (!empty($c19) && $c19 == '008') echo 'selected = "selected"'; ?>>Engineering</option>
							<option value="009" <?php if (!empty($c19) && $c19 == '009') echo 'selected = "selected"'; ?>>Engineering - EM</option>
							<option value="010" <?php if (!empty($c19) && $c19 == '010') echo 'selected = "selected"'; ?>>Engineering - TM</option>
							<option value="011" <?php if (!empty($c19) && $c19 == '011') echo 'selected = "selected"'; ?>>Quantity Surveying</option>
							<option value="012" <?php if (!empty($c19) && $c19 == '012') echo 'selected = "selected"'; ?>>Computer Science</option>
							<option value="013" <?php if (!empty($c19) && $c19 == '013') echo 'selected = "selected"'; ?>>Physical Science</option>
							<option value="014" <?php if (!empty($c19) && $c19 == '014') echo 'selected = "selected"'; ?>>Surveying Science</option>
							<option value="015" <?php if (!empty($c19) && $c19 == '015') echo 'selected = "selected"'; ?>>Applied Sciences - Phy.Sci</option>
						</select>
						</td>
						 <td>
						 <select name="u19" id="u19">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($u19) && $u19 == '001') echo 'selected = "selected"'; ?>>University of Colombo</option>
							<option value="002" <?php if (!empty($u19) && $u19 == '002') echo 'selected = "selected"'; ?>>University of  Peradeniya</option>
							<option value="003" <?php if (!empty($u19) && $u19 == '003') echo 'selected = "selected"'; ?>>University of Sri Jayawardenapura</option>
							<option value="004" <?php if (!empty($u19) && $u19 == '004') echo 'selected = "selected"'; ?>>University of Kelaniya</option>
							<option value="005" <?php if (!empty($u19) && $u19 == '005') echo 'selected = "selected"'; ?>>University of Jaffna</option>
							<option value="006" <?php if (!empty($u19) && $u19 == '006') echo 'selected = "selected"'; ?>>University of Ruhuna (Matara)</option>
							<option value="007" <?php if (!empty($u19) && $u19 == '007') echo 'selected = "selected"'; ?>>University of Moratuwa</option>
							<option value="008" <?php if (!empty($u19) && $u19 == '008') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Batticaloa)</option>
							<option value="009" <?php if (!empty($u19) && $u19 == '009') echo 'selected = "selected"'; ?>>South Eastern University of Sri Lanka (Oluvil)</option>
							<option value="010" <?php if (!empty($u19) && $u19 == '010') echo 'selected = "selected"'; ?>>Rajarata University of Sri Lanka (Mihintale)</option>
							<option value="011" <?php if (!empty($u19) && $u19 == '011') echo 'selected = "selected"'; ?>>Sabaragamuwa University of Sri Lanka (Belihuloya)</option>
							<option value="012" <?php if (!empty($u19) && $u19 == '012') echo 'selected = "selected"'; ?>>Wayamba University of Sri Lanka (Kuliyapitiya)</option>
							<option value="013" <?php if (!empty($u19) && $u19 == '013') echo 'selected = "selected"'; ?>>Institute of Indigenous Medicine</option>
							<option value="014" <?php if (!empty($u19) && $u19 == '014') echo 'selected = "selected"'; ?>>Gampaha Wickramarachchi Ayurveda Institute</option>
							<option value="015" <?php if (!empty($u19) && $u19 == '015') echo 'selected = "selected"'; ?>>University of Jaffna (Vavuniya Campus)</option>
							<option value="016" <?php if (!empty($u19) && $u19 == '016') echo 'selected = "selected"'; ?>>University of Colombo (Sripalee Campus)</option>
							<option value="017" <?php if (!empty($u19) && $u19 == '017') echo 'selected = "selected"'; ?>>University of Colombo School of Computing</option>
							<option value="018" <?php if (!empty($u19) && $u19 == '018') echo 'selected = "selected"'; ?>>Uva Wellassa University of Sri Lanka (Badulla)</option>
							<option value="019" <?php if (!empty($u19) && $u19 == '019') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Trincomalee Campus)</option>
							<option value="020" <?php if (!empty($u19) && $u19 == '020') echo 'selected = "selected"'; ?>>Swami Vipulananda Institute of Aesthetic Studies (Eastern)</option>
							<option value="021" <?php if (!empty($u19) && $u19 == '021') echo 'selected = "selected"'; ?>>University of the Visual and Performing Arts</option>
						</select>
						 </td>
					   </tr>
					   <tr align="center">
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
						 <td>&nbsp;</td>
					   </tr>
					   <tr align="center">
						 <td>20. </td>
						 <td>
						 <select name="c20" id="c20">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($c20) && $c20 == '001') echo 'selected = "selected"'; ?>>Medicine</option>
							<option value="002" <?php if (!empty($c20) && $c20 == '002') echo 'selected = "selected"'; ?>>Dental Surgery</option>
							<option value="003" <?php if (!empty($c20) && $c20 == '003') echo 'selected = "selected"'; ?>>Veterinary Science</option>
							<option value="004" <?php if (!empty($c20) && $c20 == '004') echo 'selected = "selected"'; ?>>Agriculture</option>
							<option value="005" <?php if (!empty($c20) && $c20 == '005') echo 'selected = "selected"'; ?>>Food Science and Nutrition</option>
							<option value="006" <?php if (!empty($c20) && $c20 == '006') echo 'selected = "selected"'; ?>>Biological Science</option>
							<option value="007" <?php if (!empty($c20) && $c20 == '007') echo 'selected = "selected"'; ?>>Applied Sciences - Bio.Sci</option>
							<option value="008" <?php if (!empty($c20) && $c20 == '008') echo 'selected = "selected"'; ?>>Engineering</option>
							<option value="009" <?php if (!empty($c20) && $c20 == '009') echo 'selected = "selected"'; ?>>Engineering - EM</option>
							<option value="010" <?php if (!empty($c20) && $c20 == '010') echo 'selected = "selected"'; ?>>Engineering - TM</option>
							<option value="011" <?php if (!empty($c20) && $c20 == '011') echo 'selected = "selected"'; ?>>Quantity Surveying</option>
							<option value="012" <?php if (!empty($c20) && $c20 == '012') echo 'selected = "selected"'; ?>>Computer Science</option>
							<option value="013" <?php if (!empty($c20) && $c20 == '013') echo 'selected = "selected"'; ?>>Physical Science</option>
							<option value="014" <?php if (!empty($c20) && $c20 == '014') echo 'selected = "selected"'; ?>>Surveying Science</option>
							<option value="015" <?php if (!empty($c20) && $c20 == '015') echo 'selected = "selected"'; ?>>Applied Sciences - Phy.Sci</option>
						</select>
						</td>
						 <td>
						 <select name="u20" id="u20">
							<option value="">--Choose one--</option>
							<option value="001" <?php if (!empty($u20) && $u20 == '001') echo 'selected = "selected"'; ?>>University of Colombo</option>
							<option value="002" <?php if (!empty($u20) && $u20 == '002') echo 'selected = "selected"'; ?>>University of  Peradeniya</option>
							<option value="003" <?php if (!empty($u20) && $u20 == '003') echo 'selected = "selected"'; ?>>University of Sri Jayawardenapura</option>
							<option value="004" <?php if (!empty($u20) && $u20 == '004') echo 'selected = "selected"'; ?>>University of Kelaniya</option>
							<option value="005" <?php if (!empty($u20) && $u20 == '005') echo 'selected = "selected"'; ?>>University of Jaffna</option>
							<option value="006" <?php if (!empty($u20) && $u20 == '006') echo 'selected = "selected"'; ?>>University of Ruhuna (Matara)</option>
							<option value="007" <?php if (!empty($u20) && $u20 == '007') echo 'selected = "selected"'; ?>>University of Moratuwa</option>
							<option value="008" <?php if (!empty($u20) && $u20 == '008') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Batticaloa)</option>
							<option value="009" <?php if (!empty($u20) && $u20 == '009') echo 'selected = "selected"'; ?>>South Eastern University of Sri Lanka (Oluvil)</option>
							<option value="010" <?php if (!empty($u20) && $u20 == '010') echo 'selected = "selected"'; ?>>Rajarata University of Sri Lanka (Mihintale)</option>
							<option value="011" <?php if (!empty($u20) && $u20 == '011') echo 'selected = "selected"'; ?>>Sabaragamuwa University of Sri Lanka (Belihuloya)</option>
							<option value="012" <?php if (!empty($u20) && $u20 == '012') echo 'selected = "selected"'; ?>>Wayamba University of Sri Lanka (Kuliyapitiya)</option>
							<option value="013" <?php if (!empty($u20) && $u20 == '013') echo 'selected = "selected"'; ?>>Institute of Indigenous Medicine</option>
							<option value="014" <?php if (!empty($u20) && $u20 == '014') echo 'selected = "selected"'; ?>>Gampaha Wickramarachchi Ayurveda Institute</option>
							<option value="015" <?php if (!empty($u20) && $u20 == '015') echo 'selected = "selected"'; ?>>University of Jaffna (Vavuniya Campus)</option>
							<option value="016" <?php if (!empty($u20) && $u20 == '016') echo 'selected = "selected"'; ?>>University of Colombo (Sripalee Campus)</option>
							<option value="017" <?php if (!empty($u20) && $u20 == '017') echo 'selected = "selected"'; ?>>University of Colombo School of Computing</option>
							<option value="018" <?php if (!empty($u20) && $u20 == '018') echo 'selected = "selected"'; ?>>Uva Wellassa University of Sri Lanka (Badulla)</option>
							<option value="019" <?php if (!empty($u20) && $u20 == '019') echo 'selected = "selected"'; ?>>Eastern University of Sri Lanka (Trincomalee Campus)</option>
							<option value="020" <?php if (!empty($u20) && $u20 == '020') echo 'selected = "selected"'; ?>>Swami Vipulananda Institute of Aesthetic Studies (Eastern)</option>
							<option value="021" <?php if (!empty($u20) && $u20 == '021') echo 'selected = "selected"'; ?>>University of the Visual and Performing Arts</option>
						</select>
						 </td>
					   </tr>
					  </table>
					  </p>
					  </fieldset>
					  <p>
					  <br />
						<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<input name="submit" id="submit" type="submit" value="Submit" />
						<input name="cancel" id="cancel" type="button" value="Cancel" />
					  </p>
						
					  </form>
			  <?php
                        } elseif (empty($deadline_error_msg2) && !empty($application_error_msg)) {
							
							echo '<p class="error_message">' . $application_error_msg . '</p>';	
							
							} elseif (!empty($deadline_error_msg2)) {
								
								echo '<p class="deadline_error_message2">' . $deadline_error_msg2 . '</p>';
								
								}
                } else {
                    echo '<p>You must login to view this page - <a href="login.php">Login</a></p>';
                }
              	?>
        </div>
        </div>
        
    <div id="content_footer"></div>
    <div id="footer">
    <?php
	require_once('footerconstants.php');
	
	echo '<p align="center">' . COPYRIGHT1 . '</p>';
	echo '<p align="center">' . COPYRIGHT2 . '</p>';
	?>
    </div>
    </body>
</html>