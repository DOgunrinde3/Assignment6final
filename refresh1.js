setInterval(updateQuestions, 9000);
var lastUpdate = Date.now();

function updateQuestions(e){

    var xmlhttp = new XMLHttpRequest();

    // access the onreadystatechange event for the XMLHttpRequest object
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            var results = JSON.parse(this.responseText);
            
            var div = document.getElementById("recent");
            var title = document.getElementById("title");
            var img = document.getElementById("recentimg");
            var uname = document.getElementById("recentuname");
            var question = document.getElementById("recentq");
            var date = document.getElementById("recentdate");
            var voteid = document.getElementById("recentvote");
            var votecount = document.getElementById("recentvotecount");
            //var newdiv = document.getElementById("newdiv");

          //votecount.innerHTML = "";

 
            
            //console.log(voteid);
            
            
            // try parsing AJAX response text as JSON
           
    
    
            if (results.length > 0 ) {
              

                lastUpdate = Date.now();

                for (var i = 0; i < results.length; i++) {

                    //console.log(results.length);
                
                newrecent = results[i];
             
                div.style.visibility = "visible";
                title.style.visibility = "visible";
                img.src = newrecent.img_url;
               
                
                
                recentquestion = document.createTextNode(newrecent.question);
                recentdate = document.createTextNode(newrecent.created_dt);
                question.appendChild(recentquestion);
                uname.innerHTML = newrecent.username;
                date.appendChild(recentdate);
                voteid.id = "question_"+newrecent.question_id;
                votecount.id = "counter_"+newrecent.question_id; 

                
                
                //console.log(voteid.id);

                }

    
                
                // Make some reusable variables
                
                    //TODO: add code to display password and birthday fields
                }

                if (results == 0 ) {
                    lastUpdate = Date.now();
                    div.style.visibility = "hidden";
                    //div.innerHTML="";
                   //div.remove();
                    

                }

             //endif processing sql results
            //handle 0 results
          
            
        }


    }
    //Do this line to prepare a GET
    xmlhttp.open("GET", "Refresh.php?lastdt=" + encodeURIComponent(lastUpdate), true);
    
    //Do these three lines to prepare a POST
    //xmlhttp.open("POST", "QuestionsList.php", true);
   // xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //xmlhttp.send("q="+ letter);
        
    //Do this to actually execute the either type of request
    xmlhttp.send(null);

} //send_ajax_request() function