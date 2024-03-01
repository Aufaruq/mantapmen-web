<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaKategori = $_POST["namaKategori"];

    $query_insert = "INSERT INTO kategoribuku (NamaKategori) VALUES ('$namaKategori')";
    if ($conn->query($query_insert) === TRUE) {
        $message = '<div class="alert alert-success" role="alert">Kategori berhasil ditambahkan!</div>';
    } else {
        $message = '<div class="alert alert-danger" role="alert">Error: ' . $query_insert . '<br>' . $conn->error . '</div>';
    }
}
 
 
$query_kategori = "SELECT * FROM kategoribuku";
$result_kategori = $conn->query($query_kategori);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori Buku</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4 mb-4">Tambah Kategori Buku</h2>
        <?php echo isset($message) ? $message : ''; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="namaKategori">Nama Kategori:</label>
                <input type="text" class="form-control" id="namaKategori" name="namaKategori">
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>

        <div class="mt-4">
            <h3>Daftar Kategori Buku</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_kategori->num_rows > 0) {
                        $no = 1;
                        while ($row_kategori = $result_kategori->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row_kategori["NamaKategori"] . "</td>";
                            echo "<td>";
                            echo "<a href='edit_kategori.php?id=" . $row_kategori["KategoriID"] . "' class='btn btn-primary btn-sm'>Edit</a>";
                            echo "&nbsp;&nbsp;";
                            echo "<a href='hapus_kategori.php?id=" . $row_kategori["KategoriID"] . "' class='btn btn-danger btn-sm'>Hapus</a>";
                            echo "</td>";
                            echo "</tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='3'>Tidak ada kategori tersedia</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <a href="kategori_buku.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>
