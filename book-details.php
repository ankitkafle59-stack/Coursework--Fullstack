<?php
  // Connect to database and run SQL query
  include("db.php");

  // Grabs id value from URL
  $id = $_GET['id'];

  $sql = "SELECT * FROM Books WHERE book_id = {$id}";
  $rst = mysqli_query($mysqli, $sql);
  $a_row = mysqli_fetch_assoc($rst);
?>

<h1><?=$a_row['book_name']?></h1>
<p><?=$a_row['book_description']?></p>

<a href="list-book.php"><< Back to list</a>
