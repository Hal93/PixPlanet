<?php
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 
	
	//Starting session
	session_start();
	
	if (!isset($_SESSION['id'])) 
	{
		//Redirect back to URL 
		header( 'Location: index.php');
	}

	$_SESSION['url_link'] = $_SERVER['REQUEST_URI'];
	$new_url = $_SESSION['url_link'];	
	
	//include External Files
 	include ('scripts/user_checks.php');	

	//Store values in variables
	$username = $_SESSION['username'];	
	$id = $_GET['uid'];	
	$type = $_GET['type'];
	
	if (!isset($_GET['url'])) 
	{
		$url = "index.php";
	}
	elseif (isset($_GET['url'])) 
	{
		$url = $_GET['url'];				
	}
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Edit <?php echo $username; ?>'s Information</title>				
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
		<?php
		//Connect To Database
		include ('db/connect_to_db.php');
		//Search the Database to check to see if the product in the database column matches the select product
		$memquery = mysqli_query($conn,"SELECT * FROM members WHERE userid='".$id."'");
	
		while($row = mysqli_fetch_array($memquery))
		{ 
			$fname = $row["firstname"];	
			$lname = $row["lastname"];			
			$username = $row["username"];	
			$email = $row["email"];
		}
		
		mysqli_close($conn);
		?>
		<div id="container"><!--Opening Container -->
			<div id="submit-head"><h3>Edit Information</h3></div><!--Opening submit Header -->
			<div id="submit-area"><!-- Opening submit Area -->
				<!-- Opening submit Form -->
				<form method="post" action="image_status.php" name="editform">
					<label for="username">Username:</label>										
					<input type="text" name="username" readonly="true" id="username" value="<?php echo $username; ?>" />					
					<label for="fname">First Name:</label>
					<input type="text" name="fname" id="fname" value="<?php echo $fname; ?>" /><br />
					<label for="lname">last Name:</label>
					<input type="text" name="lname" id="lname" value="<?php echo $lname; ?>" /><br />						
					<label for="email">Email:</label>
					<input type="text" name="email" id="email" value="<?php echo $email; ?>"/>
					<input type="hidden" name="id" value="<?php echo $id; ?>" />
					<input type="hidden" name="type" value="<?php echo $type; ?>" />
					<input type="hidden" name="url" value="<?php echo $url; ?>" />	
					<input type="hidden" name="newurl" value="<?php echo $new_url; ?>" />
					<input type="submit" name="submit" value="Update" class="submit-button" />
				</form><!-- End of submit Form -->
			</div><!-- Closing submit Area -->
		</div><!--Closing Container -->
		<div class="full-footer"><!--Full Footer-->
			<?php include("scripts/footer.php"); ?><!-- Footer External File-->  
		</div><!--End of Full Footer-->
	</body>
</html>