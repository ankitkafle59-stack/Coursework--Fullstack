<h1>Book Search</h1>


<hr>

<?php
include("db.php");

$keywords = $_POST['keywords'] ?? '';

$sql = "SELECT * FROM Books";
$stmt = null;

if (!empty($keywords)) {
    $sql .= " WHERE book_name LIKE ?
              OR book_description LIKE ?
              OR rating LIKE ?
              OR published_date LIKE ?
              ORDER BY published_date";

    $search = "%" . $keywords . "%";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssss", $search, $search, $search, $search);
    $stmt->execute();
    $results = $stmt->get_result();
} else {
    $sql .= " ORDER BY published_date";
    $results = mysqli_query($mysqli, $sql);
}
?>

<table border="1" cellpadding="8">
    <tr>
        <th>Book Name</th>
        <th>Rating</th>
        <th>Published Date</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($results)): ?>
        <tr>
            <td>
                <a href="book-details.php?id=<?= $row['book_id'] ?>">
                    <?= htmlspecialchars($row['book_name']) ?>
                </a>
            </td>
            <td><?= htmlspecialchars($row['rating']) ?></td>
            <td><?= htmlspecialchars($row['published_date']) ?></td>
        </tr>
    <?php endwhile; ?>
</table>