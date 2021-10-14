<?php

/*
  results.php
  -> Gathers all book submissions from book_submissions table
*/

require "dbconn.php";

$sql = "SELECT * FROM book_submissions";
$result = $conn->query($sql);
while($row =  $result->fetch_array(MYSQLI_NUM)){
  var_dump($row);
}
