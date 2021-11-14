/*
 * Lab6 validate.js 
 *
 * Contains:
 *  - SignUpForm: submit event handler / form validator 
 *  - ResetForm: reset event handler / form resetter
 * 
 * Read Carefully and watch for //TODO: comments
 */


// Lab 6 SignUpForm Validator Event Handler
//
// This sample event handler function should validate all 4 input fields,  
//    ie. (Email, Username, Password, Confirm Password)
// at once as elements of event.currentTarget, which is provided by the 
// submit event. 
//
// Follow the TODO: instructions to complete the following:
//  - get field values from the form for all fields
//  - get a reference to and reset all error message cells
//  - complete validation of username, password and confirm password
//  - provide feedback in error message cells and in display_info div
//  
//
// OR: you can implement individual functions to validate each input field after
// they are changed or receive input by modifying the "DOM2
// Event Registration" example in Lab 5:
// https://www.cs.uregina.ca/Links/class-info/215/js_dom/index.html#dom2 
// In such a solution, each input field would get its own change function. For
// example, checkEmail(), checkUsername(), checkPswd(), checkMatchPswd() You
// will still need a submit() event to check that flags for all fields are OK,
// to provide feedback in display_info div and to use event.preventDefault to
// avoid reloading the page.
// 

function SignUpForm(event) {

    // Prevent default event action. 
    // Normally only called if a form does not validate. We put it here so you can
    // see the feedback in the display_info div when the page validates.
    // For a submitted form the default action is to send form data to the URI in the 
    // form's action="" attribute. If a form has no action, the page will reload,
    // clearing the form and removing any DOM modified elements.
    
  
    //Assume the form is valid; set to false if any validation tests fail.
    var valid = true;
    
    // TODO: Get field values for all form fields
    var elements = event.currentTarget;
    var email = elements[0].value; //Email
    var uname = elements[1].value; //Username
    var pswrd = elements[2].value;//Password
    var cpswrd = elements[3].value;//Confirm Password
  
    // javascript regular expressions (jre) to validate email, username and password
    // TODO: you may wish to change these to better match exercise requirements
    var regex_email = /\S+@\S+\.\S+/;
    var regex_uname = /^[-\w\.]{3,30}$/;
    var regex_pswd  = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;
  
  
    // Empty error message cells have been added to the table above the email, 
    // username, password and confirm password fields styled with red text color   
    // TODO: Get references to all error message cells and make sure they are empty before validating
    var msg_email = document.getElementById("msg_email");
    var msg_uname = document.getElementById("msg_uname");
    var msg_pswd = document.getElementById("msg_pswd");
    var msg_pswdr = document.getElementById("msg_pswdr");
    var msg_img = document.getElementById("msg_img");
    var msg_date = document.getElementById("msg_date");
    var valueDate = document.getElementById('birthday').value;
    msg_email.innerHTML  = "";
    msg_uname.innerHTML = "";
    msg_pswd.innerHTML = "";
    msg_pswdr.innerHTML = "";
    msg_img.innerHTML = "";
    msg_date.innerHTML = "";
  
  
  
    //Variables for DOM Manipulation commands
    var textNode;
    var htmlNode;
  
  
    // if email is left empty or email format is wrong, add an error message to the matching cell.
    if (email == null || email == "") {
      textNode = document.createTextNode("Email address empty.");
      msg_email.appendChild(textNode);
      valid = false;
    } 
    else if (regex_email.test(email) == false) {
      textNode = document.createTextNode("Email address wrong format. example: username@somewhere.sth");
      msg_email.appendChild(textNode);
      valid = false;
    }

    else if (email.length > 60) {
      textNode = document.createTextNode("Email address too long. Maximum is 60 characters.");
      msg_email.appendChild(textNode);
      valid = false;
    }
  
    // TODO: add code to complete validation of username 
    //     - don't forget regex or length requirements from lab 5
  if (uname == null || uname == "") {
      textNode = document.createTextNode("Username is empty.");
      msg_uname.appendChild(textNode);
      valid = false;
  
    }
   
  else if (uname.length > 40) {
        textNode = document.createTextNode("Username too long. Maximum is 40 characters.");
        msg_uname.appendChild(textNode);
        valid = false;
    }

  else if (uname.length < 3) {
      textNode = document.createTextNode("Username too short. Minimum is 3 characters.");
      msg_uname.appendChild(textNode);
      valid = false;
  }
 
  else if (regex_uname.test(uname) == false) {
      textNode = document.createTextNode("Username is invalid, make sure it does no contain strange symbols or have extra spaces anywhere ");
      msg_uname.appendChild(textNode);
      valid = false;
    }





    //Password

    if (pswrd == null || pswrd == "") {
        textNode = document.createTextNode("Password is empty.");
        msg_pswd.appendChild(textNode);
        valid = false;
      }

    else if (pswrd.length = 6) {
        if (regex_pswd.test(pswrd) == false) {
        textNode = document.createTextNode("Password must contain letters and atleast one digit ");
        msg_pswd.appendChild(textNode);
        valid = false;
    }
      }

    //Confirm password

    if (cpswrd == null || cpswrd == "") {
        textNode = document.createTextNode("Confirm Password is empty.");
        msg_pswdr.appendChild(textNode);
        valid = false;
      }
    else if (cpswrd != pswrd) {
          textNode = document.createTextNode("Passwords dont match");
          msg_pswdr.appendChild(textNode);
          valid = false;
      }

      //image

    if( document.getElementById("avatarimg").files.length == 0 ){
      textNode = document.createTextNode("You must insert an image/graphic");
      msg_img.appendChild(textNode);
      valid = false;
    }

    //Date

   
    if ( valueDate== null || valueDate== '')
  
    {
    textNode = document.createTextNode("You must select your birthdate");
    msg_date.appendChild(textNode);
    valid = false;
 
  }
  
  
  
    // TODO: add code to validate password - don't forget regex and length requirements
  
  
  
    // TODO: add code to confirm password - must match password
  
  
  
    // TODO: complete the next section based on the comments below
    // Provide feedback in "display_info" div at the bottom of the page
    var display_info = document.getElementById("display_info");
    display_info.innerHTML = "";
    if (valid == true) {
      //Set green text color indicated everything is OK
      display_info.style.color = "green"; // Style Method 1: manipulate style directly
      
      //Add validated contents of form to the display_info div
      htmlNode = document.createElement("br");
      display_info.appendChild(htmlNode);
      textNode = document.createTextNode("Email: " + email);
      display_info.appendChild(textNode);
      htmlNode = document.createElement("br");
      display_info.appendChild(htmlNode);
      textNode = document.createTextNode("Username: " + uname);
      display_info.appendChild(textNode);
      htmlNode = document.createElement("br");
      display_info.appendChild(htmlNode);
      textNode = document.createTextNode("Password: " + pswrd);
      display_info.appendChild(textNode);
      htmlNode = document.createElement("br");
      display_info.appendChild(htmlNode);
      textNode = document.createTextNode("Confirm Password: " + cpswrd);
      display_info.appendChild(textNode);
      htmlNode = document.createElement("br");
      display_info.appendChild(htmlNode);
      
     
      //send a form reset event to clear the form
    document.getElementById("SignUp").reset(); 
  
    }
    else if (valid == false) {
      event.preventDefault(); // Normally, this is where this command should be
  
      // If the form is not valid, display an "Invalid Data Entered" message and set red text color
      textNode = document.createTextNode("Invalid Data Entered");
      display_info.appendChild(textNode);
      display_info.setAttribute("style", "color: red"); // Style Method 2: manipulate HTML attribute
  
    }
  
  }
