-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2024 at 11:33 AM
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

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`id`, `subject_id`, `grading_period`, `type`, `description`, `max_points`, `subject_type`, `activity_date`, `published`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'First Grading', 'Quiz', 'quiz 1', 10.00, 'LecLab6040', '2024-04-01', 0, NULL, '2024-04-25 22:19:27', '2024-04-25 22:19:27'),
(2, 1, 'Midterm', 'Quiz', 'mid quiz 1', 10.00, 'LecLab6040', '2024-04-01', 0, NULL, '2024-04-25 22:20:14', '2024-04-25 22:20:14'),
(3, 1, 'First Grading', 'OtherActivity', 'assign 1', 10.00, 'LecLab6040', '2024-04-25', 0, NULL, '2024-04-25 22:23:58', '2024-04-25 22:23:58'),
(4, 1, 'First Grading', 'Lab Activity', 'Lab 1', 10.00, 'LecLab6040', '2024-04-25', 0, NULL, '2024-04-26 00:03:07', '2024-04-26 00:03:07'),
(5, 1, 'First Grading', 'Exam', 'fg exam', 100.00, 'LecLab6040', '2024-04-30', 0, NULL, '2024-04-26 00:28:53', '2024-04-26 00:28:53'),
(6, 1, 'First Grading', 'Lab Exam', 'fg lab exam', 100.00, 'LecLab6040', '2024-04-30', 0, NULL, '2024-04-26 00:34:28', '2024-04-26 00:34:28'),
(7, 1, 'First Grading', 'Additional Points Exam', 'bonus exam', NULL, 'LecLab6040', NULL, 0, NULL, '2024-04-26 01:01:30', '2024-04-26 01:01:30'),
(8, 4, 'First Grading', 'Quiz', 'quiz 1', 10.00, 'LecLab6040', '2024-04-26', 0, NULL, '2024-04-26 01:14:31', '2024-04-26 01:14:31'),
(9, 4, 'First Grading', 'Lab Activity', 'lab 1', 10.00, 'LecLab6040', '2024-04-26', 0, NULL, '2024-04-26 01:14:54', '2024-04-26 01:14:54'),
(10, 4, 'First Grading', 'OtherActivity', 'ass', 10.00, 'LecLab6040', '2024-04-26', 0, NULL, '2024-04-26 01:15:26', '2024-04-26 01:15:26'),
(11, 4, 'First Grading', 'Exam', 'fg exam', 100.00, 'LecLab6040', '2024-04-26', 0, NULL, '2024-04-26 01:15:52', '2024-04-26 01:15:52'),
(12, 4, 'First Grading', 'Additional Points Exam', 'awdadwawd', NULL, 'LecLab6040', NULL, 0, NULL, '2024-04-26 01:16:11', '2024-04-26 01:16:11'),
(13, 4, 'Midterm', 'OtherActivity', 'ass 2', 10.00, 'LecLab6040', '2024-04-30', 0, NULL, '2024-04-26 01:17:22', '2024-04-26 01:17:22'),
(14, 4, 'Midterm', 'Quiz', 'quiz 2 ', 10.00, 'LecLab6040', '2024-04-26', 0, NULL, '2024-04-26 01:18:09', '2024-04-26 01:18:09'),
(15, 4, 'Midterm', 'Exam', 'mid exam', 100.00, 'LecLab6040', '2024-04-26', 0, NULL, '2024-04-26 01:18:43', '2024-04-26 01:18:43'),
(16, 4, 'Midterm', 'Lab Activity', 'Lab 1', 10.00, 'LecLab6040', '2024-04-27', 0, NULL, '2024-04-26 01:26:12', '2024-04-26 01:26:12'),
(17, 4, 'Finals', 'Lab Activity', 'la b 3', 10.00, 'LecLab6040', '2024-05-09', 0, NULL, '2024-04-26 01:29:12', '2024-04-26 01:29:12'),
(18, 4, 'Finals', 'Quiz', 'quiz 1', 10.00, 'LecLab6040', '2024-05-11', 0, NULL, '2024-04-26 01:30:15', '2024-04-26 01:30:15'),
(19, 4, 'Finals', 'Exam', 'fn exam', 100.00, 'LecLab6040', '2024-04-26', 0, NULL, '2024-04-26 01:31:02', '2024-04-26 01:31:02');

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

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_students`
--

CREATE TABLE `enrolled_students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `imported_classlist_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrolled_students`
--

