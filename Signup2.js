function ValidSignup(event)
{
	var emailInput = document.getElementById("email").value;
	var pswdInput = document.getElementById("pwrd").value;
	var BdayInput = document.getElementById("date").value;
	var UnameInput = document.getElementById("uname").value;
	var imgInput = document.getElementById("fileToUpload2").value;
	
	var emailMsg = document.getElementById("email_S");
	var pswdMsg = document.getElementById("pswd_S");
	var BdayMsg = document.getElementById("date_S");
	var UnameMsg = document.getElementById("user_S");
	var imgMsg = document.getElementById("img_S");
	
	
	emailMsg.innerHTML = "";
	pswdMsg.innerHTML = ""; 
	BdayMsg.innerHTML = "";
	UnameMsg.innerHTML = "";
	imgMsg.innerHTML = "";
	
	var emailCheck = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
	var pswdCheck = /^(\S*)?\d+(\S*)?$/;
	var BdayCheck = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
	//var UnameCheck = /^[-\w\.]{3,30}$/;
	
	var checkResult = true;
	
	if(emailInput == null || emailInput == "" || !emailCheck.test(emailInput))
	{
		emailMsg.innerHTML = "Please enter valid email.";
		checkResult = false;
	}
	
	if(pswdInput == null || pswdInput == "" || pswdInput.length < 8 || !pswdCheck.test(pswdInput))
	{
		pswdMsg.innerHTML = "Password must be at least 8 characters.";
		checkResult = false;
	}

	if(UnameInput == null || UnameInput == "" || UnameInput.length > 30 )
	{
		UnameMsg.innerHTML = "Username is invalid";
		checkResult = false;
	}
	
	if(!BdayCheck.test(BdayInput))
	{
		BdayMsg.innerHTML = "Invalid date."
		checkResult = false;
	}

	if(imgInput == null || imgInput == "" )
	{
		imgMsg.innerHTML = "Img can't be empty";
		checkResult = false;
	}


	
	if(checkResult == false)
	{
		event.preventDefault();
	}
}