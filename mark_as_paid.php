<?php
require("dbconn.php");
header('Access-Control-Allow-Origin: *');

$session_id = $_POST['session_id'];
$order_id = $_POST['order_id'];
date_default_timezone_set('Europe/London');
$date_now = date("m-d-Y h:i A");

$address_line = $_POST['address_line'];
$customer_name = $_POST['customer_name'];
$iso_country = $_POST['iso_country'];
$postcode = $_POST['postcode'];
$shipping_alias = $_POST['shipping_alias'];
$town = $_POST['town'];
$unit_cost = $_POST['unit_cost'];
 
$my_arr = [
  'address_line' => $address_line,
'customer_name' => $customer_name,
'iso_country' => $iso_country,
'postcode' => $postcode,
'shipping_alias' => $shipping_alias,
'town' => $town,
'unit_cost' => $unit_cost
];

$sql = "
  UPDATE book_submissions
  SET is_paid = 'true', date_paid = '{$date_now}', order_id = '{$order_id}', address_line = '{$address_line}', customer_name = '{$customer_name}', iso_country = '{$iso_country}', postcode = '{$postcode}', shipping_alias = '{$shipping_alias}', town = '{$town}', unit_cost = '{$unit_cost}',
  WHERE id = {$session_id}
";

if ($conn->query($sql) == TRUE) {
  echo 'Records updated!';
}else{
  echo 'There was an error.';
}