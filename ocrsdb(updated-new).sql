-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2024 at 07:30 AM
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
(1, 2, 'First Grading', 'Quiz', 'Quiz 1', '2024-05-09 18:19:33', '2024-05-09 18:19:33'),
(2, 2, 'First Grading', 'OtherActivity', 'Seat Work 1', '2024-05-09 18:19:55', '2024-05-09 18:19:55'),
(3, 2, 'First Grading', 'Exam', 'First Grading Examination', '2024-05-09 18:20:13', '2024-05-09 18:20:13'),
(4, 2, 'First Grading', 'Lab Activity', 'lab activity 1', '2024-05-09 18:36:41', '2024-05-09 18:36:41'),
(5, 2, 'First Grading', 'Lab Exam', 'First Grading Examination Lab', '2024-05-09 18:36:56', '2024-05-09 18:36:56'),
(6, 2, 'Midterm', 'Quiz', 'quiz 1', '2024-05-09 18:37:18', '2024-05-09 18:37:18'),
(7, 2, 'Midterm', 'OtherActivity', 'Assignment 1', '2024-05-09 18:37:30', '2024-05-09 18:37:30'),
(8, 2, 'Midterm', 'Exam', 'Midterms Exam', '2024-05-09 18:37:42', '2024-05-09 18:37:42'),
(9, 2, 'Finals', 'Quiz', 'Quiz 1', '2024-05-09 18:42:49', '2024-05-09 18:42:49'),
(10, 2, 'Finals', 'OtherActivity', 'Assignment 1', '2024-05-09 18:43:01', '2024-05-09 18:43:01'),
(11, 2, 'Finals', 'Exam', 'Finals Exam', '2024-05-09 18:43:19', '2024-05-09 18:43:19');

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
(1, 69, 1, '2024-05-08 23:18:25', '2024-05-08 23:18:25'),
(2, 70, 1, '2024-05-08 23:18:26', '2024-05-08 23:18:26'),
(3, 71, 1, '2024-05-08 23:18:26', '2024-05-08 23:18:26'),
(4, 72, 1, '2024-05-08 23:18:26', '2024-05-08 23:18:26'),
(5, 73, 1, '2024-05-08 23:18:26', '2024-05-08 23:18:26'),
(6, 74, 1, '2024-05-08 23:18:26', '2024-05-08 23:18:26'),
(7, 75, 1, '2024-05-08 23:18:26', '2024-05-08 23:18:26'),
(8, 76, 1, '2024-05-08 23:18:26', '2024-05-08 23:18:26'),
(9, 77, 1, '2024-05-08 23:18:26', '2024-05-08 23:18:26'),
(10, 78, 1, '2024-05-08 23:18:26', '2024-05-08 23:18:26'),
(11, 79, 1, '2024-05-08 23:18:26', '2024-05-08 23:18:26'),
(12, 80, 1, '2024-05-08 23:18:26', '2024-05-08 23:18:26'),
(13, 81, 1, '2024-05-08 23:18:26', '2024-05-08 23:18:26'),
(14, 82, 1, '2024-05-08 23:18:26', '2024-05-08 23:18:26'),
(15, 83, 1, '2024-05-08 23:18:26', '2024-05-08 23:18:26'),
(16, 84, 1, '2024-05-08 23:18:26', '2024-05-08 23:18:26'),
(17, 85, 1, '2024-05-08 23:18:26', '2024-05-08 23:18:26'),
(18, 86, 1, '2024-05-08 23:18:26', '2024-05-08 23:18:26'),
(19, 87, 1, '2024-05-08 23:18:26', '2024-05-08 23:18:26'),
(20, 88, 1, '2024-05-08 23:18:26', '2024-05-08 23:18:26'),
(21, 89, 1, '2024-05-08 23:18:26', '2024-05-08 23:18:26'),
(22, 69, 2, '2024-05-08 23:24:57', '2024-05-08 23:24:57'),
(23, 70, 2, '2024-05-08 23:24:57', '2024-05-08 23:24:57'),
(24, 71, 2, '2024-05-08 23:24:58', '2024-05-08 23:24:58'),
(25, 72, 2, '2024-05-08 23:24:58', '2024-05-08 23:24:58'),
(26, 73, 2, '2024-05-08 23:24:58', '2024-05-08 23:24:58'),
(27, 74, 2, '2024-05-08 23:24:58', '2024-05-08 23:24:58'),
(28, 75, 2, '2024-05-08 23:24:58', '2024-05-08 23:24:58'),
(29, 76, 2, '2024-05-08 23:24:58', '2024-05-08 23:24:58'),
(30, 77, 2, '2024-05-08 23:24:58', '2024-05-08 23:24:58'),
(31, 78, 2, '2024-05-08 23:24:58', '2024-05-08 23:24:58'),
(32, 79, 2, '2024-05-08 23:24:58', '2024-05-08 23:24:58'),
(33, 80, 2, '2024-05-08 23:24:58', '2024-05-08 23:24:58'),
(34, 81, 2, '2024-05-08 23:24:58', '2024-05-08 23:24:58'),
(35, 82, 2, '2024-05-08 23:24:58', '2024-05-08 23:24:58'),
(36, 83, 2, '2024-05-08 23:24:58', '2024-05-08 23:24:58'),
(37, 84, 2, '2024-05-08 23:24:58', '2024-05-08 23:24:58'),
(38, 85, 2, '2024-05-08 23:24:58', '2024-05-08 23:24:58'),
(39, 86, 2, '2024-05-08 23:24:58', '2024-05-08 23:24:58'),
(40, 87, 2, '2024-05-08 23:24:58', '2024-05-08 23:24:58'),
(41, 88, 2, '2024-05-08 23:24:58', '2024-05-08 23:24:58'),
(42, 89, 2, '2024-05-08 23:24:58', '2024-05-08 23:24:58'),
(43, 69, 3, '2024-05-08 23:32:09', '2024-05-08 23:32:09'),
(44, 70, 3, '2024-05-08 23:32:09', '2024-05-08 23:32:09'),
(45, 71, 3, '2024-05-08 23:32:09', '2024-05-08 23:32:09'),
(46, 72, 3, '2024-05-08 23:32:09', '2024-05-08 23:32:09'),
(47, 73, 3, '2024-05-08 23:32:09', '2024-05-08 23:32:09'),
(48, 74, 3, '2024-05-08 23:32:10', '2024-05-08 23:32:10'),
(49, 75, 3, '2024-05-08 23:32:10', '2024-05-08 23:32:10'),
(50, 76, 3, '2024-05-08 23:32:10', '2024-05-08 23:32:10'),
(51, 77, 3, '2024-05-08 23:32:10', '2024-05-08 23:32:10'),
(52, 78, 3, '2024-05-08 23:32:10', '2024-05-08 23:32:10'),
(53, 79, 3, '2024-05-08 23:32:10', '2024-05-08 23:32:10'),
(54, 80, 3, '2024-05-08 23:32:10', '2024-05-08 23:32:10'),
(55, 81, 3, '2024-05-08 23:32:10', '2024-05-08 23:32:10'),
(56, 82, 3, '2024-05-08 23:32:10', '2024-05-08 23:32:10'),
(57, 83, 3, '2024-05-08 23:32:10', '2024-05-08 23:32:10'),
(58, 84, 3, '2024-05-08 23:32:10', '2024-05-08 23:32:10'),
(59, 85, 3, '2024-05-08 23:32:10', '2024-05-08 23:32:10'),
(60, 86, 3, '2024-05-08 23:32:10', '2024-05-08 23:32:10'),
(61, 87, 3, '2024-05-08 23:32:10', '2024-05-08 23:32:10'),
(62, 88, 3, '2024-05-08 23:32:10', '2024-05-08 23:32:10'),
(63, 89, 3, '2024-05-08 23:32:10', '2024-05-08 23:32:10'),
(64, 69, 4, '2024-05-08 23:35:59', '2024-05-08 23:35:59'),
(65, 70, 4, '2024-05-08 23:35:59', '2024-05-08 23:35:59'),
(66, 71, 4, '2024-05-08 23:35:59', '2024-05-08 23:35:59'),
(67, 72, 4, '2024-05-08 23:36:00', '2024-05-08 23:36:00'),
(68, 73, 4, '2024-05-08 23:36:00', '2024-05-08 23:36:00'),
(69, 74, 4, '2024-05-08 23:36:00', '2024-05-08 23:36:00'),
(70, 75, 4, '2024-05-08 23:36:00', '2024-05-08 23:36:00'),
(71, 76, 4, '2024-05-08 23:36:00', '2024-05-08 23:36:00'),
(72, 77, 4, '2024-05-08 23:36:00', '2024-05-08 23:36:00'),
(73, 78, 4, '2024-05-08 23:36:00', '2024-05-08 23:36:00'),
(74, 79, 4, '2024-05-08 23:36:00', '2024-05-08 23:36:00'),
(75, 80, 4, '2024-05-08 23:36:00', '2024-05-08 23:36:00'),
(76, 81, 4, '2024-05-08 23:36:00', '2024-05-08 23:36:00'),
(77, 82, 4, '2024-05-08 23:36:00', '2024-05-08 23:36:00'),
(78, 83, 4, '2024-05-08 23:36:00', '2024-05-08 23:36:00'),
(79, 84, 4, '2024-05-08 23:36:00', '2024-05-08 23:36:00'),
(80, 85, 4, '2024-05-08 23:36:00', '2024-05-08 23:36:00'),
(81, 86, 4, '2024-05-08 23:36:00', '2024-05-08 23:36:00'),
(82, 87, 4, '2024-05-08 23:36:00', '2024-05-08 23:36:00'),
(83, 88, 4, '2024-05-08 23:36:01', '2024-05-08 23:36:01'),
(87, 89, 4, '2024-05-09 00:13:15', '2024-05-09 00:13:15'),
(88, 69, 5, '2024-05-09 00:13:53', '2024-05-09 00:13:53'),
(89, 70, 5, '2024-05-09 00:13:53', '2024-05-09 00:13:53'),
(90, 71, 5, '2024-05-09 00:13:53', '2024-05-09 00:13:53'),
(91, 72, 5, '2024-05-09 00:13:53', '2024-05-09 00:13:53'),
(92, 73, 5, '2024-05-09 00:13:53', '2024-05-09 00:13:53'),
(93, 74, 5, '2024-05-09 00:13:53', '2024-05-09 00:13:53'),
(94, 75, 5, '2024-05-09 00:13:54', '2024-05-09 00:13:54'),
(95, 76, 5, '2024-05-09 00:13:54', '2024-05-09 00:13:54'),
(96, 77, 5, '2024-05-09 00:13:54', '2024-05-09 00:13:54'),
(97, 78, 5, '2024-05-09 00:13:54', '2024-05-09 00:13:54'),
(99, 87, 5, '2024-05-09 00:13:54', '2024-05-09 00:13:54'),
(100, 88, 5, '2024-05-09 00:13:54', '2024-05-09 00:13:54'),
(102, 79, 5, '2024-05-09 00:19:45', '2024-05-09 00:19:45'),
(103, 89, 5, '2024-05-09 00:19:45', '2024-05-09 00:19:45');

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
(1, 1, 98, 'W/F, T', '9:00 AM-10:00 AM, 8:00 AM-11:00 AM', 'F215, CA01', '2024-05-08 23:18:25', '2024-05-08 23:18:25'),
(2, 2, 67, 'M', '10:00 AM-11:00 AM', 'F213', '2024-05-08 23:24:57', '2024-05-08 23:24:57'),
(3, 3, 67, 'M', '10:00 AM-11:00 AM', 'F213', '2024-05-08 23:32:09', '2024-05-08 23:32:09'),
(4, 4, 67, 'M/W, T', '9:00 AM-10:00 AM, 8:00 AM-11:00 AM', 'F215, CA01', '2024-05-08 23:35:59', '2024-05-08 23:35:59'),
(5, 5, 67, 'M/F, F', '10:00 AM-11:00 AM, 8:00 AM-11:00 AM', 'F215, CA01', '2024-05-09 00:13:53', '2024-05-09 00:13:53');

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
(1, 'DSALGO1', 'DATA STRUCTURES AND ALGORITHM', '2 - IDC4', 'First Semester, 2023 - 2024', 'LecLab2080', '2024-05-08 23:18:25', '2024-05-08 23:18:25'),
(2, 'SYSINT2', 'SYTEMS INTEGRATION AND ARCHITECTURE', '2 - IDC2', 'First Semester, 2023 - 2024', 'LecLab6040', '2024-05-08 23:24:57', '2024-05-08 23:24:57'),
(3, 'SYSINT2', 'SYTEMS INTEGRATION AND ARCHITECTURE', '2 - IDB3', 'First Semester, 2023 - 2024', 'LecLab2080', '2024-05-08 23:32:09', '2024-05-08 23:32:09'),
(4, 'DSALGO1', 'DATA STRUCTURES AND ALGORITHM', '2 - IDB3', 'First Semester, 2023 - 2024', 'LecLab6040', '2024-05-08 23:35:59', '2024-05-08 23:35:59'),
(5, 'IMDBSE2', 'ADVANCED DATABASE SYSTEMS', '2 - IDB3', 'First Semester, 2023 - 2024', 'LecLab2080', '2024-05-09 00:13:53', '2024-05-09 00:13:53');

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
(4, 2, 'TESTSUB2', 'Testsub2', '2024-05-08 19:25:18', '2024-05-08 19:25:18'),
(5, 4, 'TESTSUB4', 'Testsub4', '2024-05-08 19:25:34', '2024-05-08 19:25:34'),
(6, 3, 'SYSINT2', 'Systems and Applications 2', '2024-05-08 20:55:06', '2024-05-08 20:55:06'),
(7, NULL, 'WEBDEV2', 'Web Development 2', '2024-05-09 21:02:17', '2024-05-09 21:02:17');

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
  `password_changed` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_number`, `name`, `middle_name`, `last_name`, `course`, `gender`, `password`, `role`, `password_changed`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', NULL, NULL, NULL, NULL, '$2y$10$xMfHyc1RQhQfEkXVzF8GNOgJ9Onj4HqtphxKUgbyqfAKMV5gP/HBm', 1, 1, 'tgnx5r1mSURnww1RUmgaam1JfLiaPUxwLEeWZ00xOpnzTOgomEu9W8KQYHVg', NULL, '2024-05-08 17:38:57'),
(67, '10001000', 'Richard', 'R', 'Deckard', NULL, NULL, '$2y$10$2nDMazrP/fb0pas158hUhOmbMKgLC16JmyLbntS93KNwm2Yw6dFci', 2, 1, '6nR3wqw1Y0ZEM2L4GsCVSuweeQ0ZvE8xzCilw0aTdVd5RSypIo2NWO2iTKuu', '2024-04-30 18:45:54', '2024-05-01 17:45:51'),
(68, '00001000', 'Rachel', 'D', 'Tyrell', NULL, NULL, '$2y$10$2vtM.i2n4Xj9Ltf3FbnnLO6NtHXOPW.05kR6PDelzA6UCvQxvEURe', 4, 1, 'nos9eaG49m6Brs8zpDbGQiMRIZ9YCMaPjdVWYrLhYoBLK2kXPn9QCxqibV9z', '2024-04-30 18:46:33', '2024-05-09 21:00:46'),
(69, '20151000', 'Tariq', 'R.', 'Andrews', 'BSIT', 'Male', '$2y$10$NHbMyoYclpESUJx68VslXettT9fLQwlwtmXqy1e17zi6ex0QLtCvK', 3, 0, 'Xze4O9DoR7ewWfxLOZWIm2qDVvV2wEONCuojfGht7ag6hWh1enjaQ0k1gFiZ', '2024-04-30 20:38:44', '2024-04-30 21:01:30'),
(70, '20151110', 'Raphael', 'S.', 'Archer', 'BSIT', 'Male', '$2y$10$aMcRZ2qTP9ZHPNaJ3tEweeNSZlcJbgF//i7UPS02ZO/mDXkANlQFm', 3, 0, NULL, '2024-04-30 20:38:44', '2024-04-30 20:38:44'),
(71, '20151120', 'Brian', 'L.', 'Cooke', 'BSCS', 'Male', '$2y$10$vTSHwwQKYKCWv5YX8B9XDeG9uiqD0CyEi.MKzMftbcTyS7hre40RW', 3, 0, NULL, '2024-04-30 20:38:45', '2024-04-30 20:38:45'),
(72, '20151130', 'Timothy', 'U.', 'Dejesus', 'BSCS', 'Male', '$2y$10$.OlocPtyUfrGrWCp8gXNB.N8zjy9YB4AV.W683LbTSKID2nt6/IfO', 3, 0, NULL, '2024-04-30 20:38:45', '2024-04-30 20:38:45'),
(73, '20151140', 'Vincent', 'M.', 'Fernandez', 'BSCS', 'Male', '$2y$10$6s5ox7l5uhZNBvzRJXoyr.sjOmz7k4T5Kcll3yY5MFtGCIyM7zyBi', 3, 0, NULL, '2024-04-30 20:38:45', '2024-04-30 20:38:45'),
(74, '20151150', 'Olly', 'P.', 'Ford', 'BSCS', 'Male', '$2y$10$kw.UsNC.9I0OkCwTdDkxsOj4SToHa2rIzuqa3DPh0sw3.pVkIQW76', 3, 0, NULL, '2024-04-30 20:38:45', '2024-04-30 20:38:45'),
(75, '20151160', 'Magnus', 'P.', 'Gould', 'BSCS', 'Male', '$2y$10$Vrc9ibat3SDwhcOauWkMj.VM9vdqf2fA1SoAboT4UPhaGg0SI7zLS', 3, 0, NULL, '2024-04-30 20:38:45', '2024-04-30 20:38:45'),
(76, '20151170', 'Dennis', 'S.', 'Haley', 'BSCS', 'Male', '$2y$10$BcUr17OPB28An1RheYpg3OS8eoU/i1GjfutD38P9yyl1kuS1TkBb2', 3, 0, NULL, '2024-04-30 20:38:46', '2024-04-30 20:38:46'),
(77, '20151180', 'Jakob', 'W.', 'Harding', 'BSCS', 'Male', '$2y$10$B6doZFHoUhjl64IGVrgBCea6mLyxMxjMsX1Q0pE1cPXqICzAySgeq', 3, 0, NULL, '2024-04-30 20:38:46', '2024-04-30 20:38:46'),
(78, '20151190', 'Mike', 'A.', 'Ingram', 'BSCS', 'Male', '$2y$10$CeV2AwAmDZtWH7A5AdPtROE3YNBW53DxPV1hkFvBCAlMuBhb/Pz46', 3, 0, NULL, '2024-04-30 20:38:46', '2024-04-30 20:38:46'),
(79, '20151200', 'Omer', 'X.', 'Leonard', 'BSCS', 'Male', '$2y$10$kRvXZkqB7CT38AtIqee8suB2.d1pikZxiruFJqjOSs17zG2uWy5tG', 3, 0, NULL, '2024-04-30 20:38:46', '2024-04-30 20:38:46'),
(80, '20151210', 'Mike', 'S.', 'Morton', 'BSCS', 'Male', '$2y$10$EzaEkzTr9ZxCJKCcyQJhweUFWHUCoOAaQdxQQ01fNz05OVwF/NfxC', 3, 0, NULL, '2024-04-30 20:38:46', '2024-04-30 20:38:46'),
(81, '20151220', 'Trystan', 'Q.', 'Mullen', 'BSCS', 'Male', '$2y$10$g3XA6tUkXBl6wilMJ2pKwuubjn3B.TEFuMOerG7Prdt/fEqJbHT.G', 3, 0, NULL, '2024-04-30 20:38:46', '2024-04-30 20:38:46'),
(82, '20151230', 'Dewey', 'M.', 'Stein', 'BSCS', 'Male', '$2y$10$RW646hehohfJRhUMA/FoeO9Z6qwOQV4hj3YJZfcxQ46M.nmlw56Me', 3, 0, NULL, '2024-04-30 20:38:46', '2024-04-30 20:38:46'),
(83, '20151240', 'Shannon', 'H.', 'Summers', 'BSCS', 'Male', '$2y$10$31o/3ydUWrajEN53bkeGAOLFRETt1drOGxWYvTLoH8ys8S2TzN/6q', 3, 0, NULL, '2024-04-30 20:38:46', '2024-04-30 20:38:46'),
(84, '20151250', 'Byron', 'Q.', 'Sweeney', 'BSCS', 'Male', '$2y$10$uSxreF878s8CyeJIya36UOx.G66qkEo.tM8iw0poZIqLi7F/WjZXK', 3, 0, NULL, '2024-04-30 20:38:47', '2024-04-30 20:38:47'),
(85, '20151260', 'Ishaan', 'Q.', 'Vang', 'BSCS', 'Male', '$2y$10$hlBvLWcMGV246B6y1BO7dOWh5H/mWe1vLESuPLFw7UuUWwqbCIUHS', 3, 0, NULL, '2024-04-30 20:38:47', '2024-04-30 20:38:47'),
(86, '20151270', 'Gideon', 'C.', 'Velasquez', 'BSCS', 'Male', '$2y$10$4ENjZ1LGRhyo2yvNteaiUOS.g2aKLH2C1SP97wKhbVZgPBg1yJfGO', 3, 0, NULL, '2024-04-30 20:38:47', '2024-04-30 20:38:47'),
(87, '20151454', 'Eryn', 'W.', 'Douglas', 'BSIT', 'Female', '$2y$10$Udx./R5VNItFwutZDiIIQ.Ewti6RbYX/XNVKDck4RM7MoMAMtaY/2', 3, 0, NULL, '2024-04-30 20:38:47', '2024-04-30 20:38:47'),
(88, '20151970', 'Jayden', 'M.', 'Giles', 'BSCS', 'Female', '$2y$10$ThDCJ9Atia6rQm5KVQh48ur/LpdWV.KZp8uEqVI/J8zopMoLUIlKy', 3, 0, NULL, '2024-04-30 20:38:47', '2024-04-30 20:38:47'),
(89, '20151750', 'Evangeline', 'S.', 'Holloway', 'BSCS', 'Female', '$2y$10$ALh28kx9lx1Q4oiNLxWh6esP8vWJo9Q7Yqh8jiZgk5VySH8iQtF1u', 3, 0, NULL, '2024-04-30 20:38:47', '2024-04-30 20:38:47'),
(90, '20091220', 'Juan', 'L.', 'Dela Cruz', 'BSCS', 'Male', '$2y$10$rVu9GkiNdXzVzFP5b16UPe7nZY7JW0Xu3zlSUtL.suAPrbgA3k0nO', 3, 0, NULL, '2024-05-01 17:50:15', '2024-05-01 17:50:15'),
(91, '20019312', 'Glenn', 'S.', 'Howard', 'BSCS', 'Male', '$2y$10$/OFJc3MBm1p3.hp/8EddPexciYT6GHm0yqdxlUrL20D/fwo8stqYq', 3, 0, NULL, '2024-05-01 17:50:15', '2024-05-01 17:50:15'),
(92, '20012312', 'Testname', 'S.', 'Test', 'BSCS', 'Male', '$2y$10$A/yCiAaUZsAtxQvKx8evNeGAO72iKWCxGPsfsMpw6M4dN9ve5sNVK', 3, 0, NULL, '2024-05-01 17:50:15', '2024-05-01 17:50:15'),
(93, '21232122', 'Testname2', 'S.', 'Test', 'BSCS', 'Male', '$2y$10$RsbBxXvXshZf7olropT7JenIiCIRu1bFplNGiVEFlCbgPaKneR/.u', 3, 0, NULL, '2024-05-01 17:50:15', '2024-05-01 17:50:15'),
(94, '21232123', 'Testname3', 'S.', 'Test', 'BSCS', 'Male', '$2y$10$zW0FKkO9qcDICKlIdJv.r..UZT9tF1Z/tkUr7Af7cZUkPiIweLUde', 3, 0, NULL, '2024-05-01 17:50:16', '2024-05-01 17:50:16'),
(95, '20998131', 'Eliza', 'W.', 'Forza', 'BSIT', 'Female', '$2y$10$JVzOy7F1uVreqFcWakrs1eLISJAWYox81bj23KCmCiCTBfhqHUe06', 3, 0, NULL, '2024-05-01 17:50:16', '2024-05-01 17:50:16'),
(96, '29098881', 'Samus', 'L.', 'Sams', 'BSIT', 'Female', '$2y$10$WtGSynvh/37ppfZQfwQSV.D0XBbR0ZzCO5CsekDeFAxxanfrn3Gc2', 3, 0, NULL, '2024-05-01 17:50:16', '2024-05-01 17:50:16'),
(97, '20299123', 'Martah', 'S.', 'Sekus', 'BSIT', 'Female', '$2y$10$2F2VKo1GSHZsT3RoJYZ6GOGIWJO33YuQdDbXfxW2aDBoRq6cXSfEG', 3, 0, NULL, '2024-05-01 17:50:16', '2024-05-01 17:50:16'),
(98, '10002000', 'Cain', 'H', 'Deckard', NULL, NULL, '$2y$10$0f3gsQlHupTzIKVI4HJZJ.TLyNHn8Ug/lnx/QJT8LctmMm6Mmagxa', 2, 1, 'ymqhY5wX2q5XDL18eoMYeI2wRX5mZhjcma1HxEetvLki79oij5N9g0m1V2yv', '2024-05-08 21:43:31', '2024-05-08 21:44:13');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assessment_descriptions`
--
ALTER TABLE `assessment_descriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `enrolled_students`
--
ALTER TABLE `enrolled_students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subject_descriptions`
--
ALTER TABLE `subject_descriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subject_type_percentage`
--
ALTER TABLE `subject_type_percentage`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

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
