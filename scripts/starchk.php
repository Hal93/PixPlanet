<?php
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 
	
	//If there is a user logged In
	if (isset($_SESSION['id'])) 
	{
		//Display Stars and change when hover over
		?>
		<div class="rating-block">
			<h3>New Rating</h3>
			<input type="image" class="imgstar" id="img1" src="images/starOff.png" alt="starImages" onmouseover="hoverchk(this.id);" onmouseout="hoverchk(this.id);"
			value="1" onclick="starratings('1');">
			<input type="hidden" name="stars" id="1" value="1" />
			<input type="image" class="imgstar" id="img2" src="images/starOff.png" alt="starImages" onmouseover="hoverchk(this.id);" onmouseout="hoverchk(this.id);"
			value="2" onclick="starratings('2');">
			<input type="hidden" name="stars" id="2" value="2" />	
			<input type="image" class="imgstar" id="img3" src="images/starOff.png" alt="starImages" onmouseover="hoverchk(this.id);" onmouseout="hoverchk(this.id);"
			value="3" onclick="starratings('3');">
			<input type="hidden" name="stars" id="3" value="3" />	
			<input type="image" class="imgstar" id="img4" src="images/starOff.png" alt="starImages" onmouseover="hoverchk(this.id);" onmouseout="hoverchk(this.id);"
			value="4" onclick="starratings('4');">
			<input type="hidden" name="stars" id="4" value="4" />
			<input type="image" class="imgstar" id="img5" src="images/starOff.png" alt="starImages" onmouseover="hoverchk(this.id);" onmouseout="hoverchk(this.id);"
			value="5" onclick="starratings('5');">
			<input type="hidden" name="stars" id="5" value="5" />		
 
			<div id="displaystatus"></div>
		</div>	
		<?php
	}
	//Else Ask user to log in
	else 
	{
		echo "<h2>Please Log In To Rate</h2>"; 
	}
?>