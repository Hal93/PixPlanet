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

	$_SESSION['url_link'] = $_SERVER['REQUEST_URI'];
	$url = $_SESSION['url_link'];
	$_SESSION['new_link'] = $url;	
	
	//include External Files 
 	include ('scripts/user_checks.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Members</title>
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
				<th>Username</th>
				<th>Edit</th>
				<th>Delete</th>						
			</tr>
			<?php 
			//Connect To Database
			include ('db/connect_to_db.php');
			
			//Search the Database to check to see if the image in the database column matches the select image
			$showquery = mysqli_query($conn,"SELECT * FROM members");
	
			while($row = mysqli_fetch_array($showquery))
			{ 
				$userid = $row["userid"];
				$username = $row["username"];
			
				$newurl = "";
				$vid = "";
					
				echo '<tr>';
					echo '<td>'.$userid.'</td>';
					echo '<td>'.$username.'</td>';
					echo '<td><a href="edit_member_details.php?uid='.$userid.'&type=useredit"><img src="images/buttons/edit.png" alt="" width="35" height="35" /></a></td>';			
					echo '<td><a href="image_status.php?id='.$userid.'&type=userdelete&username='.$username.'&url='.$url.'&newurl='.$newurl.'&vid='.$vid.'"><img src="images/buttons/delete.png" alt="" width="35" height="35" /></a></td>';			
				echo '</tr>';
			}				
			mysqli_close($conn);
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