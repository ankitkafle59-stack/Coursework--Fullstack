<?php
session_start();

// Protect page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login-form.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: add-book-form.php");
    exit;
}

// Read form values
$book_name         = isset($_POST['BookName'])        ? trim($_POST['BookName'])        : '';
$book_description  = isset($_POST['BookDescription']) ? trim($_POST['BookDescription']) : '';
$book_publish_date = isset($_POST['DatePublished'])   ? trim($_POST['DatePublished'])   : '';
$book_rating       = isset($_POST['BookRating'])      ? (int)$_POST['BookRating']       : null;

// Validate
if ($book_name === '' || $book_description === '' || $book_publish_date === '' || $book_rating === null) {
    echo "<h3>Missing required fields.</h3>";
    echo "<p><a href='add-book-form.php'>Back to form</a></p>";
    exit;
}

require 'db.php';

// !!! IMPORTANT: use the real column names from your Books table
// If your column is called `published_date`, keep this.
// If it's called `publish_date` or `DatePublished`, change it here.
$sql = "INSERT INTO Books (book_name, book_description, published_date, rating)
        VALUES (?, ?, ?, ?)";

$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    echo "<h3>Database error.</h3>";
    echo "<p>" . htmlspecialchars($mysqli->error) . "</p>";
    exit;
}

$stmt->bind_param("sssi", $book_name, $book_description, $book_publish_date, $book_rating);

if (!$stmt->execute()) {
    echo "<h3>Could not save book.</h3>";
    echo "<p>" . htmlspecialchars($stmt->error) . "</p>";
    exit;
}

header("Location: list-book.php");
exit;
?>
