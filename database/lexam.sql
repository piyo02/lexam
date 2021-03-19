-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2021 at 08:58 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `class_ladder_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`id`, `school_id`, `user_id`, `class_ladder_id`, `name`, `description`) VALUES
(5, 1, NULL, 10, 'XII MIPA 1', 'Kelas 12'),
(6, 1, NULL, 10, 'XII MIPA 2', '-'),
(7, 1, NULL, 10, 'XII MIPA 3', '-'),
(8, 1, NULL, 10, 'XII MIPA 4', '-'),
(9, 1, NULL, 10, 'XII MIPA 5', '-'),
(10, 1, NULL, 10, 'XII MIPA 6', '-'),
(11, 1, NULL, 11, 'XII IPS 1', '-'),
(12, 1, NULL, 10, 'XII IPS 2', '-'),
(13, 1, NULL, 11, 'XII IPS 3', '-'),
(14, 1, NULL, 11, 'XII IPS 4', '-'),
(16, 1, NULL, 12, 'XII IBB', '-');

-- --------------------------------------------------------

--
-- Table structure for table `class_ladder`
--

CREATE TABLE `class_ladder` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_ladder`
--

INSERT INTO `class_ladder` (`id`, `name`, `description`) VALUES
(1, 'Kelas VII', '-'),
(2, 'Kelas VIII', '-'),
(3, 'Kelas IX', '-'),
(4, 'Kelas X MIPA', '-'),
(5, 'Kelas X IPS', '-'),
(6, 'Kelas X IBB', '-'),
(7, 'Kelas XI MIPA', '-'),
(8, 'Kelas XI IPS', '-'),
(9, 'Kelas XI IBB', '-'),
(10, 'Kelas XII MIPA', '-'),
(11, 'Kelas XII IPS', '-'),
(12, 'Kelas XII IBB', '-');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `school_id`, `name`, `description`) VALUES
(3, 1, 'Matematika (Wajib)', '-'),
(4, 1, 'Biologi', '-'),
(5, 1, 'Fisika', '-'),
(6, 1, 'Kimia', '-'),
(7, 1, 'Bahasa & Sastra Indonesia (Peminatan)', '-'),
(8, 1, 'Pendidikan Agama & Budi Pekerti', '-'),
(9, 1, 'Bahasa Inggris', '-'),
(10, 1, 'PPKn', '-'),
(11, 1, 'Penjasorkes', '-'),
(12, 1, 'Ekonomi', '-'),
(13, 1, 'Sejarah Indonesia', '-'),
(14, 1, 'Geografi', '-'),
(15, 1, 'Antropologi', '-'),
(16, 1, 'PKWU', '-'),
(17, 1, 'Sosiologi', '-'),
(18, 1, 'Bahasa Arab', '-'),
(19, 1, 'Sejarah (Peminatan)', '-'),
(20, 1, 'Matematika (Peminatan)', '-'),
(21, 1, 'Bahasa & Sastra Inggris (Peminatan)', '-'),
(22, 1, 'Seni Budaya', '-'),
(23, 1, 'Lintas Minat Kimia', '-'),
(24, 1, 'Lintas Minat Biologi', '-'),
(25, 1, 'Lintas Minat Ekonomi', '-'),
(26, 1, 'Lintas Minat Sosiologi', '-'),
(27, 1, 'Lintas Minat Geografi', '-'),
(28, 1, 'Lintas Minat Bahasa & Sastra Inggris', '-'),
(29, 1, 'Bahasa Indonesia (Wajib)', '-');

-- --------------------------------------------------------

--
-- Table structure for table `edu_ladder`
--

CREATE TABLE `edu_ladder` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `edu_ladder`
--

INSERT INTO `edu_ladder` (`id`, `name`, `description`) VALUES
(1, 'SD', 'Sekolah Dasar'),
(2, 'SMP ', 'Sekolah Menengah Pertama'),
(3, 'SMA', 'Sekolah Menengah Atas'),
(4, 'MI', 'SD islami'),
(5, 'MTs', 'Madrasah Tsanawiyah'),
(6, 'MA', 'Madrasah Aliyah'),
(7, 'SMK', 'Sekolah Kejuruan');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'uadmin', 'user admin'),
(3, 'teacher', 'User guru'),
(4, 'student', 'User Siswa'),
(5, 'school_admin', 'Admin Sekolah'),
(6, 'headmaster', '-');

-- --------------------------------------------------------

--
-- Table structure for table `headmaster_profile`
--

CREATE TABLE `headmaster_profile` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `nip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `headmaster_profile`
--

INSERT INTO `headmaster_profile` (`id`, `school_id`, `user_id`, `nip`) VALUES
(1, 1, 27, '192 168 0 10');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(7, '::1', 'abdulkhalikkendari@gmail.com', 1616037083);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(50) NOT NULL,
  `list_id` varchar(200) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `position` int(4) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_id`, `name`, `link`, `list_id`, `icon`, `status`, `position`, `description`) VALUES
