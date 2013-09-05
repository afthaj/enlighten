<?php
  require_once('connectvars.php');

  // Start the session
  session_start();

  // Clear the error message
  $error_msg = "";

  // If the user isn't logged in, try to log them in
  if (!isset($_SESSION['applicantID'])) {
	  
			if (isset($_POST['submit'])) {
			  // Connect to the database
			  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		
			  // Grab the user-entered log-in data
			  $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
			  $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
		
						  if (!empty($username) && !empty($password)) {
							// Look up the username and password in the database
							$query = "SELECT * FROM applicant WHERE username = '$username' AND password = SHA('$password')";
							$data = mysqli_query($dbc, $query);
					
										if (mysqli_num_rows($data) == 1) {
										  // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
										  $row = mysqli_fetch_array($data);
										  $_SESSION['applicantID'] = $row['applicantID'];
										  $_SESSION['username'] = $row['username'];
										  $_SESSION['firstname'] = $row['firstName'];
										  $_SESSION['lastname'] = $row['lastName'];
										  $_SESSION['nationalID'] = $row['nationalID'];
										  $_SESSION['ALIndexNumber'] = $row['ALIndexNumber'];
										  
										  setcookie('applicantID', $row['applicantID'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
										  setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
										  setcookie('firstName', $row['firstName'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
										  setcookie('lastName', $row['lastName'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
										  setcookie('nationalID', $row['nationalID'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
										  setcookie('ALIndexNumber', $row['ALIndexNumber'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
										  
										  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'index.php';
										  $error_msg = 'Login Successful';
										  header('Location: ' . $home_url);
										}
										else {
										  // The username/password are incorrect so set an error message
										  $error_msg = 'Sorry, you must enter a valid username and password to log in.';
										}
						  }
						  else {
							// The username/password weren't entered so set an error message
							$error_msg = 'Sorry, you must enter your username and password to log in.';
						  }
			}		
  }
?>


<!DOCTYPE HTML>
<html>

<head>
  <title>Information on Admissions | UAS</title>
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
          <li class="selected"><a href="info.php">Information on Admissions</a></li>
          <li><a href="applications.php">Applications</a></li>
          <li><a href="checkProgress.php">Check Application Progress</a></li>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
    
    <div id="sidebar_container">
        <div class="sidebar">
          <div class="sidebar_top"></div>
          <div class="sidebar_item">
            <h3>Login </h3>
            <?php
			  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
			  if (!isset($_SESSION['applicantID'])) {
			  echo '<p>' . $error_msg . '</p>';
      		?>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="applicantLoginForm" name="applicantLoginForm" >
             
             <label for="username">Username</label><br />
             <input type="text" name="username" id="username" />
             <br />
             <label for="password">Password</label><br />
             <input type="password" name="password" id="password" />
			<br /><br />
		    <input type="submit" class="submit" value="Log In" name="submit"/>
            </form>
            <?php
			  } else {
				// Confirm the successful log-in
				echo('<p>You are already logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . '
						 <ul>
						 <li><a href="logout.php">Log Out</a></li>
						 <li><a href="viewAndEditProfile.php">View Profile</a></li>
						 </ul>
						 </p>');
			  }
			?>
          </div>
          <div class="sidebar_base"></div>
          <br />
          <br />
        </div>
      </div>
      
      <div id="info_page_content">
        <!-- insert the page content here -->
        <h1>Information on Submission of Application and Admissions</h1>
       
        <p>The University system in Sri Lanka operates within the framework laid down by the Universities Act No. 16 of 1978. Selection of students for admission to undergraduate courses in universities is assigned to the University Grants Commission (UGC) under the above Act. Accordingly, at present the UGC selects students for admission to undergraduate courses for 14 National universities and 4 institutes, which have been set up under the Universities Act.</p>

		<p>In addition to admission of students with local qualifications, special provisions have been made for admission of a limited number of students with foreign qualifications also to follow undergraduate courses of study leading to bachelor’s degrees, annually.</p>

		<p>This site provides information on university admissions as well as the opportunity for studets to submit their applications for university entrance. a step-by-step, detailed user manual can be found <a href="#">here</a>.</p>
        
        <p>For further information on the University Admission Policy, Courses of Study, and the Number of places available in Universities under each course of study, the subject combination available in each University under different courses of study, and the minimum marks required for admission to various courses in respect of each administrative district, please visit the UGC website <a href="http://www.ugc.ac.lk/">here</a>.</p>
    
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
  
  <script>
    
    // Load theme
    Galleria.loadTheme('images/galleria/src/themes/dots/galleria.dots.js');
    
    $('#gallery').galleria();
    
</script>
  
</body>
</html>
