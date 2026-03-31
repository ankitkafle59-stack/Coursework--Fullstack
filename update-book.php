<?php

session_start();

if (empty($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login-form.php");
    exit;
}


include 'db.php';


$book_id = $_POST['book_id'];
$book_name = $_POST['book_name'];
$book_description = $_POST['book_description'];
$rating = $_POST['rating'];
$published_date = $_POST['published_date'];

// Update query
$sql = "UPDATE Books 
        SET book_name='$book_name',
            book_description='$book_description',
            rating='$rating',
            published_date ='$published_date'
        WHERE book_id=$book_id";

mysqli_query($mysqli, $sql);

// Redirect back to list
header("Location: list-book.php");
exit;
?>

