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
	
	//Connect To Database
	include ('db/connect_to_db.php');	
	
	if(isset($_REQUEST['did']))
	{
		$did = $_REQUEST['did'];
		$actor = mysqli_query($conn,"SELECT * FROM director WHERE d_id = '".$did."'") or die(mysqli_error($conn));
		$num_check = mysqli_num_rows($actor);
		while($rows = mysqli_fetch_array($actor))
		{
			$name = $rows['name'];
		}		
	}
	elseif(!isset($_REQUEST['did']))
	{
		$did = "";
	}
	elseif(isset($_REQUEST['aid']))
	{
		$aid = $_REQUEST['aid'];	
		$actor = mysqli_query($conn,"SELECT * FROM actors WHERE aid = '".$aid."'") or die(mysqli_error($conn));
		$num_check = mysqli_num_rows($actor);
		while($rows = mysqli_fetch_array($actor))
		{
			$name = $rows['name'];
		}
	}
	elseif(!isset($_REQUEST['aid']))
	{
		$aid = "";
	}		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo $name; ?></title>
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
			if(isset($_REQUEST['did']))
			{
				//Search the Database to check to see if the image in the database column matches the select search value
				$actorquery = mysqli_query($conn,"SELECT * FROM directorjobtitle,picture WHERE directorjobtitle.directid = '".$_REQUEST['did']."' AND directorjobtitle.movieid = picture.pictureID") or die(mysqli_error());
			}
			elseif(isset($_REQUEST['aid']))
			{
				//Search the Database to check to see if the image in the database column matches the select search value
				$actorquery = mysqli_query($conn,"SELECT * FROM actorjobtitle,picture WHERE actorjobtitle.actorid = '".$_REQUEST['aid']."' AND actorjobtitle.movieid = picture.pictureID") or die(mysqli_error($conn));
			}	
			
			$num_check = mysqli_num_rows($actorquery);			
			if ($num_check == 0) 
			{
				echo "<p id='notfound'>There are no Movies or TV Shows available for ".$name."</p>";
			}
			elseif ($num_check >= 1) 
			{
				while($actrows = mysqli_fetch_array($actorquery))
				{ 
					$picid = $actrows["movieid"];
						
					$actor_picture_query = mysqli_query($conn,"SELECT * FROM picture WHERE pictureID = '".$picid."'") or die(mysqli_error());
					$nvid_num_check = mysqli_num_rows($actor_picture_query);						
					while($vidrows = mysqli_fetch_array($actor_picture_query))
					{ 
						$picid = $vidrows["pictureID"];
						$prdtitle = $vidrows["title"];
						$upload_path = $vidrows["upload_path"]; 
						$thumb = $vidrows["thumb"];
						?>
						<div class='product-divs'><!--product-divs-->
							<?php
							echo	"<h3>".$prdtitle."</h3>";
							echo	"<a href='image_details.php?vid=".$picid."'><img src=".$upload_path.$thumb." alt='".$thumb."' border='0' /></a>";
							?>
						</div><!-- End of product-divs-->
						<?php
					}						
				}						
				mysqli_close($conn);	
			}			
			?>				
        </div><!-- End of Container-->
		<div class="full-footer"><!--Full Footer-->
			<?php include("scripts/footer.php"); ?><!-- Footer External File-->
		</div><!--End of Full Footer-->
	</body>
</html>