-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 20, 2018 at 09:11 AM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.2.1-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siakad`
--

-- --------------------------------------------------------

--
-- Table structure for table `entry_khs`
--

CREATE TABLE `entry_khs` (
  `identry_khs` int(11) NOT NULL,
  `table_mahasiswa_nim` varchar(20) NOT NULL,
  `table_matakuliah_kode_matakuliah` varchar(15) NOT NULL,
  `table_nilai_id_nilai` int(11) NOT NULL,
  `sksn` varchar(45) DEFAULT NULL,
  `table_semester_id_semester` int(11) NOT NULL,
  `tahun_ajaran` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `table_blok`
--

CREATE TABLE `table_blok` (
  `id_blok` int(11) NOT NULL,
  `kode_blok` varchar(45) DEFAULT NULL,
  `nama_blok` varchar(45) DEFAULT NULL,
  `table_kurikulum_id_kurikulum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `table_dosen`
--

CREATE TABLE `table_dosen` (
  `id_dosen` int(11) NOT NULL,
  `nidn` varchar(15) DEFAULT NULL,
  `nama_dosen` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(25) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `agama` varchar(15) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `bidang_keahlian` varchar(25) DEFAULT NULL,
  `jabatan` varchar(20) DEFAULT NULL,
  `tlpn` varchar(15) DEFAULT NULL,
  `status` enum('Tetap','Tidak Tetap') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `table_groups`
--

CREATE TABLE `table_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `table_groups`
--

INSERT INTO `table_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `table_jurusan`
--

CREATE TABLE `table_jurusan` (
  `kode_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(25) DEFAULT NULL,
  `jenjang` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `table_koas`
--

CREATE TABLE `table_koas` (
  `nim` varchar(20) NOT NULL,
  `nama_mahasiswa` varchar(45) DEFAULT NULL,
  `tempat_lahir` varchar(25) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` varchar(15) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `angkatan` varchar(10) DEFAULT NULL,
  `sekolah_asal` varchar(25) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `gol_darah` varchar(10) DEFAULT NULL,
  `photo` varchar(25) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_koas`
--

INSERT INTO `table_koas` (`nim`, `nama_mahasiswa`, `tempat_lahir`, `tgl_lahir`, `agama`, `jenis_kelamin`, `alamat`, `angkatan`, `sekolah_asal`, `no_hp`, `gol_darah`, `photo`) VALUES
('123', 'sdasd', 'asdasd', '2017-03-13', 'Islam', 'L', 'asdasd', '1312', 'adasd', '123123', 'A', ''),
('123123', 'asdasdasd', 'adasdasd', '2017-02-27', 'Islam', 'L', 'asdasd', '123123', 'asdasd', '123123123', 'A', 'error7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `table_kurikulum`
--

CREATE TABLE `table_kurikulum` (
  `id_kurikulum` int(11) NOT NULL,
  `tahun` varchar(15) DEFAULT NULL,
  `ket` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table_kurikulum`
--

INSERT INTO `table_kurikulum` (`id_kurikulum`, `tahun`, `ket`) VALUES
(1, '2012', 'kurikulum angkatan 2012-2015'),
(3, '2016', 'Kurikulum Angkatan 2016 - 2017');

-- --------------------------------------------------------

--
-- Table structure for table `table_login_attempts`
--

CREATE TABLE `table_login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `table_mahasiswa`
--

CREATE TABLE `table_mahasiswa` (
  `nim` varchar(20) NOT NULL,
  `nama_mahasiswa` varchar(45) DEFAULT NULL,
  `tempat_lahir` varchar(25) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` varchar(15) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `angkatan` varchar(10) DEFAULT NULL,
  `sekolah_asal` varchar(25) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `gol_darah` varchar(10) DEFAULT NULL,
  `photo` varchar(100) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `table_matakuliah`
--

CREATE TABLE `table_matakuliah` (
  `kode_matakuliah` varchar(15) NOT NULL,
  `nama_matakuliah` varchar(45) DEFAULT NULL,
  `sks` varchar(5) DEFAULT NULL,
  `table_dosen_id_dosen` int(11) NOT NULL,
  `table_blok_id_blok` int(11) NOT NULL,
  `table_semester_id_semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `table_mksyarat`
--

CREATE TABLE `table_mksyarat` (
  `id_mksyarat` int(11) NOT NULL,
  `table_semester_id_semester` int(11) NOT NULL,
  `table_matakuliah_kode_matakuliah` varchar(15) NOT NULL,
  `table_matakuliah_kode_matakuliah1` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `table_nilai`
--

CREATE TABLE `table_nilai` (
  `id_nilai` int(11) NOT NULL,
  `nilai` varchar(10) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `table_mahasiswa_nim` varchar(20) NOT NULL,
  `table_matakuliah_kode_matakuliah` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `table_nilai_stase`
--

CREATE TABLE `table_nilai_stase` (
  `idtable_nilai_stase` int(11) NOT NULL,
  `table_stase_idtable_stase` int(11) NOT NULL,
  `mini_cex` varchar(5) DEFAULT NULL,
  `cbd` varchar(5) DEFAULT NULL,
  `dops` varchar(5) DEFAULT NULL,
  `pylhn` varchar(5) DEFAULT NULL,
  `j_reading` varchar(5) DEFAULT NULL,
  `nform` varchar(15) DEFAULT NULL,
  `ujian_lisan` varchar(5) DEFAULT NULL,
  `n_lisan` varchar(15) DEFAULT NULL,
  `ujian_tulis` varchar(5) DEFAULT NULL,
  `n_tulis` varchar(15) DEFAULT NULL,
  `kondite` varchar(5) DEFAULT NULL,
  `nilai_angka` varchar(8) DEFAULT NULL,
  `nilai_huruf` varchar(5) DEFAULT NULL,
  `table_koas_nim` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_nilai_stase`
--

INSERT INTO `table_nilai_stase` (`idtable_nilai_stase`, `table_stase_idtable_stase`, `mini_cex`, `cbd`, `dops`, `pylhn`, `j_reading`, `nform`, `ujian_lisan`, `n_lisan`, `ujian_tulis`, `n_tulis`, `kondite`, `nilai_angka`, `nilai_huruf`, `table_koas_nim`) VALUES
(1, 1, '68', '60', '67', '70', '66', '39.72', '68', '20.4', '68', '20.4', '70', '60.12', 'C', '123123');

-- --------------------------------------------------------

--
-- Table structure for table `table_nilai_stase_besar`
--

CREATE TABLE `table_nilai_stase_besar` (
  `idtable_nilai_stase` int(11) NOT NULL,
  `table_stase_idtable_stase` int(11) NOT NULL,
  `mini_cex` varchar(5) DEFAULT NULL,
  `mini_cex2` varchar(5) DEFAULT NULL,
  `cbd` varchar(5) DEFAULT NULL,
  `cbd2` varchar(5) DEFAULT NULL,
  `dops` varchar(5) DEFAULT NULL,
  `dops2` varchar(5) DEFAULT NULL,
  `pylhn` varchar(5) DEFAULT NULL,
  `pylhn2` varchar(5) DEFAULT NULL,
  `j_reading` varchar(5) DEFAULT NULL,
  `j_reading2` varchar(5) DEFAULT NULL,
  `nform` varchar(15) DEFAULT NULL,
  `ujian_lisan` varchar(5) DEFAULT NULL,
  `n_lisan` varchar(15) DEFAULT NULL,
  `ujian_tulis` varchar(5) DEFAULT NULL,
  `n_tulis` varchar(15) DEFAULT NULL,
  `kondite` varchar(5) DEFAULT NULL,
  `nilai_angka` varchar(8) DEFAULT NULL,
  `nilai_huruf` varchar(5) DEFAULT NULL,
  `table_koas_nim` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_pa`
--

CREATE TABLE `table_pa` (
  `table_dosen_id_dosen` int(11) NOT NULL,
  `table_mahasiswa_nim` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Stand-in structure for view `table_qkhs`
--
CREATE TABLE `table_qkhs` (
`identry_khs` int(11)
,`nim` varchar(20)
,`nama_mahasiswa` varchar(45)
,`kode_matakuliah` varchar(15)
,`nama_matakuliah` varchar(45)
,`sks` varchar(5)
,`nilai` varchar(10)
,`grade` varchar(10)
,`sksn` varchar(45)
,`nama_semester` varchar(15)
,`tahun_ajaran` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `table_qmatakuliah`
--
CREATE TABLE `table_qmatakuliah` (
`kode_matakuliah` varchar(15)
,`nama_matakuliah` varchar(45)
,`sks` varchar(5)
,`nama_dosen` varchar(50)
,`nama_blok` varchar(45)
,`nama_semester` varchar(15)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `table_qnilai`
--
CREATE TABLE `table_qnilai` (
`id_nilai` int(11)
,`nim` varchar(20)
,`nama_mahasiswa` varchar(45)
,`kode_matakuliah` varchar(15)
,`nama_matakuliah` varchar(45)
,`nilai` varchar(10)
,`grade` varchar(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `table_semester`
--

CREATE TABLE `table_semester` (
  `id_semester` int(11) NOT NULL,
  `nama_semester` varchar(15) DEFAULT NULL,
  `tahun_ajaran` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table_semester`
--

INSERT INTO `table_semester` (`id_semester`, `nama_semester`, `tahun_ajaran`) VALUES
(1, 'I', '2016/2017'),
(2, 'II', '2016/2017'),
(3, 'III', '2016/2017'),
(4, 'IV', '2016/2017'),
(5, 'V', '2016/2017'),
(6, 'VI', '2016/2017'),
(7, 'VII', '2016/2017');

-- --------------------------------------------------------

--
-- Table structure for table `table_smstrskrg`
--

CREATE TABLE `table_smstrskrg` (
  `id_smstrskrg` int(11) NOT NULL,
  `nama_semester_sekarang` varchar(25) DEFAULT NULL,
  `status` enum('aktif','tidak aktif') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_stase`
--

CREATE TABLE `table_stase` (
  `idtable_stase` int(11) NOT NULL,
  `stase` varchar(25) DEFAULT NULL,
  `status` enum('besar','kecil') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `table_ta`
--

CREATE TABLE `table_ta` (
  `idtable_ta` int(11) NOT NULL,
  `tahun_ajaran` varchar(10) DEFAULT NULL,
  `status` enum('aktif','tidak aktif') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_ta`
--

INSERT INTO `table_ta` (`idtable_ta`, `tahun_ajaran`, `status`) VALUES
(1, '2016/2017', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `table_ukmppd`
--

CREATE TABLE `table_ukmppd` (
  `idtable_ukmppd` int(11) NOT NULL,
  `table_koas_nim` varchar(20) NOT NULL,
  `yudisium` enum('lulus','tidak lulus') DEFAULT NULL,
  `buku` text,
  `administrasi` enum('lunas','belum lunas') DEFAULT NULL,
  `ktp` text,
  `akta_kelahiran` text,
  `ktm` text,
  `ijasah_sked` text,
  `ijasah_sma` text,
  `photo` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_ukmppd`
--

INSERT INTO `table_ukmppd` (`idtable_ukmppd`, `table_koas_nim`, `yudisium`, `buku`, `administrasi`, `ktp`, `akta_kelahiran`, `ktm`, `ijasah_sked`, `ijasah_sma`, `photo`) VALUES
(1, '123123', 'lulus', 'asdad', 'lunas', '', '', '', '', '', ''),
(2, '123123', 'lulus', 'asdasd', 'lunas', '', '', '', '', '', ''),
(4, '123123', 'lulus', 'asdasd', 'lunas', NULL, NULL, NULL, NULL, NULL, NULL),
(5, '123123', 'lulus', 'asdasd', 'lunas', '', '', '', '', '', ''),
(6, '123123', 'lulus', 'asd', 'lunas', '', '', '', '', '', ''),
(7, '123123', 'lulus', 'asd', 'lunas', '', '', '', '', '', ''),
(8, '123123', 'lulus', 'dasd', 'lunas', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `table_user`
--

CREATE TABLE `table_user` (
  `uid` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(225) NOT NULL,
  `nama_lengkap` varchar(25) NOT NULL,
  `level` enum('Mahasiswa','Super User','Dosen') NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `table_users`
--

CREATE TABLE `table_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `table_users`
--

INSERT INTO `table_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(9, '::1', 'purjayadi', '$2y$08$VEXkUPpxBXbN.WEGR9DdtuLSvYDMzANj.KYhhx6lgsuhl1qtFrhSi', 'e8kvyoDaFo/2X3GLpSOTpu', 'purjayadi@gmail.com', NULL, NULL, NULL, 'ts/VbDHCPDPS.rP2WrR5Qe', 1497324434, 1514701088, 1, 'pur', 'jayadi', 'fakultas Kedokteran UNIZAR', '082341901641');

-- --------------------------------------------------------

--
-- Table structure for table `table_users_groups`
--

CREATE TABLE `table_users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `table_users_groups`
--

INSERT INTO `table_users_groups` (`id`, `user_id`, `group_id`) VALUES
(14, 9, 1);

-- --------------------------------------------------------

--
-- Structure for view `table_qkhs`
--
DROP TABLE IF EXISTS `table_qkhs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `table_qkhs`  AS  select `entry_khs`.`identry_khs` AS `identry_khs`,`table_mahasiswa`.`nim` AS `nim`,`table_mahasiswa`.`nama_mahasiswa` AS `nama_mahasiswa`,`table_matakuliah`.`kode_matakuliah` AS `kode_matakuliah`,`table_matakuliah`.`nama_matakuliah` AS `nama_matakuliah`,`table_matakuliah`.`sks` AS `sks`,`table_nilai`.`nilai` AS `nilai`,`table_nilai`.`grade` AS `grade`,`entry_khs`.`sksn` AS `sksn`,`table_semester`.`nama_semester` AS `nama_semester`,`entry_khs`.`tahun_ajaran` AS `tahun_ajaran` from ((((`table_mahasiswa` join `table_matakuliah`) join `table_nilai`) join `entry_khs`) join `table_semester`) where ((`entry_khs`.`table_mahasiswa_nim` = `table_mahasiswa`.`nim`) and (`entry_khs`.`table_matakuliah_kode_matakuliah` = `table_matakuliah`.`kode_matakuliah`) and (`entry_khs`.`table_nilai_id_nilai` = `table_nilai`.`id_nilai`) and (`entry_khs`.`table_semester_id_semester` = `table_semester`.`id_semester`)) ;

-- --------------------------------------------------------

--
-- Structure for view `table_qmatakuliah`
--
DROP TABLE IF EXISTS `table_qmatakuliah`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `table_qmatakuliah`  AS  select `table_matakuliah`.`kode_matakuliah` AS `kode_matakuliah`,`table_matakuliah`.`nama_matakuliah` AS `nama_matakuliah`,`table_matakuliah`.`sks` AS `sks`,`table_dosen`.`nama_dosen` AS `nama_dosen`,`table_blok`.`nama_blok` AS `nama_blok`,`table_semester`.`nama_semester` AS `nama_semester` from (((`table_matakuliah` join `table_dosen`) join `table_blok`) join `table_semester`) where ((`table_matakuliah`.`table_dosen_id_dosen` = `table_dosen`.`id_dosen`) and (`table_matakuliah`.`table_blok_id_blok` = `table_blok`.`id_blok`) and (`table_matakuliah`.`table_semester_id_semester` = `table_semester`.`id_semester`)) ;

-- --------------------------------------------------------

--
-- Structure for view `table_qnilai`
--
DROP TABLE IF EXISTS `table_qnilai`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `table_qnilai`  AS  select `table_nilai`.`id_nilai` AS `id_nilai`,`table_mahasiswa`.`nim` AS `nim`,`table_mahasiswa`.`nama_mahasiswa` AS `nama_mahasiswa`,`table_matakuliah`.`kode_matakuliah` AS `kode_matakuliah`,`table_matakuliah`.`nama_matakuliah` AS `nama_matakuliah`,`table_nilai`.`nilai` AS `nilai`,`table_nilai`.`grade` AS `grade` from ((`table_matakuliah` join `table_mahasiswa`) join `table_nilai`) where ((`table_nilai`.`table_mahasiswa_nim` = `table_mahasiswa`.`nim`) and (`table_nilai`.`table_matakuliah_kode_matakuliah` = `table_matakuliah`.`kode_matakuliah`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entry_khs`
--
ALTER TABLE `entry_khs`
  ADD PRIMARY KEY (`identry_khs`),
  ADD KEY `fk_entry_khs_table_mahasiswa1_idx` (`table_mahasiswa_nim`),
  ADD KEY `fk_entry_khs_table_matakuliah1_idx` (`table_matakuliah_kode_matakuliah`),
  ADD KEY `fk_entry_khs_table_nilai1_idx` (`table_nilai_id_nilai`),
  ADD KEY `fk_entry_khs_table_semester1_idx` (`table_semester_id_semester`);

--
-- Indexes for table `table_blok`
--
ALTER TABLE `table_blok`
  ADD PRIMARY KEY (`id_blok`),
  ADD KEY `fk_table_blok_table_kurikulum1_idx` (`table_kurikulum_id_kurikulum`);

--
-- Indexes for table `table_dosen`
--
ALTER TABLE `table_dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `table_groups`
--
ALTER TABLE `table_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_jurusan`
--
ALTER TABLE `table_jurusan`
  ADD PRIMARY KEY (`kode_jurusan`);

--
-- Indexes for table `table_koas`
--
ALTER TABLE `table_koas`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `table_kurikulum`
--
ALTER TABLE `table_kurikulum`
  ADD PRIMARY KEY (`id_kurikulum`);

--
-- Indexes for table `table_login_attempts`
--
ALTER TABLE `table_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_mahasiswa`
--
ALTER TABLE `table_mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `table_matakuliah`
--
ALTER TABLE `table_matakuliah`
  ADD PRIMARY KEY (`kode_matakuliah`),
  ADD KEY `fk_table_matakuliah_table_dosen1_idx` (`table_dosen_id_dosen`),
  ADD KEY `fk_table_matakuliah_table_blok1_idx` (`table_blok_id_blok`),
  ADD KEY `fk_table_matakuliah_table_semester1_idx` (`table_semester_id_semester`);

--
-- Indexes for table `table_mksyarat`
--
ALTER TABLE `table_mksyarat`
  ADD PRIMARY KEY (`id_mksyarat`),
  ADD KEY `fk_table_mksyarat_table_semester1_idx` (`table_semester_id_semester`),
  ADD KEY `fk_table_mksyarat_table_matakuliah1_idx` (`table_matakuliah_kode_matakuliah`),
  ADD KEY `fk_table_mksyarat_table_matakuliah2_idx` (`table_matakuliah_kode_matakuliah1`);

--
-- Indexes for table `table_nilai`
--
ALTER TABLE `table_nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `fk_table_nilai_table_mahasiswa1_idx` (`table_mahasiswa_nim`),
  ADD KEY `fk_table_nilai_table_matakuliah1_idx` (`table_matakuliah_kode_matakuliah`);

--
-- Indexes for table `table_nilai_stase`
--
ALTER TABLE `table_nilai_stase`
  ADD PRIMARY KEY (`idtable_nilai_stase`),
  ADD KEY `fk_table_nilai_stase_table_stase1_idx` (`table_stase_idtable_stase`),
  ADD KEY `fk_table_nilai_stase_table_koas1_idx` (`table_koas_nim`);

--
-- Indexes for table `table_nilai_stase_besar`
--
ALTER TABLE `table_nilai_stase_besar`
  ADD PRIMARY KEY (`idtable_nilai_stase`),
  ADD KEY `fk_table_nilai_stase_table_stase1_idx` (`table_stase_idtable_stase`),
  ADD KEY `fk_table_nilai_stase_besar_table_koas1_idx` (`table_koas_nim`);

--
-- Indexes for table `table_pa`
--
ALTER TABLE `table_pa`
  ADD KEY `fk_table_pa_table_dosen1_idx` (`table_dosen_id_dosen`),
  ADD KEY `fk_table_pa_table_mahasiswa1_idx` (`table_mahasiswa_nim`);

--
-- Indexes for table `table_semester`
--
ALTER TABLE `table_semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indexes for table `table_smstrskrg`
--
ALTER TABLE `table_smstrskrg`
  ADD PRIMARY KEY (`id_smstrskrg`);

--
-- Indexes for table `table_stase`
--
ALTER TABLE `table_stase`
  ADD PRIMARY KEY (`idtable_stase`);

--
-- Indexes for table `table_ta`
--
ALTER TABLE `table_ta`
  ADD PRIMARY KEY (`idtable_ta`);

--
-- Indexes for table `table_ukmppd`
--
ALTER TABLE `table_ukmppd`
  ADD PRIMARY KEY (`idtable_ukmppd`),
  ADD KEY `fk_table_ukmppd_table_koas1_idx` (`table_koas_nim`);

--
-- Indexes for table `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `table_users`
--
ALTER TABLE `table_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_users_groups`
--
ALTER TABLE `table_users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entry_khs`
--
ALTER TABLE `entry_khs`
  MODIFY `identry_khs` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_blok`
--
ALTER TABLE `table_blok`
  MODIFY `id_blok` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_dosen`
--
ALTER TABLE `table_dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_groups`
--
ALTER TABLE `table_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `table_jurusan`
--
ALTER TABLE `table_jurusan`
  MODIFY `kode_jurusan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_kurikulum`
--
ALTER TABLE `table_kurikulum`
  MODIFY `id_kurikulum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `table_login_attempts`
--
ALTER TABLE `table_login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_mksyarat`
--
ALTER TABLE `table_mksyarat`
  MODIFY `id_mksyarat` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_nilai`
--
ALTER TABLE `table_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_nilai_stase`
--
ALTER TABLE `table_nilai_stase`
  MODIFY `idtable_nilai_stase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `table_nilai_stase_besar`
--
ALTER TABLE `table_nilai_stase_besar`
  MODIFY `idtable_nilai_stase` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_semester`
--
ALTER TABLE `table_semester`
  MODIFY `id_semester` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `table_smstrskrg`
--
ALTER TABLE `table_smstrskrg`
  MODIFY `id_smstrskrg` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_stase`
--
ALTER TABLE `table_stase`
  MODIFY `idtable_stase` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_ta`
--
ALTER TABLE `table_ta`
  MODIFY `idtable_ta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `table_ukmppd`
--
ALTER TABLE `table_ukmppd`
  MODIFY `idtable_ukmppd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `table_user`
--
ALTER TABLE `table_user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_users`
--
ALTER TABLE `table_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `table_users_groups`
--
ALTER TABLE `table_users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `entry_khs`
--
ALTER TABLE `entry_khs`
  ADD CONSTRAINT `fk_entry_khs_table_mahasiswa1` FOREIGN KEY (`table_mahasiswa_nim`) REFERENCES `table_mahasiswa` (`nim`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_entry_khs_table_matakuliah1` FOREIGN KEY (`table_matakuliah_kode_matakuliah`) REFERENCES `table_matakuliah` (`kode_matakuliah`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_entry_khs_table_nilai1` FOREIGN KEY (`table_nilai_id_nilai`) REFERENCES `table_nilai` (`id_nilai`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_entry_khs_table_semester1` FOREIGN KEY (`table_semester_id_semester`) REFERENCES `table_semester` (`id_semester`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `table_blok`
--
ALTER TABLE `table_blok`
  ADD CONSTRAINT `fk_table_blok_table_kurikulum1` FOREIGN KEY (`table_kurikulum_id_kurikulum`) REFERENCES `table_kurikulum` (`id_kurikulum`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `table_matakuliah`
--
ALTER TABLE `table_matakuliah`
  ADD CONSTRAINT `fk_table_matakuliah_table_blok1` FOREIGN KEY (`table_blok_id_blok`) REFERENCES `table_blok` (`id_blok`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_table_matakuliah_table_dosen1` FOREIGN KEY (`table_dosen_id_dosen`) REFERENCES `table_dosen` (`id_dosen`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_table_matakuliah_table_semester1` FOREIGN KEY (`table_semester_id_semester`) REFERENCES `table_semester` (`id_semester`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `table_mksyarat`
--
ALTER TABLE `table_mksyarat`
  ADD CONSTRAINT `fk_table_mksyarat_table_matakuliah1` FOREIGN KEY (`table_matakuliah_kode_matakuliah`) REFERENCES `table_matakuliah` (`kode_matakuliah`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_table_mksyarat_table_matakuliah2` FOREIGN KEY (`table_matakuliah_kode_matakuliah1`) REFERENCES `table_matakuliah` (`kode_matakuliah`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_table_mksyarat_table_semester1` FOREIGN KEY (`table_semester_id_semester`) REFERENCES `table_semester` (`id_semester`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `table_nilai`
--
ALTER TABLE `table_nilai`
  ADD CONSTRAINT `fk_table_nilai_table_mahasiswa1` FOREIGN KEY (`table_mahasiswa_nim`) REFERENCES `table_mahasiswa` (`nim`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_table_nilai_table_matakuliah1` FOREIGN KEY (`table_matakuliah_kode_matakuliah`) REFERENCES `table_matakuliah` (`kode_matakuliah`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `table_nilai_stase`
--
ALTER TABLE `table_nilai_stase`
  ADD CONSTRAINT `fk_table_nilai_stase_table_koas1` FOREIGN KEY (`table_koas_nim`) REFERENCES `table_koas` (`nim`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_table_nilai_stase_table_stase1` FOREIGN KEY (`table_stase_idtable_stase`) REFERENCES `table_stase` (`idtable_stase`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `table_nilai_stase_besar`
--
ALTER TABLE `table_nilai_stase_besar`
  ADD CONSTRAINT `fk_table_nilai_stase_besar_table_koas1` FOREIGN KEY (`table_koas_nim`) REFERENCES `table_koas` (`nim`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_table_nilai_stase_table_stase10` FOREIGN KEY (`table_stase_idtable_stase`) REFERENCES `table_stase` (`idtable_stase`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `table_pa`
--
ALTER TABLE `table_pa`
  ADD CONSTRAINT `fk_table_pa_table_dosen1` FOREIGN KEY (`table_dosen_id_dosen`) REFERENCES `table_dosen` (`id_dosen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_table_pa_table_mahasiswa1` FOREIGN KEY (`table_mahasiswa_nim`) REFERENCES `table_mahasiswa` (`nim`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `table_ukmppd`
--
ALTER TABLE `table_ukmppd`
  ADD CONSTRAINT `fk_table_ukmppd_table_koas1` FOREIGN KEY (`table_koas_nim`) REFERENCES `table_koas` (`nim`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `table_users_groups`
--
ALTER TABLE `table_users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `table_groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `table_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
