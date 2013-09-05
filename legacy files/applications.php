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
?>
  
<!DOCTYPE HTML>
<html>

<head>
  <title>Applications | UAS</title>
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
<script src="formscripts.js"></script>
<script src="images/galleria/src/jquery-1.4.2.js"></script>
<script src="images/galleria/src/galleria.js"></script>

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
          <li class="selected"><a href="applications.php">Applications</a></li>
          <li><a href="checkProgress.php">Check Application Progress</a></li>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
    <div id="content">
      <h1>Applications</h1>
      
      <?php
	  
	  if (isset($_SESSION['applicantID'])) {
				echo '<p>You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <a href="logout.php">Log Out</a></p>';
				
				if (!empty($error_msg)){
					echo '<p class="error_message">' . $error_msg . '</p>';
					}
	  
      ?>
      
      <p>Welcome to the Applications Panel of the University Admission System. In this page, you can apply for University Entrance and View/Edit a Submitted Application.</p>
      
      
      
      <table align="center" border="0">
        <tr align="center">
          <td><h3><a href="applicationForm.php">Apply for University Entrance</a></h3></td>
          <td><h3><a href="viewAndEditApplication.php">View/Edit Submitted Application</a></h3></td>
        </tr>
      </table>
      
      <?php
	  
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
  </div>
</body>
</html>
