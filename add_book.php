<?php
include 'koneksi.php';

$sql_kategori = "SELECT * FROM kategoribuku";
$result_kategori = $conn->query($sql_kategori);
$kategoribuku_options = '';
if ($result_kategori->num_rows > 0) {
    while ($row_kategori = $result_kategori->fetch_assoc()) {
        $kategoribuku_options .= '<option value="' . $row_kategori["KategoriID"] . '">' . $row_kategori["NamaKategori"] . '</option>';
    }
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah_buku'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $deskripsi = $_POST['deskripsi'];
    $kategori_id = $_POST['kategori_id'];

    if ($_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $gambar_name = $_FILES['gambar']['name'];
        $gambar_tmp = $_FILES['gambar']['tmp_name'];
        $gambar_path = 'upload/' . $gambar_name;

        move_uploaded_file($gambar_tmp, $gambar_path);
    } else {
        $gambar_path = '';
    }

    $sql = "INSERT INTO buku (Judul, Penulis, Penerbit, TahunTerbit, Deskripsi, KategoriID, Gambar) 
            VALUES ('$judul', '$penulis', '$penerbit', '$tahun_terbit', '$deskripsi', '$kategori_id', '$gambar_path')";

    if ($conn->query($sql) === TRUE) {
        $message = '<div class="alert alert-success" role="alert">Data buku berhasil ditambahkan!</div>';
    } else {
        $message = '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_buku'])) {
    $buku_id = $_POST['buku_id'];
    $judul = isset($_POST['judul']) ? $_POST['judul'] : '';
    $penulis = isset($_POST['penulis']) ? $_POST['penulis'] : '';
    $penerbit = isset($_POST['penerbit']) ? $_POST['penerbit'] : '';
    $tahun_terbit = isset($_POST['tahun_terbit']) ? $_POST['tahun_terbit'] : '';
    $deskripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';
    $kategori_id = isset($_POST['kategori_id']) ? $_POST['kategori_id'] : '';

    $sql_update = "UPDATE buku SET Judul='$judul', Penulis='$penulis', Penerbit='$penerbit', TahunTerbit='$tahun_terbit', Deskripsi='$deskripsi', KategoriID='$kategori_id' WHERE BukuID='$buku_id'";

    if ($conn->query($sql_update) === TRUE) {
        $message = '<div class="alert alert-success" role="alert">Data buku berhasil diperbarui!</div>';
    } else {
        $message = '<div class="alert alert-danger" role="alert">Error: ' . $sql_update . '<br>' . $conn->error . '</div>';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hapus_buku'])) {
    $buku_id = $_POST['buku_id'];

    $sql_delete = "DELETE FROM buku WHERE BukuID='$buku_id'";

    if ($conn->query($sql_delete) === TRUE) {
        $message = '<div class="alert alert-success" role="alert">Data buku berhasil dihapus!</div>';
    } else {
        $message = '<div class="alert alert-danger" role="alert">Error: ' . $sql_delete . '<br>' . $conn->error . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Perpustakaan Digital</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-edit {
            display: none;
        }
    </style>
    <script>
        function showEditForm(buku_id) {
            var formId = "form-edit-" + buku_id;
            var form = document.getElementById(formId);
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>
</head>

<body>
    <div class="container mt-5">
        <h2>Tambah Buku</h2>
        <?php echo $message; ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" class="form-control" placeholder="Judul" required>
            </div>
            <div class="form-group">
                <label for="penulis">Penulis</label>
                <input type="text" name="penulis" class="form-control" placeholder="Penulis" required>
            </div>
            <div class="form-group">
                <label for="penerbit">Penerbit</label>
                <input type="text" name="penerbit" class="form-control" placeholder="Penerbit" required>
            </div>
            <div class="form-group">
                <label for="tahun_terbit">Tahun Terbit</label>
                <input type="number" name="tahun_terbit" class="form-control" placeholder="Tahun Terbit" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" placeholder="Deskripsi" required></textarea>
            </div>
            <div class="form-group">
                <label for="kategori_id">Kategori Buku</label>
                <select name="kategori_id" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    <?php echo $kategoribuku_options; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" name="gambar" class="form-control-file" accept="image/*">
            </div>
            <input type="submit" name="tambah_buku" class="btn btn-primary" value="Tambah Buku">
        </form>

        <h2>Daftar Buku</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_buku = "SELECT buku.*, kategoribuku.NamaKategori FROM buku INNER JOIN kategoribuku ON buku.KategoriID = kategoribuku.KategoriID";
                    $result_buku = $conn->query($sql_buku);
                    if ($result_buku->num_rows > 0) {
                        while ($row_buku = $result_buku->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row_buku['Judul'] . '</td>';
                            echo '<td>' . $row_buku['Penulis'] . '</td>';
                            echo '<td>' . $row_buku['Penerbit'] . '</td>';
                            echo '<td>' . $row_buku['TahunTerbit'] . '</td>';
                            echo '<td>' . $row_buku['Deskripsi'] . '</td>';
                            echo '<td>' . $row_buku['NamaKategori'] . '</td>';
                            echo '<td>';
                            echo '<button class="btn btn-sm btn-primary" onclick="showEditForm(' . $row_buku['BukuID'] . ')">Edit</button>';
                            echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '" style="display:inline">';
                            echo '<input type="hidden" name="buku_id" value="' . $row_buku['BukuID'] . '">';
                            echo '<input type="submit" name="hapus_buku" class="btn btn-sm btn-danger" value="Hapus">';
                            echo '</form>';
                            echo '</td>';
                            echo '</tr>';

                            // Form edit untuk setiap buku
                            echo '<tr class="form-edit" id="form-edit-' . $row_buku['BukuID'] . '">';
                            echo '<td colspan="7">';
                            echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '" enctype="multipart/form-data">';
                            echo '<input type="hidden" name="buku_id" value="' . $row_buku['BukuID'] . '">';
                            echo '<div class="form-group">';
                            echo '<label for="judul">Judul</label>';
                            echo '<input type="text" name="judul" class="form-control" value="' . $row_buku['Judul'] . '" required>';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo '<label for="penulis">Penulis</label>';
                            echo '<input type="text" name="penulis" class="form-control" value="' . $row_buku['Penulis'] . '" required>';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo '<label for="penerbit">Penerbit</label>';
                            echo '<input type="text" name="penerbit" class="form-control" value="' . $row_buku['Penerbit'] . '" required>';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo '<label for="tahun_terbit">Tahun Terbit</label>';
                            echo '<input type="number" name="tahun_terbit" class="form-control" value="' . $row_buku['TahunTerbit'] . '" required>';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo '<label for="deskripsi">Deskripsi</label>';
                            echo '<textarea name="deskripsi" class="form-control" required>' . $row_buku['Deskripsi'] . '</textarea>';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo '<label for="kategori_id">Kategori Buku</label>';
                            echo '<select name="kategori_id" class="form-control" required>';
                            echo '<option value="">Pilih Kategori</option>';
                            $result_kategori->data_seek(0); // Reset pointer untuk pengulangan kategori
                            while ($row_kategori = $result_kategori->fetch_assoc()) {
                                $selected = ($row_buku['KategoriID'] == $row_kategori['KategoriID']) ? 'selected' : '';
                                echo '<option value="' . $row_kategori['KategoriID'] . '" ' . $selected . '>' . $row_kategori['NamaKategori'] . '</option>';
                            }
                            echo '</select>';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo '<label for="gambar">Gambar</label>';
                            echo '<input type="file" name="gambar" class="form-control-file" accept="image/*">';
                            echo '</div>';
                            echo '<input type="submit" name="update_buku" class="btn btn-primary" value="Simpan">';
                            echo '</form>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="7">Tidak ada data buku.</td></tr>';
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

