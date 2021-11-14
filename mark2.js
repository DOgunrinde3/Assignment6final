function mark(e) {
    // create a variable we need to send to our PHP file
    var questionid2 = e.target.id.split("_")[1];
    console.log("mark for: " + questionid2);
    //create XMLHttpRequest object
    var xmlhttp = new XMLHttpRequest();

    // access the onreadystatechange event for the XMLHttpRequest object
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
          // var buttonclicked = document.getElementById("q_"+questionid);
           var result2 = JSON.parse(this.responseText);
            var setbackground = document.getElementById("back_"+questionid2);
            var button = document.getElementById("q_"+questionid2);
            if (result2.length > 0)
            {
                for (var i = 0; i < result2.length; i++) {
                   
                        setbackground.style.backgroundColor = "lightgrey";
                        button.style.visibility = "hidden";
                        //alert("shit answered cuh");
                    

                   
                    }
    

            }

          
            
        }


    }
    //Do this line to prepare a GET
    xmlhttp.open("GET", "Markas.php?questionid=" + encodeURIComponent(questionid2), true);
    
    //Do these three lines to prepare a POST
    //xmlhttp.open("POST", "QuestionsList.php", true);
   // xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //xmlhttp.send("q="+ letter);
        
    //Do this to actually execute the either type of request
    xmlhttp.send(null);

} //send_ajax_request() function