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
		  
		  if (!empty($_POST['todelete'])) {
			  
			  foreach ($_POST['todelete'] as $delete_id) {
				  
				  $query = "DELETE FROM sponsor WHERE sponsorID = '$delete_id'";
				  mysqli_query($dbc, $query) or die('Error querying database.');
				  
				  }
			
			  $error_msg = 'Sponsor(s) removed.';
			  
			  } else {
				  
				  $error_msg = 'Please select at least one Sponsor.';
				  
				  $flag = '0';
				  
				  }
		  }
}
?>

<!DOCTYPE HTML>
<html>

<head>
  <title>Remove Sponsor | Enlighten Admin</title>
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
      <h1>Remove Sponsor</h1>
      
     <?php
			// If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
			if (isset($_SESSION['adminID'])) {
				
				if ($_SESSION['privilegeLevel'] == "01") {
				
					echo '<p>You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <a href="logout.php">Log Out</a></p>';
					
					if (!empty($error_msg)){
						echo '<p class="error_message">' . $error_msg . '</p>';
						}
					
					// Display the customer rows with checkboxes for deleting
					$query = "SELECT * FROM sponsor";
					$result = mysqli_query($dbc, $query);
					
					echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post" name="removeSponsorForm" id="removeSponsorForm">';
					echo '<br />';
					echo '<table border="1" cellpadding="5em 10em">';
					echo '<thead>';
					echo '<tr>';
					echo '<th>&nbsp;</th>';
					echo '<th>Sponsor ID</th>';
					echo '<th>Name of Sponsor</th>';
					echo '<th>Email Address</th>';
					echo '</tr>';
					echo '</thead>';
					
					while ($row = mysqli_fetch_array($result)) {
						
						echo '<tbody>';
						echo '<tr>';
						echo '<td>';
						echo '<input type="checkbox" value="' . $row['sponsorID'] . '" name="todelete[]" />';
						echo '</td>';
						echo '<td>' . $row['sponsorID'] . '</td>';
						echo '<td>' . $row['firstName'] . ' ' . $row['lastName'] . '</td>';
						echo '<td>' . $row['emailAddress'] . '</td>';
						echo '</tr>';
						echo '</tbody>';
						}
					
					echo '</table>';
					
					echo '<p>';
					echo '<br />';
					echo '<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>';
					echo '<input name="submit" id="submit" type="submit" value="Remove Sponsor" />';
					echo '</p>';
					
					echo '</form>';

					} else {
						echo '<p class="error_message">You do not have sufficient privileges to remove an Admin User</p>';
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
