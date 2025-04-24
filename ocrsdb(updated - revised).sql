-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2025 at 03:57 PM
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
  `manual_activity_date` varchar(255) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`id`, `subject_id`, `grading_period`, `type`, `description`, `max_points`, `subject_type`, `activity_date`, `manual_activity_date`, `published`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 5, 'First Grading', 'Lab Activity', 'LAB 1', 50.00, 'Lab', '2025-04-15', NULL, 1, '2025-04-24 05:47:09', '2025-04-19 19:16:30', '2025-04-24 05:47:09'),
(2, 5, 'Midterm', 'Lab Activity', 'Lab 1', 45.00, 'Lab', '2025-04-16', NULL, 0, NULL, '2025-04-19 19:16:47', '2025-04-19 19:16:47'),
(3, 5, 'Finals', 'Lab Activity', 'Lab activity 2', 75.00, 'Lab', '2025-04-25', NULL, 0, NULL, '2025-04-19 19:17:19', '2025-04-19 19:17:19'),
(4, 5, 'First Grading', 'Lab Exam', 'Lab Examination FG', 100.00, 'Lab', '2025-04-17', NULL, 1, '2025-04-24 05:54:54', '2025-04-19 19:17:47', '2025-04-24 05:54:54'),
(5, 5, 'Midterm', 'Lab Exam', 'Midterm Exdam', 100.00, 'Lab', '2025-04-16', NULL, 0, NULL, '2025-04-19 19:18:10', '2025-04-19 19:18:10'),
(6, 5, 'Finals', 'Lab Exam', 'Finals LAB Exam', 100.00, 'Lab', '2025-04-19', NULL, 0, NULL, '2025-04-19 19:18:45', '2025-04-19 19:18:45'),
(7, 6, 'First Grading', 'Quiz', 'Quiz 1', 15.00, 'LecLab4060', '2025-04-08', NULL, 0, NULL, '2025-04-19 19:24:56', '2025-04-19 19:24:56'),
(8, 6, 'First Grading', 'OtherActivity', 'Seat Work 1', 10.00, 'LecLab4060', '2025-04-22', NULL, 0, NULL, '2025-04-19 19:25:21', '2025-04-19 19:25:21'),
(9, 6, 'First Grading', 'Exam', 'FG Examination', 100.00, 'LecLab4060', '2025-04-23', NULL, 0, NULL, '2025-04-19 19:25:38', '2025-04-19 19:25:38'),
(10, 6, 'First Grading', 'Lab Activity', 'Laboratory Work 1', 45.00, 'LecLab4060', '2025-04-08', NULL, 0, NULL, '2025-04-19 19:26:06', '2025-04-19 19:26:06'),
(11, 6, 'First Grading', 'Lab Exam', 'Lab Examination FG', 100.00, 'LecLab4060', '2025-04-11', NULL, 0, NULL, '2025-04-19 19:26:49', '2025-04-19 19:26:49'),
(12, 6, 'Midterm', 'Quiz', 'quiz 1', 20.00, 'LecLab4060', '2025-04-10', NULL, 0, NULL, '2025-04-19 19:27:13', '2025-04-19 19:27:13'),
(13, 6, 'Midterm', 'OtherActivity', 'Activity 1', 15.00, 'LecLab4060', '2025-04-09', NULL, 0, NULL, '2025-04-19 19:27:43', '2025-04-19 19:27:43'),
(14, 6, 'Midterm', 'Exam', 'Midterm exam ', 100.00, 'LecLab4060', '2025-04-21', NULL, 0, NULL, '2025-04-19 19:30:41', '2025-04-19 19:30:41'),
(15, 6, 'Midterm', 'Lab Activity', 'lab 1', 50.00, 'LecLab4060', '2025-04-12', NULL, 0, NULL, '2025-04-19 19:31:10', '2025-04-19 19:31:10'),
(16, 6, 'Midterm', 'Lab Exam', 'midterm lab exam', 100.00, 'LecLab4060', '2025-04-16', NULL, 0, NULL, '2025-04-19 19:31:41', '2025-04-19 19:31:41'),
(17, 6, 'Finals', 'Quiz', 'quiz 1', 10.00, 'LecLab4060', '2025-04-11', NULL, 0, NULL, '2025-04-19 19:36:28', '2025-04-19 19:36:28'),
(18, 6, 'Finals', 'OtherActivity', 'seat work1 ', 10.00, 'LecLab4060', '2025-04-24', NULL, 0, NULL, '2025-04-19 19:38:34', '2025-04-19 19:38:34'),
(19, 6, 'Finals', 'Exam', 'Finals exam', 100.00, 'LecLab4060', '2025-04-23', NULL, 0, NULL, '2025-04-19 19:39:07', '2025-04-19 19:39:07'),
(20, 6, 'Finals', 'Lab Activity', 'lab 1 ', 25.00, 'LecLab4060', '2025-04-15', NULL, 0, NULL, '2025-04-19 19:39:56', '2025-04-19 19:39:56'),
(21, 6, 'Finals', 'Lab Exam', 'finals lab exam', 100.00, 'LecLab4060', '2025-04-17', NULL, 0, NULL, '2025-04-19 19:40:33', '2025-04-19 19:40:33'),
(22, 7, 'First Grading', 'Quiz', 'quiz 1', 15.00, 'LecLab6040', '2025-04-24', NULL, 0, NULL, '2025-04-19 19:53:51', '2025-04-19 19:53:51'),
(23, 7, 'First Grading', 'OtherActivity', 'Activity 1', 15.00, 'LecLab6040', '2025-04-16', NULL, 0, NULL, '2025-04-19 19:54:14', '2025-04-19 19:54:14'),
(24, 7, 'First Grading', 'Exam', 'FG exam', 100.00, 'LecLab6040', '2025-04-23', NULL, 0, NULL, '2025-04-19 19:57:01', '2025-04-19 19:57:01'),
(25, 7, 'First Grading', 'Lab Activity', 'Lab 1', 50.00, 'LecLab6040', '2025-04-16', NULL, 0, NULL, '2025-04-19 19:57:34', '2025-04-19 19:57:34'),
(26, 7, 'First Grading', 'Lab Exam', 'Lab exam', 100.00, 'LecLab6040', '2025-04-10', NULL, 0, NULL, '2025-04-19 19:58:00', '2025-04-19 19:58:00'),
(27, 7, 'Midterm', 'Quiz', 'quiz 1 ', 20.00, 'LecLab6040', '2025-04-03', NULL, 0, NULL, '2025-04-19 20:00:03', '2025-04-19 20:00:03'),
(28, 7, 'Midterm', 'OtherActivity', 'Seat work 1 ', 15.00, 'LecLab6040', '2025-04-08', NULL, 0, NULL, '2025-04-19 20:00:27', '2025-04-19 20:00:27'),
(29, 7, 'Midterm', 'Exam', 'Midterm Exam ', 100.00, 'LecLab6040', '2025-04-15', NULL, 0, NULL, '2025-04-19 20:00:49', '2025-04-19 20:00:49'),
(30, 7, 'Midterm', 'Lab Activity', 'Lab 1 ', 45.00, 'LecLab6040', '2025-04-17', NULL, 0, NULL, '2025-04-19 20:01:17', '2025-04-19 20:01:17'),
(31, 7, 'Midterm', 'Lab Exam', 'Midterm Lab exam', 100.00, 'LecLab6040', '2025-04-16', NULL, 0, NULL, '2025-04-19 20:02:00', '2025-04-19 20:02:00'),
(32, 7, 'Finals', 'Quiz', 'quiz 1 ', 15.00, 'LecLab6040', '2025-04-16', NULL, 0, NULL, '2025-04-19 20:02:24', '2025-04-19 20:02:24'),
(33, 7, 'Finals', 'OtherActivity', 'Seat work 1 ', 20.00, 'LecLab6040', '2025-04-24', NULL, 0, NULL, '2025-04-19 20:04:24', '2025-04-19 20:04:24'),
(34, 7, 'Finals', 'Exam', 'Finals Exam', 100.00, 'LecLab6040', '2025-04-14', NULL, 0, NULL, '2025-04-19 20:07:54', '2025-04-19 20:07:54'),
(35, 7, 'Finals', 'Lab Activity', 'lab 1 ', 60.00, 'LecLab6040', '2025-04-24', NULL, 0, NULL, '2025-04-19 20:08:50', '2025-04-19 20:08:50'),
(36, 7, 'Finals', 'Lab Exam', 'finals lab exam', 100.00, 'LecLab6040', '2025-04-16', NULL, 0, NULL, '2025-04-19 20:11:20', '2025-04-19 20:11:20'),
(37, 8, 'First Grading', 'Quiz', 'quiz 1 ', 15.00, 'LecLab5050', '2025-04-17', NULL, 0, NULL, '2025-04-19 20:14:35', '2025-04-19 20:14:35'),
(38, 8, 'First Grading', 'OtherActivity', 'seat work 1', 10.00, 'LecLab5050', '2025-04-23', NULL, 0, NULL, '2025-04-19 20:15:40', '2025-04-19 20:15:40'),
(39, 8, 'First Grading', 'Exam', 'FG exam', 100.00, 'LecLab5050', '2025-04-17', NULL, 0, NULL, '2025-04-19 20:17:29', '2025-04-19 20:17:29'),
(40, 8, 'First Grading', 'Lab Activity', 'Lab 1 ', 35.00, 'LecLab5050', '2025-04-17', NULL, 0, NULL, '2025-04-19 20:18:41', '2025-04-19 20:18:41'),
(41, 8, 'First Grading', 'Lab Exam', 'Fg lab exam ', 100.00, 'LecLab5050', '2025-04-17', NULL, 0, NULL, '2025-04-19 20:19:13', '2025-04-19 20:19:13'),
(42, 8, 'Midterm', 'Quiz', 'quiz 1 ', 25.00, 'LecLab5050', '2025-04-18', NULL, 0, NULL, '2025-04-19 20:22:05', '2025-04-19 20:22:05'),
(43, 8, 'Midterm', 'OtherActivity', 'Seat work 1 ', 30.00, 'LecLab5050', '2025-04-18', NULL, 0, NULL, '2025-04-19 20:22:28', '2025-04-19 20:22:28'),
(44, 8, 'Midterm', 'Exam', 'Midterm exam', 100.00, 'LecLab5050', '2025-04-17', NULL, 0, NULL, '2025-04-19 20:23:04', '2025-04-19 20:23:04'),
(45, 8, 'Midterm', 'Lab Activity', 'Lab 1 ', 45.00, 'LecLab5050', '2025-04-16', NULL, 0, NULL, '2025-04-19 20:24:43', '2025-04-19 20:24:43'),
(46, 8, 'Midterm', 'Lab Exam', 'Midterm Lab exam ', 100.00, 'LecLab5050', '2025-04-17', NULL, 0, NULL, '2025-04-19 20:25:15', '2025-04-19 20:25:15'),
(47, 8, 'Finals', 'Quiz', 'quiz 1 ', 30.00, 'LecLab5050', '2025-04-17', NULL, 0, NULL, '2025-04-19 20:27:12', '2025-04-19 20:27:12'),
(48, 8, 'Finals', 'OtherActivity', 'Assignment 1', 45.00, 'LecLab5050', '2025-04-17', NULL, 0, NULL, '2025-04-19 20:28:04', '2025-04-19 20:28:04'),
(49, 8, 'Finals', 'Exam', 'Finals Exam', 100.00, 'LecLab5050', '2025-04-16', NULL, 0, NULL, '2025-04-19 20:28:43', '2025-04-19 20:28:43'),
(50, 8, 'Finals', 'Lab Activity', 'Lab 1 ', 40.00, 'LecLab5050', '2025-04-23', NULL, 0, NULL, '2025-04-19 20:29:40', '2025-04-19 20:29:40'),
(51, 8, 'Finals', 'Lab Exam', 'Finals Lab exam', 100.00, 'LecLab5050', '2025-04-17', NULL, 0, NULL, '2025-04-19 20:30:12', '2025-04-19 20:30:12'),
(52, 5, 'Finals', 'Direct Bonus Grade', 'fg', NULL, 'Lab', NULL, NULL, 0, NULL, '2025-04-21 21:29:02', '2025-04-21 21:29:02'),
(53, 12, 'First Grading', 'Quiz', 'adawd', 10.00, 'Lec', '2025-04-23', NULL, 1, '2025-04-23 23:51:08', '2025-04-21 22:29:13', '2025-04-23 23:51:08'),
(54, 12, 'First Grading', 'OtherActivity', 'awawda', 20.00, 'Lec', '2025-04-24', NULL, 1, '2025-04-23 23:51:10', '2025-04-21 22:29:26', '2025-04-23 23:51:10'),
(55, 12, 'First Grading', 'Exam', 'awdawdawd', 100.00, 'Lec', '2025-04-17', NULL, 1, '2025-04-23 23:51:16', '2025-04-21 22:29:44', '2025-04-23 23:51:16'),
(56, 12, 'Midterm', 'Quiz', 'adwawdawd', 10.00, 'Lec', '2025-04-24', NULL, 1, '2025-04-23 23:51:25', '2025-04-21 22:30:01', '2025-04-23 23:51:25'),
(57, 12, 'Midterm', 'Quiz', 'awdawd', 24.00, 'Lec', '2025-04-25', NULL, 1, '2025-04-23 23:51:26', '2025-04-21 22:30:37', '2025-04-23 23:51:26'),
(58, 12, 'Midterm', 'OtherActivity', 'asdasd', 10.00, 'Lec', '2025-04-24', NULL, 1, '2025-04-23 23:51:28', '2025-04-21 22:30:59', '2025-04-23 23:51:28'),
(59, 12, 'Midterm', 'Exam', 'dgsfa', 100.00, 'Lec', '2025-04-24', NULL, 1, '2025-04-23 23:51:30', '2025-04-21 22:31:17', '2025-04-23 23:51:30'),
(60, 12, 'Finals', 'Quiz', 'adawd', 10.00, 'Lec', '2025-05-02', NULL, 1, '2025-04-23 23:51:34', '2025-04-21 22:33:40', '2025-04-23 23:51:34'),
(61, 12, 'Finals', 'OtherActivity', 'dfasf', 56.00, 'Lec', '2025-04-25', NULL, 1, '2025-04-23 23:51:35', '2025-04-21 22:33:58', '2025-04-23 23:51:35'),
(62, 12, 'Finals', 'Exam', 'scsasd', 56.00, 'Lec', '2025-04-24', NULL, 1, '2025-04-23 23:51:37', '2025-04-21 22:34:23', '2025-04-23 23:51:37'),
(63, 12, 'Finals', 'Direct Bonus Grade', 'asdasd', NULL, 'Lec', NULL, NULL, 0, NULL, '2025-04-22 20:00:26', '2025-04-22 20:00:26'),
(64, 6, 'Finals', 'Direct Bonus Grade', 'sdfsadfsfd', NULL, 'LecLab4060', NULL, NULL, 0, NULL, '2025-04-22 23:35:39', '2025-04-22 23:35:39'),
(65, 10, 'First Grading', 'Quiz', 'adadwa', 10.00, 'Lec', '2025-04-26', NULL, 0, NULL, '2025-04-23 07:07:49', '2025-04-23 07:07:49');

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
(1, 1, 'First Grading', 'Lab Activity', 'LAB 1', '2025-04-19 18:44:46', '2025-04-19 18:44:46'),
(2, 1, 'First Grading', 'Lab Exam', 'Lab Examination FG', '2025-04-19 18:45:11', '2025-04-19 18:45:11'),
(3, 2, 'First Grading', 'Quiz', 'Quiz 1', '2025-04-19 18:45:31', '2025-04-19 18:45:31'),
(4, 2, 'First Grading', 'OtherActivity', 'Seat Work 1', '2025-04-19 18:45:51', '2025-04-19 18:45:51'),
(5, 2, 'First Grading', 'Exam', 'FG Examination', '2025-04-19 18:46:05', '2025-04-19 18:46:05'),
(6, 2, 'First Grading', 'Lab Activity', 'Laboratory Work 1', '2025-04-19 18:46:29', '2025-04-19 18:46:29'),
(7, 2, 'First Grading', 'Lab Exam', 'Lab Examination FG', '2025-04-19 18:46:38', '2025-04-19 18:46:38');

-- --------------------------------------------------------

--
-- Table structure for table `assessment_views`
--

