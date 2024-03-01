<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query_delete = "DELETE FROM kategoribuku WHERE KategoriID='$id'";
    if ($conn->query($query_delete) === TRUE) {
        $message = '<div class="alert alert-success" role="alert">Data kategori berhasil dihapus!</div>';
    } else {
        $message = '<div class="alert alert-danger" role="alert">Error: ' . $query_delete . '<br>' . $conn->error . '</div>';
    }
}
header("Location: kategori_buku.php");
exit();
?>
