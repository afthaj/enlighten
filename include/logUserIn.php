<?php

// If the user isn't logged in, try to log them in
  if (!isset($_SESSION['sponsorID'])) {
  
			if (isset($_POST['submit'])) {
			  // Connect to the database
			  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		
			  // Grab the user-entered log-in data
			  $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
			  $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
		
						  if (!empty($username) && !empty($password)) {
							// Look up the username and password in the database
							$query = "SELECT * FROM sponsor WHERE username = '$username' AND password = SHA('$password')";
							$data = mysqli_query($dbc, $query);
					
										if (mysqli_num_rows($data) == 1) {
										  // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
										  $row = mysqli_fetch_array($data);
										  $_SESSION['sponsorID'] = $row['sponsorID'];
										  $_SESSION['username'] = $row['username'];
										  $_SESSION['firstname'] = $row['firstName'];
										  $_SESSION['lastname'] = $row['lastName'];
										  
										  setcookie('sponsorID', $row['sponsorID'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
										  setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
										  setcookie('firstName', $row['firstName'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
										  setcookie('lastName', $row['lastName'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
										  
										  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
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