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
		  
		  if (!empty($_POST['toapprove'])) {
			  
			  foreach ($_POST['toapprove'] as $approve_id) {
				  
				  $query = "UPDATE sponsorship SET progress = '02' WHERE sponsorshipID = '$approve_id'";
				  mysqli_query($dbc, $query) or die('Error querying database.');
				  
				  $query2 = "SELECT * FROM student AS st, sponsorship AS sps WHERE st.studentID = sps.studentID AND sponsorshipID = '$approve_id'";
				  $data2 = mysqli_query($dbc, $query2);
				  $row2 = mysqli_fetch_array($data2);
				  $studentID = $row2['studentID'];
				  
				  $query3 = "UPDATE student SET sponsorshipProgress = '02' WHERE studentID = '$studentID'";
				  mysqli_query($dbc, $query3) or die('Error querying database.');
				  
				  // Code to send the email
				  $query4 = "SELECT * FROM sponsor AS sp, sponsorship AS sps WHERE sp.sponsorID = sps.sponsorID AND sponsorshipID = '$approve_id'";
				  $data4 = mysqli_query($dbc, $query4);
				  $row4 = mysqli_fetch_array($data4);
				  
				  $firstName = $row4['firstName'];
				  $lastName = $row4['lastName'];
				  $emailAddress = $row4['emailAddress'];
				  
				  $to = $emailAddress;
				  $subject = 'Your Sponsorship Request has been approved';
				  $msg = "Dear $firstName $lastName.\n\nYour sponsorship request has been approved. Please log in to the system to check the details of the request and to check further details of the sponsorship process.\n\nThank you for your generosity in making a child's dream of education a reality.";
				  
				  mail($to, $subject, $msg, 'From: Enlighten Admin');
				  
				  }
			
			  $error_msg = 'Sponsorship(s) approved.';
			  
			  } else {
				  
				  $error_msg = 'Please select at least one sponsorship.';
				  
				  $flag = '0';
				  
				  }
		  }
	  
	  }
?>
  
<!DOCTYPE HTML>
<html>

<head>
  <title>Pending Sponsorships | Enlighten Admin</title>
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
          <li><a href="adminIndex.php">Admin Home</a></li>
          <li><a href="adminAdminUsers.php">Admin Users</a></li>
          <li><a href="adminSponsors.php">Sponsors</a></li>
          <li><a href="adminStudents.php">Students</a></li>
          <li class="selected"><a href="adminPendingSponsorships.php">Pending Sponsorships</a></li>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
    <div id="content">
      <h1>Pending Sponsorships</h1>
      
      <?php
	  
	  if (isset($_SESSION['adminID'])) {
				echo '<p>You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <a href="logout.php">Log Out</a></p>';
	  
      ?>
      
      <p>&nbsp;&nbsp;Welcome to the Pending Sponsorships Panel of the University Admission System. In this page, you can add an admin user, view/edit an admin user or remove an admin user.</p>
      
      <?php
	  
			// If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
			if (isset($_SESSION['adminID'])) {
				
				if ($_SESSION['privilegeLevel'] == "01") {
					
					if (!empty($error_msg)){
						echo '<p class="error_message">' . $error_msg . '</p>';
						}
					
					$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
					$query = "SELECT * FROM sponsorship WHERE progress = '01'";
					$result = mysqli_query($dbc, $query);
					$num_rows = mysqli_num_rows($result);
					
					if ($num_rows >= 1) {
						
						echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post" name="pendingSponsorshipsForm" id="pendingSponsorshipsForm">';
						echo '<br />';
						echo '<table border="1" cellpadding="5em 10em">';
						echo '<thead>';
						echo '<tr>';
						echo '<th>&nbsp;</th>';
						echo '<th>Sponsorship ID</th>';
						echo '<th>Name of Sponsor</th>';
						echo '<th>Name of Student</th>';
						echo '<th>Date Submitted</th>';
						echo '<th>&nbsp;</th>';
						echo '</tr>';
						echo '</thead>';
						
						while ($row = mysqli_fetch_array($result)) {
							
							$sponsorID = $row['sponsorID'];
							$studentID = $row['studentID'];
							$dateSubmitted = $row['dateSubmitted'];
							
							$query2 = "SELECT * FROM sponsor WHERE sponsorID = '$sponsorID'";
							$result2 = mysqli_query($dbc, $query2);
							$row2 = mysqli_fetch_array($result2);
							$sponsorName = $row2['firstName'] . ' '. $row2['lastName'];
							
							$query3 = "SELECT * FROM student WHERE studentID = '$studentID'";
							$result3 = mysqli_query($dbc, $query3);
							$row3 = mysqli_fetch_array($result3);
							$studentName = $row3['firstName'] . ' '. $row3['lastName'];
						
							if ($row['progress'] == 01) {
								$progress = "Pending";
								} elseif ($row['progress'] == 02) {
									$progress = "Approved";
									} elseif ($row['progress'] == 03) {
										$progress = "Rejected";
										}
							
							echo '<tbody>';
							echo '<tr>';
							echo '<td>';
							echo '<input type="checkbox" value="' . $row['sponsorshipID'] . '" name="toapprove[]" />';
							echo '</td>';
							echo '<td>' . $row['sponsorshipID'] . '</td>';
							echo '<td>' . $sponsorName . '</td>';
							echo '<td>' . $studentName . '</td>';
							echo '<td>' . $dateSubmitted . '</td>';
							echo "<td><a href=\"adminViewSponsorship.php?sponsorshipID=" . $row['sponsorshipID'] . "\">View Sponsorship</a></td>";
							echo '</tr>';
							echo '</tbody>';
							}
						
						echo '</table>';
						
						echo '<p>';
						echo '<br />';
						echo '<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>';
						echo '<input name="submit" id="submit" type="submit" value="Approve Sponsorships" />';
						echo '</p>';
						
						echo '</form>';
						
						} else {
							
							echo '<p class="error_message">There are no pending sponsorships</p>';
							
							}

					} else {
						echo '<p class="error_message">You do not have sufficient privileges to approve Sponsorships</p>';
						}
				} else {
					// If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
					echo '<p>You must login to view this page - <a href="adminLogin.php">Login</a></p>';
				}
	  
	  } else {
		  echo '<p>You must login to view this page - <a href="adminLogin.php">Login</a></p>';
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
