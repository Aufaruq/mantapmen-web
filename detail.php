<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

if (isset($_GET['BukuID'])) {
    $book_id = $_GET['BukuID'];
    $sql = "SELECT * FROM buku WHERE BukuID = $book_id";
    $result = $conn->query($sql);
    $query_ulasan = "SELECT ulasanbuku.*, user.Username, user.Img, ulasanbuku.Rating
                 FROM ulasanbuku 
                 INNER JOIN user ON ulasanbuku.UserID = user.UserID
                 WHERE ulasanbuku.BukuID = $book_id";
    $result_ulasan = $conn->query($query_ulasan);
} else {
    header("location: dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ulasan']) && isset($_POST['rating']) && isset($_POST['BukuID'])) {
    $username = $_SESSION['username'];
    $ulasan = $_POST['ulasan'];
    $rating = $_POST['rating'];
    $buku_id = $_POST['BukuID'];

    if (empty($ulasan)) {
        $error_message = "Kolom ulasan harus diisi.";
    } else {
        $query = "SELECT UserID FROM user WHERE Username='$username'";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['UserID'];

            $sql = "INSERT INTO ulasanbuku (UserID, BukuID, Ulasan, Rating) VALUES (?, ?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("iiss", $user_id, $buku_id, $ulasan, $rating);

                if ($stmt->execute()) {
                    header("location: detail.php?BukuID=$buku_id");
                    exit;
                } else {
                    echo "ERROR: Could not execute query: $sql. " . $conn->error;
                }
                $stmt->close();
            } else {
                echo "ERROR: Could not prepare query: $sql. " . $conn->error;
            }
        } else {
            echo "ERROR: Could not fetch user ID.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
        <?php
        if ($result && $result->num_rows > 0) {
            $row_buku = $result->fetch_assoc();
            echo '<h2 class="text-center mb-4">' . $row_buku['Judul'] . '</h2>';
            if (!empty($row_buku['Gambar'])) {
                echo '<img src="' . $row_buku['Gambar'] . '" class="img-fluid mb-4" alt="Gambar Buku">';
            } else {
                echo "<p class='mb-4'>Gambar tidak tersedia.</p>";
            }
            echo "<p>Penulis: " . $row_buku['Penulis'] . "</p>";
            echo "<p>Penerbit: " . $row_buku['Penerbit'] . "</p>";
            echo "<p>Tahun Terbit: " . $row_buku['TahunTerbit'] . "</p>";
            echo "<p>Deskripsi: " . $row_buku['Deskripsi'] . "</p>";

            $kategori_id = $row_buku['KategoriID'];
            $sql_kategori = "SELECT NamaKategori FROM kategoribuku WHERE KategoriID = $kategori_id";
            $result_kategori = $conn->query($sql_kategori);
            if ($result_kategori && $result_kategori->num_rows > 0) {
                $row_kategori = $result_kategori->fetch_assoc();
                echo "<p>Kategori: " . $row_kategori['NamaKategori'] . "</p>";
            }

            echo '<h4 class="mt-5">Ulasan Pengguna:</h4>';
            echo '<div class="table-responsive">';
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Foto Profil</th>';
            echo '<th>Username</th>';
            echo '<th>Ulasan</th>';
            echo '<th>Rating</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            if ($result_ulasan && $result_ulasan->num_rows > 0) {
                while ($row_ulasan = $result_ulasan->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td><img src="' . $row_ulasan['Img'] . '" class="img-thumbnail" style="max-width: 100px;" alt="Foto Profil"></td>';
                    echo '<td>' . $row_ulasan['Username'] . '</td>';
                    echo '<td>' . $row_ulasan['Ulasan'] . '</td>';
                    echo '<td>' . ($row_ulasan['Rating'] ?? 'Belum ada rating') . '</td>';
                    echo '</tr>';
                }
            } else {
                echo "<tr><td colspan='4'>Belum ada ulasan untuk buku ini.</td></tr>";
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';

            if (isset($_SESSION['username'])) {
                echo '<form action="" method="post" class="mt-5" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="ulasan">Ulasan:</label>
                            <textarea class="form-control" id="ulasan" name="ulasan" rows="3"></textarea>
                            <small class="text-danger" id="ulasanError" style="display:none;">Kolom ulasan harus diisi.</small>
                        </div>
                        <div class="form-group">
                            <label for="rating">Rating:</label>
                            <select class="form-control" id="rating" name="rating">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="5">6</option>
                                <option value="5">7</option>
                                <option value="5">8</option>
                                <option value="5">9</option>
                                <option value="5">10</option>
                            </select>
                        </div>
                        <input type="hidden" name="BukuID" value="' . $book_id . '">
                        <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                    </form>';
            }

        } else {
            echo "Buku tidak ditemukan.";
        }
        ?>
        <a href="dashboard.php" class="btn btn-secondary">Kembali ke dashboard</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function validateForm() {
            var ulasan = document.getElementById("ulasan").value.trim();
            if (ulasan === "") {
                document.getElementById("ulasanError").style.display = "block";
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
