<?php
include 'koneksi.php';

$type = isset($_GET['type']) ? $_GET['type'] : '';

if ($type === 'peminjaman') {
    $query = "SELECT user.Username, buku.Judul, peminjaman.tanggalPeminjaman, peminjaman.TanggalPengembalian, peminjaman.StatusPeminjaman FROM peminjaman INNER JOIN user ON peminjaman.UserID = user.UserID INNER JOIN buku ON peminjaman.BukuID = buku.BukuID";
} elseif ($type === 'koleksi') {
    $query = "SELECT user.Username, buku.Judul FROM koleksipribadi INNER JOIN user ON koleksipribadi.UserID = user.UserID INNER JOIN buku ON koleksipribadi.BukuID = buku.BukuID";
}

if(isset($query)) {
    $result = $conn->query($query);
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode(['data' => $data]);
} else {
    echo json_encode(['data' => []]); // Jika query tidak terdefinisi, kembalikan array kosong
}
?>
