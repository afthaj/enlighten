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

	  if (isset($_GET['adminID'])) {
			  $query = 'SELECT * FROM admin WHERE adminID = "' . $_GET['adminID'] . '"';
			  $data = mysqli_query($dbc, $query);
			  $row = mysqli_fetch_array($data);
			  
			  if ($row != NULL) {
				  
				  $adminID = $_GET['adminID'];
				  
				  $username = $row['username'];
				  $password = $row['password'];
				  
				  $title = $row['title'];
				  $firstName = $row['firstName'];
				  $lastName = $row['lastName'];
				  $nationalID = $row['nationalID'];
				  $emailAddress = $row['emailAddress'];
				  
				  $privilegeLevel = $row['privilegeLevel'];
				  
				  }
			  }
	  
	  if (isset($_POST['submit'])) {	  
		// Grab the profile data from the POST
		$adminID = mysqli_real_escape_string($dbc, trim($_POST['adminID']));
		$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
		
		$title = mysqli_real_escape_string($dbc, trim($_POST['title']));
		$firstName = mysqli_real_escape_string($dbc, trim($_POST['firstName']));
		$lastName = mysqli_real_escape_string($dbc, trim($_POST['lastName']));
		$nationalID = mysqli_real_escape_string($dbc, trim($_POST['nationalID']));
		$emailAddress = mysqli_real_escape_string($dbc, trim($_POST['emailAddress']));
		
		$privilegeLevel = mysqli_real_escape_string($dbc, trim($_POST['privilegeLevel']));
		
		// Insert the new admin user data in to the database
		if (!empty($username) && !empty($firstName) && !empty($lastName) && !empty($nationalID) && !empty($emailAddress) && !empty($privilegeLevel)) {
			
			$query = "UPDATE admin SET username='$username', title = '$title',  firstName = '$firstName', lastName = '$lastName', nationalID = '$nationalID', emailAddress = '$emailAddress', privilegeLevel = '$privilegeLevel' WHERE adminID = '$adminID'";
			
			mysqli_query($dbc, $query);
	
			// Confirm success with the user
			$error_msg = 'The Admin User has been updated.';
			mysqli_close($dbc);
		  } else {
			$error_msg = 'You must enter all of the profile data.';
		  }
		  }
	  }
?>

<!DOCTYPE HTML>
<html>

<head>
  <title>View/Edit Admin User | Enlighten Admin</title>
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
      <h1>View/Edit Admin User</h1>
      
     <?php
	 if (!empty($_GET['adminID'])) {
	  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
	  if (isset($_SESSION['adminID'])) {
		  
		  if ($_SESSION['privilegeLevel'] == "01") {
		  
			  echo '<p>You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <a href="logout.php">Log Out</a></p>';
			  
			  if (!empty($error_msg)){
				  echo '<p class="error_message">' . $error_msg . '</p>';
				  }
	  ?>
      <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" class="register" id="adminAddAdminUserForm" name="adminAddAdminUserForm">
      <fieldset class="row3">
      <legend>Log In Details</legend>
        <p>
          <label for="username">User Name *</label>
          <input type="text" class="long" id="username" name="username" onBlur="validateNonEmpty(this, document.getElementById('username_help'))" value="<?php if (!empty($username)) echo $username; ?>"/>
          <span id="username_help" class="helpText"></span>
        </p>
      </fieldset>
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
              <label for="lastName">Last Name *</label>
              <input type="text" class="long" id="lastName" name="lastName" onBlur="validateNonEmpty(this, document.getElementById('firstName_help'))" value="<?php if (!empty($lastName)) echo $lastName; ?>"/>
              <span id="lastName_help" class="helpText"></span>
            </p>
            <p>
              <label for="nationalID">NIC Number *</label>
              <input type="text" class="long" maxlength="10" id="nationalID" onBlur="validateNICNumber(this, document.getElementById('nationalID_help'))" name="nationalID" value="<?php if (!empty($nationalID)) echo $nationalID; ?>"/>
              <span id="nationalID_help" class="helpText"></span>
            </p>
            <p>
                <label for="emailAddress">Email Address *</label>
                <input class="short" type="text" id="emailAddress" name="emailAddress" onBlur="validateEmail(this, document.getElementById('emailAddress_help'))" value="<?php if (!empty($emailAddress)) echo $emailAddress; ?>"/>
                <span id="emailAddress_help" class="helpText"></span>
            </p>
            <p>
            <br />
            </p>
            <p>
              <label for="privilegeLevel">Privilege Level *</label>
              <select id="privilegeLevel" name="privilegeLevel">
                  <option value="01" <?php if (!empty($privilegeLevel) && $privilegeLevel == '02') echo 'selected = "selected"'; ?>>Enlighten Administrator</option>                  
                  <option value="02" <?php if (!empty($privilegeLevel) && $privilegeLevel == '03') echo 'selected = "selected"'; ?>>Data Entry Operator</option>
              </select>
            </p>
            <p>
              <input class="short" type="hidden" id="adminID" name="adminID" value="<?php if (!empty($adminID)) echo $adminID; ?>"/>
            </p>
            </fieldset>
			<p>
			<br />
			<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			<input name="submit" id="submit" type="submit" value="Edit User" />
			<input name="cancel" id="cancel" type="button" value="Cancel" />
			</p>
      </form>
      <?php
			  } else {
				  echo '<p class="error_message">You do not have sufficient privileges to add a new Admin User</p>';
				  }
		  } else {
			  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
			  echo '<p>You must login to view this page - <a href="adminLogin.php">Login</a></p>';
		  }
	 } else {
		 
		 if ($_SESSION['privilegeLevel'] == "01") {
		 
			 if (empty($_GET['adminID'])) {
				 
				 if (!empty($error_msg)){
						  echo '<p class="error_message">' . $error_msg . '</p>';
						  }
				 
				 // Connect to the database
				$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				 
				 // Display the admin users
				$query = "SELECT * FROM admin";
				$result = mysqli_query($dbc, $query);
				echo '<table border="1" cellpadding="5em 10em">';
				echo '<thead>';
				echo '<tr>';
				echo '<th>Admin ID</th>';
				echo '<th>Name of User</th>';
				echo '<th>Email Address</th>';
				echo '<th>&nbsp;</th>';
				echo '</tr>';
				echo '</thead>';
				
				while ($row = mysqli_fetch_array($result)) {
					echo '<tbody>';
					echo '<tr>';
					echo '<td>' . $row['adminID'] . '</td>';
					echo '<td>' . $row['firstName'] . ' ' . $row['lastName'] . '</td>';
					echo '<td>' . $row['emailAddress'] . '</td>';
					echo "<td><a href=\"adminViewAndEditAdminUser.php?adminID=" . $row['adminID'] . "\">Edit Profile</a></td>";
					echo '</tr>';
					echo '</tbody>';
					}
					
				echo '</table>';
				}
			} else {
				echo '<p class="error_message">You do not have sufficient privileges to View/Edit an Admin User</p>';
				}
		 
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
