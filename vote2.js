function vote(e) {
    // create a variable we need to send to our PHP file
    var questionid = e.target.id.split("_")[1];
    console.log("vote for: " + questionid);
    //create XMLHttpRequest object
    var xmlhttp = new XMLHttpRequest();



    // access the onreadystatechange event for the XMLHttpRequest object
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            var counter = document.getElementById("counter_"+questionid);
            var results = JSON.parse(this.responseText);

            
          //console.log(results);
            if (results.length > 0)
            {
                //alert("I worked!");
                for (var i = 0; i < results.length; i++) {
                counter.innerHTML= "Number of Upvotes: " + results[i].vote_count;
                }

                //alert(results[0].vote_count);
                
            } 

            

            
        }


    }
    //Do this line to prepare a GET
    xmlhttp.open("GET", "Upvotes.php?questionid=" + encodeURIComponent(questionid), true);
    
    //Do these three lines to prepare a POST
    //xmlhttp.open("POST", "QuestionsList.php", true);
   // xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //xmlhttp.send("q="+ letter);
        
    //Do this to actually execute the either type of request
    xmlhttp.send(null);

} //send_ajax_request() function




