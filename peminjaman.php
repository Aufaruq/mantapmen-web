<?php
include 'koneksi.php';

function tambahPeminjaman($userID, $bukuID, $tanggalPeminjaman, $tanggalPengembalian, $statusPeminjaman) {
    global $conn;

    $query = "INSERT INTO peminjaman (UserID, BukuID, tanggalPeminjaman, TanggalPengembalian, StatusPeminjaman) VALUES ('$userID', '$bukuID', '$tanggalPeminjaman', '$tanggalPengembalian', '$statusPeminjaman')";

    if ($conn->query($query) === TRUE) {
        echo '<div class="alert alert-success" role="alert">Peminjaman berhasil ditambahkan!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error: ' . $query . '<br>' . $conn->error . '</div>';
    }
}

function bacaPeminjaman() {
    global $conn;

    $query = "SELECT peminjaman.PeminjamanID, user.Username, buku.Judul, peminjaman.tanggalPeminjaman, peminjaman.TanggalPengembalian, peminjaman.StatusPeminjaman FROM peminjaman INNER JOIN user ON peminjaman.UserID = user.UserID INNER JOIN buku ON peminjaman.BukuID = buku.BukuID";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<h2 class='mt-4 mb-4'>Daftar Peminjaman</h2>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-striped'>";
        echo "<thead>";
        echo "<tr><th>Username</th><th>Judul Buku</th><th>Tanggal Peminjaman</th><th>Tanggal Pengembalian</th><th>Status Peminjaman</th><th>Aksi</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["Username"]."</td><td>".$row["Judul"]."</td><td>".$row["tanggalPeminjaman"]."</td><td>".$row["TanggalPengembalian"]."</td><td>".$row["StatusPeminjaman"]."</td>";
            echo "<td>";
            if (isset($row["PeminjamanID"])) {
                echo "<a href='?action=edit&id=".$row["PeminjamanID"]."' class='btn btn-primary btn-sm mr-2'>Edit</a>";
                echo "<a href='?action=hapus&id=".$row["PeminjamanID"]."' class='btn btn-danger btn-sm'>Hapus</a>";
            } else {
                echo "Data tidak tersedia";
            }
            echo "</td></tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<div class='alert alert-info' role='alert'>Tidak ada data peminjaman.</div>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST["userID"];
    $bukuID = $_POST["bukuID"];
    $tanggalPeminjaman = $_POST["tanggalPeminjaman"];
    $tanggalPengembalian = $_POST["tanggalPengembalian"];
    $statusPeminjaman = $_POST["statusPeminjaman"];

    tambahPeminjaman($userID, $bukuID, $tanggalPeminjaman, $tanggalPengembalian, $statusPeminjaman);
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action == 'edit') {
        echo "<script>window.location.href='edit_peminjam.php?id=$id';</script>";
        exit;
    } elseif ($action == 'hapus') {
        $query_hapus = "DELETE FROM peminjaman WHERE PeminjamanID='$id'";
        if ($conn->query($query_hapus) === TRUE) {
            echo '<div class="alert alert-success" role="alert">Peminjaman berhasil dihapus!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $query_hapus . '<br>' . $conn->error . '</div>';
        }
    }
}

function getUserOptions() {
    global $conn;
    $options = '';
    $query = "SELECT UserID, Username FROM user";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $options .= '<option value="' . $row["UserID"] . '">' . $row["Username"] . '</option>';
        }
    }
    return $options;
}

function getBookOptions() {
    global $conn;
    $options = '';
    $query = "SELECT BukuID, Judul FROM buku";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $options .= '<option value="' . $row["BukuID"] . '">' . $row["Judul"] . '</option>';
        }
    }
    return $options;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Buku</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4 mb-4">Form Peminjaman Buku</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="userID">Pilih Username:</label>
                <select class="form-control" id="userID" name="userID">
                    <?php echo getUserOptions(); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="bukuID">Pilih Judul Buku:</label>
                <select class="form-control" id="bukuID" name="bukuID">
                    <?php echo getBookOptions(); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tanggalPeminjaman">Tanggal Peminjaman:</label>
                <input type="date" class="form-control" id="tanggalPeminjaman" name="tanggalPeminjaman">
            </div>
            <div class="form-group">
                <label for="tanggalPengembalian">Tanggal Pengembalian:</label>
                <input type="date" class="form-control" id="tanggalPengembalian" name="tanggalPengembalian">
            </div>
            <div class="form-group">
                <label for="statusPeminjaman">Status Peminjaman:</label>
                <select class="form-control" id="statusPeminjaman" name="statusPeminjaman">
                    <option value="Belum Kembali">Belum Kembali</option>
                    <option value="Sudah Kembali">Sudah Kembali</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <?php
        bacaPeminjaman();
        ?>
         <a href="dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
