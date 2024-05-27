-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 07:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ocrsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `grading_period` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `max_points` decimal(5,2) DEFAULT NULL,
  `subject_type` varchar(255) NOT NULL,
  `activity_date` date DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assessment_descriptions`
--

CREATE TABLE `assessment_descriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_desc_id` bigint(20) UNSIGNED NOT NULL,
  `grading_period` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assessment_descriptions`
--

INSERT INTO `assessment_descriptions` (`id`, `subject_desc_id`, `grading_period`, `type`, `description`, `created_at`, `updated_at`) VALUES
(1, 8, 'First Grading', 'Quiz', 'Quiz 1: Data types', '2024-05-19 19:45:05', '2024-05-19 19:45:05'),
(2, 8, 'First Grading', 'OtherActivity', 'Seat Work 1: basics of Data structures', '2024-05-19 19:45:37', '2024-05-19 19:45:37'),
(3, 8, 'First Grading', 'Exam', 'First Grading Examination', '2024-05-19 19:45:55', '2024-05-19 19:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_students`
--

CREATE TABLE `enrolled_students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `imported_classlist_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enrolled_student_id` bigint(20) UNSIGNED NOT NULL,
  `assessment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `points` varchar(255) DEFAULT NULL,
  `total_fg_lec` decimal(5,2) DEFAULT NULL,
  `lec_fg_grade` int(11) DEFAULT NULL,
  `total_fg_lab` decimal(5,2) DEFAULT NULL,
  `lab_fg_grade` int(11) DEFAULT NULL,
  `total_fg_grade` decimal(5,2) DEFAULT NULL,
  `tentative_fg_grade` int(11) DEFAULT NULL,
  `fg_grade` int(11) DEFAULT NULL,
  `total_midterms_lec` decimal(5,2) DEFAULT NULL,
  `lec_midterms_grade` int(11) DEFAULT NULL,
  `total_midterms_lab` decimal(5,2) DEFAULT NULL,
  `lab_midterms_grade` int(11) DEFAULT NULL,
  `total_midterms_grade` decimal(5,2) DEFAULT NULL,
  `tentative_midterms_grade` int(11) DEFAULT NULL,
  `midterms_grade` int(11) DEFAULT NULL,
  `total_finals_lec` decimal(5,2) DEFAULT NULL,
  `lec_finals_grade` int(11) DEFAULT NULL,
  `total_finals_lab` decimal(5,2) DEFAULT NULL,
  `lab_finals_grade` int(11) DEFAULT NULL,
  `total_finals_grade` decimal(5,2) DEFAULT NULL,
  `tentative_finals_grade` int(11) DEFAULT NULL,
  `finals_grade` int(11) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `published_midterms` tinyint(1) DEFAULT 0,
  `published_finals` tinyint(1) DEFAULT 0,
  `status` varchar(255) DEFAULT NULL,
  `midterms_status` varchar(255) DEFAULT NULL,
  `finals_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `imported_classlist`
--

CREATE TABLE `imported_classlist` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subjects_id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `days` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `imported_classlist`
--

INSERT INTO `imported_classlist` (`id`, `subjects_id`, `instructor_id`, `days`, `time`, `room`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'W/F', '9:00 AM-10:00 AM,  8:00 AM-11:00 AM', 'F216, CA01', '2024-05-26 16:32:50', '2024-05-26 17:15:04'),
(2, 2, 1, 'M', '8:00 - 11:00 AM', 'F216', '2024-05-26 16:34:19', '2024-05-26 16:34:19'),
(3, 3, 98, 'TH', '9:00 AM - 10:00 AM', 'F216', '2024-05-26 20:53:50', '2024-05-26 20:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_description_id` bigint(20) UNSIGNED NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `subject_description_id`, `section_name`, `created_at`, `updated_at`) VALUES
(1, 7, '3 - IDB', '2024-05-24 04:32:37', '2024-05-24 04:32:37'),
(2, 8, '2 - IDA', '2024-05-25 01:44:35', '2024-05-25 01:44:35'),
(3, 2, '3 - IDA', '2024-05-25 01:45:33', '2024-05-25 01:45:33'),
(4, 7, '3 - IDA', '2024-05-26 20:07:20', '2024-05-26 20:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `semester_name` varchar(255) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `is_current` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `semester_name`, `school_year`, `is_current`, `created_at`, `updated_at`) VALUES
(1, 'First Semester', '2023 - 2024', 0, '2024-05-21 18:09:33', '2024-05-22 23:53:14'),
(2, 'Second Semester', '2023 - 2024', 0, '2024-05-21 18:55:19', '2024-05-22 22:30:57'),
(3, 'Short Term', '2023 - 2024', 0, '2024-05-21 22:52:02', '2024-05-22 22:29:42'),
(4, 'First Semester', '2022 - 2023', 0, '2024-05-22 23:15:37', '2024-05-22 23:15:37'),
(5, 'Second Semester', '2022 - 2023', 0, '2024-05-22 23:15:55', '2024-05-22 23:15:55'),
(6, 'Short Term', '2022 - 2023', 1, '2024-05-22 23:16:03', '2024-05-26 20:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_code` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `term` varchar(255) NOT NULL,
  `subject_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_code`, `description`, `section`, `term`, `subject_type`, `created_at`, `updated_at`) VALUES
(1, 'WEBDEV2', 'Web Development 2', '3 - IDB', 'First Semester, 2023 - 2024', 'LecLab6040', '2024-05-26 16:32:50', '2024-05-26 17:15:04'),
(2, 'APPDEV1', 'Application Development 1', '3 - IDA', 'First Semester, 2023 - 2024', 'Lec', '2024-05-26 16:34:19', '2024-05-26 16:34:19'),
(3, 'WEBDEV2', 'Web Development 2', '3 - IDA', 'First Semester, 2023 - 2024', 'LecLab4060', '2024-05-26 20:53:50', '2024-05-26 20:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `subject_descriptions`
--

CREATE TABLE `subject_descriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year_level` int(2) DEFAULT NULL,
  `subject_code` varchar(255) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subject_descriptions`
--

INSERT INTO `subject_descriptions` (`id`, `year_level`, `subject_code`, `subject_name`, `created_at`, `updated_at`) VALUES
(2, 3, 'APPDEV1', 'Application Development 1', '2024-05-08 18:48:30', '2024-05-08 18:55:36'),
(3, 1, 'TESTSUB1', 'Testsub1', '2024-05-08 19:25:01', '2024-05-08 19:25:01'),
(5, 4, 'TESTSUB4', 'Testsub4', '2024-05-08 19:25:34', '2024-05-08 19:25:34'),
(6, 3, 'SYSINT2', 'Systems and Applications 2', '2024-05-08 20:55:06', '2024-05-08 20:55:06'),
(7, 3, 'WEBDEV2', 'Web Development 2', '2024-05-09 21:02:17', '2024-05-09 21:02:17'),
(8, 2, 'DSALGO1', 'Data Structures and Algorithm', '2024-05-19 19:44:36', '2024-05-19 19:46:59');

-- --------------------------------------------------------

--
-- Table structure for table `subject_type_percentage`
--

CREATE TABLE `subject_type_percentage` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_type` varchar(255) NOT NULL,
  `lec_percentage` decimal(3,2) NOT NULL,
  `lab_percentage` decimal(3,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subject_type_percentage`
--

INSERT INTO `subject_type_percentage` (`id`, `subject_type`, `lec_percentage`, `lab_percentage`, `created_at`, `updated_at`) VALUES
(1, 'LecLab2080', 0.20, 0.80, '2024-04-17 19:53:43', '2024-04-17 19:53:43'),
(2, 'LecLab6040', 0.60, 0.40, '2024-04-18 23:38:54', '2024-04-18 23:38:54'),
(4, 'LecLab4060', 0.40, 0.60, '2024-05-22 23:47:21', '2024-05-22 23:47:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL COMMENT '1=admin, 2=teacher, 3=student, 4=secretary',
  `secondary_role` tinyint(2) DEFAULT NULL,
  `password_changed` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_number`, `name`, `middle_name`, `last_name`, `course`, `gender`, `password`, `role`, `secondary_role`, `password_changed`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Dante', 'E', 'Sparda', NULL, NULL, '$2y$10$xMfHyc1RQhQfEkXVzF8GNOgJ9Onj4HqtphxKUgbyqfAKMV5gP/HBm', 1, 2, 1, 'kBSuTBbWuxFvzIHiyc2oCC8qnbRdnLJhH59MR1Awp3kTFu4BZmOMq1MRIg0L', NULL, '2024-05-21 20:24:56'),
(67, '10001000', 'Richard', 'R', 'Deckard', NULL, NULL, '$2y$10$2nDMazrP/fb0pas158hUhOmbMKgLC16JmyLbntS93KNwm2Yw6dFci', 2, 1, 1, 'rYe24JCENzhobb1tEyr6rXiQMbFoo0T2LNxEs1pyJXQyfdp9N83WqgUjPzSH', '2024-04-30 18:45:54', '2024-05-01 17:45:51'),
(68, '00001000', 'Rachel', 'D', 'Tyrell', NULL, NULL, '$2y$10$2vtM.i2n4Xj9Ltf3FbnnLO6NtHXOPW.05kR6PDelzA6UCvQxvEURe', 4, 1, 1, '1AY8PEqsLPmvx9U7HNhTM79EqPdJlfmG2UAGYZwOU8BdxhW1C8EekL9moj0k', '2024-04-30 18:46:33', '2024-05-19 20:47:29'),
(69, '20151000', 'Tariq', 'R.', 'Andrews', 'BSIT', 'Male', '$2y$10$dAJhARKEwfe0CITsVoHVgOtZ/Ve4xHkoNYwSdBiV/kl3zh8.7Sh2e', 3, NULL, 1, 'NGRJ8NrZtK674ctRsGaZqyO9z7y3kFWQuEicUED7TWPKx72pvNK4mvU0RGmw', '2024-04-30 20:38:44', '2024-05-13 23:05:04'),
(70, '20151110', 'Raphael', 'S.', 'Archer', 'BSIT', 'Male', '$2y$10$aMcRZ2qTP9ZHPNaJ3tEweeNSZlcJbgF//i7UPS02ZO/mDXkANlQFm', 3, NULL, 0, NULL, '2024-04-30 20:38:44', '2024-04-30 20:38:44'),
(71, '20151120', 'Brian', 'L.', 'Cooke', 'BSCS', 'Male', '$2y$10$vTSHwwQKYKCWv5YX8B9XDeG9uiqD0CyEi.MKzMftbcTyS7hre40RW', 3, NULL, 0, NULL, '2024-04-30 20:38:45', '2024-04-30 20:38:45'),
(72, '20151130', 'Timothy', 'U.', 'Dejesus', 'BSCS', 'Male', '$2y$10$.OlocPtyUfrGrWCp8gXNB.N8zjy9YB4AV.W683LbTSKID2nt6/IfO', 3, NULL, 0, NULL, '2024-04-30 20:38:45', '2024-04-30 20:38:45'),
(73, '20151140', 'Vincent', 'M.', 'Fernandez', 'BSCS', 'Male', '$2y$10$6s5ox7l5uhZNBvzRJXoyr.sjOmz7k4T5Kcll3yY5MFtGCIyM7zyBi', 3, NULL, 0, NULL, '2024-04-30 20:38:45', '2024-04-30 20:38:45'),
(74, '20151150', 'Olly', 'P.', 'Ford', 'BSCS', 'Male', '$2y$10$kw.UsNC.9I0OkCwTdDkxsOj4SToHa2rIzuqa3DPh0sw3.pVkIQW76', 3, NULL, 0, NULL, '2024-04-30 20:38:45', '2024-04-30 20:38:45'),
(75, '20151160', 'Magnus', 'P.', 'Gould', 'BSCS', 'Male', '$2y$10$Vrc9ibat3SDwhcOauWkMj.VM9vdqf2fA1SoAboT4UPhaGg0SI7zLS', 3, NULL, 0, NULL, '2024-04-30 20:38:45', '2024-04-30 20:38:45'),
(76, '20151170', 'Dennis', 'S.', 'Haley', 'BSCS', 'Male', '$2y$10$BcUr17OPB28An1RheYpg3OS8eoU/i1GjfutD38P9yyl1kuS1TkBb2', 3, NULL, 0, NULL, '2024-04-30 20:38:46', '2024-04-30 20:38:46'),
(77, '20151180', 'Jakob', 'W.', 'Harding', 'BSCS', 'Male', '$2y$10$B6doZFHoUhjl64IGVrgBCea6mLyxMxjMsX1Q0pE1cPXqICzAySgeq', 3, NULL, 0, NULL, '2024-04-30 20:38:46', '2024-04-30 20:38:46'),
(78, '20151190', 'Mike', 'A.', 'Ingram', 'BSCS', 'Male', '$2y$10$CeV2AwAmDZtWH7A5AdPtROE3YNBW53DxPV1hkFvBCAlMuBhb/Pz46', 3, NULL, 0, NULL, '2024-04-30 20:38:46', '2024-04-30 20:38:46'),
(79, '20151200', 'Omer', 'X.', 'Leonard', 'BSCS', 'Male', '$2y$10$kRvXZkqB7CT38AtIqee8suB2.d1pikZxiruFJqjOSs17zG2uWy5tG', 3, NULL, 0, NULL, '2024-04-30 20:38:46', '2024-04-30 20:38:46'),
(80, '20151210', 'Mike', 'S.', 'Morton', 'BSCS', 'Male', '$2y$10$EzaEkzTr9ZxCJKCcyQJhweUFWHUCoOAaQdxQQ01fNz05OVwF/NfxC', 3, NULL, 0, NULL, '2024-04-30 20:38:46', '2024-04-30 20:38:46'),
(81, '20151220', 'Trystan', 'Q.', 'Mullen', 'BSCS', 'Male', '$2y$10$g3XA6tUkXBl6wilMJ2pKwuubjn3B.TEFuMOerG7Prdt/fEqJbHT.G', 3, NULL, 0, NULL, '2024-04-30 20:38:46', '2024-04-30 20:38:46'),
(82, '20151230', 'Dewey', 'M.', 'Stein', 'BSCS', 'Male', '$2y$10$RW646hehohfJRhUMA/FoeO9Z6qwOQV4hj3YJZfcxQ46M.nmlw56Me', 3, NULL, 0, NULL, '2024-04-30 20:38:46', '2024-04-30 20:38:46'),
(83, '20151240', 'Shannon', 'H.', 'Summers', 'BSCS', 'Male', '$2y$10$31o/3ydUWrajEN53bkeGAOLFRETt1drOGxWYvTLoH8ys8S2TzN/6q', 3, NULL, 0, NULL, '2024-04-30 20:38:46', '2024-04-30 20:38:46'),
(84, '20151250', 'Byron', 'Q.', 'Sweeney', 'BSCS', 'Male', '$2y$10$uSxreF878s8CyeJIya36UOx.G66qkEo.tM8iw0poZIqLi7F/WjZXK', 3, NULL, 0, NULL, '2024-04-30 20:38:47', '2024-04-30 20:38:47'),
(85, '20151260', 'Ishaan', 'Q.', 'Vang', 'BSCS', 'Male', '$2y$10$hlBvLWcMGV246B6y1BO7dOWh5H/mWe1vLESuPLFw7UuUWwqbCIUHS', 3, NULL, 0, NULL, '2024-04-30 20:38:47', '2024-04-30 20:38:47'),
(86, '20151270', 'Gideon', 'C.', 'Velasquez', 'BSCS', 'Male', '$2y$10$4ENjZ1LGRhyo2yvNteaiUOS.g2aKLH2C1SP97wKhbVZgPBg1yJfGO', 3, NULL, 0, NULL, '2024-04-30 20:38:47', '2024-04-30 20:38:47'),
(87, '20151454', 'Eryn', 'W.', 'Douglas', 'BSIT', 'Female', '$2y$10$Udx./R5VNItFwutZDiIIQ.Ewti6RbYX/XNVKDck4RM7MoMAMtaY/2', 3, NULL, 0, NULL, '2024-04-30 20:38:47', '2024-04-30 20:38:47'),
(88, '20151970', 'Jayden', 'M.', 'Giles', 'BSCS', 'Female', '$2y$10$ThDCJ9Atia6rQm5KVQh48ur/LpdWV.KZp8uEqVI/J8zopMoLUIlKy', 3, NULL, 0, NULL, '2024-04-30 20:38:47', '2024-04-30 20:38:47'),
(89, '20151750', 'Evangeline', 'S.', 'Holloway', 'BSCS', 'Female', '$2y$10$ALh28kx9lx1Q4oiNLxWh6esP8vWJo9Q7Yqh8jiZgk5VySH8iQtF1u', 3, NULL, 0, NULL, '2024-04-30 20:38:47', '2024-04-30 20:38:47'),
(90, '20091220', 'Juan', 'L.', 'Dela Cruz', 'BSCS', 'Male', '$2y$10$rVu9GkiNdXzVzFP5b16UPe7nZY7JW0Xu3zlSUtL.suAPrbgA3k0nO', 3, NULL, 0, NULL, '2024-05-01 17:50:15', '2024-05-01 17:50:15'),
(91, '20019312', 'Glenn', 'S.', 'Howard', 'BSCS', 'Male', '$2y$10$/OFJc3MBm1p3.hp/8EddPexciYT6GHm0yqdxlUrL20D/fwo8stqYq', 3, NULL, 0, NULL, '2024-05-01 17:50:15', '2024-05-01 17:50:15'),
(92, '20012312', 'Testname', 'S.', 'Test', 'BSCS', 'Male', '$2y$10$A/yCiAaUZsAtxQvKx8evNeGAO72iKWCxGPsfsMpw6M4dN9ve5sNVK', 3, NULL, 0, NULL, '2024-05-01 17:50:15', '2024-05-01 17:50:15'),
(93, '21232122', 'Testname2', 'S.', 'Test', 'BSCS', 'Male', '$2y$10$RsbBxXvXshZf7olropT7JenIiCIRu1bFplNGiVEFlCbgPaKneR/.u', 3, NULL, 0, NULL, '2024-05-01 17:50:15', '2024-05-01 17:50:15'),
(94, '21232123', 'Testname3', 'S.', 'Test', 'BSCS', 'Male', '$2y$10$zW0FKkO9qcDICKlIdJv.r..UZT9tF1Z/tkUr7Af7cZUkPiIweLUde', 3, NULL, 0, NULL, '2024-05-01 17:50:16', '2024-05-01 17:50:16'),
(95, '20998131', 'Eliza', 'W.', 'Forza', 'BSIT', 'Female', '$2y$10$JVzOy7F1uVreqFcWakrs1eLISJAWYox81bj23KCmCiCTBfhqHUe06', 3, NULL, 0, NULL, '2024-05-01 17:50:16', '2024-05-01 17:50:16'),
(96, '29098881', 'Samus', 'L.', 'Sams', 'BSIT', 'Female', '$2y$10$WtGSynvh/37ppfZQfwQSV.D0XBbR0ZzCO5CsekDeFAxxanfrn3Gc2', 3, NULL, 0, NULL, '2024-05-01 17:50:16', '2024-05-01 17:50:16'),
(97, '20299123', 'Martah', 'S.', 'Sekus', 'BSIT', 'Female', '$2y$10$2F2VKo1GSHZsT3RoJYZ6GOGIWJO33YuQdDbXfxW2aDBoRq6cXSfEG', 3, NULL, 0, NULL, '2024-05-01 17:50:16', '2024-05-01 17:50:16'),
(98, '10002000', 'Cain', 'H', 'Deckard', NULL, NULL, '$2y$10$0f3gsQlHupTzIKVI4HJZJ.TLyNHn8Ug/lnx/QJT8LctmMm6Mmagxa', 2, NULL, 1, 'ymqhY5wX2q5XDL18eoMYeI2wRX5mZhjcma1HxEetvLki79oij5N9g0m1V2yv', '2024-05-08 21:43:31', '2024-05-19 20:42:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assessments_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `assessment_descriptions`
--
ALTER TABLE `assessment_descriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assessment_descriptions_subject_desc_id_foreign` (`subject_desc_id`);

--
-- Indexes for table `enrolled_students`
--
ALTER TABLE `enrolled_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrolled_students_student_id_foreign` (`student_id`),
  ADD KEY `enrolled_students_imported_classlist_id_foreign` (`imported_classlist_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grades_enrolled_student_id_foreign` (`enrolled_student_id`),
  ADD KEY `grades_assessment_id_foreign` (`assessment_id`);

--
-- Indexes for table `imported_classlist`
--
ALTER TABLE `imported_classlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imported_classlist_subjects_id_foreign` (`subjects_id`),
  ADD KEY `imported_classlist_instructor_id_foreign` (`instructor_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_description_id` (`subject_description_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_semester_school_year` (`semester_name`,`school_year`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_descriptions`
--
ALTER TABLE `subject_descriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subject_descriptions_subject_code_unique` (`subject_code`);

--
-- Indexes for table `subject_type_percentage`
--
ALTER TABLE `subject_type_percentage`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subject_type_percentage_subject_type_unique` (`subject_type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id_number_unique` (`id_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assessment_descriptions`
--
ALTER TABLE `assessment_descriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enrolled_students`
--
ALTER TABLE `enrolled_students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imported_classlist`
--
ALTER TABLE `imported_classlist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject_descriptions`
--
ALTER TABLE `subject_descriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subject_type_percentage`
--
ALTER TABLE `subject_type_percentage`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assessments`
--
ALTER TABLE `assessments`
  ADD CONSTRAINT `assessments_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `assessment_descriptions`
--
ALTER TABLE `assessment_descriptions`
  ADD CONSTRAINT `assessment_descriptions_subject_desc_id_foreign` FOREIGN KEY (`subject_desc_id`) REFERENCES `subject_descriptions` (`id`);

--
-- Constraints for table `enrolled_students`
--
ALTER TABLE `enrolled_students`
  ADD CONSTRAINT `enrolled_students_imported_classlist_id_foreign` FOREIGN KEY (`imported_classlist_id`) REFERENCES `imported_classlist` (`id`),
  ADD CONSTRAINT `enrolled_students_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_assessment_id_foreign` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`id`),
  ADD CONSTRAINT `grades_enrolled_student_id_foreign` FOREIGN KEY (`enrolled_student_id`) REFERENCES `enrolled_students` (`id`);

--
-- Constraints for table `imported_classlist`
--
ALTER TABLE `imported_classlist`
  ADD CONSTRAINT `imported_classlist_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `imported_classlist_subjects_id_foreign` FOREIGN KEY (`subjects_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `fk_subject_description` FOREIGN KEY (`subject_description_id`) REFERENCES `subject_descriptions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
