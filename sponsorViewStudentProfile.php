<?php
  require_once('constants/connectvars.php');

  session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['sponsorID'])) {
    if (isset($_COOKIE['sponsorID']) && isset($_COOKIE['username'])) {
      $_SESSION['sponsorID'] = $_COOKIE['sponsorID'];
      $_SESSION['username'] = $_COOKIE['username'];
	  $_SESSION['firstname'] = $_COOKIE['firstName'];
	  $_SESSION['lastname'] = $_COOKIE['lastName'];
    }
  } else {
	  $_SESSION['sponsorID'] = $_COOKIE['sponsorID'];
      $_SESSION['username'] = $_COOKIE['username'];
	  $_SESSION['firstname'] = $_COOKIE['firstName'];
	  $_SESSION['lastname'] = $_COOKIE['lastName'];
	  
	  // Connect to the database
	  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	  if (isset($_GET['studentID'])) {
		  $studentID = $_GET['studentID'];
		  $query = "SELECT * FROM student WHERE studentID = '$studentID'";
		  $data = mysqli_query($dbc, $query);
		  $row = mysqli_fetch_array($data);
		  
		  if ($row != NULL) {
			  
			  $firstName = $row['firstName'];
			  $otherNames = $row['otherNames'];
			  $lastName = $row['lastName'];
			  $dateOfBirth = $row['dateOfBirth'];
			  $contactAddress = $row['contactAddress'];
			  $currentGrade = $row['currentGrade'];
			  
			  $guardianName = $row['guardianName'];
			  $guardianTelephoneNumber = $row['guardianTelephoneNumber'];
			  $guardianContactAddress = $row['guardianContactAddress'];
			  
			  }
		  }
	  
	  if (isset($_POST['submit'])) {
			
			$studentID = $_POST['studentID'];
			
			$query = "SELECT * FROM sponsorship WHERE studentID = '$studentID'";
			$result = mysqli_query($dbc, $query);
			$row = mysqli_fetch_array($result);
			
			if ($row == NULL || $row['progress'] != '02') {
				
				$query = "INSERT INTO sponsorship (sponsorID, studentID, dateSubmitted, progress) VALUES ('" . $_SESSION['sponsorID'] . "', '$studentID', NOW(), '01')";
				mysqli_query($dbc, $query);
				
				$query2 = "UPDATE student SET sponsorshipProgress = '01' WHERE studentID = '$studentID'";
				mysqli_query($dbc, $query2) or die('Error querying database.');
				
				// Code to send the email
				$query3 = "SELECT * FROM sponsor WHERE sponsorID = '" . $_SESSION['sponsorID'] . "'";
				$data3 = mysqli_query($dbc, $query3);
				$row3 = mysqli_fetch_array($data3);
				
				$firstName = $row3['firstName'];
				$lastName = $row3['lastName'];
				$emailAddress = $row3['emailAddress'];
				
				$to = $emailAddress;
				$subject = 'You have successfully submitted a Sponsorship Request';
				$msg = "Dear $firstName $lastName.\n\nYou have successfully submitted a sponsorship request. Your request will be reviewed and you will be notified when the request is approved. Please log in to the system to check the details and progress of the request.\n\nThank you for your generosity in making a child's dream of education a reality.";
				
				mail($to, $subject, $msg, 'From: Enlighten Admin');
				
				// Confirm success with the user
				$error_msg = 'You Sponsorship Request has been submitted pending approval. When the request is approved you will be notified by email and you can view it on your profile page.';
				mysqli_close($dbc);
				
				} else {
					$error_msg = 'This Student already has a sponsorship. Please choose another student.';
					mysqli_close($dbc);
					}
			
		  }
	  }
?>

<!DOCTYPE HTML>
<html>

<head>
<title>View Student Profile | Enlighten</title>

<?php require_once("include/pagehead.php");?>

</head>

