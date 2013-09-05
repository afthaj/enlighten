<?php
  // If the user is logged in, delete the session vars to log them out
  session_start();
  
  if (isset($_SESSION['sponsorID'])) {
	  
	  // Delete the session vars by clearing the $_SESSION array
	  $_SESSION = array();

	  // Delete the session cookie by setting its expiration to an hour ago (3600)
	  if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time() - 3600);
	  }

	  // Destroy the session
	  session_destroy();
	  
	  // Delete the user ID and username cookies by setting their expirations to an hour ago (3600)
	  setcookie('sponsorID', '', time() - 3600);
	  setcookie('adminID', '', time() - 3600);
	  setcookie('username', '', time() - 3600);
	  setcookie('firstname', '', time() - 3600);
	  setcookie('lastname', '', time() - 3600);
	  
	  // Redirect to the home page
	  $home_url = 'index.php';
	  header('Location: ' . $home_url);
	  
	  } else if (isset($_SESSION['adminID'])) {
		  // Delete the session vars by clearing the $_SESSION array
		  $_SESSION = array();
	  
		  // Delete the session cookie by setting its expiration to an hour ago (3600)
		  if (isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time() - 3600);
		  }

	  // Destroy the session
	  session_destroy();
	  
	  // Delete the user ID and username cookies by setting their expirations to an hour ago (3600)
	  setcookie('sponsorID', '', time() - 3600);
	  setcookie('adminID', '', time() - 3600);
	  setcookie('username', '', time() - 3600);
	  setcookie('firstname', '', time() - 3600);
	  setcookie('lastname', '', time() - 3600);
	  setcookie('privilegeLevel', '', time() - 3600);
	  
	  // Redirect to the admin home page
	  $home_url = 'adminIndex.php';
	  header('Location: ' . $home_url);
	  
  }
?>
