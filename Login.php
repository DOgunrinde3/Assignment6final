<?php

$validate = true;
$reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
$reg_Pswd = "/^(\S*)?\d+(\S*)?$/";

$email = "";
$error = "";

if (isset($_POST["submitted"]) && $_POST["submitted"])
{
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    
    $db = new mysqli("localhost", "doo945", "Amazo142", "doo945");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
    }

    $q = "SELECT * FROM Users WHERE email = '$email' AND password = '$password'";
    // start with $q = 
       
    $r = $db->query($q);
    $row = $r->fetch_assoc();
    if($email != $row["email"] && $password != $row["password"])
    {
        $validate = false;
        echo "Email or Password is incorrect";
    }
    else
    {
        $emailMatch = preg_match($reg_Email, $email);
        if($email == null || $email == "" || $emailMatch == false)
        {
            $validate = false;
            echo "Email or Password is incorrect";
        }
        
        $pswdLen = strlen($password);
        $passwordMatch = preg_match($reg_Pswd, $password);
        if($password == null || $password == "" || $pswdLen < 8 || $passwordMatch == false)
        {
            $validate = false;
            echo "Email or Password is incorrect";
        }
    }
    
    if($validate == true)
    {

        session_start();
        $_SESSION["email"] = $row["email"];
        header("Location: QuestionsList.php");
        $db->close();
        exit();
    }
    else 
    {
        $error = "The email/password combination was incorrect. Login failed.";
        $db->close();
    }
}
?>

<!DOCTYPE html>
<html>
  <script type="text/javascript" src="loginvalidating_signup.js"></script>
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
     <h2 style="color: green; font-size: 30px;">Please Log in</h2>

     <form id="formLogin" action="Login.php" method="post">
<input type="hidden" name="submitted" value="1"/>
<table>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td>Email</td>

</tr>
<tr>
<td id="emailMsg"></td>
<td id="pswdMsg"></td>
</tr>
<td><input type="text" id="email" name="email" value=""/></td>
</tr>
<tr>
<td>Password</td>
</tr>
<tr>
<td><input type="password" id="password" name="password"/></td>
</tr>
<td><input type="submit" value="Login"/></td>
</tr>

<tr>
<td>No account? <a href="Signup.php">Sign up</a></td>
</tr>
</table>
</form>

  <script type="text/javascript" src="signupr4.js"></script>

</section>  


</body>

  </html>
