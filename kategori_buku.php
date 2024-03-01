<?php
include 'koneksi.php';

$query_select = "SELECT * FROM kategoribuku";
$result = $conn->query($query_select);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori Buku</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4 mb-4">Daftar Kategori Buku</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>KategoriID</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["KategoriID"]."</td>";
                        echo "<td>".$row["NamaKategori"]."</td>";
                        echo "<td><a href='edit_kategori.php?id=".$row["KategoriID"]."' class='btn btn-primary btn-sm mr-2'>Edit</a><a href='hapus_kategori.php?id=".$row["KategoriID"]."' class='btn btn-danger btn-sm'>Hapus</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Tidak ada data kategori buku.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="create_kategori.php" class="btn btn-primary">Tambah Kategori Buku</a>
        <a href="dashboard.php" class="btn btn-secondary">Kembali ke dashboard</a>
    </div>
</body>
</html>
