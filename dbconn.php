<?php

/*
  dbconn.php
  -> Sets up the mysqli connection to the database
*/


header('Access-Control-Allow-Origin: *');

$servername = "localhost";
$username = "hectorspost_user";
$password = "#2021Wearetraction";
$database = "be_brave_api";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}