<?php
  require_once('connectvars.php');

  session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['adminID'])) {
	  
    if (isset($_COOKIE['adminID']) && isset($_COOKIE['username'])) {
      $_SESSION['adminID'] = $_COOKIE['adminID'];
      $_SESSION['username'] = $_COOKIE['username'];
	  $_SESSION['firstname'] = $_COOKIE['firstName'];
	  $_SESSION['lastname'] = $_COOKIE['lastName'];
	  $_SESSION['privilegeLevel'] = $_COOKIE['privilegeLevel'];
	  
	  $flag = '';
	  
    }
  } else {
	  $_SESSION['adminID'] = $_COOKIE['adminID'];
      $_SESSION['username'] = $_COOKIE['username'];
	  $_SESSION['firstname'] = $_COOKIE['firstName'];
	  $_SESSION['lastname'] = $_COOKIE['lastName'];
	  $_SESSION['privilegeLevel'] = $_COOKIE['privilegeLevel'];
	  
	  $flag = '';
	  
	  // Connect to the database
	  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	  if (isset($_POST['submit'])) {
		  
		  $ALIndexNumber = $_POST['ALIndexNumber'];
		  
		  if (!empty($ALIndexNumber)) {
			  
			  $query = "SELECT * FROM application WHERE ALIndexNumber LIKE '%$ALIndexNumber%'";
			  $data = mysqli_query($dbc, $query);
			  $row = mysqli_fetch_array($data);
			  
			  if ($row != NULL) {
				  $flag = '1';
				  $error_msg = '';
				  } else {
					  $flag = '';
					  $error_msg = 'An application was not found matching the Index Number you entered. Please enter a valid Index Number.';
					  }
			  
			  } else {
				  $flag = '';
				  $error_msg = 'An application was not found matching the Index Number you entered. Please enter a valid Index Number.';
				  }
		  } elseif (isset($_GET['ALIndexNumber'])) {
			  
			  $ALIndexNumber = $_GET['ALIndexNumber'];
			  
			  $query = "SELECT * FROM application WHERE ALIndexNumber = '$ALIndexNumber'";
			  $data = mysqli_query($dbc, $query);
			  $row = mysqli_fetch_array($data);
			  
			  if ($row['registeredFlag'] == NULL) {
				  
				  $query = "UPDATE application SET registeredFlag = '1' WHERE ALIndexNumber = '$ALIndexNumber'";
				  mysqli_query($dbc, $query) or die('Error querying database.');
				  
				  $flag = '';
				  $error_msg = 'The Student has been registered successfully';
				  
				  } elseif ($row['registeredFlag'] != NULL) {
					  
					  $flag = '';
					  $error_msg = 'This Student is already registered.';
					  
					  }
			  }
}
?>

<!DOCTYPE HTML>
<html>

<head>
  <title>Registrations | UAS Admin</title>
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
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1>UAS Admin</h1>
          <h4>University Admission System for Undergraduate Degrees in Sri Lanka</h4>
          <!--displaying the date-->
          <h5><script language="JavaScript" type="text/javascript">document.write(TODAY);</script></h5>
        </div>
      </div>
      
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li><a href="admin.php">Admin Home</a></li>
          <li><a href="adminAdminUsers.php">Admin Users</a></li>
          <li><a href="adminApplications.php">Applications</a></li>
          <li class="selected"><a href="adminRegistrations.php">Registrations</a></li>
          <li><a href="#">Reports</a></li>
          <li><a href="adminDeadlines.php">Deadlines</a></li>
        </ul>
      </div>
      
    </div>

    <div id="site_content">
    
    <h1>Registration of Applicants</h1>
      
      <div id="content">
      
      
     <?php
			// If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
			if (isset($_SESSION['adminID'])) {
				
				if ($_SESSION['privilegeLevel'] == "01") {
					
					echo '<p>You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <a href="logout.php">Log Out</a></p>';
					
					if (!empty($flag)) {
					
					if (!empty($error_msg)){
						echo '<p class="error_message">' . $error_msg . '</p>';
						}
					
					// Display the applicant rows with checkboxes for deleting
					$query = "SELECT * FROM application WHERE ALIndexNumber LIKE '%$ALIndexNumber%'";
					$result = mysqli_query($dbc, $query);
					
					?>
					
					<table border="1" cellpadding="5em 10em">
                      <thead>
                      <tr>
                      <th>A/L Index Number</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>&nbsp;</th>
                      </tr>
                      </thead>
					
                    <?php
                    
					while ($row = mysqli_fetch_array($result)) {
						
						echo '<tbody>';
						echo '<tr>';
						echo '<td>' . $row['ALIndexNumber'] . '</td>';
						echo '<td>' . $row['firstName'] . '</td>';
						echo '<td>' . $row['lastName'] . '</td>';
						echo "<td><a href=\"adminRegistrations.php?ALIndexNumber=" . $row['ALIndexNumber'] . "\">Register Student</a></td>";
						echo '</tr>';
						echo '</tbody>';
						}
					
					echo '</table>';
						
						} elseif (empty($flag)) {
							
							if (!empty($error_msg)){
								echo '<p class="error_message">' . $error_msg . '</p>';
								}
							
							 echo '<p>Please enter an A/L Index Number to search for an application</p>';
							
                            ?>
                            
                            <br />
                            <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" name="searchForApplicationForm" id="searchForApplicationForm">
                              <label for="ALIndexNumber">Index Number</label>
                              <input type="text" name="ALIndexNumber" id="ALIndexNumber" value="<?php if (!empty($ALIndexNumber)) echo $ALIndexNumber; ?>" />
                              <input type="submit" name="submit" id="submit" value="Search for Applicant">
                            </form>
							
							<?php
							
							}
							
					} else {
						echo '<p class="error_message">You do not have sufficient privileges to register an Applicant</p>';
						}
				} else {
					// If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
					echo '<p>You must login to view this page - <a href="adminLogin.php">Login</a></p>';
				}
	  ?>
      
      </div>
    </div>
	
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
