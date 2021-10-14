<?php

header('Access-Control-Allow-Origin: *');

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
$outer_pdf_link = $_POST['outer_pdf_url'];
$inner_pdf_link = $_POST['inner_pdf_url'];
$preview_image_link = $_POST['preview_url'];

$data = [
  $email,
  $outer_pdf_link,
  $inner_pdf_link,
  $preview_image_link
];

echo json_encode($data);