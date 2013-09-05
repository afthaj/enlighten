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
	
	  if (isset($_POST['submit'])) {
		  
		  $year = $_POST['year'];
		  $month = $_POST['month'];
		  $day = $_POST['day'];
		  
		  if (!empty($year) && !empty($month) && !empty($day)) {
			  
			  $deadline = '' . $year . '-' . $month . '-' . $day . ' 00:00:00';
		  
			  $query = "UPDATE deadline SET deadline = '$deadline' WHERE name = 'Application Deadline'";
			  mysqli_query($dbc, $query) or die('Error querying database.');
			  
			  $error_msg = 'Deadline updated successfully';
			  
			  } else {
				  $error_msg = 'You must enter values for Day, Month and Year';
				  }
		  }
	  }
?>

<!DOCTYPE HTML>
<html>

<head>
  <title>Deadlines | UAS Admin</title>
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
          <li class="selected"><a href="adminDeadlines.php">Deadlines</a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
    
      <div id="content">
      
      <h1>Edit Application Submission Deadline</h1>
      
      <?php
	  
	  if (isset($_SESSION['adminID'])) {
		  
		  echo '<p>You are logged in as ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' - <a href="logout.php">Log Out</a></p>';
	  
		  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		  $query = "SELECT * FROM deadline";
		  $data = mysqli_query($dbc, $query);
		  $row = mysqli_fetch_array($data);
		  
		  $currentDeadline = $row['deadline'];
		  
		  if (!empty($currentDeadline)) {
			  echo '<p class="result_msg">The Current Deadline is ' . $currentDeadline . '</p>';
			  }
			  
		  if (!empty($error_msg)){
			  echo '<p class="error_message">' . $error_msg . '</p>';
			  }
		  
		  if ($_SESSION['privilegeLevel'] == 02) {
	  
      ?>
      
      <br />
      <p>Please choose a new Deadline : </p>
      
      <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" name="editDeadlineForm" id="editDeadlineForm">
        
        <label for="year">Year : &nbsp;</label>
        <select name="year" id="year">
            <option value="">--Choose one--</option>
            <option value="2020">2020</option>
            <option value="2019">2019</option>
            <option value="2018">2018</option>
            <option value="2017">2017</option>
            <option value="2016">2016</option>
            <option value="2015">2015</option>
            <option value="2014">2014</option>
            <option value="2013">2013</option>
            <option value="2012">2012</option>
            <option value="2011">2011</option>
            <option value="2010">2010</option>
        </select>
        &nbsp;
        <label for="month">Month : &nbsp;</label>
        <select name="month" id="month">
            <option value="">--Choose one--</option>
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>
        &nbsp;
        <label for="day">Day : &nbsp;</label>
        <select name="day" id="day">
            <option value="">--Choose one--</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
        </select>
        &nbsp;
        <input type="submit" name="submit" id="submit" value="Edit Deadline">
      </form>
      
      <?php
	  } else {
		  echo '<p class="error_message">You do not have sufficient privileges to edit the deadline to submit applications</p>';
		  }
	  } else {
		  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
		  echo '<p>You must login to view this page - <a href="adminLogin.php">Login</a></p>';
		  }
      ?>
      
      </div>
    </div>
    <div id="footer">
    <?php
	require_once('footerconstants.php');
	
	echo '<p align="center">' . COPYRIGHT1 . '</p>';
	echo '<p align="center">' . COPYRIGHT2 . '</p>';
	?>
    </div>
  </div>
  
  <script>
    
    // Load theme
    Galleria.loadTheme('images/galleria/src/themes/dots/galleria.dots.js');
    
    $('#gallery').galleria();
    
</script>
  
</body>
</html>
