<?php
include '../config.php';  // Pastikan file config.php sudah benar
include '../class/authors.php'; // Pastikan file authors.php sudah benar

// Periksa apakah parameter 'id' ada dalam URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data author berdasarkan ID
    $author = Authors::getAuthorById($id);

    // Jika data author tidak ditemukan, redirect ke daftar author
    if (!$author) {
        header("Location: daftarAuthor.php?error=Author not found");
        exit;
    }
} else {
    header("Location: daftarAuthor.php?error=No author ID specified");
    exit;
}

// Cek jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Panggil metode untuk memperbarui author
    $updated = Authors::updateAuthor($id, $name, $email);

    if ($updated > 0) {
        header("Location: daftarAuthor.php?message=Author updated successfully");
        exit;
    } else {
        echo "Error updating author";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Author</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h2 class="mb-4">Edit Author</h2>
        <nav>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="daftarBuku.php">Daftar Buku</a></li>
                <li class="nav-item"><a class="nav-link" href="daftarAuthor.php">Daftar Author</a></li>
                <li class="nav-item"><a class="nav-link" href="create.php">Create Author</a></li>
            </ul>
        </nav>

        <!-- Form to edit an existing author -->
        <form method="POST" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($author->name); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($author->email); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>