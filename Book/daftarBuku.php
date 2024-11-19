<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h2 class="mb-4">Daftar Buku</h2>
        <nav>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="../Book/daftarBuku.php">Daftar Buku</a></li>
                <li class="nav-item"><a class="nav-link" href="../author/daftarAuthor.php">Daftar Author</a></li>


            </ul>
        </nav>
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Author Name</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../class/books.php';

                // Ambil daftar buku
                $books = Books::getBuku();
                if (!empty($books)) {
                    foreach ($books as $book) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($book->id) . "</td>";
                        echo "<td>" . htmlspecialchars($book->title) . "</td>";
                        echo "<td>" . htmlspecialchars($book->genre) . "</td>";
                        echo "<td>" . htmlspecialchars($book->author_name) . "</td>";
                        echo "<td>" . htmlspecialchars($book->created_at) . "</td>";
                        echo "<td>";
                        echo "<a href='formdit.php?id=" . $book->id . "' class='btn btn-primary btn-sm '>Edit</a>";
                        echo "<a href='delete.php?id=" . $book->id . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this book?\")'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No books found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>