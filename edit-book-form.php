<?php

session_start();

if (empty($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login-form.php");
    exit;
}



include 'db.php';

$id = $_GET['id'];

// Get the specific book info
$sql = "SELECT * FROM Books WHERE book_id = $id";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!doctype html>
<html lang="en">
<body>

<h1>Update Book</h1>

<form action="update-book.php" method="post">
  <input type="hidden" name="book_id" value="<?=$row['book_id']?>">

  <label>Book Name:</label><br>
  <input type="text" name="book_name" value="<?=$row['book_name']?>" required><br><br>
  
  <label>Description:</label><br>
  <textarea name="book_description" rows="5" cols="40" required><?=$row['book_description']?></textarea><br><br>

  <label>Rating:</label><br>
  <input type="number" name="rating" value="<?=$row['rating']?>" required><br><br>

  <label>Publish Date:</label><br>
  <input type="date" name="published_date" value="<?=$row['published_date']?>" required><br><br>

  <input class="btn" type="submit" value="Update book">
</form>

</body>
</html>
