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
	
	  if (isset($_POST['submit2'])) {
		  
		  $ALIndexNumber = $_POST['ALIndexNumber'];
		  
		  $query = "SELECT * FROM application WHERE ALIndexNumber = '$ALIndexNumber'";
		  $data = mysqli_query($dbc, $query);
		  $row = mysqli_fetch_array($data);
		  
		  if ($row != NULL) {
			  $flag = '1';
			  $error_msg = '';
			  } else {
				  $flag = '';
				  $error_msg = 'An application was not found matching the Index Number you entered. Please enter a valid Index Number.';
				  }
		  
		  
		  
		  } elseif (isset($_POST['submit1'])) {
			  
			  if (!empty($_POST['todelete'])) {
				  
				  foreach ($_POST['todelete'] as $delete_id) {
				  $query = "DELETE FROM application WHERE ALIndexNumber = '$delete_id'";
				  mysqli_query($dbc, $query) or die('Error querying database.');
				  
				  $query2 = "DELETE FROM preferences WHERE ALIndexNumber = '$delete_id'";
				  mysqli_query($dbc, $query2) or die('Error querying database.');
				  
				  /*
				  $query2 = "SELECT * FROM application WHERE applicationID = '$delete_id'";
				  $data2 = mysqli_query($dbc, $query2);
				  $row2 = mysqli_fetch_array($data2);
				  
				  $firstName = $row2['firstName'];
				  $lastName = $row2['lastName'];
				  $emailAddress = $row2['emailAddress'];
				  $ALIndexNumber = $row2['ALIndexNumber'];
				  
				  // Code to send the email
				  $to = $emailAddress;
				  $subject = 'Your Application has been removed from the UAS';
				  $msg = "Dear $firstName $lastName.\n\nYour Index Number is: $ALIndexNumber.\n\nYour application has been removed from the University Admission System due to the non-receipt of Supporting documentation.\n\nPlease log in to the UAS and submit another application. Please send the Supporting Documentation, along with the Application ID attached, within 10 working days of submitting the application. Failure to do so will result in te Application being removed.";
				  
				  mail($to, $subject, $msg, 'From: UAS Admin');
				  */
				  
				  }
				  
				  $error_msg = 'Application(s) removed.';
				  
				  $flag = '1';
				  
				  } else {
					  
					  $error_msg = 'Please select at least one Application.';
				  
					  $flag = '';
					  
					  }
				  
				  }
}
?>

<!DOCTYPE HTML>
<html>

<head>
  <title>Remove Application | UAS Admin</title>
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
          <li><a href="adminRegistrations.php">Registrations</a></li>
          <li><a href="#">Reports</a></li>
          <li><a href="adminDeadlines.php">Deadlines</a></li>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
    
    <h1>Remove Application</h1>
    
      <div id="content">
      
      
     <?php
			// If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
			if (isset($_SESSION['adminID'])) {
				
				if ($_SESSION['privilegeLevel'] == "02") {
					
					echo '<p>You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <a href="logout.php">Log Out</a></p>';
					
					if (!empty($flag)) {
					
					if (!empty($error_msg)){
						echo '<p class="error_message">' . $error_msg . '</p>';
						}
					
					// Display the applicant rows with checkboxes for deleting
					$query = "SELECT * FROM application WHERE ALIndexNumber = '" . $_POST['ALIndexNumber'] . "'";
					$result = mysqli_query($dbc, $query);
					
					echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post" name="removeApplicationForm" id="removeApplicationForm">';
					echo '<table border="1" cellpadding="5em 10em">';
					echo '<thead>';
					echo '<tr>';
					echo '<th>&nbsp;</th>';
					echo '<th>Application ID</th>';
					echo '<th>A/L Index Number</th>';
					echo '<th>First Name</th>';
					echo '<th>Last Name</th>';
					echo '</tr>';
					echo '</thead>';
					
					while ($row = mysqli_fetch_array($result)) {
						
						echo '<tbody>';
						echo '<tr>';
						echo '<td>';
						echo '<input type="checkbox" value="' . $row['ALIndexNumber'] . '" name="todelete[]" />';
						echo '</td>';
						echo '<td>' . $row['applicationID'] . '</td>';
						echo '<td>' . $row['ALIndexNumber'] . '</td>';
						echo '<td>' . $row['firstName'] . '</td>';
						echo '<td>' . $row['lastName'] . '</td>';
						echo '</tr>';
						echo '</tbody>';
						}
					
					echo '</table>';
					
					echo '<p>';
					echo '<br />';
					echo '<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>';
					echo '<input type="submit" name="submit1" id="submit1" value="Remove Application" />';
					echo '</p>';
					
					echo '</form>';
						
						} elseif (empty($flag)) {
							
                            echo '<p>Please enter an A/L Index Number to search for an application</p>';
							
							if (!empty($error_msg)){
								echo '<p class="error_message">' . $error_msg . '</p>';
								}
							
							/*
							if (!empty($to)){
								echo '<p class="error_message">' . $to . '</p>';
								}
								
							if (!empty($subject)){
								echo '<p class="error_message">' . $subject . '</p>';
								}
								
							if (!empty($msg)){
								echo '<p class="error_message">' . $msg . '</p>';
								}
								
							if (!empty($firstName)){
								echo '<p class="error_message">' . $firstName . '</p>';
								}
								
							if (!empty($lastName)){
								echo '<p class="error_message">' . $lastName . '</p>';
								}
								
							if (!empty($emailAddress)){
								echo '<p class="error_message">' . $emailAddress . '</p>';
								}
								
							if (!empty($ALIndexNumber)){
								echo '<p class="error_message">' . $ALIndexNumber . '</p>';
								}
							*/
							
                            ?>
                            <br />
                            <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" name="searchForApplicationForm" id="searchForApplicationForm">
                              <label for="ALIndexNumber">Index Number</label>
                              <input type="text" name="ALIndexNumber" id="ALIndexNumber" value="<?php if (!empty($ALIndexNumber)) echo $ALIndexNumber; ?>" />
                              <input type="submit" name="submit2" id="submit2" value="View/Edit Application">
                            </form>
							
							<?php
							
							}
					

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
	require_once('footerconstants.php');
	
	echo '<p align=center>' . COPYRIGHT1 . '</p>';
	echo '<p align=center>' . COPYRIGHT2 . '</p>';
	?>
    </div>
  </div>
</body>
</html>
