<?php
/// Create connection
$conn = new mysqli("localhost", "doo945", "Amazo142", "doo945");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE Upvotes (
upvote_id INT NOT NULL AUTO_INCREMENT,
question_id INT NOT NULL,
user_id INT NOT NULL,
upvote_dt DATETIME NOT NULL,
PRIMARY KEY (upvote_id),
FOREIGN KEY (question_id) REFERENCES Questions(question_id),
FOREIGN KEY (user_id) REFERENCES Users(user_id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Questions created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>