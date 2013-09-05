<?php
  require_once('constants/connectvars.php');

  // Start the session
  session_start();

  // Clear the error message
  $error_msg = "";

  // If the user isn't logged in, try to log them in
  if (!isset($_SESSION['adminID'])) {
	  
			if (isset($_POST['submit'])) {
			  // Connect to the database
			  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		
			  // Grab the user-entered log-in data
			  $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
			  $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
		
						  if (!empty($username) && !empty($password)) {
							// Look up the username and password in the database
							$query = "SELECT * FROM admin WHERE username = '$username' AND password = SHA('$password')";
							$data = mysqli_query($dbc, $query);
					
										if (mysqli_num_rows($data) == 1) {
										  // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
										  $row = mysqli_fetch_array($data);
										  $_SESSION['adminID'] = $row['adminID'];
										  $_SESSION['username'] = $row['username'];
										  $_SESSION['firstname'] = $row['firstName'];
										  $_SESSION['lastname'] = $row['lastName'];
										  $_SESSION['privilegeLevel'] = $row['privilegeLevel'];
										  
										  setcookie('adminID', $row['adminID'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
										  setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
										  setcookie('firstName', $row['firstName'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
										  setcookie('lastName', $row['lastName'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
										  setcookie('privilegeLevel', $row['privilegeLevel'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
										  
										  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'adminIndex.php';
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
  <title>Admin Log In | Enlighten Admin</title>
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
      
      <h3>Login </h3>
      <?php
	  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
	  if (empty($_SESSION['adminID'])) {
          
		  if (!empty($error_msg)) {
					echo '<p class="error_message">' . $error_msg . '</p>';
					}
      ?>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="register" id="applicantLoginForm" name="applicantLoginForm" >
       
       <fieldset class="row2">
       <legend>Login</legend>
       <p>
       <label for="username">Username</label>
       <input type="text" name="username" id="username" maxlength="10" onBlur="validateNonEmpty(this, document.getElementById('username_help'))" value="<?php if (!empty($username)) echo $username; ?>"/>
       <span id="username_help" class="helpText"></span>
       <p/>
       <p>
       <label for="password">Password</label>
       <input type="password" name="password" id="password"  onblur="validateNonEmpty(this, document.getElementById('password_help'))" maxlength="10"/>
       <span id="password_help" class="helpText"></span>
      <p/>
      <p>
      <br />
      <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
      <input type="submit" class="submit" value="Log In" name="submit"/>
      </p>
      </fieldset>
      </form>
      <?php
		} else {
		  // Confirm the successful log-in
		  echo('<p>You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <a href="logout.php">Log Out</a></p>');
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
