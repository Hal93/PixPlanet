<?php
	//Names:Dean O Halloran 
	//Version: 1.1
	//December 2014
	//Image Sharing Web Application 
	
	//Starting session
	session_start();
	
	//Get request type e.g. Update, delete, etc
	$type = $_REQUEST['type'];
	
	//Get Last URL
	$newurl = $_REQUEST['newurl'];
	
	//Get Last URL before Edit Page or Member page
	$url = $_REQUEST['url'];
	
	//Set msg variable
	$msg = '<script type="text/javascript">alert("';	
	
	//Edit Member Details
	if ($type == "useredit") 
	{
		if(isset($_POST['submit'])) 
		{
			//Get ID Value
			;
			$id = $_REQUEST['id'];
			$fname = $_POST['fname'];
			$fname = trim($fname);
			$lname = $_POST['lname'];
			$lname = trim($lname);			
			$username = $_POST['username'];
			$email = $_POST['email'];	
			$email = trim($email);			
			
			//Connect To Database
			include ('db/connect_to_db.php');
			
			$update = mysqli_query($conn,"UPDATE members SET firstname = '".$fname."', lastname = '".$lname."', username = '".$username."', email = '".$email."' 
			WHERE userid = '".$id."'") or die(mysqli_error($conn));
			
			if ($update) 
			{			
				$msg .= $username.'s were Successfully Updated';
				$msg .='");</script>';				
				$_SESSION['error'] = $msg;
				//Redirect back to URL 
				header( 'refresh: 0; url='.$url);
			}
			else 
			{
				$msg .= $username.'s Records were not Updated, Try Again';
				$msg .='");</script>';			
				$_SESSION['error'] = $msg;
				//Redirect back to URL
				header( 'refresh: 0; url='.$newurl);		
			}				
		}	
	}
	
	//Delete Member Details	
	elseif ($type == "userdelete") 
	{
		//Get ID Value
		$id = $_REQUEST['id'];	
		$username = $_GET['username'];
		$old_user = $username;
		
		//Connect To Database
		include ('db/connect_to_db.php');
		
		$deletequery = mysqli_query($conn,"DELETE FROM members WHERE userid = '".$id."'") or die(mysqli_error($conn));  
		
		if ($deletequery) 
		{	
			$msg .= $old_user.' was Successfully Deleted';
			$msg .='");</script>';			
			$_SESSION['error'] = $msg;
			//Redirect back to URL
			header( 'refresh: 0; url='.$url);
		}
		else 
		{
			$msg .='Deletion was Unsuccessful Deleted';
			$msg .='");</script>';			
			$_SESSION['error'] = $msg;
			//Redirect back to URL
			header( 'refresh: 0; url='.$newurl);
		}					
	}	

	//Add New Image	
	elseif ($type == "newimage") 
	{
		if(isset($_POST['submit'])) 
		{
			//Connect To Database
			include ('db/connect_to_db.php');
			//Configuration - Your Options
			$file_types_permitted = array('.jpg','.gif','.bmp','.png'); // These will be the types of file and will be checked.
			//New Thumb Sizes
			$modwidth="160";
			$modheight="240";
			
			$filename = $_FILES['image']['name']; // Get the name of the file (including file extension).
			$filetype = $_FILES['image']['type']; // Get the type of the file (including file extension).
			
			if (!get_magic_quotes_gpc()) 
			{
				//$_POST variables			
				$title = addslashes($_POST['title']);		
				$category = addslashes($_POST['category']);
				$plot = addslashes($_POST['plot']);	
			} 
			else 
			{
				$title = $_POST['title'];
				$cateory = $_POST['category'];
				$plot = $_POST['plot'];				
			}
			
			//$_POST variables			
			$title = trim($title);				
			//Replace any item in array with a dash	
			$newtitle = str_replace(array(' ', ',', '-', '!','/','\',|'), '_', $title);
			//Replace any item in array with a dash
			
			
			$category = trim($category);	
			
			$plot = mysqli_escape_string($conn, $plot);		
			
				
			//Get Extension of File
			$extension = substr($filename, strpos($filename,'.'), strlen($filename)-1); // Get the file extension from the current filename.
			
			//Set Upload Directory Path (including sub Directoties)
			$upload_path = './pictures/'.$newtitle.'/'; // The place the files will be uploaded to (a directory).
	
			//Check if the filetype is allowed, if not DIE and inform the user.
			if(!in_array($extension,$file_types_permitted)) 
			{
				die('The file you are trying to upload is not allowed, Not right file type.');
			}
			
			else 
			{
				//Check if the file path can be written to
				if(!is_writable($upload_path))
				{
					//Make New Sub Directory and set Permissions
					mkdir($upload_path,0777);
				}

				//Upload the file to your upload path.
				if(move_uploaded_file($_FILES['image']['tmp_name'],$upload_path . $filename)) 
				{
					$oldfilename = $upload_path.$filename;
					$newfilename = $upload_path.$newtitle.$extension;
					
					$changedfile = $newtitle.$extension;
					$filename = $changedfile;
					rename($oldfilename, $newfilename);
					
					//Let's set the thumbnail
					$thumb = "tb_".$filename;
				
					//Create a new image from file
					$sourceimg = imagecreatefromjpeg($upload_path.$filename);
					//Finds X and Y of File
					$width = imagesx($sourceimg);
					$height = imagesy($sourceimg);
  
					//Create a new true color image
					$destination = imagecreatetruecolor($modwidth, $modheight);
  
					//Creates a Copy of source file and saves to new destination file
					imagecopyresampled($destination, $sourceimg, 0, 0, 0, 0, $modwidth, $modheight, $width, $height);
  
					//create the thumbnail image to the destination
					imagejpeg($destination, $upload_path.$thumb);
					
					//Destroying Images Created and freeing up any memory associated with images
					imagedestroy($sourceimg);
					imagedestroy($destination);
					
					//Insert variables to table in database
					$insert = mysqli_query($conn,"INSERT INTO picture(title, fullimage, upload_path, ext, category, thumb, plot, date_added) VALUES
					('".$title."','".$filename."','".$upload_path."','".$extension."',
					'".$category."','".$thumb."','".$plot."', NOW())") or die(mysqli_error($conn)); 
					
					//Get Last Inserted Id
					$lastid = mysqli_insert_id($conn);
					//Store Last Inserted Id in lastmovieid variable
					$lastmovieid = $lastid;
					
					$msg .='File Successfully Uploaded and '.$title.' is Successfully Added \n';
					$msg .='");</script>';
					$_SESSION['error'] = $msg;
					//Redirect back to URL
					header( 'refresh: 0; url='.$url);
				} 
				else 
				{
					$msg .='There was an error during the file upload And a problem occurred  with '.$title.'. Please try again \n';
					$msg .='");</script>';					
					$_SESSION['error'] = $msg;
					//Redirect back to URL
					header( 'refresh: 0; url='.$newurl);
				}
			}		
		}		
	}
	
	//Add New Member		
	elseif ($type == "register") 
	{
		
		if(isset($_POST['submit'])) 
		{
			//Connect To Database
			include ('db/connect_to_db.php');		
			$result = mysqli_query($conn,"SELECT * FROM members WHERE username = '".$_POST['username']."'") or die(mysqli_error($conn)); 
			$numcount = mysqli_num_rows($result);
			if ($numcount > 0) 
			{
				$msg .= $_POST['username'].' Already Exists Try another one';
				$msg .='");</script>';				
				$_SESSION['error'] = $msg;
				//Redirect back to URL
				header( 'refresh: 0; url='.$newurl);
				
			}
			elseif ($numcount == 0) 
			{
		    	$username = $_POST['username'];
				$username = trim($username);				
				$fname = $_POST['fname'];
				$fname = trim($fname);				
				$lname = $_POST['lname'];
				$lname = trim($lname);				
				$password = $_POST['password'];
				$hashpassword = md5($password);
				$email = $_POST['email'];
				$email = trim($email);				
			
				//Insert variables to table in databasse			
				$register = mysqli_query($conn,"INSERT INTO members (firstname, lastname, username, password, email, date_added) VALUES 
				('".$fname."','".$lname."','".$username."','".$hashpassword."','".$email."',NOW())") or die ("Error in query: '".$register."'") 
				or die(mysqli_error($conn));  
			
				if ($register) 
				{			
					$msg .= $username.' was Successfully Registered';
					$msg .='");</script>';				
					$_SESSION['error'] = $msg;
					//Redirect back to URL
					header( 'refresh: 0; url='.$url);
				}
				else 
				{
					$msg .='Problem occurred  when adding '.$username.'. Please try again';
					$msg .='");</script>';				
					$_SESSION['error'] = $msg;
					//Redirect back to URL
					header( 'refresh: 0; url='.$newurl);
				}
			}
		}			
	}
	
	//Add New Comment	
	elseif ($type == "newcomment") 
	{
		if (isset($_POST['submit']))
		{
			//Store Inputted Values in Variables 
			$comment = $_POST['comments'];
			$username = $_POST['username'];
			$picid = $_REQUEST['vid'];
			
			//Connect To Database
			include ('db/connect_to_db.php');
			
			//Add user information into the database table, Put the values into the column row 
			$insert = mysqli_query ($conn,"INSERT INTO usercomments (picid, username, date_added, commenttext) VALUES
			('".$picid."', '".$username."', now(), '".$comment."')") or die(mysqli_error($conn));  

			//If Function to check if the SQL Command was sucessful
			if ($insert) 
			{			
				$msg .= $username.'s Comment was Successfully Added';
				$msg .='");</script>';				
				$_SESSION['error'] = $msg;
				//Redirect back to URL
				header( 'refresh: 0; url='.$url);
			}
			else 
			{
				$msg .='Error occurred  when adding Comment';
				$msg .='");</script>';				
				$_SESSION['error'] = $msg;
				//Redirect back to URL
				header( 'refresh: 0; url='.$url);
			}		
		}
	}
	
	//Edit Image Details
	elseif ($type == "productedit") 
	{		

		if(isset($_POST['submit'])) 
		{
			//Connect To Database
			include ('db/connect_to_db.php');
			
			//Get pictureID value	
			$picid = $_POST['vid'];		
			$title = $_POST["title"];
			$title = trim($title);			
			//Replace any item in array with a dash	
			$newtitle = str_replace(array(' ', ',', '-', '!','/','\',|'), '_', $title);	
			//Replace any item in array with a dash	
			
			$category = $_POST["category"];
			$category = trim($category);			
			
			$plot = mysqli_escape_string($conn, $_POST["plot"]);				
				
			$result = mysqli_query($conn,"SELECT * FROM picture WHERE pictureID = '".$picid."'") or die(mysqli_error($conn)); 
			while($row = mysqli_fetch_array($result))
			{ 
				$fullimage = $row["fullimage"];	
				$thumb = $row["thumb"];	
			}	
			
			$oldfolder = $_POST["oldfolder"];
			$newupload_path = './pictures/'.$newtitle.'/'; //The New Upload Folder
			
			//Set File Paths
			$filename = $oldfolder.$fullimage;
			$thumbnail = $oldfolder.$thumb;
			
			//Get the Filename without the path location or extension
			$file_name = pathinfo($filename, PATHINFO_FILENAME);	
			
			//Get the Filename extension without the path location or filename
			$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

			//Get the Filename without the path location or extension			
			$thumb_name = pathinfo($thumbnail, PATHINFO_FILENAME);	
			
			//Get the Filename extension without the path location or filename			
			$thumb_ext = pathinfo($thumbnail, PATHINFO_EXTENSION);			
			
			//Set New Filename
			$fullimagefile = $newtitle.".".$file_ext;
			
			//Set New Thumbnail name
			$thumbfile = "tb_".$newtitle.".".$thumb_ext;
			
			$oldfilename = $filename;
			$newfilename = $oldfolder.$fullimagefile;
			
			$oldthumb = $thumbnail;
			$newthumb = $oldfolder.$thumbfile;			
					
			if ($oldfolder != $newupload_path) 
			{
				if ($file_name != $newtitle)
				{
					//Rename files (old file, new file)
					rename($oldfilename, $newfilename);		
					rename($oldthumb, $newthumb);						
				}
				
				//Rename file folder (old folder, new folder)
				rename($oldfolder, $newupload_path );
				$uploadpath = $newupload_path;
				$thumbnail_image = $thumbfile;
				$filename_image = $fullimagefile;
			}		
			else 
			{
				$uploadpath = $oldfolder;
				$thumbnail_image = $thumb;
				$filename_image = $fullimage;
			}
			
			$update = mysqli_query($conn,"UPDATE picture SET title = '".$title."', category = '".$category."', 
			 plot = '".$plot."', upload_path = '".$uploadpath."', fullimage = '".$filename_image."', 
			thumb = '".$thumbnail_image."'  WHERE pictureID = '".$picid."'") or die(mysqli_error($conn)); 
			
			if ($update)
			{				
				$msg .= ' was Successfully Updated \n';
				$msg .='");</script>';					
				$_SESSION['error'] = $msg;
				//Redirect back to URL
				header( 'refresh: 0; url='.$url);
			}
			else 
			{
				$msg .= ' Failed Updated \n';
				$msg .='");</script>';					
				$_SESSION['error'] = $msg;
				//Redirect back to URL
				header( 'refresh: 0; url='.$newurl);		
			}			
		}
	}
	
	//Delete Product Details		
	elseif ($type == "productdelete")
	{
		//Connect To Database
		include ('db/connect_to_db.php');	
		
		//Get pictureID value	
		$picid = $_REQUEST['vid'];	
		$title = $_GET['title'];
		//Search the Database to check to see if the product in the database column matches the select product
		$vidsql = mysqli_query($conn,"SELECT * FROM picture WHERE pictureID = '".$picid."'") or die(mysqli_error($conn)); 
		while($row = mysqli_fetch_array($vidsql))
		{ 	
			$vidtitle = $row["title"];
			$fullimage = $row["fullimage"];	
			$upload_path = $row["upload_path"];	
			$thumb = $row["thumb"];	
		}
		
		$thumb_path = $upload_path.$thumb;
		$full_path = $upload_path.$fullimage;
		
		$oldTitle = $vidtitle;
		
		//Delete Files and Folders from Directory
		unlink($thumb_path);
		unlink($full_path);
		rmdir($upload_path);

		$deletequery = mysqli_query($conn,"DELETE FROM picture WHERE pictureID = '".$picid."'") or die(mysqli_error($conn));

		if ($deletequery) 
		{
			$msg .= $oldTitle.' was Successfully Deleted \n';
			$msg .='");</script>';				
			$_SESSION['error'] = $msg;
			//Redirect back to URL
			header( 'Location: index.php');
		}
		else
		{
			$msg .='Deletion was Unsuccessful';
			$msg .='");</script>';				
			$_SESSION['error'] = $msg;
			//Redirect back to URL
			header( 'refresh: 0; url='.$url);
		}			
	}	
	
	//Add Product to Collection	
	elseif ($type == "addcollection") 
	{
		//Connect To Database
		include ('db/connect_to_db.php');	
		//Get pictureID value	
		$picid = $_REQUEST['vid'];	
		$id = $_REQUEST['id'];			
		$title = $_REQUEST['title'];
		
		//Add user information into the database table, Put the values into the column row 
		$insert = mysqli_query($conn,"INSERT INTO usercollection (pictureID, userid, date_added) VALUES
		('".$picid."', '".$id."', NOW())") or die(mysqli_error($conn));

		//If Function to check if the SQL Command was sucessful
		if ($insert) 
		{
			$msg .= $title.' was Successfully Added';
			$msg .='");</script>';				
			$_SESSION['error'] = $msg;
			//Redirect back to URL
			header('refresh: 0; url='.$url);
		}
		else 
		{
			$msg .= $title.' was Unsuccessful Added';
			$msg .='");</script>';				
			$_SESSION['error'] = $msg;
			//Redirect back to URL
			header('refresh: 0; url='.$url);
		}		
	}
	
	//Remove Product from Collection		
	elseif ($type == "removecollection") 
	{
		//Connect To Database
		include ('db/connect_to_db.php');	
		//Get pictureID value	
		$picid = $_REQUEST['vid'];	
		$title = $_GET['title'];
		$deletequery = mysqli_query($conn,"DELETE FROM usercollection WHERE pictureID = '".$picid."'") or die(mysqli_error($conn)); 
		if ($deletequery) 
		{
			$msg .= $title.' was Successfully Removed';
			$msg .='");</script>';				
			$_SESSION['error'] = $msg;
			//Redirect back to URL
			header( 'refresh: 0; url='.$url);
		}
		else 
		{
			$msg .= $title.' could not be Removed, Try Again';
			$msg .='");</script>';				
			$_SESSION['error'] = $msg;
			//Redirect back to URL
			header( 'refresh: 0; url='.$url);
		}		
	}
	
	//Remove multiple Product from Collection		
	elseif ($type == "editusercollection") 
	{
		//Connect To Database
		include ('db/connect_to_db.php');	
		//Get pictureID value	
		$deletebtn = $_REQUEST['deletebtn'];	
		
		foreach ($deletebtn as $delbtn) 
		{
			$result = mysqli_query($conn,"SELECT * FROM picture WHERE pictureID = '".$delbtn."'") or die(mysqli_error($conn));
			while($trow = mysqli_fetch_array($result))
			{ 
				$title = $trow["title"];		
			}
				$oldtitle = $title;
			
			$deletequery = mysqli_query($conn,"DELETE FROM usercollection WHERE pictureID = '".$delbtn."'") or die(mysqli_error($conn));
			if ($deletequery) 
			{
				$msg .= $oldtitle.' was Successfully Removed';
			}
			else 
			{
				$msg .= $oldtitle.' could not be Removed, Try Again';
			}
		}				
		
		$msg .='");</script>';				
		$_SESSION['error'] = $msg;
		//Redirect back to URL
		header( 'refresh: 0; url='.$newurl);
	}
	//Close Connection to Database

	mysqli_close($conn);

?>