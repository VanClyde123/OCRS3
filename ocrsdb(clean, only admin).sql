-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2024 at 03:47 AM
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
  `previous_instructor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `days` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'admin', 'Dante', 'E', 'Sparda', NULL, NULL, '$2y$10$OP67yxQ9.JvCnXloBf69lev.2m.ufSHKZtandn.QQKeV1hXrPTXD2', 1, 2, 1, 'G5U6odJ5IPdRgtftzJY39iy31jFpahxjhCO7we8Q9tVq0skijRU4HEhB9Trt', NULL, '2024-06-22 19:57:06');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assessment_views`
--
ALTER TABLE `assessment_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject_descriptions`
--
ALTER TABLE `subject_descriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject_type_percentage`
--
ALTER TABLE `subject_type_percentage`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

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
