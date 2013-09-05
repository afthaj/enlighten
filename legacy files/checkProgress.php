<?php
  require_once('connectvars.php');

  session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['applicantID'])) {
    if (isset($_COOKIE['applicantID']) && isset($_COOKIE['username'])) {
      $_SESSION['applicantID'] = $_COOKIE['applicantID'];
      $_SESSION['username'] = $_COOKIE['username'];
	  $_SESSION['firstname'] = $_COOKIE['firstName'];
	  $_SESSION['lastname'] = $_COOKIE['lastName'];
	  $_SESSION['nationalID'] = $_COOKIE['nationalID'];
	  $_SESSION['ALIndexNumber'] = $_COOKIE['ALIndexNumber'];
    }
  } else {
	  $_SESSION['applicantID'] = $_COOKIE['applicantID'];
      $_SESSION['username'] = $_COOKIE['username'];
	  $_SESSION['firstname'] = $_COOKIE['firstName'];
	  $_SESSION['lastname'] = $_COOKIE['lastName'];
	  $_SESSION['nationalID'] = $_COOKIE['nationalID'];
	  $_SESSION['ALIndexNumber'] = $_COOKIE['ALIndexNumber'];
	  }
	  
if (isset($_POST['submit'])) {
	
	$ALIndexNumber = $_POST['ALIndexNumber'];

	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$query = "SELECT * FROM application WHERE ALIndexNumber = '$ALIndexNumber'";
	$data = mysqli_query($dbc, $query);
	$row = mysqli_fetch_array($data);
	
	if ($row != NULL) {
		
		$applicationID = $row['applicationID'];
		$selectedFlag = $row['selectedFlag'];
		$ifSelectedUniversityCode = $row['ifSelectedUniversityCode'];
		$ifSelectedCourseID = $row['ifSelectedCourseID'];
		$applicationProgress = $row['applicationProgress'];
		$registeredFlag = $row['registeredFlag'];
		
		$query2 = "SELECT * FROM university WHERE universityCode ='" . $ifSelectedUniversityCode . "'";
		$data2 = mysqli_query($dbc, $query2);
		$row2 = mysqli_fetch_array($data2);
		
		$universityName = $row2['universityName'];
		
		$query3 = "SELECT * FROM course WHERE courseID ='" . $ifSelectedCourseID . "'";
		$data3 = mysqli_query($dbc, $query3);
		$row3 = mysqli_fetch_array($data3);
		
		$courseName = $row3['courseName'];
		
		if ($applicationProgress == 04) {
			if (!empty($selectedFlag)) {
				$result_msg = 'Your Index Number is ' . $ALIndexNumber . '.';
				$result_msg2 = 'Your Application has been Processed.';
				$result_msg3 = 'You have been selected to the ' . $universityName . '.';
				$result_msg4 = 'You have been selected for ' . $courseName . '.';
				}
			} elseif ($applicationProgress == 03) {
				$result_msg = 'Your Index Number is ' . $ALIndexNumber . '.';
				$result_msg2 = 'Your Application is being processed. Please check back here soon.';
				$result_msg3 = '';
				} elseif ($applicationProgress == 02) {
					$result_msg = 'Your Index Number is ' . $ALIndexNumber . '.';
					$result_msg2 = 'Your Supporting Documents have been received. Your Application will be processed soon.';
					} elseif ($applicationProgress == 01) {
						$result_msg = 'Your Index Number is ' . $ALIndexNumber . '.';
						$result_msg2 = 'Your Application has been submitted. Please attach your Application ID and send in your Supporting Documents.';
						$error_msg2 = 'CAUTION: Applications without Supporting Documentation will be discarded without being processed.';
						}
				
		} else {
			$error_msg = 'There is no application under that Index Number. Please try again.';
			$result_msg = '';
			$result_msg2 = '';
			$result_msg3 = '';
			}

	mysqli_close($dbc);

	} else {
		  $result_msg = '';
		  $result_msg2 = '';
		  $result_msg3 = '';
		}
?>

<!DOCTYPE HTML>
<html>

