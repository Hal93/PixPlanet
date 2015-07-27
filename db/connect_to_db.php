<?php
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 
	
	//MySQLI Database Connection
	//Host Connection for the MySQLI database
	$db_host = "localhost"; 
	//Username for the MySQLI database 
	$db_username = "root";  
	//Password for the MySQLI database
	$db_pass = "";  
	//Name for the MySQLI database
	$db_name = "library"; 

	//Run the MySQLI Database Connection with php variables  
	$conn = mysqli_connect($db_host,$db_username,$db_pass) or die ("could not connect to the mysql server");
	//Connect to selected MySQLI database
	mysqli_select_db($conn,$db_name) or die ("no database");  
?>