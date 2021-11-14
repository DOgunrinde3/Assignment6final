<?php
session_start();

//$voted = $_SESSION["voted"] = "true";
$error = "";
$email = $_SESSION['email'];
$class = 'background-color: grey;';
//$sumbitted = false;
//echo $class;

$db = new mysqli("localhost", "doo945", "Amazo142", "doo945");
if ($db->connect_error)
{
    die ("Connection failed: " . $db->connect_error);
}

$q = "SELECT Questions.question_id , Questions.user_id, Questions.question, Questions.created_dt, Questions.answered, Users.img_url, Users.username, Users.email
  FROM Users LEFT JOIN Questions ON(Questions.user_id = Users.user_id) 
  ORDER BY Questions.created_dt DESC LIMIT 10";

  $result = $db->query($q);
  $row = $result->fetch_assoc();


       
        
        
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

<?php 


?>


<!DOCTYPE html>
<html>
    
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
</div>
        <section class="question" style="background-color: green;">
     <h2 class="pages">Asked Questions:</h2>
 
    <div style="border: 1px solid black; padding: 10px; background-color: white; margin-bottom: 10px; border-radius: 40px;">  
          <?php
       if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { 
                
            $questionid2 = $row["question_id"];
            //$userid2 = $row["user_id"];

            echo"$questionid2";


        if (isset($_POST["submitted"]) && $_POST["submitted"])
    {
    //$class = 'background-color: grey;';

            $db = new mysqli("localhost", "doo945", "fake11", "doo945");
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

            $q3 = "SELECT user_id FROM Upvotes WHERE user_id = '$user_id' AND question_id = '$questionid2'";
            //echo $q1;
                $r3 = $db->query($q3);

            if($r3->num_rows == 0)
            {
                $q4 = "INSERT INTO Upvotes (question_id, user_id, upvote_dt) VALUES ('$questionid2', '$user_id', '$upvote_dt')";
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
                $q5 = "SELECT upvote_id FROM Upvotes WHERE user_id = '$user_id'";
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
            <div style="border: 1px solid black; padding: 30px; background-color: linen; margin-bottom: 10px; border-radius: 40px;"  >
            
                <table style="padding-bottom: 20px;">
                    <tr>
                        <td style="border: 1px solid black; text-align: center; border-radius: 50px; box-shadow: 0px 1px 2px black; padding: 30px;"><img src="<?=$row["img_url"]?>" style="width: 100px; padding-bottom: 5px; border-radius: 40px;"> </br> <a href="user.html"><?=$row["email"]?></a></td>
                        <td class="answering"><p style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-size: 15px; color: black; font-weight: 600;"><?=$row["question"]?></p></td> 
                    <?php 
                    if(isset($_SESSION["email"]))
                        { 
                            //echo $voted;
                    
                            echo "<div style='float: right; padding-top: 30px;'>
                    
                            <form id='vote' action='QuestionsList.php' method='post'> 
                            <input type='hidden' name='submitted' value='1'/>

                            <input type='submit' value='Vote'>"; 
                            
                            if($voted == true) { echo "style='$class'>
                            
                            </form>
                    
                    
                    
                            </div>";
                            }

                            
                        }
                    
                    ?>
                    </tr>
           
                </table>
            </div>

                <div class='row' style='border: 0px solid white'>
                <div style='float: right; padding-top: 10px;'>

            
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


                        $q7 = "SELECT user_id FROM Questions WHERE question_id = '$questionid2'";
                        //echo $q1;
                            $r7 = $db->query($q7);
                        if($r7->num_rows > 0)
                        {
                            while($row = $r7->fetch_assoc()) {
                                $Quser_id = $row["user_id"];
                            
                            }
                        }

                    
                    
                            if($user_id == $Quser_id )
                                { 
                                    //echo $question_id;
                            
                                    echo"
                                    
                                    <form id='mark' action='QuestionsList.php' method='post' >
                                    <input type='hidden' name='markas' value='2'/>
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
        
    }

    
      ?>

    </section>
   
</body>
</div>


  </html>
