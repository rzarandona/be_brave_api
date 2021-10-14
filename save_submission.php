<?php

/*
  save_submission.php
  -> API endpoint to save a book submission to the database
*/


require "dbconn.php";

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