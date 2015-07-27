<?php
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 
	
	include_once("db/connect_to_db.php");
	$totalnumber = "";
	$ratings = "";
	$starsNo = "";

	//Search to see if if picture equals picture ID
	$sql = mysqli_query($conn,"SELECT ratings FROM picture WHERE pictureID = '".$picid."'") or die(mysqli_error($conn));
	
	while($row = mysqli_fetch_array($sql))
	{ 
		//Get Rating column from Database Table
		$rating = $row["ratings"];
		//Split String into array by comma separator
		$rating_array = explode(",", $rating);
		//Count all the values of an array
		$result = array_count_values($rating_array);
	
		//Count Array
		$arraycount = count($rating_array);
		//Add all values in array using Array_Sum
		$arraysum = array_sum($rating_array);
		//Divide up the Sum by the Total Count to get average
		$average = $arraysum / $arraycount;
		//Rounds value Downwards
		$average = floor($average);	
	
		/*Goes through all the array one at a time ($typeofval is the values in the array and $value is the number of each in array
		eg 2 cats 3 dogs 3 is the value and dog is the typeofval*/
		foreach ($result as $typeofval => $value) 
		{
			//if there is one value it is vote
			if ($value == 1) 
			{
				$howmany = "vote";
			}
			//else its votes
			elseif ($value > 1) 
			{
				$howmany = "votes";
			}
		
			//If $typeofval value is equals to any number display star number
			if ($typeofval == "") 
			{
				$starimg = "images/star/emptystars.png";
			}
		
			elseif ($typeofval == "1") 
			{
				$starsNo = "Star&nbsp&nbsp;";
				$starimg = "images/star/1star.png";
			}
			elseif ($typeofval == "2") 
			{
				$starsNo = "Stars";
				$starimg = "images/star/2stars.png";
			}
			elseif ($typeofval == "3") 
			{
				$starsNo = "Stars";
				$starimg = "images/star/3stars.png";
			}
			elseif ($typeofval == "4") 
			{
				$starsNo = "Stars";
				$starimg = "images/star/4stars.png";
			}
			elseif ($typeofval == "5") 
			{
				$starsNo = "Stars";
				$starimg = "images/star/5stars.png";
			}		
			if($average == 0)
			{
				$totalnumber = "<p class='staravg' >No Ratings Registered Yet</p>";
			}
			else
			{
				$totalnumber .= '<p class="staravg">'.$typeofval.' '.$starsNo.': <img src="'.$starimg.'" alt="stars" /> '.$value.' '.$howmany.'</p>';
			}
		}
	
		//Count Array
		$count = count($rating_array);
		//Add all values in array using Array_Sum
		$sum = array_sum($rating_array);
		//Divide up the Sum by the Total Count to get average
		$avg = $sum / $count;
		//Rounds value Downwards
		$roundedavg = floor($avg);
		
		if($roundedavg == 0)
		{
			$ratings = "<p class='staravg' style='color:#B22222'>No Ratings Yet</p>";
		}
		else if($count == 1)
		{
			$ratings = "<p class='staravg'><img id='CurrentStars' src='images/star/emptystars.png' 
			alt='stars' /></p>";
		}
		else if($count > 1)
		{
			$ratings = "<p class='staravg'><img id='CurrentStars' src='images/star/emptystars.png' 
			alt='stars' /></p>";
		}
		else
		{
			$ratings = "<p class='staravg'>Sorry, There is an error with the website... Please try refreshing the page Again</p>";
		}		
	}
?>