INSERT INTO `enrolled_students` (`id`, `student_id`, `imported_classlist_id`, `created_at`, `updated_at`) VALUES
(1, 59, 1, '2024-04-23 22:55:37', '2024-04-23 22:55:37'),
(2, 60, 1, '2024-04-23 22:55:37', '2024-04-23 22:55:37'),
(3, 61, 1, '2024-04-23 22:55:37', '2024-04-23 22:55:37'),
(4, 62, 1, '2024-04-23 22:55:39', '2024-04-23 22:55:39'),
(5, 63, 1, '2024-04-23 22:55:39', '2024-04-23 22:55:39'),
(6, 64, 1, '2024-04-23 22:55:40', '2024-04-23 22:55:40'),
(7, 65, 1, '2024-04-23 22:55:41', '2024-04-23 22:55:41'),
(8, 66, 1, '2024-04-23 22:55:41', '2024-04-23 22:55:41'),
(9, 59, 2, '2024-04-24 21:16:14', '2024-04-24 21:16:14'),
(10, 60, 2, '2024-04-24 21:16:14', '2024-04-24 21:16:14'),
(11, 61, 2, '2024-04-24 21:16:14', '2024-04-24 21:16:14'),
(12, 62, 2, '2024-04-24 21:16:14', '2024-04-24 21:16:14'),
(13, 63, 2, '2024-04-24 21:16:14', '2024-04-24 21:16:14'),
(14, 64, 2, '2024-04-24 21:16:14', '2024-04-24 21:16:14'),
(15, 65, 2, '2024-04-24 21:16:14', '2024-04-24 21:16:14'),
(16, 66, 2, '2024-04-24 21:16:15', '2024-04-24 21:16:15'),
(17, 59, 3, '2024-04-24 21:20:00', '2024-04-24 21:20:00'),
(18, 60, 3, '2024-04-24 21:20:00', '2024-04-24 21:20:00'),
(19, 61, 3, '2024-04-24 21:20:00', '2024-04-24 21:20:00'),
(20, 62, 3, '2024-04-24 21:20:00', '2024-04-24 21:20:00'),
(21, 64, 3, '2024-04-24 21:20:00', '2024-04-24 21:20:00'),
(22, 65, 3, '2024-04-24 21:20:00', '2024-04-24 21:20:00'),
(23, 66, 3, '2024-04-24 21:20:00', '2024-04-24 21:20:00'),
(24, 36, 4, '2024-04-25 16:40:05', '2024-04-25 16:40:05'),
(25, 37, 4, '2024-04-25 16:40:05', '2024-04-25 16:40:05'),
(26, 38, 4, '2024-04-25 16:40:06', '2024-04-25 16:40:06'),
(27, 39, 4, '2024-04-25 16:40:06', '2024-04-25 16:40:06'),
(28, 40, 4, '2024-04-25 16:40:06', '2024-04-25 16:40:06'),
(29, 41, 4, '2024-04-25 16:40:06', '2024-04-25 16:40:06'),
(30, 42, 4, '2024-04-25 16:40:07', '2024-04-25 16:40:07'),
(31, 43, 4, '2024-04-25 16:40:07', '2024-04-25 16:40:07'),
(32, 44, 4, '2024-04-25 16:40:07', '2024-04-25 16:40:07'),
(33, 45, 4, '2024-04-25 16:40:07', '2024-04-25 16:40:07'),
(34, 46, 4, '2024-04-25 16:40:08', '2024-04-25 16:40:08'),
(35, 47, 4, '2024-04-25 16:40:08', '2024-04-25 16:40:08'),
(36, 54, 4, '2024-04-25 16:40:08', '2024-04-25 16:40:08'),
(37, 55, 4, '2024-04-25 16:40:08', '2024-04-25 16:40:08'),
(38, 56, 4, '2024-04-25 16:40:08', '2024-04-25 16:40:08');

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
(1, 1, 35, 'M/W, F', '10:00 AM-11:00 AM, 8:00 AM-11:00 AM', 'F213, CA03', '2024-04-23 22:55:37', '2024-04-23 22:55:37'),
(2, 2, 35, 'W', '8:00 AM-9:00 AM', 'F215', '2024-04-24 21:16:14', '2024-04-24 21:16:14'),
(3, 3, 35, 'W', '9:00 AM-10:00 AM', 'F214', '2024-04-24 21:20:00', '2024-04-24 21:20:00'),
(4, 4, 35, 'W/F, T', '9:00 AM-10:00 AM, 8:00 AM-11:00 AM', 'F214, CA02', '2024-04-25 16:40:05', '2024-04-25 16:40:05');

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
(1, 'First Semester', '2023 - 2024', 1, '2024-04-17 19:53:26', '2024-04-17 19:54:09');

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
(1, 'LECLABSUB6040', 'LEC AND LAB SUBJECT 6040', '2 - IDB3', 'First Semester, 2023 - 2024', 'LecLab6040', '2024-04-23 22:55:37', '2024-04-23 22:55:37'),
(2, 'LECSUB1', 'LECTURE SUBJECT', '2 - IDB3', 'First Semester, 2023 - 2024', 'Lec', '2024-04-24 21:16:14', '2024-04-24 21:16:14'),
(3, 'LABSUB1', 'LAB SUBJECT 1', '2 - IDB3', 'First Semester, 2023 - 2024', 'Lab', '2024-04-24 21:19:59', '2024-04-24 21:19:59'),
(4, 'WEBSYS2', 'WEB SYSTEM AND TECHNOLOGIES 2', '2 - IDB3', 'First Semester, 2023 - 2024', 'LecLab6040', '2024-04-25 16:40:05', '2024-04-25 16:40:05');