(101, 1, 'Beranda', 'admin/', 'home_index', 'home', 1, 1, '-'),
(102, 1, 'Group', 'admin/group', 'group_index', 'home', 1, 2, '-'),
(103, 1, 'Setting', 'admin/menus', '-', 'cogs', 1, 3, '-'),
(104, 1, 'User', 'admin/user_management', 'user_management_index', 'users', 1, 4, '-'),
(106, 103, 'Menu', 'admin/menus', 'menus_index', 'circle', 1, 1, '-'),
(107, 2, 'Beranda', 'uadmin/home', 'home_index', 'home', 1, 1, '-'),
(108, 2, 'Pengguna', 'uadmin/users', 'users_index', 'home', 1, 2, '-'),
(109, 3, 'Beranda', 'teacher/home', 'home_index', 'home', 1, 1, '-'),
(110, 3, 'Mata Pelajaran', 'teacher/courses', 'courses_index', 'book', 0, 1, '-'),
(111, 3, 'Ulangan', 'teacher/ulangan', 'teacher_ulangan', 'tasks', 1, 1, '-'),
(112, 111, 'Bank Soal', 'teacher/questionnaire', 'questionnaire_index', 'th', 1, 1, '-'),
(113, 111, 'Ulangan', 'teacher/test', 'test_index', 'file-signature', 1, 1, '-'),
(114, 3, 'Analisa', 'teacher/analysis', 'teacher_analysis', 'diagnoses', 1, 1, '-'),
(115, 114, 'Hasil Ulangan', 'teacher/result_test', 'result_test_index', 'clipboard-check', 1, 1, '-'),
(116, 114, 'Siswa', 'teacher/student', 'student_index', 'user-graduate', 0, 1, '-'),
(120, 5, 'Beranda', 'school_admin/home', 'home_index', 'home', 1, 1, '-'),
(121, 5, 'Sekolah', 'school_admin/school', 'uadmin_school', 'home', 1, 1, '-'),
(122, 121, 'Mata Pelajaran', 'school_admin/courses', 'courses_index', 'home', 1, 1, '-'),
(123, 121, 'Kelas', 'school_admin/classroom', 'classroom_index', 'home', 1, 1, '-'),
(124, 5, 'Pengguna', 'school_admin/users', 'users_index', 'home', 1, 1, '-'),
(125, 4, 'Daftar Ulangan', 'student/list_test', 'student_list_test', 'tasks', 1, 1, '-'),
(126, 125, 'Ulangan', 'student/test', 'test_index', 'file-signature', 1, 1, '-'),
(127, 125, 'Histori', 'student/history', 'history_index', 'history', 1, 1, '-'),
(128, 4, 'Hasil', 'student/result_test', 'result_test_index', 'wave-square', 1, 1, '-'),
(129, 2, 'Sekolah', 'uadmin/schools', 'schools_index', 'home', 1, 1, '-'),
(130, 2, 'Testimoni', 'uadmin/testimoni', 'testimoni_index', 'home', 1, 1, '-'),
(131, 2, 'Jenjang Kelas', 'uadmin/class_ladder', 'class_ladder_index', 'home', 1, 1, '-'),
(132, 6, 'Siswa', 'headmaster/student', 'student_index', 'home', 1, 1, '-'),
(133, 6, 'Guru', 'headmaster/teacher', 'teacher_index', 'home', 1, 1, '-'),
(134, 6, 'Pemeringkatan', 'headmaster/ranking', 'ranking_index', 'home', 0, 1, '-'),
(135, 2, 'Kepala Sekolah', 'uadmin/headmaster', 'headmaster_index', 'home', 1, 1, '-');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `questionnaire_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(25) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `audio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `code`, `questionnaire_id`, `type`, `text`, `image`, `audio`) VALUES
(4366, 'S-1', 9, 'text', '<p>Ardi melakukan perjalanan dari kota A ke kota C melalui kota B. Kota A dan kota B dihubungkan oleh 4 jalur darat,&nbsp;&nbsp; 1&nbsp; jalur udara. Sedangkan kota B dan kota C dihubungkan oleh 3 jalur darat,&nbsp;&nbsp; 2 jalur udara.&nbsp; Dalam berapa cara Ardi melakukan perjalanan tersebut ?</p>', NULL, NULL),
(4367, 'S-2', 9, 'image', '<p>Diketahui 5 mobil berbeda dan 4 motor berbeda yang sedang diparkir berbaris. Berapa banyak carakah barisan kendaraan ini dapat dibentuk jika motor harus berkelompok ?</p>', 'S-2_1615971926_soal-mtk.png', NULL),
(4368, 'S-3', 9, 'text', 'Dari angka-angka 2, 3, 4, 5, 6, 8, 9 akan disusun bilangan yang terdiri atas 4 angka berbeda. Banyak bilangan genap yang dapat disusun adalah ….', NULL, NULL),
(4369, 'S-4', 9, 'text', 'Rini merapikan buku-buku di atas meja belajarnya dengan menyusunnya pada rak buku. Ada  6 buah buku berbeda yang akan disusunnya  pada rak buku. Banyak cara Rini menyusun buku-buku tersebut pada rak buku adalah ….', NULL, NULL),
(4370, 'S-5', 9, 'text', 'Banyak permutasi dari huruf-huruf pada kata  “S E L A S A”  adalah ….', NULL, NULL),
(4371, 'S-6', 9, 'text', 'Enam orang manager perusahaan duduk mengelilingi sebuah meja berbentuk melingkar untuk mengadakan rapat. Berapa banyak cara mereka duduk mengelilingi meja yang melingkar itu dengan urutan yang berbeda ?', NULL, NULL),
(4372, 'S-7', 9, 'text', 'Dari 9 siswa berprestasi akan dibuat tim yang terdiri dari 3 orang untuk mengikuti suatu lomba. Banyak kemungkinan tim yang dapat dibentuk adalah …', NULL, NULL),
(4373, 'S-8', 9, 'text', 'Dalam pemilihan murid teladan di suatu sekolah tersedia calon yang terdiri dari 5 orang putra dan 4 orang putri. Jika akan dipilih sepasang murid teladan yang tediri dari seorang putra dan seorang putri, maka banyaknya pasangan yang mungkin terpilih adalah ….', NULL, NULL),
(4374, 'S-9', 9, 'text', 'Suatu tim bulu tangkis terdiri dari 5 pemain putra dan 4 pemain putri. Banyaknya tim ganda putra yang dapat disusun adalah ….', NULL, NULL),
(4375, 'S-10', 9, 'text', 'Seorang siswa diminta mengerjakan 7 soal dari 10 soal yang tersedia dengan syarat soal nomor 1 sampai nomor 5 harus dikerjakan. Banyak pilihan yang dapat diambil siswa tersebut adalah ….', NULL, NULL),
(4376, 'S-1', 10, 'text', 'Di bawah ini merupakan langkah-langkah dalam menganalisis informasi baik fakta dan opini dalam sebuah artikel, kecuali … ', NULL, NULL),
(4377, 'S-2', 10, 'text', '(1) sesuai kenyataan isi dan kebenarannya \n(2) bergantung pada kepentingan tertentu \n(3) benar atau salah bergantung data pendukung \n(4) cenderung deskriptif pengungkapannya \n(5) cenderung persuasif pengungkapan \n(6) penalarannya cenderung induktif \n(7) penalarannya cenderung deduktif. \nBerdasarkan pernyataan di atas yang termasuk ciri-ciri fakta adalah …. ', NULL, NULL),
(4378, 'S-3', 10, 'text', '(1) Udara di Bogor terasa dingin. (2) Kali ini dinginnya melebihi hari-hari sebelumnya. (3) Dinginnya suhu udara di Bogor mencapai 24ºC. (4) Data tingkat suhu udara ini, terdapat di papan informasi pengukur suhu di jalan-jalan besar di kota Bogor. \nDua kalimat pendapat pada teks tersebut ditandai dengan nomor .... ', NULL, NULL),
(4379, 'S-4', 10, 'text', '(1) Antioksidan ternyata ditemukan pada berbagai buah dan sayuran berupa vitamin C. (2) Zat ini pun ada yang beranggapan dapat mencegah oksidan kolesterol dan proses yang menyebabkan penyempitan arteri. (3) Untuk mempercantik tubuh dan sehat, banyaklah orang yang melakukan diet seimbang dengan lima porsi buah dan sayuran setiap hari, karena dianggap cukup untuk memenuhi kebutuhan vitamin C tubuh dan pencegahan penyakit. (4) Di samping itu, mengonsumsi buah yang bervitamin C, terbukti tidak berdampak sampingan yang merugikan tubuh. (5) Dengan demikian, bolehlah kita yakini bahwa sangatlah berbeda efek suplemen vitamin C hasil olahan dengan yang asli dari buah. \nFakta dalam paragraf tersebut terdapat pada kalimat nomor … ', NULL, NULL),
(4380, 'S-5', 10, 'text', 'Olahraga sangat membantu pertahanan tubuh agar terhindar dari berbagai penyakit. Rajin berolahraga, antara lain, membuat kita dapat tidur nyenyak. Olahraga juga membuat kita menjadi orang yang selalu ceria sehingga terhindar dari berbagai macam penyakit, termasuk kanker. \nPendapat yang dapat mewakili pernyataan itu adalah ….', NULL, NULL),
(4381, 'S-6', 10, 'text', 'Fakta yang diperlukan untuk pendapat-pendapat yang ada pada kutipan itu adalah ….', NULL, NULL),
(4382, 'S-7', 10, 'text', 'Cermati teks berikut! (1)Saat ini literasi bukan hanya sekadar mampu membaca dan menulis. (2) Melainkan, kemampuan lebih dari sekadar itu. (3) Padahal, pemahaman literasi yang mana berarti seorang individu mampu dalam mengolah informasi dan pengetahuan untuk kecakapan hidup. (4) Dalam konteks pengajaran, literasi merupakan kemampuan mengakses, memahami, dan menggunakan sesuatu secara cerdas melalui berbagai aktivitas. (5) Aktivitas tersebut di antaranya, membaca, berhitung, menyimak, menulis, berbicara dan berbudaya. \nKalimat yang tidak efektif dari paragraf tersebut adalah kalimat nomor …. ', NULL, NULL),
(4383, 'S-8', 10, 'text', 'Cermati keterangan berikut! \nJudul : Problematika Budaya Menyontek di Indonesia \n(1) Berbagai aspek yang melandasi seseorang untuk menyontek. \n(2) Kebudayaan menyontek semakin marak di Indonesia. \n(3) Pemerolehan hasil atau nilai yang tinggi dan memuaskan \n(4) Berbagai fakta ditemukan pada setiap tingkat jenjang pendidikan. \n(5) Simpulan budaya menyontek dengan budaya korupsi di Indonesia \nUrutan kerangka yang sesuai dengan judul adalah nomor …. ', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questionnaire`
--

CREATE TABLE `questionnaire` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `classroom_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questionnaire`
--

INSERT INTO `questionnaire` (`id`, `user_id`, `classroom_id`, `course_id`, `name`, `description`, `status`) VALUES
(9, 423, 5, 3, 'Matematika (Wajib)', '-', 0),
(10, 428, 5, 29, 'Bahasa Indonesia (Wajib)', '-', 0);

-- --------------------------------------------------------

--
-- Table structure for table `question_answer`
--

CREATE TABLE `question_answer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(20) NOT NULL,
  `answer` text NOT NULL,
  `value` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_answer`
--

INSERT INTO `question_answer` (`id`, `question_id`, `type`, `answer`, `value`) VALUES
(21790, 4366, 'text', '9 cara', 0),
(21791, 4366, 'text', '10 cara', 0),
(21792, 4366, 'text', '14 cara', 0),
(21793, 4366, 'text', '24 cara', 0),
(21794, 4366, 'text', '25 cara', 1),
(21795, 4367, 'text', '6 ! x 5 !', 0),
(21796, 4367, 'text', '5 ! x 5 !', 0),
(21797, 4367, 'text', '6 ! x 4 !', 1),
(21798, 4367, 'text', '5 ! x 4 !', 0),
(21799, 4367, 'text', '4 ! x 4 !', 0),
(21800, 4368, 'text', '360', 0),
(21801, 4368, 'text', '480', 1),
(21802, 4368, 'text', '504', 0),
(21803, 4368, 'text', '630', 0),
(21804, 4368, 'text', '840', 0),
(21805, 4369, 'text', '30', 0),
(21806, 4369, 'text', '120', 0),
(21807, 4369, 'text', '180', 0),
(21808, 4369, 'text', '360', 0),
(21809, 4369, 'text', '720', 1),
(21810, 4370, 'text', '180', 1),
(21811, 4370, 'text', '240', 0),
(21812, 4370, 'text', '360', 0),
(21813, 4370, 'text', '480', 0),
(21814, 4370, 'text', '720', 0),
(21815, 4371, 'text', '480', 0),
(21816, 4371, 'text', '360', 0),
(21817, 4371, 'text', '240', 0),
(21818, 4371, 'text', '120', 1),
(21819, 4371, 'text', '60', 0),
(21820, 4372, 'text', '84', 1),
(21821, 4372, 'text', '168', 0),
(21822, 4372, 'text', '240', 0),
(21823, 4372, 'text', '504', 0),
(21824, 4372, 'text', '1008', 0),
(21825, 4373, 'text', '9', 0),
(21826, 4373, 'text', '16', 0),
(21827, 4373, 'text', '18', 0),
(21828, 4373, 'text', '20', 1),
(21829, 4373, 'text', '36', 0),
(21830, 4374, 'text', '9', 0),
(21831, 4374, 'text', '10', 1),
(21832, 4374, 'text', '12', 0),
(21833, 4374, 'text', '20', 0),
(21834, 4374, 'text', '25', 0),
(21835, 4375, 'text', '10', 1),
(21836, 4375, 'text', '17', 0),
(21837, 4375, 'text', '20', 0),
(21838, 4375, 'text', '70', 0),
(21839, 4375, 'text', '120', 0),
(21840, 4376, 'text', 'analisis informasi ', 0),
(21841, 4376, 'text', 'pilih kalimat dari artikel ', 0),
(21842, 4376, 'text', 'perhatikan ide pokoknya ', 1),
(21843, 4376, 'text', 'baca artikel dengan saksama ', 0),
(21844, 4376, 'text', 'cermati kalimat yang diambil ', 0),
(21845, 4377, 'text', '(1), (2), (3) ', 0),
(21846, 4377, 'text', '(1), (4), (6) ', 1),
(21847, 4377, 'text', '(2), (4), (5) ', 0),
(21848, 4377, 'text', '(2), (3), (6) ', 0),
(21849, 4377, 'text', '(3), (4), (5)', 0),
(21850, 4378, 'text', '(1) dan (2) ', 1),
(21851, 4378, 'text', '(1) dan (3) ', 0),
(21852, 4378, 'text', '(1) dan (4) ', 0),
(21853, 4378, 'text', '(2) dan (3) ', 0),
(21854, 4378, 'text', '(2) dan (4) ', 0),
(21855, 4379, 'text', '(1) dan (4)', 1),
(21856, 4379, 'text', '(2) dan (4)', 0),
(21857, 4379, 'text', '(3) dan (4) ', 0),
(21858, 4379, 'text', '(3) dan (5) ', 0),
(21859, 4379, 'text', '(4) dan (5)', 0),
(21860, 4380, 'text', 'Rajin berolahraga sudah pasti terbebas dari kanker. ', 0),
(21861, 4380, 'text', 'Sebelum tidur, seseorang harus banyak berolahraga. ', 0),
(21862, 4380, 'text', 'Orang yang terkena kanker pasti tidak pernah berolahraga. ', 0),
(21863, 4380, 'text', 'Berolahraga dapat menghindarkan kita dari berbagai penyakit. ', 1),
(21864, 4380, 'text', 'Kanker merupakan penyakit yang disebabkan oleh kurang tidur. ', 0),
(21865, 4381, 'text', 'Cara-cara berolahraga yang baik. ', 0),
(21866, 4381, 'text', 'Proses perkembangbiakan kanker. ', 0),
(21867, 4381, 'text', 'Macam-macam penyakit berbahaya. ', 0),
(21868, 4381, 'text', 'Jumlah penyakit yang biasa menyerang tubuh. ', 0),
(21869, 4381, 'text', 'Pengalaman orang-orang yang biasa olahraga ', 1),
(21870, 4382, 'text', '(1) dan (2)', 0),
(21871, 4382, 'text', '(1) dan (5)', 0),
(21872, 4382, 'text', '(2) dan (3)', 1),
(21873, 4382, 'text', '(3) dan (4) ', 0),
(21874, 4382, 'text', '(4) dan (5)', 0),
(21875, 4383, 'text', '(1), (2), (4), (3), (5)', 0),
(21876, 4383, 'text', '(2), (4), (1), (3), (5)', 1),
(21877, 4383, 'text', '(3), (2), (3), (1), (5)', 0),
(21878, 4383, 'text', '(3), (4), (2), (1), (5) ', 0),
(21879, 4383, 'text', '(4), (1), (3), (2), (5) ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `question_reference`
--

CREATE TABLE `question_reference` (
  `id` int(10) UNSIGNED NOT NULL,
  `test_id` int(10) UNSIGNED NOT NULL,
  `questionnaire_id` int(10) UNSIGNED NOT NULL,
  `multiple_choice` int(5) NOT NULL,
  `short_answer` int(5) NOT NULL,
  `essay` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_reference`
--

INSERT INTO `question_reference` (`id`, `test_id`, `questionnaire_id`, `multiple_choice`, `short_answer`, `essay`) VALUES
(16, 15, 9, 10, 0, 0),
(17, 16, 10, 8, 0, 0),
(18, 17, 9, 4, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(10) UNSIGNED NOT NULL,
  `edu_ladder_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `edu_ladder_id`, `name`, `description`) VALUES
(1, 3, 'SMA Negeri 6 Kendari', 'Sekolah'),
(2, 3, 'SMA Negeri 1 Morosi', '-');

-- --------------------------------------------------------

--
-- Table structure for table `school_admin`
--

CREATE TABLE `school_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_admin`
--

INSERT INTO `school_admin` (`id`, `user_id`, `school_id`) VALUES
(1, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `solve_test`
--

CREATE TABLE `solve_test` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `test_id` int(10) UNSIGNED NOT NULL,
  `time_start` int(11) NOT NULL,
  `is_break` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_answer`
--

CREATE TABLE `student_answer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `test_id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `choice` char(1) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `skor` int(11) DEFAULT NULL,
  `uncertain` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_answer`
--

INSERT INTO `student_answer` (`id`, `user_id`, `test_id`, `question_id`, `choice`, `answer`, `skor`, `uncertain`) VALUES
(61, 46, 15, 4370, NULL, NULL, 0, NULL),
(62, 46, 15, 4369, NULL, NULL, 0, NULL),
(63, 46, 15, 4367, NULL, NULL, 0, NULL),
(64, 46, 15, 4372, NULL, NULL, 0, NULL),
(65, 46, 15, 4371, NULL, NULL, 0, NULL),
(66, 46, 15, 4375, NULL, NULL, 0, NULL),
(67, 46, 15, 4373, NULL, NULL, 0, NULL),
(68, 46, 15, 4368, NULL, NULL, 0, NULL),
(69, 46, 15, 4366, NULL, NULL, 0, NULL),
(70, 46, 15, 4374, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_profile`
--

CREATE TABLE `student_profile` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `classroom_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_profile`
--

INSERT INTO `student_profile` (`id`, `user_id`, `school_id`, `classroom_id`) VALUES
(18, 34, 1, 16),
(19, 35, 1, 16),
(20, 36, 1, 16),
(21, 37, 1, 16),
(22, 38, 1, 16),
(23, 39, 1, 16),
(24, 40, 1, 16),
(25, 41, 1, 16),
(26, 42, 1, 16),
(27, 43, 1, 16),
(28, 44, 1, 16),
(29, 45, 1, 16),
(31, 46, 1, 5),
(32, 47, 1, 5),
(33, 48, 1, 5),
(34, 49, 1, 5),
(35, 50, 1, 5),
(36, 51, 1, 5),
(37, 52, 1, 5),
(38, 53, 1, 5),
(39, 54, 1, 5),
(40, 55, 1, 5),
(41, 56, 1, 5),
(42, 57, 1, 5),
(43, 58, 1, 5),
(44, 59, 1, 5),
(45, 60, 1, 5),
(46, 61, 1, 5),
(47, 62, 1, 5),
(48, 63, 1, 5),
(49, 64, 1, 5),
(50, 65, 1, 5),
(51, 66, 1, 5),
(52, 67, 1, 5),
(53, 68, 1, 5),
(54, 69, 1, 5),
(55, 70, 1, 5),
(56, 71, 1, 5),
(57, 72, 1, 5),
(58, 73, 1, 5),
(59, 74, 1, 5),
(60, 75, 1, 5),
(61, 76, 1, 5),
(62, 77, 1, 5),
(63, 78, 1, 5),
(64, 79, 1, 6),
(65, 80, 1, 6),
(66, 81, 1, 6),
(67, 82, 1, 6),
(68, 83, 1, 6),
(69, 84, 1, 6),
(70, 85, 1, 6),
(71, 86, 1, 6),
(72, 87, 1, 6),
(73, 88, 1, 6),
(74, 89, 1, 6),
(75, 90, 1, 6),
(76, 91, 1, 6),
(77, 92, 1, 6),
(78, 93, 1, 6),
(79, 94, 1, 6),
(80, 95, 1, 6),
(81, 96, 1, 6),
(82, 97, 1, 6),
(83, 98, 1, 6),
(84, 99, 1, 6),
(85, 100, 1, 6),
(86, 101, 1, 6),
(87, 102, 1, 6),
(88, 103, 1, 6),
(89, 104, 1, 6),
(90, 105, 1, 6),
(91, 106, 1, 6),
(92, 107, 1, 6),
(93, 108, 1, 6),
(94, 109, 1, 6),
(126, 141, 1, 7),
(127, 142, 1, 7),
(128, 143, 1, 7),
(129, 144, 1, 7),
(130, 145, 1, 7),
(131, 146, 1, 7),
(132, 147, 1, 7),
(133, 148, 1, 7),
(134, 149, 1, 7),
(135, 150, 1, 7),
(136, 151, 1, 7),
(137, 152, 1, 7),
(138, 153, 1, 7),
(139, 154, 1, 7),
(140, 155, 1, 7),
(141, 156, 1, 7),
(142, 157, 1, 7),
(143, 158, 1, 7),
(144, 159, 1, 7),
(145, 160, 1, 7),
(146, 161, 1, 7),
(147, 162, 1, 7),
(148, 163, 1, 7),
(149, 164, 1, 7),
(150, 165, 1, 7),
(151, 166, 1, 7),
(152, 167, 1, 7),
(153, 168, 1, 7),
(154, 169, 1, 7),
(155, 170, 1, 7),
(156, 171, 1, 7),
(157, 172, 1, 8),
(158, 173, 1, 8),
(159, 174, 1, 8),
(160, 175, 1, 8),
(161, 176, 1, 8),
(162, 177, 1, 8),
(163, 178, 1, 8),
(164, 179, 1, 8),
(165, 180, 1, 8),
(166, 181, 1, 8),
(167, 182, 1, 8),
(168, 183, 1, 8),
(169, 184, 1, 8),
(170, 185, 1, 8),
(171, 186, 1, 8),
(172, 187, 1, 8),
(173, 188, 1, 8),
(174, 189, 1, 8),
(175, 190, 1, 8),
(176, 191, 1, 8),
(177, 192, 1, 8),
(178, 193, 1, 8),
(179, 194, 1, 8),
(180, 195, 1, 8),
(181, 196, 1, 8),
(182, 197, 1, 8),
(183, 198, 1, 8),
(184, 199, 1, 8),
(185, 200, 1, 8),
(186, 201, 1, 8),
(187, 202, 1, 8),
(188, 203, 1, 8),
(189, 204, 1, 8),
(190, 205, 1, 8),
(191, 206, 1, 9),
(192, 207, 1, 9),
(193, 208, 1, 9),
(194, 209, 1, 9),
(195, 210, 1, 9),
(196, 211, 1, 9),
(197, 212, 1, 9),
(198, 213, 1, 9),
(199, 214, 1, 9),
(200, 215, 1, 9),
(201, 216, 1, 9),
(202, 217, 1, 9),
(203, 218, 1, 9),
(204, 219, 1, 9),
(205, 220, 1, 9),
(206, 221, 1, 9),
(207, 222, 1, 9),
(208, 223, 1, 9),
(209, 224, 1, 9),
(210, 225, 1, 9),
(211, 226, 1, 9),
(212, 227, 1, 9),
(213, 228, 1, 9),
(214, 229, 1, 9),
(215, 230, 1, 9),
(216, 231, 1, 9),
(217, 232, 1, 9),
(218, 233, 1, 9),
(219, 234, 1, 9),
(220, 235, 1, 9),
(221, 236, 1, 9),
(222, 237, 1, 9),
(223, 238, 1, 9),
(224, 239, 1, 10),
(225, 240, 1, 10),
(226, 241, 1, 10),
(227, 242, 1, 10),
(228, 243, 1, 10),
(229, 244, 1, 10),
(230, 245, 1, 10),
(231, 246, 1, 10),
(232, 247, 1, 10),
(233, 248, 1, 10),
(234, 249, 1, 10),
(235, 250, 1, 10),
(236, 251, 1, 10),
(237, 252, 1, 10),
(238, 253, 1, 10),
(239, 254, 1, 10),
(240, 255, 1, 10),
(241, 256, 1, 10),
(242, 257, 1, 10),
(243, 258, 1, 10),
(244, 259, 1, 10),
(245, 260, 1, 10),
(246, 261, 1, 10),
(247, 262, 1, 10),
(248, 263, 1, 10),
(249, 264, 1, 10),
(250, 265, 1, 10),
(251, 266, 1, 10),
(252, 267, 1, 10),
(253, 268, 1, 10),
(254, 269, 1, 10),
(255, 270, 1, 10),
(256, 271, 1, 10),
(285, 295, 1, 13),
(286, 296, 1, 13),
(287, 297, 1, 13),
(288, 298, 1, 13),
(289, 299, 1, 13),
(290, 300, 1, 13),
(291, 301, 1, 13),
(292, 302, 1, 13),
(293, 303, 1, 13),
(294, 304, 1, 13),
(295, 305, 1, 13),
(296, 306, 1, 13),
(297, 307, 1, 13),
(298, 308, 1, 13),
(299, 309, 1, 13),
(300, 310, 1, 13),
(301, 311, 1, 13),
(302, 312, 1, 13),
(303, 313, 1, 13),
(304, 314, 1, 13),
(305, 315, 1, 13),
(306, 316, 1, 13),
(307, 317, 1, 13),
(308, 318, 1, 13),
(309, 319, 1, 13),
(310, 320, 1, 13),
(311, 321, 1, 13),
(312, 322, 1, 13),
(313, 323, 1, 13),
(314, 324, 1, 13),
(315, 325, 1, 13),
(316, 326, 1, 13),
(317, 327, 1, 13),
(318, 328, 1, 12),
(319, 329, 1, 12),
(320, 330, 1, 12),
(321, 331, 1, 12),
(322, 332, 1, 12),
(323, 333, 1, 12),
(324, 334, 1, 12),
(325, 335, 1, 12),
(326, 336, 1, 12),
(327, 337, 1, 12),
(328, 338, 1, 12),
(329, 339, 1, 12),
(330, 340, 1, 12),
(331, 341, 1, 12),
(332, 342, 1, 12),
(333, 343, 1, 12),
(334, 344, 1, 12),
(335, 345, 1, 12),
(336, 346, 1, 12),
(337, 347, 1, 12),
(338, 348, 1, 12),
(339, 349, 1, 12),
(340, 350, 1, 12),
(341, 351, 1, 12),
(342, 352, 1, 12),
(343, 353, 1, 12),
(344, 354, 1, 12),
(345, 355, 1, 12),
(346, 356, 1, 12),
(347, 357, 1, 12),
(348, 358, 1, 12),
(349, 359, 1, 11),
(350, 360, 1, 11),
(351, 361, 1, 11),
(352, 362, 1, 11),
(353, 363, 1, 11),
(354, 364, 1, 11),
(355, 365, 1, 11),
(356, 366, 1, 11),
(357, 367, 1, 11),
(358, 368, 1, 11),
(359, 369, 1, 11),
(360, 370, 1, 11),
(361, 371, 1, 11),
(362, 372, 1, 11),
(363, 373, 1, 11),
(364, 374, 1, 11),
(365, 375, 1, 11),
(366, 376, 1, 11),
(367, 377, 1, 11),
(368, 378, 1, 11),
(369, 379, 1, 11),
(370, 380, 1, 11),
(371, 381, 1, 11),
(372, 382, 1, 11),
(373, 383, 1, 11),
(374, 384, 1, 11),
(375, 385, 1, 11),
(376, 386, 1, 11),
(377, 387, 1, 11),
(378, 388, 1, 11),
(379, 389, 1, 11),
(380, 390, 1, 11),
(381, 391, 1, 11),
(382, 392, 1, 11),
(384, 393, 1, 14),
(385, 394, 1, 14),
(386, 395, 1, 14),
(387, 396, 1, 14),
(388, 397, 1, 14),
(389, 398, 1, 14),
(390, 399, 1, 14),
(391, 400, 1, 14),
(392, 401, 1, 14),
(393, 402, 1, 14),
(394, 403, 1, 14),
(395, 404, 1, 14),
(396, 405, 1, 14),
(397, 406, 1, 14),
(398, 407, 1, 14),
(399, 408, 1, 14),
(400, 409, 1, 14),
(401, 410, 1, 14),
(402, 411, 1, 14),
(403, 412, 1, 14),
(404, 413, 1, 14),
(405, 414, 1, 14),
(406, 415, 1, 14),
(408, 416, 1, 14),
(409, 417, 1, 14),
(410, 418, 1, 14),
(411, 419, 1, 14),
(412, 420, 1, 14),
(414, 421, 1, 14),
(415, 422, 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_course`
--

CREATE TABLE `teacher_course` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_course`
--

INSERT INTO `teacher_course` (`id`, `user_id`, `course_id`) VALUES
(8, 423, 3),
(9, 423, 4),
(10, 423, 13),
(11, 424, 17),
(12, 424, 5),
(13, 424, 22),
(14, 425, 11),
(15, 425, 16),
(16, 425, 8),
(17, 426, 20),
(18, 426, 18),
(19, 426, 19),
(20, 427, 6),
(21, 427, 9),
(22, 427, 10),
(23, 428, 29),
(24, 428, 15),
(25, 428, 7),
(26, 429, 28),
(27, 429, 14),
(28, 429, 21),
(29, 423, 24),
(30, 427, 23),
(31, 424, 26),
(32, 429, 27),
(33, 426, 28),
(34, 425, 12);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_profile`
--

CREATE TABLE `teacher_profile` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `nip` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_profile`
--

INSERT INTO `teacher_profile` (`id`, `user_id`, `school_id`, `nip`) VALUES
(5, 423, 1, '197511012006041007'),
(6, 424, 1, '196803181991031011'),
(7, 425, 1, ''),
(8, 426, 1, ''),
(9, 427, 1, '198105182008012012'),
(10, 428, 1, '198211132006042012'),
(11, 429, 1, '197912172010012011');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `classroom_id` int(10) UNSIGNED NOT NULL,
  `class_ladder_id` int(10) UNSIGNED DEFAULT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `duration` int(11) NOT NULL,
  `kkm` int(3) NOT NULL,
  `max_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `user_id`, `classroom_id`, `class_ladder_id`, `course_id`, `name`, `date`, `duration`, `kkm`, `max_value`) VALUES
(15, 423, 5, NULL, 3, 'Simulasi Matematika Wajib XII MIPA 1', '2021-03-27', 25, 75, 100),
(16, 428, 5, NULL, 29, 'Simulasi Bahasa Indonesia (Wajib)', '2021-03-27', 25, 75, 100),
(17, 423, 6, 10, 3, 'tes', '2021-03-20', 10, 75, 100);

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `testimoni` text NOT NULL,
  `image` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test_result`
--

CREATE TABLE `test_result` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `test_id` int(10) UNSIGNED NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `is_login` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` text NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `is_login`, `active`, `first_name`, `last_name`, `phone`, `image`, `address`) VALUES
(1, '127.0.0.1', 'admin@fixl.com', '$2y$12$XpBgMvQ5JzfvN3PTgf/tA.XwxbCOs3mO0a10oP9/11qi1NUpv46.u', 'admin@fixl.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1615871695, 0, 1, 'Admin', 'istrator', '081232578168', 'USER_1_1614003280.png', 'admin'),
(13, '::1', 'uadmin@gmail.com', '$2y$10$78SZyvKRKMU7nPCew9w4nOpEUmJ1SeTV4L4ZG2NXXSfbEaswqoepq', 'uadmin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1568678256, 1615780755, 0, 1, 'admin', 'Dinas', '00', 'USER_13_1568678463.jpg', 'jln mutiara no 8'),
(17, '::1', 'smanam@gmail.com', '$2y$10$NIx.vGJvX.a/6J1/Yha1beTeSpb8xvMr5q2mbgpcZ2/2gOMk5.KIS', 'smanam@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1575916410, 1616040675, 0, 1, 'Admin SMA', 'Negeri 6 Kendari', '081234567890', 'USER_17_1578449627.jpg', 'Jalan Banda'),
(18, '::1', 'zidni@gmail.com', '$2y$10$554DNYTB6fzLJoaWdKsFwOSt5v88LAdqO1SlxqRB1JjTYrvT4yMky', 'zidni@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1575919985, 1615884433, 0, 1, 'Al Zidni', 'Kasim', '081232578168', 'USER_18_1577108725.jpg', 'BTN Graha Mandiri Permai Blok K/07'),
(19, '::1', 'alzidni@gmail.com', '$2y$10$CpC0kMgMDYXYtag4Ba4pEe2KMzz2WKsVi4Tk.csIUi6dtrcTsO1oa', 'alzidni@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1575920027, 1616035883, 0, 1, 'Al Zidni', 'Kasim', '081232578167', 'USER_19_1615873888.png', 'BTN Graha Mandiri Permai Blok K/07'),
(20, '::1', 'abdul_samad@gmail.com', '$2y$10$fDq9A4muW0tMHxEFTOOelergR2R0jGgsOcUV1yOY8dCNatoqhkrbq', 'abdul_samad@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1578920748, 1615780235, 0, 1, 'Abdul Samad', 'S.Pd., M.Pd', '0321241414', 'default.jpg', 'Lorong Koila Puuwatu'),
(24, '::1', 'fiki@gmail.com', '$2y$10$zqQMQTEzCquoNaxgTUoNAOQFUOcCukdnTaqgge1YE0sjWBY04/AKq', 'fiki@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1578923029, NULL, 0, 1, 'Muh. Fiki', 'Ramadhan', '081234567890', 'default.jpg', 'Lorong Koila'),
(25, '::1', 'beni@gmail.com', '$2y$10$MN.fwpricYHFfD8/IZgzHuYI8yYHD4QHM4PmMRxWsbziQitZuDnk.', 'beni@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1578923029, NULL, 0, 1, 'Muh. Benni', 'Barakati', '081234567890', 'default.jpg', 'Jalan THR'),
(26, '::1', 'sindy@gmail.com', '$2y$10$I1JsK.p19F9j/vMmvBx40OCfeI5kmbO2Ltpi8HxYFGL370bd6rrdC', 'sindy@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1578923029, 1615780363, 0, 1, 'Sindy M.', 'Konggoasa', '081234567890', 'default.jpg', 'Jalan Konggoasa'),
(27, '::1', 'headmaster@gmail.com', '$2y$10$KpIBh8M3Te9JAypcooL94.bEkUNMi8ghUcCmPJDLQJMCbByxQVzVi', 'headmaster@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1581400377, 1615230938, 0, 1, 'Kepala Sekolah', 'ku', '081232578168', 'default.jpg', 'jalan'),
(29, '127.0.0.1', 'kharismayunitra@gmail.com', '$2y$10$j3fM.dzpMXtY9rT9As1x/OaufsF8IgN3FFlIff0pNvcdX8ODmQvpq', 'kharismayunitra@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615230796, 1615230853, 0, 1, 'Kharisma', 'Yunitra', '081232678168', 'default.jpg', 'Lorong Manggis'),
(34, '::1', 'abrisal@yahoo.com', '$2y$10$TptmQ.0DT1DPd/NJ6LXaoekkR7mQIQXSElRVKkrhz9jBXy7nOrBMq', 'abrisal@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615962837, NULL, 0, 1, 'ABRISAL', '.', '082346245702', 'default.jpg', '-'),
(35, '::1', 'putri@yahoo.com', '$2y$10$I3odScU7qqdweeD0D7lp.OgUFG4RqNAZWUnqYbN.G7PJvTslUVRf6', 'putri@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615962837, 1616036076, 0, 1, 'AGRIZIA ANGELVLYN PUTRI RONGKALOE', '.', '082269107537', 'default.jpg', '-'),
(36, '::1', 'aldi@yahoo.com', '$2y$10$BAKuVXwM31Au4aPF3cynLuD.IE3CfS/t7RxFRN57AqcpEQYisNfcK', 'aldi@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615962837, NULL, 0, 1, 'Aldi', '.', '085299366994', 'default.jpg', '-'),
(37, '::1', 'anggi@yahoo.com', '$2y$10$9nnK9aHIcZ1KBAu.ICe4DubROP5regQ9.P0BhybTaAWQAmZ7VmY4O', 'anggi@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615962837, NULL, 0, 1, 'ANGGI SAPITRI AYU', '.', '082339464721', 'default.jpg', '-'),
(38, '::1', 'fadillah@gmail.com', '$2y$10$3xcarJ1s8D9aPgoD4Nppyu4FL8VJQ/7OQ8HDFyXSafOPzyiouuVaG', 'fadillah@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615962837, NULL, 0, 1, 'Fadillah Mutmainah', '.', '082246804491', 'default.jpg', '-'),
(39, '::1', 'faturahman@yahoo.com', '$2y$10$4OwFloZfsHhOS.icqQtfgeDVEHQxKL3YQXYFDXijq3Hoyyr.bhPuu', 'faturahman@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615962837, NULL, 0, 1, 'Faturahman Albiadi', '.', '081382891558', 'default.jpg', '-'),
(40, '::1', 'febryan@gmail.com', '$2y$10$XfuK/wtDc6MelKP3JV1zLukESFXRiGr3nm4u8dReZGAgfeNW4yGeS', 'febryan@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615962837, NULL, 0, 1, 'Febryan Akuba', '.', '082242219212', 'default.jpg', '-'),
(41, '::1', 'ayulestari@yahoo.com', '$2y$10$QI5fx6rgAFe98ZU85ZtnC.yWhlYXJpm44nPhGyjt1pj6DYQlwCjyy', 'ayulestari@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615962837, NULL, 0, 1, 'HILDA AYU LESTARI', '.', '085756834891', 'default.jpg', '-'),
(42, '::1', 'khusnul@yahoo.com', '$2y$10$3Hz/t0rBZQmxQO0h.5tD5Oy9v7ZfQWQbp8bvZ59ptb.CYn4WrGP52', 'khusnul@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615962838, NULL, 0, 1, 'KHUSNUL KHATIMA', '.', '082346272324', 'default.jpg', '-'),
(43, '::1', 'faridrusdi@gmail.com', '$2y$10$Xf8CxHbyrFinKAp7RPZ3Q.JUrmx4SFu9iruxM1xNPamY9QH2GKiCC', 'faridrusdi@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615962838, NULL, 0, 1, 'MUHAMMAD FARID RUSDI', '.', '082293894029', 'default.jpg', '-'),
(44, '::1', 'rendi@gmail.com', '$2y$10$aHCUvsLDzGrNORt1w1GM/eSubKGUH9Vtmbsxkx1o.2ZED4qt/LZFW', 'rendi@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615962838, NULL, 0, 1, 'RENDI PURWANTO MUH. RIDWAN', '.', '089681383400', 'default.jpg', '-'),
(45, '::1', 'ayulestari@gmail.com', '$2y$10$9zcsroeTpSfBysAvYeAd5.kJLCmElpg.i2tA/qp7itdoyR7TXr8O.', 'ayulestari@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615962838, NULL, 0, 1, 'Riska Ayu Lestari', '.', '082153032087', 'default.jpg', '-'),
(46, '::1', 'aqila@yahoo.co.id', '$2y$10$HSyNocamHrfzPHQ7oubBc.Xk6XGEB0EhKUOWWXkL5g4KFIiZAhgP2', 'aqila@yahoo.co.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964517, 1616040900, 0, 1, 'A\'QILA NUR RAMADHANI', '.', '082385854915', 'default.jpg', 'jalan'),
(47, '::1', 'abdulrahman@yahoo.com', '$2y$10$9E9u2ozvy4afavsv.Yv98uqV1RGLoIY5adnZusOogZ3TqIjht4pHy', 'abdulrahman@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964517, NULL, 0, 1, 'Abdul Rahman Umar', '.', '082210453493', 'default.jpg', 'jalan'),
(48, '::1', 'cahyadi@yahoo.co.id', '$2y$10$0pbqDn1MIB6i8x7xf.2ZYuwcedrdSwIDlgiunWw8qS27yvQiNdJV2', 'cahyadi@yahoo.co.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964517, NULL, 0, 1, 'Ahmad Cahyadi', '.', '082349604216', 'default.jpg', 'jalan'),
(49, '::1', 'magfira@yahoo.com', '$2y$10$HT5jUx0e4O8Ptd5stZIdKumVKCgg4QB7B.1nW0mlB7CKoTpCH4DHG', 'magfira@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964517, NULL, 0, 1, 'Alifia Insani Magfira', '.', '081340388882', 'default.jpg', 'jalan'),
(50, '::1', 'ratuaulia@yahoo.com', '$2y$10$efADi414uFCnmFR4UqYweeyzDKQUKi6FTiaKJGRC/YqMo2ydeg6aC', 'ratuaulia@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964517, NULL, 0, 1, 'ANDI FADILLAH RATU AULIA', '.', '082296688685', 'default.jpg', 'jalan'),
(51, '::1', 'aqilah@yahoo.com', '$2y$10$iCSnj7dQ/56GJQMBTo0LGOSusnv9QYBOfIr45/bkDr13CzgYVovra', 'aqilah@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964517, NULL, 0, 1, 'Aqilah Hisyam Toruntju', '.', '082393343823', 'default.jpg', 'jalan'),
(52, '::1', 'mursyid@gmail.com', '$2y$10$Q7REeav3cZGZjlZHL/rTW.P.PUEIqQdbeGIF.Oyw/KerBA/ZqcJeW', 'mursyid@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964517, NULL, 0, 1, 'ARDANA MURSYID', '.', '089682320800', 'default.jpg', 'jalan'),
(53, '::1', 'asmirana@gmail.com', '$2y$10$l0OYEjru5a57B/7ITa84JOFPjqJL1mjPoI4l5wiEsQfXVWa4lb9DW', 'asmirana@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964517, NULL, 0, 1, 'ASMIRANDA', '.', '085333700284', 'default.jpg', 'jalan'),
(54, '::1', 'musakti@yahoo.com', '$2y$10$lWEklFCqwpJklsLJJCIfBeQfz/Te3zGh/eyyTG2rEMSKJTDEkI3r2', 'musakti@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964517, NULL, 0, 1, 'AULIA Z.A. MUSAKTI', '.', '085346142476', 'default.jpg', 'jalan'),
(55, '::1', 'chevin@gmail.com', '$2y$10$r2PKamVehUz8VsH/sQgHtO3ax.pbrFcv8FNfKDITJikqM6nPeYnPa', 'chevin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964517, NULL, 0, 1, 'Chevin Breemer', '.', '082292556335', 'default.jpg', 'jalan'),
(56, '::1', 'cicisyaumi@gmail.com', '$2y$10$7QhDcVHyIYj5CrLItbYvE.vpWhEgtHja0/4ZvprqB3Xjtxi9rpkcm', 'cicisyaumi@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964518, NULL, 0, 1, 'Cici Syaumi Rachmadani', '.', '085967074386', 'default.jpg', 'jalan'),
(57, '::1', 'dewirahmawati@yahoo.com', '$2y$10$f0mq3x5ceuri5sTmGVAuiOkOmiXtVzL8vBSKSfHtbx8zrSgI/qP4W', 'dewirahmawati@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964518, NULL, 0, 1, 'Dewi Rahmawati', '.', '085254306485', 'default.jpg', 'jalan'),
(58, '::1', 'elaayu@yahoo.co.id', '$2y$10$PyJV56ZeDj4eyy4Ys6dDlubdDjWb9iiPzJygvqoYw6iOI79V6a5ky', 'elaayu@yahoo.co.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964518, NULL, 0, 1, 'ELA AYURIANTI MARSHAL', '.', '083138603621', 'default.jpg', 'jalan'),
(59, '::1', 'erfandi@yahoo.com', '$2y$10$Vp45XqfUyxoDewypBpXyj..qZrgkWpYal0XbsKCUh2N/DcHuuIJYW', 'erfandi@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964518, NULL, 0, 1, 'ERFANDI VARELLIO ILHAM', '.', '082264820596', 'default.jpg', 'jalan'),
(60, '::1', 'faridakbar@gmail.com', '$2y$10$HWzNzt/KURAA4hrsINo9OuM1omeTJsvJNv4L1maHGaOA96UDVq8Qm', 'faridakbar@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964518, NULL, 0, 1, 'FARID AKBAR', '.', '085341125283', 'default.jpg', 'jalan'),
(61, '::1', 'fasya@yahoo.com', '$2y$10$J7i3j66pOEkGtHbi/vj6YOHAOMIQFT7ue9PLpGyrVJRdV8rmB.zUm', 'fasya@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964518, NULL, 0, 1, 'FASYA ISLAMI PUTRI', '.', '087804112261', 'default.jpg', 'jalan'),
(62, '::1', 'fenny@gmail.com', '$2y$10$yEyIeWGu.vsf0cs.MONUm.BviI835wrsdpyQKWmHNRxzI1XTjWSL6', 'fenny@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964518, NULL, 0, 1, 'FENNY MELANI', '.', '082187201941', 'default.jpg', 'jalan'),
(63, '::1', 'tippa@gmail.com', '$2y$10$0DxO6henmOujvhFRxiYZI.cVRIwu3q8WTxLIvfie1lqXo8dd4rJ9W', 'tippa@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964518, NULL, 0, 1, 'HEILZHINSKY R. LA TIPPA', '.', '082244964408', 'default.jpg', 'jalan'),
(64, '::1', 'irmayanti@gmail.com', '$2y$10$DHED/Abhv7zjmUE.Vw6Uw.l9WnAIMqg7Q/cuvK/k5Ex/PRrBxhVmu', 'irmayanti@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964518, NULL, 0, 1, 'IRMA YANTI', '.', '082344425599', 'default.jpg', 'jalan'),
(65, '::1', 'marni@gmail.com', '$2y$10$aUlpMI4v0gmWl8S5D7wR8uhZAyLC4OLRpUVMsCQ/.kB0ehpI/iE0G', 'marni@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964518, NULL, 0, 1, 'Marni', '.', '087853885941', 'default.jpg', 'jalan'),
(66, '::1', 'meldayanti@yahoo.com', '$2y$10$pLXGD187g1B8f6lPkBtOrugFLJDMyJ2yNLf0FVhXdV6NZIELiO0ZW', 'meldayanti@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964518, NULL, 0, 1, 'MELDAYANTI', '.', '085256109346', 'default.jpg', 'jalan'),
(67, '::1', 'nurmilasari@yahoo.com', '$2y$10$bIwf6Bs6ZTJC5YgaLNacheoKpiMwDOg7y4MijCLHHJtfH75low.qi', 'nurmilasari@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964519, NULL, 0, 1, 'Nurmila Sari', '.', '085299993950', 'default.jpg', 'jalan'),
(68, '::1', 'putrianalestari@yahoo.com', '$2y$10$k3VQPTfI5Sjzxux1IYylBuTb/5Y79EzOdqL62KyfKTZj/CUUsXACS', 'putrianalestari@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964519, NULL, 0, 1, 'PUTRIANA LESTARI', '.', '087885090254', 'default.jpg', 'jalan'),
(69, '::1', 'reginaamalia@yahoo.com', '$2y$10$rthsDS2xXTCwUwHUGjrw5efT239Mdum4mP/R3gyWM527U9JD.Gc6a', 'reginaamalia@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964519, NULL, 0, 1, 'REGINA AMALIA', '.', '082238367868', 'default.jpg', 'jalan'),
(70, '::1', 'rikanirmalasari@yahoo.com', '$2y$10$LMLQ3gtmpfRRL1O5GkRVMut4wD2d8Pw6g63Cr535r8k8ZNkK7W93S', 'rikanirmalasari@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964519, NULL, 0, 1, 'RIKA NIRMALASARI', '.', '085281716688', 'default.jpg', 'jalan'),
(71, '::1', 'riskacahya@gmail.com', '$2y$10$mFeXot4vJiZ0AEJz3A9WnuQJsoWV8wzKSO2yEL8d25cxZxgQ29Vti', 'riskacahya@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964519, NULL, 0, 1, 'RISKA CAHYANINGSI', '.', '087806356149', 'default.jpg', 'jalan'),
(72, '::1', 'riyanbagus@gmail.com', '$2y$10$C4WH7ivMCbXY4cEwIydaYe8FVF2tRgp4SsGL73n1XTH5HIZkJZxHi', 'riyanbagus@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964519, NULL, 0, 1, 'Riyan Bagus Saputra', '.', '087825510318', 'default.jpg', 'jalan'),
(73, '::1', 'sartia@gmail.com', '$2y$10$zDD0ylYWAOftDeG851T5JOP7YSCoQIZb2tbRHp3wf5OGSDKAAQ.FS', 'sartia@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964519, NULL, 0, 1, 'SARTIA', '.', '082346584127', 'default.jpg', 'jalan'),
(74, '::1', 'sittiazzahra@gmail.com', '$2y$10$sYaOaqQRzywhF/3Ddr35w.CpkKImnzQVJNpb30Sdlt9s6fqcaT6C.', 'sittiazzahra@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964519, NULL, 0, 1, 'SITTI AZZAHRA', '.', '087701508822', 'default.jpg', 'jalan'),
(75, '::1', 'sucirahmadani@gmail.com', '$2y$10$clhKJ0fC11D3DKyrlVk01Od1QtmMThxuzR7Oumod4hqkKaXgDQrfm', 'sucirahmadani@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964519, NULL, 0, 1, 'SUCI RAHMADANI', '.', '085256291969', 'default.jpg', 'jalan'),
(76, '::1', 'waodeayuningsih@yahoo.com', '$2y$10$Oi5GtWM7879xSkFam9zq6OrJZrpuI0hwCN2l8WExITAROrThl5zKW', 'waodeayuningsih@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964519, NULL, 0, 1, 'WA ODE AYUNINGSYAH AGU', '.', '087701508822', 'default.jpg', 'jalan'),
(77, '::1', 'waodesiti@yahoo.com', '$2y$10$U7Xbx5ThOaFtnDzjAHxNjOX1CGfgdfT76O/CYIcx6mXcTZfmGuY.i', 'waodesiti@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964519, NULL, 0, 1, 'WA ODE SITI THAHIRAH', '.', '082362832507', 'default.jpg', 'jalan'),
(78, '::1', 'yulianus@yahoo.com', '$2y$10$Adak5WUFvARUFmZfbDpVd.89H/tA4DqP0XX7vYtBunD0CXKd6ZFWy', 'yulianus@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615964520, NULL, 0, 1, 'YULIANUS PALETTE', '.', '085333261287', 'default.jpg', 'jalan'),
(79, '::1', 'azis@yahoo.com', '$2y$10$s7bThA/EaD9bLDjmp7Cu5.TMgk4ztIs/DOLZiNOtMIvBSixkMBEXO', 'azis@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965105, 1616037422, 0, 1, 'ADRIANSYAH AZIS', '.', '082188177061', 'default.jpg', 'jalan'),
(80, '::1', 'gracia@yahoo.co.id', '$2y$10$uXqNZID.C5Ox7IQfjlrfHeHGL.1t5zd16z1HPEf1bZXhgCAI84Jc2', 'gracia@yahoo.co.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965105, NULL, 0, 1, 'Agnetha Gracia Allodatu', '.', '087886986322', 'default.jpg', 'jalan'),
(81, '::1', 'aisya@gmail.com', '$2y$10$obQ7uq.ey/XyXC5xyaJKleh2Jy/oIniijcrjQpkZEl4aO78xbwq7.', 'aisya@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965105, NULL, 0, 1, 'AISYA FICESYA', '.', '082237074895', 'default.jpg', 'jalan'),
(82, '::1', 'azizul@yahoo.com', '$2y$10$rzccD8UIjj6zqpnTqP6NDOaXHSm9w6uwUjwJRdmsKqmJIVtDEM3dC', 'azizul@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965105, NULL, 0, 1, 'ALAMZAH AZIZUL JAYA', '.', '083131096374', 'default.jpg', 'jalan'),
(83, '::1', 'amriadit@yahoo.com', '$2y$10$uZVkXSz6JI7OabaCiEAFN.Kby0NEwTl.CFlYXfIieu0AclUjDhDQe', 'amriadit@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965105, NULL, 0, 1, 'AMRI ADIT', '.', '082261596745', 'default.jpg', 'jalan'),
(84, '::1', 'angelika@gmail.com', '$2y$10$ZRSsLBPjyvgNOiv6dR4ka.b7ip/UUOCm7zYLxNow5Qfhf9Y1iFwFC', 'angelika@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965105, NULL, 0, 1, 'Angelika Tri Rosanti Bachtiar', '.', '083132474879', 'default.jpg', 'jalan'),
(85, '::1', 'anggreani@yahoo.com', '$2y$10$bfFzL6W1yYkDtmd0huCH0.5qJrRpyakAOd1.JjHHXoZzcQywuTyNS', 'anggreani@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965105, NULL, 0, 1, 'ANGGREANI NAWANG WULAN', '.', '085230397650', 'default.jpg', 'jalan'),
(86, '::1', 'anissasmita@yahoo.com', '$2y$10$EHHJIfh18hdmcBefk4V.NeoxWuzMJn5DIsGuynFkVzUkVPnmG142G', 'anissasmita@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965105, NULL, 0, 1, 'ANIS SASMITA', '.', '085217706577', 'default.jpg', 'jalan'),
(87, '::1', 'bryanotneal@yahoo.com', '$2y$10$Z/G5PiApIJlBZocLZW4KXe5JKvmLMw7jjX5gN.JL6QYHRc8gl5bti', 'bryanotneal@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965105, NULL, 0, 1, 'BRYAN OTNEAL SETO', '.', '082189094717', 'default.jpg', 'jalan'),
(88, '::1', 'bungarahma@yahoo.com', '$2y$10$MxQppFrwgeNAuIOHcdXcqO/OPZ7ybVawyOLCREtDtHVzK71HdbsQ2', 'bungarahma@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965105, NULL, 0, 1, 'BUNGA RAHMADANTI', '.', '082231274556', 'default.jpg', 'jalan'),
(89, '::1', 'dhitalia@gmail.com', '$2y$10$iVR8YYsMNWEku0P.RGaB8uwWQWMvXyOe6YOEGe8M.Oe3fUf/euGjG', 'dhitalia@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965106, NULL, 0, 1, 'Dhitalia Ramadhani', '.', '082290810835', 'default.jpg', 'jalan'),
(90, '::1', 'dynasti@yahoo.com', '$2y$10$c6DVPfaE4SLYsng2CUnb6.z3Yuy/c3.uXADLo1Ya9DtiWkOhueB2O', 'dynasti@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965106, NULL, 0, 1, 'DYNASTI', '.', '082187888567', 'default.jpg', 'jalan'),
(91, '::1', 'elispengge@yahoo.com', '$2y$10$cdO462Q2OuszB5qNSLGXLev/LqMptYOaFXOvS995ltq.nlxaHfaHO', 'elispengge@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965106, NULL, 0, 1, 'ELIS PENGGE', '.', '081341692202', 'default.jpg', 'jalan'),
(92, '::1', 'evaselvia@yahoo.com', '$2y$10$O3eE6h9e1xgtFT7XquUe3.mzepOEgentfGIzD/jml3dzntEuamWya', 'evaselvia@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965106, NULL, 0, 1, 'EVA SELVIA', '.', '082241381621', 'default.jpg', 'jalan'),
(93, '::1', 'fathur@yahoo.com', '$2y$10$X5vzlmm/80hRjxmTtyGGOO.PtOmPHAuxkJAntZYCed/a4NUnCe.Fq', 'fathur@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965106, NULL, 0, 1, 'FATHUR RAHMAN', '.', '085298677649', 'default.jpg', 'jalan'),
(94, '::1', 'ferdiyansa@yahoo.com', '$2y$10$UZTJXUZzCR9eXLrJhZ/EA.U6ifDO8S9tuiG0gTLfJdy/gvsxy3f7u', 'ferdiyansa@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965106, NULL, 0, 1, 'FERDIYANSA', '.', '082238639048', 'default.jpg', 'jalan'),
(95, '::1', 'geldys@gmail.com', '$2y$10$4HZ3oBkkV8f.J.1ODhkcSuW1aICaChWIDa2CR3Pb/IhtAYX8jE/X6', 'geldys@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965106, NULL, 0, 1, 'GLEDYS MARSITA M KONGGOASA', '.', '082292184719', 'default.jpg', 'jalan'),
(96, '::1', 'julfita@yahoo.co.id', '$2y$10$pQjrdX0p.nrk8BYjQey8henwxtTXtMfQmEKrhnH.6U0uq29thtWt2', 'julfita@yahoo.co.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965106, NULL, 0, 1, 'Julfita', '.', '082292979603', 'default.jpg', 'jalan'),
(97, '::1', 'alvito@gmail.com', '$2y$10$DMnMmQ6zgLqpQ1gA994vmeQbUuTr6yFAaFK.uP1ccMii6XcXgulTq', 'alvito@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965106, NULL, 0, 1, 'MUH. ALVITO', '.', '81234567890', 'default.jpg', 'jalan'),
(98, '::1', 'rifkhy@gmail.com', '$2y$10$.ZLHm4SE0bP1XRir1ZxGnOfRjHZHp6r.g0D/zjPDKXu4mp4MLjs.W', 'rifkhy@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965106, NULL, 0, 1, 'MUHAMMAD RIFKHY YUDHAWASTU', '.', '082385729685', 'default.jpg', 'jalan'),
(99, '::1', 'noviarni@gmail.com', '$2y$10$fjkjGU6kjUv3CdbPlWv3R.iwIrVIF2nYw.PFdfeoehPzN68XuwfSu', 'noviarni@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965106, NULL, 0, 1, 'NOVIARNI', '.', '085256466790', 'default.jpg', 'jalan'),
(100, '::1', 'novitasari@yahoo.com', '$2y$10$2jBpX2R0/pz8VQy90xzo9eF/L7ZzYMvMiutMCyZtWzeL4t0WAzzVa', 'novitasari@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965106, NULL, 0, 1, 'Novitasari Malisan', '.', '081344397657', 'default.jpg', 'jalan'),
(101, '::1', 'nurlena@gmail.com', '$2y$10$7H2x1nuuTf/MB2coME4V3uWm1LwTqpE6b0RsPANriMJki.92dCLc.', 'nurlena@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965107, NULL, 0, 1, 'NURLENA', '.', '085222314260', 'default.jpg', 'jalan'),
(102, '::1', 'nurul@gmail.com', '$2y$10$RDUtARj2d5zjHdpTnyt61eNuxJ0P99kuZldFOqFi22HVXT5RPPdRq', 'nurul@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965107, NULL, 0, 1, 'NURUL FHADILATUL AZ ZAHRA', '.', '085338576525', 'default.jpg', 'jalan'),
(103, '::1', 'nuryasintia@gmail.com', '$2y$10$Ue49Mois28cYwrfokHnNEeE4zvcx3eHSfC4.QUe/nZa6/FYCiyBa2', 'nuryasintia@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965107, NULL, 0, 1, 'Nurya Sintia Malik', '.', '081242532434', 'default.jpg', 'jalan'),
(104, '::1', 'sittirahma@yahoo.com', '$2y$10$oVIIRRgL1hWkhl1/i6fb8.Axbf.iZ2bhfCpfMCFMZ5pNIZl5FQb02', 'sittirahma@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965107, NULL, 0, 1, 'SITTI RAHMA DAHLAN', '.', '082315497880', 'default.jpg', 'jalan'),
(105, '::1', 'sulavias@yahoo.com', '$2y$10$d9.zM9FoSWHUCw.pbIRXXuCC7NmWf2C7phP251iZhutI7qNOezLTi', 'sulavias@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965107, NULL, 0, 1, 'Sulavias', '.', '085314714058', 'default.jpg', 'jalan'),
(106, '::1', 'tirzatrinizia@yahoo.com', '$2y$10$C5C1q2ihHpN1lbD50JFmKuKY38om3GlkQgMRiq.TvS7IdQp2DPZaG', 'tirzatrinizia@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965107, NULL, 0, 1, 'Tirza Trinizia Juniata', '.', '081341512299', 'default.jpg', 'jalan'),
(107, '::1', 'vhirasaf@yahoo.com', '$2y$10$9ukVT0UDL5F5O3BXMHeIUOM7BHtfmpVe7J.p7JurXYRp0WlkY77jS', 'vhirasaf@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965107, NULL, 0, 1, 'VHIRA SAFITRI HARUN', '.', '085342029002', 'default.jpg', 'jalan'),
(108, '::1', 'wandaayucantika@gmail.com', '$2y$10$R.pQAjyduoPJv2QXUpO0KuQAPFTqqcWV/y35cprxCj3Ti8zBNEta2', 'wandaayucantika@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965107, NULL, 0, 1, 'WANDA AYU CANTIKA', '.', '085331111504', 'default.jpg', 'jalan'),
(109, '::1', 'wiwindwi@yahoo.com', '$2y$10$/2kxHOERvmf2xnbp09tnVu9XAb5nLmfBsyMwgkniHnPjnndar.eie', 'wiwindwi@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965107, NULL, 0, 1, 'Wiwin Dwi Aryanti', '.', '081245791448', 'default.jpg', 'jalan'),
(141, '::1', 'candra@gmail.com', '$2y$10$APjaQ6Mg8JvkF44bjSfWdeeWbfeKRvQMb2rSUMuTharZlxg4AMw86', 'candra@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965506, NULL, 0, 1, 'ADI CANDRA', '.', '082292265940', 'default.jpg', 'jalan'),
(142, '::1', 'tamnge@yahoo.com', '$2y$10$rvxhX5ZMb3RDzEsNHLg/puHuSoqfGZvxoOffWFutXvdxw1Z4JJm9e', 'tamnge@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965506, NULL, 0, 1, 'ADONIA ANGGIAYU ELIZABETH TAMNGE', '.', '082293726200', 'default.jpg', 'jalan'),
(143, '::1', 'agustian@yahoo.com', '$2y$10$FGBTeBtYo80y5jfUI7FwzerExgllGsOqbn2hYzfxpjdd9R6tVcqLG', 'agustian@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965506, NULL, 0, 1, 'Agustian', '.', '081247849345', 'default.jpg', 'jalan'),
(144, '::1', 'ramadhani@yahoo.com', '$2y$10$CmkNnj850BLa8SZo11aAButJDZXdNReQVSdxElBJGosMdmgG.vMsC', 'ramadhani@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965506, NULL, 0, 1, 'AL FATHUR RAMADHANI', '.', '085340571983', 'default.jpg', 'jalan'),
(145, '::1', 'aldarisma@yahoo.com', '$2y$10$nLh/Jsg8jQh0/zEHhsD/Xu9OmPOMga6DsXmDKF9pWsNqFC2rQpJuu', 'aldarisma@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965506, NULL, 0, 1, 'ALDA RISMA', '.', '082348954190', 'default.jpg', 'jalan'),
(146, '::1', 'anitarahmadhani@yahoo.com', '$2y$10$ZB00nqzYy4MXrjFq1YAkeesit.kX9jPWQZ4iWzbTmEWb/D1uWdU7G', 'anitarahmadhani@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965506, NULL, 0, 1, 'Anita Rahmadhani', '.', '085931532627', 'default.jpg', 'jalan'),
(147, '::1', 'silvia@gmail.com', '$2y$10$FX321LOEWo.eMpe772CFBeNk4oessnq9Lid80hmDB2WZH2aqwaubO', 'silvia@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965506, NULL, 0, 1, 'ANJELITA SILVIA JAHAL', '.', '082198115008', 'default.jpg', 'jalan'),
(148, '::1', 'asninasela@gmail.com', '$2y$10$zLuGBzoWkdM.fOKIzAPXsetGfZE856fu.6is0tpQ0sfahAwblvS52', 'asninasela@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965506, NULL, 0, 1, 'Asnina Sela', '.', '082347971002', 'default.jpg', 'jalan'),
(149, '::1', 'bayuashar@gmail.com', '$2y$10$oevm4iZgrEvHSkySLkUdyONKTRk2bezOWm7Ii35fqCEwTDn1W2wwa', 'bayuashar@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965506, NULL, 0, 1, 'Bayu Ashar', '.', '082243641776', 'default.jpg', 'jalan'),
(150, '::1', 'cheni@gmail.com', '$2y$10$9g4xtEwfH8DZd3cNVUO7l.EqHo2xn3KV.ZN7CSrLBwRGlzrg2rogG', 'cheni@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965506, NULL, 0, 1, 'Cheni Pratiwi', '.', '085240598837', 'default.jpg', 'jalan'),
(151, '::1', 'endangsri@gmail.com', '$2y$10$tBoQpACIr.b6NiFhS9mY0.JXVWlcsbo86GQkA9cq.Cx9n45h00pzC', 'endangsri@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965507, NULL, 0, 1, 'ENDANG SRI WAHYUNI', '.', '082249455038', 'default.jpg', 'jalan'),
(152, '::1', 'eugenia@yahoo.com', '$2y$10$1gyjXAgkIiV4wHTTURGdkudA2Mhb4Ou9S5wfm0Kqwd9wIKkw4Sse6', 'eugenia@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965507, NULL, 0, 1, 'Eugenia Cananga', '.', '082235877552', 'default.jpg', 'jalan'),
(153, '::1', 'fitri@gmail.com', '$2y$10$svAjHKWWw4IHwpSaJG/snOw9hSZ6nM5zWtrVQgDUSD8BdzZemEaNW', 'fitri@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965507, NULL, 0, 1, 'Fitri', '.', '081523669102', 'default.jpg', 'jalan'),
(154, '::1', 'iitarwaihti@gmail.com', '$2y$10$yuStXfSEayAZAfq137SeMO8pFcFGiOH.mu0Ektc7mqdTAfqwnrS2y', 'iitarwaihti@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965507, NULL, 0, 1, 'IIT AL\' ARWAIHTI', '.', '082320303417', 'default.jpg', 'jalan'),
(155, '::1', 'mbagas@yahoo.com', '$2y$10$SMObqwhByPsm2kBFUi34TuwlWlVDB25vmsCQsKDaGExY/imW.Ae3G', 'mbagas@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965507, NULL, 0, 1, 'M. BAGAS', '.', '083132956112', 'default.jpg', 'jalan'),
(156, '::1', 'monikadoresta@yahoo.com', '$2y$10$2aQ3zJli89y.qj6iLqulWeUkT5r3OWp97HG9sl01IvoHMSJVJSeKi', 'monikadoresta@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965507, NULL, 0, 1, 'Monika Doresta', '.', '081245971425', 'default.jpg', 'jalan'),
(157, '::1', 'muhhendri@gmail.com', '$2y$10$qbfbi.yMGXcK1uEBCOuarud9Hs6LCVTSovXq7euF2Wulsphb6TAWq', 'muhhendri@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965507, NULL, 0, 1, 'MUHAMAD HENDRIAWAN', '.', '081324259304', 'default.jpg', 'jalan'),
(158, '::1', 'ariosaputra@gmail.com', '$2y$10$1QCRTnLDlMiJOcEUWaQD.u63G4xFCxSg37sCOw4cyhjhsRiMJzSCG', 'ariosaputra@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965507, NULL, 0, 1, 'MUHAMMAD ARIO SAPUTRA', '.', '085333654620', 'default.jpg', 'jalan'),
(159, '::1', 'nurapni@gmail.com', '$2y$10$UJPMgvmu.sQqvOpBPjBwKurAXn5H1ih6K.olADd.TiSjcjga5mSLS', 'nurapni@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965507, NULL, 0, 1, 'Nur\' Apni', '.', '082129947909', 'default.jpg', 'jalan'),
(160, '::1', 'nyomansri@yahoo.com', '$2y$10$ESpjaeNVq1mTh0P3.8MG6uMzfp2MdIVULFJoWve99OqrfzHaULsIe', 'nyomansri@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965507, NULL, 0, 1, 'NYOMAN SRI SYAH FITRI', '.', '082152854943', 'default.jpg', 'jalan'),
(161, '::1', 'rifaldi@gmail.com', '$2y$10$EFUy6gCYS6qq6FnyfbcqPOwxFS.i/Io7G0IYWo5nQamhIgi5j2aiO', 'rifaldi@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965507, NULL, 0, 1, 'RIFALDI', '.', '083131575237', 'default.jpg', 'jalan'),
(162, '::1', 'riskawulan@gmail.com', '$2y$10$w8svMjGaliv22ahsjMz6huqwbHnqXsL2FRfFNgPBK4W6WNvNZYoV2', 'riskawulan@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965508, NULL, 0, 1, 'RISKA WULANDARI', '.', '082321233567', 'default.jpg', 'jalan'),
(163, '::1', 'rismadayanti@yahoo.com', '$2y$10$194g1adEZ04qXgQ9lgf5/uYmChY1XJfK4IN10rgiFbD0hGCxabpeW', 'rismadayanti@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965508, NULL, 0, 1, 'RISMADAYANTI SAPITRI', '.', '082170158279', 'default.jpg', 'jalan'),
(164, '::1', 'sariska@gmail.com', '$2y$10$ccTOjdqQLMCXg.DQ5s1Hh.MysGFHyFQvxFhmVaGwI2tZ/c3cBtILa', 'sariska@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965508, NULL, 0, 1, 'SARISKA JULIANTI', '.', '082237713387', 'default.jpg', 'jalan'),
(165, '::1', 'sufilda@gmail.com', '$2y$10$oclUL4bNBrFEfy4EjhXVpOPKggqjwVojYi1oIi2mAof/cHzWkeLlu', 'sufilda@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965508, NULL, 0, 1, 'SUFILDA', '.', '085345802139', 'default.jpg', 'jalan'),
(166, '::1', 'sugiyanti@gmail.com', '$2y$10$E5jDbew3LPKx8mWSFRkkM.wOjAfJEQoJ7iLLKOh425vphn12Xtn0y', 'sugiyanti@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965508, NULL, 0, 1, 'SUGI YANTI', '.', '085333172748', 'default.jpg', 'jalan'),
(167, '::1', 'mulky@gmail.com', '$2y$10$W7BCl6Yx3c1Pcx3uepBvFugELJ3vCoqhjlRQjEvITn9Pb6rUUjJCm', 'mulky@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965508, NULL, 0, 1, 'SULHAFIZH MULKY LAWONUA', '.', '081242942393', 'default.jpg', 'jalan'),
(168, '::1', 'syarimsah@yahoo.com', '$2y$10$IQAFgjpupXpSqjd44HlWLeKt7h.ddXEyiMfJsx3FV2jW.VcUP5bBO', 'syarimsah@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965508, NULL, 0, 1, 'SYARIMSAH SEPTYAS SAGUNI', '.', '082249205563', 'default.jpg', 'jalan'),
(169, '::1', 'velani@gmail.com', '$2y$10$CAOas5HOtbfiNFDrfFdKXOubFFG6mTSlJYy.NyZk5h53.3P8mlfVK', 'velani@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965508, NULL, 0, 1, 'WA ODE VELANI FATMAYONE SALIHIN', '.', '081343555311', 'default.jpg', 'jalan'),
(170, '::1', 'yusuf@gmail.com', '$2y$10$LgM5W4KmVitsvvjv4e7cR.VlvGZO7caWCh1a5dqaCaiOvW1mG/QEK', 'yusuf@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965508, NULL, 0, 1, 'Yusuf Hamdani', '.', '081296275080', 'default.jpg', 'jalan'),
(171, '::1', 'yuyunadiputra@gmail.com', '$2y$10$WtgCH5YzY.DyO9m9JASeWOBvmGKUtS93Iv.c1ps8HFZSaUGF1XIcK', 'yuyunadiputra@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965509, NULL, 0, 1, 'YUYUN ADIPUTRA', '.', '081352225673', 'default.jpg', 'jalan'),
(172, '::1', 'annisah@gmail.com', '$2y$10$3pmzDB3Qnj9LhQJFx6AxguwSziaZMGi.W1jvuX3DYq6J11jZyw6hm', 'annisah@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965605, NULL, 0, 1, 'ANNISAH ASHARINI ROE', '.', '082246727329', 'default.jpg', 'jalan'),
(173, '::1', 'carolin@yahoo.com', '$2y$10$aisyWE2y/0J0BfabFdxiruHnHLIL0R9QJ9wGAHRojbxf/E6B8zL52', 'carolin@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965605, NULL, 0, 1, 'CAROLIN MAHARANI PUTRI', '.', '085945097557', 'default.jpg', 'jalan'),
(174, '::1', 'damar@yahoo.com', '$2y$10$WxiSZHoN2FTFlS6baxYcH.MzCCK1T5Nllb3isvEbRrhmReW57VKiS', 'damar@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965605, NULL, 0, 1, 'Damar Ramadhan Iskandar', '.', '081281023615', 'default.jpg', 'jalan'),
(175, '::1', 'dewisatyawati@yahoo.com', '$2y$10$3KPjOGPoWmFJ7KmrDivs0eCfM47so8YDsqKIx4PqgKHkUmLkIjnM6', 'dewisatyawati@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965605, NULL, 0, 1, 'Dewi Setyawati', '.', '082243264501', 'default.jpg', 'jalan'),
(176, '::1', 'elisya@gmail.com', '$2y$10$ofzhL2l4Q.geCbpmPwRBg.j7JdaUQR5f3Ec4mTh5EF9vMHGdx9.lm', 'elisya@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965605, NULL, 0, 1, 'Elisya Ramadhani', '.', '082348874424', 'default.jpg', 'jalan'),
(177, '::1', 'faradillahcahya@yahoo.com', '$2y$10$ltjxzpjaP.eOsdb.ja88kOGQkBWiijYiii4.sYaw8iEZISOUby.uC', 'faradillahcahya@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965605, NULL, 0, 1, 'Faradilla Cahya Wahyuni', '.', '082317711630', 'default.jpg', 'jalan'),
(178, '::1', 'imamkurniawan@gmail.com', '$2y$10$/DCjW8ChTfm4UcUp/K38oer78H.sAyffstyCh7nFpDlStj3EhItWS', 'imamkurniawan@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965605, NULL, 0, 1, 'IMAM HERMAWAN', '.', '082339471651', 'default.jpg', 'jalan'),
(179, '::1', 'irmayuningsi@yahoo.com', '$2y$10$lJ56KowHoDGBsbl8paPX1eKW1Q64AmfbzM1eco6qlakG9q0QjP6f.', 'irmayuningsi@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965606, NULL, 0, 1, 'IRMA YUNINGSI NUHUNG', '.', '087885531043', 'default.jpg', 'jalan'),
(180, '::1', 'irvanariesta@gmail.com', '$2y$10$6T0afVUK2p39HjQKH610OedM0n4VpJSUIK/4DlcJoxo7yEclHIcHq', 'irvanariesta@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965606, NULL, 0, 1, 'Irvan Ariesta Trisakti', '.', '082319184367', 'default.jpg', 'jalan'),
(181, '::1', 'kiaindo@yahoo.com', '$2y$10$N3VL8snbK4FOEjZZIKqR4OdpEH5B1b1lzr48a8yBYtAzmexLOUohy', 'kiaindo@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965606, NULL, 0, 1, 'KIA INDO ININDO IV. KARAMASA', '.', '082235903723', 'default.jpg', 'jalan'),
(182, '::1', 'ramadhan@gmail.com', '$2y$10$OWsbRzAA3GrXCbK0tAGgVeDhUVhtW0aAd4564UrP9NlJshLi2n6fm', 'ramadhan@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965606, NULL, 0, 1, 'LA ODE MUHAMMAD RAMADHAN', '.', '085241676087', 'default.jpg', 'jalan'),
(183, '::1', 'leonardomangundun@yahoo.com', '$2y$10$NBWhJTbOHwNOfIGkPcsL2epUhgIQdWr.o0GtRxxHVT1520zutehbK', 'leonardomangundun@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965606, NULL, 0, 1, 'LEONARDO MANGUNDUN', '.', '082290710586', 'default.jpg', 'jalan'),
(184, '::1', 'faadhil@yahoo.com', '$2y$10$DFjvlT0K7vg7BvafICdkZu1soH0OTbOE58CtfTQCve4ru.sV9THyO', 'faadhil@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965606, NULL, 0, 1, 'MD RAYHAAN FAADHIL', '.', '0', 'default.jpg', 'jalan'),
(185, '::1', 'awalulsubhan@yahoo.com', '$2y$10$SdFpZhp9kPyxqrIfkG9G7e2af/enZxzxgnyEzRmq83VJdrjInRdkq', 'awalulsubhan@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965606, NULL, 0, 1, 'MUH. AWALUL SUBHAN PRADANA SYAHPUTRA', '.', '081340455359', 'default.jpg', 'jalan'),
(186, '::1', 'raflisyahputra@yahoo.com', '$2y$10$AcwWLRkBVBhwRquPDANl6OSroNcBaiGE32Ah14iMJdL4saEdkdj2W', 'raflisyahputra@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965606, NULL, 0, 1, 'MUH. RAFLI SYAHPUTRA', '.', '082129947161', 'default.jpg', 'jalan'),
(187, '::1', 'saktiagus@gmail.com', '$2y$10$ig6LvU61aT8I5w05wTJBYOXx4QMioLb6d.nI4MiHVNNIzSyUOARQy', 'saktiagus@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965606, NULL, 0, 1, 'MUH. SAKTI AGUS PRAWIRA', '.', '082285608398', 'default.jpg', 'jalan'),
(188, '::1', 'salehbadawi@gmail.com', '$2y$10$n90543MVolSFdWoO6SZohOHOtqHr9qC.YEwGTVZCoYIWx0MLdj4Pe', 'salehbadawi@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965606, NULL, 0, 1, 'Muh. Saleh Badawi', '.', '082230415952', 'default.jpg', 'jalan'),
(189, '::1', 'arfanbasir@gmail.com', '$2y$10$4YrBFBKSVsERfYua.X9Pb.TLpxW5o33kzd9S3n8rgKu/HNu0dXzQW', 'arfanbasir@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965606, NULL, 0, 1, 'Muhammad Arfan Basir', '.', '081244752704', 'default.jpg', 'jalan'),
(190, '::1', 'muhfachri@gmail.com', '$2y$10$sLbOlkJlKS6aC97DVIE3eOslZzPHk1zjSsL3ENNhSMYzSxBFAbr/C', 'muhfachri@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965607, NULL, 0, 1, 'MUHAMMAD FACHRI', '.', '081271086743', 'default.jpg', 'jalan'),
(191, '::1', 'nandiashal@yahoo.com', '$2y$10$fknaLMHXr0iJKtIkDYvGuOLN3krPsj4FmWqOr8GWB.UMp8fvtTnPy', 'nandiashal@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965607, NULL, 0, 1, 'NANDIA SHALSABILA RAMADHANI', '.', '083136210133', 'default.jpg', 'jalan'),
(192, '::1', 'nikadewi@gmail.com', '$2y$10$7on9rYiFI/EoZY9234HpB.4UxefQy8uDMQHj9/nhj9Gn9PVidq0gK', 'nikadewi@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965607, NULL, 0, 1, 'NI KADE WIDHIAWARDANI', '.', '082260643457', 'default.jpg', 'jalan'),
(193, '::1', 'osamaladen@yahoo.com', '$2y$10$vX9ujmaKHje.wo7Ky2QyqOl/jHFFOx7pdKMqEQtMdv0lC1a66/9wi', 'osamaladen@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965607, NULL, 0, 1, 'OSAMA LADENAILAH', '.', '081244895745', 'default.jpg', 'jalan'),
(194, '::1', 'priliaresqy@gmail.com', '$2y$10$yvn9PYi7DC2g4qRQsND.FOZwdlTP./f5BBqv4j6OsP2muJyYFm8ui', 'priliaresqy@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965607, NULL, 0, 1, 'PRILIA RESQY RONNY', '.', '087881134174', 'default.jpg', 'jalan'),
(195, '::1', 'rafida@yahoo.com', '$2y$10$0FUvd07kgOQQNfE8tTzMeOanfSSYOXqPmvde5JHqR0GM6FclXzWba', 'rafida@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965607, NULL, 0, 1, 'RAFIDA NUR AFIFAH', '.', '081344493893', 'default.jpg', 'jalan'),
(196, '::1', 'reskinursyawal@yahoo.com', '$2y$10$sEJm.jZf35hup8u53wvpquTjzB8qEum1MIBW1pa2Nlm38sCrHl7yK', 'reskinursyawal@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965607, NULL, 0, 1, 'RESKI NURSYAWAL', '.', '082187396618', 'default.jpg', 'jalan'),
(197, '::1', 'rinirizki@gmail.com', '$2y$10$OYK7NAEwa.LBuVKBnAdeVOnWWArNe04wDu0SN/UvDRpAu5xRs3i/O', 'rinirizki@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965607, NULL, 0, 1, 'Rini Rizki Andriana', '.', NULL, 'default.jpg', 'jalan'),
(198, '::1', 'riskapratiwi@yahoo.com', '$2y$10$pinxjeZLhSpsMi6ZtvwoYu2z.k3IJu5.WYXUAPRLV.nK41iPN.F1G', 'riskapratiwi@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965607, NULL, 0, 1, 'Riska Pratiwi Iskandar', '.', '085341796009', 'default.jpg', 'jalan'),
(199, '::1', 'rivnul@yahoo.com', '$2y$10$u56vGjRBnnTkjminb4JZcOLRToqYrQ3o5kjGYsbpSPW00B9cddH/y', 'rivnul@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965607, NULL, 0, 1, 'RIVNUL SULISTIALIS', '.', '082190219604', 'default.jpg', 'jalan'),
(200, '::1', 'rohiyana@gmail.com', '$2y$10$JAcPcJ4xgQ6ZknKfdqUBf.HcV/.G/R08nDJwGy3SY3N1LTtT..YFO', 'rohiyana@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965607, NULL, 0, 1, 'Rohiyana', '.', '082292657311', 'default.jpg', 'jalan'),
(201, '::1', 'sandrina@gmail.com', '$2y$10$QkAAps2sXzbEyuDRLGH7CODS99YOfNlnE70j7N2NlEglImE9bbR0K', 'sandrina@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965607, NULL, 0, 1, 'SANDRINA', '.', '082293508238', 'default.jpg', 'jalan'),
(202, '::1', 'santisamriah@gmail.com', '$2y$10$7W6EpgM0K1aGnuQkZ7MVzemUhETfw7YP45Fi9.yMtHc33jZDsUREK', 'santisamriah@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965608, NULL, 0, 1, 'SANTI SAMRIAH', '.', '085396099202', 'default.jpg', 'jalan'),
(203, '::1', 'selviana@gmail.com', '$2y$10$RFbs3DfXAhlC6ImCSD7sYuO2B4XZG0ZK.7zOLBGyVNJXAmWYbufV6', 'selviana@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965608, NULL, 0, 1, 'SELVIANA', '.', '082349662950', 'default.jpg', 'jalan'),
(204, '::1', 'harlinaaha03@gmail.com', '$2y$10$a20ncoVkjmfbFS4Jlkqz9eduCdj4hOFphaTlFpctAwVgtL9tbg/0a', 'harlinaaha03@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965608, NULL, 0, 1, 'Wanda Wulandari', '.', '082187717771', 'default.jpg', 'jalan'),
(205, '::1', 'yulianimukma@gmail.com', '$2y$10$iwsXZFdW8aFJtuJICZ78Oelj6BjyiO5/4haQASMuaRFh9hSb3ICLi', 'yulianimukma@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965608, NULL, 0, 1, 'YULIANI MUKMA INNAH', '.', '085823240708', 'default.jpg', 'jalan'),
(206, '::1', 'pusparini@yahoo.com', '$2y$10$Ela5cLH18R2u0sJ.PSyWk.kVX1mdLWQDtdsO3MKcWd5SLjy9MYrQ2', 'pusparini@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965684, NULL, 0, 1, 'ADELIA PUSPARINI', '.', '082259260095', 'default.jpg', 'jalan'),
(207, '::1', 'ahmad@gmail.com', '$2y$10$gR1.pTPqNN1/hJOx9jYrVuJIaHoDx6JzlfZZMGsZJUMj2iSnCByfK', 'ahmad@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965684, NULL, 0, 1, 'AHMAD DARUSSALAM', '.', '082235742868', 'default.jpg', 'jalan'),
(208, '::1', 'ahmadyasin@gmail.com', '$2y$10$4yTjlbGfF1qMyUESF7ch0u02Yr9S/Lx6YhftxmVBenSRwUJlwhJge', 'ahmadyasin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965684, NULL, 0, 1, 'AHMAD YASIN KOSIM AL-DIDWAN', '.', '082216143730', 'default.jpg', 'jalan'),
(209, '::1', 'nurhasana@gmail.com', '$2y$10$H8f/m6YZmD9pJBt0Vb9PiuNSxpkGhWWqJd681U1rF9xcIXXn3bRJS', 'nurhasana@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965684, NULL, 0, 1, 'ANA NURHASANA', '.', '085340346325', 'default.jpg', 'jalan'),
(210, '::1', 'fachrurrozi@gmail.com', '$2y$10$xUjm.wrPmVZWkNu6c335/O1C1RNcfLRxYCzXy9oNzznm.g09cGNiK', 'fachrurrozi@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965684, NULL, 0, 1, 'Fachrurrozi Al-Afandy', '.', '082158663027', 'default.jpg', 'jalan'),
(211, '::1', 'ibrah@gmail.com', '$2y$10$BmoY9.TX/4A158y5h4o1Een0K.v5pJRByWDTS8cycFyGoxuab36pG', 'ibrah@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965684, NULL, 0, 1, 'FAKHYTAH IBRAH', '.', '082260866143', 'default.jpg', 'jalan'),
(212, '::1', 'gracenovi@yahoo.com', '$2y$10$NmYMI019Q6hp80m0LiNSw.Ma88EFSW0qPbDVUzY/Jun8i6fNa8hNu', 'gracenovi@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965684, NULL, 0, 1, 'GRACE NOVILAWATI TARRUA', '.', '085341135130', 'default.jpg', 'jalan'),
(213, '::1', 'harnina@gmail.com', '$2y$10$DlN8SiZxiVSBCNQpQENEKe.iYVYqN8loH7EkzCEDO5DVgTQQ8D0vi', 'harnina@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965684, NULL, 0, 1, 'HARNINA AGUSTINA', '.', '085341775055', 'default.jpg', 'jalan'),
(214, '::1', 'iksan@gmail.com', '$2y$10$Tg3eAY0zjFMHiFvCsYqlPu1vU65t7vkEPB4JmhhWNA/Qg6vu4ZsH.', 'iksan@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965684, NULL, 0, 1, 'IKSAN', '.', '082296651286', 'default.jpg', 'jalan'),
(215, '::1', 'irawati@gmail.com', '$2y$10$.Xf10wSyraNeUtT8L1tah.Vsm7fyqAvFv3O58OTN58/zfFe96XW66', 'irawati@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965685, NULL, 0, 1, 'Irawati', '.', '085342029850', 'default.jpg', 'jalan'),
(216, '::1', 'jelita@yahoo.com', '$2y$10$230YPsX72SZ8GJlMo9fmbOBmTUD0yJzP/BtQw77lfF6eyh7H5fD8C', 'jelita@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965685, NULL, 0, 1, 'JELITA', '.', '085237618374', 'default.jpg', 'jalan'),
(217, '::1', 'raziq@gmail.com', '$2y$10$1cEv4FW1dB1KW.GSvfEuXO29U3haOyCBUya.9ghOcwWozwcY2g4.S', 'raziq@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965685, NULL, 0, 1, 'LA ODE MUHAMMAD RAZIG', '.', '81234567890', 'default.jpg', 'jalan'),
(218, '::1', 'jiensan@yahoo.com', '$2y$10$qi1CvNTpPGZbP5.kvnmT9u2GY8Q40bDunvSbtmHePjNfOWMnvvEnG', 'jiensan@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965685, NULL, 0, 1, 'Maximillian Jiensan', '.', '085340843333', 'default.jpg', 'jalan'),
(219, '::1', 'adlifahrezy@gmail.com', '$2y$10$X3neKeAK.sbCmvwRXdn5XujJMm/EmzKM6anrjszuzTSEB1FuAYXMi', 'adlifahrezy@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965685, NULL, 0, 1, 'Muhammad Adli Fahrezy Tombora', '.', '085257109114', 'default.jpg', 'jalan'),
(220, '::1', 'muhhaikal@gmail.com', '$2y$10$lKnzDKrcHIB5i2xSLwNLo.EHE/a3YnuXz9N/ezY5h5CeBxtszMnEu', 'muhhaikal@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965685, NULL, 0, 1, 'Muhammad Haikal Kamil', '.', '085257109114', 'default.jpg', 'jalan'),
(221, '::1', 'muhiksan@gmail.com', '$2y$10$0bldQzjOrM/aWeDVgfjCIeQ4QN6aVqc6FGOGe6ba9rfHkJFy3QtNO', 'muhiksan@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965685, NULL, 0, 1, 'MUHAMMAD IKSAN TAWULO', '.', '085316972830', 'default.jpg', 'jalan'),
(222, '::1', 'naufal@gmail.com', '$2y$10$0jsJ9I5yASdtJi4tNfDN4.r/beHvPufXioYwV2glI0G3Okr/sS3jq', 'naufal@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965685, NULL, 0, 1, 'Muhammad Naufal Febriansyah Muchlis', '.', '085299863335', 'default.jpg', 'jalan'),
(223, '::1', 'sumitro@gmail.com', '$2y$10$4PTY2kIkkXqDybXouoYMcOqlnP9xNNt7jB7hDvy1r/AzblMdGC1Vu', 'sumitro@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965685, NULL, 0, 1, 'Muhammad Sumitro', '.', '082150111001', 'default.jpg', 'jalan'),
(224, '::1', 'musdalifa@gmail.com', '$2y$10$QF72Kaks3lZQmB09iNiAsOw9yvH5yFx/mkegLrb9OTueRWAh1h4I2', 'musdalifa@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965685, NULL, 0, 1, 'MUSDALIFA', '.', '0081285317357', 'default.jpg', 'jalan'),
(225, '::1', 'nikenr@gmail.com', '$2y$10$3jhEknTa2iJG4I5l.J3VxOLVCv8SW755Q000IsrcJ0r/P5f0nq/Ie', 'nikenr@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965685, NULL, 0, 1, 'NIKEN R', '.', '082193289227', 'default.jpg', 'jalan'),
(226, '::1', 'nurwanis@yahoo.com', '$2y$10$Zh4zF4pBUPtfxyJg5nGaz.AjpnRhBBhuF1Z2.c2uzO5qPLAZAERlK', 'nurwanis@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965686, NULL, 0, 1, 'NURWANIS', '.', '082349006570', 'default.jpg', 'jalan'),
(227, '::1', 'rahmafaucia@gmail.com', '$2y$10$k25oCXWJqb7z5ycB70.iwOajP01MBLODPSVMqbSYMU9iAMM09Aeka', 'rahmafaucia@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965686, NULL, 0, 1, 'Rahma Faucia', '.', '081527213200', 'default.jpg', 'jalan'),
(228, '::1', 'rahmad@yahoo.com', '$2y$10$X07Q8V82ZYRjgfBi2AGnIeRNsIpXZnhcdUWsGgPsLa/v0iHfvMlui', 'rahmad@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965686, NULL, 0, 1, 'RAHMAD', '.', '082193216650', 'default.jpg', 'jalan'),
(229, '::1', 'rijal@yahoo.com', '$2y$10$bSiDcK/1KifRyavTRW/ZHeV3pGjAScqfVlFr/Yv/DFSvLij87Fm2y', 'rijal@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965686, NULL, 0, 1, 'Rijal', '.', '082252060681', 'default.jpg', 'jalan'),
(230, '::1', 'risal@gmail.com', '$2y$10$cbv05i0tg6OcvEq9T23PqujE6k7Do10yNJUpuF1P7u0HJN4E2ilnu', 'risal@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965686, NULL, 0, 1, 'RISAL', '.', '082246809793', 'default.jpg', 'jalan'),
(231, '::1', 'ryoreski@gmail.com', '$2y$10$buvhMYRATAIvj3cATMxibuHLbv4MkfB/OX2ahQYOBl70hQl2fDBKy', 'ryoreski@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965686, NULL, 0, 1, 'RYO RESKI FEBRIAN', '.', '082246637294', 'default.jpg', 'jalan'),
(232, '::1', 'alayubim@gmail.com', '$2y$10$oed/kdl34d4rfIfMBTBGy.px3cVGoQavbyNfUsbR378ZixMBVyDLG', 'alayubim@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965686, NULL, 0, 1, 'Salahuddin Al Ayubi M', '.', '082129748414', 'default.jpg', 'jalan'),
(233, '::1', 'salsaangel@gmail.com', '$2y$10$lUY1X.ibUkfJLRlDVQAk5OruJAN0qzquTikFl3zCPfxV22cjdyKGG', 'salsaangel@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965686, NULL, 0, 1, 'SALSA ANGELICA SYAHWANI', '.', '087811130588', 'default.jpg', 'jalan'),
(234, '::1', 'samshul@gmail.com', '$2y$10$GulWRrOplwP7HUULX3xkZu5t1EKS/X4Tow.Xh2ED1zIwMeUwSA8re', 'samshul@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965686, NULL, 0, 1, 'Samshul Rizhal', '.', '082228898090', 'default.jpg', 'jalan'),
(235, '::1', 'sryyunita@gmail.com', '$2y$10$GlXHXSJKV436lXEeLkM.0.6h6aHDFkwEgktzki5D8ezmK2vXgvddW', 'sryyunita@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965686, NULL, 0, 1, 'SRY YUNITA', '.', '082193271357', 'default.jpg', 'jalan'),
(236, '::1', 'wilsonpasari@gmail.com', '$2y$10$nKMgBTXhmqMNH.cI991nT.I9yS6ECBhCfWA2FlfbsHveMYYUKlLPe', 'wilsonpasari@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965686, NULL, 0, 1, 'WILSON PASARI', '.', '085827895575', 'default.jpg', 'jalan'),
(237, '::1', 'yogasaputra@gmail.com', '$2y$10$utTXMEztkjFPOfk1aV.PD.rcF4kfnv2Uzx7iZK8JGuI8zQnBlAMCq', 'yogasaputra@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965687, NULL, 0, 1, 'YOGASAPUTRA EKO', '.', '082130263878', 'default.jpg', 'jalan'),
(238, '::1', 'yusma@yahoo.com', '$2y$10$m4Xld.3c1hVxDs6swSVunePhsOaMBz3tJ7ZY1sxnMkuWm.d8.HIGC', 'yusma@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615965871, NULL, 0, 1, 'YUSMA MARSELINDA YUSUF', '.', '085242078418', 'default.jpg', 'jalan'),
(239, '::1', 'ramadani@yahoo.co.id', '$2y$10$k6BNO6jJS2SqgJL5d0TiD.u/QnaUqHI2ssxU1km7Mn4/GI4n9Hkvy', 'ramadani@yahoo.co.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966024, NULL, 0, 1, 'ADELIA PUTRI RAMADANI', '.', '082271009447', 'default.jpg', 'jalan'),
(240, '::1', 'syafei@yahoo.co.id', '$2y$10$Wau5UaB33y.DivDperzbreQILUFwbgIX40d3EzHBMuy9iEsDzRCg2', 'syafei@yahoo.co.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966024, NULL, 0, 1, 'ALIF RACHMAN SYAFEI', '.', '082290806759', 'default.jpg', 'jalan'),
(241, '::1', 'ariotaisir@gmail.com', '$2y$10$tP1TOiYaOqqNyr5ZAHuV..3aRYyOnqKh5vS7rHOn17Jj4ovBwO0dq', 'ariotaisir@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966024, NULL, 0, 1, 'ARIO TAISIR GUNAWAN', '.', '082210881016', 'default.jpg', 'jalan'),
(242, '::1', 'defrila@yahoo.com', '$2y$10$7UgcQplrLrvBkOkQmdzBi.b0YrIdaqvy6Ddr5PrqO.0gdmKQoX53m', 'defrila@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966024, NULL, 0, 1, 'Defrila Tsabita Sande', '.', '082347974520', 'default.jpg', 'jalan'),
(243, '::1', 'dini@gmail.com', '$2y$10$A9OkWYmgldQ3WQlFH.pThO4lWOGZiA97z9m0dP/fDgaLeBO5MLOiS', 'dini@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966024, NULL, 0, 1, 'Dini', '.', '085255418335', 'default.jpg', 'jalan'),
(244, '::1', 'harmansyah@gmail.com', '$2y$10$zo5Y/BvUvGGiDL0iQhYDCuUAR7/Lebnfi.7E.4vHXlAsqlP.NKwNW', 'harmansyah@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966025, NULL, 0, 1, 'Harmansyah Parmin Ali', '.', '082398375773', 'default.jpg', 'jalan'),
(245, '::1', 'smaskartika328@gmail.com', '$2y$10$xGMlf86kQUbHpOluxZiMbO.BAaQzCBV71XJ1PoK4haK5AIiK/Ngs2', 'smaskartika328@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966025, NULL, 0, 1, 'Helmi Yahya', '.', '085281716511', 'default.jpg', 'jalan'),
(246, '::1', 'jordylies@gmail.com', '$2y$10$Sl.k9G6zwiGJAIjBAtx15uc0hQQ.wqck..eX5m.LCAAgymM0xn6ci', 'jordylies@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966025, NULL, 0, 1, 'JORDY LIESWAN', '.', '082198052970', 'default.jpg', 'jalan'),
(247, '::1', 'khairul@yahoo.com', '$2y$10$VV5xHJSHcXciI6TMNTuiuu32kOHzTLK6tObTYonKTNtV9ydwd.FMC', 'khairul@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966025, NULL, 0, 1, 'KHAIRUL FADHLI', '.', '082230553259', 'default.jpg', 'jalan'),
(248, '::1', 'lmjulian@yahoo.com', '$2y$10$KbVg.zYSuScD6iEnpOVZkeUrd/Z/NteX6jTry.EuLSSbSp/xY45Xy', 'lmjulian@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966025, NULL, 0, 1, 'L.M.JULIANSYAH', '.', '082287449677', 'default.jpg', 'jalan'),
(249, '::1', 'lestiawati@gmail.com', '$2y$10$MeTXFQqW1qqWfB/fO/uk6eES1.4y9l75Ll.GsSvdLtsT.nWzqjpxS', 'lestiawati@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966025, NULL, 0, 1, 'LESTIAWATI', '.', '082211205129', 'default.jpg', 'jalan');
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `is_login`, `active`, `first_name`, `last_name`, `phone`, `image`, `address`) VALUES
(250, '::1', 'feriyansyah@yahoo.com', '$2y$10$IFhFlQEYpsKxglgxqyAglu5sh21t1xLgZvIJkuNFgcrNumgKDM4fy', 'feriyansyah@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966025, NULL, 0, 1, 'MUH. FERIYANSYAH MUMEK', '.', '085298671991', 'default.jpg', 'jalan'),
(251, '::1', 'mahdin@gmail.com', '$2y$10$VN8RrFL7dhTJwwYhAESql.DYrBFXRMkHZ6RJt369KESHlPIDjAQHu', 'mahdin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966025, NULL, 0, 1, 'Muh. Mahdin Nasaruddin', '.', '082244966219', 'default.jpg', 'jalan'),
(252, '::1', 'shafarnuur@gmail.com', '$2y$10$Avh7dPcSNFvmOOGAhhbqzO/LtPCzAwIh4wm/RpbfsfKywtK9X4mu6', 'shafarnuur@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966025, NULL, 0, 1, 'MUH. SHAFAR NURJAYADI', '.', '085232065173', 'default.jpg', 'jalan'),
(253, '::1', 'faisalfajri@gmail.com', '$2y$10$ou/0WbQ9.F7HVNDGANncW.Ho6WO8vpScCMkDsfpR2WwDEgfubvqia', 'faisalfajri@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966025, NULL, 0, 1, 'MUHAMMAD FAIS ALFAJRI', '.', '082271299032', 'default.jpg', 'jalan'),
(254, '::1', 'rahmadani@gmail.com', '$2y$10$QT9f6tQySCl9ntUBTsDIpeVEVI2xmGL5HI2iKzrAHrdPhWegm3ymW', 'rahmadani@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966025, NULL, 0, 1, 'MUHAMMAD RAHMADANI', '.', '082235868749', 'default.jpg', 'jalan'),
(255, '::1', 'nining@yahoo.com', '$2y$10$RSzaUfTtXu.vMAlc4f5mc.BNsf5.Wp6JKxcMOfW/NaDp/lbnRzZuC', 'nining@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966026, NULL, 0, 1, 'NINING ELVITASARI NINGSI', '.', '082334644851', 'default.jpg', 'jalan'),
(256, '::1', 'nurannisa@gmail.com', '$2y$10$a/9/WOLNnoghdUpyaowJn.IL/wbKFvpEPdT1vHNnYu7byDhwgZM5O', 'nurannisa@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966026, NULL, 0, 1, 'NUR ANNISA', '.', '085333702916', 'default.jpg', 'jalan'),
(257, '::1', 'nurul@yahoo.com', '$2y$10$q6X3ZH39p5wz12AoUD4vau6EO5Wnuk4QguP5J/94HA5yIhCvBRwVu', 'nurul@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966026, NULL, 0, 1, 'Nurul Al Najiad', '.', '085823863320', 'default.jpg', 'jalan'),
(258, '::1', 'alfirahmat@gmail.com', '$2y$10$6S4/IbUZv0Ia/DeQM7KVzeeQw6SyqZrWnUzOAnBQsw5X3kjQUOEQ.', 'alfirahmat@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966026, NULL, 0, 1, 'PANGERAN ALFI RAHMAT RAMADAN', '.', '081525829510', 'default.jpg', 'jalan'),
(259, '::1', 'rahmanhidayat@gmail.com', '$2y$10$CjLJi//5ado05EgSIySFpesXa3nfS5CTlBVZjs9d3W.aS0hCtj766', 'rahmanhidayat@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966026, NULL, 0, 1, 'RAHMAN HIDAYAT', '.', '083135329525', 'default.jpg', 'jalan'),
(260, '::1', 'rini@gmail.com', '$2y$10$En/NAMA9xPHKXA3u7gyBMuEJINQ3/ZTyhdaEYtY.UVcGXtttBPA6i', 'rini@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966026, NULL, 0, 1, 'RINI', '.', '085231881475', 'default.jpg', 'jalan'),
(261, '::1', 'sabrina@yahoo.com', '$2y$10$Bkn0I0K5u4lxSiGTbvFgweIZ1S5CfPvBUjsH.XyQhyn7ZYlswZNXq', 'sabrina@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966026, NULL, 0, 1, 'Sabrina Ananda Akbar', '.', '081342339494', 'default.jpg', 'jalan'),
(262, '::1', 'sindiadelia@yahoo.com', '$2y$10$vRmAbw96AY1/paGSIy.cku3lvlms.ch0MtXWba50LljmRoIO.yewO', 'sindiadelia@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966026, NULL, 0, 1, 'Sindi Adelia Syamsuddin', '.', '081290503180', 'default.jpg', 'jalan'),
(263, '::1', 'sittiazah@gmail.com', '$2y$10$4.ly3GCj8ljvwb8LG.ykq.FQX/lF9oUgg6IOCOmwg8SQFgtVBmGUy', 'sittiazah@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966026, NULL, 0, 1, 'SITTI AZAH RANIATI SUARNO', '.', '085342016128', 'default.jpg', 'jalan'),
(264, '::1', 'stepi@yahoo.com', '$2y$10$c/oG62WU/bJZInpT0plqp.bFlK/SsZmK7DPrB.0NL0YZm5e9poA1G', 'stepi@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966026, NULL, 0, 1, 'STEPI', '.', '085298994124', 'default.jpg', 'jalan'),
(265, '::1', 'sukmawati@yahoo.com', '$2y$10$Gt3BpYKjNBZV1Mgpt.7ANuupPHvrNp36jHPDW4YUjRLZ.gdP6NcBy', 'sukmawati@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966026, NULL, 0, 1, 'SUKMAWATI', '.', '081343074479', 'default.jpg', 'jalan'),
(266, '::1', 'waodesaraswati@yahoo.com', '$2y$10$aQM0Em4y1t/6B0p./2OMwOys7yFCD25AuVWvqP3WbpyE00Os3R1ky', 'waodesaraswati@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966027, NULL, 0, 1, 'WAODE SARASWATI', '.', '085256254343', 'default.jpg', 'jalan'),
(267, '::1', 'wiwinaprilia@yahoo.com', '$2y$10$428rboIiT9y4AfpmBCXkI.lfu/WdDShqtBPVerbu5lcXG7IknXH3G', 'wiwinaprilia@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966027, NULL, 0, 1, 'WIWIN APRILIA', '.', '081355127730', 'default.jpg', 'jalan'),
(268, '::1', 'yuanita@gmail.com', '$2y$10$2PkvjNNQKFrIsZq8T3.mdOS.iefM34IXsEmniznrMeSua6ONcJgoS', 'yuanita@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966027, NULL, 0, 1, 'YUANITA ADINDA', '.', '082191609957', 'default.jpg', 'jalan'),
(269, '::1', 'yuliani@yahoo.com', '$2y$10$wCwRQaYkZiGaLFMoqlDeduu59oX/lHiZdNS0e1igl6.g1VlErttLy', 'yuliani@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966027, NULL, 0, 1, 'Yuliani', '.', '082253193009', 'default.jpg', 'jalan'),
(270, '::1', 'yuniar@yahoo.com', '$2y$10$IyfdyQSyIrEF7SljhAWID.VBWi4ay5tkgygjgpX1cxBYuO4r5liTC', 'yuniar@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966027, NULL, 0, 1, 'YUNIAR', '.', '081213487463', 'default.jpg', 'jalan'),
(271, '::1', 'yunita@yahoo.co.id', '$2y$10$H740dCvmeFgvYfBeGZBNOOEV9T6qnQ0kluqVX3S6f/DaHIFIl1MKG', 'yunita@yahoo.co.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966027, NULL, 0, 1, 'Yunita Aprilia', '.', '085217706577', 'default.jpg', 'jalan'),
(295, '::1', 'nagita@gmail.com', '$2y$10$E/R8WBBv5dARvA47.g3fdeS1ccW3sBJVW1QgvziBygcCYzncsf.Ry', 'nagita@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966533, NULL, 0, 1, 'ADHE MARSYA NAGITA PUTRI', '.', '085345433845', 'default.jpg', 'jalan'),
(296, '::1', 'aditiya@gmail.com', '$2y$10$e0EuuaX3evomjgXwVgGN7eJ4Ap2u9J8rHQeFGLlQ6Y9NGgrD3tqvC', 'aditiya@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966533, NULL, 0, 1, 'ADITIYA APRILIYANTO', '.', '082335822834', 'default.jpg', 'jalan'),
(297, '::1', 'mukti@gmail.com', '$2y$10$aIMOOnVkXbRoBtTVLPgu0.tO7beAOXH/oYMoRzhrwIKyMVBJ5LJTG', 'mukti@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966533, NULL, 0, 1, 'AHIMSA KRISNA MUKTI', '.', '085326987319', 'default.jpg', 'jalan'),
(298, '::1', 'pramuja@gmail.com', '$2y$10$Xt34WYVhv48HQFIK.bBkIeXu96nvjGXkqrDzfMt7ekYRf/ei0Hl.K', 'pramuja@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966533, NULL, 0, 1, 'AHMAD PRAMUJA', '.', '087877338650', 'default.jpg', 'jalan'),
(299, '::1', 'andini@yahoo.com', '$2y$10$sx0AWRM32n1IWlue.AfPtuog0ns3TL7nLUlv6.hxY0SmGNDty6t02', 'andini@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966533, NULL, 0, 1, 'Andini', '.', '081215873985', 'default.jpg', 'jalan'),
(300, '::1', 'anggie@gmail.com', '$2y$10$WUjkvcyTiMffy5NNQTSsXujqNVvmt1i4sA7sMITZLJU5po1CWxvEO', 'anggie@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966533, NULL, 0, 1, 'ANGGIE TYA DEARDY', '.', '082245059704', 'default.jpg', 'jalan'),
(301, '::1', 'ayudia@gmail.com', '$2y$10$/d3yDSnjI.3QzPqgM5K/guJJRZY1HZSoGh2ZytsWjUf1dCVt2ono.', 'ayudia@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966534, NULL, 0, 1, 'AYUDIA RISKA PEBRIANA', '.', '081240303405', 'default.jpg', 'jalan'),
(302, '::1', 'fatmawati@yahoo.com', '$2y$10$B3JCWJbDnh9eB3Tc9VLJtOgXVfB9CdsvjWl3/CBCe2zqOmKA/yaAC', 'fatmawati@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966534, NULL, 0, 1, 'Fatmawati Labamba', '.', '082290582733', 'default.jpg', 'jalan'),
(303, '::1', 'hardiono@gmail.com', '$2y$10$BB2CR23gE0ALjuZUKpQbge6U4mEc44l9gp8F/qLMC7k7JvzbohBbi', 'hardiono@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966534, NULL, 0, 1, 'HARDIONO', '.', '085256472820', 'default.jpg', 'jalan'),
(304, '::1', 'hartanti@gmail.com', '$2y$10$0GpzDZTj79iWp4KcYv1yo./eUkpKWgY.o361m4GObflK0XkVrt4UG', 'hartanti@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966534, NULL, 0, 1, 'HARTANTI DWI ANGGI SUJANA', '.', '081284030460', 'default.jpg', 'jalan'),
(305, '::1', 'imeldasafitriani@gmail.com', '$2y$10$wSzB8ZuSMyBqsqBwNStK0eub48wYBVzKodNXLRxQQB02Ri5benP4y', 'imeldasafitriani@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966534, NULL, 0, 1, 'Imelda Safitriani Saharuddin', '.', '081244856291', 'default.jpg', 'jalan'),
(306, '::1', 'indriana@gmail.com', '$2y$10$M4Kak6c4KQ7clE31AuRqTu0T5xLjip3JLrmVMDW24OvwbNakhWQwO', 'indriana@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966534, NULL, 0, 1, 'INDRIANA RAMADANI', '.', '082266926399', 'default.jpg', 'jalan'),
(307, '::1', 'jerana@yahoo.com', '$2y$10$Hsgt60YfxfkIheBgFvoO7u8JClhu858qNy7w7lenv9M3u15vM1ns.', 'jerana@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966534, NULL, 0, 1, 'JERANA', '.', '082259007937', 'default.jpg', 'jalan'),
(308, '::1', 'kristin@yahoo.co.id', '$2y$10$y4PKFhy4lkjKXq8F.hVLo.u.VLm.0c61ZwIjElYxTCmqQPSRJylJu', 'kristin@yahoo.co.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966534, NULL, 0, 1, 'KRISTIN FADILAH', '.', '085341133851', 'default.jpg', 'jalan'),
(309, '::1', 'kusdianto@yahoo.com', '$2y$10$b6tzsBDIuexh70u37rfqAOw1W1oaWpJyb0YP1aTYAxfNt1HKH6nR2', 'kusdianto@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966534, NULL, 0, 1, 'KUSDIANTO', '.', '0', 'default.jpg', 'jalan'),
(310, '::1', 'lasyukur@gmail.com', '$2y$10$OC/Ld5keRTndmkO2qMPjT.G6GaTNvXLyw6eIhLnYE2J4j2rUsQ7WK', 'lasyukur@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966534, NULL, 0, 1, 'Lasyukur', '.', '082244859889', 'default.jpg', 'jalan'),
(311, '::1', 'melansaputri@yahoo.com', '$2y$10$Z.Q6AAjN2qG5CKy22a5Yyel6bNmtyt7gHBRmfbHcTpT1NIlhc8Bo.', 'melansaputri@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966534, NULL, 0, 1, 'MELAN SAPUTRI', '.', '082393333697', 'default.jpg', 'jalan'),
(312, '::1', 'alifhikmatiar@gmail.com', '$2y$10$8IQUfBUMIltm2rcyDfn.de18wKDopkK.yFM14dMJWElwJTQ4BcOz2', 'alifhikmatiar@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966535, NULL, 0, 1, 'MOH. ALIF HIKMATIAR HARUN', '.', '081240834757', 'default.jpg', 'jalan'),
(313, '::1', 'akbbaristaman@yahoo.com', '$2y$10$iHJSq/Txy1o4PA1o3As5n.WMmay1TY9YU1p7eMW4x.9R1VTy/BDQS', 'akbbaristaman@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966535, NULL, 0, 1, 'MUH. AKBAR ISTAMAN', '.', '085254541209', 'default.jpg', 'jalan'),
(314, '::1', 'loudryaprilian@gmail.com', '$2y$10$1h6dN6ozxM4N1/Hu3ySTAe6B.Ef34Sd7uddnxibJnYB25ZekjyvDa', 'loudryaprilian@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966535, NULL, 0, 1, 'MUH. LOUDRY APRILIAN', '.', '082213735482', 'default.jpg', 'jalan'),
(315, '::1', 'sawal@gmail.com', '$2y$10$PGTzZ9x84O1kzGehDR0w/uRA3IoDfVNoOVG9LAeR4EENm12YsASZ2', 'sawal@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966535, NULL, 0, 1, 'MUH. SAWAL', '.', '083139274954', 'default.jpg', 'jalan'),
(316, '::1', 'agusalim@yahoo.com', '$2y$10$jv3YNmQ4pHu.4eghbziAQ.us4eGPrOe9wgDkFzjsTNce4tT9Bre5q', 'agusalim@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966535, NULL, 0, 1, 'Muhamad Agusalim', '.', '085341905826', 'default.jpg', 'jalan'),
(317, '::1', 'agung@gmail.com', '$2y$10$9sHkahXLOi7rcBBkCbwN/.7MkDOVKS65t8OTj3cdfmQ34ah2Sfbwe', 'agung@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966535, NULL, 0, 1, 'Muhammad Agung', '.', '085256282676', 'default.jpg', 'jalan'),
(318, '::1', 'mashut@gmail.com', '$2y$10$53E9u42vqFf1LEJif7J2D.GzmtEfMJzSTc.0J0lIKxpWiSJy2NCEK', 'mashut@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966535, NULL, 0, 1, 'MUHAMMAD YAFA\'ZHARRIF MASHUR', '.', '0', 'default.jpg', 'jalan'),
(319, '::1', 'nurliansri@gmail.com', '$2y$10$bEXkznvbBBGIgfUCfSR7uORpdqEsTCfaoEfPSKUszskbZqYAdXHhS', 'nurliansri@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966535, NULL, 0, 1, 'NURLIAN SRI YUNIANTI L', '.', '082334917147', 'default.jpg', 'jalan'),
(320, '::1', 'nurmaisah@gmail.com', '$2y$10$/actVZNh5osud013hILciOtuHcfB00oBxsw0QgeM1yE1XvXPyxWXe', 'nurmaisah@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966535, NULL, 0, 1, 'NURMAISAH', '.', '082348868079', 'default.jpg', 'jalan'),
(321, '::1', 'reskyardiansah@gmail.com', '$2y$10$aM6eW2/4e6k9w6rODn1IyuQordFNxaF2exTrMEgrcQgCVz9VxR8v2', 'reskyardiansah@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966536, NULL, 0, 1, 'RESKY ARDIANSAH PUTRA. S', '.', '085230926993', 'default.jpg', 'jalan'),
(322, '::1', 'salabas@gmail.com', '$2y$10$2XdIFTXn5bbUaRliG4Rl/Ozn.zEN6ShND0GjaN/ml9/6/w2bbhClu', 'salabas@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966536, NULL, 0, 1, 'Salabas', '.', '085281783675', 'default.jpg', 'jalan'),
(323, '::1', 'sarman@gmail.com', '$2y$10$tT1OWd8nI9ZJK5QetnXeruyP/RQ/khLzGVvFn2Hv2vVmuSnI1MqH6', 'sarman@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966536, NULL, 0, 1, 'Sarman', '.', '0', 'default.jpg', 'jalan'),
(324, '::1', 'suciananda@yahoo.com', '$2y$10$wvzEVgOaAV5O8JKLEtaMgekZqMwjrXxYPFAdhJi5HmnokbZJl5kZa', 'suciananda@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966536, NULL, 0, 1, 'SUCI NANDA AULIA', '.', '0', 'default.jpg', 'jalan'),
(325, '::1', 'syahrulkam@gmail.com', '$2y$10$QL0qkJ6igxxtq6c.tN4/BeHczYiDmZS6jN2r.cjArhMe247.ITqem', 'syahrulkam@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966536, NULL, 0, 1, 'SYAHRUL KAM', '.', NULL, 'default.jpg', 'jalan'),
(326, '::1', 'trizafaradila@gmail.com', '$2y$10$BaxdRKh3hi.Y/sIN.TGlC.TOwSuyvWs71/EULcjsDNyhCtoxhjAmO', 'trizafaradila@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966536, NULL, 0, 1, 'TRIZA FARADILA', '.', '082289726933', 'default.jpg', 'jalan'),
(327, '::1', 'yuliana@yahoo.com', '$2y$10$wIzYnUXZg1MkR.m8dpFRPem5MCMicAuZsDGFDG6CAmIC32siWX.UK', 'yuliana@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966536, NULL, 0, 1, 'Yuliana', '.', '085243265854', 'default.jpg', 'jalan'),
(328, '::1', 'fikrah@gmail.com', '$2y$10$q.R7iSgZAdORTRHvXJjik.4jBiTF.xmevp4Mjwvx8hZ9Gyjd3D05G', 'fikrah@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966755, NULL, 0, 1, 'A. Muhammad Fikrah', '.', '085346146431', 'default.jpg', 'jalan'),
(329, '::1', 'akmal@gmail.com', '$2y$10$ycFXzh5fWJpoZJ1jGVFSielQgdEkDxaJsCl57n5lcIV05/GSHBisy', 'akmal@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966755, NULL, 0, 1, 'AKMAL', '.', '085145438060', 'default.jpg', 'jalan'),
(330, '::1', 'alamsyah@yahoo.com', '$2y$10$ImgZwhIRzyv379hBmwYMFeexMPPt6oueYk4rWo12qIT.RA5Sr3A82', 'alamsyah@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966755, NULL, 0, 1, 'Alamsyah', '.', '087773307585', 'default.jpg', 'jalan'),
(331, '::1', 'alim@yahoo.com', '$2y$10$kZEhq5tSHubXMihWdahZ3ucEx4PC3xgf3PqF6krIl7Fbdj4WITXN6', 'alim@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966755, NULL, 0, 1, 'ALIM RAMADHANI ISFANDY', '.', '083131158827', 'default.jpg', 'jalan'),
(332, '::1', 'amitha@yahoo.com', '$2y$10$ZEoQSLDCZxu9gCAiJ8WlvO9CW3UXbR08V.mVM6Xfg8EbFUb//WCjq', 'amitha@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966755, NULL, 0, 1, 'Amitha Mulyanisa', '.', '081344444079', 'default.jpg', 'jalan'),
(333, '::1', 'sinarbulan@yahoo.com', '$2y$10$XUFhfGxV0sebIaCzHRC1Z.QeLBIUliyZsnibr9Al6P0hncu8cyt6e', 'sinarbulan@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966755, NULL, 0, 1, 'ANDI SINAR BULAN PURNAMA', '.', '082346267377', 'default.jpg', 'jalan'),
(334, '::1', 'asripul@yahoo.com', '$2y$10$Ub6h9SZWpgTywVZ6AEVI/erjSYPEjfBjzXzc90zVhIUsET2PJOxtS', 'asripul@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966755, NULL, 0, 1, 'Asripul', '.', '082291593613', 'default.jpg', 'jalan'),
(335, '::1', 'eraastriani@yahoo.com', '$2y$10$4QEiN/V9QO4ej/jF46nfN.n//sXBJJYTyZfH4ij6scxUV69NsGExi', 'eraastriani@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966756, NULL, 0, 1, 'ERA ASTRIANI', '.', '082271451767', 'default.jpg', 'jalan'),
(336, '::1', 'fajarsaputra@gmail.com', '$2y$10$z2FXE3DAnWIQTwg6Y35JV.cRYo3rPER7qaGltTVWGtuDnJVpGzsQC', 'fajarsaputra@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966756, NULL, 0, 1, 'FAJAR SAPUTRA', '.', '085333365043', 'default.jpg', 'jalan'),
(337, '::1', 'intanagus@gmail.com', '$2y$10$80haWuiNAjzw6tGZ0GEXruYdN/YVmFak.L1QLa0NoDd6W0p6jUoaK', 'intanagus@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966756, NULL, 0, 1, 'INTAN AGUS DJAELANI', '.', '082394485141', 'default.jpg', 'jalan'),
(338, '::1', 'liana@yahoo.com', '$2y$10$di0wkTYJiaGSJSAx9zffVO9n7RvWuHgvOQ0N.jg58KNf835WPWnNO', 'liana@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966756, NULL, 0, 1, 'LIANA', '.', '085254376649', 'default.jpg', 'jalan'),
(339, '::1', 'lisnavalencia@yahoo.com', '$2y$10$n6xQA15HVu6xzE0OC9QILOfsUn6nBIRSd6HbudvvWz1Nw9so5jYXO', 'lisnavalencia@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966756, NULL, 0, 1, 'Lisna Febri Valencia', '.', '085314284942', 'default.jpg', 'jalan'),
(340, '::1', 'mardani@yahoo.com', '$2y$10$1SS4CF6kStK2nd43dJAt/.h5vM8ElnvAKNISdtlkn0H2h6wbvDpIi', 'mardani@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966756, NULL, 0, 1, 'MARDANI SURYA PUTRA', '.', '082198120319', 'default.jpg', 'jalan'),
(341, '::1', 'maulmaul@gmail.com', '$2y$10$NGZdHrqHdCTl2SadvUc6YOLii4bEOCE/26rac80md2Speo8IWySqO', 'maulmaul@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966756, NULL, 0, 1, 'MAUL', '.', '082245058199', 'default.jpg', 'jalan'),
(342, '::1', 'trihikmat@gmail.com', '$2y$10$/1Ll6atoSNcsLW.a8QTOaeJKl.EecD7DpvDB1VJ1dRZxKLPhAz/YK', 'trihikmat@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966756, NULL, 0, 1, 'MUH TRI HIKMAT', '.', '082318274078', 'default.jpg', 'jalan'),
(343, '::1', 'aghylasbin@gmail.com', '$2y$10$ZmVYxAkPWd46XohD56LUgOl0XyKs7RhmcX17K6UcjVFusUpzKWDZO', 'aghylasbin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966756, NULL, 0, 1, 'Muh. Aghyl Asbin Tombora', '.', '081355881007', 'default.jpg', 'jalan'),
(344, '::1', 'ritnosetiawan@yahoo.com', '$2y$10$z2ghcfEZy0r6BD2s/Z4xRef5K.vVkW1WqKSfEP.h2sDyY59r.GLa.', 'ritnosetiawan@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966756, NULL, 0, 1, 'MUHAMMAD RITNO SETIAWAN', '.', '082347040273', 'default.jpg', 'jalan'),
(345, '::1', 'nurulal@gmail.com', '$2y$10$J16qHunC9CIjRGQJ63CbH./Ve7swkJx6yTneoNij3ZirXEcQXQMVO', 'nurulal@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966756, NULL, 0, 1, 'Nurul Alisyah Ridwan', '.', '085796923857', 'default.jpg', 'jalan'),
(346, '::1', 'prayudha@gmail.com', '$2y$10$xJ2YKZrj/2GzehvtkvV.IOmEktdWrCYm0TMH.NwvYTaxb55mr3wym', 'prayudha@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966757, NULL, 0, 1, 'PRAYUDHA SATRYAWAN HUSEN', '.', '081245687121', 'default.jpg', 'jalan'),
(347, '::1', 'putriyanti@gmail.com', '$2y$10$Zh5Tng.ItkmEdrwNwZzidem4givZrqVUcEK8AIyuRgNHdW1uln1l.', 'putriyanti@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966757, NULL, 0, 1, 'PUTRI YANTI', '.', '082219593670', 'default.jpg', 'jalan'),
(348, '::1', 'reskiwulan@gmail.com', '$2y$10$GHMJo2gRFHhEXxIK3ff6deZbrX0w6RrAofLWkUYUeWDxVV6bg5vXa', 'reskiwulan@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966757, NULL, 0, 1, 'RESKI WULANDASARI', '.', '082347042887', 'default.jpg', 'jalan'),
(349, '::1', 'restifadiyah@gmail.com', '$2y$10$efYYmXJOKR/DKOcECCRrSeDMlTo6cHuGx1EZWVeYl.SeZHLOC9K3q', 'restifadiyah@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966757, NULL, 0, 1, 'RESTI FADIYAH', '.', '085284000534', 'default.jpg', 'jalan'),
(350, '::1', 'riskaayu@yahoo.com', '$2y$10$aWkc1pFlC8CLApS2dey2XeSz405QdR52ITJXW70ck4/FY6oEZXQtC', 'riskaayu@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966757, NULL, 0, 1, 'Riska Ayu Pratiwi', '.', '082347021382', 'default.jpg', 'jalan'),
(351, '::1', 'wahyuni@gmail.com', '$2y$10$SF9QmTk2ziE0SCGALMmaJOu5OcRX2z6bxng.XJTuTVGHz/8f3Ia4.', 'wahyuni@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966757, NULL, 0, 1, 'SRI WAHYUNI NINGSIH', '.', '085213179638', 'default.jpg', 'jalan'),
(352, '::1', 'sriwulandari@gmail.com', '$2y$10$FEp6FhS/c9j6RC0evqhZrewdNVsphbZa.aWu2MdDWDmgAGuCcSlda', 'sriwulandari@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966757, NULL, 0, 1, 'SRI WULANDARI PUTRI', '.', '085323247944', 'default.jpg', 'jalan'),
(353, '::1', 'sucirahmadani@yahoo.com', '$2y$10$lrIJ9B4osd0p46gc001zeu67NcOw6odVDLv4zBINsQNqpXfYTLv6q', 'sucirahmadani@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966757, NULL, 0, 1, 'SUCI RAHMADANI', '.', '087800655810', 'default.jpg', 'jalan'),
(354, '::1', 'sumartina@yahoo.com', '$2y$10$AQ3lWuHxzj9kZvMjzIdM5.qyNG4AS2gLSyb305FRLaLcCNskMJcQG', 'sumartina@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966757, NULL, 0, 1, 'sumartina', '.', '082347638366', 'default.jpg', 'jalan'),
(355, '::1', 'suratzman@gmail.com', '$2y$10$.tJudgWdDlslVGjVg47eUeUo7l.LC5boOCg98Iw92PYW0RH0VTdl6', 'suratzman@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966757, NULL, 0, 1, 'SURATZMAN ALFARIS SIKOTA', '.', '082210786787', 'default.jpg', 'jalan'),
(356, '::1', 'wahyudi@gmail.com', '$2y$10$NNeoGd301hD/wWRtMhO8VeRGtf0mzjm5o1nRqnLALUxZ1PltnQrYe', 'wahyudi@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966757, NULL, 0, 1, 'Wahyudi', '.', '082198463945', 'default.jpg', 'jalan'),
(357, '::1', 'wdwildayanti@yahoo.com', '$2y$10$GIagFWjfHR3sNnVsKJ2YGebi4GNm8rrJU3MY2pCewQLDansH8YMoy', 'wdwildayanti@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966758, NULL, 0, 1, 'Wd. Wilda Yanti', '.', '085323250108', 'default.jpg', 'jalan'),
(358, '::1', 'yunita@yahoo.com', '$2y$10$MnnZHlh9t854/n9ATMUJ5OHpXDDvJ6F2C7T0XIAWAlfeB9wAH933e', 'yunita@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966758, NULL, 0, 1, 'YUNITA ANGGRAENI', '.', '082271493514', 'default.jpg', 'jalan'),
(359, '::1', 'nugraha@gmail.com', '$2y$10$u19xegb5NBsvQecgEsdg6egOUa9.PNRM/j0ygggcBWx3DXJmJqUBG', 'nugraha@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966953, NULL, 0, 1, 'ADITHYA NUGRAHA PRATAMA KUEN', '.', '085342179935', 'default.jpg', 'jalan'),
(360, '::1', 'putri@gmail.com', '$2y$10$yL3eP92/uAKNObAZtzlAVuXjYNtksqoENy1MgXs1xFcgVMA2Alv7K', 'putri@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966953, NULL, 0, 1, 'Aisya Alsa Putri', '.', '087859717185', 'default.jpg', 'jalan'),
(361, '::1', 'kirani@gmail.com', '$2y$10$XahLwQq3PIpFrIXkkHB0jOI4Xl3g1dhVmnBWUu7C7490wIryioCiC', 'kirani@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966953, NULL, 0, 1, 'Aiza Kirani', '.', '085299677204', 'default.jpg', 'jalan'),
(362, '::1', 'haris@yahoo.co.id', '$2y$10$negXdc18Z.ax10ntP8ijV.glFbLnsROA63NLxHst7AF3BKy.8dZ3a', 'haris@yahoo.co.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966954, NULL, 0, 1, 'AJRAN SURYA SETIAWAN HARIS', '.', '082290168858', 'default.jpg', 'jalan'),
(363, '::1', 'alamsyah@gmail.com', '$2y$10$2cRqlV9pBLjYdfKeOHGG5.G9wOIkM1Nl2tCURMPR/rp2yodsSgv5i', 'alamsyah@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966954, NULL, 0, 1, 'Akbar Alamsyah', '.', '082213828033', 'default.jpg', 'jalan'),
(364, '::1', 'amanda@yahoo.co.id', '$2y$10$fm0GAps7osGybhIEqEUfr.GypZVmAq0d6my8L4TEcZb6JNq7WRSF6', 'amanda@yahoo.co.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966954, NULL, 0, 1, 'AMANDA FITRIA RAHMAT', '.', '082231278360', 'default.jpg', 'jalan'),
(365, '::1', 'ramadani@yahoo.com', '$2y$10$znn.06FogbqxHd.XdsfucugIZ0c5IAtS4ICGN/MzFXZmn04Qax7hm', 'ramadani@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966954, NULL, 0, 1, 'AMELIA SRI RAMADANI', '.', '085343737509', 'default.jpg', 'jalan'),
(366, '::1', 'annisa@gmail.com', '$2y$10$Ek08l4hjo.TsxzslNSH/BOflb47Wo032a2mq7WGm43WD9uwSmMCLi', 'annisa@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966954, NULL, 0, 1, 'Annisa', '.', '085333279820', 'default.jpg', 'jalan'),
(367, '::1', 'arinitri@yahoo.com', '$2y$10$dfzbXMsInuiGk3Dch8ps3e15lE9srxoVfDi4j/yT7WnVpkz3COdp.', 'arinitri@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966954, NULL, 0, 1, 'ARINITRI NURFARIDA', '.', '085320256369', 'default.jpg', 'jalan'),
(368, '::1', 'desifitriani@yahoo.com', '$2y$10$4kRWJO3RBACE5YUfHeWbx.nH8rs3A1Mjvu6xjbTr.boAKfC6STfKu', 'desifitriani@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966954, NULL, 0, 1, 'DESI FITRIANI PUTRI', '.', '085340299940', 'default.jpg', 'jalan'),
(369, '::1', 'dhika@gmail.com', '$2y$10$xwbpBM/loYtI.IGTp3xlmOuZu5pRv0zkCznM2Yx6VBJvZF.L9DZH2', 'dhika@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966954, NULL, 0, 1, 'DHIKA AFANDYASA SUMANIK', '.', '082249034254', 'default.jpg', 'jalan'),
(370, '::1', 'endang@yahoo.com', '$2y$10$NsTLFk5Xc68iCH.mEWP3yuIY3eQcGPV2hjPxlfz9Il8ICkeB8KxIG', 'endang@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966954, NULL, 0, 1, 'Endang Wahyuningsih', '.', '081350845944', 'default.jpg', 'jalan'),
(371, '::1', 'fauziah@gmail.com', '$2y$10$PFWg9/IR0eWiWyyq6.UUEeGBTssB4Bg/7vwoWIhkqu2VUJsKrxgaW', 'fauziah@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966954, NULL, 0, 1, 'FAUZIAH APRILIA ILHAM', '.', '085934458914', 'default.jpg', 'jalan'),
(372, '::1', 'habilmaisya@yahoo.com', '$2y$10$p0SXs9WJgGCn8se11QDSNOJMG8Uw.rOdgxHWoqgkMheP32Zyi46nq', 'habilmaisya@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966954, NULL, 0, 1, 'HABIL MAISYA ALPAREZA ANTON SOBO', '.', '083132426732', 'default.jpg', 'jalan'),
(373, '::1', 'hapsah@yahoo.com', '$2y$10$zdZKdno1eU96TxTPK.2Qyu4Ym2PBQ6DD9XuVXEASgdiAJ3o6iAKRm', 'hapsah@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966955, NULL, 0, 1, 'Hapsah Alsa Putri', '.', '082264428594', 'default.jpg', 'jalan'),
(374, '::1', 'hasbinlaigi@yahoo.com', '$2y$10$yhYZikfRxMivkvSdj.jcS.5/cQYCKWUw01tB0d9xNOJEN2Svq6YK.', 'hasbinlaigi@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966955, NULL, 0, 1, 'Hasbin Laigi', '.', '081283217875', 'default.jpg', 'jalan'),
(375, '::1', 'hendriansa@yahoo.com', '$2y$10$jouR5Rm8vQltioSTKP39XO2Q58SZjvWbzVWgKNQ1mJorv8nUveyVe', 'hendriansa@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966955, NULL, 0, 1, 'Hendriansa', '.', '082196142100', 'default.jpg', 'jalan'),
(376, '::1', 'intannurmasita@gmail.com', '$2y$10$1plHvZTITc1YnWq.dJZgfeia8s1SRHMBYjK.bp48866m/g8.OcRWG', 'intannurmasita@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966955, NULL, 0, 1, 'INTAN NURMASITA', '.', '082248491040', 'default.jpg', 'jalan'),
(377, '::1', 'fikri@gmail.com', '$2y$10$.4Eui3ZxwFCV1zJm/hP6FOXUyJTeFUl.SW85uWx32Rsna4XXWfycS', 'fikri@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966955, NULL, 0, 1, 'Ma\'ruf Fikri Karim', '.', '081245789214', 'default.jpg', 'jalan'),
(378, '::1', 'marlina@gmail.com', '$2y$10$w3zvs/OyJGkeiekWQWIn/OTJqzhgoO/84gevVAnDRCZ1JzU9HRbBm', 'marlina@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966955, NULL, 0, 1, 'MARLINA', '.', '0', 'default.jpg', 'jalan'),
(379, '::1', 'marnimani@yahoo.co.id', '$2y$10$v2x0hdEalernaCa/dCEI8u9VkL3kCK5ThYRJjp3VdIkoA6OQCz4dy', 'marnimani@yahoo.co.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966955, NULL, 0, 1, 'MARNI', '.', '085242324486', 'default.jpg', 'jalan'),
(380, '::1', 'safitri@yahoo.com', '$2y$10$pxD8oUG4Yb3cy1NUXr7duOibR9YPGpwT6YhH1q75cB/Wq6CwPSYqq', 'safitri@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966955, NULL, 0, 1, 'MELANI SAFITRI SAHRULLAH', '.', '083132102695', 'default.jpg', 'jalan'),
(381, '::1', 'meldamelda@yahoo.com', '$2y$10$0IGjy/WMhP2nr/70BFzjmuz2gpY6kQrX.lny1YgyeA6vDaQWhipnS', 'meldamelda@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966955, NULL, 0, 1, 'MELDA', '.', '081341747884', 'default.jpg', 'jalan'),
(382, '::1', 'sahrulamadhan@gmail.com', '$2y$10$rwBNTMXddG1Xgk32ElIAoeSoomEeOmijXqfnW9GBLZXC2.1pXvP0y', 'sahrulamadhan@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966955, NULL, 0, 1, 'MUHAMAD SAHRUL RAMADHAN', '.', '085333599765', 'default.jpg', 'jalan'),
(383, '::1', 'musran@gmail.com', '$2y$10$3eu/gwv2vU6WQFhGZsLybuivqfh2Yf0m2oW9J9RFSEThKOLTeEXKm', 'musran@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966955, NULL, 0, 1, 'MUSRAN', '.', '0', 'default.jpg', 'jalan'),
(384, '::1', 'noniwidyanti@yahoo.com', '$2y$10$YPiFGfUz7CUxxFqVbuZaOOP2HJrZWZV2l1JDnala5pDvnSVMSE6h2', 'noniwidyanti@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966956, NULL, 0, 1, 'NONI WIDYANTI', '.', '082189451045', 'default.jpg', 'jalan'),
(385, '::1', 'sitimutmainna@gmail.com', '$2y$10$7AGmompPwCepfA4jZxESfukchnsGOhH9X5AqXDXQoAu3/QFunvLIi', 'sitimutmainna@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966956, NULL, 0, 1, 'Siti Mutmainna', '.', '085241741098', 'default.jpg', 'jalan'),
(386, '::1', 'suryaatmaja@gmail.com', '$2y$10$E1f5hFV93Ck/VN/L.NMGbuMwTL/HeBq/DuQQoZAn7FpyeCZdkT4ua', 'suryaatmaja@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966956, NULL, 0, 1, 'SURYA ATMAJA', '.', '0', 'default.jpg', 'jalan'),
(387, '::1', 'tatiwidya@yahoo.com', '$2y$10$zDTJdDUHJt6/NNSNJHgaP.FOwbOzPCNXaFZ5/tIaDzcy5FpebN1uS', 'tatiwidya@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966956, NULL, 0, 1, 'TATI WIDYA PUTRI', '.', '082349870223', 'default.jpg', 'jalan'),
(388, '::1', 'thomasri@gmail.com', '$2y$10$rcfsxDcRgGjzYfjY12T/5.p9onAP/mHozYq60H99j6uhucPS/dFme', 'thomasri@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966956, NULL, 0, 1, 'THOMASRI RICARD MUNIAGA', '.', '082271036472', 'default.jpg', 'jalan'),
(389, '::1', 'triwahyu@gmail.com', '$2y$10$6Sr.Z0AfRONCNPIi8xOnauMWZwRTa20ohqrdf7JjGg9KvbsDY3vQe', 'triwahyu@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966956, NULL, 0, 1, 'TRI WAHYU FEBRIANTO', '.', '0', 'default.jpg', 'jalan'),
(390, '::1', 'waodeekarti@yahoo.com', '$2y$10$xCIReaTgFTW82p0D1jEQPe6s9dK8cMNZOtutogsIj6O30GcaS5LuO', 'waodeekarti@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966956, NULL, 0, 1, 'WA ODE EKARTI', '.', '081382313240', 'default.jpg', 'jalan'),
(391, '::1', 'yusafrizal@yahoo.com', '$2y$10$/i9tXm8wc1YAOOplRH3qd.yHDQHNEjL/wfHzJMuR6iXaptibvxmaS', 'yusafrizal@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966956, NULL, 0, 1, 'YUS AFRIZAL', '.', '085241964362', 'default.jpg', 'jalan'),
(392, '::1', 'zikra@gmail.com', '$2y$10$2W917B/7QBeERNKf82YG9.uezdzi1vO.k0XAbz9IT8NmqS2czJjaC', 'zikra@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615966957, NULL, 0, 1, 'ZIKRA NURAIDI AFDAL', '.', '085254180708', 'default.jpg', 'jalan'),
(393, '::1', 'asmidar@yahoo.com', '$2y$10$CNv5TmC8CS4gmqbrFUSAfOZ7thHC5Um7Yw1H4XmuDdcL1e8.79PhS', 'asmidar@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967257, NULL, 0, 1, 'ASMIDAR', '.', '0', 'default.jpg', 'jalan'),
(394, '::1', 'astrid@yahoo.co.id', '$2y$10$6I/78I63R8VWjtrrvzrmu.B1IgcClGZQAD6oKnXTIJUGleZko2RtK', 'astrid@yahoo.co.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967257, NULL, 0, 1, 'ASTRID', '.', '0', 'default.jpg', 'jalan'),
(395, '::1', 'chaesar@gmail.com', '$2y$10$xEH509b2.dlwkqB2UQvWJehmdc1IumWyG9YKoWNpywi16w9Y59h82', 'chaesar@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967257, NULL, 0, 1, 'CHAESAR TITO', '.', '085241516363', 'default.jpg', 'jalan'),
(396, '::1', 'devica@gmail.com', '$2y$10$OKknxrjatH4lAUC6MBK7weXBgKNPfkfgcBbUZh7Zt4NW6B3orDVFm', 'devica@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967257, NULL, 0, 1, 'DEVICA AYU NENGSI', '.', '081908233182', 'default.jpg', 'jalan'),
(397, '::1', 'mutiara@gmail.com', '$2y$10$2zLOAibI1UttSkxSkuxhhOdHac26HPHDzsKg77AbupVjfgnUY4yhy', 'mutiara@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967257, NULL, 0, 1, 'Dwi Mutiara Rere', '.', '081245555421', 'default.jpg', 'jalan'),
(398, '::1', 'faturrahmat@yahoo.com', '$2y$10$hDgbW.6/xT0MOi8WpvASeuBjWXu/VIlceM3Mgh8urPhwqpvO2KvKK', 'faturrahmat@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967257, NULL, 0, 1, 'Fatur Rahmat', '.', '081935405904', 'default.jpg', 'jalan'),
(399, '::1', 'indarmayangsari@gmail.com', '$2y$10$LP98EqhbKb5P66GX6WIaD..RZtys2BCpJjggaW546GhXODMGN6rOK', 'indarmayangsari@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967257, NULL, 0, 1, 'INDAR MAYANG SARI', '.', '082348686542', 'default.jpg', 'jalan'),
(400, '::1', 'affansyah@gmail.com', '$2y$10$gOTWyHRsmxez3cWOuUkmyuD3QOfLbE43OGGw5fdbHfyTTiVTryLJC', 'affansyah@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967257, NULL, 0, 1, 'Irghy Affansyah', '.', '082197284346', 'default.jpg', 'jalan'),
(401, '::1', 'kevinpawani@gmail.com', '$2y$10$EZwMzZk02DSCdCAOFSvibeBVilRRSdfMWahA8qYMJekOGBPEmkquC', 'kevinpawani@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967258, NULL, 0, 1, 'KEVIN PAWANI', '.', '0', 'default.jpg', 'jalan'),
(402, '::1', 'linglingeka@yahoo.com', '$2y$10$udem0es.wz2ce6hvLu5t0efWlkJYvvD3IkdI7r9JB9v0Xr797ktfO', 'linglingeka@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967258, NULL, 0, 1, 'Lingling Ekasari', '.', '0', 'default.jpg', 'jalan'),
(403, '::1', 'ardiprimayudha@gmail.com', '$2y$10$8HT60vSItyrZYMTckiQqW.KIe.dgrtwjczVuWDxIUmO0QiiHi2Izi', 'ardiprimayudha@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967258, NULL, 0, 1, 'MUH. ARDI PRIMAYUDHA', '.', '0', 'default.jpg', 'jalan'),
(404, '::1', 'muhfadil@yahoo.com', '$2y$10$CH85gtQwl95Y8kH/giaeMutiD.kdZHDIpxP7sEh96DqTaNOLFDu/u', 'muhfadil@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967258, NULL, 0, 1, 'Muh. Fadil', '.', '0', 'default.jpg', 'jalan'),
(405, '::1', 'fajarrevizha@gmail.com', '$2y$10$6esTlGBTlb/Ri723hHns.enTgxU64wmkQlzW/gdB4V4IyDMa8cU9K', 'fajarrevizha@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967258, NULL, 0, 1, 'MUH. FAJAR REVIZHA FHATURROCHMAN', '.', '085299907892', 'default.jpg', 'jalan'),
(406, '::1', 'ikhsan@gmail.com', '$2y$10$RrHLwubuVrlqWa76aCbWb.VYFDQID3i.Ay7d76cS0Lve2KfnhGsx.', 'ikhsan@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967258, NULL, 0, 1, 'Muh. Ikhsan', '.', '082348753399', 'default.jpg', 'jalan'),
(407, '::1', 'kisal@gmail.com', '$2y$10$ZleK5FEy61pfpTh9GGCWi.e99JD8jKBSRUe5om2vud7.BDeunB8YW', 'kisal@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967258, NULL, 0, 1, 'MUH. KISAL', '.', '085241898239', 'default.jpg', 'jalan'),
(408, '::1', 'nabhanrosyad@gmail.com', '$2y$10$lzUmi/9qig.7umHnm6QAyONOzO8zG3bZlZDnnKOVxkO./52E.U.4G', 'nabhanrosyad@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967258, NULL, 0, 1, 'MUH. NABHAN ROSYAD', '.', '0', 'default.jpg', 'jalan'),
(409, '::1', 'ariefikhsan@gmail.com', '$2y$10$QrES2FFA2P1m2Le7/vUG/ebkn.B/XlyGKG.9hVXPmANZ1DXAqqP/G', 'ariefikhsan@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967258, NULL, 0, 1, 'MUHAMMAD ARIEF IKHSAN', '.', '0', 'default.jpg', 'jalan'),
(410, '::1', 'neneng@yahoo.com', '$2y$10$HNcAPhGZTC/Gvj3k5xuJIOrtQP9KkWany7x4PtEQ3t4ewJz7dquYm', 'neneng@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967258, NULL, 0, 1, 'NENENG WIDYASTUTI', '.', '0', 'default.jpg', 'jalan'),
(411, '::1', 'nirmala@gmail.com', '$2y$10$REUE/7ZL12YQF7QqhneGzejpy89NjjbW7lnz6gtvfXtFrRZLeBiM2', 'nirmala@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967258, NULL, 0, 1, 'NIRMALA ANUGRAH SAPITRI', '.', '085399103415', 'default.jpg', 'jalan'),
(412, '::1', 'nurhidayat@yahoo.com', '$2y$10$5HjECtXdBvp1yo5cfoV96eIuhQsKeZGxIiIFkF.fU6e95ZAbH98q2', 'nurhidayat@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967259, NULL, 0, 1, 'Nur Hidayat', '.', '0', 'default.jpg', 'jalan'),
(413, '::1', 'nursanti@yahoo.com', '$2y$10$O//WsgrSw.o1.mwWE0jK8uGF1.PTbOcFiPlc2qRFZZC0zw7iyOe/u', 'nursanti@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967259, NULL, 0, 1, 'NUR SANTI', '.', '0', 'default.jpg', 'jalan'),
(414, '::1', 'nurputri@gmail.com', '$2y$10$dmpYofJ4alRiUcxIuIS8peZ7BiEmmfT7cb4pU1Bp2Twhc/1.rxoCa', 'nurputri@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967259, NULL, 0, 1, 'Nurul Putri Hidayat', '.', '0', 'default.jpg', 'jalan'),
(415, '::1', 'priskalidya@yahoo.com', '$2y$10$mZEMNb4oVizrcYG0IkFdMuIdx7nFEAjeIAnt8qIP38IPa/tK1psuS', 'priskalidya@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967259, NULL, 0, 1, 'PRISKA LIDYA ESSE PAMULA', '.', '0', 'default.jpg', 'jalan'),
(416, '::1', 'putri07@yahoo.com', '$2y$10$jL4jZOiv0EGAWEuB2VD/suQxH86ufb1WG6f/1dYVSVx6FytCcYYYS', 'putri07@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967348, NULL, 0, 1, 'PUTRI', '.', '0', 'default.jpg', 'jalan'),
(417, '::1', 'riskamulia@yahoo.co.id', '$2y$10$/fK2fCPCe1g6hO5dDwhuJuJcLIkLUEErpk4QSiXuu8qnfbuHw5PFi', 'riskamulia@yahoo.co.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967349, NULL, 0, 1, 'RISKA MULYA', '.', '082349384983', 'default.jpg', 'jalan'),
(418, '::1', 'riskayuli@yahoo.com', '$2y$10$JXMLpZOKCqoarB.AVcuajOWFTFlMdpJ7F3z5LJhAul0MvcXiR3hLy', 'riskayuli@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967349, NULL, 0, 1, 'RISKA YULI', '.', '0', 'default.jpg', 'jalan'),
(419, '::1', 'sulfianaamalia@yahoo.co.id', '$2y$10$UCRgSOX.fQVjwdkklSxH6OD.u7y1ywSXHI5wngAi1qHAz7jFxEv32', 'sulfianaamalia@yahoo.co.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967349, NULL, 0, 1, 'Sulfiana Amalia', '.', '0', 'default.jpg', 'jalan'),
(420, '::1', 'thefhilus@yahoo.com', '$2y$10$RNmfNgxS6cajZ8IrNLQHQ.hgKzE9UTX7RlL6mIR8mPcI37liPFaBq', 'thefhilus@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967349, NULL, 0, 1, 'THEO FHILUS YEHESKIEL', '.', '0', 'default.jpg', 'jalan'),
(421, '::1', 'smaskartika_umar@gmail.com', '$2y$10$YXHnj8pXpHoQjeeJgG7nHux51OkGhMuwYKHXs791cpr7HjvBfqK4C', 'smaskartika_umar@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967443, NULL, 0, 1, 'UMAR', '.', '087844229150', 'default.jpg', 'jalan'),
(422, '::1', 'waodeariyana@yahoo.com', '$2y$10$rixhcl2N/54qYsZpuIZ3gOEnf8LKUU.K4W7fpGY/cSAKZnme292vy', 'waodeariyana@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615967443, NULL, 0, 1, 'WA ODE ARIYANA', '.', '0', 'default.jpg', 'jalan'),
(423, '::1', 'sitti.ayin@gmail.com', '$2y$10$5mrAbbreh6NdoiJLgqvexuoMclcBqj50GrWLv2QFJH/GUWenwvXpW', 'sitti.ayin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615968670, 1616040921, 0, 1, 'Sitti Ayyin', 'Sunaini', '085242830700', 'default.jpg', 'jalan'),
(424, '::1', 'jumpalagi.fisika@gmail.com', '$2y$10$pKXy177oUt3sXQ.6dRJsGuIgIVW0HPzl0PFsPABB/SuYFybMXYk.O', 'jumpalagi.fisika@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615968976, NULL, 0, 1, 'Hayuddin', 'Mahmud', '082197536416', 'default.jpg', 'jalan'),
(425, '::1', 'farisadnanadrian072@gmail.com', '$2y$10$lb4eMNpp0iFvqaEvzoftdupO2k57X5ZM9Ic.iOSVXGBaN7VZPK3la', 'farisadnanadrian072@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615969605, NULL, 0, 1, 'Faris Adnan', 'Adrian', '085340860324', 'default.jpg', 'jalan'),
(426, '::1', 'satria@gmail.com', '$2y$10$8NySqT224aZl/pCCA6gREuVJM5.NSCvvufiv26FyJRj607l7xrHTu', 'satria@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615969755, NULL, 0, 1, 'Satria.', 'A', '08123456789', 'default.jpg', ''),
(427, '::1', 'ik.verawati@gmail.com', '$2y$10$GaKXlHtTZfZa7aJVmLvUv.F4EqRXecGpvQnC.p0YwybVxoAyZWqLa', 'ik.verawati@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615969912, 1616037072, 0, 1, 'Ika', 'Verawati', '085241638098', 'default.jpg', 'jalan'),
(428, '::1', 'samihaulfa706@gmail.com', '$2y$10$kjmMg/k9rdVBwhrO3I/0t.NSsCHceT7DcxVFUu16S4UE03IXsLJPa', 'samihaulfa706@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615970120, 1615972713, 0, 1, 'Samiha', 'Ulfa', '085241778288', 'default.jpg', 'jalan'),
(429, '::1', 'syaddad2006@gmail.com', '$2y$10$qOKIrDACcnz93FByBevFg.UJw9UWpQNjW7H7ac1T8t4wHleivUyFm', 'syaddad2006@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615970365, NULL, 0, 1, 'Naowati', 'Naowati', '085327427715', 'default.jpg', 'jalan');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(29, 13, 2),
(33, 17, 5),
(64, 18, 3),
(35, 19, 4),
(36, 20, 3),
(40, 24, 4),
(41, 25, 4),
(73, 26, 4),
(70, 27, 6),
(72, 29, 4),
(78, 34, 4),
(79, 35, 4),
(80, 36, 4),
(81, 37, 4),
(82, 38, 4),
(83, 39, 4),
(84, 40, 4),
(85, 41, 4),
(86, 42, 4),
(87, 43, 4),
(88, 44, 4),
(89, 45, 4),
(90, 46, 4),
(91, 47, 4),
(92, 48, 4),
(93, 49, 4),
(94, 50, 4),
(95, 51, 4),
(96, 52, 4),
(97, 53, 4),
(98, 54, 4),
(99, 55, 4),
(100, 56, 4),
(101, 57, 4),
(102, 58, 4),
(103, 59, 4),
(104, 60, 4),
(105, 61, 4),
(106, 62, 4),
(107, 63, 4),
(108, 64, 4),
(109, 65, 4),
(110, 66, 4),
(111, 67, 4),
(112, 68, 4),
(113, 69, 4),
(114, 70, 4),
(115, 71, 4),
(116, 72, 4),
(117, 73, 4),
(118, 74, 4),
(119, 75, 4),
(120, 76, 4),
(121, 77, 4),
(122, 78, 4),
(123, 79, 4),
(124, 80, 4),
(125, 81, 4),
(126, 82, 4),
(127, 83, 4),
(128, 84, 4),
(129, 85, 4),
(130, 86, 4),
(131, 87, 4),
(132, 88, 4),
(133, 89, 4),
(134, 90, 4),
(135, 91, 4),
(136, 92, 4),
(137, 93, 4),
(138, 94, 4),
(139, 95, 4),
(140, 96, 4),
(141, 97, 4),
(142, 98, 4),
(143, 99, 4),
(144, 100, 4),
(145, 101, 4),
(146, 102, 4),
(147, 103, 4),
(148, 104, 4),
(149, 105, 4),
(150, 106, 4),
(151, 107, 4),
(152, 108, 4),
(153, 109, 4),
(185, 141, 4),
(186, 142, 4),
(187, 143, 4),
(188, 144, 4),
(189, 145, 4),
(190, 146, 4),
(191, 147, 4),
(192, 148, 4),
(193, 149, 4),
(194, 150, 4),
(195, 151, 4),
(196, 152, 4),
(197, 153, 4),
(198, 154, 4),
(199, 155, 4),
(200, 156, 4),
(201, 157, 4),
(202, 158, 4),
(203, 159, 4),
(204, 160, 4),
(205, 161, 4),
(206, 162, 4),
(207, 163, 4),
(208, 164, 4),
(209, 165, 4),
(210, 166, 4),
(211, 167, 4),
(212, 168, 4),
(213, 169, 4),
(214, 170, 4),
(215, 171, 4),
(216, 172, 4),
(217, 173, 4),
(218, 174, 4),
(219, 175, 4),
(220, 176, 4),
(221, 177, 4),
(222, 178, 4),
(223, 179, 4),
(224, 180, 4),
(225, 181, 4),
(226, 182, 4),
(227, 183, 4),
(228, 184, 4),
(229, 185, 4),
(230, 186, 4),
(231, 187, 4),
(232, 188, 4),
(233, 189, 4),
(234, 190, 4),
(235, 191, 4),
(236, 192, 4),
(237, 193, 4),
(238, 194, 4),
(239, 195, 4),
(240, 196, 4),
(241, 197, 4),
(242, 198, 4),
(243, 199, 4),
(244, 200, 4),
(245, 201, 4),
(246, 202, 4),
(247, 203, 4),
(248, 204, 4),
(249, 205, 4),
(250, 206, 4),
(251, 207, 4),
(252, 208, 4),
(253, 209, 4),
(254, 210, 4),
(255, 211, 4),
(256, 212, 4),
(257, 213, 4),
(258, 214, 4),
(259, 215, 4),
(260, 216, 4),
(261, 217, 4),
(262, 218, 4),
(263, 219, 4),
(264, 220, 4),
(265, 221, 4),
(266, 222, 4),
(267, 223, 4),
(268, 224, 4),
(269, 225, 4),
(270, 226, 4),
(271, 227, 4),
(272, 228, 4),
(273, 229, 4),
(274, 230, 4),
(275, 231, 4),
(276, 232, 4),
(277, 233, 4),
(278, 234, 4),
(279, 235, 4),
(280, 236, 4),
(281, 237, 4),
(282, 238, 4),
(283, 239, 4),
(284, 240, 4),
(285, 241, 4),
(286, 242, 4),
(287, 243, 4),
(288, 244, 4),
(289, 245, 4),
(290, 246, 4),
(291, 247, 4),
(292, 248, 4),
(293, 249, 4),
(294, 250, 4),
(295, 251, 4),
(296, 252, 4),
(297, 253, 4),
(298, 254, 4),
(299, 255, 4),
(300, 256, 4),
(301, 257, 4),
(302, 258, 4),
(303, 259, 4),
(304, 260, 4),
(305, 261, 4),
(306, 262, 4),
(307, 263, 4),
(308, 264, 4),
(309, 265, 4),
(310, 266, 4),
(311, 267, 4),
(312, 268, 4),
(313, 269, 4),
(314, 270, 4),
(315, 271, 4),
(339, 295, 4),
(340, 296, 4),
(341, 297, 4),
(342, 298, 4),
(343, 299, 4),
(344, 300, 4),
(345, 301, 4),
(346, 302, 4),
(347, 303, 4),
(348, 304, 4),
(349, 305, 4),
(350, 306, 4),
(351, 307, 4),
(352, 308, 4),
(353, 309, 4),
(354, 310, 4),
(355, 311, 4),
(356, 312, 4),
(357, 313, 4),
(358, 314, 4),
(359, 315, 4),
(360, 316, 4),
(361, 317, 4),
(362, 318, 4),
(363, 319, 4),
(364, 320, 4),
(365, 321, 4),
(366, 322, 4),
(367, 323, 4),
(368, 324, 4),
(369, 325, 4),
(370, 326, 4),
(371, 327, 4),
(372, 328, 4),
(373, 329, 4),
(374, 330, 4),
(375, 331, 4),
(376, 332, 4),
(377, 333, 4),
(378, 334, 4),
(379, 335, 4),
(380, 336, 4),
(381, 337, 4),
(382, 338, 4),
(383, 339, 4),
(384, 340, 4),
(385, 341, 4),
(386, 342, 4),
(387, 343, 4),
(388, 344, 4),
(389, 345, 4),
(390, 346, 4),
(391, 347, 4),
(392, 348, 4),
(393, 349, 4),
(394, 350, 4),
(395, 351, 4),
(396, 352, 4),
(397, 353, 4),
(398, 354, 4),
(399, 355, 4),
(400, 356, 4),
(401, 357, 4),
(402, 358, 4),
(403, 359, 4),
(404, 360, 4),
(405, 361, 4),
(406, 362, 4),
(407, 363, 4),
(408, 364, 4),
(409, 365, 4),
(410, 366, 4),
(411, 367, 4),
(412, 368, 4),
(413, 369, 4),
(414, 370, 4),
(415, 371, 4),
(416, 372, 4),
(417, 373, 4),
(418, 374, 4),
(419, 375, 4),
(420, 376, 4),
(421, 377, 4),
(422, 378, 4),
(423, 379, 4),
(424, 380, 4),
(425, 381, 4),
(426, 382, 4),
(427, 383, 4),
(428, 384, 4),
(429, 385, 4),
(430, 386, 4),
(431, 387, 4),
(432, 388, 4),
(433, 389, 4),
(434, 390, 4),
(435, 391, 4),
(436, 392, 4),
(437, 393, 4),
(438, 394, 4),
(439, 395, 4),
(440, 396, 4),
(441, 397, 4),
(442, 398, 4),
(443, 399, 4),
(444, 400, 4),
(445, 401, 4),
(446, 402, 4),
(447, 403, 4),
(448, 404, 4),
(449, 405, 4),
(450, 406, 4),
(451, 407, 4),
(452, 408, 4),
(453, 409, 4),
(454, 410, 4),
(455, 411, 4),
(456, 412, 4),
(457, 413, 4),
(458, 414, 4),
(459, 415, 4),
(460, 416, 4),
(461, 417, 4),
(462, 418, 4),
(463, 419, 4),
(464, 420, 4),
(465, 421, 4),
(466, 422, 4),
(504, 423, 3),
(502, 424, 3),
(499, 425, 3),
(497, 426, 3),
(494, 427, 3),
(500, 428, 3),
(498, 429, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classroom_ibfk_1` (`school_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `class_ladder_id` (`class_ladder_id`);

--
-- Indexes for table `class_ladder`
--
ALTER TABLE `class_ladder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `edu_ladder`
--
ALTER TABLE `edu_ladder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `headmaster_profile`
--
ALTER TABLE `headmaster_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questionnaire_id` (`questionnaire_id`);

--
-- Indexes for table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `classroom_id` (`classroom_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `question_answer`
--
ALTER TABLE `question_answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `question_reference`
--
ALTER TABLE `question_reference`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `questionnaire_id` (`questionnaire_id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`),
  ADD KEY `edu_ladder_id` (`edu_ladder_id`);

--
-- Indexes for table `school_admin`
--
ALTER TABLE `school_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `solve_test`
--
ALTER TABLE `solve_test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `student_answer`
--
ALTER TABLE `student_answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `student_profile`
--
ALTER TABLE `student_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `classroom_id` (`classroom_id`);

--
-- Indexes for table `teacher_course`
--
ALTER TABLE `teacher_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `classroom_id` (`classroom_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `class_ladder_id` (`class_ladder_id`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_result`
--
ALTER TABLE `test_result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `class_ladder`
--
ALTER TABLE `class_ladder`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `edu_ladder`
--
ALTER TABLE `edu_ladder`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `headmaster_profile`
--
ALTER TABLE `headmaster_profile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4384;

--
-- AUTO_INCREMENT for table `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `question_answer`
--
ALTER TABLE `question_answer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21880;

--
-- AUTO_INCREMENT for table `question_reference`
--
ALTER TABLE `question_reference`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school_admin`
--
ALTER TABLE `school_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `solve_test`
--
ALTER TABLE `solve_test`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_answer`
--
ALTER TABLE `student_answer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `student_profile`
--
ALTER TABLE `student_profile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=416;

--
-- AUTO_INCREMENT for table `teacher_course`
--
ALTER TABLE `teacher_course`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_result`
--
ALTER TABLE `test_result`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=430;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=505;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classroom`
--
ALTER TABLE `classroom`
  ADD CONSTRAINT `classroom_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`),
  ADD CONSTRAINT `classroom_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `classroom_ibfk_3` FOREIGN KEY (`class_ladder_id`) REFERENCES `class_ladder` (`id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);

--
-- Constraints for table `headmaster_profile`
--
ALTER TABLE `headmaster_profile`
  ADD CONSTRAINT `headmaster_profile_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`),
  ADD CONSTRAINT `headmaster_profile_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaire` (`id`);

--
-- Constraints for table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD CONSTRAINT `questionnaire_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `questionnaire_ibfk_2` FOREIGN KEY (`classroom_id`) REFERENCES `classroom` (`id`),
  ADD CONSTRAINT `questionnaire_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `question_reference`
--
ALTER TABLE `question_reference`
  ADD CONSTRAINT `question_reference_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`),
  ADD CONSTRAINT `question_reference_ibfk_2` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaire` (`id`);

--
-- Constraints for table `school`
--
ALTER TABLE `school`
  ADD CONSTRAINT `school_ibfk_1` FOREIGN KEY (`edu_ladder_id`) REFERENCES `edu_ladder` (`id`);

--
-- Constraints for table `school_admin`
--
ALTER TABLE `school_admin`
  ADD CONSTRAINT `school_admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `school_admin_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);

--
-- Constraints for table `solve_test`
--
ALTER TABLE `solve_test`
  ADD CONSTRAINT `solve_test_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `solve_test_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`);

--
-- Constraints for table `student_answer`
--
ALTER TABLE `student_answer`
  ADD CONSTRAINT `student_answer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `student_answer_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`),
  ADD CONSTRAINT `student_answer_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`);

--
-- Constraints for table `student_profile`
--
ALTER TABLE `student_profile`
  ADD CONSTRAINT `student_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `student_profile_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`),
  ADD CONSTRAINT `student_profile_ibfk_3` FOREIGN KEY (`classroom_id`) REFERENCES `classroom` (`id`);

--
-- Constraints for table `teacher_course`
--
ALTER TABLE `teacher_course`
  ADD CONSTRAINT `teacher_course_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `teacher_course_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
  ADD CONSTRAINT `teacher_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `teacher_profile_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `test_ibfk_1` FOREIGN KEY (`class_ladder_id`) REFERENCES `class_ladder` (`id`);

--
-- Constraints for table `test_result`
--
ALTER TABLE `test_result`
  ADD CONSTRAINT `test_result_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`),
  ADD CONSTRAINT `test_result_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
