-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 07:13 AM
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
-- Table structure for table `enrolled_students`
--

CREATE TABLE `enrolled_students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
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
  `password_changed` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_number`, `name`, `middle_name`, `last_name`, `course`, `gender`, `password`, `role`, `password_changed`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', NULL, NULL, NULL, NULL, '$2y$10$h4f83IhJQVxvj9t6E2.mm.1FA2yJzvu2CFifNkpMCGhALRF1dBnz2', 1, 0, '4hpxnXN8VyUvCeJqwKSLbciI085H6IpRHYqwfb18oV22bS8GqDgLO3bSHKMp', NULL, '2024-04-30 20:59:00'),
(67, '10001000', 'Richard', 'R', 'Deckard', NULL, NULL, '$2y$10$fCvfVIVzmhE7YiE4a0hNOuQdiNEHaqX1Xv1omOD4mvtGfZhUebhu.', 2, 0, 'Khh3uY6IeVfxrFPmzdkkVanpbnoGeijoT1YuAvlzwTzsffDYGCliHbz6oOHi', '2024-04-30 18:45:54', '2024-04-30 20:59:46'),
(68, '00001000', 'Rachel', 'D', 'Tyrell', NULL, NULL, '$2y$10$98e5Mh.GD2xxkzVICd7si.Its48UYhbADRvC.ZgCE9S1v8ZHWI8t2', 4, 0, 'YX95ngdKOv0ODGa5WzLBDkKjQBtRwjW7kta6ldVFVKZQ2746qc4p1cJUmUc0', '2024-04-30 18:46:33', '2024-04-30 21:00:39'),
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
(89, '20151750', 'Evangeline', 'S.', 'Holloway', 'BSCS', 'Female', '$2y$10$ALh28kx9lx1Q4oiNLxWh6esP8vWJo9Q7Yqh8jiZgk5VySH8iQtF1u', 3, 0, NULL, '2024-04-30 20:38:47', '2024-04-30 20:38:47');

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
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

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
