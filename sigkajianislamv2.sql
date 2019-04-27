-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2019 at 05:01 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sigkajianislamv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `formkajian`
--

CREATE TABLE `formkajian` (
  `id_kajian` int(11) NOT NULL,
  `namakajian` varchar(100) NOT NULL,
  `namapemateri` varchar(255) NOT NULL,
  `namatempat` varchar(255) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `fotoposter` text NOT NULL,
  `fototempat` text NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kelurahan` varchar(25) NOT NULL,
  `kecamatan` varchar(25) NOT NULL,
  `tanggalkajian` date NOT NULL,
  `waktumulai` varchar(30) NOT NULL,
  `waktuselesai` varchar(30) NOT NULL,
  `kuota` varchar(20) NOT NULL,
  `statuspeserta` varchar(20) NOT NULL,
  `statuskajian` varchar(30) NOT NULL,
  `statusberbayar` varchar(20) NOT NULL,
  `Pengelola` varchar(255) NOT NULL,
  `kontakpengelola` varchar(20) NOT NULL,
  `informasi` varchar(255) NOT NULL,
  `id_username` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `formkajian`
--

INSERT INTO `formkajian` (`id_kajian`, `namakajian`, `namapemateri`, `namatempat`, `lat`, `lng`, `fotoposter`, `fototempat`, `alamat`, `kelurahan`, `kecamatan`, `tanggalkajian`, `waktumulai`, `waktuselesai`, `kuota`, `statuspeserta`, `statuskajian`, `statusberbayar`, `Pengelola`, `kontakpengelola`, `informasi`, `id_username`) VALUES
(20, 'Fiqih Perempuan', '', 'Masjid Al Ikhlas', -0.49874, 117.137, 'http://192.168.1.2/SIGKajianIslam/image/poster/IMG_USR(5c51aaad24975).png', 'http://192.168.1.2/SIGKajianIslam/image/tempat/IMG_USR(5c51aaad29158).png', 'Jl Dr Sutomo', '4', '', '2019-01-29', '10.00 WITA', '12.00 WITA', '10.000', 'Perempuan', 'TelahSelesai', 'Rp. 10.000', 'Yayasan Peduli Umat', '0812412421323', 'Membawa Alat Solat dan Sajadah', 2),
(23, 'Solat Berjamaah', '', 'Masjid At Thoriq', -0.501326, 117.139, 'http://192.168.1.2/SIGKajianIslam/image/poster/IMG_USR(5c516cbbaba04).png', 'http://192.168.1.2/SIGKajianIslam/image/tempat/IMG_USR(5c516cbbac027).png', 'Jl Dr Sutomo', '11', '', '2019-01-31', '10.00 WITA', '12.00 WITA', '15.000', 'Laki-Laki', 'Telah', 'Rp. 10.000', 'PT Yayasan Jaya', '054171234123', 'Ingat Mati', 2),
(24, 'Solat Berjamaah', 'Ustad Zakir', 'Masjid At Thoriq', -0.495724, 117.141, 'http://192.168.1.3/SIGKajianIslam/image/poster/IMG_USR(5c7feeeb91afb).png', 'http://192.168.1.3/SIGKajianIslam/image/tempat/IMG_USR(5c7feeeba2dc4).png', 'Jl Dr Haji Darjat', '2', '', '2019-01-31', '10.00 WITA', '12.00 WITA', '15.000', 'Laki-Laki', 'Aktif', 'Rp. 10.000', 'PT Yayasan Jaya', '054171234123', 'Ingat', 2),
(25, 'Solat Sunnah', '', 'Masjid At Thaharah', -0.499181, 117.136, 'http://192.168.1.3/SIGKajianIslam/image/poster/IMG_USR(5c5177023cc71).png', 'http://192.168.1.3/SIGKajianIslam/image/tempat/IMG_USR(5c517702418e9).png', 'Jl Dr Haji Darjat', '5', '', '2019-01-31', '11.00 WITA', '13.00 WITA', '20.000', 'Umum', 'Telah', 'Rp. 10.000', 'PT Yayasan Jaya Raya', '054171234123', 'Ingat Bawa Air Wudhu', 2),
(38, 'Tolong Menolong Dalam Kebaikan', 'Ustad Wasis', 'Masjid Al Fatihah Unmul', -0.498654, 117.142, 'http://192.168.1.3/SIGKajianIslam/image/poster/IMG_USR(5c7468da5b6a5).png', 'http://192.168.1.3/SIGKajianIslam/image/tempat/IMG_USR(5c7468da6b3be).png', 'Jl. Gunung Kelua', '7', '', '2019-02-28', '16.00 WITA', '18.00 WITA', 'Bebas', 'Umum', 'TelahSelesai', 'Gratis', 'PUSDIMA UNMUL', '08132151232523', 'Jangan Lupa Ikut Ya', 14),
(39, 'Cek', 'Cak', 'Cik', -0.506366, 117.154, 'http://192.168.1.3/SIGKajianIslam/image/poster/IMG_USR(5c751f8ab9ca0).png', 'http://192.168.1.3/SIGKajianIslam/image/tempat/IMG_USR(5c751f8abf69a).png', 'Cuk', '12', '', '2019-02-22', '12.00 WITA', '14.00 WITA', 'Tak Dibatasi', 'Umum', 'Aktif', 'Gratis', 'PT Maju Terus', '0812342342323', 'Harap Daftar Dulu melalui sms', 2),
(40, 'Solat Malam di Bulan Ramadhan', 'Ustad Sofyan', 'Masjid Nurul Jannah', -0.500186, 117.149, 'http://192.168.1.3/SIGKajianIslam/image/poster/IMG_USR(5c754d5104a89).png', 'http://192.168.1.3/SIGKajianIslam/image/tempat/IMG_USR(5c754d5106ace).png', 'Jl. Panglima Batur No. 5', '12', '', '2019-03-14', '16.00 WITA', '18.00 WITA', 'Tak Dibatasi', 'Umum', 'TelahSelesai', 'Gratis', 'Yayasan Peduli Sesama', '0812341234223', 'Harus Datang Tepat Waktu', 2),
(41, 'Tolong Menolong Dalam Kebaikan', 'Ustad Zakaria', 'Masjid Baitulrahman', -0.498326, 117.146, 'http://192.168.1.3/SIGKajianIslam/image/poster/IMG_USR(5c7fef2bc1d62).png', 'http://192.168.1.3/SIGKajianIslam/image/tempat/IMG_USR(5c7fef2bc2b54).png', 'Jl. Pasar Pagi', '11', '', '2019-02-23', '11.00 WITA', '15.00 WITA', 'Tak Dibatasi', 'Umum', 'Aktif', 'Gratis', 'Yayasan Mustofa', '08132423423', 'Jagalah Kesehatan', 2),
(42, 'fadsfasdf', 'dfasfasdfsd', 'dsfasdfasfas', -0.500753, 117.142, 'http://192.168.1.3/SIGKajianIslam/image/poster/IMG_USR(5c808559000e2).png', 'http://192.168.1.3/SIGKajianIslam/image/tempat/IMG_USR(5c80855901b85).png', 'Jl. Abdul Wahab Syahranie 4 Blok K No. 14A', '8', '', '2019-03-20', '10.00 WITA', '16.00 WITA', '10.000', 'Umum', 'Aktif', 'Rp. 20.000', 'PT Jaya Baya', '081234123142', 'Bawa Sumbangan Terbaik', 2),
(43, 'Aku Mau Jadi Berjaya', 'Pak Soleh Solihun', 'Masjid Raya Samarinda', -0.492515, 117.138, 'http://192.168.1.3/SIGKajianIslam2/image/poster/IMG_USR(5c9df9ca23fcb).png', 'http://192.168.1.3/SIGKajianIslam2/image/tempat/IMG_USR(5c9df9ca27e54).png', 'Jl. Abdul Wahab Syahranie 4 Blok K No. 14A', 'Sidodadi', 'Samarinda Selatan', '2019-03-30', '14.00 WITA', '16.00 WITA', '1000 Orang', 'Umum', 'TelahSelesai', 'Gratis', 'Yayasan Peduli Umat', '08132151232523', 'Bawa Sumbangan Terbaik', 2),
(44, '123', '123', '123', 123, 123, 'image/poster/IMG_5ca61a0678235.png', 'image/tempat/IMG_5ca61a0678d71.png', '123', '123', '123', '0000-00-00', '123', '123', '123', '123', 'Aktif', '123', '123', '13', '123', 16),
(45, 'yolo', 'yolo', '', -0.479538, 117.149, 'image/poster/IMG_5ca62192d7be5.png', 'image/tempat/IMG_5ca62193085d7.png', 'yolo', 'yolo', 'yolo', '2019-05-04', '2213123', '23123', '23123', '213123', 'Aktif', 'yolo', 'yolo', 'yolo', 'yolo', 16),
(46, 'yolo', 'yolo', '', -0.479538, 117.149, 'image/poster/IMG_5ca622794173e.png', 'image/tempat/IMG_5ca6227946099.png', 'yolo', 'yolo', 'yolo', '2019-05-04', '2213123', '23123', '23123', '213123', 'Aktif', 'yolo', 'yolo', 'yolo', 'yolo', 16),
(47, 'tolong', 'tolong', 'tolong', -0.479296, 117.151, 'image/poster/IMG_5ca623a2a6000.png', 'image/tempat/IMG_5ca623a2a8493.png', 'dasfasf', 'dfasdfaf', 'dfasdfaf', '2019-05-04', 'fasdfasf', 'adsfasf', 'adsfasf', 'adsfadsfa', 'Aktif', 'adfasdf', 'adfasdfa', 'adsfasdf', 'adsfasf', 16),
(48, 'This', 'is', 'Me', -0.484879, 117.148, 'image/poster/IMG_5ca7196321036.png', 'image/tempat/IMG_5ca7196330f33.png', 'Beautiful', 'Melodies', 'Melodies', '2019-06-04', 'wo', 'wo', 'wo', 'wo', 'Aktif', 'wo', 'wo', 'wo', 'wo', 9),
(49, 'bagus pliss', 'bagus pliss', 'bagus pliss', -0.486333, 117.148, 'image/poster/IMG_5ca71be762ab3.png', 'image/tempat/IMG_5ca71be7735e1.png', 'bagus pliss', 'bagus pliss', 'bagus pliss', '2019-06-04', 'asdfasf', 'adsfasdfa', 'asdfasdf', 'adsfasdf', 'Aktif', 'asdfasdfa', 'asdfasdf', 'adfasdf', 'dsfasf', 9),
(50, '$namakajian', '$namapemateri', '$namatempat', 0, 0, '$finalImage', '$finalImage2', '$alamat', '$kelurahan', '$kecamatan', '0000-00-00', '$waktumulai', '$waktuselesai', '$kuotapeserta', '$statuspeserta', 'Aktif', '$statusberbayar', '$pengelola', '$kontakpengelola', '$informasi', 15),
(51, 'g', 'v', 'v', -0.492544, 117.142, 'image/poster/IMG_5ca767134c59a.png', 'image/tempat/IMG_5ca76713546f5.png', 'f', 'g', 'g', '2019-06-04', 'g', 'v', 'v', 'g', 'Aktif', 'g', 'g', 'g', 'g', 16),
(52, 'gafsscz', 'xafXgsd', 'ddadszf', -0.495454, 117.143, 'image/poster/IMG_5ca768261bf9a.png', 'image/tempat/IMG_5ca768261d0d1.png', 'xafafzsf', 'xDFD', 'xDFD', '2019-06-04', 'fagazd', 'dafsxxd', 'xafzcgsd', 'zafFss', 'Aktif', 'faczzvsx', 'xXgSasd', 'fszgxzs', 'fsxgdzd', 16),
(53, 'mau plis', 'maumau', 'mau', -0.492786, 117.146, 'image/poster/IMG_5ca768c81d7bc.png', 'image/tempat/IMG_5ca768c81f3d1.png', 'mau', 'mau', 'mau', '2019-06-04', 'mau', 'mau', 'mau', 'mau', 'Aktif', 'mau', 'mau', 'mau', 'mau', 15),
(54, 'tolong', 'tolong', 'shakjz', -0.493939, 117.146, 'image/poster/IMG_5ca76982a7d75.png', 'image/tempat/IMG_5ca76982add6f.png', 'hajkJ', 'ajjajzjJ', 'ajjajzjJ', '2019-06-04', 'jskakfba', 'hdjakxj', 'zhjajxjN', 'shajzja', 'Aktif', 'shzjanxn', 'sjkfkaj', 'sjjsjajs', 'sjajjdnsj', 15),
(55, 'oioioioi', 'tolong', 'hakfkam', -0.494666, 117.145, 'image/poster/IMG_5ca769ce48725.png', 'image/tempat/IMG_5ca769ce4a22e.png', 'ajfnakx', 'zjcjJxj', 'zjcjJxj', '2019-06-04', 'xhJxjJ', 'dnzjdja', 'hdjajxj', 'sjjxjajxj', 'Aktif', 'xhajzjsj', 'sbsjjxj', 'sbJjzjz', 'snajjxjzzjz', 15),
(56, 'plisplis', 'plis', 'plis', -0.495273, 117.144, 'image/poster/IMG_5ca76afd6f66f.png', 'image/tempat/IMG_5ca76afd701af.png', 'plis', 'plis', 'plis', '2019-06-04', 'hdkaks', 'sjjdjajs', 'jajxnjajs', 'jsjakdj', 'Aktif', 'jajdnan', 'xhJxjj', 'shajjxn', 'hshajsn', 15);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `tempatlahir` varchar(30) NOT NULL,
  `tanggallahir` date NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kelurahan` varchar(25) NOT NULL,
  `kecamatan` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `sosialmedia` varchar(30) NOT NULL,
  `fotoktp` text NOT NULL,
  `nomorktp` varchar(16) NOT NULL,
  `no_telepon` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `Nama`, `tempatlahir`, `tanggallahir`, `alamat`, `kelurahan`, `kecamatan`, `email`, `sosialmedia`, `fotoktp`, `nomorktp`, `no_telepon`) VALUES
