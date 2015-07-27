<?php
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 
	
	//Starting session
	session_start();
		
	//Get Last URL
	if (isset($_GET['url'])) 
	{
		$url = $_GET['url'];
	}
	elseif (isset($_SESSION['new_link'])) 
	{
		$url = $_SESSION['new_link'];			
	}
	else 
	{
		$url = "index.php";
	}
	
	//include External Files 
 	include ('scripts/user_checks.php');	
	
	//Store values in variables	
	$type = $_GET['type'];	
	$_SESSION['url_link'] = $_SERVER['REQUEST_URI'];
	$new_url = $_SESSION['url_link'];
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Registration</title>				
		<link rel="stylesheet" href="css/input_forms.css" type="text/css">
		<link rel="stylesheet" href="css/style.css" type="text/css"/> 		
        <link rel="stylesheet" href="css/banner.css" type="text/css"/>
		<link rel="stylesheet" href="css/search.css" type="text/css"/>             
		<link rel="stylesheet" href="css/menu.css" type="text/css" />
		<link rel="stylesheet" href="css/footer.css" type="text/css"/>
		<script type="text/javascript" src="js/hint-textbox.js"></script>
		<script type="text/javascript" src="js/Validation.js"></script>
	</head>
	<body>
		<?php echo $msgerror; ?><!-- Echo Error Message-->
       <div class="fullnav"><!--FullNav-->
            <div class="logo"><?php include("scripts/logo.php"); ?><!-- Logo External File--></div>
            <div class="centernav"><!--CenterNav-->
				 <?php include("scripts/menu.php"); ?><!-- Navigation External File-->
				 <div id="loginNav">
				 	<?php include("scripts/user_navigation.php"); ?>
				</div> 
			</div><!-- End of CenterNav-->
        </div><!-- End of FullNav-->	    			
		<div id="container"><!--Opening Container -->
			<div id="submit-head"><h3>Register New User</h3></div><!--Opening submit Header -->
			<div id="submit-area"><!-- Opening submit Area -->
				<!-- Opening submit Form -->
				<form method="post" action="image_status.php" name="RegisterForm" onsubmit="return ValidateRegisterForm();">
					<label for="fname">First Name:</label>
					<input type="text" name="fname" id="fname" />
					<label for="lname">Last Name:</label>
					<input type="text" name="lname" id="lname" />							
					<label for="username">Username:</label>
					<input type="text" name="username" id="username" />
					<label for="password">Password:</label>
					<input type="text" name="password" id="password" /><br />
                    <label for="email">Email:</label>
					<input type="text" name="email" id="email"/>
					<input type="hidden" name="type" value="<?php echo $type; ?>" />
					<input type="hidden" name="url" value="<?php echo $url; ?>" />	
					<input type="hidden" name="newurl" value="<?php echo $new_url; ?>" />										
					<input type="submit" name="submit" value="Submit" class="submit-button" />
				</form><!-- End of submit Form -->
			</div><!-- Closing submit Area -->
		</div><!--Closing Container -->
		<div class="full-footer"><!--Full Footer-->
			<?php include("scripts/footer.php"); ?><!-- Footer External File-->  
		</div><!--End of Full Footer-->
	</body>
</html>