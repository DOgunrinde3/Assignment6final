function PostForm(event) {

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
    var post = elements[0].value; //Question

    var msg_post = document.getElementById("msg_post");
    var counter = countWord();

    msg_post.innerHTML  = "";

  
  
    //Variables for DOM Manipulation commands
    var textNode;
    var htmlNode;
  
  
    // if email is left empty or email format is wrong, add an error message to the matching cell.
    if (post == null || post == "") {
      textNode = document.createTextNode("Question Field cannot be left Empty");
      msg_post.appendChild(textNode);
      valid = false;
    } 
   
    else if (countWord() == true) {
      textNode = document.createTextNode("Maximum is 30 words.");
      msg_post.appendChild(textNode);
      valid = false;
    }

  
    // TODO: complete the next section based on the comments below
    // Provide feedback in "display_info" div at the bottom of the page

    if (valid == true) {
      //send a form reset event to clear the form
    document.getElementById("SignUp").reset(); 
  
    }
    else if (valid == false) {
      event.preventDefault(); // Normally, this is where this command should be
  
    }

  
  }

  function countWord() {
  
    // Get the input text value
    var words = document.getElementById("question").value;

    var max = false;

    // Initialize the word counter
    var count = 0;

    // Split the words on each
    // space character 
    var split = words.split(' ');

    // Loop through the words and 
    // increase the counter when 
    // each split word is not empty
    for (var i = 0; i < split.length; i++) {
        if (split[i] != "") {
            count += 1;
        }
    }

    // Display it as output
    document.getElementById("show")
        .innerHTML = count;

     if (count > 30)
        {
            return max = true;
        }
  
        return max;
}
