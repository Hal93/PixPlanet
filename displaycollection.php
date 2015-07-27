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
	
	//include External Files 
 	include ('scripts/user_checks.php');
	
	$_SESSION['url_link'] = $_SERVER['REQUEST_URI'];
	$new_url = $_SESSION['url_link'];		
	
	$id = $_GET['uid'];	
	$type = $_GET['type'];
	$firstname = $_SESSION['firstname'];
	
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
		<title><?php echo $firstname.'s Collection'; ?></title>	
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
		<p>&nbsp;</p>
		<p>&nbsp;</p>
        <table border="1">
			<tr>
				<th>Name</th>
				<th>Delete</th>						
			</tr>
			<?php 
			//Connect To Database
			include ('db/connect_to_db.php');
			
			//Search the Database to check to see if the image in the database column matches the select image
			$showcolquery = mysqli_query($conn,"SELECT * FROM usercollection WHERE userid = '".$id."'");
			$num_check = mysqli_num_rows($showcolquery);
			if ($num_check == 0) 
			{
				echo '<tr>';
					echo '<td></td>';
					echo '<td></td>';			
				echo '</tr>';
			}
			else 
			{
				?>
				<form method="post" action="image_status.php" name="collectionform">
					<?php			
					while($row = mysqli_fetch_array($showcolquery))
					{ 
						$pictureID = $row["pictureID"];

						$result = mysqli_query($conn,"SELECT * FROM picture WHERE pictureID = '".$pictureID."'");
						while($trow = mysqli_fetch_array($result))
						{ 
							$title = $trow["title"];		
						

							echo '<tr>';
								echo '<td><a href="image_details.php?vid='.$pictureID.'">'.$title.'</a></td>';
								echo '<td><input type="checkbox" name="deletebtn[]" value="'.$pictureID.'"></td>';			
							echo '</tr>';
						}
					}

					mysqli_close($conn);
					?>
					<input type="hidden" name="id" value="<?php echo $id; ?>" />					
					<input type="hidden" name="type" value="<?php echo $type; ?>" />
					<input type="hidden" name="url" value="<?php echo $url; ?>" />	
					<input type="hidden" name="newurl" value="<?php echo $new_url; ?>" />
					<tr>
						<td></td>
						<td><input type="submit" name="submit" value="Submit" class="submit-button" /></td>					
					</tr>
				</form>	
				<?php
			}	
			?>			
		</table>
		<p>&nbsp;</p>
		<p>&nbsp;</p>		
        <div class="clear"></div>                                     
		<div class="full-footer"><!--Full Footer-->
			<?php include("scripts/footer.php"); ?><!-- Footer External File-->
		</div><!--End of Full Footer-->
	</body>
</html>