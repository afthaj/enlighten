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
			  
			  $row2 = mysqli_fetch_array($data);
			  
			  $_SESSION['adminID'] = $row2['adminID'];
			  $_SESSION['username'] = $row2['username'];
			  $_SESSION['firstname'] = $row2['firstName'];
			  $_SESSION['lastname'] = $row2['lastName'];
			  $_SESSION['privilegeLevel'] = $row2['privilegeLevel'];
			  
			  setcookie('adminID', $row2['adminID'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
			  setcookie('username', $row2['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
			  setcookie('firstName', $row2['firstName'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
			  setcookie('lastName', $row2['lastName'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
			  setcookie('privilegeLevel', $row2['privilegeLevel'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
			  
			  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'adminIndex.php';
			  $error_msg = 'Login Successful';
			  header('Location: ' . $home_url);
			  } else {
				  // The username/password are incorrect so set an error message
				  $error_msg = 'Sorry, you must enter a valid username and password to log in.';
				  }

			} else {
			  // The username/password weren't entered so set an error message
			  $error_msg = 'Sorry, you must enter your username and password to log in.';
			}
		}
	  }
?>

<!DOCTYPE HTML>
<html>

<head>
  <title>Admin Panel | Enlighten Admin</title>
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
          <li class="selected"><a href="adminIndex.php">Admin Home</a></li>
          <li><a href="adminAdminUsers.php">Admin Users</a></li>
          <li><a href="adminSponsors.php">Sponsors</a></li>
          <li><a href="adminStudents.php">Students</a></li>
          <li><a href="adminPendingSponsorships.php">Pending Sponsorships</a></li>
        </ul>
      </div>
    </div>
    
    <div id="site_content">
    
      <div id="sidebar_container">
        <div class="sidebar">
          <div class="sidebar_top"></div>
          <div class="sidebar_item">
            <h3>Admin Login</h3>
            <?php
			  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
			  if (!isset($_SESSION['adminID'])) {
			  
			  if (!empty($error_msg)){
					echo '<p>' . $error_msg . '</p>';
					}
      		?>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="adminLoginForm" name="adminLoginForm" >
             
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
						 <li><a href="adminViewAndEditProfile.php">View Profile</a></li>
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
      
      <h1>&nbsp;&nbsp;Welcome to the Enlighten Admin Panel</h1>
        
        <div id="gallery">
          <ul>
            <li><img src="images/galleria/1.jpg"></li>
            <li><img src="images/galleria/2.jpg"></li>
            <li><img src="images/galleria/3.jpg"></li>
            <li><img src="images/galleria/4.jpg"></li>
            <li><img src="images/galleria/5.jpg"></li>
          </ul> 
        </div>
      
      <div id="content">
       
        <p>Welcome to the Administrator Panel of Enlighten. In the Panel, you can login into the sytem, perform administrator tasks and edit details of students.</p>
    
      </div>
	
    </div>
	
    <div id="footer">
    <?php
	require_once('constants/footerconstants.php');
	
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
