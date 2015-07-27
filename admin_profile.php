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
	
	//Store values in variables
	$username = $_SESSION['username'];
	$id = $_SESSION['id'];
	$_SESSION['url_link'] = $_SERVER['REQUEST_URI'];
	$url = $_SESSION['url_link'];
	
	//include External Files
 	include ('scripts/user_checks.php');

	//Connect To Database
	include ('db/connect_to_db.php');	
	//Search the Database to check to see if the user in the database column matches the select user
	$result = mysqli_query($conn,"SELECT * FROM members WHERE userid = '".$id."'");
	
	while($row = mysqli_fetch_array($result))
	{ 
		$fname = $row["firstname"];
		$lname = $row["lastname"];	
		$username = $row["username"];
		$email = $row["email"];
		$date_added = $row["date_added"];
	}
	mysqli_close($conn);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Administrator Profile</title>
		<link rel="stylesheet" href="css/members.css" type="text/css">
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
			<div class="members"><!--Opening members-->
				<div class="members-info"><!--Opening members-Info-->
					<div class="members-title"><h2><?php echo $username; ?>'s Profile</h2></div><!--members-Title-->
					<p></p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<h3><span>Name:</span> <?php echo $fname." ".$lname; ?></h3>	
					<h3><span>Username:</span> <?php echo $username; ?></h3>
					<h3><span>Email Address:</span><?php echo $email; ?></h3>
					<p>&nbsp;</p>
					<p>&nbsp;</p>					
					<ul id ="admin-button-table">
						<li><h3><a href="edit_member_details.php?uid=<?php echo $id; ?>&url=<?php echo $url; ?>&type=useredit" target="_self"><button>Edit Your Details</button></a></h3></li>
						<li><h3><a href="new_image.php?type=newimage&url=<?php echo $url; ?>" target="_self"><button>Upload Image</button></a></h3></li>			
						<li><h3><a href="register.php?type=register&url=<?php echo $url; ?>" target="_self"><button>Register New User</button></a></h3></li>						
	                    <li><h3><a href="show_members.php" target="_self"><button>Show Members</button></a></h3></li>
						<li><h3><a href="show_products.php" target="_self"><button>Show Products</button></a></h3></li>
					</ul>			
				</div><!--Closing members-Info-->
			</div><!--Closing members-->   
		</div><!--Closing Container -->
		<div class="full-footer"><!--Full Footer-->
			<?php include("scripts/footer.php"); ?><!-- Footer External File-->  
		</div><!--End of Full Footer-->
	</body>
</html>