<?php

header('Access-Control-Allow-Origin: *');

$servername = "localhost";
$username = "root";
$password = "#2021Wearetraction";
$database = "hectors_post";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}