<?php
/// Create connection
$conn = new mysqli("localhost", "doo945", "Amazo142", "doo945");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE Questions (
question_id INT NOT NULL AUTO_INCREMENT,
user_id INT NOT NULL,
question VARCHAR(255) NOT NULL,
created_dt DATETIME NOT NULL,
answered BOOLEAN NOT NULL,
PRIMARY KEY (question_id),
FOREIGN KEY (user_id) REFERENCES Users(user_id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Questions created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>