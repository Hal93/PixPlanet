<?php
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 
	
	//Starting session
	session_start();
	
	if (!isset($_GET['userid'])) 
	{
		//Redirect back to URL 
		header( 'Location: index.php');
	}	
	
	//Store values in variables
	$userID = $_GET['userid'];
	$username = $_SESSION['username'];
	$firstname = $_SESSION['firstname'];	
	$_SESSION['url_link'] = $_SERVER['REQUEST_URI'];
	$url = $_SESSION['url_link'];
	
	//include External Files
 	include ('scripts/user_checks.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo $firstname."'s Collection"; ?></title>
		<link rel="stylesheet" href="css/style.css" type="text/css"/> 		
        <link rel="stylesheet" href="css/banner.css" type="text/css"/>
		<link rel="stylesheet" href="css/menu.css" type="text/css" />
		<link rel="stylesheet" href="css/search.css" type="text/css"/>
 		<link rel="stylesheet" href="css/product_layout.css" type="text/css"/>              
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
        <div id="container"><!--Start of Container-->
			<?php
			//Connect To Database
			include ('db/connect_to_db.php');	
	        //Search the Database to check to see if the image in the database column matches the select image for collection
			$prdresult = mysqli_query($conn,"SELECT picture.pictureID,picture.title,picture.upload_path,picture.thumb FROM picture,usercollection 
			WHERE usercollection.userid='".$userID."' AND usercollection.pictureID=picture.pictureID");	
			$num_check = mysqli_num_rows($prdresult);
			if ($num_check == 0) 
			{
				echo "<p id='notfound'>No Pictures in Favourites</p>";
			}
			else 
			{
				while($pdrows = mysqli_fetch_array($prdresult))
				{ 
					$picid = $pdrows["pictureID"];
					$title = $pdrows["title"];
					$upload_path = $pdrows["upload_path"]; 
					$thumb = $pdrows["thumb"];
					?>
				<div id='collect'>
					<div class='product-divs'><!--product-divs-->
						
						<?php
						
						echo	"<a href='image_details.php?vid=".$picid."'><img src=".$upload_path.$thumb." alt='".$thumb."' border='0' /></a>";
						 ?><!-- Members Settings External File-->
						</div>
					</div><!-- End of product-divs-->
				</div>
					<?php
				}				
			}	
			mysqli_close($conn);
			?>				
        </div><!-- End of Container-->
		<div class="full-footer"><!--Full Footer-->
			<?php include("scripts/footer.php"); ?><!-- Footer External File-->
		</div><!--End of Full Footer-->
	</body>
</html>