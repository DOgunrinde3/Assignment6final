<?php
	//TODO: Create a connection to your database using a mysqli object
	// - notice we are using object oriented style
	// - see example 1 here: https://www.php.net/manual/en/mysqli.construct.php
	// - see also lab 11: https://www.cs.uregina.ca/Links/class-info/215/php_mysql/index.html#dbconnection
	$db = new mysqli("localhost", "doo945", "Amazo142", "doo945");
	
	if ($db -> connect_error) {
	   die ("Connection failed: " . $db -> connect_error);
	}

	$lastdt = $_GET['lastdt'];
    $lastAsked = date('Y-m-d H:i:s', $lastdt/1000);
    //echo $lastdt;

    //print_r($_GET);
    //echo $lastAsked;
    


   // echo $q2;

    $q16 = "SELECT question_id FROM Questions WHERE created_dt > '$lastAsked'";
    //echo $q1;
        $r16 = $db->query($q16);
      
        //$class = "unsubmitted";

   if ($r16 -> num_rows > 0){

    while($row19 = $r16->fetch_assoc()) {
        $QID = $row19["question_id"];
    
    }

    $q = "SELECT Questions.question, Questions.question_id, Questions.created_dt, Users.img_url, Users.username, Users.email FROM Users LEFT JOIN Questions ON(Questions.user_id = Users.user_id) 
    WHERE question_id = $QID";
  //Questions.created_dt
    $result = $db->query($q);
 
    

    $response = array();
    
        while ($row = $result->fetch_assoc()) {
            
            $response[] = $row;
        }
      
        $JSON_response = json_encode($response);
        echo $JSON_response;
        $db->close();
    
        //TODO: after creating a query results array, encode it as JSON and echo it as the message
        // - encoding as JSON from PHP: https://www.php.net/manual/en/function.json-encode.php

    }

    else
    {
        $response2 = 0;
        $JSON_response = json_encode($response2);
        echo $JSON_response;
        $db->close();

    }



?>