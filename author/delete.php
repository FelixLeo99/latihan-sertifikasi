<?php
include '../class/authors.php';  // Pastikan path ini benar

// Cek jika parameter 'id' ada di URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Panggil metode deleteAuthor untuk menghapus data
    $deleted = Authors::deleteAuthor($id);

    // Jika berhasil, redirect ke halaman daftar author dengan pesan sukses
    if ($deleted > 0) {
        header("Location: daftarAuthor.php?message=Author deleted successfully");
        exit;
    } else {
        // Jika gagal, redirect dengan pesan error
        header("Location: daftarAuthor.php?error=Failed to delete author");
        exit;
    }
} else {
    // Jika 'id' tidak ditemukan di URL, tampilkan pesan error
    header("Location: daftarAuthor.php?error=No author ID specified");
    exit;
}
