<?php


$servername = "localhost";
$username = "root";
$password = "#2021Wearetraction";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$email = $_POST['email'];
echo json_encode($email);