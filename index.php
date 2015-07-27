<?php
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 
	
	//Starting session
	session_start();
	
	//Store values in variables
	$_SESSION['url_link'] = $_SERVER['REQUEST_URI'];
	$url = $_SESSION['url_link'];
	$_SESSION['new_link'] = $url;	
	
	//include External Files
 	include ('scripts/user_checks.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Pix Planet</title>
		<link rel="stylesheet" href="css/style.css" type="text/css"/> 		
        <link rel="stylesheet" href="css/banner.css" type="text/css"/>
		<link rel="stylesheet" href="css/search.css" type="text/css"/>
 		<link rel="stylesheet" href="css/product_layout.css" type="text/css"/>              
		<link rel="stylesheet" href="css/menu.css" type="text/css" />
		<link rel="stylesheet" href="css/footer.css" type="text/css"/>
		<script src="js/jquery-1.8.0.min.js"></script>			
		<script type="text/javascript" src="js/hint-textbox.js"></script>
		<script type="text/javascript" src="js/Validation.js"></script>
		<script type="text/javascript" src="js/functions.js"></script>		
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
		<div id="container"><!-- Start of Container-->
			<div class="left-column"><!-- Start of Left Column-->
				<h2>Most Popular</h2>
				<?php
				//Set Number of Film to empty
				$nums = "";
				//Connect To Database
				include ('db/connect_to_db.php');
	             //Search the Database to check to see if the image in the database column matches the select image and order it by descending order
				$lftresult = mysqli_query($conn,"SELECT pictureID,title,upload_path,thumb FROM picture ORDER BY date_added DESC LIMIT 10");	
				$lftnum_check = mysqli_num_rows($lftresult);
				if ($lftnum_check == 0) 
				{
					echo "<h3>No picture's Available</h3>";
				}
				else 
				{
					while($leftrow = mysqli_fetch_array($lftresult))
					{ 
						//Increment Number of pictures
						$nums++;
						$picid = $leftrow["pictureID"];
						$title = $leftrow["title"];
						$upload_path = $leftrow["upload_path"]; 
						$thumb = $leftrow["thumb"];
						?>
						<div class='left-divs-cols'><!--specialoffer-divs-cols-->
							<?php
							echo  "<a href='image_details.php?vid=".$picid."'><img src=".$upload_path.$thumb." alt='".$thumb."' width='120' height='120' title='".$title."' border='0' /></a>";
							echo  "<h3><a href='image_details.php?vid=".$picid."'></a></h3>";
							?>
						</div><!-- End of left-divs-cols-->
						<?php
					}
				}
				?>
			</div><!-- End of Left Column-->
			
			<div class="right-column"><!-- Start of Right Column-->
				<?php
	             //Search the Database to check to see if the image in the database column matches the select image
				$rghtresult = mysqli_query($conn,"SELECT pictureID,title,upload_path,thumb FROM picture ORDER BY title");	
				$rhtnum_check = mysqli_num_rows($rghtresult);
				if ($rhtnum_check == 0) 
				{
					echo "<h3>No picture's Available</h3>";
				}
				else 
				{
					while($rghtrow = mysqli_fetch_array($rghtresult))
					{ 
						$picid = $rghtrow["pictureID"];
						$title = $rghtrow["title"];
						$upload_path = $rghtrow["upload_path"]; 
						$thumb = $rghtrow["thumb"];
						?>
						<div class='product-divs'><!--product-divs-->
							<?php
							echo	"<a href='image_details.php?vid=".$picid."'><img src=".$upload_path.$thumb." alt='".$thumb."' title='".$title."' border='0' /></a>";
							?>
						</div><!-- End of product-divs-->
						<?php
					}				
				}
				
				mysqli_close($conn);
				?>
			</div><!-- End of Right Column-->   
        </div><!-- End of Container-->
		<div class="full-footer"><!--Full Footer-->
			<?php include("scripts/footer.php"); ?><!-- Footer External File-->
		</div><!--End of Full Footer-->
	</body>
</html>