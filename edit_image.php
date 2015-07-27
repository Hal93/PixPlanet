<?php
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 
	
	//Starting session
	session_start();
	
	if (!isset($_SESSION['id']) || $_SESSION['username'] != "admin") 
	{
		//Redirect back to URL 
		header( 'Location: index.php');
	}	
	
	//include External Files
 	include ('scripts/user_checks.php');
	
	$vid = $_GET['vid'];
	$type = $_GET['type'];
	$url = $_GET['url'];
	$_SESSION['url_link'] = $_SERVER['REQUEST_URI'];
	$new_url = $_SESSION['url_link'];
	
	//Connect To Database
	include ('db/connect_to_db.php');	
	//Search the Database to check to see if the image in the database column matches the select image
	$memquery = mysqli_query($conn,"SELECT * FROM picture WHERE pictureID='".$vid."'");
	
	while($row = mysqli_fetch_array($memquery))
	{ 
		// Get member ID into a session variable
		$title = $row["title"];
		$category = $row["category"];
		$mediatype = $row["mediatype"];
		$mediaformat = $row["mediaformat"];
		$upload_path = $row["upload_path"];
		$storyline = $row["plot"];			
	}	
	mysqli_close($conn);
	
	//Set Counters to 0
	$i = 0;
	$j = 0;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Edit Image Information</title>
		<link rel="stylesheet" href="css/input_forms.css" type="text/css">
		<link rel="stylesheet" href="css/style.css" type="text/css"/> 		
        <link rel="stylesheet" href="css/banner.css" type="text/css"/>
		<link rel="stylesheet" href="css/search.css" type="text/css"/>             
		<link rel="stylesheet" href="css/menu.css" type="text/css" />
		<link rel="stylesheet" href="css/footer.css" type="text/css"/>
		<script type="text/javascript" src="js/functions.js"></script>
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
			<div id="submit-head"><h3>Edit Image Information</h3></div><!--submit Header -->
			<div id="submit-area"><!-- Opening submit Area -->
				<form method="post" action="image_status.php" name="editProductForm">
					<label for="title">Title:</label>
					<input type="text" name="title" id="title" value="<?php echo $title; ?>"  />
					<label for="category">Category:</label>
					<input type="text" name="category" value="<?php echo $category; ?>" />
					<label for="plot">Experience:</label>
					<textarea name="plot" cols="" rows="4"><?php echo $storyline; ?></textarea>
										
					<input type="submit" name="submit" value="Submit" class="submit-button" />
				</form><!-- End of submit Form -->
			</div><!-- Closing submit Area -->
		</div><!--Closing Container -->
		<div class="full-footer"><!--Full Footer-->
			<?php include("scripts/footer.php"); ?><!-- Footer External File-->  
		</div><!--End of Full Footer-->
	</body>
</html>