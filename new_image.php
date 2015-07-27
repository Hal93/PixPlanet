<?php
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 
	
	//Starting session
	session_start();	
	
	//include External Files 
 	include ('scripts/user_checks.php');
	
	$type = $_GET['type'];
	$url = $_GET['url'];
	$_SESSION['url_link'] = $_SERVER['REQUEST_URI'];
	$new_url = $_SESSION['url_link'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Upload Image</title>
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
				<div id="submit-head"><h3>Upload Image</h3></div><!--Opening submit Header -->
				<div id="submit-area"><!-- Opening submit Area -->
					<form method="post" action="image_status.php" name="newProductForm" enctype="multipart/form-data">
						<label for="title">Title:</label>
						<input type="text" name="title" id="title"  />
						<label for="category">Category</label>
						<input type='text' name='category'>
						<label for="plot">Experience</label>
                        <textarea name="plot" cols="" rows="4"></textarea>
                        <label for="image">Image:</label>
						<input type="file" name="image" id="image"  />	
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