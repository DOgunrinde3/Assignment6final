<?php
session_start();
$email = $_SESSION['email'];
//echo $email;
$upvote_dt = date_create('now')->format('Y-m-d H:i:s'); 
	//TODO: Create a connection to your database using a mysqli object
	// - notice we are using object oriented style
	// - see example 1 here: https://www.php.net/manual/en/mysqli.construct.php
	// - see also lab 11: https://www.cs.uregina.ca/Links/class-info/215/php_mysql/index.html#dbconnection
	$db = new mysqli("localhost", "doo945", "Amazo142", "doo945");
	
	if ($db -> connect_error) {
	   die ("Connection failed: " . $db -> connect_error);
	}

	$q = $_GET['questionid'];

    $q11 = "SELECT user_id FROM Users WHERE email = '$email'";
    //echo $q1;
        $r11 = $db->query($q11);
    if($r11->num_rows > 0)
    {
        while($row = $r11->fetch_assoc()) {
            $user_id = $row["user_id"];
        
        }
    }

    //echo $q;

    $q3 = "SELECT user_id FROM Upvotes WHERE user_id = '$user_id' AND question_id = $q";
    //echo $q1;
        $r3 = $db->query($q3);

    if($r3->num_rows == 0)
    {
        $q4 = "INSERT INTO Upvotes (question_id, user_id, upvote_dt) VALUES ('$q', '$user_id', '$upvote_dt')";
    //echo $q1;
        $r4 = $db->query($q4);
        
    }


    else if($r3->num_rows != 0)
    {
        $q5 = "SELECT upvote_id FROM Upvotes WHERE user_id = '$user_id' AND question_id = $q" ;
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
        
      
        //$class = "unsubmitted";

    }

    $votecount = "SELECT Count(Upvotes.upvote_id) AS vote_count FROM Upvotes WHERE question_id = '$q'";
    
    $result =$db->query($votecount);

    $response = array();

	while ($row5 = $result->fetch_assoc()) {
		
		$response[] = $row5;
	}
  
    $JSON_response = json_encode($response);

	//TODO: after creating a query results array, encode it as JSON and echo it as the message
	// - encoding as JSON from PHP: https://www.php.net/manual/en/function.json-encode.php

    echo $JSON_response;

	//TODO: query the User table... 
	// - Use object oriented style: https://www.php.net/manual/en/mysqli.query.php
	// - Be sure to select only fields you need.
	// - filter your results using 'q' value sent in the request
	
//$result = array();
	//OPTIONAL TODO: if the query did not work, perhaps echo an error message
	// - the sample Javascript is built to handle this by printing it anything that is not JSON encoded
	// - warning: users are not always happy to see error messages...
    //echo "$results";
	//TODO: if the query worked, loop through the results and add each row to an array (do not print or echo them yet)
	// - Use object oriented style!
	// - request rows such that we get an associative array with field names, not index numbers
	//   see mysqli_fetch_assoc for more: https://www.php.net/manual/en/mysqli-result.fetch-assoc.php
	// - appending to PHP arrays: 
	//    - https://www.php.net/manual/en/language.types.array.php#language.types.array.syntax.modifying
	//    - https://www.php.net/manual/en/function.array-push.php
	// - HINT: when reading www.php.net, check the User Contributed Notes too...
    //echo $row['email'];
	//$response = array();


	//TODO: after creating a query results array, encode it as JSON and echo it as the message
	// - encoding as JSON from PHP: https://www.php.net/manual/en/function.json-encode.php


	$db->close();
?>