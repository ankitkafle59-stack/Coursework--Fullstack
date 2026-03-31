<?php
session_start();

if (empty($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login-form.php");
    exit;
}

// Get ID safely
$book_id = $_GET['id'] ?? '';

if (empty($book_id)) {
    die("Invalid ID");
}

// Connect DB
include("db.php");

// Use prepared statement (BEST PRACTICE)
$stmt = $mysqli->prepare("DELETE FROM Books WHERE book_id = ?");
$stmt->bind_param("i", $book_id);

if (!$stmt->execute()) {
    echo "Error: " . $stmt->error;
}

// Redirect
header("Location: list-book.php");
exit;
?>