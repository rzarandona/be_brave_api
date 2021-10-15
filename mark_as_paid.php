<?php
require("dbconn.php");
header('Access-Control-Allow-Origin: *');

$session_id = $_POST['session_id'];
$date_now = date("m-d-Y h:i A");

$sql = "
  UPDATE book_submissions
  SET is_paid = 'true', date_paid = '{$date_now}'
  WHERE id = {$session_id}
";

if ($conn->query($sql) == TRUE) {
  echo "UPDATED";
}