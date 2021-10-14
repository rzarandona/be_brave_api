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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
            <th scope="col">ID</th>
            <th scope="col">Email</th>
            <th scope="col">Date Created</th>
            <th scope="col">Date Paid</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($book_submissions as $submission){?>

            <tr>
              <td><?php echo $submission['id']; ?></td>
              <td><?php echo $submission['email']; ?></td>
              <td><?php echo $submission['date_created']; ?></td>
              <td><?php echo $submission['date_paid']; ?></td>
              <td><button class="btn-primary">OneFlow</button></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>

    </div>
</body>
</html>