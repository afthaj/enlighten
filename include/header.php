<header id="header">
      <nav class="navbar navbar-inverse navbar-fixed-top" id="menubar">
      	<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				
				<a class="brand" href="index.php">Enlighten</a>
				
				<div class="nav-collapse collapse">
					<div class="pull-left">
						<ul class="nav" id="menu">
						  <li class="active"><a href="index.php">Home</a></li>
						  <li><a href="signUp.php">Sign Up</a></li>
						  <li><a href="#">Information</a></li>
						  <li><a href="sponsorStudentSearch.php">Student Search</a></li>
						</ul>
					</div>
					<div class="pull-right">
					<?php 
							if (isset($_SESSION['sponsorID'])) {
								echo '<div class="btn-group">
									  <a class="btn btn-primary" href="sponsorViewAndEditProfile.php"><i class="icon-user icon-white"></i> ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . '</a>
									  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
									  <ul class="dropdown-menu pull-right">
										<li><a href="sponsorViewAndEditProfile.php"><i class="icon-pencil"></i> Edit Profile</a></li>
										<li><a href="sponsorChangePassword.php"><i class="icon-lock"></i> Change Login Details</a></li>
										<li><a href="logout.php"><i class="icon-off"></i> Log Out</a></li>
									  </ul>
									</div>';
								} else {
									echo '<p class="navbar-text" id="loginIndicator">You are not currently logged in - <a href="login.php">Login</a>&nbsp;&nbsp;&nbsp;&nbsp;</p>';
									}
					  ?>
					  </div>
				</div>
			</div>
        </div>
      </nav>
	  
	<div class="span12">&nbsp;&nbsp;</div>
	<div class="span12">&nbsp;&nbsp;</div>
</header>