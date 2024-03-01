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

$query_ulasan = "SELECT ulasanbuku.*, user.Username, buku.Judul 
                 FROM ulasanbuku 
                 INNER JOIN user ON ulasanbuku.UserID = user.UserID
                 INNER JOIN buku ON ulasanbuku.BukuID = buku.BukuID";
$result_ulasan = $conn->query($query_ulasan);

// Aksi untuk menghapus ulasan buku
if ($role == 'administrator' || $role == 'petugas') {
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $delete_query = "DELETE FROM ulasanbuku WHERE UlasanID = $delete_id";
        if ($conn->query($delete_query) === TRUE) {
            header("location: ulasan.php");
            exit;
        } else {
            echo "Error: " . $delete_query . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Buku</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Ulasan Buku</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul Buku</th>
                        <th>Username</th>
                        <th>Ulasan</th>
                        <th>Rating</th>
                        <?php if ($role == 'administrator' || $role == 'petugas'): ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result_ulasan && $result_ulasan->num_rows > 0): ?>
                        <?php $no = 1; ?>
                        <?php while ($row_ulasan = $result_ulasan->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $row_ulasan['Judul']; ?></td>
                                <td><?php echo $row_ulasan['Username']; ?></td>
                                <td><?php echo $row_ulasan['Ulasan']; ?></td>
                                <td><?php echo isset($row_ulasan['rating']) ? $row_ulasan['rating'] : 'Belum ada rating'; ?></td>
                                <?php if ($role == 'administrator' || $role == 'petugas'): ?>
                                    <td>
                                        <a href="?delete_id=<?php echo $row_ulasan['UlasanID']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?');" class="btn btn-danger btn-sm">Hapus</a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                            <?php $no++; ?>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">Belum ada ulasan buku.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <a href="dashboard.php" class="btn btn-secondary">Kembali ke dashboard</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
