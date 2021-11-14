<?php
	//TODO: Create a connection to your database using a mysqli object
	// - notice we are using object oriented style
	// - see example 1 here: https://www.php.net/manual/en/mysqli.construct.php
	// - see also lab 11: https://www.cs.uregina.ca/Links/class-info/215/php_mysql/index.html#dbconnection
	$db = new mysqli("localhost", "doo945", "Amazo142", "doo945");
	
	if ($db -> connect_error) {
	   die ("Connection failed: " . $db -> connect_error);
	}

	$q2 = $_GET['questionid'];

   // echo $q2;

    $q16 = "UPDATE Questions SET answered = true WHERE question_id = '$q2' ";
    //echo $q1;
        $r16 = $db->query($q16);
      

        //$class = "unsubmitted";

   
    $isanswered = "SELECT answered FROM Questions WHERE answered = true ";
    $result =$db->query($isanswered);
 
    //echo $results;
  
        $response = array();
    
        while ($row = $result->fetch_assoc()) {
            
            $response[] = $row;
        }
      
        $JSON_response = json_encode($response);
    
        //TODO: after creating a query results array, encode it as JSON and echo it as the message
        // - encoding as JSON from PHP: https://www.php.net/manual/en/function.json-encode.php
    
        echo $JSON_response;
    
    

	$db->close();
?>