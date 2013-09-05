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
			  
				if (isset($_POST['submit'])) {
				  // Grab the profile data from the POST
				  $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
				  $firstName = mysqli_real_escape_string($dbc, trim($_POST['firstName']));
				  $otherNames = mysqli_real_escape_string($dbc, trim($_POST['otherNames']));
				  $lastName = mysqli_real_escape_string($dbc, trim($_POST['lastName']));
				  $IDNumber = mysqli_real_escape_string($dbc, trim($_POST['IDNumber']));
				  $gender = mysqli_real_escape_string($dbc, trim($_POST['gender']));
				  $contactAddress = mysqli_real_escape_string($dbc, trim($_POST['contactAddress']));
				  $emailAddress = mysqli_real_escape_string($dbc, trim($_POST['emailAddress']));
				  $telephoneNumber1 = mysqli_real_escape_string($dbc, trim($_POST['telephoneNumber1']));
				  $telephoneNumber2 = mysqli_real_escape_string($dbc, trim($_POST['telephoneNumber2']));
				  
				  // Update the profile data in the database
				  if (!empty($firstName) && !empty($lastName)) {
					  $query = "UPDATE sponsor SET title = '$title',  firstName = '$firstName', otherNames = '$otherNames', lastName = '$lastName', IDNumber = '$IDNumber', gender = '$gender', contactAddress = '$contactAddress', emailAddress = '$emailAddress', telephoneNumber1 = '$telephoneNumber1', telephoneNumber2 = '$telephoneNumber2' WHERE sponsorID = '" . $_SESSION['sponsorID'] . "'";
					  
					mysqli_query($dbc, $query);
			
					// Confirm success with the user
					$error_msg = 'Your profile has been successfully updated. Would you like to <a href="sponsorViewAndEditProfile.php">view</a> your profile?';
					mysqli_close($dbc);
				  } else {
					$error_msg = 'You must enter all of the profile data.';
				  }
				} // End of check for form submission
			  else {
				  // Grab the profile data from the database
				  $query = "SELECT * FROM sponsor WHERE sponsorID ='" . $_SESSION['sponsorID'] . "'";
				  $data = mysqli_query($dbc, $query);
				  $row = mysqli_fetch_array($data);
			  
				  if ($row != NULL) {
					  
					  $error_msg = '';
					  
					  $title = $row['title'];
					  $firstName = $row['firstName'];
					  $otherNames = $row['otherNames'];
					  $lastName = $row['lastName'];
					  $IDNumber = $row['IDNumber'];
					  $gender = $row['gender'];
					  $contactAddress = $row['contactAddress'];
					  $emailAddress = $row['emailAddress'];
					  $telephoneNumber1 = $row['telephoneNumber1'];
					  $telephoneNumber2 = $row['telephoneNumber2'];
				  } else {
					$error_msg = 'There was a problem accessing your profile.';
				  }
				  mysqli_close($dbc);
				}
	  }
?>

<!DOCTYPE HTML>
<html>

<head>
	<title>View and Edit Profile | Enlighten</title>

	<?php require_once("include/pagehead.php");?>
</head>

