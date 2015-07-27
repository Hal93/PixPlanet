<?php
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 
	
	//Set Variable to Clear
	$navlinks = "";
	$userchoice = "";
	$usertype = "";	
	$msgerror = "";
	$comment = "";
	
	//If Session ID is Set
	if (isset($_SESSION['id'])) 
	{
		//Put stored session variables into local php variable
		$userid = $_SESSION['id'];
		$firstname = $_SESSION['firstname'];
		$username = $_SESSION['username'];
		$comment = 	'<h3><a href="#comment">Write Comment</a></h3>';
		//Put stored session variables into local php variable
		$usertype = "My Collection";

		//Store html code in variable when user logged in 
		$userchoice = '<a href="member_collection.php?userid=' . $userid . '">' . $usertype . '</a>';
		
		//If the username is admin
		if ($username == 'admin')
		{
			$navlinks = '<h3><a href="logout.php">Log Out</a>
						<a href="admin_profile.php">' . $username . '</a></h3>';
		}
		//else Do This
		elseif ($username != 'admin')
		{
			//Store html code in variable when user logged in 
			$navlinks = '<h3><a href="logout.php">Log Out</a>
						<a href="member_profile.php?id=' . $userid . '">Welcome ' . $firstname . '</a></h3>';			
		}
	}
	//If Nobody is logged in Display This
	else 
	{
		//Store html code in variable when user is not logged in 
		$navlinks = '<form action="login.php" method="post" name="LoginForm" onsubmit="return ValidateLoginForm();">
					<input name="username" value="Username" type="text" class="hintTextbox"/> 
					<input name="password" value="Password" type="password" class="hintTextbox"/>
					<input type="hidden" name="url" value="'.$url.'" />					
					<input type="submit" name="Submit" value="login" class="submit-button" />
					</form>';
					
		$comment = "";
		
		if (!isset($url)) 
		{
			$usertype = "";
			//Store html code in variable when user is not logged in 
			$userchoice = '';
		}
		elseif (isset($url)) 
		{
		
			$usertype = "Register";
			//Store html code in variable when user is not logged in 
			$userchoice = '<a href="register.php?type=register&url='.$url.'">' . $usertype . '</a>';					
		}
	}
	
	//If Session variable error is set
	if(isset($_SESSION['error'])) 
	{
		//Store Session variable in Variable
		$msgerror = $_SESSION['error'];
		$_SESSION['error'] = "";
	}
	
	//Else Session variable error is not set
	else 
	{
		//Set Variable to Clear
		$msgerror = "";
	}
?>