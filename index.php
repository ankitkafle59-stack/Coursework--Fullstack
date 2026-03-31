<?php
// ----------------------
// LOGIN SECURITY
// ----------------------
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login-form.php");
    exit;
}
?>
<script>
if (!sessionStorage.getItem('tabLoggedIn')) {
    window.location.href = "login-form.php";
}
</script>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Books</title>

  <!-- Bootstrap 5 CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >

  <style>
    .books-table {
      font-family: Arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
      background: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }

    .books-table thead {
      background: #04AA6D;
      color: white;
    }

    .books-table th {
      padding: 14px;
      text-align: left;
      font-size: 15px;
      letter-spacing: 0.5px;
    }

    .books-table td {
      padding: 14px;
      border-bottom: 1px solid #e6e6e6;
      font-size: 14px;
    }

    .books-table tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .books-table tbody tr:hover {
      background-color: #eaf9f1;
      transition: 0.25s;
    }

    .books-table a.book-link {
      color: #0275d8;
      text-decoration: none;
      font-weight: 600;
    }

    .books-table a.book-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">

      <!-- Brand -->
      <a class="navbar-brand fw-bold" href="list-book.php">List of ALL my books!!!</a>

      <!-- Mobile toggler -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#mainNavbar" aria-controls="mainNavbar"
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar content -->
      <div class="collapse navbar-collapse" id="mainNavbar">
        <div class="ms-auto d-flex align-items-center">

          <!-- Search -->
          <form class="d-flex me-3" action="search-book.php" method="post">
            <input class="form-control form-control-sm me-2"
                   type="text" name="keywords" placeholder="Search">
            <button class="btn btn-sm btn-outline-light" type="submit">Go!</button>
          </form>

          <!-- AJAX features -->
          <ul class="navbar-nav me-3">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="ajaxDropdown"
                 role="button" data-bs-toggle="dropdown" aria-expanded="false">
                AJAX Features
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="ajaxDropdown">
                <li><a class="dropdown-item" href="bootstrap-ajax-dropdown.html">Dropdown Example</a></li>
                <li><a class="dropdown-item" href="bootstrap-ajax-modal.html">Modal Example</a></li>
              </ul>
            </li>
          </ul>

          <!-- LOGIN STATUS -->
          <span class="text-white me-3">
            Logged in as <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>
          </span>

          <a class="btn btn-sm btn-danger" href="logout.php">Logout</a>

        </div>
      </div>
    </div>
  </nav>

  <div class="container my-4">
    <?php
      include("db.php");

      $sql = "SELECT * FROM Books ORDER BY published_date";
      $results = mysqli_query($mysqli, $sql);

      if (!$results) {
        die("Database error: " . htmlspecialchars(mysqli_error($mysqli)));
      }
    ?>

    <!-- Header + Add button -->
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1 class="h3 mb-0">My Books</h1>
      <a href="add-book-form.php" class="btn btn-success btn-sm">+ Add a book</a>
    </div>

    <!-- Books table -->
    <table class="books-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Book</th>
          <th>Rating</th>
          <th style="width: 220px;">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($a_row = mysqli_fetch_assoc($results)): ?>
          <tr>
            <td><?= (int)$a_row['book_id'] ?></td>

            <td>
              <a class="book-link" href="book-details.php?id=<?= (int)$a_row['book_id'] ?>">
                <?= htmlspecialchars($a_row['book_name']) ?>
              </a>
            </td>

            <td><?= htmlspecialchars($a_row['rating']) ?></td>

            <td>
              <a class="btn btn-warning btn-sm"
                 href="edit-book-form.php?id=<?= (int)$a_row['book_id'] ?>">
                Edit
              </a>

              <a class="btn btn-outline-danger btn-sm ms-1"
                 href="delete-book.php?id=<?= (int)$a_row['book_id'] ?>"
                 onclick="return confirm('Delete this book?');">
                Delete
              </a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
