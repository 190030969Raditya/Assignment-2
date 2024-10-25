<?php
// RDS database connection settings
$host = "your-rds-endpoint";  // Replace with your RDS endpoint
$dbname = "your-database-name"; // Replace with your DB name
$username = "your-username";  // Replace with your RDS username
$password = "your-password";  // Replace with your RDS password

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $f_name = $conn->real_escape_string($_POST['f_name']);
    $l_name = $conn->real_escape_string($_POST['l_name']);
    $email = $conn->real_escape_string($_POST['email']);

    // SQL query to insert data into the table
    $sql = "INSERT INTO users (first_name, last_name, email) VALUES ('$f_name', '$l_name', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>