<?php
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 
	
	//Starting session
	session_start();
	include ('db/connect_to_db.php');
	//Get Variables Sent by Ajax
	$category = $_REQUEST['catchoice'];
	$cattype = $_REQUEST['cattype'];
	
	//Check if Category is equals to value all or empty string
	if (($category == "all") || ($category == "")) 
	{
		$numberof = "";
		$cathead = "";
		$newcatchoices = mysqli_query($conn,"SELECT pictureID,title,upload_path,thumb FROM picture WHERE mediatype='".$cattype."' ORDER BY title") 
		or die(mysqli_error($conn)); 
	}
	//Else
	else 
	{
		$numberof = $cattype;
		$cathead = $category;
		$newcatchoices = mysqli_query($conn,"SELECT pictureID,title,upload_path,thumb FROM picture WHERE mediatype='".$cattype."' AND category='".$category."' 
		ORDER BY title") or die(mysqli_error($conn)); 
	}	
	
	//Counts All Rows in query	
	$num_rows = mysqli_num_rows($newcatchoices);

		
	//If type is movie or tv show
	if ($cattype == "movie")
	{
		$numberof = "Movies";	
		echo '<script type="text/javascript">document.title = '.$numberof.';</script>';
		
	}

	elseif ($cattype == "tvshow") 
	{
		$numberof = "TV Shows";	
		echo '<script type="text/javascript">document.title = '.$numberof.';</script>';
	}	
			
	//Echo heading on page		
	
			
	//If no records found display none		
	if ($num_rows == 0) 
	{
		echo "<p id='notfound'>There are no available Titles</p>";
	}
	//Else Show Requested Records
	else 
	{
		while($pdrows = mysqli_fetch_array($newcatchoices))
		{ 
			$picid = $pdrows["pictureID"];
			$prdtitle = $pdrows["title"];
			$upload_path = $pdrows["upload_path"]; 
			$thumb = $pdrows["thumb"];

			echo "<div class='product-divs'><!--product-divs-->";
			echo  "<a href='image_details.php?vid=".$picid."'><img src=".$upload_path.$thumb." alt='".$thumb."' border='0' /></a>";
			echo  "</div><!-- End of product-divs-->";
		}
	}	
?>	