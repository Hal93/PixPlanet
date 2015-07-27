<?php
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 
	
	//Starting session
	session_start();
	
	//Check if $_GET variables equals value
	$picid = $_GET['vid'];	
	
	//Store values in variables
	$_SESSION['url_link'] = $_SERVER['REQUEST_URI'];
	$url = $_SESSION['url_link'];
	$_SESSION['new_link'] = $url;
	
	//include External Files 	
 	include ('scripts/user_checks.php');
	//Average Star Ratings
	include ('scripts/avgstar.php');
	
	//Connect To Database
	include ('db/connect_to_db.php');	
	//Search the Database to check to see if the image in the database column matches the select image
	$result = mysqli_query($conn,"SELECT * FROM picture WHERE pictureID = '".$picid."'");
	while($row = mysqli_fetch_array($result))
	{ 
		$title = $row["title"];			
		$fullimage = $row["fullimage"];
		$mediatype = $row["mediatype"];
		$mediaformat = $row["mediaformat"];
		$upload_path = $row["upload_path"];	
		$category = $row["category"];	
		$thumb = $row["thumb"];	
		$storyline = $row["plot"]; 
		$date_added = $row["date_added"]; 		
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" href="css/style.css" type="text/css"/> 		
        <link rel="stylesheet" href="css/banner.css" type="text/css"/>
		<link rel="stylesheet" href="css/search.css" type="text/css"/>              
		<link rel="stylesheet" href="css/menu.css" type="text/css" />
		<link rel="stylesheet" href="css/footer.css" type="text/css"/>		
		<link rel="stylesheet" href="css/product_layout.css" type="text/css"/>
        <link rel="stylesheet" href="css/comments.css" type="text/css"/>
		<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
		<script src="js/jquery-1.8.0.min.js"></script>		
		<script type="text/javascript" src="js/lightbox.js"></script>
		<script type="text/javascript" src="js/Validation.js"></script>
		<script type="text/javascript" src="js/functions.js"></script>
		<script  async type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>	
		<script  async type="text/javascript">stLight.options({publisher: "70e80440-0f9f-48f7-ae4f-037a328c3489", doNotHash: false, doNotCopy: false, hashAddressBar: false}); </script>			
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
		<div id="container"> <!--Opening Container -->
			<div class="product"><!--Opening Review-->
				<div class="product-image"><!--Opening product-Image-->
					<a href="<?php echo $upload_path.$fullimage; ?>" rel="lightbox" title="<?php echo $title; ?>">
					<img src="<?php echo $upload_path.$thumb; ?>" alt="<?php echo $title; ?>" width="140" height="200" /></a>
				</div><!--Closing product-Image-->
				<div class="social-links"><!--Opening Social Links-->
						<span class='st_facebook_large' displayText='Facebook'></span>
						<span class='st_twitter_large' displayText='Tweet'></span>
						<span class='st_googleplus_large' displayText='Google +'></span>
						<span class='st_pinterest_large' displayText='Pinterest'></span>
				</div><!--Closing Social Links-->
				<div class="product-details"><!--Opening Image Details-->
					<h3>Image Details</span></h3>
					<ul>
						<li>Title:</span> <?php echo $title; ?></li>
						<li><span>Date:</span> <?php echo date('d-m-Y', strtotime($date_added));?></li>
						<li><span>Type:</span> <?php echo $category; ?></li>
						<?php echo $ratings; ?>
				</div><!--Closing Image Details -->
				
				<div class="product-info"><!--Opening product-info-->
					
                    <div class="product-storyline">					
						<?php
						echo "<h3>$title</h3>";
						if ($storyline == "") 
						{
							?>
							<br />
							<p>No Experience Given</p>					
							<?php
						}
						else 
						{
							echo "<p>".$storyline."</p>";
						}
						?>
					</div>				
					
					<?php include("scripts/member_settings.php"); ?><!-- Logo External File-->
					<?php include("scripts/admin_edit_settings.php"); ?><!-- Logo External File-->                    
					
					<div class="outer-comment"><!--opening outer comments-->  
						<?php include("scripts/comments.php"); ?><!--- Display Comments External File-->
					</div><!--Closing outer comments-->  


				</div><!--Closing product-info-->

				
				<div class="rating-container">
					<h3>Pic Ratings</h3>
					<?php echo $totalnumber; ?>
					<input type="hidden" name="vid" id="picid" value="<?php echo $picid; ?>" />	
					<input type="hidden" name="id" id="userid" value="<?php echo $_SESSION['id']; ?>" />
					<input type="hidden" name="vtype" id="vtype" value="<?php echo $mediatype; ?>" />
					<div class="stars">
						<?php include("scripts/starchk.php"); ?><!-- Navigation External File-->
						<script type="text/javascript">hoverchk(); staravgresults();</script>		
					</div>	
				</div>
			</div><!--Closing product--> 
			
		</div> <!--Closing Container -->
		<div class="full-footer"><!--Full Footer-->
			<?php include("scripts/footer.php"); ?><!-- Footer External File-->
		</div><!--End of Full Footer-->
	</body>
</html>