<?php
include '../config.php';
include '../class/authors.php'; // Pastikan file ini di-include dengan benar

// Cek apakah form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];  // Ambil data nama dari form
    $email = $_POST['email'];  // Ambil data email dari form

    // Panggil fungsi createAuthor dari class Authors untuk menambah author baru
    if (Authors::createAuthor($name, $email)) {
        echo "<div class='alert alert-success'>Author created successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Failed to create author!</div>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Author</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h2 class="mb-4">Create Author</h2>
        <nav>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="daftarBuku.php">Daftar Buku</a></li>
                <li class="nav-item"><a class="nav-link" href="daftarAuthor.php">Daftar Author</a></li>
                <li class="nav-item"><a class="nav-link" href="formCreate.php">Create Author</a></li>
            </ul>
        </nav>

        <!-- Form to add a new author -->
        <form method="POST" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>