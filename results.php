<?php

/*
  results.php
  -> Gathers all book submissions from book_submissions table
*/

require "dbconn.php";

$sql = "SELECT * FROM book_submissions";
$result = $conn->query($sql);

$book_submissions = [];

while($row =  $result->fetch_array(MYSQLI_ASSOC)){
  array_push($book_submissions, $row);
}

return json_encode($book_submissions);