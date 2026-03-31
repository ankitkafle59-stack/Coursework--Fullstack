<?php
session_start();

if (empty($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login-form.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <h1>Add a Book</h1>
      <form action="add-book.php" method="post">
        <div class="mb-3">
          <label for="BookName" class="form-label">Book name</label>
          <input type="text" class="form-control" id="BookName" name="BookName">
        </div>
        <div class="mb-3">
          <label for="BookDescription" class="form-label">Description</label>
          <textarea class="form-control" id="BookDescription" name="BookDescription" rows="5"></textarea>
        </div>
        <div class="mb-3">
          <label for="DatePublished" class="form-label">Date published</label>
          <input type="date" class="form-control" id="DatePublished" name="DatePublished">
        </div>  
        <div class="mb-3">
          <label for="BookRating" class="form-label">Rating</label>
          <input type="number" class="form-control" id="BookRating" name="BookRating">
        </div>         
        <input type="submit" class="btn btn-primary" value="Add book">
      </form>
    </div>
  </body>
</html>	      
