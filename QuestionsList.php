<?php
session_start();

//$voted = $_SESSION["voted"] = "true";
$error = "";
$email = $_SESSION['email'];

//$sumbitted = false;
//echo $class;

$db = new mysqli("localhost", "doo945", "Amazo142", "doo945");
if ($db->connect_error)
{
    die ("Connection failed: " . $db->connect_error);
}


$q = "SELECT Questions.question_id , Questions.user_id, Questions.question, Questions.created_dt, Questions.answered, Users.img_url, Users.username, Users.email, Count(Upvotes.upvote_id) AS vote_count  
  FROM Users LEFT JOIN Questions ON(Questions.user_id = Users.user_id) LEFT JOIN Upvotes ON(Upvotes.question_id = Questions.question_id) GROUP BY Questions.question_id
  ORDER BY vote_count DESC, Questions.created_dt DESC LIMIT 10";
//Questions.created_dt
  $result = $db->query($q);
  //$row = $result->fetch_assoc();

    //$color = $row["answered"];

    


       
        
        
        // $q9 = "UPDATE Questions SET answered = true WHERE question_id = '2'";
        // //echo $q1;
        //     $r9 = $db->query($q9);
        //     if ($r9 == true)
        //     {
        //         //$class = 'background-color: grey;';
        //         header("test.php");
        //         $db->close();
        //         exit();
        //     }
        
      



?>


<!DOCTYPE html>
<html>
<script type="text/javascript" src="vote2.js"></script>

<script type="text/javascript" src="mark2.js"></script>
<script type="text/javascript" src="refresh1.js"></script>
     
    <link rel="stylesheet" href="sysstyling.css" type="text/css">
  <header class="login">
    <title>In-Class Q&A System: Login</title>
    
    
    <div class="urlogo">
        <img src="logo.svg" id="urimage">

    </div>
    <div class="login">
    <h1 class="login">Welcome to the In-Class Q&A System</h1>
    </div>

    <div class="loginimg">
        <img src="296-2967608_q-a-icon-answer-symbol.png" id="userimg">
    </div>
</header>
<div class="grid">
    <body class="user" style="background-color: rgba(169, 169, 169, 0.199);">
        <div>
        <form action="">
            <label for="sort">Sort By:</label>
            <select name="sort" id="sort">
              <option value="votes">Up-Votes</option>
            </select>
          
            <button type="button" onclick="location.href='Post.php'" style="float: right; background-color: goldenrod; font-size: 20px;">Post Question</button>

        </form>
        <a href='Logout.php'>Logout</a><br>