(6, '$nama', '$tempatlahir', '1995-09-09', '$alamat', '2', '', '$email', '$sosialmedia', '$finalImage2', '$no_ktp', '$no_telepon'),
(7, '99999999', '666666666', '2019-01-22', '2222222', '2', '', '111111111111', '2222222', 'http://192.168.1.3/SIGKajianIslam/image/ktp/IMG_USR(5c389d9ed7efe).png', '3333333333', '444444444444'),
(8, 'asdgadsf adsfas dfadsf asdsd', 'samarinda', '2019-01-08', 'Jalan Panjang Berliku Liku Menaiki Gunung', '2', '', 'fasdfdsafa', 'adsfasfasdf', 'http://192.168.1.3/SIGKajianIslam/image/ktp/IMG_USR(5c7548544c2c7).png', 'asdfasdf', 'adsfasdfasdf'),
(14, 'sdfasdfa', 'adsfasdfas', '2019-01-29', 'fasdfasdf', '2', '', 'fasdfasdfafds', 'asdfasdfasdf', 'http://192.168.1.10/SIGKajianIslam/image/ktp/IMG_USR(5c3840772ae6a).png', '34324234234', '234234234'),
(15, 'dsfasdf', 'asdfasdf', '2019-01-23', 'fdasfasdfasf', '2', '', 'sadfasfasf', 'dsafasdfaf', 'http://192.168.1.2/SIGKajianIslam/image/ktp/IMG_USR(5c7530a4d57fc).png', '213123123', '23123123'),
(16, 'asdasd', 'dsadsadasd', '2019-01-28', 'sadasdasd', '2', '', 'asdasdasd', 'sadasdasd', 'http://192.168.1.10/SIGKajianIslam/image/ktp/IMG_USR(5c384200cda57).png', '213213123123', '123213123213'),
(17, '12312', '2312', '0002-12-31', '123123', '2', '', '1', '123', 'http://192.168.1.2/SIGKajianIslam/image/ktp/IMG_USR(5c7530fe03a0d).png', '123', '123'),
(18, '123', '123', '0033-12-31', '123', '2', '', '123', '123', 'http://192.168.1.10/SIGKajianIslam/image/ktp/IMG_USR(5c38466c91dcb).png', '123', '123'),
(19, 'dsafasdfasdf', 'dfasdfasfa', '2019-01-28', 'fsdafasdfas', '2', '', 'asdfasdfasf', 'asdfasfasf', 'http://192.168.1.10/SIGKajianIslam/image/ktp/IMG_USR(5c385b5e40014).png', '21312312312', '213123123123'),
(20, 'tekacel', 'asdfasdfasf', '2019-01-28', 'jaslkdfjasdf', '2', '', 'fjklasdjfakls', 'ksdajflkasjf;l', 'http://192.168.1.10/SIGKajianIslam/image/ktp/IMG_USR(5c385bce66a41).png', '6453654345', '976986679'),
(21, 'Jeki Ansari', 'Samarinda', '1994-10-25', 'Jl. Abdul Wahab Syahranie 4 Bl', '2', '', 'jekigendut94@gmail.com', 'jeki ansari', 'http://192.168.1.3/SIGKajianIslam/image/ktp/IMG_USR(5c385e3ab328e).png', '1231212321412312', '213124213123123123'),
(22, 'asdfasdfadsfadsf', 'asdfasdfasdf', '2019-01-22', 'hahahahaha', '2', '', 'sadfasfasdf', 'asdfasdf', 'http://192.168.1.2/SIGKajianIslam/image/ktp/IMG_USR(5c3867cb5dbb7).png', '412341423412412', '1341412341241234'),
(23, 'Jeki Ansari', 'Samarinda', '1994-10-25', 'Jl.Abdul Wahab Syahranie 4 Blo', '2', '', 'jokerstarix@gmail.com', 'jeki Ansari', 'http://192.168.1.3/SIGKajianIslam/image/ktp/IMG_USR(5c388b14aba0b).png', '123456789', '081350042338'),
(24, 'Jeki Ansari', 'Samarinda', '1994-01-30', 'Jl. Abdul Wahab Syahranie 4 Bl', '4', '', 'jekigendut94@gmail.com', 'tekencel', 'http://192.168.1.3/SIGKajianIslam/image/ktp/IMG_USR(5c4842b0e86a2).png', '312312412313', '231231231231'),
(25, 'Jeki Ansari', 'Samarinda', '1994-10-25', 'Jl. Aws 4', '9', '', 'jokerstarix@gmail.com', 'Jeki Ansari', 'http://192.168.1.2/SIGKajianIslam/image/ktp/IMG_USR(5c73be313a7b9).png', '213124123123', '21123123123'),
(26, 'Berhasil', 'Samarinda', '2019-02-20', 'Jl. Bengkinang', 'Sidodadi', 'Samarinda Ulu', 'jokerstarix@gmail.com', 'Tolong Bawa air', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5c9dec25b1b4c).png', '1231212321412312', '081350042338'),
(27, 'tekacak kacak', 'dikacak', '2019-02-14', 'Jl. Bengkinang', '12', '', 'jokerstarix@gmail.com', '@tekacak', 'http://192.168.1.3/SIGKajianIslam/image/ktp/IMG_USR(5c754ee6ba756).png', '01923041231234', '1234012030124213'),
(28, 'Jeki Ansari SSSS', 'Samarinda', '2019-03-27', 'Jl. Abdul Wahab Syahranie 4 Blok K No. 14A', 'Sungai Pinang', 'Samarinda Ulu', 'jekigendut94@gmail.com', 'jeki Ansari', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5c9df1ff0df5f).png', '213124123123', '21123123123'),
(29, 'irvan setiawan', 'balikpapan', '2019-03-25', 'jl panjaitan', 'sungai keledang', 'samarinda ulu', 'irvanze@gmail.com', 'Irvan Setiawan', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5c9df4548e54f).png', '098098', '9898908'),
(30, 'sdfasdf', 'sadafa', '0000-00-00', 'dsfasdfasf', 'dfadsfasf', 'fasfsafasfasf', 'sfasfasf', 'dfasfsadfas', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5c9e24e8c04a2).png', 'fsadfasdfasf', 'asdfasfasf'),
(31, '', 'piatos', '0000-00-00', 'dsafasdf', '', '', 'sadfasdfas', 'dasfasfsa', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5c9e2597d9ad7).png', '', 'sadfasdfas'),
(32, '', 'fafasdfas', '0000-00-00', 'asdfasfas', '', '', 'asdfasdfas', 'asdfasdfas', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5c9e26024a43c).png', '', 'asdfasdfas'),
(33, 'sdfasdf', 'sadafa', '0000-00-00', 'dsfasdfasf', 'dfadsfasf', 'fasfsafasfasf', 'sfasfasf', 'dfasfsadfas', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5c9e284729c00).png', 'fsadfasdfasf', 'asdfasfasf'),
(34, '', 'otato', '0000-00-00', 'tolong', '', '', 'tidak', 'error', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5c9e2b551ffd7).png', '', 'plisssss'),
(35, '', 'aaaa', '0000-00-00', 'aaaa', '', '', 'aaaaa', 'aaaaaa', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5ca45998dffc1).png', '', 'aaaaaaa'),
(36, '', 'aaaaa', '0000-00-00', '2333', '', '', 'aaaa', 'aaaa', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5ca45b21aa904).png', '', '11111'),
(37, 'aaaaa', 'aaaaa', '0000-00-00', 'aaaaa', 'aaaa', 'aaaa', 'aaaaaa', 'aaaa', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5ca45c8d6cd01).png', '123', '123'),
(38, 'sss', 'ss', '2019-04-10', 'sss', 'ssss', 'ssss', 'ssss', 'sss', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5ca45f2d6e5e1).png', '123', '123'),
(39, 'ssss', 'ssss', '0000-00-00', 'aaaa', 'aaaa', 'aaaa', 'aaaa', 'aaaa', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5ca45ffeb2e7e).png', '123', '123'),
(40, 'asd', 'asdas', '0000-00-00', 'asasdas', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5ca4625853137).png', 'asdas', 'asd'),
(41, '123', '123', '0000-00-00', 'sds', 'aas', 'aasd', 'asd', 'aaa', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5ca462e8c94ca).png', 'asd', '123'),
(42, '222', '222', '2019-04-04', '2', '123', '123', '123', '123', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5ca464bac97d1).png', '132', '123'),
(43, 'ddd', 'dddd', '2019-04-04', '123', '123', '123', '123', '123', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5ca4654947c34).png', '123', '123'),
(44, '4444', '222', '2019-04-04', '123', '123', '12', '123', '13', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5ca468390795a).png', '133', '123'),
(45, '333', '333', '2019-04-04', 'ssss', 'ss', 'sss', 'sss', 'ssss', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5ca468f8c9ee6).png', 'sss', 'sss'),
(46, 'll', 'lll', '2019-04-04', 'llll', 'llll', 'lll', 'llll', 'llll', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5ca4693b6e847).png', 'llll', 'llll'),
(47, '12', '12', '2019-04-04', '123', '2222', '222', '222', '2', 'http://192.168.1.3/SIGKajianIslam2/image/ktp/IMG_USR(5ca46a6dbff9c).png', '2', '2'),
(48, 'kkkk', 'kkkk', '2019-04-04', 'kkkkk', 'kkkk', 'kkkk', 'kkkk', 'kkkk', 'image/ktp/IMG_USR(5ca46e033001f).png', 'kkkk', 'kkkk');

