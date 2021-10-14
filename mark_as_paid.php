<?php
require("dbconn.php");
header('Access-Control-Allow-Origin: *');

$session_id = $_POST['session_id'];
echo $session_id;