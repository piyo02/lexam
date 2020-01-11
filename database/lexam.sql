-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 11 Jan 2020 pada 22.37
-- Versi Server: 5.7.28-0ubuntu0.18.04.4
-- PHP Version: 7.2.24-0ubuntu0.18.04.1

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
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `classroom`
--

INSERT INTO `classroom` (`id`, `school_id`, `user_id`, `name`, `description`) VALUES
(1, 1, NULL, 'X IPA 1', 'Kelas 10'),
(2, 1, NULL, 'X IPS 1', 'Kelas 10'),
(3, 1, NULL, 'XI IPA 1', 'Kelas 11'),
(4, 1, NULL, 'XI IPS 1', 'Kelas 11'),
(5, 1, NULL, 'XII IPA 1', 'Kelas 12');

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
(5, 'school_admin', 'Admin Sekolah');

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
(129, 2, 'Sekolah', 'uadmin/schools', 'schools_index', 'home', 1, 1, '-');

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
(19, 'S-8', 1, 'text', '<p>soal esai</p>', NULL, NULL);

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
(2, 18, 5, 4, 'Bank Soal Biologi Kelas XII IPA 1', 'Bank Soal Mid', 1);

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
(66, 12, 'text', 'a', 0),
(67, 12, 'text', 'b', 1),
(68, 12, 'text', 'c', 0),
(69, 12, 'text', 'd', 0),
(70, 12, 'text', 'e', 0),
(82, 19, 'short_answer', 'Soal esai', 10);

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
(3, 4, 1, 3, 1, 0);

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
  `time_start` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `solve_test`
--

INSERT INTO `solve_test` (`id`, `user_id`, `test_id`, `time_start`) VALUES
(1, 19, 4, 1578548866);

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
(5, 19, 4, 11, 'C', '', NULL, 1),
(6, 19, 4, 1, 'B', '', NULL, 1),
(7, 19, 4, 12, NULL, NULL, NULL, NULL),
(8, 19, 4, 19, '', 'Soal esai', NULL, 0);

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
(2, 19, 1, 5);

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
(4, 18, 3),
(5, 18, 4);

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
(2, 18, 1, '192 168 1 1');

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
(4, 18, 5, 3, 'Ulangan Harian', '2020-08-05', 60, 75, 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `test_result`
--

CREATE TABLE `test_result` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `test_id` int(10) UNSIGNED NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `image`, `address`) VALUES
(1, '127.0.0.1', 'admin@fixl.com', '$2y$12$XpBgMvQ5JzfvN3PTgf/tA.XwxbCOs3mO0a10oP9/11qi1NUpv46.u', 'admin@fixl.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1578751303, 1, 'Admin', 'istrator', '081342989185', 'USER_1_1571554027.jpeg', 'admin'),
(13, '::1', 'uadmin@gmail.com', '$2y$10$78SZyvKRKMU7nPCew9w4nOpEUmJ1SeTV4L4ZG2NXXSfbEaswqoepq', 'uadmin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1568678256, 1578583682, 1, 'admin', 'Dinas', '00', 'USER_13_1568678463.jpg', 'jln mutiara no 8'),
(17, '::1', 'smanam@gmail.com', '$2y$10$NIx.vGJvX.a/6J1/Yha1beTeSpb8xvMr5q2mbgpcZ2/2gOMk5.KIS', 'smanam@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1575916410, 1578751336, 1, 'Admin SMA', 'Negeri 6 Kendari', '081234567890', 'USER_17_1578449627.jpg', 'Jalan Banda'),
(18, '::1', 'zidni@gmail.com', '$2y$10$554DNYTB6fzLJoaWdKsFwOSt5v88LAdqO1SlxqRB1JjTYrvT4yMky', 'zidni@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1575919985, 1578720596, 1, 'Al Zidni', 'Kasim', '081232578168', 'USER_18_1577108725.jpg', 'BTN Graha Mandiri Permai Blok K/07'),
(19, '::1', 'alzidni@gmail.com', '$2y$10$CpC0kMgMDYXYtag4Ba4pEe2KMzz2WKsVi4Tk.csIUi6dtrcTsO1oa', 'alzidni@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1575920027, 1578720870, 1, 'Al Zidni', 'Kasim', '081232578167', 'USER_19_1578497304.jpg', 'BTN Graha Mandiri Permai Blok K/07');

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
(34, 18, 3),
(35, 19, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classroom_ibfk_1` (`school_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `question_answer`
--
ALTER TABLE `question_answer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `question_reference`
--
ALTER TABLE `question_reference`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `student_answer`
--
ALTER TABLE `student_answer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `student_profile`
--
ALTER TABLE `student_profile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `teacher_course`
--
ALTER TABLE `teacher_course`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `test_result`
--
ALTER TABLE `test_result`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `classroom`
--
ALTER TABLE `classroom`
  ADD CONSTRAINT `classroom_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`),
  ADD CONSTRAINT `classroom_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);

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