-- --------------------------------------------------------

--
-- Table structure for table `username`
--

CREATE TABLE `username` (
  `id_username` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` text NOT NULL,
  `status` varchar(30) NOT NULL,
  `level` varchar(13) NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `username`
--

INSERT INTO `username` (`id_username`, `username`, `password`, `token`, `status`, `level`, `id_pengguna`) VALUES
(2, 'jeki', 'jeki', '', 'Verifikasi', 'Admin', 8),
(6, '1', '1212', 'Belum Diketahui', 'Verifikasi', 'User', 17),
(7, 'tekacak', 'tekacak', 'Belum Diketahui', 'Blocked', 'User', 24),
(9, 'Tekencel', 'jeki', 'Belum Diketahui', 'Verifikasi', 'User', 20),
(10, 'jeki94', 'jekiansari', 'Belum Diketahui', 'Verifikasi', 'User', 21),
(11, 'asdfasfasf', 'asdfasdfasf', 'Belum Diketahui', 'Verifikasi', 'User', 22),
(14, 'berhasil', 'berhasil', '', 'Verifikasi', 'Admin', 26),
(15, 'tekacak', 'kacak', 'Belum Diketahui', 'Verifikasi', 'User', 28),
(16, 'irvan', 'setiawan', 'Belum Diketahui', 'Verifikasi', 'User', 29),
(17, 'faku u', 'jeki', 'Belum Diketahui', 'BelumVerifikasi', 'adfasdfs', 30),
(18, 'citato', 'piatos', 'Belum Diketahui', 'BelumVerifikasi', '', 31),
(19, 'tolong', 'lontong', 'Belum Diketahui', 'BelumVerifikasi', 'User', 32),
(20, 'faku', 'jeki', 'Belum Diketahui', 'BelumVerifikasi', 'User', 33),
(21, 'potato', 'ooooooo', 'Belum Diketahui', 'BelumVerifikasi', 'User', 34),
(22, 'aaa', 'aaaaa', 'Belum Diketahui', 'BelumVerifikasi', 'User', 35),
(23, 'aaaaaa', 'aaaaaa', 'Belum Diketahui', 'BelumVerifikasi', 'User', 36),
(24, 'bbbbb', 'bbbbbb', 'Belum Diketahui', 'BelumVerifikasi', 'User', 37),
(25, 'sss', 'sss', 'Belum Diketahui', 'BelumVerifikasi', 'User', 38),
(26, 'ssss', 'ssss', 'Belum Diketahui', 'BelumVerifikasi', 'User', 39),
(27, 'aasdas', 'asd', 'Belum Diketahui', 'BelumVerifikasi', 'User', 40),
(28, '123', '123', 'Belum Diketahui', 'BelumVerifikasi', 'User', 41),
(29, '222', '222', 'Belum Diketahui', 'BelumVerifikasi', 'User', 42),
(30, 'dddd', 'ddd', 'Belum Diketahui', 'BelumVerifikasi', 'User', 43),
(31, '4444', '4444', 'Belum Diketahui', 'BelumVerifikasi', 'User', 44),
(32, '3333', '3333', 'Belum Diketahui', 'BelumVerifikasi', 'User', 45),
(33, 'lll', 'lll', 'Belum Diketahui', 'BelumVerifikasi', 'User', 46),
(34, '12', '12', 'Belum Diketahui', 'BelumVerifikasi', 'User', 47),
(35, 'kkk', 'kkkk', 'Belum Diketahui', 'BelumVerifikasi', 'User', 48);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `formkajian`
--
ALTER TABLE `formkajian`
  ADD PRIMARY KEY (`id_kajian`),
  ADD KEY `formkajian_fk0` (`kelurahan`),
  ADD KEY `id_username` (`id_username`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `Pengguna_fk0` (`kelurahan`);

--
-- Indexes for table `username`
--
ALTER TABLE `username`
  ADD PRIMARY KEY (`id_username`),
  ADD KEY `Username_fk0` (`id_pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `formkajian`
--
ALTER TABLE `formkajian`
  MODIFY `id_kajian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `username`
--
ALTER TABLE `username`
  MODIFY `id_username` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `formkajian`
--
ALTER TABLE `formkajian`
  ADD CONSTRAINT `formkajian_ibfk_1` FOREIGN KEY (`id_username`) REFERENCES `username` (`id_username`);

--
-- Constraints for table `username`
--
ALTER TABLE `username`
  ADD CONSTRAINT `Username_fk0` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
