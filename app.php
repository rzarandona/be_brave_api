<?php
  require "header.php";

  $sql = "SELECT * FROM book_submissions";
  $result = $conn->query($sql);
  $row = $result->fetch_array(MYSQLI_NUM);

  var_dump($row);


?>