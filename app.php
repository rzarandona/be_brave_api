<?php
  /*
    app.php
    -> Creates an admin dashboard of the book submissions
  */

  require "results.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Submissions API Dashboard</title>
  <link rel="stylesheet" href="https://bootswatch.com/5/united/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h3>Book Submissions API Dashboard</h3>
    <?php print_r($book_submissions)?>
  </div>
</body>
</html>