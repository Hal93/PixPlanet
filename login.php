
<?php 
	//Login Page
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 
	//Starting session
	session_start();

	if (isset($_SESSION['id'])) 
	{
		//Redirect back to URL 
		header( 'Location: index.php');
	}	
	
	//Get Last URL
	$url = $_SESSION['new_link'];	
	
	if (isset($_POST['username'])) 
	{
		$user = $_POST['username'];
		$user = trim($user);
		$password = $_POST['password'];
		$password = trim($password);
		$password = md5($password);
				
		//Connect To Database
		include ('db/connect_to_db.php');				
		$login = mysqli_query($conn,"SELECT * FROM members WHERE username='".$user."' AND password='".$password."'") or die ("Error in query: '".$login."'");
		$login_check = mysqli_num_rows($login);
		if($login_check > 0)
		{ 
			while($row = mysqli_fetch_array($login))
			{ 
				// Get member ID into a session variable
				$id = $row["userid"];    
				$_SESSION['id'] = $id;
				// Get member username into a session variable
				$username = $row["username"];   
				$_SESSION['username'] = $username;
				$fname = $row["firstname"];	
				$_SESSION['firstname'] = $fname;
			} // close while
			
			//Update recent login Date in the database
			$login_update = mysqli_query($conn,"UPDATE members SET last_logged_in = NOW() WHERE userid = '".$id."'");				
			//Redirect back to URL 
			header( 'refresh: 0; url='.$url);
		} //End of if Function Login Check
		else 
		{
			// Redirect to Index Page
			$msg='<script type="text/javascript">alert("Incorrect Username or Password");</script>';
			$_SESSION['error'] = $msg;
			//Redirect back to URL 
			header( 'refresh: 0; url='.$url);
		} //End of Else Function
	} //End of if Function isset Username

	mysqli_close($conn);

?>