-- --------------------------------------------------------

--
-- Table structure for table `subject_descriptions`
--

CREATE TABLE `subject_descriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_code` varchar(255) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, 'LecLab6040', 0.60, 0.40, '2024-04-18 23:38:54', '2024-04-18 23:38:54');

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_number`, `name`, `middle_name`, `last_name`, `course`, `gender`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', NULL, NULL, NULL, NULL, '$2y$10$813IV7ZO3Sb9fnlrIC/Nge9UCjYsuxSsHtpu68d/QNuh6EVuxj3UK', 1, 'xlTvxSHQ8Q6mWCproO9wfgvXg13TGIiqaG0Jmw9lJ0aJ6NmGsRRJlfYAlUoO', NULL, '2024-04-17 23:50:14'),
(35, '10001000', 'Richard', 'O', 'Deckard', NULL, NULL, '$2y$10$7c6MGnR0YMys5DdNflC1OOXJETenq5ll9mly4e30kCgwh4DpbOBuK', 2, 'oXsfusw0TRJssX6LUVAeO9LnpHClMcRzHxWGDSbd73qmnN7ET851tzzX2zhv', '2024-04-17 19:52:50', '2024-04-17 23:00:45'),
(36, '20151000', 'Tariq', 'R.', 'Andrews', 'BSIT', 'Male', '$2y$10$Yvk4tGRcg3ZCAE03uIz0w.5qymSJSX4D9hselYRd9AywH5g50sPki', 3, 'aw2pokCVEVSwDghxMJXzBsWlQ1zi0xdJkTOTadLEeiymTUZ8tmEL9oS7w1F5', '2024-04-17 19:54:54', '2024-04-17 23:01:23'),
(37, '20151110', 'Raphael', 'S.', 'Archer', 'BSIT', 'Male', '$2y$10$Haxs8MoHu9.TlSY54kgUFecK74eQPlBCrxtqRAAij8bnMvllo9/66', 3, 'FvMQoQjLj5qdt4qzuB9ZrfAfeQEnHo4ErgVvgJGRXK01MWWXQ4AzIYB8xeGc', '2024-04-17 19:54:54', '2024-04-17 19:54:54'),
(38, '20151120', 'Brian', 'L.', 'Cooke', 'BSCS', 'Male', '$2y$10$I64/.ZzxDsMnpnDAOQmUwezUJIJoNqJIsHNTE3XFekjX3Q.07zjhq', 3, NULL, '2024-04-17 19:54:55', '2024-04-17 19:54:55'),
(39, '20151130', 'Timothy', 'U.', 'Dejesus', 'BSCS', 'Male', '$2y$10$L8V5vAR/jVgVbTQpPrd/e.vheMXzOUA51N.fAFfLZKCUYKz7C.uX6', 3, NULL, '2024-04-17 19:54:56', '2024-04-17 19:54:56'),
(40, '20151140', 'Vincent', 'M.', 'Fernandez', 'BSCS', 'Male', '$2y$10$Ib7fFssRLhGvImOc6f8mEe.g43QLTGKTY21nCRIhikgJBwh/34JMK', 3, NULL, '2024-04-17 19:54:56', '2024-04-17 19:54:56'),
(41, '20151150', 'Olly', 'P.', 'Ford', 'BSCS', 'Male', '$2y$10$52M6qbxko.Q7SE0bcT3j1ucgllst21fRqeiopFQIFaQV1MUVw5vCy', 3, NULL, '2024-04-17 19:54:56', '2024-04-17 19:54:56'),
(42, '20151160', 'Magnus', 'P.', 'Gould', 'BSCS', 'Male', '$2y$10$wzLA.BYDc83mUQaWwLeVHuOyFj7W8P2LeS8qALjAxLne/xRAUmGe6', 3, NULL, '2024-04-17 19:54:56', '2024-04-17 19:54:56'),
(43, '20151170', 'Dennis', 'S.', 'Haley', 'BSCS', 'Male', '$2y$10$68NN2K3/jMaxF8Q62A.7ZOaWZ6teC3JU14AFnO5N2e/.BrBvAvvF.', 3, NULL, '2024-04-17 19:54:56', '2024-04-17 19:54:56'),
(44, '20151180', 'Jakob', 'W.', 'Harding', 'BSCS', 'Male', '$2y$10$6RPBoVkHMYtpBRp7I9GKGuGCN.Oi7KqkKi68hig129nhoQDG7suom', 3, NULL, '2024-04-17 19:54:57', '2024-04-17 19:54:57'),
(45, '20151190', 'Mike', 'A.', 'Ingram', 'BSCS', 'Male', '$2y$10$U5hBlweSXp4Pl6e.GNyjk.jP6Jbr5BrX5C8WruKCiPbK13/iauR7S', 3, NULL, '2024-04-17 19:54:57', '2024-04-17 19:54:57'),
(46, '20151200', 'Omer', 'X.', 'Leonard', 'BSCS', 'Male', '$2y$10$UM.6oQx23f/lzTJPz81ZXO7B3.0yg125uQo5smHODq2AzcYUjIhqi', 3, NULL, '2024-04-17 19:54:57', '2024-04-17 19:54:57'),
(47, '20151210', 'Mike', 'S.', 'Morton', 'BSCS', 'Male', '$2y$10$VBxe0SaNuvOwg2AOnInrS.RGsyEap.wwZSPwzX8rrXeGFq1lTl2RO', 3, NULL, '2024-04-17 19:54:57', '2024-04-17 19:54:57'),
(48, '20151220', 'Trystan', 'Q.', 'Mullen', 'BSCS', 'Male', '$2y$10$6Vj0cOjujg9mpbjP.m8jC.ixk9J/kBAs7hcgn32g9OQlAuX1D5tQa', 3, NULL, '2024-04-17 19:54:57', '2024-04-17 19:54:57'),
(49, '20151230', 'Dewey', 'M.', 'Stein', 'BSCS', 'Male', '$2y$10$JCK4/u/nr9UUv06UJMEgduN5.8han4qEb.EZYnpdfBD0tdm2tSVx6', 3, NULL, '2024-04-17 19:54:57', '2024-04-17 19:54:57'),
(50, '20151240', 'Shannon', 'H.', 'Summers', 'BSCS', 'Male', '$2y$10$EAje0QA/pauklA5/YaYcE.3o.vyVl9/.OB2aErGraYaucmzrnARv6', 3, NULL, '2024-04-17 19:54:58', '2024-04-17 19:54:58'),
(51, '20151250', 'Byron', 'Q.', 'Sweeney', 'BSCS', 'Male', '$2y$10$ZJGXYAzhFObNZzXmACXos.O3rLr7G7K29rxsl4TOkmtJcuq6dgMKa', 3, NULL, '2024-04-17 19:54:58', '2024-04-17 19:54:58'),
(52, '20151260', 'Ishaan', 'Q.', 'Vang', 'BSCS', 'Male', '$2y$10$y98pxErpjsM5V.G.xAJDIO7Y3iVXa5UjSdOc5Jdx3vRjknUcbd3Sa', 3, NULL, '2024-04-17 19:54:58', '2024-04-17 19:54:58'),
(53, '20151270', 'Gideon', 'C.', 'Velasquez', 'BSCS', 'Male', '$2y$10$EiBeEOVIKCVk3UfKPoPBTuMgL.BjYC9sQMPSE8YWdnsrIi//AXxZC', 3, NULL, '2024-04-17 19:54:58', '2024-04-17 19:54:58'),
(54, '20151454', 'Eryn', 'W.', 'Douglas', 'BSIT', 'Female', '$2y$10$mIVRbeWDix4Yn49ejp2PC.elbWlp3AG4xk1IBI2pe0kWbSH2vMGVC', 3, NULL, '2024-04-17 19:54:58', '2024-04-17 19:54:58'),
(55, '20151970', 'Jayden', 'M.', 'Giles', 'BSCS', 'Female', '$2y$10$GO8XGpCwjQdCDcwzxMQ1YuP5/Yo6rCUrHWDZahe6I1IqO0rX3O/2q', 3, NULL, '2024-04-17 19:54:59', '2024-04-17 19:54:59'),
(56, '20151750', 'Evangeline', 'S.', 'Holloway', 'BSCS', 'Female', '$2y$10$JrG5nkcKCavRjLr4uL4O0.OwKJ.lkE2cLJiqEAykDK.pdP/8a2rGK', 3, NULL, '2024-04-17 19:54:59', '2024-04-17 19:54:59'),
(57, '00001000', 'Rachel', 'I', 'Masaya', NULL, NULL, '$2y$10$tMtS2SjOIqRQ/jBvJf.2V.qbNO4lJawEmla0NANuwL49Mb/xfdXhK', 4, 'Al8OFH5TEml8Xyk48Z2pzcfKiON9KoVG9SGHakWBtbvpZ6EZbFN29iernvKV', '2024-04-17 22:40:05', '2024-04-17 23:00:14'),
(58, '406021', 'junamil', '', 'zamora-cacho', NULL, NULL, '$2y$10$IrM8yzIC.eH8lnrHNTutC.b8xUAP3R8rDW15yEH4D4JLy4HJi5l8e', 2, 'N7l1XCvlbMyh76V2aB9Mi657XCnDKjkB3vhxxqsRENsgj79OXfvM82PzKdEG', '2024-04-18 23:20:05', '2024-04-18 23:20:05'),
(59, '20091220', 'Juan', 'L.', 'Dela Cruz', 'BSCS', 'Male', '$2y$10$5XhmHrfDlRKyB7BYSdGT.OcOEJlyoVr/DGExglkB6ZhR4JpQUo8ia', 3, NULL, '2024-04-22 20:26:46', '2024-04-22 20:26:46'),
(60, '20019312', 'Glenn', 'S.', 'Howard', 'BSCS', 'Male', '$2y$10$baGULYm9Tj9jiNypahR3Ous.t8nB3g8.z0tpMB9EcZ0wiyqZ1/C5.', 3, NULL, '2024-04-22 20:26:46', '2024-04-22 20:26:46'),
(61, '20012312', 'Testname', 'S.', 'Test', 'BSCS', 'Male', '$2y$10$yyP4EWUs0rNHRNL.DSh1n.6tBZ9NKlGXkGbzPyaqZGogrn1NIbyva', 3, NULL, '2024-04-22 20:26:47', '2024-04-22 20:26:47'),
(62, '21232122', 'Testname2', 'S.', 'Test', 'BSCS', 'Male', '$2y$10$VqY.pyZhVV1PHzt6ulaXTut4DZXmIZCI9dEwnkfn5eF7/4C1mNgCS', 3, NULL, '2024-04-22 20:26:47', '2024-04-22 20:26:47'),
(63, '21232123', 'Testname3', 'S.', 'Test', 'BSCS', 'Male', '$2y$10$ZIFvBWNLb./AiOTaeAYsOulDl1NnB5QX7WJ1uDAVSWVlb6J52g61K', 3, NULL, '2024-04-22 20:26:47', '2024-04-22 20:26:47'),
(64, '20998131', 'Eliza', 'W.', 'Forza', 'BSIT', 'Female', '$2y$10$/6cbyQ8Hp6Ln6tvxpPO3p.8/DE.fd.XLgpb5pwO3EffU4E2dzPAwO', 3, NULL, '2024-04-22 20:26:47', '2024-04-22 20:26:47'),
(65, '29098881', 'Samus', 'L.', 'Sams', 'BSIT', 'Female', '$2y$10$CfoTdwr0F9Pn7f2XehpzzeKGTmRxBLo0yrFRDYr1RNs9Gil7iKoii', 3, NULL, '2024-04-22 20:26:47', '2024-04-22 20:26:47'),
(66, '20299123', 'Martah', 'S.', 'Sekus', 'BSIT', 'Female', '$2y$10$lngu1CTT.ydjzvZ.1PbRbu59Ih4qfHWh9ir3T6KOOPKO9g4KehKa6', 3, NULL, '2024-04-22 20:26:47', '2024-04-22 20:26:47');

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
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `assessment_descriptions`
--
ALTER TABLE `assessment_descriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrolled_students`
--
ALTER TABLE `enrolled_students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subject_descriptions`
--
ALTER TABLE `subject_descriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject_type_percentage`
--
ALTER TABLE `subject_type_percentage`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
