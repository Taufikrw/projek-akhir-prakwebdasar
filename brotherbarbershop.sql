-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Apr 2022 pada 19.14
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brotherbarbershop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `book`
--

CREATE TABLE `book` (
  `bookID` int(11) NOT NULL,
  `bookDate` date NOT NULL,
  `bookTime` time NOT NULL,
  `bookDatetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dataCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `userID` int(11) NOT NULL,
  `serviceID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `book`
--

INSERT INTO `book` (`bookID`, `bookDate`, `bookTime`, `bookDatetime`, `dataCreated`, `userID`, `serviceID`, `employeeID`) VALUES
(1, '2022-04-19', '14:00:00', '2022-04-19 07:00:00', '2022-04-18 03:49:01', 1, 1, 1),
(2, '2022-04-19', '11:00:00', '2022-04-19 04:00:00', '2022-04-19 06:22:12', 1, 1, 1),
(3, '2022-04-20', '09:00:00', '2022-04-20 02:00:00', '2022-04-19 06:46:54', 2, 6, 2),
(4, '2022-04-20', '10:00:00', '2022-04-20 03:00:00', '2022-04-19 06:47:30', 2, 5, 2),
(6, '2022-04-19', '19:00:00', '2022-04-19 12:00:00', '2022-04-19 07:07:36', 1, 1, 1),
(7, '2022-04-19', '20:00:00', '2022-04-19 13:00:00', '2022-04-19 08:04:43', 2, 11, 4),
(8, '2022-04-23', '11:00:00', '2022-04-23 04:00:00', '2022-04-23 03:10:02', 1, 1, 1),
(9, '2022-04-23', '13:00:00', '2022-04-23 06:00:00', '2022-04-23 03:11:45', 1, 13, 1),
(10, '2022-04-22', '09:00:00', '2022-04-22 02:00:00', '2022-04-23 03:11:58', 1, 1, 1),
(12, '2022-04-26', '09:00:00', '2022-04-26 02:00:00', '2022-04-25 15:59:44', 2, 1, 1),
(13, '2022-04-26', '10:00:00', '2022-04-26 03:00:00', '2022-04-25 16:25:33', 1, 1, 1),
(14, '2022-04-26', '13:00:00', '2022-04-26 06:00:00', '2022-04-25 16:26:10', 1, 19, 1),
(15, '2022-04-26', '14:00:00', '2022-04-26 07:00:00', '2022-04-25 16:28:54', 2, 19, 2),
(17, '2022-04-27', '09:00:00', '2022-04-27 02:00:00', '2022-04-26 16:42:24', 2, 4, 4),
(18, '2022-04-28', '09:00:00', '2022-04-28 02:00:00', '2022-04-26 17:00:12', 2, 16, 1),
(19, '2022-04-28', '10:00:00', '2022-04-28 03:00:00', '2022-04-26 17:01:15', 1, 1, 4),
(20, '2022-04-28', '09:00:00', '2022-04-28 02:00:00', '2022-04-26 17:01:36', 1, 18, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `employee`
--

CREATE TABLE `employee` (
  `employeeID` int(11) NOT NULL,
  `employeeName` varchar(30) NOT NULL,
  `employeeGender` enum('laki-laki','perempuan') NOT NULL,
  `phoneNumber` varchar(13) NOT NULL,
  `employeeDeskripsi` varchar(200) DEFAULT NULL,
  `employeePhoto` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `employee`
--

INSERT INTO `employee` (`employeeID`, `employeeName`, `employeeGender`, `phoneNumber`, `employeeDeskripsi`, `employeePhoto`) VALUES
(1, 'Raffi Ahmad', 'laki-laki', '081650243624', 'Raffi bekerja di BROTHER sejak Maret 2020. Sebelum bekerja di sini, ia sempat menjajal dunia hiburan di tahun 2002 lewat sinetron bertajuk Tunjuk Satu Bintang yang dibintangi oleh sejumlah artis terke', 'pegawai1.jpg'),
(2, 'Nagita Slavina', 'perempuan', '089551882058', 'Nagita Slavina yang akrab dipanggil Gigi ini bekerja di BROTHER dari desember 2020. Ia bekerja di sini karena mengikuti jejak suaminya, yaitu Raffi Ahmad.', 'pegawai4.jpg'),
(3, 'Arya Saloka', 'laki-laki', '088182555935', 'Arya mulai bekerja di BROTHER di bulan januari 2018. Ia memulai kariernya di dunia paskas rambut saat berada di bangku SMP yaitu dengan momotong rambut temannya.', 'pegawai2.jpg'),
(4, 'Rafathar', 'laki-laki', '085778969975', 'Rafathar mulai bekerja di BROTHER pada Januari 2022. Ia bekerja di sini karena terpaksa. Ayah dan ibunya bekerja di sini, sehingga mau tidak mau membuat dia harus bekerja di BROTHER juga.', 'pegawai3.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `service`
--

CREATE TABLE `service` (
  `serviceID` int(11) NOT NULL,
  `serviceName` varchar(50) NOT NULL,
  `serviceLines` varchar(20) NOT NULL,
  `serviceImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `service`
--

INSERT INTO `service` (`serviceID`, `serviceName`, `serviceLines`, `serviceImage`) VALUES
(1, 'Under Cut', 'Haircut', 'undercut.jpg'),
(2, 'Quiff', 'Haircut', 'quiff.jpg'),
(3, 'Crop Out', 'Haircut', 'cropout.jpg'),
(4, 'Fringe Crop', 'Haircut', 'fringecrop.jpg'),
(5, 'Texture Crop', 'Haircut', 'texturecrop.jpg'),
(6, 'Jet Black', 'Hair Coloring', 'jetblack.jpg'),
(7, 'Honey Brown Highlights', 'Hair Coloring', 'honeybrownhighlights.jpg'),
(8, 'Grey', 'Hair Coloring', 'grey.jpg'),
(9, 'Rose Gold', 'Hair Coloring', 'rosegold.jpg'),
(10, 'Warm Hazelnut', 'Hair Coloring', 'warmhazelnut.jpg'),
(11, 'Brunette', 'Hair Coloring', 'brunette.jpg'),
(12, 'Copper Red', 'Hair Coloring', 'copperred.jpg'),
(13, 'Pastel Pink', 'Hair Coloring', 'pastelpink.jpg'),
(14, 'Burgundy', 'Hair Coloring', 'burgundy.jpg'),
(15, 'Fiery Red', 'Hair Coloring', 'fieryred.jpg'),
(16, 'Shaving', 'Shaving', 'shaving.jpg'),
(17, 'Smooting Pendek Tanpa Poni', 'Smooting', 'rambutpendektanpaponi.jpg'),
(18, 'Smooting Klasik Belah Samping', 'Smooting', 'smootingklasikbelahsamping.jpg'),
(19, 'Smooting Blow Pendek', 'Smooting', 'smootingblowpendek.jpg'),
(20, 'Smooting Dora', 'Smooting', 'smootingdora.jpg'),
(21, 'Smooting Panjang Poni Belah Tengah', 'Smooting', 'smootingpanjangponibelahtengah.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `servicelines`
--

CREATE TABLE `servicelines` (
  `serviceLines` varchar(20) NOT NULL,
  `servicePrice` int(11) NOT NULL,
  `serviceIcon` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `servicelines`
--

INSERT INTO `servicelines` (`serviceLines`, `servicePrice`, `serviceIcon`) VALUES
('Hair Coloring', 50000, 'iconhaircoloring.png'),
('Haircut', 20000, 'iconhaircut.png'),
('Shaving', 40000, 'iconshaving.png'),
('Smooting', 50000, 'iconsmooting.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `customerName` varchar(30) NOT NULL,
  `customerGender` enum('laki-laki','perempuan') NOT NULL,
  `phoneNumber` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `customerName`, `customerGender`, `phoneNumber`) VALUES
(1, 'siapa', '$2y$10$MYq4anIzS0vebxw2XYCPI.Ht7m20qskpiv56lwjlWwvvVdV8wxdfq', 'siapaaja', 'laki-laki', '081122223333'),
(2, 'admin', '$2y$10$M4XJVpr9aayFkIr64cBTt.bp31MisUKj.jEKLgfk1l2xZFPIE175W', 'siapa coba', 'laki-laki', '081192227888'),
(3, 'miftah', '$2y$10$be7cYwvCedHbbvUN.jWG8eFosCwrArAB6QvFXCMKcuI6FARHvKO3u', 'miftah', 'laki-laki', '0811922278888');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bookID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `employeeID` (`employeeID`),
  ADD KEY `serviceID` (`serviceID`);

--
-- Indeks untuk tabel `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeID`);

--
-- Indeks untuk tabel `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`serviceID`),
  ADD KEY `serviceLines` (`serviceLines`);

--
-- Indeks untuk tabel `servicelines`
--
ALTER TABLE `servicelines`
  ADD PRIMARY KEY (`serviceLines`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `book`
--
ALTER TABLE `book`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `service`
--
ALTER TABLE `service`
  MODIFY `serviceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`),
  ADD CONSTRAINT `book_ibfk_3` FOREIGN KEY (`serviceID`) REFERENCES `service` (`serviceID`);

--
-- Ketidakleluasaan untuk tabel `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`serviceLines`) REFERENCES `servicelines` (`serviceLines`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