CREATE TABLE `assessment_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `assessment_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assessment_views`
--

INSERT INTO `assessment_views` (`id`, `student_id`, `assessment_id`, `created_at`, `updated_at`) VALUES
(1, 283, 62, NULL, NULL),
(2, 283, 1, NULL, NULL);

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

--
-- Dumping data for table `enrolled_students`
--

INSERT INTO `enrolled_students` (`id`, `student_id`, `imported_classlist_id`, `created_at`, `updated_at`) VALUES
(1, 282, 1, '2025-04-19 18:10:20', '2025-04-19 18:10:20'),
(2, 283, 1, '2025-04-19 18:10:20', '2025-04-19 18:10:20'),
(3, 284, 1, '2025-04-19 18:10:20', '2025-04-19 18:10:20'),
(4, 285, 1, '2025-04-19 18:10:20', '2025-04-19 18:10:20'),
(5, 286, 1, '2025-04-19 18:10:20', '2025-04-19 18:10:20'),
(6, 287, 1, '2025-04-19 18:10:20', '2025-04-19 18:10:20'),
(7, 288, 1, '2025-04-19 18:10:20', '2025-04-19 18:10:20'),
(8, 289, 1, '2025-04-19 18:10:20', '2025-04-19 18:10:20'),
(9, 290, 1, '2025-04-19 18:10:20', '2025-04-19 18:10:20'),
(10, 291, 1, '2025-04-19 18:10:20', '2025-04-19 18:10:20'),
(11, 292, 1, '2025-04-19 18:10:20', '2025-04-19 18:10:20'),
(12, 293, 1, '2025-04-19 18:10:20', '2025-04-19 18:10:20'),
(13, 294, 1, '2025-04-19 18:10:20', '2025-04-19 18:10:20'),
(14, 296, 1, '2025-04-19 18:10:20', '2025-04-19 18:10:20'),
(15, 297, 1, '2025-04-19 18:10:20', '2025-04-19 18:10:20'),
(16, 298, 1, '2025-04-19 18:10:20', '2025-04-19 18:10:20'),
(17, 282, 2, '2025-04-19 18:10:32', '2025-04-19 18:10:32'),
(18, 283, 2, '2025-04-19 18:10:33', '2025-04-19 18:10:33'),
(19, 284, 2, '2025-04-19 18:10:33', '2025-04-19 18:10:33'),
(20, 285, 2, '2025-04-19 18:10:33', '2025-04-19 18:10:33'),
(21, 286, 2, '2025-04-19 18:10:33', '2025-04-19 18:10:33'),
(22, 287, 2, '2025-04-19 18:10:33', '2025-04-19 18:10:33'),
(23, 288, 2, '2025-04-19 18:10:33', '2025-04-19 18:10:33'),
(24, 289, 2, '2025-04-19 18:10:33', '2025-04-19 18:10:33'),
(25, 290, 2, '2025-04-19 18:10:33', '2025-04-19 18:10:33'),
(26, 291, 2, '2025-04-19 18:10:33', '2025-04-19 18:10:33'),
(27, 292, 2, '2025-04-19 18:10:33', '2025-04-19 18:10:33'),
(28, 293, 2, '2025-04-19 18:10:33', '2025-04-19 18:10:33'),
(29, 294, 2, '2025-04-19 18:10:33', '2025-04-19 18:10:33'),
(30, 296, 2, '2025-04-19 18:10:33', '2025-04-19 18:10:33'),
(31, 297, 2, '2025-04-19 18:10:33', '2025-04-19 18:10:33'),
(32, 298, 2, '2025-04-19 18:10:33', '2025-04-19 18:10:33'),
(33, 282, 3, '2025-04-19 18:10:43', '2025-04-19 18:10:43'),
(34, 283, 3, '2025-04-19 18:10:43', '2025-04-19 18:10:43'),
(35, 284, 3, '2025-04-19 18:10:43', '2025-04-19 18:10:43'),
(36, 285, 3, '2025-04-19 18:10:43', '2025-04-19 18:10:43'),
(37, 286, 3, '2025-04-19 18:10:43', '2025-04-19 18:10:43'),
(38, 287, 3, '2025-04-19 18:10:44', '2025-04-19 18:10:44'),
(39, 288, 3, '2025-04-19 18:10:44', '2025-04-19 18:10:44'),
(40, 289, 3, '2025-04-19 18:10:44', '2025-04-19 18:10:44'),
(41, 290, 3, '2025-04-19 18:10:44', '2025-04-19 18:10:44'),
(42, 291, 3, '2025-04-19 18:10:44', '2025-04-19 18:10:44'),
(43, 292, 3, '2025-04-19 18:10:44', '2025-04-19 18:10:44'),
(44, 293, 3, '2025-04-19 18:10:44', '2025-04-19 18:10:44'),
(45, 294, 3, '2025-04-19 18:10:44', '2025-04-19 18:10:44'),
(46, 296, 3, '2025-04-19 18:10:44', '2025-04-19 18:10:44'),
(47, 297, 3, '2025-04-19 18:10:44', '2025-04-19 18:10:44'),
(48, 298, 3, '2025-04-19 18:10:44', '2025-04-19 18:10:44'),
(49, 282, 4, '2025-04-19 18:10:53', '2025-04-19 18:10:53'),
(50, 283, 4, '2025-04-19 18:10:53', '2025-04-19 18:10:53'),
(51, 284, 4, '2025-04-19 18:10:53', '2025-04-19 18:10:53'),
(52, 285, 4, '2025-04-19 18:10:53', '2025-04-19 18:10:53'),
(53, 286, 4, '2025-04-19 18:10:53', '2025-04-19 18:10:53'),
(54, 287, 4, '2025-04-19 18:10:53', '2025-04-19 18:10:53'),
(55, 288, 4, '2025-04-19 18:10:53', '2025-04-19 18:10:53'),
(56, 289, 4, '2025-04-19 18:10:53', '2025-04-19 18:10:53'),
(57, 290, 4, '2025-04-19 18:10:53', '2025-04-19 18:10:53'),
(58, 291, 4, '2025-04-19 18:10:53', '2025-04-19 18:10:53'),
(59, 292, 4, '2025-04-19 18:10:53', '2025-04-19 18:10:53'),
(60, 293, 4, '2025-04-19 18:10:53', '2025-04-19 18:10:53'),
(61, 294, 4, '2025-04-19 18:10:53', '2025-04-19 18:10:53'),
(62, 296, 4, '2025-04-19 18:10:53', '2025-04-19 18:10:53'),
(63, 297, 4, '2025-04-19 18:10:53', '2025-04-19 18:10:53'),
(64, 298, 4, '2025-04-19 18:10:53', '2025-04-19 18:10:53'),
(65, 282, 5, '2025-04-19 18:15:00', '2025-04-19 18:15:00'),
(66, 283, 5, '2025-04-19 18:15:00', '2025-04-19 18:15:00'),
(67, 284, 5, '2025-04-19 18:15:00', '2025-04-19 18:15:00'),
(68, 285, 5, '2025-04-19 18:15:00', '2025-04-19 18:15:00'),
(69, 286, 5, '2025-04-19 18:15:00', '2025-04-19 18:15:00'),
(70, 287, 5, '2025-04-19 18:15:00', '2025-04-19 18:15:00'),
(71, 288, 5, '2025-04-19 18:15:00', '2025-04-19 18:15:00'),
(72, 289, 5, '2025-04-19 18:15:00', '2025-04-19 18:15:00'),
(73, 290, 5, '2025-04-19 18:15:00', '2025-04-19 18:15:00'),
(74, 291, 5, '2025-04-19 18:15:00', '2025-04-19 18:15:00'),
(75, 292, 5, '2025-04-19 18:15:01', '2025-04-19 18:15:01'),
(76, 293, 5, '2025-04-19 18:15:01', '2025-04-19 18:15:01'),
(77, 294, 5, '2025-04-19 18:15:01', '2025-04-19 18:15:01'),
(78, 296, 5, '2025-04-19 18:15:01', '2025-04-19 18:15:01'),
(79, 297, 5, '2025-04-19 18:15:01', '2025-04-19 18:15:01'),
(80, 298, 5, '2025-04-19 18:15:01', '2025-04-19 18:15:01'),
(81, 282, 6, '2025-04-19 18:15:15', '2025-04-19 18:15:15'),
(82, 283, 6, '2025-04-19 18:15:15', '2025-04-19 18:15:15'),
(83, 284, 6, '2025-04-19 18:15:15', '2025-04-19 18:15:15'),
(84, 285, 6, '2025-04-19 18:15:15', '2025-04-19 18:15:15'),
(85, 286, 6, '2025-04-19 18:15:15', '2025-04-19 18:15:15'),
(86, 287, 6, '2025-04-19 18:15:15', '2025-04-19 18:15:15'),
(87, 288, 6, '2025-04-19 18:15:15', '2025-04-19 18:15:15'),
(88, 289, 6, '2025-04-19 18:15:15', '2025-04-19 18:15:15'),
(89, 290, 6, '2025-04-19 18:15:15', '2025-04-19 18:15:15'),
(90, 291, 6, '2025-04-19 18:15:15', '2025-04-19 18:15:15'),
(91, 292, 6, '2025-04-19 18:15:15', '2025-04-19 18:15:15'),
(92, 293, 6, '2025-04-19 18:15:16', '2025-04-19 18:15:16'),
(93, 294, 6, '2025-04-19 18:15:16', '2025-04-19 18:15:16'),
(94, 296, 6, '2025-04-19 18:15:16', '2025-04-19 18:15:16'),
(95, 297, 6, '2025-04-19 18:15:16', '2025-04-19 18:15:16'),
(96, 298, 6, '2025-04-19 18:15:16', '2025-04-19 18:15:16'),
(97, 282, 7, '2025-04-19 18:15:24', '2025-04-19 18:15:24'),
(98, 283, 7, '2025-04-19 18:15:24', '2025-04-19 18:15:24'),
(99, 284, 7, '2025-04-19 18:15:24', '2025-04-19 18:15:24'),
(100, 285, 7, '2025-04-19 18:15:24', '2025-04-19 18:15:24'),
(101, 286, 7, '2025-04-19 18:15:24', '2025-04-19 18:15:24'),
(102, 287, 7, '2025-04-19 18:15:24', '2025-04-19 18:15:24'),
(103, 288, 7, '2025-04-19 18:15:24', '2025-04-19 18:15:24'),
(104, 289, 7, '2025-04-19 18:15:24', '2025-04-19 18:15:24'),
(105, 290, 7, '2025-04-19 18:15:24', '2025-04-19 18:15:24'),
(106, 291, 7, '2025-04-19 18:15:24', '2025-04-19 18:15:24'),
(107, 292, 7, '2025-04-19 18:15:24', '2025-04-19 18:15:24'),
(108, 293, 7, '2025-04-19 18:15:24', '2025-04-19 18:15:24'),
(109, 294, 7, '2025-04-19 18:15:24', '2025-04-19 18:15:24'),
(110, 296, 7, '2025-04-19 18:15:24', '2025-04-19 18:15:24'),
(111, 297, 7, '2025-04-19 18:15:24', '2025-04-19 18:15:24'),
(112, 298, 7, '2025-04-19 18:15:24', '2025-04-19 18:15:24'),
(113, 282, 8, '2025-04-19 18:15:33', '2025-04-19 18:15:33'),
(114, 283, 8, '2025-04-19 18:15:33', '2025-04-19 18:15:33'),
(115, 284, 8, '2025-04-19 18:15:33', '2025-04-19 18:15:33'),
(116, 285, 8, '2025-04-19 18:15:33', '2025-04-19 18:15:33'),
(117, 286, 8, '2025-04-19 18:15:33', '2025-04-19 18:15:33'),
(118, 287, 8, '2025-04-19 18:15:33', '2025-04-19 18:15:33'),
(119, 288, 8, '2025-04-19 18:15:33', '2025-04-19 18:15:33'),
(120, 289, 8, '2025-04-19 18:15:33', '2025-04-19 18:15:33'),
(121, 290, 8, '2025-04-19 18:15:33', '2025-04-19 18:15:33'),
(122, 291, 8, '2025-04-19 18:15:33', '2025-04-19 18:15:33'),
(123, 292, 8, '2025-04-19 18:15:33', '2025-04-19 18:15:33'),
(124, 293, 8, '2025-04-19 18:15:33', '2025-04-19 18:15:33'),
(125, 294, 8, '2025-04-19 18:15:33', '2025-04-19 18:15:33'),
(126, 296, 8, '2025-04-19 18:15:33', '2025-04-19 18:15:33'),
(127, 297, 8, '2025-04-19 18:15:33', '2025-04-19 18:15:33'),
(128, 298, 8, '2025-04-19 18:15:33', '2025-04-19 18:15:33'),
(146, 282, 10, '2025-04-19 18:27:46', '2025-04-19 18:27:46'),
(147, 283, 10, '2025-04-19 18:27:46', '2025-04-19 18:27:46'),
(148, 284, 10, '2025-04-19 18:27:46', '2025-04-19 18:27:46'),
(149, 285, 10, '2025-04-19 18:27:46', '2025-04-19 18:27:46'),
(150, 286, 10, '2025-04-19 18:27:46', '2025-04-19 18:27:46'),
(151, 287, 10, '2025-04-19 18:27:46', '2025-04-19 18:27:46'),
(152, 288, 10, '2025-04-19 18:27:46', '2025-04-19 18:27:46'),
(153, 289, 10, '2025-04-19 18:27:46', '2025-04-19 18:27:46'),
(154, 290, 10, '2025-04-19 18:27:46', '2025-04-19 18:27:46'),
(155, 291, 10, '2025-04-19 18:27:46', '2025-04-19 18:27:46'),
(156, 292, 10, '2025-04-19 18:27:46', '2025-04-19 18:27:46'),
(157, 293, 10, '2025-04-19 18:27:46', '2025-04-19 18:27:46'),
(158, 294, 10, '2025-04-19 18:27:46', '2025-04-19 18:27:46'),
(159, 295, 10, '2025-04-19 18:27:46', '2025-04-19 18:27:46'),
(160, 296, 10, '2025-04-19 18:27:46', '2025-04-19 18:27:46'),
(161, 297, 10, '2025-04-19 18:27:46', '2025-04-19 18:27:46'),
(162, 298, 10, '2025-04-19 18:27:46', '2025-04-19 18:27:46'),
(180, 282, 12, '2025-04-19 19:47:16', '2025-04-19 19:47:16'),
(181, 283, 12, '2025-04-19 19:47:16', '2025-04-19 19:47:16'),
(182, 284, 12, '2025-04-19 19:47:16', '2025-04-19 19:47:16'),
(183, 285, 12, '2025-04-19 19:47:16', '2025-04-19 19:47:16'),
(184, 286, 12, '2025-04-19 19:47:16', '2025-04-19 19:47:16'),
(185, 287, 12, '2025-04-19 19:47:16', '2025-04-19 19:47:16'),
(186, 288, 12, '2025-04-19 19:47:16', '2025-04-19 19:47:16'),
(187, 289, 12, '2025-04-19 19:47:16', '2025-04-19 19:47:16'),
(188, 290, 12, '2025-04-19 19:47:16', '2025-04-19 19:47:16'),
(189, 291, 12, '2025-04-19 19:47:16', '2025-04-19 19:47:16'),
(190, 292, 12, '2025-04-19 19:47:16', '2025-04-19 19:47:16'),
(191, 293, 12, '2025-04-19 19:47:16', '2025-04-19 19:47:16'),
(192, 294, 12, '2025-04-19 19:47:16', '2025-04-19 19:47:16'),
(193, 295, 12, '2025-04-19 19:47:16', '2025-04-19 19:47:16'),
(194, 296, 12, '2025-04-19 19:47:16', '2025-04-19 19:47:16'),
(195, 297, 12, '2025-04-19 19:47:16', '2025-04-19 19:47:16'),
(196, 298, 12, '2025-04-19 19:47:16', '2025-04-19 19:47:16');

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
-- Table structure for table `final_statuses`
--

CREATE TABLE `final_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `final_statuses`
--

INSERT INTO `final_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'NFE', '2025-04-23 02:02:55', '2025-04-23 02:02:55'),
(2, 'DRP', '2025-04-23 02:03:06', '2025-04-23 02:03:06'),
(3, 'INC', '2025-04-23 02:03:23', '2025-04-23 02:20:49'),
(4, 'WITHDRAW', '2025-04-23 03:49:09', '2025-04-23 03:49:09'),
(5, 'OD', '2025-04-23 06:36:12', '2025-04-23 06:36:12');

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
  `adjusted_finals_grade` int(11) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `published_midterms` tinyint(1) DEFAULT 0,
  `published_finals` tinyint(1) DEFAULT 0,
  `status` varchar(255) DEFAULT NULL,
  `midterms_status` varchar(255) DEFAULT NULL,
  `finals_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `enrolled_student_id`, `assessment_id`, `points`, `total_fg_lec`, `lec_fg_grade`, `total_fg_lab`, `lab_fg_grade`, `total_fg_grade`, `tentative_fg_grade`, `fg_grade`, `total_midterms_lec`, `lec_midterms_grade`, `total_midterms_lab`, `lab_midterms_grade`, `total_midterms_grade`, `tentative_midterms_grade`, `midterms_grade`, `total_finals_lec`, `lec_finals_grade`, `total_finals_lab`, `lab_finals_grade`, `total_finals_grade`, `tentative_finals_grade`, `finals_grade`, `adjusted_finals_grade`, `published`, `published_midterms`, `published_finals`, `status`, `midterms_status`, `finals_status`, `created_at`, `updated_at`) VALUES