<head>
  <title>Check Progress | UAS</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
  
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
          <li class="selected"><a href="checkProgress.php">Check Application Progress</a></li>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
      <div id="content">
        <h1>Check Application Progress</h1>
    <?php
		if (!isset($_SESSION['applicantID'])) {
			// Applicant has not logged in
	?>
       <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" name="checkResultForm">      
       	<p>Please enter you Application ID to check the progress of a submitted application</p>
         <label for="ALIndexNumber">Index Number</label>
         <input type="text" name="ALIndexNumber" id="ALIndexNumber" value="<?php if (!empty($ALIndexNumber)) echo $ALIndexNumber; ?>" />
         <input name="submit" type="submit" value="Check Progress">
       </form>
       <?php
	   echo '<br />';
	   if (!empty($error_msg)) {echo '<p class="error_message">' . $error_msg . '</p>';}
	   if (!empty($result_msg)) {echo '<p class="result_msg">' . $result_msg . '</p>';}
	   if (!empty($result_msg2)) {echo '<p class="result_msg">' . $result_msg2 . '</p>';}
	   if (!empty($result_msg3)) {echo '<p class="result_msg">' . $result_msg3 . '</p>';}
	   if (!empty($result_msg4)) {echo '<p class="result_msg">' . $result_msg4 . '</p>';}
	   if (!empty($error_msg2)) {echo '<p class="error_message">' . $error_msg2 . '</p>';}
	   
		} else {
			// Applicant is already logged in
			// Fetch application data when applicant is logged in
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			
			$query = "SELECT * FROM application WHERE applicantID = '" . $_SESSION['applicantID'] . "'";
			
			$data = mysqli_query($dbc, $query);
			$row = mysqli_fetch_array($data);
			
			$applicationID = $row['applicationID'];
			$ALIndexNumber = $row['ALIndexNumber'];
			$selectedFlag = $row['selectedFlag'];
			$ifSelectedUniversityCode = $row['ifSelectedUniversityCode'];
			$ifSelectedCourseID = $row['ifSelectedCourseID'];
			$applicationProgress = $row['applicationProgress'];
			$registeredFlag = $row['registeredFlag'];
			
			$query2 = "SELECT * FROM university WHERE universityCode ='" . $ifSelectedUniversityCode . "'";
			$data2 = mysqli_query($dbc, $query2);
			$row2 = mysqli_fetch_array($data2);
			$universityName = $row2['universityName'];
			
			$query3 = "SELECT * FROM course WHERE courseID ='" . $ifSelectedCourseID . "'";
			$data3 = mysqli_query($dbc, $query3);
			$row3 = mysqli_fetch_array($data3);
			$courseName = $row3['courseName'];
			
			mysqli_close($dbc);
			
			if (!empty($applicationID)) {
				
				if ($applicationProgress == 04) {
					if (!empty($selectedFlag)) {
						echo '<p class="result_msg">Your Index Number is ' . $ALIndexNumber . '.</p>';
						echo '<p class="result_msg">Your Application has been Processed.</p>';
						echo '<p class="result_msg">You have been selected to the ' . $universityName . '.</p>';
						echo '<p class="result_msg">You have been selected for ' . $courseName . '.</p>';
						}
					} elseif ($applicationProgress == 03) {
						echo '<p class="result_msg">Your Index Number is ' . $ALIndexNumber . '.</p>';
						echo '<p class="result_msg">Your Application is being processed. Please check back here soon.</p>';
						} elseif ($applicationProgress == 02) {
							echo '<p class="result_msg">Your Index Number is ' . $ALIndexNumber . '.</p>';
							echo '<p class="result_msg">Your Supporting Documents have been received. Your Application will be processed soon.</p>';
							} elseif ($applicationProgress == 01) {
								echo '<p class="result_msg">Your Index Number is ' . $ALIndexNumber . '.</p>';
								echo '<p class="result_msg">Your Application has been submitted. Please attach your Application ID and send in your Supporting Documents.</p>';
								echo '<p class="error_message">CAUTION: Applications without Supporting Documentation will be discarded without being processed.</p>';
								}
				
				} else {
					echo '<p class="error_message">You have not submitted an application. Please submit an application <a href="applicationForm.php">here</a>.</p>';
					}
			}
       ?>
    	<p></p>
        <p></p>
      </div>
    </div>
	
    <div id="content_footer"></div>
    <div id="footer">
    <?php
	require_once('footerconstants.php');
	
	echo '<p align=center>' . COPYRIGHT1 . '</p>';
	echo '<p align=center>' . COPYRIGHT2 . '</p>';
	?>
    </div>
  </div>
</body>
</html>
