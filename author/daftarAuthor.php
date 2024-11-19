<?php
// Menampilkan pesan sukses atau error jika ada
if (isset($_GET['message'])) {
    echo "<div class='alert alert-success'>" . htmlspecialchars($_GET['message']) . "</div>";
} elseif (isset($_GET['error'])) {
    echo "<div class='alert alert-danger'>" . htmlspecialchars($_GET['error']) . "</div>";
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h2 class="mb-4">Daftar Author</h2>
        <nav>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="../Book/daftarBuku.php">Daftar Buku</a></li>
                <li class="nav-item"><a class="nav-link" href="daftarAuthor.php">Daftar Author</a></li>
                <li class="nav-item"><a class="nav-link" href="formCreate.php">Create Author</a></li>
            </ul>
        </nav>

        <!-- Table to display authors -->
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the authors class
                include '../class/authors.php';

                // Fetch authors
                $authors = Authors::getAuthors();

                // Check if authors are available
                if (!empty($authors)) {
                    foreach ($authors as $author) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($author->id) . "</td>";
                        echo "<td>" . htmlspecialchars($author->name) . "</td>";
                        echo "<td>" . htmlspecialchars($author->email) . "</td>";
                        echo "<td>" . htmlspecialchars($author->created_at) . "</td>";
                        echo "<td>";
                        echo "<a href='formdit.php?id=" . $author->id . "' class='btn btn-primary btn-sm '>Edit</a>";
                        echo "<a href='delete.php?id=" . $author->id . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this author?\")'>Delete</a>";
                        echo "</td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No authors found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>