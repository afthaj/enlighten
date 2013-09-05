<?php
  require_once("constants/connectvars.php");

  // Start the session
  session_start();

  // Clear the error message
  $error_msg = "";

  //log user in via SESSION or COOKIES
  require_once("include/logUserIn.php");
  
?>

<!DOCTYPE HTML>
<html>

<head>
	<title>Home | Enlighten</title>

	<?php require_once("include/pagehead.php");?>
	
	<!--flexslider css and js imports-->
	<link href="css/flexslider.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.flexslider.js"></script>
	
	<!--flexslider script-->
	<script>
		$(window).load(function() {
			$('.flexslider').flexslider({
			animation: "slide"
			});
		});
	</script>

</head>

<body>
	<div class="container-fluid" id="main">
		
		<!--header-->
		<div class="row-fluid">
			<?php include("include/header.php");?>
		</div>
		<!--end header-->
	  
		<!--main content-->	
		<div class="row-fluid">
			<div class="flexslider">
				<ul class="slides">
					<li>
					<img src="images/galleria/slide1.jpg" />
					</li>
					<li>
					<img src="images/galleria/slide2.jpg" />
					</li>
					<li>
					<img src="images/galleria/slide3.jpg" />
					</li>
					<li>
					<img src="images/galleria/slide4.jpg" />
					</li>
				</ul>
			</div>
		</div>
			
		<div class="row-fluid">
			<h1>Welcome to Enlighten</h1>
		</div>
			
		<div class="row-fluid" id="content">
			<p>You can use Enlighten to help students learn and share their happiness as they are granted with the gift of education. You can search for a student by entering his or her name. Alternatively you can view the whole list of students. after selecting, you can login to the system and submit the sponsorship request.</p>
		</div>
		<!--end main content-->
	  
		<!--footer-->
		<div class="row-fluid">
			<?php include("include/footer.php");?>
		</div>
		<!--end footer-->
	</div>

</body>

</html>
