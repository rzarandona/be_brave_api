<?php
  require "header.php";

  $sql = "SELECT * FROM book_submissions";
  $result -> $conn->query($sql);
  $arr = $result->fetch_all(MYSQLI_ASSOC);

  var_dump($arr);

?>