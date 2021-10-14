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

    <nav class="navbar navbar-dark bg-primary">
      <div class="container">
        <a class="navbar-brand" href="http://157.245.51.194/api/hectors_post/be_brave/app.php">Book Submissions API Dashboard</a>
      </div>
    </nav>
    <div class="container">
      
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
          </tr>
        </thead>
        <tbody>
         
          <tr>
            <th scope="row">3</th>
            <td>Larry</td>
            <td>the Bird</td>
            <td>@twitter</td>
          </tr>
        </tbody>
      </table>

    </div>
</body>
</html>