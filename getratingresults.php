<?php
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 

	//Connect to Database
	include("db/connect_to_db.php");
	//If POST value is set
	if(isset($_POST["vid"]))
	{
		$picid = $_POST["vid"];
	}

	//Use Select Query to get ratings from table
	$sql = mysqli_query($conn,"SELECT ratings FROM picture WHERE pictureID = '".$picid."'");

	while($row = mysqli_fetch_array($sql))
	{ 
		$rating = $row["ratings"];
	
		//Split String into array by comma separator
		$rating_array = explode(",", $rating);
		//Count Array
		$count = count($rating_array);
		//Add all values in array using Array_Sum
		$sum = array_sum($rating_array);
		//Divide up the Sum by the Total Count to get average
		$avg = $sum / $count;
		//Rounds value Downwards
		$roundavg = floor($avg);
	
		//If any of the values equals the rounded average echo out number which goes back to ajax
		if($roundavg == 0)
		{
			echo "0";
		}
		
		elseif($roundavg == 1)
		{
			echo "1";
		}
		
		elseif($roundavg == 2)
		{
			echo "2";
		}	
		
		elseif($roundavg == 3)
		{
			echo "3";
		}
		
		elseif($roundavg == 4)
		{
			echo "4";
		}	
		
		elseif($roundavg == 5)
		{
			echo "5";
		}		
	}
?>