</div>
        <section class="question" style="background-color: green;">
     <h2 class="pages">Asked Questions:</h2>
 
    <div style="border: 1px solid black; padding: 10px; background-color: white; margin-bottom: 10px; border-radius: 40px;">  
          <?php
        while ($row = $result->fetch_assoc()) { 
           
            

            $color = $row["answered"];

            if ($color == false)
            {
                $backclass = 'linen;';

            }

            else if ($color == true)
            {
                $backclass = 'lightgrey;';

            }
                
            $questionid2 = $row["question_id"];
            $userid2 = $row["user_id"];


            


        if (isset($_POST["submitted"]) && $_POST["submitted"])
    {
    //$class = 'background-color: grey;';


            $db = new mysqli("localhost", "doo945", "Amazo142", "doo945");
            if ($db->connect_error)
            {
                die ("Connection failed: " . $db->connect_error);
            }

            $q11 = "SELECT user_id FROM Users WHERE email = '$email'";
            //echo $q1;
                $r11 = $db->query($q11);
            if($r11->num_rows > 0)
            {
                while($row = $r11->fetch_assoc()) {
                    $user_id = $row["user_id"];
                
                }
            }

            
            $upvote_dt = date_create('now')->format('Y-m-d H:i:s'); 

            $realquestionid = $_POST["questionid"];

            $q3 = "SELECT user_id FROM Upvotes WHERE user_id = '$user_id' AND question_id = $realquestionid";
            //echo $q1;
                $r3 = $db->query($q3);

            if($r3->num_rows == 0)
            {
                $q4 = "INSERT INTO Upvotes (question_id, user_id, upvote_dt) VALUES ('$realquestionid', '$user_id', '$upvote_dt')";
            //echo $q1;
                $r4 = $db->query($q4);
                
                if ($r4 === true)
                {
                    //$class = 'background-color: grey;';
                    header("Refresh:0");
                    $voted = true;
                    $db->close();
                    exit();
                }

                

            }


            else if($r3->num_rows != 0)
            {
                $q5 = "SELECT upvote_id FROM Upvotes WHERE user_id = '$user_id' AND question_id = $realquestionid" ;
                //echo $q1;
                    $r5 = $db->query($q5);
                
                if($r5->num_rows > 0)
                {
                    while($row = $r5->fetch_assoc()) {
                        $upvote_id = $row["upvote_id"];
                    
                    }
                }

                $q6 = "DELETE FROM Upvotes WHERE upvote_id = '$upvote_id'";
            //echo $q1;
                $r6 = $db->query($q6);
                
                if ($r6 === true)
                {
                    header("Refresh:0");
                    $db->close();
                    exit();
                }

                //$class = "unsubmitted";

            }

        }

      
                 
            ?>
            <div id="back_<?=$row["question_id"]?>"style="border: 1px solid black; padding: 30px; background-color:<?=$backclass?>; margin-bottom: 10px; border-radius: 40px;"  >
            
                <table style="padding-bottom: 20px;">
                    <tr>
                        <td style="border: 1px solid black; text-align: center; border-radius: 50px; box-shadow: 0px 1px 2px black; padding: 20px;">
                        
                        
                        
                        <img src="<?=$row["img_url"]?>" style="width: 250px; padding-bottom: 5px; border-radius: 30px;"> 
                        
                        
                        </br> 
                        
                        <form id='user' action='User.php' method='post'> 
                            <input type='hidden' name='userpage' value='1'/>
                            <input type='hidden' name='userid' value='<?=$userid2?>'/>
                            <input type='submit' value='<?=$row["username"]?>'> 

                        </form>
                        
                        
                        </td>
                        <td class="answering">
                        <p style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-size: 20px; color: black; font-weight: 600;"><?=$row["question"]?></p>
                        <p style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-size: 15px; color: blue; font-weight: 800;">Posted On: <?=$row["created_dt"]?></p>
                        
                        </td> 
                    <?php 
                    if(isset($_SESSION["email"]))
                        { 
                            //echo $voted;
                            //question_$Question_id
                           $upvotes = $row["vote_count"];
                           $Question_id = $row['question_id'];
                            echo "<div style='float: right; padding-top: 30px;'>
                    
                            <button id='question_$Question_id' class='votebutton' style='width:100%;'> VOTE </button>

                            <p id='counter_$Question_id' style='font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-size: 15px; color: blue; font-weight: 800;'>Number of Upvotes: $upvotes</p>
                    
                    
                            </div>";
                            

                            
                        }

                        
                    
                    ?>

<?php 




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
        
        }
    }

    $q14 = "SELECT answered FROM Questions WHERE question_id = '$questionid2'";
    //echo $q1;
        $r14 = $db->query($q14);
    if($r14->num_rows > 0)
    {
        while($row = $r14->fetch_assoc()) {
            $answered = $row["answered"];
        
        }
    }



    $q7 = "SELECT user_id FROM Questions WHERE question_id = '$questionid2'";
    //echo $q1;
        $r7 = $db->query($q7);
    if($r7->num_rows > 0)
    {
        while($row = $r7->fetch_assoc()) {
            $Quser_id = $row["user_id"];
        
        }
    }

    

        if($user_id == $Quser_id && $answered == false)
            { 
                //$backclass = 'linen;';
                //echo $question_id;
               // $Question_id2 = $row['question_id'];
        
                echo"
                <div style='float: right; padding-top: 30px; margin-right: 10px'>
                <button id='q_$Question_id' class='markbutton' style='width:100%;'> Mark Answered </button>

                </div>
                ";

                

            }

       
    
            ?>

                   
                    </tr>
           
                </table>
            
                
       <table>
       

 </table>

    </div>

    <?php



        }
        

    
      ?>

<h2 id="title" style="visibility:hidden;">Recently Asked Questions:</h2>

<div id="recent" style="border: 1px solid black; padding: 10px; background-color: linen; margin-bottom: 10px; border-radius: 40px; visibility:hidden;"> 
<button style='width:30%; background-color: blue; 'onClick="window.location.reload()">Click to Refresh</button>
<table style="padding-bottom: 20px;">

                    
<tr>
                        
    <td style="border: 1px solid black; text-align: center; border-radius: 50px; box-shadow: 0px 1px 2px black;">
                        
                       
                        <img id="recentimg" style="width: 250px; padding-bottom: 5px; border-radius: 30px; padding-top: 10px;"> 
                        <button id='recentuname'></button>

    </td>                  
   
    
                        <td class="answering">
                        <p id="recentq"style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-size: 20px; color: black; font-weight: 600;"></p>
                        <p id="recentdate"style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-size: 15px; color: blue; font-weight: 800;">Posted on: </p>
                        
                        </td>    

                        <?php 
                    if(isset($_SESSION["email"]))
                        { 
                            //echo $voted;
                            //question_$Question_id
                
                            echo "<div style='float: right; padding-top: 30px;'>
                    
                            <button id='recentvote' class='votebutton' style='width:80%;'> VOTE </button>

                            <p id='recentvotecount' style='font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-size: 15px; color: blue; font-weight: 800;'>Number of Upvotes: 0 </p>
                    
                    
                            </div>";
                            

                            
                        }

                        
                    
                    ?>
            
                        <tr>

                     </table>  

                  

</div>

    </section>
    
   
</body>
</div>

<script type="text/javascript" src="vote-r2.js"></script>  
<script type="text/javascript" src="mark-r2.js"></script>  
  </html>


  