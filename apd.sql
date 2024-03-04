-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2024 at 03:02 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apd`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `BukuID` int(11) NOT NULL,
  `Judul` varchar(255) DEFAULT NULL,
  `Penulis` varchar(255) DEFAULT NULL,
  `Penerbit` varchar(255) DEFAULT NULL,
  `TahunTerbit` int(11) DEFAULT NULL,
  `Deskripsi` text DEFAULT NULL,
  `KategoriID` int(11) DEFAULT NULL,
  `Gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`BukuID`, `Judul`, `Penulis`, `Penerbit`, `TahunTerbit`, `Deskripsi`, `KategoriID`, `Gambar`) VALUES
(25, 'Pulang Pergi', 'Tere Liye', 'Aufa', 2022, 'pembaca akan diajak buat menyelami romansa keduanya dengan peristiwa yang menegangkan.', 21, 'upload/pulangpergi.png'),
(26, 'Home Sweet Loan', 'Almira Illini Bastari', 'Aufa', 2022, 'Di kisahnya 4 orang sahabat yang bekerja di sebuah perusahaan mengalami persoalan tersendiri dalam hidup mereka', 21, 'upload/Screenshot 2024-03-01 102234.png'),
(27, 'Luka Cita ', 'Valerie Patkar', 'Aufa', 2021, 'mengisahkan tentang tokoh bernama Utara dan Javier.\r\nKeduanya memutuskan buat melepaskan impian mereka yang justru menimbulkan luka', 21, 'upload/Screenshot 2024-03-01 140034.png'),
(28, 'Pachinko', 'Min Jin Lee', 'Aufa', 2022, 'Buku ini mengisahkan romansa berlatarkan tahun 1910-an silam yang mengandung banyak sejarah Korea', 21, 'upload/Screenshot 2024-03-01 140204.png'),
(29, 'MetroPop: Mismatch', 'Arata Kim', 'Aufa', 2022, ' Perjuangan Giovanni untuk meluluhkan hati Kenizia bakalan membuat kalian ikut tenggelam dalam kisah cinta mereka yang bikin baper.', 21, 'upload/Screenshot 2024-03-01 141836.png'),
(30, 'Alan', 'Tamara Biliski', 'Aufa', 2022, 'Fokus utama pada tokoh bernama Meisya Nata Wijaya yang tidak sengaja bertemu Alan Aileen', 21, 'upload/Screenshot 2024-03-01 142003.png'),
(31, '1 Kos, 3 Cinta, 7 Keberuntungan ', 'Astrid Tito', 'Aufa', 2021, 'Ada apa dengan kamar nomor 7 di kosan 7? Mengapa penghuni kamar tersebut selalu berulah dan bermasalah?', 21, 'upload/Screenshot 2024-03-01 142200.png'),
(32, 'Jejak Dedari', 'Erwin Arnada', 'Aufa', 2019, 'Jejak Dedari , terinspirasi dari kehidupan sebuah desa di Bali Utara dengan mayoritas\r\npenduduk bisu tuli', 22, 'upload/Screenshot 2024-03-01 143557.png'),
(33, 'Majapahit Milenia', 'Bre Redana', 'Aufa', 2018, 'Ketika Majapahit jatuh pada abad ke-15 Masehi, dua abdi, Banca dan Naya, sebelum moksha mengeluarkan sumpah bahwa keduanya akan menitis pada individu terpilih, dari masa ke masa', 22, 'upload/Screenshot 2024-03-01 143659.png'),
(34, 'Gadis Pantai', 'Pramoedya Anantatur', 'Aufa', 2020, 'Sebuah buku adalah sebuah kesaksian. Dan buku ini adalah kesaksian tentang peristiwa genosida kemanusiaan paling mengerikan di balik pembangunan Jalan Raya Pos atau yang lebih dikenal dengan Jalan Daendels; jalan yng membentang 1000 kilometer sepanjang utara pulau Jawa.', 22, 'upload/Screenshot 2024-03-01 143822.png'),
(35, 'Mushaf Cinta', ' Amirul Ulum', 'Aufa', 2023, 'Dua tahun setelah kepergian sang ayah, Kiai Jazuli, Neng Azza berhasil menyelesaikan pendidikannya di Nahdlatul Wathan Banat (setingkat SMU), dengan hasil yang sangat memuaskan, Atas keberhasilannya itu, Nahdlatul wathan memberikan beasiswa kepadanya untuk melanjutkan pendidikan ke Mesir, Neng Azza sangat bahagia, keinginannya selama ini untuk memperdalam ilmunya, khususnya gramatika Arab di Mesir terlaksana.', 22, 'upload/Screenshot 2024-03-01 143916.png'),
(36, 'Novus Ordo Seclorum', 'Zaynur Ridwa', 'Aufa', 2019, 'Dalam waktu yang hampir bersamaan, seorang peneliti WHO di Meksiko, seorang pengusaha di Inggris, dan seorang senator di Amerika ditemukan tewas meninggalkan pesan anagram yang sama, serta petunjuk dari symbol bahasa purba yang disebut Codex Magica.', 22, 'upload/Screenshot 2024-03-01 144007.png'),
(37, 'Death Note Short Stories', 'Tsugumi Ohba', 'Aufa', 2020, 'seorang anak laki-laki seusia Light. Ia tidak menggunakannya untuk membunuh penjahat, melainkan mencoba untuk menjualnya untuk penawaran tertinggi dengan desain penipuan cerdik untuk membuatnya lebih banyak uang.', 23, 'upload/Screenshot 2024-03-01 144308.png'),
(38, 'Akasha Record of Ragnarok 06', 'Shinya Umemura dan Takumi Fukui', 'Aufa', 2020, 'Jack the Ripper, sang penjahat terbesar umat manusia, akan melawan pahlawan tergigih, Heracles. Pertarungan epic mereka tentu tak terhindarkan, yaitu Pembunuh berantai terkejam vs Pahlawan dalam legenda!', 23, 'upload/Screenshot 2024-03-01 144512.png'),
(39, 'One Piece 98', 'Eiichiro Oda', 'Aufa', 20222, 'Sebuah wiracarita tentang para samurai gagah berani berencana membalaskan dendam atas kematian tuan mereka, Asano Naganori. Setelah berhasil membalas dendam dengan membunuh Kira Yoshinaka, biang keladi terbunuhnya Asano Naganori, seluruh samurai pengikut Naganori menyerahkan diri kepada otoritas dan dihukum seppuku oleh shogun yang berkuasa.', 23, 'upload/Screenshot 2024-03-01 144600.png'),
(40, 'Blue Lock 01', 'Muneyuki Kaneshiro dan Yusuke Nomura', 'Aufa', 2023, 'Blue Lock merupakan manga bertema olahraga, tepatnya sepak bola, yang rilis pertama kali pada 1 Agustus 2018 di majalah Weekly Shonen Magazine. Mengisahkan tentang seorang laki-laki bernama Isagi Yoichi yang masuk sebuah lembaga sepakbola bernama Japan Football Union (JFU), bersama 299 peserta lainnya untuk mengembangkan bakat dan ego mereka demi menjadi seorang striker terbaik yang selalu haus akan kemenangan.', 23, 'upload/Screenshot 2024-03-01 144645.png'),
(41, 'Tokyo Revengers 01', 'Ken Wakui', 'Aufa', 2023, 'Mengisahkan perjalanan waktu Takemichi dalam merubah nasibnya dan orang yang ia cintai, Hinata. Satu-satunya gadis yang pernah dipacari dalam hidupnya saat mereka SMP, namun dibunuh oleh Geng Tokyo Manji, aliansi berandalan yang bahkan tidak bisa ditangani polisi.', 23, 'upload/Screenshot 2024-03-01 144731.png'),
(42, 'Jujutsu Kaisen 05', 'Gege Akutami', 'Aufa', 2021, 'Todo yang gemar berkelahi segera menyerang pihak Tokyo. Saat Todo dan Itadori saling berhadapan, anak-anak Kyoto yang lain ikut mengepung Itadori dengan niat untuk membunuhnya! Tapi jangan tegang dulu Grameds, selain penuh aksi kamu juga akan dibuat terbahak oleh komik satu ini.', 23, 'upload/Screenshot 2024-03-01 161015.png');

