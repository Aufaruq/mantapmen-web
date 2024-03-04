<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman dan Koleksi Pribadi</title>
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2, h3 {
            margin-bottom: 20px;
            text-align: center;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .button-container button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            background-color: #007bff;
            color: #fff;
        }

        .button-container button:hover {
            background-color: #0056b3;
        }

        .section {
            margin-bottom: 40px;
        }

        table.dataTable {
            width: 100%;
            margin: 0 auto;
            clear: both;
            border-collapse: collapse;
            border-spacing: 0;
        }

        table.dataTable thead th,
        table.dataTable thead td {
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        table.dataTable tbody td {
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
        }

        @media print {
            .button-container {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Laporan Peminjaman dan Koleksi Pribadi</h2>

        <div class="button-container">
            <button id="printButton">Cetak</button>
        </div>

        <div class="section">
            <h3>Daftar Peminjaman</h3>
            <table id="peminjamanTable" class="display">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status Peminjaman</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h3>Daftar Koleksi Pribadi</h3>
            <table id="koleksiTable" class="display">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Judul Buku</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
     <a href="dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#peminjamanTable').DataTable({
                "ajax": "get_data.php?type=peminjaman",
                "columns": [
                    { "data": "Username" },
                    { "data": "Judul" },
                    { "data": "tanggalPeminjaman" },
                    { "data": "TanggalPengembalian" },
                    { "data": "StatusPeminjaman" }
                ]
            });

            $('#koleksiTable').DataTable({
                "ajax": "get_data.php?type=koleksi",
                "columns": [
                    { "data": "Username" },
                    { "data": "Judul" }
                ]
            });

            $('#printButton').on('click', function() {
                window.print();
            });
        });
    </script>
</body>
</html>
