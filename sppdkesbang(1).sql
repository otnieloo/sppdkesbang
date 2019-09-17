-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Sep 2019 pada 18.10
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sppdkesbang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggaran`
--

CREATE TABLE `anggaran` (
  `id_anggaran` int(25) NOT NULL,
  `kode_anggaran` varchar(25) NOT NULL,
  `uraian` varchar(1000) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `target_kinerja` varchar(500) NOT NULL,
  `sumber_dana` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggaran`
--

INSERT INTO `anggaran` (`id_anggaran`, `kode_anggaran`, `uraian`, `lokasi`, `target_kinerja`, `sumber_dana`) VALUES
(1, '4.01.44.01.1', 'Program Pelayanan Administrasi Perkantoran						\r\n', '', '', ''),
(2, '4.01.44.01.1.2', 'Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik					\r\n\r\n', '', '', ''),
(3, '4.01.44.01.1.8', 'Penyediaan Jasa Kebersihan Kantor					\r\n', '', '', ''),
(4, '4.01.44.01.1.10', 'Penyediaan Alat Tulis Kantor					\r\n\r\n', '', '', ''),
(5, '4.01.44.01.1.11', 'Penyediaan Barang Cetakan dan Penggandaan					\r\n', '', '', ''),
(6, '4.01.44.01.1.13', 'Penyediaan Peralatan dan Perlengkapan Kantor					\r\n', '', '', ''),
(7, '4.01.44.01.1.15', 'Penyediaan Bahan Bacaan dan Peraturan Perundang-undangan					\r\n					\r\n', '', '', ''),
(8, '4.01.44.01.1.17', 'Penyediaan Makanan dan Minuman			', '', '', ''),
(9, '4.01.44.01.1.19', 'Penyediaan Jasa Tenaga Pendukung Administrasi / Teknis Perkantoran				', '', '', ''),
(10, '4.01.44.01.1.20', 'Penyediaan Jasa Pengamanan Kantor					\r\n', '', '', ''),
(11, '4.01.44.01.1.29', 'Rapat-rapat Koordinasi dan Konsultasi', '', '', ''),
(12, '4.01.44.01.2', 'Program Peningkatan Sarana dan Prasarana Aparatur				', '', '', ''),
(13, '4.01.44.01.2.5', 'Pengadaan Kendaraan Dinas/Operasional', '', '', ''),
(14, '4.01.44.01.2.22', 'Pemeliaharaan Rutin/Berkala Gedung Kantor					\r\n', '', '', ''),
(15, '4.01.44.01.2.24', 'Pemeliaharaan Rutin/Berkala Kendaraan Dinas/Operasional					\r\n					\r\n', '', '', ''),
(16, '4.01.44.01.2.28', 'Pemeliaharaan Rutin/Berkala Peralatan Gedung Kantor				', '', '', ''),
(17, '4.01.44.01.3', 'Program Peningkatan Disiplin Aparatur						\r\n', '', '', ''),
(18, '4.01.44.01.3.2', 'Pengadaan Pakaian Dinas beserta perlengkapanya', '', '', ''),
(19, '4.01.44.01.5', 'Program Peningkatan Kapasitas Sumber Daya Aparatur', '', '', ''),
(20, '4.01.44.01.5.1', 'Pendidikan dan Pelatihan Formal		', '', '', ''),
(21, '4.01.44.01.6', 'Program Peningkatan Pengembangan Sistem Pelaporan Capaian Kinerja dan Keuangan			', '', '', ''),
(22, '4.01.44.01.6.4', 'Penyusunan Laporan Keuangan Akhir Tahun			', '', '', ''),
(23, '4.01.44.01.6.5', 'Penyusunan Laporan Keuangan Bulanan/Tahunan SKPD', '', '', ''),
(24, '4.01.44.01.6.26', 'Penyusunan Dokumen Pelaporan Perangkat Daerah					\r\n', '', '', ''),
(25, '4.01.44.01.7', 'Program Peningkatan Perencanaan dan Penganggaran SKPD', '', '', ''),
(26, '4.01.44.01.7.4', 'Penyusunan Dokumen Perencanaan dan Penganggaran Perangkat Daerah', '', '', ''),
(27, '4.01.44.01.15', 'Program Peningkatan Keamanan dan Kenyamanan Lingkungan			', '', '', ''),
(28, '4.01.44.01.15.15', 'Pengamanan Kunjungan Kerja Presiden RI', '', '', ''),
(29, '4.01.44.01.15.19', 'Penanganan Konflik Sosial', '', '', ''),
(30, '4.01.44.01.15.40', 'Penguatan Pengawasan Orang Asing, Organisasi Masyarakat Asing, Lembaga Asing dan Tenaga Kerja ', '', '', ''),
(31, '4.01.44.01.15.44', 'Peningkatan Keamanan dan Kenyamanan Lingkungan', '', '', ''),
(32, '4.01.44.01.15.45', 'Penanganan Radikalisme', '', '', ''),
(33, '4.01.44.01.17', 'Program Pengembangan Wawasan Kebangsaan', '', '', ''),
(34, '4.01.44.01.17.1', 'Peningkatan Toleransi dan Kerukunan dalam Kehidupan Beragama', '', '', ''),
(35, '4.01.44.01.17.4', 'Pemahaman Wawasan Kebangsaan dan Ketahanan Bangsa', '', '', ''),
(36, '4.01.44.01.17.5', 'Orientasi Wasbang, Tahbang, Pembauran Bangsa dan Deteksi Dini', '', '', ''),
(37, '4.01.44.01.17.9', 'Peningkatan Kesadaran Bela Negara', '', '', ''),
(38, '4.01.44.01.17.10', 'Ekspedisi Budaya dalam Upaya Peningkatan Ketahanan Bangsa dan Wawasan Kebangsaan', '', '', ''),
(39, '4.01.44.01.21', 'Program Pendidikan Politik Masyarakat', '', '', ''),
(40, '4.01.44.01.21.3', 'Koordinasi Forum-Forum Diskusi Politik', '', '', ''),
(41, '4.01.44.01.21.5', 'Diseminasi Arah Kebijakan Ormas, LSM dan OKP', '', '', ''),
(42, '4.01.44.01.21.8', 'Pemantauan Pileg dan Pilpres Tahun 2019 (Banprov)', '', '', ''),
(43, '4.01.44.01.21.14', 'Evaluasi Pengajuan Hibah dan Bantuan Sosial dari Orkemas', '', '', ''),
(44, '4.01.44.01.21.15', 'Verifikasi Pemberian Bantuan Keuangan Kepada Partai Politik', '', '', ''),
(45, '4.01.44.01.21.17', 'Sinergitas Hubungan Antar Lembaga Pemerintahan di Daerah di Bidang Politik', '', '', ''),
(46, '4.01.44.01.21.19', 'Desk Pemilu Legislatif dan Pilpres', '', '', ''),
(47, '4.01.44.01.21.20', 'Pengamanan Tertutup Kunjungan Kerja VVIP', '', '', ''),
(48, '4.01.44.01.21.22', 'Sosialisasi Pemilu untuk Pemilih Pemula', '', '', ''),
(49, '4.01.44.01.21.23', 'Peran Serta Ormas dan Parpol dalam Mensuksekan Pemilu', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(25) NOT NULL,
  `id_sppd` int(255) NOT NULL,
  `hasil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `id_sppd`, `hasil`) VALUES
(1, 5, 'asdsa'),
(2, 6, 'ijbib'),
(3, 8, 'Ketuhanan yang maha esa'),
(5, 12, 'Seru dan menantang,Informatif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(25) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `pangkat` varchar(25) NOT NULL,
  `golongan` varchar(5) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `unit_kerja` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `pangkat`, `golongan`, `jabatan`, `unit_kerja`) VALUES
('196107081985031009', 'Suparto, S.IP ', 'Penata Tk.I', 'III/d', 'Kasi HAL dan PMA', ''),
('196210111987012001', 'Emma Hermayati, S.IP', 'Penata Tk.I', 'III/d', 'Kasubag Tata Usaha', ''),
('196412011986031013', 'Iwan Ridwan, S.IP', 'Pembina Tk.I', 'IV/b', 'Kepala Kantor', ''),
('196510241996011001', 'Dadan Herdiana', 'Penata Muda Tk.I', 'III/b', 'Pengelola Organisasi Politik dan Organisasi Kemasy', ''),
('196703042003121004', 'Gunawan, S.IP', 'Penata', 'III/c', 'Pengelola Barang Milik Negara', ''),
('196908142009062001', 'Ai Nurbaeti, S.IP', 'Penata Muda', 'III/a', 'Bendahara Pengeluaran', ''),
('198006052010011015', 'Yusup Supiana, S.Sos, M.Si', 'Penata Muda Tk.I', 'III/b', 'Analisis Politik Dalam Negri', ''),
('198203092011012001', 'Mariani, S.H', 'Penata Muda Tk.I', 'III/b', 'Kasi Tahbang', ''),
('198206152014101001', 'Jajat Sudrajat', 'Juru Tk.I', 'I/d', 'Pengelola Kepegawaian ', ''),
('198211272010011006', 'Arief Sutrisna W, S.IP', 'Penata ', 'III/c', 'Analisis Kerja', ''),
('198511182011012002', 'Piping Novianti, S.IP, MM', 'Penata Muda Tk.I', 'III/b', 'Analisis Wawasan Kebangsaan', ''),
('198804112019032003', 'Senny Apriani, S.IP', 'Penata Muda ', 'III/a', 'Analisis Kerja', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengikut`
--

CREATE TABLE `pengikut` (
  `id_pengikut` int(25) NOT NULL,
  `id_sppd` int(25) NOT NULL,
  `id_pegawai` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengikut`
--

INSERT INTO `pengikut` (`id_pengikut`, `id_sppd`, `id_pegawai`) VALUES
(0, 6, 2147483647),
(0, 6, 2147483647),
(0, 7, 2147483647),
(0, 7, 2147483647),
(0, 8, 2147483647),
(0, 8, 2147483647),
(0, 9, 2147483647),
(0, 9, 2147483647),
(0, 10, 2147483647),
(0, 10, 2147483647),
(0, 10, 2147483647),
(0, 10, 2147483647),
(0, 10, 2147483647);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ringkasan`
--

CREATE TABLE `ringkasan` (
  `id_ringkasan` int(25) NOT NULL,
  `id_laporan` int(25) NOT NULL,
  `ringkasan` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ringkasan`
--

INSERT INTO `ringkasan` (`id_ringkasan`, `id_laporan`, `ringkasan`) VALUES
(0, 5, 'sdf'),
(0, 5, 'df');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sppd`
--

CREATE TABLE `sppd` (
  `id_sppd` int(25) NOT NULL,
  `pejabat` varchar(100) NOT NULL,
  `id_pegawai` varchar(25) NOT NULL,
  `maksud` varchar(1000) NOT NULL,
  `alat_angkut` varchar(25) NOT NULL,
  `tempat_berangkat` varchar(100) NOT NULL,
  `tempat_tujuan` varchar(100) NOT NULL,
  `lama_dinas` int(11) NOT NULL,
  `tgl_berangkat` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `id_pengikut` varchar(1000) NOT NULL,
  `instansi` varchar(50) NOT NULL,
  `id_anggaran` int(25) NOT NULL,
  `keterangan` varchar(1000) NOT NULL,
  `no_sppd` varchar(100) NOT NULL,
  `kode_sppd` varchar(100) NOT NULL,
  `tingkat` varchar(50) NOT NULL,
  `tgl_surat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sppd`
--

INSERT INTO `sppd` (`id_sppd`, `pejabat`, `id_pegawai`, `maksud`, `alat_angkut`, `tempat_berangkat`, `tempat_tujuan`, `lama_dinas`, `tgl_berangkat`, `tgl_kembali`, `id_pengikut`, `instansi`, `id_anggaran`, `keterangan`, `no_sppd`, `kode_sppd`, `tingkat`, `tgl_surat`) VALUES
(5, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 's', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'Ruang Rapat Aula Wiradadaha Lt. 2 Bappeda Kabupaten Tasikmalaya', 1, '0000-00-00', '0000-00-00', '196107081985031009,198511182011012002', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 18, 'aaa', 'A', 'A', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(6, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asd', 2, '2019-08-22', '2019-08-22', '196107081985031009,198511182011012002', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asd', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(8, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '198511182011012002', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asd', 1, '2018-07-27', '2018-07-27', '196107081985031009,198511182011012002', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 18, 'asd', '123', '13', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(9, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '198211272010011006', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asd', 1, '2018-07-27', '2018-07-27', '196107081985031009,198511182011012002', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 18, 'asdas', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(10, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'adasd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asd', 1, '2018-07-30', '2018-07-30', '196107081985031009,198511182011012002', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 14, 'asd', '123', '123', 'Dalam Daerah - Wilayah III', '0000-00-00'),
(12, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asd', 2, '2018-08-31', '2018-08-31', '196210111987012001,196412011986031013,196703042003121004,196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 3, 'adasd', 'xxx', 'xxx', 'Dalam Daerah - Wilayah III', '0000-00-00'),
(13, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(14, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(15, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(16, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(17, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(18, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(19, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(20, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(21, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(22, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(23, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(24, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(25, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(26, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(27, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(28, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(29, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(30, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(31, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '0000-00-00'),
(32, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '2019-09-10'),
(33, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '2019-09-10'),
(34, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '2019-09-10'),
(35, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '2019-09-10'),
(36, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asdas', 20, '2019-09-10', '2019-09-30', '196908142009062001,198203092011012001,198206152014101001,198511182011012002,198804112019032003', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 2, 'asda', '123', '123', 'Dalam Daerah - Wilayah I', '2019-09-10'),
(37, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '196107081985031009', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asd', 0, '2019-09-13', '2019-09-13', '196210111987012001,196703042003121004,198203092011012001,198511182011012002', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 15, 'asd', '123', '123', 'Dalam Daerah - Wilayah I', '2019-09-12'),
(38, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '198203092011012001', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asd', 0, '2019-09-13', '2019-09-13', '196210111987012001,196703042003121004,198511182011012002', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 19, 'asd', '123', '123', 'Dalam Daerah - Wilayah III', '2019-09-12'),
(39, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '198203092011012001', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asd', 0, '2019-09-13', '2019-09-13', '196210111987012001,196703042003121004,198511182011012002', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 19, 'asd', '123', '123', 'Dalam Daerah - Wilayah III', '2019-09-12'),
(40, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '198203092011012001', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asd', 0, '2019-09-13', '2019-09-13', '196210111987012001,196703042003121004,198511182011012002', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 19, 'asd', '123', '123', 'Dalam Daerah - Wilayah III', '2019-09-12'),
(41, 'KEPALA KANTOR KESBANG DAN LINMAS KABUPATEN', '198203092011012001', 'asd', 'Kendaraan Dinas', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 'asd', 0, '2019-09-13', '2019-09-13', '196210111987012001,196703042003121004,198511182011012002', 'Kantor Kesbang dan Linmas Kab. Tasikmalaya', 19, 'asd', '123', '123', 'Dalam Daerah - Wilayah III', '2019-09-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spt`
--

CREATE TABLE `spt` (
  `id_spt` int(25) NOT NULL,
  `id_sppd` int(25) NOT NULL,
  `no_spt` varchar(50) NOT NULL,
  `dasar` varchar(1000) NOT NULL,
  `untuk` varchar(1000) NOT NULL,
  `tanggal_surat` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `spt`
--

INSERT INTO `spt` (`id_spt`, `id_sppd`, `no_spt`, `dasar`, `untuk`, `tanggal_surat`) VALUES
(8, 4, '800/___ /III/KBL/2019', 'Surat dari Badan Perencanaan Pembangunan Daerah Kabupaten Tasikmalaya Nomor: ', 'sdfq', '16 Agustus 2019'),
(10, 6, '800/___ /III/KBL/2019', 'Surat dari Badan Perencanaan Pembangunan Daerah Kabupaten Tasikmalaya Nomor: ', 'ASD', '123'),
(11, 5, '800/___ /III/KBL/2019', 'Surat dari Badan Perencanaan Pembangunan Daerah Kabupaten Tasikmalaya Nomor: ', 'asd', 'asd'),
(12, 7, '800/___ /III/KBL/2019', 'Surat dari Badan Perencanaan Pembangunan Daerah Kabupaten Tasikmalaya Nomor: ', 'asd', 'ad');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggaran`
--
ALTER TABLE `anggaran`
  ADD PRIMARY KEY (`id_anggaran`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD UNIQUE KEY `id_sppd` (`id_sppd`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `sppd`
--
ALTER TABLE `sppd`
  ADD PRIMARY KEY (`id_sppd`);

--
-- Indeks untuk tabel `spt`
--
ALTER TABLE `spt`
  ADD PRIMARY KEY (`id_spt`),
  ADD UNIQUE KEY `id_sppd` (`id_sppd`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggaran`
--
ALTER TABLE `anggaran`
  MODIFY `id_anggaran` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `sppd`
--
ALTER TABLE `sppd`
  MODIFY `id_sppd` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `spt`
--
ALTER TABLE `spt`
  MODIFY `id_spt` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