<body>
  <div class="container container-fluid" id="main">
    
	<?php include("include/header.php");?>
	
    <div id="content_header"></div>
    <div class="span12" id="site_content">
      <div id="content">
      <h1>View Student Profile</h1>
      
     <?php
	 if (!empty($_GET['studentID'])) {
	  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
	  if (isset($_SESSION['sponsorID'])) {
		  
			  echo '<p>You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <a href="logout.php">Log Out</a></p>';
			  
			  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			  $query = "SELECT * FROM student WHERE studentID = '" . $_GET['studentID'] . "'";
			  $data = mysqli_query($dbc, $query);
			  $row = mysqli_fetch_array($data);
			  
			  if ($row['sponsorshipProgress'] == '00') {
			  
			  if (!empty($error_msg)){
				  echo '<p class="error_message">' . $error_msg . '</p>';
				  }
	  ?>
      <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" class="register" id="adminAddAdminUserForm" name="adminAddAdminUserForm">
            <fieldset class="row2">
            <legend>Student Details</legend>
            <p>
              <label for="firstName">First Name</label>
              <input type="text" class="long" id="firstName" name="firstName" value="<?php if (!empty($firstName)) echo $firstName; ?>" readonly="readonly"/>
            </p>
            <p>
              <label for="otherNames">Other Names</label>
              <input type="text" class="long" id="otherNames" name="otherNames" value="<?php if (!empty($otherNames)) echo $otherNames; ?>" readonly="readonly"/>
            </p>
            <p>
              <label for="lastName">Last Name</label>
              <input type="text" class="long" id="lastName" name="lastName" value="<?php if (!empty($lastName)) echo $lastName; ?>" readonly="readonly"/>
            </p>
            <p>
                    <label for="contactAddress">Contact Address </label>
                    <textarea rows="5" cols="50" id="contactAddress" name="contactAddress" readonly="readonly"><?php if (!empty($contactAddress)) echo $contactAddress; ?></textarea>
            </p>
            <p>
                <label for="dateOfBirth">Date of Birth</label>
                <input type="text" id="dateOfBirth" name="dateOfBirth" size="11" maxlength="10" value="<?php if (!empty($dateOfBirth)) echo $dateOfBirth; ?>" readonly="readonly"/>
            </p>
            <p>
                <label for="currentGrade">Current Grade</label>
                <input type="text" id="currentGrade" name="currentGrade" size="11" maxlength="10" value="<?php if (!empty($currentGrade)) echo $currentGrade; ?>" readonly="readonly"/>
            </p>
            </fieldset>
            <fieldset class="row2">
            <legend>Guardian Details</legend>
            <p>
              <label for="guardianName">Guardian's Name</label>
              <input type="text" class="long" id="guardianName" name="guardianName" value="<?php if (!empty($guardianName)) echo $guardianName; ?>" readonly="readonly"/>
            </p>
            <p>
              <label for="guardianTelephoneNumber">Guardian's Telephone Number</label>
              <input type="text" class="long" id="guardianTelephoneNumber" name="guardianTelephoneNumber" value="<?php if (!empty($guardianTelephoneNumber)) echo $guardianTelephoneNumber; ?>" readonly="readonly"/>
            </p>
            <p>
                    <label for="guardianContactAddress">Guardian's Contact Address </label>
                    <textarea rows="5" cols="50" id="guardianContactAddress" name="guardianContactAddress" readonly="readonly"><?php if (!empty($guardianContactAddress)) echo $guardianContactAddress; ?></textarea>
            </p>
            <p>
              <input class="short" type="hidden" id="studentID" name="studentID" value="<?php if (!empty($studentID)) echo $studentID; ?>"/>
            </p>
            </fieldset>
			<p>
			<br />
			<input type="submit" class="btn btn-primary" name="submit" id="submit" value="Submit Sponsorship Request" />
			</p>
      </form>
      <?php
			  } elseif($row['sponsorshipProgress'] == '01') {
				  
				  echo '<p class="error_message">This user already has a sponsorship pending. Please choose another student.</p>';
				  
				  } elseif($row['sponsorshipProgress'] == '02') {
					  
					  echo '<p class="error_message">This user already has a sponsorship. Please choose another student.</p>';
					  
					  }
		  } else {
			  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
			  echo '<p>You must login to view this page - <a href="adminLogin.php">Login</a></p>';
		  }
	 } else {
		 
		 if (!empty($error_msg)){
					echo '<p class="error_message">' . $error_msg . '</p>';
					}
				
		  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		  $query = 'SELECT * FROM student';
		  $result = mysqli_query($dbc, $query);
		  $num_rows = mysqli_num_rows($result);
		  
		  echo '<table border="1" cellpadding="5em 10em">';
		  echo '<thead>';
		  echo '<tr>';
		  echo '<th>&nbsp;</th>';
		  echo '<th>Name of Student</th>';
		  echo '<th>&nbsp;</th>';
		  echo '</tr>';
		  echo '</thead>';
		  
		  while ($row = mysqli_fetch_array($result)) {
			  
			  $sponsorshipProgress = $row['sponsorshipProgress'];
						
			  if ($sponsorshipProgress == "00") {
				  
				  echo '<tbody>';
				  echo '<tr>';
				  echo '<td>';
				  echo '<input type="checkbox" value="' . $row['studentID'] . '" name="tosponsor[]" />';
				  echo '</td>';
				  echo '<td>' . $row['firstName'] . ' ' . $row['otherNames'] . ' ' . $row['lastName'] . '</td>';
				  echo "<td><a href=\"sponsorViewStudentProfile.php?studentID=" . $row['studentID'] . "\">View Profile</a></td>";
				  echo '</tr>';
				  echo '</tbody>';
				  
				  }
			  }
		  
		  echo '</table>';
		 
		 }
	  ?>
      </div>
    </div>
    <div id="content_footer"></div>
    <?php include("include/footer.php");?>
  </div>
</body>
</html>
