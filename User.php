<?php
session_start();

//$voted = $_SESSION["voted"] = "true";
$error = "";
$email = $_SESSION['email'];

//$sumbitted = false;
//echo $class;
if (isset($_POST["userpage"]) && $_POST["userpage"])
{
    $db = new mysqli("localhost", "doo945", "Amazo142", "doo945");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
    }

    $realuserid = $_POST["userid"];



$q20 = "SELECT Questions.question_id , Questions.user_id, Questions.question, Questions.created_dt, Questions.answered, Users.img_url, Users.DOB, Users.username, Users.email, Count(Upvotes.upvote_id) AS vote_count  
  FROM Users LEFT JOIN Questions ON(Questions.user_id = Users.user_id) LEFT JOIN Upvotes ON(Upvotes.question_id = Questions.question_id) WHERE Users.user_id = $realuserid GROUP BY Questions.question_id 
  ORDER BY vote_count DESC, Questions.created_dt DESC LIMIT 10"; 

$result = $db->query($q20);
  
$result2 = $db->query($q20);
  $row2 = $result2->fetch_assoc();

    //$color = $row["answered"];

}




?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="sysstyling.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <header class="grid" style="color: goldenrod;">
    <title>User Detail </title>
    <div class="user">
    <h2 id="username">Username: <?=$row2["username"]?></h2>
    <h3 id="username">Email: <?=$row2["email"]?></h3>
    <h3>Date Of Birth: <?=$row2["DOB"]?></h3>
</div>

<div class="userimg">
<img src="<?=$row2["img_url"]?>" id="userimg">
</div>

</header>

<div class="grid">
<body class="user">

<a href='QuestionsList.php'>All Questions</a><br>
<a href='Logout.php'>Logout</a><br>
 
    <section class="question" style="background-color: green;">
    
 <h2 class="pages">Posted Questions:</h2>
 <div>
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
            $email = $_SESSION['email'];

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
            <div style="border: 1px solid black; padding: 30px; background-color:<?=$backclass?> margin-bottom: 10px; border-radius: 40px;"  >
            
                <table style="padding-bottom: 20px;">
                    <tr>
                        <td style="border: 1px solid black; text-align: center; border-radius: 50px; box-shadow: 0px 1px 2px black; padding: 20px;">
                        
                        
                        
                        <img src="<?=$row["img_url"]?>" style="width: 250px; padding-bottom: 5px; border-radius: 30px;"> 
                        
                        
                        </br> 
                        
                        <form id='user' action='User.php' method='post'> 
                            <input type='hidden' name='userpage' value='1'/>
                            <input type='hidden' name='userid' value='<?=$userid2?>'/>
                            <input type='submit' value='<?=$row["email"]?>'> 

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
                           $upvotes = $row["vote_count"];
                            echo "<div style='float: right; padding-top: 30px;'>
                    
                            <form id='vote' action='QuestionsList.php' method='post'> 
                            <input type='hidden' name='submitted value='1'/>
                            <input type='hidden' name='questionid' value='$questionid2'/>

                            <input type='submit' value='Vote'> 
                            
                            
                            
                            </form>
                            <p style='font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-size: 15px; color: blue; font-weight: 800;'>Number of Upvotes: $upvotes</p>
                    
                    
                            </div>";
                            

                            
                        }
                    
                    ?>

                   
                    </tr>
           
                </table>
            </div>

                <div class='row' style='border: 0px solid white'>
                <div style='float: right; padding-top: 10px;'>

            
                    <?php 

                    if (isset($_POST["markas"]) && $_POST["markas"])
                    {
                    //$class = 'background-color: grey;';


                            $db = new mysqli("localhost", "doo945", "Amazo142", "doo945");
                            if ($db->connect_error)
                            {
                                die ("Connection failed: " . $db->connect_error);
                            }

                            $questionid4 = $_POST["questionid2"];
                            $color = $_POST["color"];

                            $q16 = "UPDATE Questions SET answered = true WHERE question_id = '$questionid4' ";
                            //echo $q1;
                                $r16 = $db->query($q16);
                                if ($r16 === true)
                                    {   
                                        header("Refresh:0");
                                        $db->close();
                                        exit();
                                        
                                    }

                            
                                    

                        }

                
                    
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
                            
                                    echo"
                                    
                                    <form id='mark' action='QuestionsList.php' method='post' >
                                    <input type='hidden' name='markas' value='1'/>
                                    <input type='hidden' name='questionid2' value='$questionid2'/>
                                    <input type='hidden' name='color' value='grey'/>
                                    <input type='submit' value='Mark Answered'>
                                    
                                    </form>

                                    ";

                                    

                                }

                           
                        
                                ?>

                </div>
                
       <table>
        <tr>
            <h3>Answer User:</h3>
            <textarea id="answer" name="answer" rows="8" cols="100" ></textarea> 
           </div>
           
        </tr>

        <div style="padding-bottom: 10px;"><button type="button">Post Answer</button></div>

 </table>

    </div>

    <?php



        }
        

    
      ?>
 </div>
</section>

</body>
</div>

  </html>

 