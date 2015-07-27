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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Images</title>	
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
				<th>Id</th>
				<th>Product</th>
				<th>Type</th>
				<th>Format</th>
				<th>Edit</th>
				<th>Delete</th>						
			</tr>
			<?php 
			//Connect To Database
			include ('db/connect_to_db.php');
			
			//Search the Database to check to see if the image in the database column matches the select image
			$showquery = mysqli_query($conn,"SELECT * FROM picture");
			$num_check = mysqli_num_rows($showquery);
			if ($num_check == 0) 
			{
				echo '<tr>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td></td>';				
					echo '<td><a href=""><img src="images/buttons/edit.png" alt="" width="60" height="60" /></a></td>';			
					echo '<td><a href=""><img src="images/buttons/delete.png" alt="" width="60" height="60" /></a></td>';			
				echo '</tr>';
			}
			else 
			{
				while($row = mysqli_fetch_array($showquery))
				{ 
					$pictureID = $row["pictureID"];
					$title = $row["title"];
					$mediatype = $row["mediatype"];
					$mediaformat = $row["mediaformat"];
					
					$newurl = "";
					$id = "";
			
					echo '<tr>';
						echo '<td>'.$pictureID.'</td>';
						echo '<td>'.$title.'</td>';
						echo '<td>'.$mediatype.'</td>';
						echo '<td>'.$mediaformat.'</td>';				
						echo '<td><a href="edit_image.php?vid='.$pictureID.'&type=productedit&url=index.php"><img src="images/buttons/edit.png" alt="" width="35" height="35" /></a></td>';			
						echo '<td><a href="image_status.php?vid='.$pictureID.'&type=productdelete&title='.$title.'&url=index.php&newurl='.$newurl.'&id='.$id.'"><img src="images/buttons/delete.png" alt="" width="35" height="35" /></a></td>';			
					echo '</tr>';
				}
				mysqli_close($conn);				
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