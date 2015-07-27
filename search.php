<?php
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 

	//Starting session
	session_start();
	
	$_SESSION['url_link'] = $_SERVER['REQUEST_URI'];
	$url = $_SESSION['url_link'];
	$_SESSION['new_link'] = $url;
	
	//include External Files 
 	include ('scripts/user_checks.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Search Results</title>
		<link rel="stylesheet" href="css/style.css" type="text/css"/> 		
        <link rel="stylesheet" href="css/banner.css" type="text/css"/>
		<link rel="stylesheet" href="css/search.css" type="text/css"/>
 		<link rel="stylesheet" href="css/product_layout.css" type="text/css"/>         
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
		<div id="container"><!-- Start of Container-->
			<div class="fullsearch"><!-- Start of fullsearch-->
				<div id="searchdiv"><!-- Start of searchdiv-->
					<form method="GET" name="searchform" action="search.php" onsubmit="return ValidateSearchForm();">
						<input type="text" name="searchquery" />
						<input type="submit" name="search" value=""  class="searchbox_submit"/>
					</form>
				</div><!-- End of searchdiv-->
			</div><!-- End of fullsearch-->			
				<?php

			//Gets Value using $_GET
			$query = $_GET['searchquery']; 
		
			//Removes HTML code and replaces with eg.&lt to &gt        
			$query = htmlspecialchars($query); 
        
			//Removes special characters in string to stop SQL injection
			$query = mysql_real_escape_string($query);
	
			//Converts to Uppercase
			$search_upper = strtoupper($query);
			
			//Connect To Database
			include ('db/connect_to_db.php');	
		
			//Search the Database to check to see if the image in the database column matches the select search value
			$search_upper_query = mysqli_query($conn,"SELECT * FROM picture
			WHERE UPPER(title) LIKE '%".$search_upper."%' OR UPPER(plot) LIKE '%".$search_upper."%'") or die(mysqli_error($conn));
			//Count Rows
			$num_check = mysqli_num_rows($search_upper_query);
			
			if ($num_check == 0) 
			{
				echo "<p id='notfound'>No image matches your criteria</p>";				
			}
			elseif ($num_check >= 1) 
			{				
				echo "<h2 id='producttitle'>".$num_check." have been found for ".$query."</h2>";
				while($pdrows = mysqli_fetch_array($search_upper_query))
				{ 
					$picid = $pdrows["pictureID"];
					$prdtitle = $pdrows["title"];
					$upload_path = $pdrows["upload_path"]; 
					$thumb = $pdrows["thumb"];
					?>
					<div class='product-divs'><!--product-divs-->
					<?php
						echo	"<a href='image_details.php?vid=".$picid."'><img src=".$upload_path.$thumb." alt='".$thumb."' border='0' /></a>";
						?>
					</div><!-- End of product-divs-->
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