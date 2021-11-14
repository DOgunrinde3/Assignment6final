<?php
session_start();
$validate = true;
$error = "";
$email = $_SESSION['email'];



if (isset($_POST["submitted"]) && $_POST["submitted"])
{

    
    $question = trim($_POST["question"]);
    //echo $question;
    //$user_id = .$_SESSION['uname'].
     
    $db = new mysqli("localhost", "doo945", "Amazo142", "doo945");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
    }


    
    $q1 = "SELECT user_id FROM Users WHERE email = '$email'";
    //echo $q1;
    $r1 = $db->query($q1);

    if($r1->num_rows > 0)
    {
        while($row = $r1->fetch_assoc()) {
            $user_id = $row["user_id"];
            //echo "user_id: " . $row["user_id"]. "<br>";
          }
    }
    //$user_id = $row["user_id"];
    //echo $r1;

   // echo $user_id;


    
  
    if($validate == true)
    {  

       $created_dt = date_create('now')->format('Y-m-d H:i:s'); 
       $answered = 'False';
       //$user_id = .$_SESSION['uname'].
        
        $q2 = "INSERT INTO Questions (user_id, question, created_dt, answered) VALUES ('$user_id', '$question', '$created_dt', '$answered')";

        //$q2 = "INSERT INTO User (email, password, DOB, test_id) VALUES ('$email', '$answered', '$created_dt', $user_id)";
       
        $r2 = $db->query($q2);
        
        if ($r2 === true)
        {
            header("Location: QuestionsList.php");
            $db->close();
            exit();
        }
    }
    else
    {
        $error = "There was an error, you Question could not be posted";
      
        $db->close();
    }

}

?>
<?php

		  
	//If nobody is logged in, display login and signup page.
	if(isset($_SESSION["email"]))
	{ 

        
	  	//If somebody is logged in, display a welcome message
          echo "<!DOCTYPE html>
          <html>
          <script type='text/javascript' src='postq2.js'></script>
            <link rel='stylesheet' href='sysstyling.css' type='text/css'>
            <header class='login'>
              <title>In-Class Q&A System: Post Questions</title>  
              <div class='urlogo'>
                  <img src='logo.svg' id='urimage'>
          
              </div>
              <div class='login'>
              <h1 class='login'>Post your Questions to the In-Class Q&A System</h1>
              </div>
          
              <div class='loginimg'>
                  <img src='296-2967608_q-a-icon-answer-symbol.png' id='userimg'>
              </div>
          </header>";
          
          echo "<h2> Welcome, you are logged in as:  " .$_SESSION['email']. " </h2><br/>" ;	
          echo "<body>
          <section class='login'>
          
              <h2 style='color: green; font-size: 30px;'>Post your Question </h2>
              <form id='post' action='Post.php' method='post' >
              <input type='hidden' name='submitted' value='1'/>
                
                <tr>
                  <td><label id='msg_post' class='err_msg'></label></td>
                </tr></br>
      
                <label style='float: left; margin-right: 5px;'for='question'>What would you like to ask?: <span></br>(30 words or less)</span></label>
            
                <textarea id='question' name='question' rows='8' cols='50'></textarea> <br></br>
      
                <p> Word Count:
                  <span id='show'>0</span>
              </p> <br></br>
                
                <input type='submit' value='Post Question'>
          
            </form>
    
            <script type='text/javascript' src='postq-r.js'></script>
          
          </section>

        <aside class='back'>
          <h2 style='font-size: 40px;'>Pages:</h2>
        
          <a href='Logout.php'>Logout</a><br>
        <a href='QuestionsList.php'>All Questions</a><br>

              
        
        </aside>
   </body>
   </html>";
	
    
   

   
	}



	else
	{	
		echo "<!DOCTYPE html>
        <html>
          <link rel='stylesheet' href='sysstyling.css' type='text/css'>
          <header class='login'>
            <title>In-Class Q&A System: Post Questions</title>  
            <div class='urlogo'>
                <img src='logo.svg' id='urimage'>
        
            </div>
            <div class='login'>
            <h1 class='login'>Post your Questions to the In-Class Q&A System</h1>
            </div>
        
            <div class='loginimg'>
                <img src='296-2967608_q-a-icon-answer-symbol.png' id='userimg'>
            </div>
        </header>
        </html>";
        echo "<h2>You aren't Logged in, Please Login or Signup Below</h2>";
		echo "<a href='Login.php'>Login</a> <a href='Signup.php'>Signup</a>";	
				
	}
?>