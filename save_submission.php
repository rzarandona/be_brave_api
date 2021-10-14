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

$email = $_POST['email'];
$outer_pdf_link = $_POST['outer_pdf_url'];
$inner_pdf_link = $_POST['inner_pdf_url'];
$preview_image_link = $_POST['preview_url'];

date_default_timezone_set('Europe/London');
$date_now = date("m-d-Y h:i A");

$sql = "
INSERT INTO 
  book_submissions 
    (email, preview_image_link, outer_pdf_link, inner_pdf_link, date_created, date_paid, is_paid)
  VALUES
    ('{$email}', '{$preview_image_link}', '{$outer_pdf_link}', '{$inner_pdf_link}', '{$date_now}', NULL, 'false');
";

if ($conn->query($sql) == TRUE) {
  $id = $conn->insert_id;
  echo $id;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();