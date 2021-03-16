-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 16 Mar 2021 pada 16.47
-- Versi Server: 5.7.33-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struktur dari tabel `classroom`
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
-- Dumping data untuk tabel `classroom`
--

INSERT INTO `classroom` (`id`, `school_id`, `user_id`, `class_ladder_id`, `name`, `description`) VALUES
(1, 1, NULL, 4, 'X IPA 1', 'Kelas 10'),
(2, 1, NULL, 5, 'X IPS 1', 'Kelas 10'),
(3, 1, NULL, 6, 'XI IPA 1', 'Kelas 11'),
(4, 1, NULL, 7, 'XI IPS 1', 'Kelas 11'),
(5, 1, NULL, 8, 'XII IPA 1', 'Kelas 12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `class_ladder`
--

CREATE TABLE `class_ladder` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `class_ladder`
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
-- Struktur dari tabel `comment`
--

CREATE TABLE `comment` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `courses`
--

INSERT INTO `courses` (`id`, `school_id`, `name`, `description`) VALUES
(3, 1, 'Matematika', '-'),
(4, 1, 'Biologi', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `edu_ladder`
--

CREATE TABLE `edu_ladder` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `edu_ladder`
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
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `groups`
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
-- Struktur dari tabel `headmaster_profile`
--

CREATE TABLE `headmaster_profile` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `nip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `headmaster_profile`
--

INSERT INTO `headmaster_profile` (`id`, `school_id`, `user_id`, `nip`) VALUES
(1, 1, 27, '192 168 0 10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(3, '192.168.1.191', 'farisadnanadrian072@gmail.com', 1615881497),
(4, '192.168.1.191', 'farisadnanadrian072@gmail.com', 1615881517),
(5, '192.168.1.191', 'farisadnanadrian072@gmail.com', 1615881535);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
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
-- Dumping data untuk tabel `menus`
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
-- Struktur dari tabel `question`
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
-- Dumping data untuk tabel `question`
--

INSERT INTO `question` (`id`, `code`, `questionnaire_id`, `type`, `text`, `image`, `audio`) VALUES
(1, 'S-1', 1, 'text', '<p>soal pertama</p>', NULL, NULL),
(11, 'S-3', 1, 'image', '<p>a</p>', 'S-3_1578212008_533093.jpg', NULL),
(12, 'S-4', 1, 'image', '<p>soa</p>', 'S-4_1578212113_533090.jpg', NULL),
(19, 'S-8', 1, 'text', '<p>soal esai</p>', NULL, NULL),
(4355, 'S-1', 2, 'text', 'soal pilihan ganda', NULL, NULL),
(4356, 'S-2', 2, 'text', 'soal isian singkat', NULL, NULL),
(4357, 'S-3', 2, 'text', 'deskripsikan diri anda', NULL, NULL),
(4358, 'S-4', 1, 'text', '<p>soal perdana</p>', NULL, NULL),
(4359, 'S-5', 3, 'text', '<p>Soal Mudah</p>', NULL, NULL),
(4362, 'S-6', 1, 'image', '<p>Sebuah balok kecil mempunyai dimensi panjang , lebar dan tinggi seperti yang ditunjukkan oleh jangka sorong seperti di bawah ini. Volume dari balok tersebut adalah ....</p>', 'S-6_1615882724_soal-3.png', NULL),
(4363, 'S-7', 5, 'image', '<p>Sebuah balok kecil mempunyai dimensi panjang , lebar dan tinggi seperti yang ditunjukkan oleh jangka sorong seperti di bawah ini. Volume dari balok tersebut adalah ....</p>', 'S-7_1615883392_soal-3.png', NULL),
(4364, 'S-8', 5, 'image', '<p>Gambar berikut adalah pengukuran massa benda dengan menggunakan neraca Ohauss lengan tiga. Hasil pengukuran massa yang benar adalah.....</p>', 'S-8_1615883474_soal4.png', NULL),
(4365, 'S-9', 5, 'text', 'The bills are folded in an origami style in a_______', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `questionnaire`
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
-- Dumping data untuk tabel `questionnaire`
--

INSERT INTO `questionnaire` (`id`, `user_id`, `classroom_id`, `course_id`, `name`, `description`, `status`) VALUES
(1, 18, 5, 3, 'Bank Soal Matematika Kelas XII IPA 1', 'Materi Algoritma', 1),
(2, 18, 5, 4, 'Bank Soal Biologi Kelas XII IPA 1', 'Bank Soal Mid', 1),
(3, 20, 2, 3, 'Bank Soal Matematika Kelas X IPS 1', '-', 1),
(4, 18, 1, 4, 'Bank Soal Biologi', '-', 1),
(5, 18, 5, 4, 'Paket 1', '-', 0),
(6, 18, 5, 4, 'Paket 2', '-', 0),
(7, 18, 5, 4, 'P1', '-', 0),
(8, 18, 5, 4, 'Paket 3', '-', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `question_answer`
--

CREATE TABLE `question_answer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(20) NOT NULL,
  `answer` text NOT NULL,
  `value` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `question_answer`
--

INSERT INTO `question_answer` (`id`, `question_id`, `type`, `answer`, `value`) VALUES
(1, 1, 'text', 'soal', 0),
(2, 1, 'text', 'pertama', 0),
(3, 1, 'text', 'ini', 0),
(4, 1, 'text', 'jawabannya', 0),
(5, 1, 'text', 'pilihan e', 1),
(61, 11, 'text', 'a', 0),
(62, 11, 'text', 'b', 0),
(63, 11, 'text', 'c', 1),
(64, 11, 'text', 'd', 0),
(65, 11, 'text', 'r', 0),
(80, 19, 'short_answer', 'Soal Esai', 10),
(21743, 4355, 'text', 'pilihan a', 0),
(21744, 4355, 'text', 'pilihan b', 0),
(21745, 4355, 'text', 'pilihan c', 0),
(21746, 4355, 'text', 'pilihan d', 1),
(21747, 4355, 'text', 'pilihan e', 0),
(21748, 4356, 'short_answer', 'jawab saja sembarang', 6),
(21749, 4357, 'essay', 'deskripsi diri', 50),
(21750, 4358, 'text', 'ini pilihan', 0),
(21751, 4358, 'text', 'ini juga', 0),
(21752, 4358, 'text', 'ini lagi', 0),
(21753, 4358, 'text', 'dan ini juga', 1),
(21754, 4358, 'text', 'ini juga', 0),
(21755, 4359, 'text', 'A', 0),
(21756, 4359, 'text', 'B', 0),
(21757, 4359, 'text', 'C', 0),
(21758, 4359, 'text', 'D', 1),
(21759, 4359, 'text', 'E', 0),
(21770, 4362, 'text', '43,1 cm3', 0),
(21771, 4362, 'text', '43,2 cm3', 1),
(21772, 4362, 'text', '43,3 cm3', 0),
(21773, 4362, 'text', '43,4 cm3', 0),
(21774, 4362, 'text', '43,5 cm3', 0),
(21775, 4363, 'text', '43,1 cm3 ', 1),
(21776, 4363, 'text', '43,2 cm3 ', 0),
(21777, 4363, 'text', '43,3 cm3 ', 0),
(21778, 4363, 'text', '43,4 cm3 ', 0),
(21779, 4363, 'text', '43,5 cm3 ', 0),
(21780, 4364, 'text', '350 gram ', 0),
(21781, 4364, 'text', '321,5 gram', 0),
(21782, 4364, 'text', '240 gram', 1),
(21783, 4364, 'text', '173 gram', 0),
(21784, 4364, 'text', '170,3 gram ', 0),
(21785, 4365, 'text', 'there-dimensionals frame', 0),
(21786, 4365, 'text', 'Three-Dimensional frame', 1),
(21787, 4365, 'text', 'Three-Dimensional frame', 0),
(21788, 4365, 'text', 'Three-frames dimensional', 0),
(21789, 4365, 'text', 'Three-frames dimensional', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `question_reference`
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
-- Dumping data untuk tabel `question_reference`
--

INSERT INTO `question_reference` (`id`, `test_id`, `questionnaire_id`, `multiple_choice`, `short_answer`, `essay`) VALUES
(3, 4, 1, 3, 1, 0),
(4, 5, 2, 1, 1, 1),
(5, 6, 2, 1, 1, 1),
(6, 7, 2, 1, 1, 1),
(7, 8, 2, 1, 1, 1),
(8, 9, 2, 1, 1, 1),
(9, 10, 2, 1, 1, 1),
(10, 11, 2, 1, 1, 1),
(11, 12, 2, 1, 1, 1),
(12, 13, 1, 3, 1, 0),
(13, 13, 2, 1, 1, 1),
(14, 13, 1, 2, 0, 0),
(15, 14, 5, 2, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `school`
--

CREATE TABLE `school` (
  `id` int(10) UNSIGNED NOT NULL,
  `edu_ladder_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `school`
--

INSERT INTO `school` (`id`, `edu_ladder_id`, `name`, `description`) VALUES
(1, 3, 'SMA Negeri 6 Kendari', 'Sekolah'),
(2, 3, 'SMA Negeri 1 Morosi', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `school_admin`
--

CREATE TABLE `school_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `school_admin`
--

INSERT INTO `school_admin` (`id`, `user_id`, `school_id`) VALUES
(1, 17, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `solve_test`
--

CREATE TABLE `solve_test` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `test_id` int(10) UNSIGNED NOT NULL,
  `time_start` int(11) NOT NULL,
  `is_break` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `solve_test`
--

INSERT INTO `solve_test` (`id`, `user_id`, `test_id`, `time_start`, `is_break`) VALUES
(3, 19, 12, 1615277079, 0),
(5, 26, 4, 1615780454, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `student_answer`
--

CREATE TABLE `student_answer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `test_id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `choice` char(1) DEFAULT NULL,
  `answer` text,
  `skor` int(11) DEFAULT NULL,
  `uncertain` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `student_answer`
--

INSERT INTO `student_answer` (`id`, `user_id`, `test_id`, `question_id`, `choice`, `answer`, `skor`, `uncertain`) VALUES
(5, 19, 4, 11, 'D', '64', 0, 0),
(6, 19, 4, 1, 'E', '5', 1, 0),
(7, 19, 4, 12, 'C', '68', 0, 0),
(8, 19, 4, 19, '', '<p>Jawabanku di ganti</p>', 5, 1),
(9, 19, 5, 4355, 'C', '21745', 0, 0),
(10, 19, 5, 4356, '', '<p>abc</p>', 0, 0),
(11, 19, 5, 4357, '', '<p>oke gaes</p>', 0, 0),
(12, 19, 6, 4355, 'D', '21746', 1, 0),
(13, 19, 6, 4356, NULL, NULL, 0, NULL),
(14, 19, 6, 4357, NULL, NULL, 0, NULL),
(15, 19, 7, 4355, NULL, NULL, 0, NULL),
(16, 19, 7, 4356, NULL, NULL, 0, NULL),
(17, 19, 7, 4357, NULL, NULL, 0, NULL),
(18, 19, 8, 4355, NULL, NULL, 0, NULL),
(19, 19, 8, 4356, NULL, NULL, 0, NULL),
(20, 19, 8, 4357, NULL, NULL, 0, NULL),
(30, 19, 9, 4355, NULL, NULL, 0, NULL),
(31, 19, 9, 4356, NULL, NULL, 0, NULL),
(32, 19, 9, 4357, NULL, NULL, 0, NULL),
(33, 19, 10, 4355, 'A', '21743', 0, 0),
(34, 19, 10, 4356, NULL, NULL, 0, NULL),
(35, 19, 10, 4357, NULL, NULL, 0, NULL),
(36, 19, 11, 4355, NULL, NULL, 0, NULL),
(37, 19, 11, 4356, NULL, NULL, 0, NULL),
(38, 19, 11, 4357, NULL, NULL, 0, NULL),
(39, 19, 12, 4355, 'C', '21745', NULL, 1),
(40, 19, 12, 4356, NULL, NULL, NULL, NULL),
(41, 19, 12, 4357, NULL, NULL, NULL, NULL),
(42, 26, 13, 12, NULL, NULL, 0, NULL),
(43, 26, 13, 4358, 'A', '21750', 0, 0),
(44, 26, 13, 11, NULL, NULL, 0, NULL),
(45, 26, 13, 1, NULL, NULL, 0, NULL),
(46, 26, 13, 4355, NULL, NULL, 0, NULL),
(47, 26, 13, 11, NULL, NULL, 0, NULL),
(48, 26, 13, 1, NULL, NULL, 0, NULL),
(49, 26, 13, 4358, 'A', '21750', 0, 0),
(50, 26, 13, 12, NULL, NULL, 0, NULL),
(51, 26, 13, 19, NULL, NULL, 0, NULL),
(52, 26, 13, 4356, NULL, NULL, 0, NULL),
(53, 26, 13, 19, NULL, NULL, 0, NULL),
(54, 26, 13, 4357, '', '<p>sdfsldf</p>', 0, 0),
(55, 26, 4, 12, NULL, NULL, NULL, NULL),
(56, 26, 4, 4358, NULL, NULL, NULL, NULL),
(57, 26, 4, 11, NULL, NULL, NULL, NULL),
(58, 26, 4, 19, NULL, NULL, NULL, NULL),
(59, 19, 14, 4364, 'A', '21780', 0, 1),
(60, 19, 14, 4363, 'C', '21777', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `student_profile`
--

CREATE TABLE `student_profile` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `classroom_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `student_profile`
--

INSERT INTO `student_profile` (`id`, `user_id`, `school_id`, `classroom_id`) VALUES
(2, 19, 1, 5),
(10, 24, 1, 5),
(11, 25, 1, 5),
(12, 26, 1, 5),
(13, 29, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `teacher_course`
--

CREATE TABLE `teacher_course` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `teacher_course`
--

INSERT INTO `teacher_course` (`id`, `user_id`, `course_id`) VALUES
(5, 18, 4),
(6, 20, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `teacher_profile`
--

CREATE TABLE `teacher_profile` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `nip` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `teacher_profile`
--

INSERT INTO `teacher_profile` (`id`, `user_id`, `school_id`, `nip`) VALUES
(2, 18, 1, '192 168 1 2'),
(3, 20, 1, '192 168 1 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `test`
--

CREATE TABLE `test` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `classroom_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `duration` int(11) NOT NULL,
  `kkm` int(3) NOT NULL,
  `max_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `test`
--

INSERT INTO `test` (`id`, `user_id`, `classroom_id`, `course_id`, `name`, `date`, `duration`, `kkm`, `max_value`) VALUES
(4, 18, 5, 3, 'Ulangan Harian', '2020-08-05', 60, 75, 100),
(5, 18, 5, 4, 'Ulangan 1', '2020-02-01', 60, 75, 100),
(6, 18, 5, 4, 'Ulangan 2', '2020-02-01', 60, 75, 100),
(7, 18, 5, 4, 'Ulangan 3', '2020-02-01', 60, 75, 100),
(8, 18, 5, 4, 'Ulangan 4', '2020-02-01', 5, 75, 100),
(9, 18, 5, 4, 'Ulangan 5', '2020-02-01', 60, 75, 100),
(10, 18, 5, 4, 'Ulangan 6', '2020-02-01', 60, 75, 100),
(11, 18, 5, 4, 'Ulangan 7', '2020-02-01', 60, 75, 100),
(12, 18, 5, 4, 'Ulangan 8', '2020-02-01', 60, 75, 100),
(13, 18, 5, 4, 'MIID TEST', '2020-02-26', 60, 75, 100),
(14, 18, 5, 4, 'Ulangan Fisika', '2021-03-16', 5, 75, 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimoni`
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
-- Struktur dari tabel `test_result`
--

CREATE TABLE `test_result` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `test_id` int(10) UNSIGNED NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `test_result`
--

INSERT INTO `test_result` (`id`, `user_id`, `test_id`, `value`) VALUES
(2, 19, 4, 46.1538),
(3, 19, 5, 0),
(4, 19, 6, 1.75439),
(5, 19, 7, 0),
(6, 19, 8, 0),
(10, 19, 9, 0),
(11, 19, 10, 0),
(12, 19, 11, 0),
(13, 26, 13, 0),
(14, 19, 14, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
  `is_login` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` text NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `is_login`, `active`, `first_name`, `last_name`, `phone`, `image`, `address`) VALUES
(1, '127.0.0.1', 'admin@fixl.com', '$2y$12$XpBgMvQ5JzfvN3PTgf/tA.XwxbCOs3mO0a10oP9/11qi1NUpv46.u', 'admin@fixl.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1615871695, 0, 1, 'Admin', 'istrator', '081232578168', 'USER_1_1614003280.png', 'admin'),
(13, '::1', 'uadmin@gmail.com', '$2y$10$78SZyvKRKMU7nPCew9w4nOpEUmJ1SeTV4L4ZG2NXXSfbEaswqoepq', 'uadmin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1568678256, 1615780755, 0, 1, 'admin', 'Dinas', '00', 'USER_13_1568678463.jpg', 'jln mutiara no 8'),
(17, '::1', 'smanam@gmail.com', '$2y$10$NIx.vGJvX.a/6J1/Yha1beTeSpb8xvMr5q2mbgpcZ2/2gOMk5.KIS', 'smanam@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1575916410, 1615884111, 0, 1, 'Admin SMA', 'Negeri 6 Kendari', '081234567890', 'USER_17_1578449627.jpg', 'Jalan Banda'),
(18, '::1', 'zidni@gmail.com', '$2y$10$554DNYTB6fzLJoaWdKsFwOSt5v88LAdqO1SlxqRB1JjTYrvT4yMky', 'zidni@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1575919985, 1615884433, 0, 1, 'Al Zidni', 'Kasim', '081232578168', 'USER_18_1577108725.jpg', 'BTN Graha Mandiri Permai Blok K/07'),
(19, '::1', 'alzidni@gmail.com', '$2y$10$CpC0kMgMDYXYtag4Ba4pEe2KMzz2WKsVi4Tk.csIUi6dtrcTsO1oa', 'alzidni@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1575920027, 1615883681, 0, 1, 'Al Zidni', 'Kasim', '081232578167', 'USER_19_1615873888.png', 'BTN Graha Mandiri Permai Blok K/07'),
(20, '::1', 'abdul_samad@gmail.com', '$2y$10$fDq9A4muW0tMHxEFTOOelergR2R0jGgsOcUV1yOY8dCNatoqhkrbq', 'abdul_samad@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1578920748, 1615780235, 0, 1, 'Abdul Samad', 'S.Pd., M.Pd', '0321241414', 'default.jpg', 'Lorong Koila Puuwatu'),
(24, '::1', 'fiki@gmail.com', '$2y$10$zqQMQTEzCquoNaxgTUoNAOQFUOcCukdnTaqgge1YE0sjWBY04/AKq', 'fiki@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1578923029, NULL, 0, 1, 'Muh. Fiki', 'Ramadhan', '081234567890', 'default.jpg', 'Lorong Koila'),
(25, '::1', 'beni@gmail.com', '$2y$10$MN.fwpricYHFfD8/IZgzHuYI8yYHD4QHM4PmMRxWsbziQitZuDnk.', 'beni@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1578923029, NULL, 0, 1, 'Muh. Benni', 'Barakati', '081234567890', 'default.jpg', 'Jalan THR'),
(26, '::1', 'sindy@gmail.com', '$2y$10$I1JsK.p19F9j/vMmvBx40OCfeI5kmbO2Ltpi8HxYFGL370bd6rrdC', 'sindy@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1578923029, 1615780363, 0, 1, 'Sindy M.', 'Konggoasa', '081234567890', 'default.jpg', 'Jalan Konggoasa'),
(27, '::1', 'headmaster@gmail.com', '$2y$10$KpIBh8M3Te9JAypcooL94.bEkUNMi8ghUcCmPJDLQJMCbByxQVzVi', 'headmaster@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1581400377, 1615230938, 0, 1, 'Kepala Sekolah', 'ku', '081232578168', 'default.jpg', 'jalan'),
(29, '127.0.0.1', 'kharismayunitra@gmail.com', '$2y$10$j3fM.dzpMXtY9rT9As1x/OaufsF8IgN3FFlIff0pNvcdX8ODmQvpq', 'kharismayunitra@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615230796, 1615230853, 0, 1, 'Kharisma', 'Yunitra', '081232678168', 'default.jpg', 'Lorong Manggis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users_groups`
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
(72, 29, 4);

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
  ADD KEY `course_id` (`course_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4366;
--
-- AUTO_INCREMENT for table `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `question_answer`
--
ALTER TABLE `question_answer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21790;
--
-- AUTO_INCREMENT for table `question_reference`
--
ALTER TABLE `question_reference`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `student_answer`
--
ALTER TABLE `student_answer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `student_profile`
--
ALTER TABLE `student_profile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `teacher_course`
--
ALTER TABLE `teacher_course`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `test_result`
--
ALTER TABLE `test_result`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `classroom`
--
ALTER TABLE `classroom`
  ADD CONSTRAINT `classroom_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`),
  ADD CONSTRAINT `classroom_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `classroom_ibfk_3` FOREIGN KEY (`class_ladder_id`) REFERENCES `class_ladder` (`id`);

--
-- Ketidakleluasaan untuk tabel `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);

--
-- Ketidakleluasaan untuk tabel `headmaster_profile`
--
ALTER TABLE `headmaster_profile`
  ADD CONSTRAINT `headmaster_profile_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`),
  ADD CONSTRAINT `headmaster_profile_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaire` (`id`);

--
-- Ketidakleluasaan untuk tabel `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD CONSTRAINT `questionnaire_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `questionnaire_ibfk_2` FOREIGN KEY (`classroom_id`) REFERENCES `classroom` (`id`),
  ADD CONSTRAINT `questionnaire_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Ketidakleluasaan untuk tabel `question_reference`
--
ALTER TABLE `question_reference`
  ADD CONSTRAINT `question_reference_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`),
  ADD CONSTRAINT `question_reference_ibfk_2` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaire` (`id`);

--
-- Ketidakleluasaan untuk tabel `school`
--
ALTER TABLE `school`
  ADD CONSTRAINT `school_ibfk_1` FOREIGN KEY (`edu_ladder_id`) REFERENCES `edu_ladder` (`id`);

--
-- Ketidakleluasaan untuk tabel `school_admin`
--
ALTER TABLE `school_admin`
  ADD CONSTRAINT `school_admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `school_admin_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);

--
-- Ketidakleluasaan untuk tabel `solve_test`
--
ALTER TABLE `solve_test`
  ADD CONSTRAINT `solve_test_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `solve_test_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`);

--
-- Ketidakleluasaan untuk tabel `student_answer`
--
ALTER TABLE `student_answer`
  ADD CONSTRAINT `student_answer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `student_answer_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`),
  ADD CONSTRAINT `student_answer_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`);

--
-- Ketidakleluasaan untuk tabel `student_profile`
--
ALTER TABLE `student_profile`
  ADD CONSTRAINT `student_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `student_profile_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`),
  ADD CONSTRAINT `student_profile_ibfk_3` FOREIGN KEY (`classroom_id`) REFERENCES `classroom` (`id`);

--
-- Ketidakleluasaan untuk tabel `teacher_course`
--
ALTER TABLE `teacher_course`
  ADD CONSTRAINT `teacher_course_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `teacher_course_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Ketidakleluasaan untuk tabel `teacher_profile`
--
ALTER TABLE `teacher_profile`
  ADD CONSTRAINT `teacher_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `teacher_profile_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);

--
-- Ketidakleluasaan untuk tabel `test_result`
--
ALTER TABLE `test_result`
  ADD CONSTRAINT `test_result_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`),
  ADD CONSTRAINT `test_result_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
