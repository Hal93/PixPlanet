<?php
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 
?>	
	<!-- Search Box External File -->
	<div id="searchwrapper"><!-- Opening of searchwrapper-->
		<form method="GET" name="searchform" action="search.php" onsubmit="return ValidateSearchForm();">
			<input type="text" name="searchquery" id="searchquery" />
			<input type="submit" name="search" value="" class="searchbox_submit"/>
		</form>
	</div><!-- Closing of searchwrapper-->