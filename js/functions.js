/*
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 
*/

//Hover For the Stars To Light Up
function hoverchk() 
{
	var imgstar = document.getElementsByClassName('imgstar');
	for (i=0;i<imgstar.length;i++) 
	{
		var elems = document.getElementById(imgstar[i].id);
		elems.src = "images/star/"+"starOff.png";
		elems.onmouseover = btnMouseOver;
		elems.onmouseout = btnMouseOut;
		
		//OnMouseOver Function When hover over stars
		function btnMouseOver() 
		{
			var starOn = document.getElementById(this.id);
			if (starOn.id == "img1") 
			{
				starOn.src = "images/star/"+"starOver.png";
			}
			if (starOn.id == "img2") 
			{
				starOn.src = "images/star/"+"starOver.png";
				document.getElementById('img1').src = "images/star/"+"starOver.png";
			}		
			if (starOn.id == "img3") 
			{
				starOn.src = "images/star/"+"starOver.png";
				document.getElementById('img1').src = "images/star/"+"starOver.png";
				document.getElementById('img2').src = "images/star/"+"starOver.png";				
			}			
			if (starOn.id == "img4") 
			{
				starOn.src = "images/star/"+"starOver.png";
				document.getElementById('img1').src = "images/star/"+"starOver.png";
				document.getElementById('img2').src = "images/star/"+"starOver.png";
				document.getElementById('img3').src = "images/star/"+"starOver.png";				
			}			
		
			if (starOn.id == "img5") 
			{
				starOn.src = "images/star/"+"starOver.png";
				document.getElementById('img1').src = "images/star/"+"starOver.png";
				document.getElementById('img2').src = "images/star/"+"starOver.png";
				document.getElementById('img3').src = "images/star/"+"starOver.png";				
				document.getElementById('img4').src = "images/star/"+"starOver.png";
			}			
		}

		//OnMouseOut Function When hover away from stars
		function btnMouseOut() 
		{
			var starOn = document.getElementById(this.id);
			if (starOn.id == "img1") 
			{
				starOn.src = "images/star/"+"starOff.png";
			}
			if (starOn.id == "img2") 
			{
				starOn.src = "images/star/"+"starOff.png";
				document.getElementById('img1').src = "images/star/"+"starOff.png";
			}		
			if (starOn.id == "img3") 
			{
				starOn.src = "images/star/"+"starOff.png";
				document.getElementById('img1').src = "images/star/"+"starOff.png";
				document.getElementById('img2').src = "images/star/"+"starOff.png";				
			}			
			if (starOn.id == "img4") 
			{
				starOn.src = "images/star/"+"starOff.png";
				document.getElementById('img1').src = "images/star/"+"starOff.png";
				document.getElementById('img2').src = "images/star/"+"starOff.png";
				document.getElementById('img3').src = "images/star/"+"starOff.png";				
			}			
		
			if (starOn.id == "img5")
			{
				starOn.src = "images/star/"+"starOff.png";
				document.getElementById('img1').src = "images/star/"+"starOff.png";
				document.getElementById('img2').src = "images/star/"+"starOff.png";
				document.getElementById('img3').src = "images/star/"+"starOff.png";				
				document.getElementById('img4').src = "images/star/"+"starOff.png";
			}			
		}		
	}
}


//Ajax Function to send ratings to php and display the star rating
function starratings(elem)
{
	if (window.XMLHttpRequest) 
	{
		//Firefox, Opera, IE7, and other browsers will use the native object
		var x = new XMLHttpRequest();
	} 
	else 
	{
		//IE 5 and 6 will use the ActiveX control
		var x = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	var url = "send_rating.php";
	var el = document.getElementById(elem).value;
	var vid = document.getElementById('picid').value;
	var user_id = document.getElementById('userid').value;	
	var vtype = document.getElementById('vtype').value;	
	var sendinfo = "starchoice="+el+"&picid="+vid+"&userid="+user_id+"&type="+vtype;
	x.open("POST", url, true);
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	x.onreadystatechange = function() 
	{
		if (x.readyState == 4 && x.status == 200) 
		{
			var request_data = x.responseText;
			document.getElementById("displaystatus").innerHTML = request_data;
			staravgresults();
		}
	}

    // Send the data to PHP now... and wait for response to update the status div
    x.send(sendinfo); // Actually execute the request
	document.getElementById("displaystatus").src = "<img src='images/loading/ajax-loader.gif'/>";
}

//Ajax Function to call and display the star average and Current Ratings
function staravgresults()
{
	if (window.XMLHttpRequest) 
	{
		//Firefox, Opera, IE7, and other browsers will use the native object
		var h = new XMLHttpRequest();
	} 
	else 
	{
		//IE 5 and 6 will use the ActiveX control
		var h = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	var url = "getratingresults.php";
	var vid = document.getElementById('picid').value;	
	var senddata = "vid="+vid;
	h.open("POST", url, true);
	h.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	h.onreadystatechange = function() 
	{
		if (h.readyState == 4 && h.status == 200) 
		{
			var s = document.getElementById('CurrentStars');
			r = h.responseText;
			
			if (r == "0")
			{
				s.src = "images/star/emptystars.png";
			}
			if (r == "1")
			{
				s.src = "images/star/1star.png";
			}
			if (r == "2")
			{
				s.src = "images/star/2stars.png";
			}
			if (r == "3")
			{
				s.src = "images/star/3stars.png";
			}
			if (r == "4")
			{
				s.src = "images/star/4stars.png";
			}
			if (r == "5")
			{
				s.src = "images/star/5stars.png";
			}			
		}
	}

    // Send the data to PHP now... and wait for response to update the status div
    h.send(senddata); // Actually execute the request
	document.getElementById("CurrentStars").src = "<img src='images/loading/ajax-loader.gif'/>";
}

//Get Search Query Parameters from url in address bar
function GetAddressURLParameters(paraName)
{
    var url = window.location.search.substring(1);
    var urlsearchpart = url.split('&');
    for (var i = 0; i < urlsearchpart.length; i++)
    {
        var params = urlsearchpart[i].split('=');
        if (params[0] == paraName)
        {
            return params[1];
        }
    }
}

//Ajax Function to send category selection to php and display the dvds in that category
function sendcat(elms)
{
	if (window.XMLHttpRequest) 
	{
		//Firefox, Opera, IE7, and other browsers will use the native object
		var k = new XMLHttpRequest();
	} 
	else 
	{
		//IE 5 and 6 will use the ActiveX control
		var k = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var cattype = document.getElementById('cattype').value;
	if (cattype != "") {
		var cat = cattype;
	}
	else
	{
		var cat = GetAddressURLParameters('cat');
	}
	
	var url = "send_cat.php?catchoice="+elms+"&cattype="+cat;
	k.open("GET", url, true);
	k.onreadystatechange = function() 
	{
		if (k.readyState == 4 && k.status == 200) 
		{
			if (cat=="movie")
			{
				document.title = "Movies";
			}
			else if (cat=="tvshow")
			{
				document.title = "TV Shows";
			}
			document.getElementById('cattype').value = cat;
			document.getElementById("rightcol").innerHTML = k.responseText;
		}
	}
	
    // Send the data to PHP now... and wait for response to update the status div
    k.send(null); // Actually execute the request
	document.getElementById("rightcol").src = "<img src='images/loading/ajax-loader.gif'/>";
}