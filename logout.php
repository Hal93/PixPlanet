<?php
	//Logout Page
	
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 
	
	//Starting session
	session_start();
	
	//Get Last URL
	if (!isset($_SESSION['new_link'])) 
	{
		$url = "index.php";
	}
	elseif (isset($_SESSION['new_link'])) 
	{
		$url = $_SESSION['new_link'];			
	}
	else 
	{
		$url = $_GET['url'];
	}
	
	$firstname = $_SESSION['firstname'];
	$user = $_SESSION['username'];
	$cat = $_SESSION['cat'];
	session_destroy();
	
	// Redirect to Index Page
	$msg='<script type="text/javascript">alert("Your Successfully Logged Out, Thank you for visiting '.$firstname.'");</script>';
	session_start();
	$_SESSION['error'] = $msg;
	$_SESSION['cat'] = $cat;
	//Redirect back to URL 
	header( 'refresh: 0; url='.$url);
?>

