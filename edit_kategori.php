<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kategoriID = $_POST["kategoriID"];
    $namaKategori = $_POST["namaKategori"];

    $query_update = "UPDATE kategoribuku SET NamaKategori='$namaKategori' WHERE KategoriID='$kategoriID'";
    if ($conn->query($query_update) === TRUE) {
        $message = '<div class="alert alert-success" role="alert">Data kategori berhasil diperbarui!</div>';
    } else {
        $message = '<div class="alert alert-danger" role="alert">Error: ' . $query_update . '<br>' . $conn->error . '</div>';
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query_select = "SELECT * FROM kategoribuku WHERE KategoriID='$id'";
    $result = $conn->query($query_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori Buku</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4 mb-4">Edit Kategori Buku</h2>
        <?php echo isset($message) ? $message : ''; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="kategoriID" value="<?php echo $row["KategoriID"]; ?>">
            <div class="form-group">
                <label for="namaKategori">Nama Kategori:</label>
                <input type="text" class="form-control" id="namaKategori" name="namaKategori" value="<?php echo $row["NamaKategori"]; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <a href="kategori_buku.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>
<?php
    } else {
        echo '<div class="alert alert-danger" role="alert">Data kategori tidak ditemukan.</div>';
    }
}
?>
