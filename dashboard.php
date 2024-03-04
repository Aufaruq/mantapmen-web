<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

$username = $_SESSION['username'];
$query = "SELECT role FROM user WHERE Username='$username'";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $role = $row['role'];
} else {
    $role = 'peminjam';
}

$sql_buku = "SELECT buku.*, kategoribuku.NamaKategori, IFNULL(AVG(ulasanbuku.rating), 0) AS rating_avg
            FROM buku
            INNER JOIN kategoribuku ON buku.KategoriID = kategoribuku.KategoriID
            LEFT JOIN ulasanbuku ON buku.BukuID = ulasanbuku.BukuID
            GROUP BY buku.BukuID";
$result_buku = $conn->query($sql_buku);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Aplikasi Perpustakaan Digital</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <?php if ($role == 'administrator' || $role == 'petugas'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="add_book.php">Tambah Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kategori_buku.php">Kategori Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ulasan.php">Ulasan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="laporan.php">generate</a>
                    </li>
                <?php endif; ?>
                <?php if ($role == 'peminjam'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="peminjaman.php">Peminjaman Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="koleksipribadi.php">Koleksi Buku</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="row mt-7">
        <div class="col-md-12">
            <h2 class="text-center mb-4">List Buku Perpustakaan Digital</h2>
        </div>
    </div>
    
    <div class="container-fluid row row-cols-6 justify-content-center d-flex mt-5">
    <?php while ($row_buku = $result_buku->fetch_assoc()): ?>
        <div class="card" style="width: 18rem; margin: 10px;">
            <div style="height: 500px; overflow: hidden;">
                <img src="<?php echo $row_buku['Gambar']; ?>" class="card-img-top" alt="..." style="height: 100%; object-fit: cover;">
            </div>
            <div class="card-body text-center">
                <h2 class="card-title"><?php echo $row_buku['Judul']; ?></h2>
                <p><strong>Penulis:</strong> <?php echo $row_buku['Penulis']; ?></p>
                <p><strong>Penerbit:</strong> <?php echo $row_buku['Penerbit']; ?></p>
                <p><strong>Tahun Terbit:</strong> <?php echo $row_buku['TahunTerbit']; ?></p>
                <p><strong>Kategori:</strong> <?php echo $row_buku['NamaKategori']; ?></p>
                <p><strong>Rating:</strong> <?php echo $row_buku['rating_avg'] > 0 ? number_format($row_buku['rating_avg'], 1) : 'Belum ada rating'; ?></p>
                <a href="detail.php?BukuID=<?php echo $row_buku['BukuID']; ?>" class="btn btn-primary">Lihat Detail</a>
            </div>
        </div>
    <?php endwhile; ?>
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
