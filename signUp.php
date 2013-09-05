<?php
  require_once('constants/connectvars.php');
  
  session_start();
  
  // Clear the error message
  $error_msg = "";

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['sponsorID'])) {
    if (isset($_COOKIE['sponsorID']) && isset($_COOKIE['username'])) {
      $_SESSION['sponsorID'] = $_COOKIE['sponsorID'];
      $_SESSION['username'] = $_COOKIE['username'];
	  $_SESSION['firstname'] = $_COOKIE['firstName'];
	  $_SESSION['lastname'] = $_COOKIE['lastName'];
	  }
	}
	
	// Connect to the database
  	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		  if (isset($_POST['submit'])) {
			// Grab the profile data from the POST
			$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
			$password = mysqli_real_escape_string($dbc, trim($_POST['password']));
			$retypePassword = mysqli_real_escape_string($dbc, trim($_POST['retypePassword']));
			$firstName = mysqli_real_escape_string($dbc, trim($_POST['firstName']));
			$lastName = mysqli_real_escape_string($dbc, trim($_POST['lastName']));
			$emailAddress = mysqli_real_escape_string($dbc, trim($_POST['emailAddress']));
			$IDNumber = mysqli_real_escape_string($dbc, trim($_POST['IDNumber']));
		
			if (!empty($username) && !empty($password) && !empty($retypePassword) && !empty($firstName) && !empty($lastName) && !empty($IDNumber) && !empty($emailAddress) && ($password == $retypePassword)) {
				// Make sure someone isn't already registered using this username
				$query = "SELECT * FROM sponsor WHERE username = '$username'";
				$data = mysqli_query($dbc, $query);
				
						if (mysqli_num_rows($data) == 0) {
							
							// The username is unique, so insert the data into the database
							$query = "INSERT INTO sponsor (username, password, joinDate, firstName, lastName, emailAddress, IDNumber) VALUES ('$username', SHA('$password'), NOW(), '$firstName', '$lastName', '$emailAddress', '$IDNumber')";
							mysqli_query($dbc, $query);
							mysqli_close($dbc);
							
							// Code to send the email
							$to = $emailAddress;
							$subject = 'You have successfully signed up for Enlighten';
							$msg = "Dear $firstName $lastName.\n\nThank you for using Enlighten. You have successfully signed up on the system. You can now search for a child of your choice and submit a sponsorship request.\n\nYour Username is:  $username.\nYour Password is:  $password.\n\nPlease keep this information with you and use it to login to the Enlighten system.";
							
							mail($to, $subject, $msg, 'From: Enlighten Admin');
							
							//set the session and cookies
							$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
							$query2  = "SELECT * FROM sponsor WHERE username = '$username' AND password = SHA('$password')";
							$data2 = mysqli_query($dbc, $query2);
							$row2 = mysqli_fetch_array($data2);
							
							$_SESSION['sponsorID'] = $row2['sponsorID'];
							$_SESSION['username'] = $row2['username'];
							$_SESSION['firstname'] = $row2['firstName'];
							$_SESSION['lastname'] = $row2['lastName'];
							
							setcookie('sponsorID', $row2['sponsorID'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
							setcookie('username', $row2['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
							setcookie('firstName', $row2['firstName'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
							setcookie('lastName', $row2['lastName'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
							
							// Confirm success with the user
							$error_msg = 'Your new account has been successfully created. An email has been sent to the email address provided, with important sign up details. You are now ready to log in and <a href="sponsorViewAndEditProfile.php">edit</a> your profile.';
					
							mysqli_close($dbc);
								
							} else {
							  // An account already exists for this username, so display an error message
							  $error_msg = 'An account already exists for this username. Please use a different Username.';
							  $username = "";
							  }
				} else {
				  $error_msg = 'You must enter all of the sign-up data, including the desired password twice.';
				  }
				} 
?>

<!DOCTYPE HTML>
<html>

<head>
<title>Sign Up | Enlighten</title>

<?php require_once("include/pagehead.php");?>

</head>

<body>
  <div class="container-fluid" id="main">
	
	<div class="row-fluid">
		<?php include("include/header.php");?>
	</div>

    <div class="container-fluid" id="site_content">
      <h1>Sign Up</h1>
     <?php
			// If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
			
			if (!empty($error_msg)){
					echo '<p class="error_message">' . $error_msg . '</p>';
					}
			
			if (!isset($_SESSION['sponsorID'])) {
				echo '<p class="guidelines">&nbsp;&nbsp;Please read the Guidelines below before you complete the form. After successfully signing up to the system you can submit a sponsorship request.</p><br />';
	  ?>
		<form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" class="" id="sponsorSignupForm" name="sponsorSignupForm" onSubmit="return validateSignUp(this.form)">      

			<div class="span5">
			<h3>Log In Details</h3>
			<p>
			<label for="username">Username</label>
			<input type="text" name="username" id="username" onBlur="validateNonEmpty(this, document.getElementById('username_help'))" value="<?php if (!empty($username)) echo $username; ?>"/>
			<span id="username_help" class="helpText"></span>
			</p>
			<p>
			<label for="password">Password</label>
			<input type="password" name="password" id="password" onBlur="validateNonEmpty(this, document.getElementById('password_help'))" />
			<span id="password_help" class="helpText"></span>
			</p>
			<p>
			<label for="retypePassword">Retype Password</label>
			<input type="password" name="retypePassword" id="retypePassword" onBlur="validateRetypePassword(this, document.getElementById('password'), document.getElementById('retypePassword_help'))" />
			<span id="retypePassword_help" class="helpText"></span>
			</p>
			</div>
			
			<div class="span5 offset1">
			<h3>Personal Details</h3>
			<p>
			<label for="firstName">First Name</label>
			<input type="text" class="long" id="firstName" name="firstName" onBlur="validateNonEmpty(this, document.getElementById('firstName_help'))" value="<?php if (!empty($firstName)) echo $firstName; ?>"/>
			<span id="firstName_help" class="helpText"></span>
			</p>
			<p>
			<label for="lastName">Last Name</label>
			<input type="text" class="long" id="lastName" name="lastName" onBlur="validateNonEmpty(this, document.getElementById('lastName_help'))" value="<?php if (!empty($lastName)) echo $lastName; ?>"/>
			<span id="lastName_help" class="helpText"></span>
			</p>
			<p>
			<label for="emailAddress">Email Address</label>
			<input class="short" type="text" id="emailAddress" name="emailAddress" onBlur="validateEmail(this, document.getElementById('emailAddress_help'))" value="<?php if (!empty($emailAddress)) echo $emailAddress; ?>"/>
			<span id="emailAddress_help" class="helpText"></span>
			</p>
			<p>
			<label for="IDNumber">Identification Number</label>
			<input type="text" class="long" id="IDNumber" name="IDNumber" onBlur="validateNonEmpty(this, document.getElementById('IDNumber_help'))" value="<?php if (!empty($IDNumber)) echo $IDNumber; ?>"/>
			<span id="IDNumber_help" class="helpText"></span>
			</p>
			</div>
			
			<div class="span12">
				<p>
				<br />
				<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				<input class="btn btn-primary" name="submit" id="submit" type="submit" value="Sign Up" />
				<input class="btn" name="cancel" id="cancel" type="button" value="Cancel" />
				</p>
			
				<br /><br /><br />
				<p class="guidelines">Guidelines to fill the Registration Form</p>
				<ol>
				<li>Please retype the Password in the given field. This is to ensure that the Password you typed is correct. If they do not match, the system will not allow you to submit the form.</li>
				<li>All fields are compulsory.</li>
				<li>In the Identification Number field, enter either your National ID Number or Passport Number</li>
				</ol>
			</div>
      </form>
      <?php
		} else {
			// Confirm the successful log-in
			echo('<p>You are already logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <a href="logout.php">Log Out</a></p>');
		  }
	  ?>
    </div>
	
    <div class="row-fluid">
    	<?php include("include/footer.php");?>
    </div>
    </div>
  </div>
</body>
</html>
