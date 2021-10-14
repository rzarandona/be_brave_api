<?php
  require "header.php";

  $sql = "SELECT * FROM book_submissions";
  if ($data = $conn->query($sql) == TRUE) {
    print_r($data);
  }
?>