(1, 65, 1, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:31', '2025-04-22 20:26:04'),
(2, 65, NULL, NULL, NULL, NULL, NULL, NULL, 2.00, NULL, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 75, 0, 0, 0, NULL, NULL, 'NFE', '2025-04-19 19:16:31', '2025-04-24 05:55:00'),
(3, 67, 1, '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:31', '2025-04-22 20:28:57'),
(4, 68, 1, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:32', '2025-04-21 22:06:59'),
(5, 69, 1, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:32', '2025-04-21 22:07:03'),
(6, 66, 1, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:32', '2025-04-21 22:06:43'),
(7, 67, NULL, NULL, NULL, NULL, NULL, NULL, 4.00, NULL, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 84, 0, 0, 0, NULL, NULL, 'NFE', '2025-04-19 19:16:32', '2025-04-24 05:55:02'),
(8, 68, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 0, 0, 0, NULL, NULL, 'DRP', '2025-04-19 19:16:32', '2025-04-24 05:55:03'),
(9, 69, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 0, 0, 0, NULL, NULL, 'DRP', '2025-04-19 19:16:32', '2025-04-24 05:55:04'),
(10, 66, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 0, 0, 0, '2', NULL, 'DRP', '2025-04-19 19:16:32', '2025-04-24 05:55:01'),
(11, 71, 1, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:32', '2025-04-21 22:07:14'),
(12, 72, 1, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:32', '2025-04-21 22:07:25'),
(13, 73, 1, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:32', '2025-04-21 22:07:32'),
(14, 71, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 0, 0, 0, NULL, NULL, 'DRP', '2025-04-19 19:16:32', '2025-04-24 05:55:06'),
(15, 72, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 0, 0, 0, NULL, NULL, 'DRP', '2025-04-19 19:16:32', '2025-04-24 05:55:06'),
(16, 74, 1, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:33', '2025-04-21 22:06:18'),
(17, 75, 1, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:33', '2025-04-21 22:11:28'),
(18, 73, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 0, 0, 0, NULL, NULL, 'DRP', '2025-04-19 19:16:33', '2025-04-24 05:55:07'),
(19, 74, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 0, 0, 0, NULL, NULL, 'DRP', '2025-04-19 19:16:33', '2025-04-24 05:55:08'),
(20, 75, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 0, 0, 0, NULL, NULL, 'DEFAULT', '2025-04-19 19:16:33', '2025-04-24 05:55:09'),
(21, 77, 1, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:33', '2025-04-21 22:02:23'),
(22, 77, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 0, 0, 0, NULL, NULL, 'DRP', '2025-04-19 19:16:33', '2025-04-24 05:55:11'),
(23, 78, 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:33', '2025-04-19 19:16:33'),
(24, 76, 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:33', '2025-04-19 19:16:33'),
(25, 79, 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:33', '2025-04-19 19:16:33'),
(26, 78, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 0, 0, 0, NULL, NULL, 'OD', '2025-04-19 19:16:33', '2025-04-24 05:55:12'),
(27, 79, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 0, 0, 0, NULL, NULL, 'NFE', '2025-04-19 19:16:33', '2025-04-24 05:55:13'),
(28, 76, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 0, 0, 0, NULL, NULL, 'DEFAULT', '2025-04-19 19:16:33', '2025-04-24 05:55:10'),
(29, 65, 2, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:48', '2025-04-21 22:06:34'),
(30, 66, 2, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:48', '2025-04-21 22:06:44'),
(31, 67, 2, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:49', '2025-04-21 22:06:54'),
(32, 68, 2, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:49', '2025-04-21 22:07:00'),
(33, 70, 1, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:49', '2025-04-21 22:07:10'),
(34, 69, 2, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:49', '2025-04-21 22:07:04'),
(35, 70, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 0, 0, 0, NULL, NULL, 'DRP', '2025-04-19 19:16:49', '2025-04-24 05:55:05'),
(36, 70, 2, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:50', '2025-04-21 22:07:11'),
(37, 71, 2, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:50', '2025-04-21 22:07:15'),
(38, 72, 2, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:50', '2025-04-21 22:07:26'),
(39, 73, 2, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:51', '2025-04-21 22:07:33'),
(40, 74, 2, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:51', '2025-04-21 22:06:22'),
(41, 75, 2, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:52', '2025-04-21 22:11:34'),
(42, 76, 2, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:52', '2025-04-19 19:16:52'),
(43, 77, 2, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:53', '2025-04-21 22:02:28'),
(44, 79, 2, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:53', '2025-04-19 19:16:53'),
(45, 78, 2, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:53', '2025-04-19 19:16:53'),
(46, 80, 1, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:53', '2025-04-19 19:16:53'),
(47, 80, 2, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:53', '2025-04-19 19:16:53'),
(48, 80, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 0, 0, 0, NULL, NULL, 'INC', '2025-04-19 19:16:53', '2025-04-24 05:55:13'),
(49, 80, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:16:53', '2025-04-19 19:16:53'),
(50, 65, 3, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:20', '2025-04-21 22:06:34'),
(51, 66, 3, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:21', '2025-04-21 22:06:45'),
(52, 67, 3, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:21', '2025-04-21 22:06:54'),
(53, 68, 3, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:21', '2025-04-22 18:27:13'),
(54, 69, 3, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:22', '2025-04-21 22:07:04'),
(55, 70, 3, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:22', '2025-04-21 22:07:11'),
(56, 71, 3, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:23', '2025-04-21 22:07:19'),
(57, 72, 3, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:23', '2025-04-21 22:07:27'),
(58, 73, 3, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:23', '2025-04-21 22:07:34'),
(59, 74, 3, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:24', '2025-04-21 22:06:23'),
(60, 75, 3, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:24', '2025-04-21 22:11:37'),
(61, 76, 3, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:24', '2025-04-19 19:17:24'),
(62, 78, 3, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:25', '2025-04-19 19:17:25'),
(63, 79, 3, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:25', '2025-04-19 19:17:25'),
(64, 80, 3, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:26', '2025-04-19 19:17:26'),
(65, 65, 4, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:49', '2025-04-22 20:26:29'),
(66, 66, 4, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:49', '2025-04-21 22:06:43'),
(67, 67, 4, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:49', '2025-04-21 22:06:53'),
(68, 68, 4, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:50', '2025-04-21 22:06:59'),
(69, 69, 4, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:50', '2025-04-21 22:07:04'),
(70, 70, 4, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:51', '2025-04-21 22:07:11'),
(71, 72, 4, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:52', '2025-04-21 22:07:25'),
(72, 73, 4, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:52', '2025-04-21 22:07:33'),
(73, 74, 4, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:53', '2025-04-21 22:06:21'),
(74, 75, 4, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:53', '2025-04-21 22:11:30'),
(75, 76, 4, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:53', '2025-04-19 19:17:53'),
(76, 77, 4, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:54', '2025-04-21 22:02:25'),
(77, 78, 4, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:55', '2025-04-19 19:17:55'),
(78, 77, 3, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:55', '2025-04-21 22:02:31'),
(79, 79, 4, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:55', '2025-04-19 19:17:55'),
(80, 80, 4, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:17:58', '2025-04-19 19:17:58'),
(81, 65, 5, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:13', '2025-04-22 18:27:07'),
(82, 66, 5, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:14', '2025-04-21 22:06:44'),
(83, 67, 5, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:15', '2025-04-21 22:06:54'),
(84, 68, 5, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:16', '2025-04-21 22:07:00'),
(85, 69, 5, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:17', '2025-04-21 22:07:04'),
(86, 70, 5, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:19', '2025-04-21 22:07:11'),
(87, 71, 4, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:21', '2025-04-21 22:07:15'),
(88, 71, 5, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:22', '2025-04-21 22:07:15'),
(89, 72, 5, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:24', '2025-04-21 22:07:26'),
(90, 73, 5, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:26', '2025-04-21 22:07:33'),
(91, 74, 5, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:27', '2025-04-21 22:06:22'),
(92, 75, 5, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:27', '2025-04-21 22:11:35'),
(93, 76, 5, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:28', '2025-04-19 19:18:28'),
(94, 77, 5, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:29', '2025-04-21 22:02:30'),
(95, 78, 5, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:29', '2025-04-19 19:18:29'),
(96, 79, 5, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:30', '2025-04-19 19:18:30'),
(97, 80, 5, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:30', '2025-04-19 19:18:30'),
(98, 65, 6, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:48', '2025-04-21 22:06:35'),
(99, 66, 6, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:48', '2025-04-21 22:06:47'),
(100, 67, 6, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:49', '2025-04-21 22:06:56'),
(101, 68, 6, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:49', '2025-04-21 22:07:01'),
(102, 69, 6, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:50', '2025-04-21 22:07:06'),
(103, 70, 6, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:51', '2025-04-22 18:27:14'),
(104, 71, 6, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:52', '2025-04-21 22:07:21'),
(105, 72, 6, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:52', '2025-04-21 22:07:28'),
(106, 73, 6, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:53', '2025-04-21 22:07:37'),
(107, 74, 6, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:53', '2025-04-21 22:06:27'),
(108, 75, 6, 'E', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:54', '2025-04-21 22:11:42'),
(109, 76, 6, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:55', '2025-04-19 19:18:55'),
(110, 77, 6, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:56', '2025-04-21 22:02:33'),
(111, 78, 6, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:56', '2025-04-19 19:18:56'),
(112, 79, 6, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:57', '2025-04-19 19:18:57'),
(113, 80, 6, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:18:57', '2025-04-19 19:18:57'),
(114, 81, 7, '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:24:58', '2025-04-22 20:36:10'),
(115, 81, NULL, NULL, 13.33, 66, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 65.00, 72, NULL, 69, 68, 80, 0, 0, 0, 'DEFAULT', NULL, 'DEFAULT', '2025-04-19 19:24:58', '2025-04-24 05:42:05'),
(116, 83, 7, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:24:58', '2025-04-19 19:24:58'),
(117, 82, 7, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:24:58', '2025-04-23 05:34:45'),
(118, 84, 7, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:24:58', '2025-04-19 19:24:58'),
(119, 85, 7, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:24:58', '2025-04-19 19:24:58'),
(120, 83, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 91.00, 77, NULL, 72, 70, 80, 0, 0, 0, NULL, NULL, 'DEFAULT', '2025-04-19 19:24:58', '2025-04-24 05:42:11'),
(121, 85, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, 'NFE', NULL, 'DEFAULT', '2025-04-19 19:24:58', '2025-04-24 05:42:16'),
(122, 82, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, 'DRP', '2025-04-19 19:24:58', '2025-04-24 05:42:08'),
(123, 84, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 80, 0, 0, 0, NULL, NULL, 'DEFAULT', '2025-04-19 19:24:58', '2025-04-24 05:42:14'),
(124, 86, 7, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:24:58', '2025-04-19 19:24:58'),
(125, 88, 7, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:24:58', '2025-04-19 19:24:58'),
(126, 86, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, 'DEFAULT', '2025-04-19 19:24:58', '2025-04-24 05:42:19'),
(127, 90, 7, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:24:58', '2025-04-19 19:24:58'),
(128, 87, 7, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:24:58', '2025-04-19 19:24:58'),
(129, 88, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, 'DEFAULT', '2025-04-19 19:24:59', '2025-04-24 05:42:23'),
(130, 89, 7, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:24:59', '2025-04-19 19:24:59'),
(131, 87, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, 'DEFAULT', '2025-04-19 19:24:59', '2025-04-24 05:42:21'),
(132, 91, 7, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:24:59', '2025-04-19 19:24:59'),
(133, 90, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, 'DEFAULT', '2025-04-19 19:24:59', '2025-04-24 05:42:28'),
(134, 91, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, 'DEFAULT', '2025-04-19 19:24:59', '2025-04-24 05:42:30'),
(135, 89, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, 'DEFAULT', '2025-04-19 19:24:59', '2025-04-24 05:42:26'),
(136, 95, 7, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:24:59', '2025-04-19 19:24:59'),
(137, 93, 7, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:24:59', '2025-04-19 19:24:59'),
(138, 94, 7, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:24:59', '2025-04-19 19:24:59'),
(139, 95, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:24:59', '2025-04-24 05:42:38'),
(140, 94, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, 'DEFAULT', '2025-04-19 19:24:59', '2025-04-24 05:42:36'),
(141, 93, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, 'DEFAULT', '2025-04-19 19:24:59', '2025-04-24 05:42:34'),
(142, 96, 7, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:24:59', '2025-04-19 19:24:59'),
(143, 96, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 80, 0, 0, 0, 'INC', NULL, NULL, '2025-04-19 19:24:59', '2025-04-24 05:42:40'),
(144, 81, 8, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:22', '2025-04-19 19:25:22'),
(145, 82, 8, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:22', '2025-04-23 05:34:48'),
(146, 83, 8, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:23', '2025-04-19 19:25:23'),
(147, 84, 8, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:23', '2025-04-19 19:25:23'),
(148, 85, 8, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:23', '2025-04-19 19:25:23'),
(149, 86, 8, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:24', '2025-04-19 19:25:24'),
(150, 87, 8, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:24', '2025-04-19 19:25:24'),
(151, 89, 8, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:24', '2025-04-19 19:25:24'),
(152, 88, 8, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:24', '2025-04-19 19:25:24'),
(153, 90, 8, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:24', '2025-04-19 19:25:24'),
(154, 92, 7, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:25', '2025-04-19 19:25:25'),
(155, 92, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, 'DEFAULT', '2025-04-19 19:25:25', '2025-04-24 05:42:32'),
(156, 92, 8, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:25', '2025-04-19 19:25:25'),
(157, 91, 8, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:25', '2025-04-19 19:25:25'),
(158, 93, 8, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:25', '2025-04-19 19:25:25'),
(159, 94, 8, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:25', '2025-04-19 19:25:25'),
(160, 95, 8, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:25', '2025-04-19 19:25:25'),
(161, 96, 8, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:26', '2025-04-19 19:25:26'),
(162, 81, 9, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:39', '2025-04-19 19:25:39'),
(163, 82, 9, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:39', '2025-04-23 05:34:48'),
(164, 83, 9, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:40', '2025-04-19 19:25:40'),
(165, 84, 9, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:42', '2025-04-19 19:25:42'),
(166, 85, 9, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:42', '2025-04-19 19:25:42'),
(167, 86, 9, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:43', '2025-04-19 19:25:43'),
(168, 87, 9, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:44', '2025-04-19 19:25:44'),
(169, 88, 9, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:45', '2025-04-19 19:25:45'),
(170, 89, 9, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:45', '2025-04-19 19:25:45'),
(171, 91, 9, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:46', '2025-04-19 19:25:46'),
(172, 90, 9, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:46', '2025-04-19 19:25:46'),
(173, 92, 9, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:46', '2025-04-19 19:25:46'),
(174, 93, 9, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:47', '2025-04-19 19:25:47'),
(175, 94, 9, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:47', '2025-04-19 19:25:47'),
(176, 95, 9, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:48', '2025-04-19 19:25:48'),
(177, 96, 9, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:25:48', '2025-04-19 19:25:48'),
(178, 81, 10, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:08', '2025-04-19 19:26:08'),
(179, 82, 10, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:08', '2025-04-23 05:34:50'),
(180, 83, 10, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:09', '2025-04-19 19:26:09'),
(181, 84, 10, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:09', '2025-04-19 19:26:09'),
(182, 85, 10, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:09', '2025-04-19 19:26:09'),
(183, 86, 10, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:10', '2025-04-19 19:26:10'),
(184, 87, 10, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:11', '2025-04-19 19:26:11'),
(185, 88, 10, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:11', '2025-04-19 19:26:11'),
(186, 89, 10, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:11', '2025-04-19 19:26:11'),
(187, 90, 10, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:11', '2025-04-19 19:26:11'),
(188, 91, 10, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:12', '2025-04-19 19:26:12'),
(189, 92, 10, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:12', '2025-04-19 19:26:12'),
(190, 93, 10, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:13', '2025-04-19 19:26:13'),
(191, 94, 10, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:13', '2025-04-19 19:26:13'),
(192, 95, 10, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:13', '2025-04-19 19:26:13'),
(193, 96, 10, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:14', '2025-04-19 19:26:14'),
(194, 81, 11, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:51', '2025-04-19 19:26:51'),
(195, 82, 11, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:52', '2025-04-23 05:34:51'),
(196, 83, 11, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:53', '2025-04-19 19:26:53'),
(197, 84, 11, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:53', '2025-04-19 19:26:53'),
(198, 85, 11, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:54', '2025-04-19 19:26:54'),
(199, 86, 11, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:54', '2025-04-19 19:26:54'),
(200, 87, 11, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:55', '2025-04-19 19:26:55'),
(201, 88, 11, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:55', '2025-04-19 19:26:55'),
(202, 89, 11, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:56', '2025-04-19 19:26:56'),
(203, 90, 11, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:57', '2025-04-19 19:26:57'),
(204, 91, 11, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:57', '2025-04-19 19:26:57'),
(205, 92, 11, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:58', '2025-04-19 19:26:58'),
(206, 93, 11, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:26:59', '2025-04-19 19:26:59'),
(207, 94, 11, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:00', '2025-04-19 19:27:00'),
(208, 95, 11, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:01', '2025-04-19 19:27:01'),
(209, 96, 11, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:03', '2025-04-19 19:27:03'),
(210, 81, 12, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:18', '2025-04-19 19:27:18'),
(211, 83, 12, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:19', '2025-04-19 19:27:19'),
(212, 84, 12, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:20', '2025-04-19 19:27:20'),
(213, 85, 12, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:21', '2025-04-19 19:27:21'),
(214, 86, 12, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:21', '2025-04-19 19:27:21'),
(215, 87, 12, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:23', '2025-04-19 19:27:23'),
(216, 88, 12, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:23', '2025-04-19 19:27:23'),
(217, 89, 12, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:24', '2025-04-19 19:27:24'),
(218, 90, 12, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:25', '2025-04-19 19:27:25'),
(219, 91, 12, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:28', '2025-04-19 19:27:28'),
(220, 92, 12, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:31', '2025-04-19 19:27:31'),
(221, 93, 12, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:33', '2025-04-19 19:27:33'),
(222, 94, 12, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:37', '2025-04-19 19:27:37'),
(223, 95, 12, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:38', '2025-04-19 19:27:38'),
(224, 96, 12, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:42', '2025-04-19 19:27:42');
INSERT INTO `grades` (`id`, `enrolled_student_id`, `assessment_id`, `points`, `total_fg_lec`, `lec_fg_grade`, `total_fg_lab`, `lab_fg_grade`, `total_fg_grade`, `tentative_fg_grade`, `fg_grade`, `total_midterms_lec`, `lec_midterms_grade`, `total_midterms_lab`, `lab_midterms_grade`, `total_midterms_grade`, `tentative_midterms_grade`, `midterms_grade`, `total_finals_lec`, `lec_finals_grade`, `total_finals_lab`, `lab_finals_grade`, `total_finals_grade`, `tentative_finals_grade`, `finals_grade`, `adjusted_finals_grade`, `published`, `published_midterms`, `published_finals`, `status`, `midterms_status`, `finals_status`, `created_at`, `updated_at`) VALUES
(225, 82, 13, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:50', '2025-04-23 05:34:55'),
(226, 83, 13, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:51', '2025-04-19 19:27:51'),
(227, 84, 13, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:52', '2025-04-19 19:27:52'),
(228, 85, 13, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:54', '2025-04-19 19:27:54'),
(229, 86, 13, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:54', '2025-04-19 19:27:54'),
(230, 87, 13, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:55', '2025-04-19 19:27:55'),
(231, 88, 13, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:56', '2025-04-19 19:27:56'),
(232, 89, 13, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:57', '2025-04-19 19:27:57'),
(233, 90, 13, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:58', '2025-04-19 19:27:58'),
(234, 91, 13, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:58', '2025-04-19 19:27:58'),
(235, 92, 13, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:27:59', '2025-04-19 19:27:59'),
(236, 93, 13, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:28:00', '2025-04-19 19:28:00'),
(237, 94, 13, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:28:00', '2025-04-19 19:28:00'),
(238, 95, 13, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:28:01', '2025-04-19 19:28:01'),
(239, 96, 13, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:28:02', '2025-04-19 19:28:02'),
(240, 81, 14, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:30:43', '2025-04-19 19:30:43'),
(241, 81, 13, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:30:43', '2025-04-19 19:30:43'),
(242, 82, 12, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:30:44', '2025-04-23 05:34:53'),
(243, 82, 14, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:30:45', '2025-04-23 05:34:55'),
(244, 83, 14, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:30:45', '2025-04-19 19:30:45'),
(245, 84, 14, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:30:46', '2025-04-19 19:30:46'),
(246, 85, 14, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:30:48', '2025-04-19 19:30:48'),
(247, 86, 14, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:30:49', '2025-04-19 19:30:49'),
(248, 87, 14, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:30:49', '2025-04-19 19:30:49'),
(249, 88, 14, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:30:54', '2025-04-19 19:30:54'),
(250, 89, 14, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:30:57', '2025-04-19 19:30:57'),
(251, 90, 14, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:00', '2025-04-19 19:31:00'),
(252, 91, 14, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:04', '2025-04-19 19:31:04'),
(253, 92, 14, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:07', '2025-04-19 19:31:07'),
(254, 93, 14, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:09', '2025-04-19 19:31:09'),
(255, 94, 14, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:10', '2025-04-19 19:31:10'),
(256, 95, 14, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:11', '2025-04-19 19:31:11'),
(257, 81, 15, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:19', '2025-04-19 19:31:19'),
(258, 82, 15, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:20', '2025-04-23 05:34:57'),
(259, 83, 15, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:21', '2025-04-19 19:31:21'),
(260, 84, 15, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:23', '2025-04-19 19:31:23'),
(261, 85, 15, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:24', '2025-04-19 19:31:24'),
(262, 86, 15, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:28', '2025-04-19 19:31:28'),
(263, 87, 15, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:31', '2025-04-19 19:31:31'),
(264, 88, 15, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:32', '2025-04-19 19:31:32'),
(265, 89, 15, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:34', '2025-04-19 19:31:34'),
(266, 90, 15, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:35', '2025-04-19 19:31:35'),
(267, 91, 15, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:36', '2025-04-19 19:31:36'),
(268, 92, 15, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:37', '2025-04-19 19:31:37'),
(269, 93, 15, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:38', '2025-04-19 19:31:38'),
(270, 95, 15, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:41', '2025-04-19 19:31:41'),
(271, 96, 14, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:42', '2025-04-19 19:31:42'),
(272, 96, 15, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:42', '2025-04-19 19:31:42'),
(273, 81, 16, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:50', '2025-04-19 19:31:50'),
(274, 82, 16, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:51', '2025-04-23 05:34:58'),
(275, 83, 16, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:53', '2025-04-19 19:31:53'),
(276, 84, 16, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:55', '2025-04-19 19:31:55'),
(277, 85, 16, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:56', '2025-04-19 19:31:56'),
(278, 86, 16, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:57', '2025-04-19 19:31:57'),
(279, 87, 16, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:31:58', '2025-04-19 19:31:58'),
(280, 88, 16, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:32:00', '2025-04-19 19:32:00'),
(281, 89, 16, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:32:01', '2025-04-19 19:32:01'),
(282, 90, 16, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:32:03', '2025-04-19 19:32:03'),
(283, 91, 16, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:32:04', '2025-04-19 19:32:04'),
(284, 92, 16, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:32:06', '2025-04-19 19:32:06'),
(285, 93, 16, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:32:08', '2025-04-19 19:32:08'),
(286, 94, 15, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:32:09', '2025-04-19 19:32:09'),
(287, 94, 16, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:32:09', '2025-04-19 19:32:09'),
(288, 95, 16, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:32:10', '2025-04-19 19:32:10'),
(289, 96, 16, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:32:12', '2025-04-19 19:32:12'),
(290, 81, 17, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:36:35', '2025-04-19 19:36:35'),
(291, 82, 17, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:36:37', '2025-04-23 05:35:52'),
(292, 83, 17, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:36:39', '2025-04-19 19:36:39'),
(293, 84, 17, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:36:40', '2025-04-19 19:36:40'),
(294, 85, 17, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:36:42', '2025-04-19 19:36:42'),
(295, 86, 17, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:36:43', '2025-04-19 19:36:43'),
(296, 88, 17, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:36:46', '2025-04-19 19:36:46'),
(297, 89, 17, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:36:48', '2025-04-19 19:36:48'),
(298, 90, 17, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:36:49', '2025-04-19 19:36:49'),
(299, 91, 17, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:36:50', '2025-04-19 19:36:50'),
(300, 92, 17, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:36:52', '2025-04-19 19:36:52'),
(301, 93, 17, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:36:53', '2025-04-19 19:36:53'),
(302, 94, 17, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:36:54', '2025-04-19 19:36:54'),
(303, 95, 17, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:36:56', '2025-04-19 19:36:56'),
(304, 96, 17, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:36:57', '2025-04-19 19:36:57'),
(305, 81, 18, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:38:38', '2025-04-19 19:38:38'),
(306, 82, 18, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:38:39', '2025-04-23 05:35:00'),
(307, 83, 18, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:38:42', '2025-04-19 19:38:42'),
(308, 84, 18, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:38:44', '2025-04-19 19:38:44'),
(309, 85, 18, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:38:53', '2025-04-19 19:38:53'),
(310, 86, 18, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:38:55', '2025-04-19 19:38:55'),
(311, 87, 18, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:38:57', '2025-04-19 19:38:57'),
(312, 87, 17, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:38:57', '2025-04-19 19:38:57'),
(313, 88, 18, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:38:59', '2025-04-19 19:38:59'),
(314, 89, 18, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:01', '2025-04-19 19:39:01'),
(315, 90, 18, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:02', '2025-04-19 19:39:02'),
(316, 91, 18, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:04', '2025-04-19 19:39:04'),
(317, 92, 18, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:06', '2025-04-19 19:39:06'),
(318, 81, 19, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:17', '2025-04-19 19:39:17'),
(319, 82, 19, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:19', '2025-04-23 05:35:01'),
(320, 83, 19, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:21', '2025-04-19 19:39:21'),
(321, 84, 19, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:23', '2025-04-19 19:39:23'),
(322, 85, 19, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:24', '2025-04-19 19:39:24'),
(323, 86, 19, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:26', '2025-04-19 19:39:26'),
(324, 87, 19, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:28', '2025-04-19 19:39:28'),
(325, 88, 19, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:30', '2025-04-19 19:39:30'),
(326, 89, 19, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:31', '2025-04-19 19:39:31'),
(327, 90, 19, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:33', '2025-04-19 19:39:33'),
(328, 91, 19, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:35', '2025-04-19 19:39:35'),
(329, 92, 19, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:38', '2025-04-19 19:39:38'),
(330, 93, 18, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:43', '2025-04-19 19:39:43'),
(331, 93, 19, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:43', '2025-04-19 19:39:43'),
(332, 94, 18, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:52', '2025-04-19 19:39:52'),
(333, 94, 19, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:52', '2025-04-19 19:39:52'),
(334, 96, 19, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:39:58', '2025-04-19 19:39:58'),
(335, 81, 20, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:40:09', '2025-04-19 19:40:09'),
(336, 82, 20, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:40:11', '2025-04-23 05:35:02'),
(337, 83, 20, '25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:40:14', '2025-04-23 01:06:39'),
(338, 84, 20, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:40:21', '2025-04-19 19:40:21'),
(339, 85, 20, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:40:29', '2025-04-19 19:40:29'),
(340, 86, 20, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:40:32', '2025-04-19 19:40:32'),
(341, 87, 20, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:40:34', '2025-04-19 19:40:34'),
(342, 82, 21, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:40:43', '2025-04-23 05:35:09'),
(343, 83, 21, '66', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:40:45', '2025-04-23 00:56:23'),
(344, 84, 21, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:40:47', '2025-04-19 19:40:47'),
(345, 85, 21, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:40:50', '2025-04-19 19:40:50'),
(346, 86, 21, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:40:52', '2025-04-19 19:40:52'),
(347, 87, 21, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:40:54', '2025-04-19 19:40:54'),
(348, 88, 20, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:40:56', '2025-04-19 19:40:56'),
(349, 88, 21, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:40:56', '2025-04-19 19:40:56'),
(350, 89, 20, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:40:58', '2025-04-19 19:40:58'),
(351, 89, 21, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:40:58', '2025-04-19 19:40:58'),
(352, 90, 20, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:41:01', '2025-04-19 19:41:01'),
(353, 90, 21, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:41:01', '2025-04-19 19:41:01'),
(354, 91, 21, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:41:04', '2025-04-19 19:41:04'),
(355, 91, 20, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:41:04', '2025-04-19 19:41:04'),
(356, 92, 21, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:41:07', '2025-04-19 19:41:07'),
(357, 92, 20, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:41:07', '2025-04-19 19:41:07'),
(358, 93, 21, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:41:10', '2025-04-19 19:41:10'),
(359, 93, 20, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:41:10', '2025-04-19 19:41:10'),
(360, 94, 20, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:41:12', '2025-04-19 19:41:12'),
(361, 81, 21, '65', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:41:23', '2025-04-22 23:43:16'),
(362, 95, 18, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:42:04', '2025-04-19 19:42:04'),
(363, 95, 19, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:42:04', '2025-04-19 19:42:04'),
(364, 95, 20, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:42:05', '2025-04-19 19:42:05'),
(365, 95, 21, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:42:05', '2025-04-19 19:42:05'),
(366, 96, 18, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:42:07', '2025-04-19 19:42:07'),
(367, 96, 20, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:42:08', '2025-04-19 19:42:08'),
(368, 96, 21, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:42:08', '2025-04-19 19:42:08'),
(369, 97, 22, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:52', '2025-04-22 20:30:01'),
(370, 99, 22, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:52', '2025-04-19 19:53:52'),
(371, 97, NULL, NULL, 2.67, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:52', '2025-04-24 05:15:58'),
(372, 98, 22, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:53', '2025-04-19 19:53:53'),
(373, 102, 22, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:53', '2025-04-19 19:53:53'),
(374, 100, 22, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:53', '2025-04-19 19:53:53'),
(375, 101, 22, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:53', '2025-04-19 19:53:53'),
(376, 99, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:53', '2025-04-24 03:18:56'),
(377, 101, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:53', '2025-04-24 05:15:58'),
(378, 98, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:53', '2025-04-24 05:15:58'),
(379, 102, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:53', '2025-04-24 03:18:51'),
(380, 100, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:53', '2025-04-24 05:15:58'),
(381, 103, 22, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:53', '2025-04-19 19:53:53'),
(382, 103, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:53', '2025-04-24 03:18:56'),
(383, 106, 22, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:53', '2025-04-19 19:53:53'),
(384, 107, 22, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:53', '2025-04-19 19:53:53'),
(385, 105, 22, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:53', '2025-04-19 19:53:53'),
(386, 106, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:53', '2025-04-24 03:18:43'),
(387, 104, 22, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:53', '2025-04-19 19:53:53'),
(388, 108, 22, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:53', '2025-04-19 19:53:53'),
(389, 105, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:54', '2025-04-24 03:10:58'),
(390, 109, 22, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:54', '2025-04-19 19:53:54'),
(391, 104, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:54', '2025-04-24 03:18:43'),
(392, 107, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:54', '2025-04-24 03:18:43'),
(393, 110, 22, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:54', '2025-04-19 19:53:54'),
(394, 108, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:54', '2025-04-24 03:18:44'),
(395, 109, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:54', '2025-04-24 03:18:44'),
(396, 110, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:54', '2025-04-24 03:11:08'),
(397, 111, 22, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:55', '2025-04-19 19:53:55'),
(398, 112, 22, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:55', '2025-04-19 19:53:55'),
(399, 111, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:55', '2025-04-24 03:11:10'),
(400, 112, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:53:55', '2025-04-24 03:11:12'),
(401, 97, 23, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:54:15', '2025-04-19 19:54:15'),
(402, 99, 23, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:54:15', '2025-04-19 19:54:15'),
(403, 98, 23, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:54:15', '2025-04-19 19:54:15'),
(404, 100, 23, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:54:16', '2025-04-19 19:54:16'),
(405, 101, 23, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:54:16', '2025-04-19 19:54:16'),
(406, 102, 23, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:54:16', '2025-04-19 19:54:16'),
(407, 105, 23, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:54:17', '2025-04-19 19:54:17'),
(408, 104, 23, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:54:17', '2025-04-19 19:54:17'),
(409, 106, 23, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:54:17', '2025-04-19 19:54:17'),
(410, 108, 23, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:54:17', '2025-04-19 19:54:17'),
(411, 107, 23, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:54:17', '2025-04-19 19:54:17'),
(412, 109, 23, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:54:17', '2025-04-19 19:54:17'),
(413, 111, 23, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:54:18', '2025-04-19 19:54:18'),
(414, 110, 23, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:54:18', '2025-04-19 19:54:18'),
(415, 112, 23, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:54:18', '2025-04-19 19:54:18'),
(416, 103, 23, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:55:15', '2025-04-19 19:55:15'),
(417, 98, 24, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:03', '2025-04-19 19:57:03'),
(418, 97, 24, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:03', '2025-04-19 19:57:03'),
(419, 99, 24, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:04', '2025-04-19 19:57:04'),
(420, 100, 24, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:04', '2025-04-19 19:57:04'),
(421, 101, 24, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:04', '2025-04-19 19:57:04'),
(422, 102, 24, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:05', '2025-04-19 19:57:05'),
(423, 103, 24, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:05', '2025-04-19 19:57:05'),
(424, 104, 24, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:06', '2025-04-19 19:57:06'),
(425, 105, 24, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:06', '2025-04-19 19:57:06'),
(426, 106, 24, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:06', '2025-04-19 19:57:06'),
(427, 107, 24, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:07', '2025-04-19 19:57:07'),
(428, 108, 24, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:07', '2025-04-19 19:57:07'),
(429, 109, 24, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:08', '2025-04-19 19:57:08'),
(430, 110, 24, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:08', '2025-04-19 19:57:08'),
(431, 111, 24, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:09', '2025-04-19 19:57:09'),
(432, 112, 24, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:09', '2025-04-19 19:57:09'),
(433, 97, 25, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:36', '2025-04-19 19:57:36'),
(434, 98, 25, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:36', '2025-04-19 19:57:36'),
(435, 99, 25, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:37', '2025-04-19 19:57:37'),
(436, 100, 25, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:38', '2025-04-19 19:57:38'),
(437, 101, 25, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:38', '2025-04-19 19:57:38'),
(438, 102, 25, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:39', '2025-04-19 19:57:39'),
(439, 103, 25, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:39', '2025-04-19 19:57:39'),
(440, 104, 25, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:40', '2025-04-19 19:57:40'),
(441, 105, 25, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:41', '2025-04-19 19:57:41'),
(442, 106, 25, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:41', '2025-04-19 19:57:41'),
(443, 107, 25, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:42', '2025-04-19 19:57:42'),
(444, 108, 25, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:42', '2025-04-19 19:57:42'),
(445, 109, 25, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:43', '2025-04-19 19:57:43'),
(446, 110, 25, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:43', '2025-04-19 19:57:43');
INSERT INTO `grades` (`id`, `enrolled_student_id`, `assessment_id`, `points`, `total_fg_lec`, `lec_fg_grade`, `total_fg_lab`, `lab_fg_grade`, `total_fg_grade`, `tentative_fg_grade`, `fg_grade`, `total_midterms_lec`, `lec_midterms_grade`, `total_midterms_lab`, `lab_midterms_grade`, `total_midterms_grade`, `tentative_midterms_grade`, `midterms_grade`, `total_finals_lec`, `lec_finals_grade`, `total_finals_lab`, `lab_finals_grade`, `total_finals_grade`, `tentative_finals_grade`, `finals_grade`, `adjusted_finals_grade`, `published`, `published_midterms`, `published_finals`, `status`, `midterms_status`, `finals_status`, `created_at`, `updated_at`) VALUES
(447, 111, 25, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:44', '2025-04-19 19:57:44'),
(448, 112, 25, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:57:44', '2025-04-19 19:57:44'),
(449, 97, 26, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:58:03', '2025-04-19 19:58:03'),
(450, 98, 26, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:58:04', '2025-04-19 19:58:04'),
(451, 99, 26, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:58:04', '2025-04-19 19:58:04'),
(452, 100, 26, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:58:05', '2025-04-19 19:58:05'),
(453, 101, 26, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:58:05', '2025-04-19 19:58:05'),
(454, 102, 26, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:58:06', '2025-04-19 19:58:06'),
(455, 103, 26, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:58:07', '2025-04-19 19:58:07'),
(456, 104, 26, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:58:08', '2025-04-19 19:58:08'),
(457, 105, 26, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:58:08', '2025-04-19 19:58:08'),
(458, 106, 26, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:58:09', '2025-04-19 19:58:09'),
(459, 107, 26, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:58:10', '2025-04-19 19:58:10'),
(460, 108, 26, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:58:10', '2025-04-19 19:58:10'),
(461, 109, 26, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:58:11', '2025-04-19 19:58:11'),
(462, 110, 26, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:58:12', '2025-04-19 19:58:12'),
(463, 111, 26, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:58:13', '2025-04-19 19:58:13'),
(464, 112, 26, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 19:58:14', '2025-04-19 19:58:14'),
(465, 97, 27, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:06', '2025-04-19 20:00:06'),
(466, 98, 27, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:07', '2025-04-19 20:00:07'),
(467, 99, 27, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:08', '2025-04-19 20:00:08'),
(468, 100, 27, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:08', '2025-04-19 20:00:08'),
(469, 101, 27, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:10', '2025-04-19 20:00:10'),
(470, 102, 27, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:11', '2025-04-19 20:00:11'),
(471, 103, 27, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:12', '2025-04-19 20:00:12'),
(472, 104, 27, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:14', '2025-04-19 20:00:14'),
(473, 105, 27, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:18', '2025-04-19 20:00:18'),
(474, 106, 27, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:20', '2025-04-19 20:00:20'),
(475, 107, 27, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:23', '2025-04-19 20:00:23'),
(476, 108, 27, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:27', '2025-04-19 20:00:27'),
(477, 109, 27, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:28', '2025-04-19 20:00:28'),
(478, 97, 28, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:31', '2025-04-19 20:00:31'),
(479, 98, 28, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:32', '2025-04-19 20:00:32'),
(480, 99, 28, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:33', '2025-04-19 20:00:33'),
(481, 100, 28, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:35', '2025-04-19 20:00:35'),
(482, 101, 28, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:39', '2025-04-19 20:00:39'),
(483, 102, 28, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:42', '2025-04-19 20:00:42'),
(484, 103, 28, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:46', '2025-04-19 20:00:46'),
(485, 104, 28, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:50', '2025-04-19 20:00:50'),
(486, 97, 29, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:53', '2025-04-19 20:00:53'),
(487, 98, 29, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:54', '2025-04-19 20:00:54'),
(488, 99, 29, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:55', '2025-04-19 20:00:55'),
(489, 100, 29, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:56', '2025-04-19 20:00:56'),
(490, 101, 29, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:58', '2025-04-19 20:00:58'),
(491, 102, 29, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:58', '2025-04-19 20:00:58'),
(492, 103, 29, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:00:59', '2025-04-19 20:00:59'),
(493, 104, 29, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:03', '2025-04-19 20:01:03'),
(494, 105, 28, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:05', '2025-04-19 20:01:05'),
(495, 105, 29, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:08', '2025-04-19 20:01:08'),
(496, 106, 28, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:11', '2025-04-19 20:01:11'),
(497, 106, 29, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:11', '2025-04-19 20:01:11'),
(498, 107, 28, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:15', '2025-04-19 20:01:15'),
(499, 107, 29, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:16', '2025-04-19 20:01:16'),
(500, 108, 28, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:18', '2025-04-19 20:01:18'),
(501, 108, 29, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:18', '2025-04-19 20:01:18'),
(502, 109, 29, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:18', '2025-04-19 20:01:18'),
(503, 110, 29, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:19', '2025-04-19 20:01:19'),
(504, 111, 28, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:19', '2025-04-19 20:01:19'),
(505, 97, 30, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:22', '2025-04-19 20:01:22'),
(506, 98, 30, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:23', '2025-04-19 20:01:23'),
(507, 99, 30, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:25', '2025-04-19 20:01:25'),
(508, 100, 30, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:31', '2025-04-19 20:01:31'),
(509, 101, 30, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:37', '2025-04-19 20:01:37'),
(510, 102, 30, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:41', '2025-04-19 20:01:41'),
(511, 103, 30, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:43', '2025-04-19 20:01:43'),
(512, 104, 30, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:45', '2025-04-19 20:01:45'),
(513, 105, 30, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:50', '2025-04-19 20:01:50'),
(514, 106, 30, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:54', '2025-04-19 20:01:54'),
(515, 107, 30, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:01:59', '2025-04-19 20:01:59'),
(516, 108, 30, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:02', '2025-04-19 20:02:02'),
(517, 110, 27, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:02', '2025-04-19 20:02:02'),
(518, 110, 30, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:02', '2025-04-19 20:02:02'),
(519, 112, 27, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:03', '2025-04-19 20:02:03'),
(520, 112, 28, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:03', '2025-04-19 20:02:03'),
(521, 97, 31, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:06', '2025-04-19 20:02:06'),
(522, 98, 31, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:08', '2025-04-19 20:02:08'),
(523, 99, 31, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:09', '2025-04-19 20:02:09'),
(524, 100, 31, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:10', '2025-04-19 20:02:10'),
(525, 101, 31, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:16', '2025-04-19 20:02:16'),
(526, 102, 31, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:23', '2025-04-19 20:02:23'),
(527, 97, 32, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:30', '2025-04-19 20:02:30'),
(528, 98, 32, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:32', '2025-04-19 20:02:32'),
(529, 99, 32, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:35', '2025-04-19 20:02:35'),
(530, 100, 32, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:37', '2025-04-19 20:02:37'),
(531, 101, 32, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:39', '2025-04-19 20:02:39'),
(532, 102, 32, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:42', '2025-04-19 20:02:42'),
(533, 103, 32, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:44', '2025-04-19 20:02:44'),
(534, 103, 31, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:44', '2025-04-19 20:02:44'),
(535, 104, 31, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:46', '2025-04-19 20:02:46'),
(536, 104, 32, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:46', '2025-04-19 20:02:46'),
(537, 105, 32, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:47', '2025-04-19 20:02:47'),
(538, 105, 31, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:47', '2025-04-19 20:02:47'),
(539, 106, 31, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:49', '2025-04-19 20:02:49'),
(540, 106, 32, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:49', '2025-04-19 20:02:49'),
(541, 107, 31, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:51', '2025-04-19 20:02:51'),
(542, 107, 32, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:51', '2025-04-19 20:02:51'),
(543, 108, 31, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:52', '2025-04-19 20:02:52'),
(544, 108, 32, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:52', '2025-04-19 20:02:52'),
(545, 109, 28, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:54', '2025-04-19 20:02:54'),
(546, 109, 30, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:54', '2025-04-19 20:02:54'),
(547, 109, 31, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:54', '2025-04-19 20:02:54'),
(548, 109, 32, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:54', '2025-04-19 20:02:54'),
(549, 110, 28, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:55', '2025-04-19 20:02:55'),
(550, 110, 31, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:55', '2025-04-19 20:02:55'),
(551, 110, 32, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:56', '2025-04-19 20:02:56'),
(552, 111, 27, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:57', '2025-04-19 20:02:57'),
(553, 111, 29, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:57', '2025-04-19 20:02:57'),
(554, 111, 32, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:57', '2025-04-19 20:02:57'),
(555, 111, 30, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:58', '2025-04-19 20:02:58'),
(556, 111, 31, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:58', '2025-04-19 20:02:58'),
(557, 112, 29, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:59', '2025-04-19 20:02:59'),
(558, 112, 30, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:59', '2025-04-19 20:02:59'),
(559, 112, 31, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:59', '2025-04-19 20:02:59'),
(560, 112, 32, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:02:59', '2025-04-19 20:02:59'),
(561, 97, 33, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:04:30', '2025-04-19 20:04:30'),
(562, 98, 33, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:04:33', '2025-04-19 20:04:33'),
(563, 99, 33, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:04:36', '2025-04-19 20:04:36'),
(564, 100, 33, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:04:39', '2025-04-19 20:04:39'),
(565, 101, 33, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:04:41', '2025-04-19 20:04:41'),
(566, 102, 33, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:04:44', '2025-04-19 20:04:44'),
(567, 103, 33, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:04:47', '2025-04-19 20:04:47'),
(568, 104, 33, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:04:49', '2025-04-19 20:04:49'),
(569, 105, 33, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:04:51', '2025-04-19 20:04:51'),
(570, 106, 33, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:04:54', '2025-04-19 20:04:54'),
(571, 107, 33, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:04:56', '2025-04-19 20:04:56'),
(572, 108, 33, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:04:58', '2025-04-19 20:04:58'),
(573, 109, 33, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:05:00', '2025-04-19 20:05:00'),
(574, 110, 33, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:05:02', '2025-04-19 20:05:02'),
(575, 111, 33, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:05:04', '2025-04-19 20:05:04'),
(576, 112, 33, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:05:06', '2025-04-19 20:05:06'),
(577, 97, 34, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:07:58', '2025-04-19 20:07:58'),
(578, 98, 34, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:08:00', '2025-04-19 20:08:00'),
(579, 99, 34, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:08:02', '2025-04-19 20:08:02'),
(580, 100, 34, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:08:05', '2025-04-19 20:08:05'),
(581, 101, 34, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:08:06', '2025-04-19 20:08:06'),
(582, 102, 34, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:08:08', '2025-04-19 20:08:08'),
(583, 103, 34, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:08:11', '2025-04-19 20:08:11'),
(584, 104, 34, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:08:13', '2025-04-19 20:08:13'),
(585, 105, 34, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:08:15', '2025-04-19 20:08:15'),
(586, 106, 34, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:08:18', '2025-04-19 20:08:18'),
(587, 107, 34, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:08:21', '2025-04-19 20:08:21'),
(588, 108, 34, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:08:24', '2025-04-19 20:08:24'),
(589, 109, 34, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:08:26', '2025-04-19 20:08:26'),
(590, 110, 34, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:08:29', '2025-04-19 20:08:29'),
(591, 111, 34, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:08:36', '2025-04-19 20:08:36'),
(592, 112, 34, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:08:44', '2025-04-19 20:08:44'),
(593, 97, 35, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:08:57', '2025-04-19 20:08:57'),
(594, 98, 35, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:08:59', '2025-04-19 20:08:59'),
(595, 99, 35, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:09:03', '2025-04-19 20:09:03'),
(596, 100, 35, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:09:05', '2025-04-19 20:09:05'),
(597, 101, 35, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:09:08', '2025-04-19 20:09:08'),
(598, 102, 35, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:09:10', '2025-04-19 20:09:10'),
(599, 103, 35, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:09:12', '2025-04-19 20:09:12'),
(600, 104, 35, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:09:15', '2025-04-19 20:09:15'),
(601, 105, 35, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:09:17', '2025-04-19 20:09:17'),
(602, 106, 35, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:09:19', '2025-04-19 20:09:19'),
(603, 107, 35, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:09:21', '2025-04-19 20:09:21'),
(604, 108, 35, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:09:23', '2025-04-19 20:09:23'),
(605, 109, 35, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:09:26', '2025-04-19 20:09:26'),
(606, 111, 35, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:09:30', '2025-04-19 20:09:30'),
(607, 112, 35, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:09:32', '2025-04-19 20:09:32'),
(608, 97, 36, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:11:28', '2025-04-19 20:11:28'),
(609, 98, 36, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:11:31', '2025-04-19 20:11:31'),
(610, 99, 36, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:11:34', '2025-04-19 20:11:34'),
(611, 100, 36, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:11:36', '2025-04-19 20:11:36'),
(612, 115, 37, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:36', '2025-04-19 20:14:36'),
(613, 113, 37, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:36', '2025-04-23 18:40:07'),
(614, 116, 37, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:36', '2025-04-19 20:14:36'),
(615, 114, 37, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:36', '2025-04-23 18:40:06'),
(616, 117, 37, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:36', '2025-04-19 20:14:36'),
(617, 115, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, 'WITHDRAW', '2025-04-19 20:14:36', '2025-04-24 05:14:04'),
(618, 113, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, 'NFE', '2025-04-19 20:14:36', '2025-04-24 05:14:00'),
(619, 118, 37, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:36', '2025-04-19 20:14:36'),
(620, 116, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, 'INC', '2025-04-19 20:14:36', '2025-04-24 05:14:07'),
(621, 117, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:36', '2025-04-24 05:14:07'),
(622, 114, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, 'INC', '2025-04-19 20:14:36', '2025-04-24 05:14:03'),
(623, 118, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:37', '2025-04-24 04:08:13'),
(624, 119, 37, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:37', '2025-04-19 20:14:37'),
(625, 121, 37, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:37', '2025-04-19 20:14:37'),
(626, 120, 37, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:37', '2025-04-19 20:14:37'),
(627, 121, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:38', '2025-04-24 04:07:01'),
(628, 120, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:38', '2025-04-24 04:07:48'),
(629, 119, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:38', '2025-04-24 04:06:56'),
(630, 122, 37, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:38', '2025-04-19 20:14:38'),
(631, 124, 37, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:38', '2025-04-19 20:14:38'),
(632, 122, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:38', '2025-04-24 04:07:03'),
(633, 123, 37, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:38', '2025-04-19 20:14:38'),
(634, 124, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:38', '2025-04-24 04:07:06'),
(635, 123, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:38', '2025-04-24 04:07:04'),
(636, 125, 37, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:38', '2025-04-19 20:14:38'),
(637, 126, 37, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:38', '2025-04-19 20:14:38'),
(638, 127, 37, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:39', '2025-04-19 20:14:39'),
(639, 125, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:39', '2025-04-24 04:07:48'),
(640, 128, 37, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:39', '2025-04-19 20:14:39'),
(641, 126, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:39', '2025-04-24 04:07:11'),
(642, 127, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:39', '2025-04-24 04:07:13'),
(643, 128, NULL, NULL, 0.00, 65, 0.00, 65, NULL, NULL, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 0.00, 65, 0.00, 65, NULL, 65, 65, 70, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:14:39', '2025-04-24 04:07:15'),
(644, 114, 38, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:15:41', '2025-04-19 20:15:41'),
(645, 113, 38, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:15:41', '2025-04-19 20:15:41'),
(646, 115, 38, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:15:41', '2025-04-19 20:15:41'),
(647, 116, 38, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:15:42', '2025-04-19 20:15:42'),
(648, 117, 38, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:15:42', '2025-04-19 20:15:42'),
(649, 118, 38, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:15:42', '2025-04-19 20:15:42'),
(650, 119, 38, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:15:43', '2025-04-19 20:15:43'),
(651, 120, 38, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:15:43', '2025-04-19 20:15:43'),
(652, 121, 38, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:15:43', '2025-04-19 20:15:43'),
(653, 122, 38, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:15:43', '2025-04-19 20:15:43'),
(654, 124, 38, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:15:44', '2025-04-19 20:15:44'),
(655, 123, 38, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:15:44', '2025-04-19 20:15:44'),
(656, 125, 38, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:15:44', '2025-04-19 20:15:44'),
(657, 126, 38, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:15:44', '2025-04-19 20:15:44'),
(658, 127, 38, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:15:45', '2025-04-19 20:15:45'),
(659, 128, 38, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:15:45', '2025-04-19 20:15:45'),
(660, 114, 39, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:17:31', '2025-04-19 20:17:31'),
(661, 113, 39, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:17:31', '2025-04-19 20:17:31'),
(662, 115, 39, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:17:32', '2025-04-19 20:17:32'),
(663, 116, 39, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:17:32', '2025-04-19 20:17:32'),
(664, 117, 39, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:17:32', '2025-04-19 20:17:32'),
(665, 118, 39, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:17:33', '2025-04-19 20:17:33'),
(666, 119, 39, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:17:33', '2025-04-19 20:17:33'),
(667, 120, 39, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:17:33', '2025-04-19 20:17:33');
INSERT INTO `grades` (`id`, `enrolled_student_id`, `assessment_id`, `points`, `total_fg_lec`, `lec_fg_grade`, `total_fg_lab`, `lab_fg_grade`, `total_fg_grade`, `tentative_fg_grade`, `fg_grade`, `total_midterms_lec`, `lec_midterms_grade`, `total_midterms_lab`, `lab_midterms_grade`, `total_midterms_grade`, `tentative_midterms_grade`, `midterms_grade`, `total_finals_lec`, `lec_finals_grade`, `total_finals_lab`, `lab_finals_grade`, `total_finals_grade`, `tentative_finals_grade`, `finals_grade`, `adjusted_finals_grade`, `published`, `published_midterms`, `published_finals`, `status`, `midterms_status`, `finals_status`, `created_at`, `updated_at`) VALUES
(668, 121, 39, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:17:34', '2025-04-19 20:17:34'),
(669, 122, 39, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:17:34', '2025-04-19 20:17:34'),
(670, 123, 39, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:17:34', '2025-04-19 20:17:34'),
(671, 124, 39, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:17:35', '2025-04-19 20:17:35'),
(672, 125, 39, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:17:35', '2025-04-19 20:17:35'),
(673, 126, 39, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:17:36', '2025-04-19 20:17:36'),
(674, 127, 39, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:17:37', '2025-04-19 20:17:37'),
(675, 128, 39, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:17:37', '2025-04-19 20:17:37'),
(676, 113, 40, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:18:43', '2025-04-19 20:18:43'),
(677, 114, 40, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:18:44', '2025-04-19 20:18:44'),
(678, 116, 40, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:18:44', '2025-04-19 20:18:44'),
(679, 117, 40, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:18:45', '2025-04-19 20:18:45'),
(680, 118, 40, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:18:45', '2025-04-19 20:18:45'),
(681, 119, 40, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:18:46', '2025-04-19 20:18:46'),
(682, 120, 40, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:18:46', '2025-04-19 20:18:46'),
(683, 121, 40, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:18:47', '2025-04-19 20:18:47'),
(684, 122, 40, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:18:48', '2025-04-19 20:18:48'),
(685, 123, 40, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:18:48', '2025-04-19 20:18:48'),
(686, 124, 40, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:18:48', '2025-04-19 20:18:48'),
(687, 125, 40, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:18:49', '2025-04-19 20:18:49'),
(688, 126, 40, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:18:49', '2025-04-19 20:18:49'),
(689, 127, 40, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:18:50', '2025-04-19 20:18:50'),
(690, 128, 40, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:18:50', '2025-04-19 20:18:50'),
(691, 113, 41, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:19:16', '2025-04-19 20:19:16'),
(692, 114, 41, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:19:16', '2025-04-19 20:19:16'),
(693, 115, 40, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:19:16', '2025-04-19 20:19:16'),
(694, 115, 41, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:19:17', '2025-04-19 20:19:17'),
(695, 116, 41, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:19:18', '2025-04-19 20:19:18'),
(696, 117, 41, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:19:18', '2025-04-19 20:19:18'),
(697, 118, 41, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:19:19', '2025-04-19 20:19:19'),
(698, 119, 41, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:19:19', '2025-04-19 20:19:19'),
(699, 120, 41, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:19:20', '2025-04-19 20:19:20'),
(700, 121, 41, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:19:21', '2025-04-19 20:19:21'),
(701, 122, 41, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:19:21', '2025-04-19 20:19:21'),
(702, 123, 41, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:19:22', '2025-04-19 20:19:22'),
(703, 124, 41, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:19:22', '2025-04-19 20:19:22'),
(704, 125, 41, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:19:23', '2025-04-19 20:19:23'),
(705, 126, 41, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:19:24', '2025-04-19 20:19:24'),
(706, 127, 41, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:19:24', '2025-04-19 20:19:24'),
(707, 113, 42, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:07', '2025-04-19 20:22:07'),
(708, 116, 42, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:10', '2025-04-19 20:22:10'),
(709, 117, 42, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:11', '2025-04-19 20:22:11'),
(710, 118, 42, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:14', '2025-04-19 20:22:14'),
(711, 120, 42, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:20', '2025-04-19 20:22:20'),
(712, 121, 42, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:21', '2025-04-19 20:22:21'),
(713, 122, 42, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:24', '2025-04-19 20:22:24'),
(714, 123, 42, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:27', '2025-04-19 20:22:27'),
(715, 124, 42, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:29', '2025-04-19 20:22:29'),
(716, 125, 42, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:29', '2025-04-19 20:22:29'),
(717, 113, 43, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:32', '2025-04-19 20:22:32'),
(718, 114, 42, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:33', '2025-04-19 20:22:33'),
(719, 114, 43, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:33', '2025-04-19 20:22:33'),
(720, 115, 43, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:34', '2025-04-19 20:22:34'),
(721, 116, 43, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:35', '2025-04-19 20:22:35'),
(722, 117, 43, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:36', '2025-04-19 20:22:36'),
(723, 118, 43, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:37', '2025-04-19 20:22:37'),
(724, 119, 42, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:38', '2025-04-19 20:22:38'),
(725, 119, 43, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:38', '2025-04-19 20:22:38'),
(726, 120, 43, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:38', '2025-04-19 20:22:38'),
(727, 121, 43, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:39', '2025-04-19 20:22:39'),
(728, 122, 43, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:41', '2025-04-19 20:22:41'),
(729, 123, 43, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:42', '2025-04-19 20:22:42'),
(730, 124, 43, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:42', '2025-04-19 20:22:42'),
(731, 125, 43, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:44', '2025-04-19 20:22:44'),
(732, 126, 42, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:45', '2025-04-19 20:22:45'),
(733, 126, 43, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:45', '2025-04-19 20:22:45'),
(734, 127, 43, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:46', '2025-04-19 20:22:46'),
(735, 127, 42, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:46', '2025-04-19 20:22:46'),
(736, 128, 41, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:47', '2025-04-19 20:22:47'),
(737, 128, 42, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:49', '2025-04-19 20:22:49'),
(738, 128, 43, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:22:49', '2025-04-19 20:22:49'),
(739, 113, 44, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:23:10', '2025-04-19 20:23:10'),
(740, 114, 44, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:23:10', '2025-04-19 20:23:10'),
(741, 115, 42, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:23:11', '2025-04-19 20:23:11'),
(742, 115, 44, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:23:12', '2025-04-19 20:23:12'),
(743, 116, 44, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:23:12', '2025-04-19 20:23:12'),
(744, 117, 44, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:23:14', '2025-04-19 20:23:14'),
(745, 118, 44, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:23:15', '2025-04-19 20:23:15'),
(746, 119, 44, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:23:16', '2025-04-19 20:23:16'),
(747, 120, 44, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:23:17', '2025-04-19 20:23:17'),
(748, 121, 44, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:23:18', '2025-04-19 20:23:18'),
(749, 122, 44, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:23:19', '2025-04-19 20:23:19'),
(750, 123, 44, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:23:20', '2025-04-19 20:23:20'),
(751, 124, 44, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:23:21', '2025-04-19 20:23:21'),
(752, 125, 44, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:23:22', '2025-04-19 20:23:22'),
(753, 126, 44, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:23:23', '2025-04-19 20:23:23'),
(754, 127, 44, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:23:24', '2025-04-19 20:23:24'),
(755, 128, 44, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:23:24', '2025-04-19 20:23:24'),
(756, 113, 45, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:24:46', '2025-04-19 20:24:46'),
(757, 114, 45, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:24:47', '2025-04-19 20:24:47'),
(758, 115, 45, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:24:49', '2025-04-19 20:24:49'),
(759, 116, 45, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:24:50', '2025-04-19 20:24:50'),
(760, 117, 45, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:24:51', '2025-04-19 20:24:51'),
(761, 118, 45, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:24:58', '2025-04-19 20:24:58'),
(762, 119, 45, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:01', '2025-04-19 20:25:01'),
(763, 120, 45, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:02', '2025-04-19 20:25:02'),
(764, 121, 45, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:04', '2025-04-19 20:25:04'),
(765, 122, 45, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:05', '2025-04-19 20:25:05'),
(766, 123, 45, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:06', '2025-04-19 20:25:06'),
(767, 124, 45, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:07', '2025-04-19 20:25:07'),
(768, 125, 45, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:08', '2025-04-19 20:25:08'),
(769, 126, 45, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:10', '2025-04-19 20:25:10'),
(770, 127, 45, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:12', '2025-04-19 20:25:12'),
(771, 128, 45, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:13', '2025-04-19 20:25:13'),
(772, 113, 46, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:21', '2025-04-19 20:25:21'),
(773, 114, 46, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:22', '2025-04-19 20:25:22'),
(774, 115, 46, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:23', '2025-04-19 20:25:23'),
(775, 116, 46, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:25', '2025-04-19 20:25:25'),
(776, 118, 46, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:28', '2025-04-19 20:25:28'),
(777, 119, 46, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:29', '2025-04-19 20:25:29'),
(778, 120, 46, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:34', '2025-04-19 20:25:34'),
(779, 121, 46, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:39', '2025-04-19 20:25:39'),
(780, 122, 46, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:43', '2025-04-19 20:25:43'),
(781, 123, 46, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:47', '2025-04-19 20:25:47'),
(782, 124, 46, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:49', '2025-04-19 20:25:49'),
(783, 125, 46, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:50', '2025-04-19 20:25:50'),
(784, 126, 46, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:51', '2025-04-19 20:25:51'),
(785, 127, 46, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:52', '2025-04-19 20:25:52'),
(786, 128, 46, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:25:54', '2025-04-19 20:25:54'),
(787, 113, 47, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:27:15', '2025-04-19 20:27:15'),
(788, 114, 47, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:27:17', '2025-04-19 20:27:17'),
(789, 115, 47, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:27:18', '2025-04-19 20:27:18'),
(790, 116, 47, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:27:20', '2025-04-19 20:27:20'),
(791, 117, 46, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:27:21', '2025-04-19 20:27:21'),
(792, 117, 47, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:27:21', '2025-04-19 20:27:21'),
(793, 118, 47, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:27:23', '2025-04-19 20:27:23'),
(794, 119, 47, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:27:24', '2025-04-19 20:27:24'),
(795, 120, 47, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:27:25', '2025-04-19 20:27:25'),
(796, 121, 47, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:27:27', '2025-04-19 20:27:27'),
(797, 122, 47, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:27:29', '2025-04-19 20:27:29'),
(798, 123, 47, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:27:30', '2025-04-19 20:27:30'),
(799, 124, 47, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:27:32', '2025-04-19 20:27:32'),
(800, 125, 47, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:27:34', '2025-04-19 20:27:34'),
(801, 126, 47, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:27:40', '2025-04-19 20:27:40'),
(802, 127, 47, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:27:42', '2025-04-19 20:27:42'),
(803, 128, 47, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:27:47', '2025-04-19 20:27:47'),
(804, 113, 48, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:10', '2025-04-19 20:28:10'),
(805, 114, 48, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:12', '2025-04-19 20:28:12'),
(806, 115, 48, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:13', '2025-04-19 20:28:13'),
(807, 116, 48, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:15', '2025-04-19 20:28:15'),
(808, 117, 48, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:16', '2025-04-19 20:28:16'),
(809, 118, 48, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:18', '2025-04-19 20:28:18'),
(810, 119, 48, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:19', '2025-04-19 20:28:19'),
(811, 120, 48, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:21', '2025-04-19 20:28:21'),
(812, 121, 48, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:22', '2025-04-19 20:28:22'),
(813, 122, 48, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:25', '2025-04-19 20:28:25'),
(814, 123, 48, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:26', '2025-04-19 20:28:26'),
(815, 125, 48, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:30', '2025-04-19 20:28:30'),
(816, 126, 48, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:35', '2025-04-19 20:28:35'),
(817, 127, 48, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:44', '2025-04-19 20:28:44'),
(818, 113, 49, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:48', '2025-04-19 20:28:48'),
(819, 114, 49, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:50', '2025-04-19 20:28:50'),
(820, 115, 49, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:52', '2025-04-19 20:28:52'),
(821, 116, 49, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:53', '2025-04-19 20:28:53'),
(822, 117, 49, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:55', '2025-04-19 20:28:55'),
(823, 118, 49, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:57', '2025-04-19 20:28:57'),
(824, 119, 49, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:28:59', '2025-04-19 20:28:59'),
(825, 120, 49, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:29:01', '2025-04-19 20:29:01'),
(826, 121, 49, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:29:02', '2025-04-19 20:29:02'),
(827, 122, 49, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:29:04', '2025-04-19 20:29:04'),
(828, 123, 49, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:29:06', '2025-04-19 20:29:06'),
(829, 124, 48, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:29:07', '2025-04-19 20:29:07'),
(830, 124, 49, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:29:08', '2025-04-19 20:29:08'),
(831, 125, 49, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:29:09', '2025-04-19 20:29:09'),
(832, 127, 49, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:29:13', '2025-04-19 20:29:13'),
(833, 128, 49, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:29:14', '2025-04-19 20:29:14'),
(834, 128, 48, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:29:14', '2025-04-19 20:29:14'),
(835, 113, 50, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:29:52', '2025-04-19 20:29:52'),
(836, 114, 50, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:29:54', '2025-04-19 20:29:54'),
(837, 115, 50, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:30:00', '2025-04-19 20:30:00'),
(838, 116, 50, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:30:07', '2025-04-19 20:30:07'),
(839, 117, 50, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:30:14', '2025-04-19 20:30:14'),
(840, 113, 51, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:30:19', '2025-04-19 20:30:19'),
(841, 114, 51, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:30:21', '2025-04-19 20:30:21'),
(842, 115, 51, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:30:23', '2025-04-19 20:30:23'),
(843, 116, 51, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:30:25', '2025-04-19 20:30:25'),
(844, 117, 51, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:30:28', '2025-04-19 20:30:28'),
(845, 118, 51, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:30:30', '2025-04-19 20:30:30'),
(846, 120, 51, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:30:31', '2025-04-19 20:30:31'),
(847, 121, 50, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:30:31', '2025-04-19 20:30:31'),
(848, 118, 50, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:31:01', '2025-04-19 20:31:01'),
(849, 119, 50, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:31:03', '2025-04-19 20:31:03'),
(850, 119, 51, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:31:03', '2025-04-19 20:31:03'),
(851, 120, 50, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:31:05', '2025-04-19 20:31:05'),
(852, 121, 51, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:31:07', '2025-04-19 20:31:07'),
(853, 122, 50, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:31:08', '2025-04-19 20:31:08'),
(854, 122, 51, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:31:09', '2025-04-19 20:31:09'),
(855, 123, 50, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:31:10', '2025-04-19 20:31:10'),
(856, 123, 51, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:31:10', '2025-04-19 20:31:10'),
(857, 124, 50, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:31:12', '2025-04-19 20:31:12'),
(858, 124, 51, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:31:12', '2025-04-19 20:31:12'),
(859, 125, 51, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:31:14', '2025-04-19 20:31:14'),
(860, 125, 50, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:31:14', '2025-04-19 20:31:14'),
(861, 126, 50, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:31:16', '2025-04-19 20:31:16'),
(862, 126, 49, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:31:16', '2025-04-19 20:31:16'),
(863, 126, 51, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:31:16', '2025-04-19 20:31:16'),
(864, 127, 50, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:31:18', '2025-04-19 20:31:18'),
(865, 127, 51, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:31:18', '2025-04-19 20:31:18'),
(866, 128, 50, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:31:20', '2025-04-19 20:31:20'),
(867, 128, 51, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:31:20', '2025-04-19 20:31:20'),
(868, 101, 36, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:35:16', '2025-04-19 20:35:16'),
(869, 102, 36, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:35:18', '2025-04-19 20:35:18'),
(870, 103, 36, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:35:20', '2025-04-19 20:35:20'),
(871, 104, 36, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:35:22', '2025-04-19 20:35:22'),
(872, 106, 36, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:35:26', '2025-04-19 20:35:26'),
(873, 107, 36, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:35:27', '2025-04-19 20:35:27'),
(874, 108, 36, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:35:29', '2025-04-19 20:35:29'),
(875, 109, 36, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:35:31', '2025-04-19 20:35:31'),
(876, 110, 35, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:35:32', '2025-04-19 20:35:32'),
(877, 110, 36, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:35:32', '2025-04-19 20:35:32'),
(878, 111, 36, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:35:34', '2025-04-19 20:35:34'),
(879, 112, 36, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:35:36', '2025-04-19 20:35:36'),
(880, 105, 36, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-19 20:36:02', '2025-04-19 20:36:02'),
(881, 65, 52, '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 21:29:04', '2025-04-23 01:10:00'),
(882, 66, 52, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 21:29:05', '2025-04-21 21:29:05'),
(883, 67, 52, '19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 21:29:06', '2025-04-23 01:10:49'),
(884, 68, 52, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 21:29:06', '2025-04-21 21:29:06'),
(885, 69, 52, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 21:29:07', '2025-04-21 21:29:07'),
(886, 70, 52, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 21:29:08', '2025-04-21 21:29:08'),
(887, 71, 52, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 21:29:08', '2025-04-21 21:29:08');
INSERT INTO `grades` (`id`, `enrolled_student_id`, `assessment_id`, `points`, `total_fg_lec`, `lec_fg_grade`, `total_fg_lab`, `lab_fg_grade`, `total_fg_grade`, `tentative_fg_grade`, `fg_grade`, `total_midterms_lec`, `lec_midterms_grade`, `total_midterms_lab`, `lab_midterms_grade`, `total_midterms_grade`, `tentative_midterms_grade`, `midterms_grade`, `total_finals_lec`, `lec_finals_grade`, `total_finals_lab`, `lab_finals_grade`, `total_finals_grade`, `tentative_finals_grade`, `finals_grade`, `adjusted_finals_grade`, `published`, `published_midterms`, `published_finals`, `status`, `midterms_status`, `finals_status`, `created_at`, `updated_at`) VALUES
(888, 72, 52, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 21:29:09', '2025-04-21 21:29:09'),
(889, 73, 52, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 21:29:10', '2025-04-21 21:29:10'),
(890, 74, 52, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 21:29:20', '2025-04-21 21:29:20'),
(891, 75, 52, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 21:29:21', '2025-04-21 21:29:21'),
(892, 76, 52, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 21:29:21', '2025-04-21 21:29:21'),
(893, 77, 52, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 21:29:22', '2025-04-21 21:29:22'),
(894, 78, 52, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 21:29:22', '2025-04-21 21:29:22'),
(895, 79, 52, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 21:29:23', '2025-04-21 21:29:23'),
(896, 80, 52, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 21:29:24', '2025-04-21 21:29:24'),
(897, 180, 53, '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:15', '2025-04-22 20:49:36'),
(898, 183, 53, '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:15', '2025-04-22 20:20:21'),
(899, 181, 53, '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:15', '2025-04-22 22:41:05'),
(900, 184, 53, '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:15', '2025-04-22 20:25:14'),
(901, 180, NULL, NULL, NULL, NULL, NULL, NULL, 26.00, 26, 68, NULL, NULL, NULL, NULL, 0.00, 65, 66, NULL, NULL, NULL, NULL, 72.07, 76, 73, 73, 1, 1, 1, NULL, NULL, 'DEFAULT', '2025-04-21 22:29:15', '2025-04-23 23:51:40'),
(902, 182, 53, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:15', '2025-04-22 20:19:19'),
(903, 183, NULL, NULL, NULL, NULL, NULL, NULL, 16.00, 16, 67, NULL, NULL, NULL, NULL, 0.00, 65, 66, NULL, NULL, NULL, NULL, 38.57, 70, 69, 70, 1, 1, 1, NULL, NULL, 'DEFAULT', '2025-04-21 22:29:15', '2025-04-23 23:51:40'),
(904, 185, 53, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:15', '2025-04-22 20:28:06'),
(905, 181, NULL, NULL, NULL, NULL, NULL, NULL, 82.60, 83, 85, NULL, NULL, NULL, NULL, 89.25, 91, 89, NULL, NULL, NULL, NULL, 76.29, 80, 83, 83, 1, 1, 1, NULL, NULL, 'DEFAULT', '2025-04-21 22:29:15', '2025-04-23 23:51:40'),
(906, 184, NULL, NULL, NULL, NULL, NULL, NULL, 20.00, 20, 67, NULL, NULL, NULL, NULL, 0.00, 65, 66, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 1, 1, 1, NULL, NULL, 'DEFAULT', '2025-04-21 22:29:15', '2025-04-23 23:51:40'),
(907, 182, NULL, NULL, NULL, NULL, NULL, NULL, 24.00, 24, 68, NULL, NULL, NULL, NULL, 51.60, 72, 71, NULL, NULL, NULL, NULL, 94.64, 95, 87, 87, 1, 1, 1, NULL, NULL, 'DEFAULT', '2025-04-21 22:29:15', '2025-04-23 23:51:40'),
(908, 185, NULL, NULL, NULL, NULL, NULL, NULL, 4.00, 4, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 1, 1, 1, NULL, NULL, 'DEFAULT', '2025-04-21 22:29:15', '2025-04-23 23:51:40'),
(909, 186, 53, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:16', '2025-04-21 22:29:16'),
(910, 186, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 1, 1, 1, NULL, NULL, 'DEFAULT', '2025-04-21 22:29:16', '2025-04-23 23:51:40'),
(911, 190, 53, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:16', '2025-04-21 22:29:16'),
(912, 188, 53, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:16', '2025-04-21 22:29:16'),
(913, 187, 53, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:16', '2025-04-21 22:29:16'),
(914, 189, 53, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:16', '2025-04-21 22:29:16'),
(915, 191, 53, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:16', '2025-04-21 22:29:16'),
(916, 191, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 1, 1, 1, NULL, NULL, 'DEFAULT', '2025-04-21 22:29:16', '2025-04-23 23:51:40'),
(917, 187, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 1, 1, 1, NULL, NULL, 'DEFAULT', '2025-04-21 22:29:16', '2025-04-23 23:51:40'),
(918, 189, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 1, 1, 1, NULL, NULL, 'DEFAULT', '2025-04-21 22:29:16', '2025-04-23 23:51:40'),
(919, 188, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 1, 1, 1, NULL, NULL, 'DEFAULT', '2025-04-21 22:29:16', '2025-04-23 23:51:40'),
(920, 190, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 1, 1, 1, NULL, NULL, 'DEFAULT', '2025-04-21 22:29:16', '2025-04-23 23:51:40'),
(921, 192, 53, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:16', '2025-04-21 22:29:16'),
(922, 193, 53, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:17', '2025-04-21 22:29:17'),
(923, 194, 53, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:17', '2025-04-21 22:29:17'),
(924, 192, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 1, 1, 1, NULL, NULL, 'DEFAULT', '2025-04-21 22:29:17', '2025-04-23 23:51:42'),
(925, 195, 53, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:17', '2025-04-21 22:29:17'),
(926, 196, 53, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:17', '2025-04-21 22:29:17'),
(927, 193, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 1, 1, 1, NULL, NULL, 'DEFAULT', '2025-04-21 22:29:17', '2025-04-23 23:51:47'),
(928, 194, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 1, 1, 1, NULL, NULL, 'DEFAULT', '2025-04-21 22:29:17', '2025-04-23 23:51:47'),
(929, 196, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 1, 1, 1, NULL, NULL, 'DEFAULT', '2025-04-21 22:29:17', '2025-04-23 23:51:47'),
(930, 195, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, NULL, NULL, NULL, NULL, 0.00, 65, 65, 70, 1, 1, 1, NULL, NULL, 'DEFAULT', '2025-04-21 22:29:17', '2025-04-23 23:51:47'),
(931, 180, 54, '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:27', '2025-04-22 20:48:40'),
(932, 181, 54, '15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:27', '2025-04-22 22:41:09'),
(933, 182, 54, '20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:28', '2025-04-22 23:15:44'),
(934, 183, 54, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:28', '2025-04-21 22:29:28'),
(935, 184, 54, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:28', '2025-04-21 22:29:28'),
(936, 185, 54, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:28', '2025-04-21 22:29:28'),
(937, 186, 54, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:28', '2025-04-21 22:29:28'),
(938, 187, 54, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:29', '2025-04-21 22:29:29'),
(939, 188, 54, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:29', '2025-04-21 22:29:29'),
(940, 189, 54, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:29', '2025-04-21 22:29:29'),
(941, 190, 54, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:30', '2025-04-21 22:29:30'),
(942, 191, 54, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:30', '2025-04-21 22:29:30'),
(943, 192, 54, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:30', '2025-04-21 22:29:30'),
(944, 193, 54, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:30', '2025-04-21 22:29:30'),
(945, 195, 54, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:30', '2025-04-21 22:29:30'),
(946, 194, 54, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:31', '2025-04-21 22:29:31'),
(947, 196, 54, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:32', '2025-04-21 22:29:32'),
(948, 180, 55, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:45', '2025-04-21 22:29:45'),
(949, 181, 55, '89', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:45', '2025-04-22 22:41:14'),
(950, 182, 55, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:48', '2025-04-21 22:29:48'),
(951, 183, 55, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:48', '2025-04-21 22:29:48'),
(952, 185, 55, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:48', '2025-04-21 22:29:48'),
(953, 184, 55, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:49', '2025-04-21 22:29:49'),
(954, 186, 55, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:49', '2025-04-21 22:29:49'),
(955, 187, 55, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:51', '2025-04-21 22:29:51'),
(956, 188, 55, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:52', '2025-04-21 22:29:52'),
(957, 189, 55, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:53', '2025-04-21 22:29:53'),
(958, 190, 55, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:55', '2025-04-21 22:29:55'),
(959, 191, 55, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:55', '2025-04-21 22:29:55'),
(960, 192, 55, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:57', '2025-04-21 22:29:57'),
(961, 193, 55, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:59', '2025-04-21 22:29:59'),
(962, 194, 55, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:29:59', '2025-04-21 22:29:59'),
(963, 195, 55, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:00', '2025-04-21 22:30:00'),
(964, 196, 55, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:02', '2025-04-21 22:30:02'),
(965, 180, 56, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:04', '2025-04-21 22:30:04'),
(966, 181, 56, '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:04', '2025-04-22 22:41:17'),
(967, 182, 56, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:05', '2025-04-21 22:30:05'),
(968, 183, 56, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:05', '2025-04-21 22:30:05'),
(969, 184, 56, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:06', '2025-04-21 22:30:06'),
(970, 186, 56, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:07', '2025-04-21 22:30:07'),
(971, 187, 56, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:07', '2025-04-21 22:30:07'),
(972, 188, 56, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:08', '2025-04-21 22:30:08'),
(973, 189, 56, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:08', '2025-04-21 22:30:08'),
(974, 190, 56, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:09', '2025-04-21 22:30:09'),
(975, 191, 56, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:12', '2025-04-21 22:30:12'),
(976, 192, 56, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:13', '2025-04-21 22:30:13'),
(977, 193, 56, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:14', '2025-04-21 22:30:14'),
(978, 194, 56, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:15', '2025-04-21 22:30:15'),
(979, 195, 56, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:16', '2025-04-21 22:30:16'),
(980, 196, 56, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:19', '2025-04-21 22:30:19'),
(981, 180, 57, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:39', '2025-04-21 22:30:39'),
(982, 181, 57, '23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:40', '2025-04-22 22:41:22'),
(983, 182, 57, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:41', '2025-04-21 22:30:41'),
(984, 183, 57, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:41', '2025-04-21 22:30:41'),
(985, 184, 57, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:42', '2025-04-21 22:30:42'),
(986, 185, 56, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:42', '2025-04-21 22:30:42'),
(987, 185, 57, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:43', '2025-04-21 22:30:43'),
(988, 186, 57, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:43', '2025-04-21 22:30:43'),
(989, 187, 57, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:44', '2025-04-21 22:30:44'),
(990, 188, 57, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:44', '2025-04-21 22:30:44'),
(991, 189, 57, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:45', '2025-04-21 22:30:45'),
(992, 190, 57, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:46', '2025-04-21 22:30:46'),
(993, 191, 57, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:47', '2025-04-21 22:30:47'),
(994, 192, 57, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:47', '2025-04-21 22:30:47'),
(995, 193, 57, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:48', '2025-04-21 22:30:48'),
(996, 194, 57, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:49', '2025-04-21 22:30:49'),
(997, 195, 57, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:52', '2025-04-21 22:30:52'),
(998, 196, 57, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:30:54', '2025-04-21 22:30:54'),
(999, 180, 58, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:03', '2025-04-21 22:31:03'),
(1000, 181, 58, '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:04', '2025-04-22 22:41:24'),
(1001, 182, 58, '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:05', '2025-04-22 23:15:34'),
(1002, 183, 58, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:08', '2025-04-21 22:31:08'),
(1003, 184, 58, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:11', '2025-04-21 22:31:11'),
(1004, 185, 58, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:13', '2025-04-21 22:31:13'),
(1005, 186, 58, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:16', '2025-04-21 22:31:16'),
(1006, 187, 58, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:19', '2025-04-21 22:31:19'),
(1007, 188, 58, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:19', '2025-04-21 22:31:19'),
(1008, 190, 58, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:20', '2025-04-21 22:31:20'),
(1009, 196, 58, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:20', '2025-04-21 22:31:20'),
(1010, 180, 59, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:22', '2025-04-21 22:31:22'),
(1011, 181, 59, '89', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:23', '2025-04-22 22:41:29'),
(1012, 182, 59, '89', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:24', '2025-04-22 23:15:24'),
(1013, 183, 59, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:25', '2025-04-21 22:31:25'),
(1014, 184, 59, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:26', '2025-04-21 22:31:26'),
(1015, 185, 59, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:26', '2025-04-21 22:31:26'),
(1016, 186, 59, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:27', '2025-04-21 22:31:27'),
(1017, 187, 59, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:29', '2025-04-21 22:31:29'),
(1018, 188, 59, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:29', '2025-04-21 22:31:29'),
(1019, 189, 58, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:30', '2025-04-21 22:31:30'),
(1020, 189, 59, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:30', '2025-04-21 22:31:30'),
(1021, 190, 59, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:31', '2025-04-21 22:31:31'),
(1022, 191, 58, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:32', '2025-04-21 22:31:32'),
(1023, 191, 59, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:32', '2025-04-21 22:31:32'),
(1024, 192, 59, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:33', '2025-04-21 22:31:33'),
(1025, 192, 58, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:33', '2025-04-21 22:31:33'),
(1026, 193, 58, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:33', '2025-04-21 22:31:33'),
(1027, 193, 59, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:34', '2025-04-21 22:31:34'),
(1028, 194, 59, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:34', '2025-04-21 22:31:34'),
(1029, 195, 59, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:36', '2025-04-21 22:31:36'),
(1030, 195, 58, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:36', '2025-04-21 22:31:36'),
(1031, 196, 59, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:31:36', '2025-04-21 22:31:36'),
(1032, 180, 60, '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:33:43', '2025-04-22 20:11:14'),
(1033, 181, 60, '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:33:44', '2025-04-22 20:12:09'),
(1034, 182, 60, '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:33:46', '2025-04-22 23:15:10'),
(1035, 183, 60, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:33:50', '2025-04-21 22:33:50'),
(1036, 184, 60, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:33:54', '2025-04-21 22:33:54'),
(1037, 185, 60, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:33:58', '2025-04-21 22:33:58'),
(1038, 194, 58, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:34:00', '2025-04-21 22:34:00'),
(1039, 194, 60, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:34:00', '2025-04-21 22:34:00'),
(1040, 180, 61, '45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:34:05', '2025-04-22 22:29:29'),
(1041, 181, 61, '34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:34:06', '2025-04-22 22:41:33'),
(1042, 182, 61, '45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:34:07', '2025-04-22 23:15:52'),
(1043, 183, 61, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:34:09', '2025-04-21 22:34:09'),
(1044, 184, 61, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:34:11', '2025-04-21 22:34:11'),
(1045, 185, 61, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:34:12', '2025-04-21 22:34:12'),
(1046, 186, 60, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:34:18', '2025-04-21 22:34:18'),
(1047, 186, 61, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:34:18', '2025-04-21 22:34:18'),
(1048, 187, 61, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:34:24', '2025-04-21 22:34:24'),
(1049, 187, 60, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:34:24', '2025-04-21 22:34:24'),
(1050, 180, 62, '56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:34:29', '2025-04-22 23:22:01'),
(1051, 181, 62, '45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:34:31', '2025-04-22 22:42:19'),
(1052, 182, 62, '54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:34:32', '2025-04-22 23:20:10'),
(1053, 183, 62, '54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:34:33', '2025-04-22 23:27:46'),
(1054, 184, 62, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:34:34', '2025-04-21 22:34:34'),
(1055, 185, 62, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:34:36', '2025-04-21 22:34:36'),
(1056, 186, 62, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:36:42', '2025-04-21 22:36:42'),
(1057, 188, 60, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:36:45', '2025-04-21 22:36:45'),
(1058, 192, 60, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:36:45', '2025-04-21 22:36:45'),
(1059, 187, 62, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:36:58', '2025-04-21 22:36:58'),
(1060, 188, 61, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:36:59', '2025-04-21 22:36:59'),
(1061, 188, 62, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:36:59', '2025-04-21 22:36:59'),
(1062, 189, 60, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:00', '2025-04-21 22:37:00'),
(1063, 189, 61, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:00', '2025-04-21 22:37:00'),
(1064, 189, 62, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:01', '2025-04-21 22:37:01'),
(1065, 190, 61, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:01', '2025-04-21 22:37:01'),
(1066, 190, 60, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:01', '2025-04-21 22:37:01'),
(1067, 190, 62, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:01', '2025-04-21 22:37:01'),
(1068, 191, 61, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:03', '2025-04-21 22:37:03'),
(1069, 191, 60, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:03', '2025-04-21 22:37:03'),
(1070, 191, 62, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:03', '2025-04-21 22:37:03'),
(1071, 192, 62, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:04', '2025-04-21 22:37:04'),
(1072, 192, 61, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:04', '2025-04-21 22:37:04'),
(1073, 193, 60, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:04', '2025-04-21 22:37:04'),
(1074, 193, 62, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:05', '2025-04-21 22:37:05'),
(1075, 193, 61, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:05', '2025-04-21 22:37:05'),
(1076, 194, 61, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:06', '2025-04-21 22:37:06'),
(1077, 194, 62, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:06', '2025-04-21 22:37:06'),
(1078, 195, 60, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:07', '2025-04-21 22:37:07'),
(1079, 195, 61, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:07', '2025-04-21 22:37:07'),
(1080, 195, 62, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:08', '2025-04-21 22:37:08'),
(1081, 196, 62, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:09', '2025-04-21 22:37:09'),
(1082, 196, 61, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:09', '2025-04-21 22:37:09'),
(1083, 196, 60, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 22:37:09', '2025-04-21 22:37:09'),
(1084, 94, 21, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-21 23:00:24', '2025-04-21 23:00:24'),
(1085, 180, 63, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 20:00:30', '2025-04-22 23:13:49'),
(1086, 181, 63, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 20:00:32', '2025-04-22 20:00:32'),
(1087, 182, 63, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 20:00:34', '2025-04-22 23:19:50'),
(1088, 183, 63, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 20:00:35', '2025-04-22 23:35:03'),
(1089, 184, 63, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 20:00:36', '2025-04-22 20:00:36'),
(1090, 185, 63, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 20:00:38', '2025-04-22 20:00:38'),
(1091, 186, 63, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 20:00:40', '2025-04-22 20:00:40'),
(1092, 187, 63, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 20:00:41', '2025-04-22 20:00:41'),
(1093, 188, 63, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 20:00:42', '2025-04-22 20:00:42'),
(1094, 189, 63, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 20:00:44', '2025-04-22 20:00:44'),
(1095, 190, 63, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 20:00:45', '2025-04-22 20:00:45'),
(1096, 191, 63, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 20:00:47', '2025-04-22 20:00:47'),
(1097, 192, 63, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 20:00:48', '2025-04-22 20:00:48'),
(1098, 193, 63, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 20:00:50', '2025-04-22 20:00:50'),
(1099, 194, 63, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 20:00:51', '2025-04-22 20:00:51'),
(1100, 195, 63, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 20:00:53', '2025-04-22 20:00:53'),
(1101, 196, 63, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 20:00:54', '2025-04-22 20:00:54'),
(1102, 81, 64, '12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 23:35:46', '2025-04-22 23:43:06'),
(1103, 82, 64, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 23:35:48', '2025-04-23 05:35:13'),
(1104, 83, 64, '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 23:35:50', '2025-04-23 01:11:21'),
(1105, 84, 64, '15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 23:35:52', '2025-04-23 03:11:09'),
(1106, 85, 64, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 23:35:55', '2025-04-22 23:35:55'),
(1107, 88, 64, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 23:35:59', '2025-04-22 23:35:59');
INSERT INTO `grades` (`id`, `enrolled_student_id`, `assessment_id`, `points`, `total_fg_lec`, `lec_fg_grade`, `total_fg_lab`, `lab_fg_grade`, `total_fg_grade`, `tentative_fg_grade`, `fg_grade`, `total_midterms_lec`, `lec_midterms_grade`, `total_midterms_lab`, `lab_midterms_grade`, `total_midterms_grade`, `tentative_midterms_grade`, `midterms_grade`, `total_finals_lec`, `lec_finals_grade`, `total_finals_lab`, `lab_finals_grade`, `total_finals_grade`, `tentative_finals_grade`, `finals_grade`, `adjusted_finals_grade`, `published`, `published_midterms`, `published_finals`, `status`, `midterms_status`, `finals_status`, `created_at`, `updated_at`) VALUES
(1108, 89, 64, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 23:36:00', '2025-04-22 23:36:00'),
(1109, 90, 64, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 23:36:01', '2025-04-22 23:36:01'),
(1110, 86, 64, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 23:36:19', '2025-04-22 23:36:19'),
(1111, 87, 64, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 23:36:21', '2025-04-22 23:36:21'),
(1112, 91, 64, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 23:36:29', '2025-04-22 23:36:29'),
(1113, 92, 64, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 23:36:31', '2025-04-22 23:36:31'),
(1114, 93, 64, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 23:36:33', '2025-04-22 23:36:33'),
(1115, 94, 64, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 23:36:35', '2025-04-22 23:36:35'),
(1116, 95, 64, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 23:36:37', '2025-04-22 23:36:37'),
(1117, 96, 64, '15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-22 23:36:39', '2025-04-24 05:41:36'),
(1118, 147, 65, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:50', '2025-04-23 07:07:50'),
(1119, 149, 65, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:50', '2025-04-23 07:07:50'),
(1120, 146, 65, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:50', '2025-04-23 07:07:50'),
(1121, 148, 65, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:50', '2025-04-23 07:07:50'),
(1122, 147, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:50', '2025-04-23 07:07:50'),
(1123, 149, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:50', '2025-04-23 07:07:50'),
(1124, 150, 65, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:50', '2025-04-23 07:07:50'),
(1125, 151, 65, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:50', '2025-04-23 07:07:50'),
(1126, 146, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:50', '2025-04-23 07:07:50'),
(1127, 150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:50', '2025-04-23 07:07:50'),
(1128, 148, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:50', '2025-04-23 07:07:50'),
(1129, 151, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:51', '2025-04-23 07:07:51'),
(1130, 153, 65, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:51', '2025-04-23 07:07:51'),
(1131, 152, 65, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:51', '2025-04-23 07:07:51'),
(1132, 154, 65, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:51', '2025-04-23 07:07:51'),
(1133, 155, 65, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:51', '2025-04-23 07:07:51'),
(1134, 156, 65, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:51', '2025-04-23 07:07:51'),
(1135, 153, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:51', '2025-04-23 07:07:51'),
(1136, 152, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:51', '2025-04-23 07:07:51'),
(1137, 156, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:51', '2025-04-23 07:07:51'),
(1138, 154, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:51', '2025-04-23 07:07:51'),
(1139, 157, 65, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:51', '2025-04-23 07:07:51'),
(1140, 155, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:51', '2025-04-23 07:07:51'),
(1141, 157, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:51', '2025-04-23 07:07:51'),
(1142, 158, 65, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:52', '2025-04-23 07:07:52'),
(1143, 158, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:52', '2025-04-23 07:07:52'),
(1144, 159, 65, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:52', '2025-04-23 07:07:52'),
(1145, 162, 65, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:52', '2025-04-23 07:07:52'),
(1146, 159, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:52', '2025-04-23 07:07:52'),
(1147, 160, 65, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:52', '2025-04-23 07:07:52'),
(1148, 161, 65, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:52', '2025-04-23 07:07:52'),
(1149, 162, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:52', '2025-04-23 07:07:52'),
(1150, 161, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:52', '2025-04-23 07:07:52'),
(1151, 160, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2025-04-23 07:07:52', '2025-04-23 07:07:52');

-- --------------------------------------------------------

--
-- Table structure for table `grade_ceiling_settings`
--

CREATE TABLE `grade_ceiling_settings` (
  `id` int(11) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `grade_above` int(11) DEFAULT 80,
  `grade_lower` int(11) DEFAULT 75,
  `grade_upper` int(11) DEFAULT 79,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grade_ceiling_settings`
--

INSERT INTO `grade_ceiling_settings` (`id`, `identifier`, `grade_above`, `grade_lower`, `grade_upper`, `created_at`, `updated_at`) VALUES
(1, 'default', 80, 75, 79, '2025-03-26 15:39:44', '2025-03-26 15:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `imported_classlist`
--

CREATE TABLE `imported_classlist` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subjects_id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `previous_instructor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `days` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `imported_classlist`
--

INSERT INTO `imported_classlist` (`id`, `subjects_id`, `instructor_id`, `previous_instructor_id`, `days`, `time`, `room`, `created_at`, `updated_at`) VALUES
(1, 1, 263, 1, 'Th/T', '3:30 PM-5:00 PM', 'F217', '2025-04-19 18:10:20', '2025-04-19 20:44:44'),
(2, 2, 263, 1, 'T/Th', '3:30 PM-5:00 PM', 'F216', '2025-04-19 18:10:32', '2025-04-19 20:44:48'),
(3, 3, 263, 1, 'Th/T', '3:30 PM-5:00 PM', 'F215', '2025-04-19 18:10:43', '2025-04-19 20:44:52'),
(4, 4, 263, 1, 'Th/T', '3:30 PM-5:00 PM', 'F216', '2025-04-19 18:10:52', '2025-04-19 20:44:56'),
(5, 5, 1, 263, 'Th/T', '3:30 PM-5:00 PM', 'F216', '2025-04-19 18:15:00', '2025-04-21 18:07:08'),
(6, 6, 1, 263, 'Th/T', '3:30 PM-5:00 PM', 'F216', '2025-04-19 18:15:15', '2025-04-21 22:28:16'),
(7, 7, 1, 263, 'Th/T', '3:30 PM-5:00 PM', 'F216', '2025-04-19 18:15:24', '2025-04-22 20:29:46'),
(8, 8, 263, 1, 'Th/T', '3:30 PM-5:00 PM', 'F216', '2025-04-19 18:15:33', '2025-04-19 20:43:46'),
(10, 10, 263, 1, 'Th/T', '3:30 PM-5:00 PM', 'F214', '2025-04-19 18:27:46', '2025-04-19 20:43:50'),
(12, 12, 1, 263, 'Th/T', '3:30 PM-5:00 PM', 'F216', '2025-04-19 19:47:16', '2025-04-21 22:28:55');

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
(4, 1, 'IBA1', '2025-04-19 18:47:48', '2025-04-19 18:47:48'),
(5, 2, 'IBA1', '2025-04-19 18:48:01', '2025-04-19 18:48:01'),
(6, 3, 'IBA2', '2025-04-19 18:48:12', '2025-04-19 18:48:12'),
(7, 4, 'IBA3', '2025-04-19 18:48:24', '2025-04-19 18:48:24');

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
(1, 'Second Semester', '2024 - 2025', 1, '2025-04-19 04:56:21', '2025-04-21 18:06:00'),
(2, 'First Semester', '2024 - 2025', 0, '2025-04-19 17:43:01', '2025-04-21 18:06:00');

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
(1, 'ITMGNT1', 'PROJECT MANAGEMENT', 'IDB1', 'First Semester, 2024 - 2025', 'Lec', '2025-04-19 18:10:20', '2025-04-19 18:10:20'),
(2, 'PROGIT2', 'PROJECT OREINTED PROGRAMMING', 'IDA2', 'First Semester, 2024 - 2025', 'Lab', '2025-04-19 18:10:32', '2025-04-19 18:10:32'),
(3, 'DSALGO1', 'DATA STRUCTURES AND ALGORITHM', 'IDB1', 'First Semester, 2024 - 2025', 'LecLab4060', '2025-04-19 18:10:43', '2025-04-19 18:10:43'),
(4, 'IMDBSE2', 'ADVANCED DATABASE SYSTEMS', 'IDC3', 'First Semester, 2024 - 2025', 'LecLab6040', '2025-04-19 18:10:52', '2025-04-19 18:10:52'),
(5, 'PROGIT2', 'PROJECT OREINTED PROGRAMMING', 'IAB4', 'Second Semester, 2024 - 2025', 'Lab', '2025-04-19 18:15:00', '2025-04-19 18:15:00'),
(6, 'DSALGO1', 'DATA STRUCTURES AND ALGORITHM', 'IAB3', 'Second Semester, 2024 - 2025', 'LecLab4060', '2025-04-19 18:15:15', '2025-04-19 18:15:15'),
(7, 'IMDBSE2', 'ADVANCED DATABASE SYSTEMS', 'IAB2', 'Second Semester, 2024 - 2025', 'LecLab6040', '2025-04-19 18:15:23', '2025-04-19 18:15:23'),
(8, 'WEBSYS2', 'WEB SYSTEM AND TECHNOLOGIES 2', 'IAB2', 'Second Semester, 2024 - 2025', 'LecLab5050', '2025-04-19 18:15:32', '2025-04-19 19:49:44'),
(10, 'ITMGNT1', 'PROJECT MANAGEMENT', 'IAC2', 'Second Semester, 2024 - 2025', 'Lec', '2025-04-19 18:27:46', '2025-04-19 18:27:46'),
(12, 'ITMGNT1', 'PROJECT MANAGEMENT', 'IDB1', 'Second Semester, 2024 - 2025', 'Lec', '2025-04-19 19:47:16', '2025-04-19 19:47:16');

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
(1, 3, 'PROGIT2', 'PROJECT OREINTED PROGRAMMING', '2025-04-19 18:34:14', '2025-04-19 18:34:14'),
(2, 3, 'DSALGO1', 'DATA STRUCTURES AND ALGORITHM', '2025-04-19 18:34:41', '2025-04-19 18:34:41'),
(3, 3, 'IMDBSE2', 'ADVANCED DATABASE SYSTEMS', '2025-04-19 18:35:03', '2025-04-19 18:38:55'),
(4, 3, 'WEBSYS2', 'WEB SYSTEM AND TECHNOLOGIES 2', '2025-04-19 18:35:17', '2025-04-19 18:35:17');

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
(1, 'LecLab4060', 0.40, 0.60, '2025-04-19 04:53:11', '2025-04-19 04:53:11'),
(2, 'LecLab6040', 0.60, 0.40, '2025-04-19 04:53:36', '2025-04-19 04:53:36'),
(3, 'LecLab5050', 0.50, 0.50, '2025-04-19 19:49:35', '2025-04-19 19:49:35');

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
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL COMMENT '1=admin, 2=teacher, 3=student, 4=secretary',
  `secondary_role` tinyint(2) DEFAULT NULL,
  `password_changed` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_number`, `name`, `middle_name`, `last_name`, `course`, `email`, `gender`, `password`, `role`, `secondary_role`, `password_changed`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Stephen', 'E.', 'Strange', NULL, NULL, NULL, '$2y$10$ifbYrHEq0OvHBpHcYmNdf.niICRo50QwuG16m4JSmezVD0FTt3a1K', 1, 2, 1, 1, 'w3m1DNaBIvXKJaH5fzixOCeYHFcmEQOekrRvBEQO4HHVVv4gdri2HSRDQ8aG', NULL, '2025-04-21 18:06:37'),
(261, '11110000', 'Brian', 'S', 'Humphrey', '', NULL, '', '$2y$10$8JtAXxQgAYxRkhspfZaNw.7sRhUgfbYE3s9sshnCq8z9ye.mCW7vi', 2, NULL, 0, 1, NULL, '2025-04-19 04:44:48', '2025-04-19 04:44:48'),
(262, '12110000', 'Lorcan', 'B', 'Mathews', '', NULL, '', '$2y$10$em4vlrskonn6k1d9IrgU1uR1Da7jrOq8EDQ/yaFi0F.UGNIWLV64e', 2, NULL, 0, 1, NULL, '2025-04-19 04:46:10', '2025-04-19 04:46:10'),
(263, '12210000', 'Henry', 'F', 'Burton', '', NULL, '', '$2y$10$PMdxhw7D1ZOrl1.RguIWWuS1QmhxnDBKbcj.2xwZMuruF.pmplDBm', 2, NULL, 1, 1, 'ktts9pM9WvWJSVNMrMNpxvwWb3D2vWvmZl1I4dUfXT0k37feFqWxQVgnXmf1', '2025-04-19 04:47:08', '2025-04-23 06:54:59'),
(264, '12220000', 'Allan', 'A', 'Kramer', '', NULL, '', '$2y$10$mJ3nyRLVEZCbMiE0JhYije5iHt9vUAHkTZ6Q3G0JYVrNvQ4CM9qqe', 4, NULL, 1, 1, 'acfV4sSab0UF4YEfVIl0zQFuxonl00iSOkS3WBmPoZaY3L5T4IWa31QJ9ccL', '2025-04-19 04:47:58', '2025-04-24 04:26:29'),
(282, '20181775', 'GERALD PRINCE', 'BACAYON', 'ALLAWAN', 'BSCS', '20181775@s.ubaguio.edu', 'Male', '$2y$10$axXJKTxDIXFArCHQrnmI2ejhGYQArY5qGTNOxO65LvnCm6xxKFNU2', 3, NULL, 0, 1, NULL, '2025-04-19 17:31:38', '2025-04-19 17:31:38'),
(283, '20237713', 'MAQUIER HANS', 'TENORIO', 'ARNOBIT', 'BSCS', '20237713@s.ubaguio.edu', 'Male', '$2y$10$JDEHg6F7xGvPVZ3W0TxQKuLuB7FsfuvMmsG8b6uIL0yHhme1xCJ7u', 3, NULL, 1, 1, '3TAtZeBxTtOwOYmvw0YpYune4w375uUIQ7AuvRq6zlBcl1EQwLtOfnXi4uyL', '2025-04-19 17:31:38', '2025-04-23 23:47:36'),
(284, '20234719', 'KEF HARVEY', 'MASAOAY', 'BUGNAY', 'BSCS', '20234719@s.ubaguio.edu', 'Male', '$2y$10$j4TCbQ92kCaqzhNe5.UBUujM9hNq1CKnUGJFp5Je5qRCauRCOt1kG', 3, NULL, 0, 1, NULL, '2025-04-19 17:31:39', '2025-04-19 17:31:39'),
(285, '20192672', 'RHONE BRYCE', 'MOLTIO', 'CHAMOS', 'BSCS', '20192672@s.ubaguio.edu', 'Male', '$2y$10$WUo2yZFdqY6sWTVpyxen/eUPWvKruJdhRhzprZJUoKSvWh7ChQzqy', 3, NULL, 0, 1, NULL, '2025-04-19 17:31:39', '2025-04-19 17:31:39'),
(286, '20140976', 'JONAH ANDRE', 'PATENDO', 'DE GUZMAN', 'BSCS', '20140976@s.ubaguio.edu', 'Male', '$2y$10$KeLq2byaWmkmGdcFnVVUUeCw6CAEY.rgafICEhm.HStVQAG7AqCma', 3, NULL, 0, 1, NULL, '2025-04-19 17:31:39', '2025-04-19 17:31:39'),
(287, '20235142', 'CRISTIAN JOSEPH', 'FERNANDEZ', 'DIZON', 'BSCS', '20235142@s.ubaguio.edu', 'Male', '$2y$10$6anjow9dln6RVbeZzysKiuG0esFdwT3lHx1DrxW3LP/j9aGZiGwsO', 3, NULL, 0, 1, NULL, '2025-04-19 17:31:39', '2025-04-19 17:31:39'),
(288, '20237809', 'FHRENNE SZEN', 'DUPINGAY', 'INSO', 'BSCS', '20237809@s.ubaguio.edu', 'Male', '$2y$10$8EIOiGGK8oNq7NWPuY0QUujPbJd7ylCzpDe89Qi7mBja0Ybx5UevK', 3, NULL, 0, 1, NULL, '2025-04-19 17:31:39', '2025-04-19 17:31:39'),
(289, '20171292', 'MAVERICK ZACH', 'DUGAO', 'LOBCHOY', 'BSCS', '20171292@s.ubaguio.edu', 'Male', '$2y$10$3bgvTCQmocwi.18NT59x2uQVb690WkJy/xympzm8Osr4VuGbp9zKW', 3, NULL, 0, 1, NULL, '2025-04-19 17:31:39', '2025-04-19 17:31:39'),
(290, '20237790', 'LANCE ANGELO', 'GARCIA', 'PABLO', 'BSCS', '20237790@s.ubaguio.edu', 'Male', '$2y$10$z06l0qzDpk8ZnkxYKzmtv.H2CHlXw2IcbCtvH2aoLJJWTr8Yx7uqi', 3, NULL, 0, 1, NULL, '2025-04-19 17:31:40', '2025-04-19 17:31:40'),
(291, '20209694', 'JHELO', 'DULAYCAN', 'PALCO', 'BSCS', '20209694@s.ubaguio.edu', 'Male', '$2y$10$V2e0JGySHs5FDoCnODgopeOBbMnp2AQSZE94dOCUdajT.ZuJYJjrC', 3, NULL, 0, 1, NULL, '2025-04-19 17:31:40', '2025-04-19 17:31:40'),
(292, '20236987', 'JUN WALENG', 'DELMAS', 'PASING', 'BSCS', '20236987@s.ubaguio.edu', 'Male', '$2y$10$EaWPjIq9hdZsidT8cOHwTOwpYdeewkU95H.91ybbHYwPYjOKPiF7m', 3, NULL, 0, 1, NULL, '2025-04-19 17:31:40', '2025-04-19 17:31:40'),
(293, '20237896', 'WILLIAM RAP-EL', 'OLIVEROS', 'RAGEL', 'BSCS', '20237896@s.ubaguio.edu', 'Male', '$2y$10$NuK8vKMH7YHrsrUm2I4T.OkoYi.CcXyS0O32PkJmoQwq6WfNewm4i', 3, NULL, 0, 1, NULL, '2025-04-19 17:31:40', '2025-04-19 17:31:40'),
(294, '20161521', 'STEPHEN EZEKIEL', 'CALALO', 'ROBLES', 'BSCS', '20161521@s.ubaguio.edu', 'Male', '$2y$10$bSe6TSnG4pqXVgZX4bM9Le5hGXWMDuvLksUSJtuVosQGjWkhHHKda', 3, NULL, 0, 1, NULL, '2025-04-19 17:31:40', '2025-04-19 17:31:40'),
(295, '20141985', 'IVAN CLYDE', 'MENIS', 'ROM', 'BSCS', '20141985@s.ubaguio.edu', 'Male', '$2y$10$kISpZvrEoMlUF3Syu8m5mOhOLiWu8ZUekQmmKW/7q3FvsZmwMXYWe', 3, NULL, 1, 1, 'zgGSXCxFWYJ1bvBkgnT12xLuonJ7DrGRrtlNxwmyaG55nvaZ9HE8E6vs2TD5', '2025-04-19 17:31:40', '2025-04-23 23:46:00'),
(296, '20226410', 'ERIN DREW', 'CASTILLON', 'COVACHA', 'BSCS', '20226410@s.ubaguio.edu', 'Female', '$2y$10$upJzjVKjtX2A80BwFAXEBubNvUpL1a5wRPnOzgow7efhSLQAB.Zeq', 3, NULL, 0, 1, NULL, '2025-04-19 17:31:40', '2025-04-19 17:31:40'),
(297, '20212590', 'VALLEREE', 'DUNUAN', 'JOSEPH', 'BSCS', '20212590@s.ubaguio.edu', 'Female', '$2y$10$Sc77IysWa.lzBMvuE8Zm4uNPPAS0QdUHkG3URac/AQ.yq4INUeMmi', 3, NULL, 0, 1, NULL, '2025-04-19 17:31:41', '2025-04-19 17:31:41'),
(298, '20237084', 'CEOLO DIANE', 'AWACAN', 'KANAPI', 'BSCS', '20237084@s.ubaguio.edu', 'Female', '$2y$10$12eVkq4UZ3k3T4FSXvMdQuj3hr6byiK/S0s2dF5qv0Z71RLA3iId.', 3, NULL, 0, 1, NULL, '2025-04-19 17:31:41', '2025-04-19 17:31:41'),
(299, '11112222', 'asdasda', 'asdasdasd', 'asdasdasd', '', NULL, '', '$2y$10$KiV6GJM2K8uXAXDMyAdlGO7e5v9Vyg/LvKG069p.wuSdJc8ZOSeka', 2, NULL, 0, 1, 'zIRwBDZJkDmaMF3N4EStoZRDjeuC3b3ksIszfDplzKmMyDrJXM22MLPJs7vz', '2025-04-24 03:01:01', '2025-04-24 03:01:01');

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
-- Indexes for table `assessment_views`
--
ALTER TABLE `assessment_views`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_assessment_unique` (`student_id`,`assessment_id`),
  ADD KEY `assessment_id` (`assessment_id`);

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
-- Indexes for table `final_statuses`
--
ALTER TABLE `final_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grades_enrolled_student_id_foreign` (`enrolled_student_id`),
  ADD KEY `grades_assessment_id_foreign` (`assessment_id`);

--
-- Indexes for table `grade_ceiling_settings`
--
ALTER TABLE `grade_ceiling_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identifier` (`identifier`);

--
-- Indexes for table `imported_classlist`
--
ALTER TABLE `imported_classlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imported_classlist_subjects_id_foreign` (`subjects_id`),
  ADD KEY `imported_classlist_instructor_id_foreign` (`instructor_id`),
  ADD KEY `fk_previous_instructor` (`previous_instructor_id`);

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
  ADD UNIQUE KEY `users_id_number_unique` (`id_number`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `assessment_descriptions`
--
ALTER TABLE `assessment_descriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `assessment_views`
--
ALTER TABLE `assessment_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enrolled_students`
--
ALTER TABLE `enrolled_students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `final_statuses`
--
ALTER TABLE `final_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1152;

--
-- AUTO_INCREMENT for table `grade_ceiling_settings`
--
ALTER TABLE `grade_ceiling_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `imported_classlist`
--
ALTER TABLE `imported_classlist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subject_descriptions`
--
ALTER TABLE `subject_descriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subject_type_percentage`
--
ALTER TABLE `subject_type_percentage`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;

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
-- Constraints for table `assessment_views`
--
ALTER TABLE `assessment_views`
  ADD CONSTRAINT `assessment_views_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assessment_views_ibfk_2` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `fk_previous_instructor` FOREIGN KEY (`previous_instructor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
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
