<?php 
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 

	if(isset($_POST["starchoice"]))
	{
		//Use Expressions and make sure its all numbers and replaces any other value with a blank space
		$starchoice = preg_replace('#[^0-9]#i', '', $_POST['starchoice']);
		
		//If A user puts less than 5 exit
		if ($starchoice < 1) 
		{
			echo '<p class="errorclass">You entered an invalid vote with vote less than 5</p>';
			exit();
		}
		//If A user puts more than 5 exit
		elseif ($starchoice > 5) 
		{
			echo '<p class="errorclass">You entered an invalid vote more than 5</p>';
			exit();
		}	
		
		//If all is ok
		else 
		{
			$picid = $_POST["picid"];
			$userid = $_POST["userid"];
			$type = $_POST["type"];
			//Connect to Database
			include ('db/connect_to_db.php');
			
			//Check if user has already submitted a rating
			$sql_check = mysqli_query($conn,"SELECT * FROM rating WHERE userid = '".$userid."' AND picid = '".$picid."'");
			$num_rows = mysqli_num_rows($sql_check);
			
			//If More that 0 exit
			if($num_rows > 0)
			{
				echo '<p class="errorclass">Sorry, You have already rated this Title</p>';
				exit();
			}
			
			//If user is not found then user can be inserted
			$sql = mysqli_query($conn,"SELECT ratings FROM picture WHERE pictureID = '".$picid."'");
			while($row = mysqli_fetch_array($sql))
			{ 
				$rating = $row["ratings"];
				//Split String into array by comma separator
				$rating_array = explode(",", $rating);
				//Push users choice to end of the array
				array_push($rating_array, $starchoice);
				//Turn Array back into a string
				$ratings_string = implode(",", $rating_array);
				//Finds First Value in string
				$startval = substr($ratings_string, 0, 1);
				//Finds last Value in string
				$endval = substr($ratings_string, strlen($ratings_string) - 1, 1);
				
				//If comma found at start of string just add users starchoice
				if($startval == ",")
				{
					$ratings_string = $starchoice;
				}
				
				//If comma found at end of string remove comma
				if($endval == ",")
				{
					$ratings_string = substr($string, strlen($string) - 1, 1);
				}
				
				//Update movie in database
				$update = mysqli_query($conn,"UPDATE picture SET ratings='".$ratings_string."' WHERE pictureID = '".$picid."'");
				//Insert User into ratings table
				$insert = mysqli_query($conn,"INSERT INTO rating (userid, picid) VALUES ('".$userid."', '".$picid."')");
				//Echo Back the result to Ajax to display on screen
				echo '<p class="errorclass">Thanks! You have given this '.$type.' a rating of '.$starchoice.'</p>';
				//Exit the Page
				exit();
			}
			
			echo '<script type="text/javascript">location.reload(true);</script>';
		}
	}
?>