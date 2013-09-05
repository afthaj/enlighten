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
	  
	  $flag = '';
	  
    }
  } else {
	  $_SESSION['sponsorID'] = $_COOKIE['sponsorID'];
      $_SESSION['username'] = $_COOKIE['username'];
	  $_SESSION['firstname'] = $_COOKIE['firstName'];
	  $_SESSION['lastname'] = $_COOKIE['lastName'];
	  
	  $flag = '';
	  
	  // This function builds a search query from the search keywords and sort setting
		function build_query($user_search) {
		  $search_query = "SELECT * FROM student";
	  
		  // Extract the search keywords into an array
		  $clean_search = str_replace(',', ' ', $user_search);
		  $search_words = explode(' ', $clean_search);
		  $final_search_words = array();
		  if (count($search_words) > 0) {
			foreach ($search_words as $word) {
			  if (!empty($word)) {
				$final_search_words[] = $word;
			  }
			}
		  }
	  
		  // Generate a WHERE clause using all of the search keywords
		  $where_list = array();
		  if (count($final_search_words) > 0) {
			foreach($final_search_words as $word) {
			  $where_list[] = "firstName LIKE '%$word%' OR otherNames LIKE '%$word%' OR lastName LIKE '%$word%'";
			}
		  }
		  $where_clause = implode(' OR ', $where_list);
	  
		  // Add the keyword WHERE clause to the search query
		  if (!empty($where_clause)) {
			$search_query .= " WHERE $where_clause";
		  }
		  
		  return $search_query;
		}
	  
	  // Connect to the database
	  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	  if (isset($_POST['submit2'])) {
		  
		  $user_search = $_POST['name'];
			  
		  $query = build_query($user_search);
		  $data = mysqli_query($dbc, $query);
		  $row = mysqli_fetch_array($data);
		  
		  if ($row != NULL) {
			  $flag = '1';
			  $error_msg = '';
			  } else {
				  $flag = '';
				  $error_msg = 'A student was not found matching the search criteria. Please try again.';
				  }
		  
		  } elseif (isset($_POST['submit1'])) {
			  
			  if (!empty($_POST['tosponsor'])) {
					  
					  foreach ($_POST['tosponsor'] as $studentID) {
						  
						  $query = "INSERT INTO sponsorship (sponsorID, studentID, dateSubmitted, progress) VALUES ('" . $_SESSION['sponsorID'] . "', '$studentID', NOW(), '01')";
						  mysqli_query($dbc, $query) or die('Error querying database.');
						  
						  $query2 = "UPDATE student SET sponsorshipProgress = '01' WHERE studentID = '$studentID'";
						  mysqli_query($dbc, $query2) or die('Error querying database.');
						  
						  $error_msg = 'Sponsorship request(s) submitted.';
						  $flag = '0';
						  
						  
						  $query2 = "SELECT * FROM sponsor WHERE sponsorID = '" . $_SESSION['sponsorID'] . "'";
						  $data2 = mysqli_query($dbc, $query2);
						  $row2 = mysqli_fetch_array($data2);
						  
						  $firstName = $row2['firstName'];
						  $lastName = $row2['lastName'];
						  $emailAddress = $row2['emailAddress'];
						  
						  // Code to send the email
						  $to = $emailAddress;
						  $subject = 'You have successfully submitted a Sponsorship Request';
						  $msg = "Dear $firstName $lastName.\n\nYou have successfully submitted a sponsorship request. Your request will be reviewed and you will be notified when the request is approved. Please log in to the system to check the details and progress of the request.\n\nThank you for your generosity in making a child's dream of education a reality.";
						  
						  mail($to, $subject, $msg, 'From: Enlighten Admin');
						  
						  }
				  
				  } else {
					  
					  $error_msg = 'Please select at least one Student.';
					  $user_search = '';
					  $flag = '1';
					  
					  }
				  }
}
?>

<!DOCTYPE HTML>
<html>

<head>
	<title>Student Search | Enlighten</title>

	<?php require_once("include/pagehead.php");?>

</head>

<body>
  <div class="container-fluid" id="main">
    
	<div class="row-fluid">
		<?php include("include/header.php");?>
	</div>
	
    <div class="row-fluid span12" id="site_content">
    
    <h1>Student Search</h1>
    
      <div id="content">
      
     <?php
			// If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
			if (isset($_SESSION['sponsorID'])) {
				
				echo '<p>You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <a href="logout.php">Log Out</a></p>';
				
				if (!empty($flag)) {
				
				if (!empty($error_msg)){
					echo '<p class="error_message">' . $error_msg . '</p>';
					}
				
				// Display the applicant rows with checkboxes for deleting
				$query = build_query($user_search);
				$result = mysqli_query($dbc, $query);
				$num_rows = mysqli_num_rows($result);
					
					echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post" name="submitSponsorshipRequestForm" id="submitSponsorshipRequestForm">';
					echo '<br />';
					echo '<table border="1" cellpadding="5em 10em">';
					echo '<thead>';
					echo '<tr>';
					echo '<th>&nbsp;</th>';
					echo '<th>Name of Student</th>';
					echo '<th>Date of Birth</th>';
					echo '<th>Current Grade</th>';
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
							echo '<td>' . $row['dateOfBirth'] . '</td>';
							echo '<td>' . $row['currentGrade'] . '</td>';
							echo "<td><a href=\"sponsorViewStudentProfile.php?studentID=" . $row['studentID'] . "\">View Profile</a></td>";
							echo '</tr>';
							echo '</tbody>';
							
							}
						
						}
						
					echo '</table>';
					
					echo '<p>';
					echo '<br />';
					echo '<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>';
					echo '<input type="submit" class="btn btn-primary" name="submit1" id="submit1" value="Submit Sponsorship Request" />';
					echo '</p>';
					
					echo '</form>';
					
					} elseif (empty($flag)) {
						
						echo '<p>Please enter a name to retrieve student details</p>';
						echo '<p>Leave the name blank if you want to see the entire list of students available for sponsorships</p>';
						
						?>
						<br />
						<form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" name="studentSearchForm" id="studentSearchForm">
						  <input type="text" name="name" id="name" placeholder="Name of Student" value="" /> <br /> <? //if (!empty($name)) {echo $name;} ?>
						  <input type="submit" class="btn btn-primary" name="submit2" id="submit2" value="Search" />
						</form>
						<br />
						<?php
						if (!empty($error_msg)){
							echo '<p class="error_message">' . $error_msg . '</p>';
							}
						}
				} else {
					// If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
					echo '<p>You must login to view this page - <a href="login.php">Login</a></p>';
				}
	  ?>
      
      </div>
    </div>
	
    <div id="content_footer"></div>
    <?php include("include/footer.php");?>
  </div>
</body>
</html>
