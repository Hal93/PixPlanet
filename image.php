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
		<title></title>
		<link rel="stylesheet" href="css/style.css" type="text/css"/> 		
        <link rel="stylesheet" href="css/banner.css" type="text/css"/>
		<link rel="stylesheet" href="css/menu.css" type="text/css" />
		<link rel="stylesheet" href="css/search.css" type="text/css"/>
 		<link rel="stylesheet" href="css/product_layout.css" type="text/css"/>              
		<link rel="stylesheet" href="css/footer.css" type="text/css"/>
		<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>			
		<script type="text/javascript" src="js/hint-textbox.js"></script>
		<script type="text/javascript" src="js/Validation.js"></script>
		<script type="text/javascript" src="js/functions.js"></script>		
	</head>
	<body onLoad='sendcat("all");'>
		<?php echo $msgerror; ?><!-- Echo Error Message-->
		<?php $cat = $_GET['cat']; ?>
		<input type="hidden" name="cattype" id="cattype" value="<?php echo $cat; ?>"/>
		
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
			<div class="left-column"><!-- Start of Left Column-->
				<h2>Categories</h2>
				<?php
				//Connect To Database
				include ('db/connect_to_db.php');
	            //Search the Database to check to see if the product in the database column matches the select product and order it by descending order
				$lftresult = mysqli_query($conn,"SELECT distinct category FROM picture WHERE mediatype='".$cat."' GROUP BY category");	
					while($leftrow = mysqli_fetch_array($lftresult))
					{ 
						$category = $leftrow["category"];
						?>
						
						<div class='left-choicediv'><!--specialoffer-divs-cols-->
							<input type="button" class="cat" id="catlink" value="<?php echo $category; ?>" onclick="sendcat(this.value);" />
						</div><!-- End of left-choicediv-->
						<?php
					}
				?>
			</div><!-- End of Left Column-->
			<div class="right-column2"><!-- Start of Right Column-->
				 <div id="Searchbox">
				 	<?php include("scripts/searchbox.php"); ?>
				</div> 
				<div id="rightcol"></div>
			</div><!-- End of Right Column--> 
			
        </div><!-- End of Container-->
			<?php 

			?>		
		<div class="full-footer"><!--Full Footer-->
			<?php include("scripts/footer.php"); ?><!-- Footer External File-->
		</div><!--End of Full Footer-->
	</body>
</html>