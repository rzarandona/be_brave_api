<?php
require("dbconn.php");
header('Access-Control-Allow-Origin: *');

$session_id = $_POST['session_id'];
$order_id = $_POST['order_id'];
date_default_timezone_set('Europe/London');
$date_now = date("m-d-Y h:i A");


$sql = "
  UPDATE book_submissions
  SET is_paid = 'true', date_paid = '{$date_now}', order_id = '{$order_id}'
  WHERE id = {$session_id}
";

if ($conn->query($sql) == TRUE) {
  echo "UPDATED";
}