-- --------------------------------------------------------

--
-- Table structure for table `kategoribuku`
--

CREATE TABLE `kategoribuku` (
  `KategoriID` int(11) NOT NULL,
  `NamaKategori` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategoribuku`
--

INSERT INTO `kategoribuku` (`KategoriID`, `NamaKategori`) VALUES
(21, 'Romance'),
(22, 'Sejarah'),
(23, 'komik');

-- --------------------------------------------------------

--
-- Table structure for table `kategoribuku_relasi`
--

CREATE TABLE `kategoribuku_relasi` (
  `KategoriBukuID` int(11) DEFAULT NULL,
  `BukuID` int(11) DEFAULT NULL,
  `KategoriID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `koleksipribadi`
--

CREATE TABLE `koleksipribadi` (
  `KoleksiID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `BukuID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `koleksipribadi`
--

INSERT INTO `koleksipribadi` (`KoleksiID`, `UserID`, `BukuID`) VALUES
(40, 6, 26),
(41, 6, 35),
(42, 7, 27),
(43, 7, 32),
(44, 7, 42),
(45, 8, 27),
(46, 8, 38),
(47, 8, 39),
(48, 8, 42),
(49, 8, 29),
(50, 8, 42),
(51, 8, 25),
(52, 8, 33),
(53, 9, 27),
(54, 9, 25),
(55, 9, 37),
(56, 9, 37),
(57, 9, 40),
(58, 9, 42),
(59, 9, 28),
(60, 9, 26),
(61, 9, 38),
(62, 10, 26),
(63, 10, 32),
(64, 10, 39),
(65, 10, 42),
(66, 10, 41),
(67, 10, 27),
(68, 10, 29),
(69, 10, 33),
(70, 10, 37),
(71, 10, 36),
(72, 11, 25),
(73, 11, 29),
(74, 11, 34),
(75, 11, 36),
(76, 11, 39),
(77, 11, 40),
(78, 11, 37),
(79, 11, 41),
(80, 11, 42),
(81, 11, 27),
(82, 11, 27),
(83, 11, 25),
(84, 11, 33),
(85, 11, 35),
(86, 11, 38);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `PeminjamanID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `BukuID` int(11) DEFAULT NULL,
  `tanggalPeminjaman` date DEFAULT NULL,
  `TanggalPengembalian` date DEFAULT NULL,
  `StatusPeminjaman` varchar(50) DEFAULT NULL,
  `type` enum('peminjaman','pengembalian') NOT NULL DEFAULT 'peminjaman'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`PeminjamanID`, `UserID`, `BukuID`, `tanggalPeminjaman`, `TanggalPengembalian`, `StatusPeminjaman`, `type`) VALUES
(9, 6, 26, '2024-03-04', '2024-03-05', 'Sudah Kembali', 'peminjaman'),
(10, 7, 42, '2024-03-04', '2024-03-05', 'Belum Kembali', 'peminjaman'),
(11, 8, 40, '2024-03-05', '2024-03-08', 'Belum Kembali', 'peminjaman'),
(12, 8, 29, '2024-03-05', '2024-03-16', 'Belum Kembali', 'peminjaman'),
(13, 8, 28, '2024-03-07', '2024-03-21', 'Belum Kembali', 'peminjaman'),
(14, 9, 31, '2024-03-12', '2024-03-22', 'Belum Kembali', 'peminjaman'),
(15, 9, 42, '2024-03-06', '2024-03-08', 'Belum Kembali', 'peminjaman'),
(16, 9, 39, '2024-03-13', '2024-03-14', 'Belum Kembali', 'peminjaman'),
(17, 9, 41, '2024-03-06', '2024-03-15', 'Belum Kembali', 'peminjaman'),
(18, 10, 36, '2024-03-09', '2024-03-19', 'Belum Kembali', 'peminjaman'),
(19, 10, 39, '2024-03-07', '2024-03-15', 'Belum Kembali', 'peminjaman'),
(20, 10, 42, '2024-03-06', '2024-03-13', 'Belum Kembali', 'peminjaman'),
(21, 10, 37, '2024-03-14', '2024-03-16', 'Sudah Kembali', 'peminjaman'),
(22, 10, 35, '2024-03-09', '2024-03-14', 'Belum Kembali', 'peminjaman'),
(23, 11, 30, '2024-03-18', '2024-03-05', 'Belum Kembali', 'peminjaman'),
(24, 11, 33, '2024-03-06', '2024-03-14', 'Belum Kembali', 'peminjaman'),
(25, 11, 40, '2024-02-07', '2024-03-12', 'Belum Kembali', 'peminjaman'),
(26, 11, 38, '2024-03-07', '2024-03-07', 'Belum Kembali', 'peminjaman'),
(27, 11, 37, '2024-03-16', '2024-03-22', 'Belum Kembali', 'peminjaman');

-- --------------------------------------------------------

--
-- Table structure for table `ulasanbuku`
--

CREATE TABLE `ulasanbuku` (
  `UlasanID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `BukuID` int(11) DEFAULT NULL,
  `Ulasan` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasanbuku`
--

INSERT INTO `ulasanbuku` (`UlasanID`, `UserID`, `BukuID`, `Ulasan`, `rating`) VALUES
(24, 5, 25, 'bukunya bagus banget', 10),
(25, 6, 25, 'bukunya keren', 10),
(26, 7, 25, 'lumayan', 8),
(27, 8, 25, 'Bukunya bagus', 7),
(28, 9, 25, 'Bukunya keren, jadi baper', 9),
(29, 10, 25, 'bukunya bagus, bikin baperr', 7),
(30, 11, 25, 'bukunya mantap, gacor', 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `NamaLengkap` varchar(255) DEFAULT NULL,
  `Alamat` text DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `role` enum('administrator','petugas','peminjam') NOT NULL DEFAULT 'peminjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `Password`, `Email`, `NamaLengkap`, `Alamat`, `img`, `role`) VALUES
(5, 'Aufa', '123', 'faruqabdilah555@gmail.com', 'Ananda Faruq Abdilah', 'Kumpai Batu', 'uploads/Screenshot 2024-03-01 153124.png', 'administrator'),
(6, 'Ridwan', '123', 'ridwanardi@gmail.com', 'Ridwan Ardiansyah', 'Madurejo', 'uploads/Screenshot 2024-03-04 073918.png', 'peminjam'),
(7, 'Alif', '123', 'alifia@gmail.com', 'Alifia', 'jalan', 'uploads/Screenshot 2024-03-04 082148.png', 'peminjam'),
(8, 'Faisal', '123', 'faisal@gmail.com', 'Faisal Faturrahman', 'Kumai', 'uploads/Screenshot 2024-03-04 085136.png', 'peminjam'),
(9, 'Alpin', '123', 'alpin@gmail.com', 'AlpinSaid', 'Madurejo', 'uploads/Screenshot 2024-03-04 085232.png', 'peminjam'),
(10, 'Jordan', '123', 'jordan@gmail.com', 'Jordannn', 'Madurejo', 'uploads/Screenshot 2024-03-04 085521.png', 'peminjam'),
(11, 'Rizky', '123', 'rizky@gmail.com', 'Rizkyy', 'Kampung Baru', 'uploads/Screenshot 2024-03-04 085757.png', 'peminjam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`BukuID`);

--
-- Indexes for table `kategoribuku`
--
ALTER TABLE `kategoribuku`
  ADD PRIMARY KEY (`KategoriID`);

--
-- Indexes for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  ADD KEY `BukuID` (`BukuID`),
  ADD KEY `KategoriID` (`KategoriID`);

--
-- Indexes for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  ADD PRIMARY KEY (`KoleksiID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `BukuID` (`BukuID`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`PeminjamanID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `BukuID` (`BukuID`);

--
-- Indexes for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  ADD PRIMARY KEY (`UlasanID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `BukuID` (`BukuID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `BukuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `kategoribuku`
--
ALTER TABLE `kategoribuku`
  MODIFY `KategoriID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  MODIFY `KoleksiID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `PeminjamanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  MODIFY `UlasanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  ADD CONSTRAINT `kategoribuku_relasi_ibfk_1` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`),
  ADD CONSTRAINT `kategoribuku_relasi_ibfk_2` FOREIGN KEY (`KategoriID`) REFERENCES `kategoribuku` (`KategoriID`);

--
-- Constraints for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  ADD CONSTRAINT `koleksipribadi_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `koleksipribadi_ibfk_2` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`);

--
-- Constraints for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  ADD CONSTRAINT `ulasanbuku_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `ulasanbuku_ibfk_2` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
