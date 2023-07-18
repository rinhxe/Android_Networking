<?php
// Establish a connection to the MySQL database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'du_an_1';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve data from the database
$query = "SELECT * FROM room";

$result = $conn->query($query);

// Convert the result to an associative array and return as JSON
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

$conn->close();
?>