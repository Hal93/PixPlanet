/*
	//Name: Dean O Halloran
	//Version: 1.1
	//Decemeber 2014
	//Image Sharing Web Application 
*/

//Registration Validation
function ValidateRegisterForm() 
{
	var username =  document.RegisterForm.username;
	var email = document.RegisterForm.email;
	var password = document.RegisterForm.password;
	var emailExpression = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

	if (username.value == "")
	{
		window.alert("Please enter your Username.");
		username.focus();
		return false;
	}
    
	if (email.value == "") 
	{
		window.alert("Please enter a valid e-mail address.");
		email.focus();
		return false;
	}
	
	if(!email.value.match(emailExpression )){ 
		alert("Please enter valid Email Address");
		email.focus();
		return false;					
	}

	if (password.value == "") 
	{
		window.alert("Please provide a Password.");
		password.focus();
		return false;
	}
						
		return true;
}
			
			
//Validate User Login Form Function
function ValidateLoginForm() 
{
	var username =  document.LoginForm.username;
	var password = document.LoginForm.password;

	if (username.value == "") 
	{
		window.alert("Please enter your Username.");
		username.focus();
		return false;
	}

	if (password.value == "") 
	{
		window.alert("Please provide your Password.");
		password.focus();
		return false;
	}
		return true;
}
			
//Validate CommentsForm Function
function ValidateCommentForm() 
{
	var moviecomments = document.CommentsForm.moviecomments;

	if (moviecomments.value == "") 
	{
		window.alert("Please enter a Comment Please.");
		moviecomments.focus();
		return false;
	}
		return true;
}
			
//Validate SearchForm Function
function ValidateSearchForm() 
{
	var searchquery = document.searchform.searchquery;

	if (searchquery.value == "")
	{
		window.alert("Please enter a Search Value Please.");
		searchquery.focus();
		return false;
	}
		return true;
}	