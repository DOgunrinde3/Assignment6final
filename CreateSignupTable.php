<?php
/// Create connection
$conn = new mysqli("localhost", "doo945", "Amazo142", "doo945");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE Users (
user_id INT NOT NULL AUTO_INCREMENT,
email VARCHAR(255) NOT NULL,
username VARCHAR(255) NOT NULL,
password VARCHAR(30) NOT NULL,
DOB DATE NOT NULL,
img_url VARCHAR(255) NOT NULL,
PRIMARY KEY (user_id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>