<body>
  <div class="container-fluid" id="main">
    
	<div class="row-fluid">
		<?php include("include/header.php");?>
	</div>
	
    <div class="row-fluid span12" id="site_content">
      <div id="content">
      <h1>View and Edit Profile</h1>
      
     <?php
			// If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
			if (isset($_SESSION['sponsorID'])) {
				echo '<p>You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <a href="logout.php">Log Out</a></p>';
				
				if (!empty($error_msg)){
					echo '<p class="error_message">' . $error_msg . '</p>';
					}
	  ?>
      <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" class="register" id="editProfileForm" name="editProfileForm">
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
                    <label for="firstName">First Name</label>
                    <input type="text" class="long" id="firstName" name="firstName" onBlur="validateNonEmpty(this, document.getElementById('firstName_help'))" value="<?php if (!empty($firstName)) echo $firstName; ?>"/>
                    <span id="firstName_help" class="helpText"></span>
            </p>
            <p>
                    <label for="otherNames">Other Names</label>
                    <input type="text" class="long" id="otherNames" name="otherNames" value="<?php if (!empty($otherNames)) echo $otherNames; ?>"/>
            </p>
            <p>
                    <label for="lastName">Last Name</label>
                    <input type="text" class="long" id="lastName" name="lastName" onBlur="validateNonEmpty(this, document.getElementById('firstName_help'))" value="<?php if (!empty($lastName)) echo $lastName; ?>"/>
                    <span id="lastName_help" class="helpText"></span>
            </p>
            <p>
                    <label for="IDNumber">Identification Number</label>
                    <input type="text" class="long" maxlength="10" id="IDNumber" name="IDNumber" value="<?php if (!empty($IDNumber)) echo $IDNumber; ?>"/>
                    <span id="IDNumber_help" class="helpText"></span>
            </p>
            <p>
                <label for="gender">Gender</label>
                <select name="gender" id="gender">
                <option value="M" <?php if (!empty($gender) && $gender == 'M') echo 'selected = "selected"'; ?>>Male</option>
                <option value="F" <?php if (!empty($gender) && $gender == 'F') echo 'selected = "selected"'; ?>>Female</option>
            </select>
            </p>
            <p>
                    <label for="contactAddress">Contact Address </label>
                    <textarea rows="2" cols="35" id="contactAddress" name="contactAddress" onBlur="validateNonEmpty(this, document.getElementById('contactAddress_help'))"><?php if (!empty($contactAddress)) echo $contactAddress; ?></textarea>
                    <span id="contactAddress_help" class="helpText"></span>
            </p>
            <p>
                <label for="telephoneNumber1">Telephone Number 1</label>
                <input class="short" type="text" maxlength="13" id="telephoneNumber1" name="telephoneNumber1" onBlur="validatePhoneNumber(this, document.getElementById('telephoneNumber1_help'))" value="<?php if (!empty($telephoneNumber1)) echo $telephoneNumber1; ?>"/>
                <span id="telephoneNumber1_help" class="helpText"></span>
            </p>
            <p>
                <label for="telephoneNumber2">Telephone Number 2</label>
                <input class="short" type="text" maxlength="13" id="telephoneNumber2" name="telephoneNumber2" onBlur="validatePhoneNumber(this, document.getElementById('telephoneNumber2_help'))" value="<?php if (!empty($telephoneNumber2)) echo $telephoneNumber2; ?>"/>
                <span id="telephoneNumber2_help" class="helpText"></span>
            </p>
            <p>
                <label for="emailAddress">Email Address</label>
                <input class="short" type="text" id="emailAddress" name="emailAddress" onBlur="validateEmail(this, document.getElementById('emailAddress_help'))" value="<?php if (!empty($emailAddress)) echo $emailAddress; ?>"/>
                <span id="emailAddress_help" class="helpText"></span>
            </p>
            </fieldset>
			<p>
			<br />
			<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			<input class="btn btn-primary" name="submit" id="submit" type="submit" value="Edit Profile" />
			<input class="btn btn-danger" name="cancel" id="cancel" type="button" value="Cancel" />
			</p>
         </form>   
      
      <div class="row-fluid">
      <h3>Sponsorship Details</h3>

        <?php
			//connecting to the database
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			
			//checking what are the entered values
			
			echo "<table border='1' cellpadding='5em 10em'>";
			echo "<thead>";
			echo "<tr>";
			echo "<th>Student Name</th>";
			echo "<th>Date of Birth</th>";
			echo "<th>Date Submitted</th>";
			echo "<th>Progress</th>";
			echo "</tr>";
			echo "</thead>";
			
			echo "<tbody>";
			
			$query2 = "SELECT * FROM sponsorship AS s, student AS st WHERE s.studentID = st.studentID AND sponsorID = '" . $_SESSION['sponsorID'] . "'";
			
			//store the result from the query
			$result2 = mysqli_query($dbc, $query2) or die('Query failed: ' . mysqli_error());
			$num_rows2 = mysqli_num_rows($result2);
			
			//check number of result rows
				
				// print values in the table
				while($row2 = mysqli_fetch_array($result2)) {
					
					$studentName = $row2['firstName'] . ' '. $row2['otherNames'] . ' '. $row2['lastName'];
					
					if ($row2['progress'] == 01) {
						$progress = "Pending";
						} elseif ($row2['progress'] == 02) {
							$progress = "Approved";
							} elseif ($row2['progress'] == 03) {
								$progress = "Rejected";
								}
					
					echo "<tr>";
					echo "<td>" . $studentName . "</td>";
					echo "<td>" . $row2['dateOfBirth'] . "</td>";
					echo "<td>" . $row2['dateSubmitted'] . "</td>";
					echo "<td>" . $progress . "</td>";
					echo "</tr>";
					}
				
				echo "</tbody>";
				echo "</table>";
				mysqli_close($dbc);
		
        ?>
      	</div>
      <?php
		} else {
			// If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
			echo '<p>You must login to view this page - <a href="login.php">Login</a></p>';
		}
	  ?>
      </div>
    </div>
	
    <div class="row-fluid">
    	<?php include("include/footer.php");?>
    </div>
  </div>
</body>
</html>
