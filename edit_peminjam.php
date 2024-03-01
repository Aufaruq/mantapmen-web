<?php
include 'koneksi.php';

$notif = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $peminjamanID = $_POST["peminjamanID"];
    $userID = $_POST["userID"];
    $bukuID = $_POST["bukuID"];
    $tanggalPeminjaman = $_POST["tanggalPeminjaman"];
    $tanggalPengembalian = $_POST["tanggalPengembalian"];
    $statusPeminjaman = $_POST["statusPeminjaman"];

    $query_update = "UPDATE peminjaman SET UserID='$userID', BukuID='$bukuID', tanggalPeminjaman='$tanggalPeminjaman', TanggalPengembalian='$tanggalPengembalian', StatusPeminjaman='$statusPeminjaman' WHERE PeminjamanID='$peminjamanID'";
    if ($conn->query($query_update) === TRUE) {
        $notif = '<div class="alert alert-success" role="alert">Data peminjaman berhasil diperbarui!</div>';
        echo '<script>window.location.href = "peminjaman.php";</script>';
    } else {
        $notif = '<div class="alert alert-danger" role="alert">Error: ' . $sql_update . '<br>' . $conn->error . '</div>';
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query_select = "SELECT * FROM peminjaman WHERE PeminjamanID='$id'";
    $result = $conn->query($query_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peminjaman</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4 mb-4">Edit Peminjaman</h2>
        <?php echo $notif; ?> <!-- Menampilkan notifikasi di sini -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="peminjamanID" value="<?php echo $row["PeminjamanID"]; ?>">
            <div class="form-group">
                <label for="userID">Username Pengguna:</label>
                <select class="form-control" id="userID" name="userID">
                    <?php
                    $query_user = "SELECT UserID, Username FROM user";
                    $result_user = $conn->query($query_user);
                    if ($result_user->num_rows > 0) {
                        while($user = $result_user->fetch_assoc()) {
                            echo '<option value="' . $user["UserID"] . '"';
                            if ($user["UserID"] == $row["UserID"]) {
                                echo ' selected';
                            }
                            echo '>' . $user["Username"] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="bukuID">Judul Buku:</label>
                <select class="form-control" id="bukuID" name="bukuID">
                    <?php
                    $query_buku = "SELECT BukuID, Judul FROM buku";
                    $result_buku = $conn->query($query_buku);
                    if ($result_buku->num_rows > 0) {
                        while($buku = $result_buku->fetch_assoc()) {
                            echo '<option value="' . $buku["BukuID"] . '"';
                            if ($buku["BukuID"] == $row["BukuID"]) {
                                echo ' selected';
                            }
                            echo '>' . $buku["Judul"] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tanggalPeminjaman">Tanggal Peminjaman:</label>
                <input type="date" class="form-control" id="tanggalPeminjaman" name="tanggalPeminjaman" value="<?php echo $row["tanggalPeminjaman"]; ?>">
            </div>
            <div class="form-group">
                <label for="tanggalPengembalian">Tanggal Pengembalian:</label>
                <input type="date" class="form-control" id="tanggalPengembalian" name="tanggalPengembalian" value="<?php echo $row["TanggalPengembalian"]; ?>">
            </div>
            <div class="form-group">
                <label for="statusPeminjaman">Status Peminjaman:</label>
                <select class="form-control" id="statusPeminjaman" name="statusPeminjaman">
                    <option value="Belum Kembali" <?php if($row["StatusPeminjaman"] == "Belum Kembali") echo "selected"; ?>>Belum Kembali</option>
                    <option value="Sudah Kembali" <?php if($row["StatusPeminjaman"] == "Sudah Kembali") echo "selected"; ?>>Sudah Kembali</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <a href="peminjaman.php" class="btn btn-secondary">Kembali ke peminjaman</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
    } else {
        echo '<div class="alert alert-danger" role="alert">Data peminjaman tidak ditemukan.</div>';
    }
}
?>
