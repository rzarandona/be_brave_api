<?php

/*
  results.php
  -> Gathers all book submissions from book_submissions table
*/

require "dbconn.php";

$sql = "SELECT * FROM book_submissions";
$result = $conn->query($sql);

$book_submissions = [];

while($row =  $result->fetch_array(MYSQLI_NUM)){
  array_push($book_submissions, $row);
}