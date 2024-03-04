<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

$username = $_SESSION['username'];
$query = "SELECT * FROM user WHERE Username='$username'";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "User not found!";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $gambar_name = $_FILES['foto']['name'];
        $gambar_tmp = $_FILES['foto']['tmp_name'];
        $gambar_path = 'uploads/' . $gambar_name;

        if (move_uploaded_file($gambar_tmp, $gambar_path)) {
            $update_query = "UPDATE user SET Email='{$_POST['email']}', NamaLengkap='{$_POST['nama_lengkap']}', Alamat='{$_POST['alamat']}', Img='$gambar_path' WHERE Username='$username'";
            if ($conn->query($update_query) === TRUE) {
                echo "<script>alert('Profil berhasil diperbarui');</script>";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Gagal mengunggah gambar.";
        }
    } else {
        $gambar_path = '';
        $update_query = "UPDATE user SET Email='{$_POST['email']}', NamaLengkap='{$_POST['nama_lengkap']}', Alamat='{$_POST['alamat']}' WHERE Username='$username'";
        if ($conn->query($update_query) === TRUE) {
            echo "<script>alert('Profil berhasil diperbarui');</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4">Profil Pengguna</h2>

        <div class="text-center mb-3">
            <img src="<?php echo isset($row['img']) ? $row['img'] : 'placeholder.jpg'; ?>" class="img-thumbnail" style="max-width: 100px;" alt="Foto Profil">
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="foto">Foto Profil:</label>
                <input type="file" class="form-control-file" id="foto" name="foto">
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" value="<?php echo $row['Username']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['Email']; ?>">
            </div>
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap:</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $row['NamaLengkap']; ?>">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea class="form-control" id="alamat" name="alamat"><?php echo $row['Alamat']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
