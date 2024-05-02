-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Sep 2022 pada 19.41
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `nip` char(20) NOT NULL,
  `nama_guru` varchar(30) NOT NULL,
  `ttl` varchar(50) NOT NULL,
  `no_guru` char(13) NOT NULL,
  `status_guru` varchar(20) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan','','') NOT NULL,
  `gambar_guru` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`nip`, `nama_guru`, `ttl`, `no_guru`, `status_guru`, `jenis_kelamin`, `gambar_guru`) VALUES
('1111', 'rolisana', 'kutacane, 18-03-1970', '082324565473', 'wali kelas', 'Laki-Laki', 'Wahyu.Putra.jpg'),
('196702121993031006', 'usman', 'tebo, 19-01-1970', '082324565472', 'wali kelas', 'Laki-Laki', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `kd_jadwal` varchar(8) NOT NULL,
  `kd_mp` varchar(8) NOT NULL,
  `nip` char(20) NOT NULL,
  `kd_kelas` varchar(8) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `jam_mulai` varchar(5) NOT NULL,
  `jam_selesai` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`kd_jadwal`, `kd_mp`, `nip`, `kd_kelas`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
('004', 'BI01', '196702121993031006', '03', 'senin', '08.00', '09.00'),
('0111', 'PJOK01', '1111', '01', 'senin', '08.00', '09.00'),
('0222', 'PJOK01', '196702121993031006', '06', 'selasa', '08.00', '09.00'),
('0333', 'MTK01', '1111', '02', 'selasa', '08.00', '09.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `kd_kelas` varchar(8) NOT NULL,
  `nama_kelas` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`kd_kelas`, `nama_kelas`) VALUES
('01', '01'),
('02', '02'),
('03', '03'),
('04', '04'),
('05', '05'),
('06', '06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `kd_mp` varchar(8) NOT NULL,
  `nama_mp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`kd_mp`, `nama_mp`) VALUES
('AG01', 'Agama'),
('BI01', 'Bahasa Indonesia'),
('MTK01', 'Matematika'),
('PJOK01', 'Pendididkan Jasmani, Olahraga, Dan Kesehatan'),
('PKN01', 'Pendidikan Kewarga Negaraan'),
('SBD01', 'Seni Budata dan Prakarya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(8) NOT NULL,
  `nisn` char(20) NOT NULL,
  `kd_mp` varchar(8) NOT NULL,
  `harian` varchar(3) NOT NULL,
  `ulangan` varchar(3) NOT NULL,
  `ujian` varchar(3) NOT NULL,
  `semester` enum('ganjil','genap','','') NOT NULL,
  `kd_tahun` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `nisn`, `kd_mp`, `harian`, `ulangan`, `ujian`, `semester`, `kd_tahun`) VALUES
(44, '5180411244', 'AG01', '80', '80', '80', 'ganjil', '2021'),
(45, '5180411244', 'AG01', '90', '70', '56', 'ganjil', '2022');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nisn` char(20) NOT NULL,
  `nama_siswa` varchar(30) NOT NULL,
  `jk_siswa` enum('Laki-Laki','Perempuan','','') NOT NULL,
  `kd_kelas` varchar(8) NOT NULL,
  `ttl` varchar(50) NOT NULL,
  `wali` varchar(30) NOT NULL,
  `no_hp` char(13) NOT NULL,
  `gambar_siswa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nisn`, `nama_siswa`, `jk_siswa`, `kd_kelas`, `ttl`, `wali`, `no_hp`, `gambar_siswa`) VALUES
('001', 'Midoriya', 'Laki-Laki', '01', 'tebo, 19-01-1970', 'keke', '085295498617', 'bocil.jpeg'),
('5180411244', 'Wahyu Putra', 'Laki-Laki', '01', 'tebo, 19-01-1970', 'neji', '085295498617', 'bocil.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun`
--

CREATE TABLE `tahun` (
  `kd_tahun` varchar(15) NOT NULL,
  `tahun_ajaran` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tahun`
--

INSERT INTO `tahun` (`kd_tahun`, `tahun_ajaran`) VALUES
('2021', '2021/2022'),
('2022', '2022/2023');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `kd_user` int(20) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password1` varchar(80) NOT NULL,
  `level` enum('admin','guru','siswa','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`kd_user`, `username`, `password1`, `level`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, '1111', 'guru', 'guru'),
(3, '001', 'siswa', 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`kd_jadwal`),
  ADD KEY `kd_kelas` (`kd_kelas`),
  ADD KEY `jadwal_ibfk_2` (`nip`),
  ADD KEY `kd_mp` (`kd_mp`,`nip`,`kd_kelas`) USING BTREE;

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kd_kelas`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`kd_mp`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `nisn` (`nisn`,`kd_mp`),
  ADD KEY `kd_mp` (`kd_mp`),
  ADD KEY `kd_tahun` (`kd_tahun`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `kd_kelas` (`kd_kelas`) USING BTREE;

--
-- Indeks untuk tabel `tahun`
--
ALTER TABLE `tahun`
  ADD PRIMARY KEY (`kd_tahun`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`kd_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `kd_user` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`kd_kelas`) REFERENCES `kelas` (`kd_kelas`),
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `guru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`kd_mp`) REFERENCES `mapel` (`kd_mp`);

--
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`kd_mp`) REFERENCES `mapel` (`kd_mp`),
  ADD CONSTRAINT `nilai_ibfk_3` FOREIGN KEY (`kd_tahun`) REFERENCES `tahun` (`kd_tahun`);

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kd_kelas`) REFERENCES `kelas` (`kd_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
