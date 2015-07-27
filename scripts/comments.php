<?php
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 

	//Comments External File
	
	//Connect To Database
	include ('db/connect_to_db.php');

	//Search the Database to check to see if the movie in the database column matches the select movie and order it by descending order
	$query = mysqli_query($conn,"SELECT * FROM usercomments WHERE picid = '".$picid."' ORDER BY date_added DESC ");
	$num_check = mysqli_num_rows($query);		
	//print Out on the screen a div tag with the comments header
	?>
	<div id='commenthead'><h3>Comments</h3></div><br>
	<?php
	//if numrow is equal to 0
	if ($num_check == 0 || $num_check == "") 
	{		
		//print Out on the screen a div tag with the list of comments for the movie
		?>
		<div id='usercomments'><h4>No Comments have been Found</h4></div>
		<?php
	} 
	else 
	{
		while($row = mysqli_fetch_array($query))
		{ 			
			//Get columns from database from store in variables
			$username = $row["username"];
			$date = $row["date_added"];
			$commenttext = $row["commenttext"];	
							
			//Echo Usercomments Div Tag Opening
			echo "<div id='usercomments'>";
			//Echo comment-rating Div Tag Opening
			echo "<div id='comment-rating'>";
			//Use echo to print out ratings and username and date
			echo "<span>".$username."</span> Posted on <span> ".date('d-m-Y', strtotime($date))."<br>";
			//Echo comment-rating Div Tag Closing
			echo "</div><br/>";
			//Echo maincomment Div Tag Opening
			echo "<div id='maincomment'>";
			// echo to Comment H4
			echo "<h4>Comment</h4>";
			//Echo to print out Comment
			echo "".$commenttext."<br>";
			//Echo maincomment Div Tag Closing
			echo "</div><br/>";
			//Echo Usercomments Div Tag Closing
			echo "</div><br/>";
		}				
	}
	
	mysqli_close($conn);	
	
	// Check If user is logged in
	//If Session ID is Set
	if (isset($_SESSION['id'])) 
	{
	
		$commentform = "newcomment";
		$new_url = "";
		?>	
		<a name="comment"></a><!-- Comments Form Achor Tag --> 
		<div id="commentform"><!-- Opening Commentform Div -->
			<!-- Opening CommentsForm Form -->
			<form method="post" action="image_status.php" name="CommentsForm" onsubmit="return ValidateCommentForm();">
				<label for="comments">Comment:</label><br/>
				<textarea name="comments" rows="20" cols="20"></textarea><br />
				<input type="hidden" name="vid" value="<?php echo $picid; ?>" />
				<input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>" />
				<input type="hidden" name="type" value="<?php echo $commentform; ?>" />
				<input type="hidden" name="url" value="<?php echo $url; ?>" />
				<input type="hidden" name="newurl" value="<?php echo $new_url; ?>" />			
				<input type="submit" name="submit" value="Post" class="submit-button" />
			</form><!-- End of CommentsForm Form -->
		</div><!-- Closing Commentform Div -->
		<br />

		<?php
	}
	//Else Session ID is  not Set
	else 
	{
		?>
		<!-- Check if Logged In-->
		<div class="error-comment">
			<h3>Login To Add Comment</h3><br />
			<p>You must be logged in to write a comment</p>
		</div>
		<?php
	} 
?>