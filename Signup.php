<?php
$validate = true;
$error = "";
$reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
$reg_Pswd = "/^(\S*)?\d+(\S*)?$/";
$reg_Bday = "/^\d{1,2}\/\d{1,2}\/\d{4}$/";
$email = "";
$date = "mm/dd/yyyy";




if (isset($_POST["submitted"]) && $_POST["submitted"])
{

    
    $email = trim($_POST["email"]);
    $date = trim($_POST["date"]);
    $uname = trim($_POST["uname"]);
    $password = trim($_POST["pwrd"]);
    
    
   
       
    $db = new mysqli("localhost", "doo945", "Amazo142", "doo945");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
    }
    
    $q1 = "SELECT * FROM Users WHERE email = '$email'";
    $r1 = $db->query($q1);

    // if the email address is already taken.
    if($r1->num_rows > 0)
    {
        $validate = false;
    }
    else
    {
        $emailMatch = preg_match($reg_Email, $email);
        if($email == null || $email == "" || $emailMatch == false)
        {
            $validate = false;
        }

              
        $pswdLen = strlen($password);
        $pswdMatch = preg_match($reg_Pswd, $password);
        if($password == null || $password == "" || $pswdLen< 8 || $pswdMatch == false)
        {
            $validate = false;
        }

        $bdayMatch = preg_match($reg_Bday, $date);
        if($date == null || $date == "" || $bdayMatch == false)
        {
            $validate = false;
        }


    }

    

    if($validate == true)
    {  

        $dateFormat = date("Y-m-d", strtotime($date));
        $target_dir = "uploads2/";
        $target_file = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
        move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], "uploads2");
        
            if (move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file)) {
              echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload2"]["name"])). " has been uploaded.";
            } else {
              echo "Sorry, there was an error uploading your file.";
            }
            
        
        //$img_url = "<img src='$target_file' style='width: 300px;' /> "; 
        //add code here to insert a record into the table User;
        // table User attributes are: email, password, DOB
        // variables in the form are: email, password, dateFormat, 
        // start with $q2 =

        //$uname = 'Username';

        $img_url = "<img src='$target_file' style='width: 300px;' /> ";

        //echo basename($_FILES["fileToUpload"]["name"]);
        $q2 = "INSERT INTO Users (email, username, password, DOB, img_url) VALUES ('$email', '$uname', '$password', '$dateFormat', '$target_file')";

        //$q2 = "INSERT INTO User (email, password, DOB, username) VALUES ('$email', '$password', '$dateFormat')";
       
        $r2 = $db->query($q2);
        
        if ($r2 === true)
        {
            header("Location: Login.php");
            $db->close();
            exit();
        }
    }
    else
    {
        $error = "email address is not available. Signup failed.";
      
        $db->close();
    }

}


?>

<!DOCTYPE html>
<html>
<script type="text/javascript" src="Signup2.js"></script>
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


  <body>
    <section class="login">
        <h2 style="color: green; font-size: 30px;">Q&A Sign up</h2>
        <form id="formSignup" action="Signup.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="submitted" value="1"/>
<table>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td id="email_S"></td>
</tr>
<tr>
<td>Email:</td>
<td><input type="text" id="email" name="email" value=""/></td>
</tr>
<tr>
<td></td>
<td id="user_S"></td>
</tr>
<tr>
<td>Username:</td>
<td><input type="text" id="uname" name="uname" value=""/></td>
</tr>
<tr>
<td></td>
<td id="pswd_S"></td>
</tr>
<tr>
<td>Password:</td>
<td><input type="password" id="pwrd" name="pwrd"/></td>
</tr>
<td></td>
<td id="date_S"></td>
</tr>
<tr>
<td>Birthday:</td>
<td><input type="text" id="date" name="date" value="mm/dd/yyyy"/></td>
</tr>

<tr>
<td></td>
<td id="img_S"></td>
</tr>
<tr><td>Photo: </td><td> <input type="file" name="fileToUpload2" id="fileToUpload2"></td></tr>


<tr>
<td></td>
<td><input type="submit" value="Sign up"/></td>
</tr>
</table>
<tr>
<td>Already got an account? <a href="Login.php">Log in</a></td>
</tr>
</form>
        
</section>
<script type="text/javascript" src="SignupR1.js"></script>
   </body>


  </html>


