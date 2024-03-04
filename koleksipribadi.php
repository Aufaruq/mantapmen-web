<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$notif = '';
$username = $_SESSION['username'];
$query = "SELECT * FROM user WHERE Username='$username'";

$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "User not found!";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah'])) {
    $userID = $row['UserID']; // Perbaikan di sini
    $bukuID = $_POST["bukuID"];

    $query_insert = "INSERT INTO koleksipribadi (UserID, BukuID) VALUES ('$userID', '$bukuID')";
    if ($conn->query($query_insert) === TRUE) {
        $notif = '<div class="alert alert-success" role="alert">Data koleksi pribadi berhasil ditambahkan!</div>';
    } else {
        $notif = '<div class="alert alert-danger" role="alert">Error: ' . $query_insert . '<br>' . $conn->error . '</div>';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $koleksiID = $_POST["koleksiID"];
    $userID = $row['UserID']; // Perbaikan di sini
    $bukuID = $_POST["bukuID"];

    $query_update = "UPDATE koleksipribadi SET UserID='$userID', BukuID='$bukuID' WHERE KoleksiID='$koleksiID'";
    if ($conn->query($query_update) === TRUE) {
        $notif = '<div class="alert alert-success" role="alert">Data koleksi pribadi berhasil diperbarui!</div>';
    } else {
        $notif = '<div class="alert alert-danger" role="alert">Error: ' . $query_update . '<br>' . $conn->error . '</div>';
    }
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action == 'hapus') {
        $query_delete = "DELETE FROM koleksipribadi WHERE KoleksiID='$id'";
        if ($conn->query($query_delete) === TRUE) {
            $notif = '<div class="alert alert-success" role="alert">Data koleksi pribadi berhasil dihapus!</div>';
        } else {
            $notif = '<div class="alert alert-danger" role="alert">Error: ' . $query_delete . '<br>' . $conn->error . '</div>';
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksi Pribadi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4 mb-4">Koleksi Pribadi</h2>
        <?php echo $notif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <?php if (isset($id)) { ?>
                <input type="hidden" name="koleksiID" value="<?php echo $id; ?>">
            <?php } ?>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" value="<?php echo $username; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="bukuID">Judul Buku:</label>
                <select class="form-control" id="bukuID" name="bukuID">
                    <?php
                    $sql_buku = "SELECT BukuID, Judul FROM buku";
                    $result_buku = $conn->query($sql_buku);
                    if ($result_buku->num_rows > 0) {
                        while ($row_buku = $result_buku->fetch_assoc()) {
                            echo '<option value="' . $row_buku["BukuID"] . '"';
                            if (isset($bukuID) && $row_buku["BukuID"] == $bukuID) echo ' selected';
                            echo '>' . $row_buku["Judul"] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <?php if (!isset($id)) { ?>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
            <?php } else { ?>
                <button type="submit" name="update" class="btn btn-primary">Update Data</button>
            <?php } ?>
        </form>

        <h2 class="mt-4 mb-4">Daftar Koleksi Pribadi</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Judul Buku</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_koleksi = "SELECT kp.KoleksiID, u.Username, b.Judul FROM koleksipribadi kp
                                    INNER JOIN user u ON kp.UserID = u.UserID
                                    INNER JOIN buku b ON kp.BukuID = b.BukuID";
                    $result_koleksi = $conn->query($sql_koleksi);
                    if ($result_koleksi->num_rows > 0) {
                        while ($row_koleksi = $result_koleksi->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row_koleksi["Username"] . '</td>';
                            echo '<td>' . $row_koleksi["Judul"] . '</td>';
                            echo '<td>
                                    <a href="?action=edit&id=' . $row_koleksi["KoleksiID"] . '" class="btn btn-primary btn-sm mr-2">Edit</a>
                                    <a href="?action=hapus&id=' . $row_koleksi["KoleksiID"] . '" class="btn btn-danger btn-sm">Hapus</a>
                                </td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="3">Tidak ada data koleksi pribadi.</td></tr>';
                    }
                    ?>
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
