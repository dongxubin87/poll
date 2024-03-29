-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 29, 2024 at 07:52 AM
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
-- Database: `myfirstdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionnaires`
--

CREATE TABLE `questionnaires` (
  `questionnaire_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questionnaires`
--

INSERT INTO `questionnaires` (`questionnaire_id`, `title`, `description`, `created_at`) VALUES
(1, 'Favorite Foods', 'Share your favorite foods with us.', '2024-03-19 16:27:22'),
(2, 'Travel Destinations', 'Tell us about your favorite travel destinations.', '2024-03-19 16:27:22'),
(3, 'Hobbies and Interests', 'Let us know about your hobbies and interests.', '2024-03-19 16:27:22');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `questionnaire_id` int(11) DEFAULT NULL,
  `type` enum('true_false','single_choice','multi_choice') NOT NULL,
  `content` text DEFAULT NULL,
  `option1` varchar(255) DEFAULT NULL,
  `option2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `questionnaire_id`, `type`, `content`, `option1`, `option2`) VALUES
(15, 1, 'single_choice', 'What\'s your favorite cuisine?', 'Italian', 'Mexican'),
(16, 1, 'single_choice', 'Do you prefer sweet or savory foods?', 'Sweet', 'Savory'),
(17, 1, 'single_choice', 'Which do you enjoy more?', 'Pizza', 'Burgers'),
(18, 1, 'single_choice', 'What\'s your favorite dessert?', 'Ice cream', 'Cake'),
(19, 1, 'single_choice', 'When it comes to breakfast, what\'s your go-to choice?', 'Pancakes', 'Eggs and bacon');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `signature` text DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `username`, `password`, `email`, `is_admin`, `created_at`, `signature`, `avatar`) VALUES
(9, 'admin', 'admin', 'dongxubin624@163.com', 1, '2024-03-21 16:51:22', NULL, NULL),
(10, 'user', '$2y$10$ZD98o6OYUm9qnTGBzsxjOOYD2C/.nyz.Htgo1QBZPyxI49EYLJMha', 'user@example.com', 0, '2024-03-21 16:58:52', NULL, NULL),
(11, 'e2301515', '$2y$10$6DVlL0vjYj.sJgmsBDW2e.6rIZw5B6pMfzs3RBsNrfCIBeqN4tg1.', 'dongxubin624@163.com', 0, '2024-03-28 06:26:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_questionnaires`
--

CREATE TABLE `user_questionnaires` (
  `submission_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `questionnaire_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_questionnaires`
--

INSERT INTO `user_questionnaires` (`submission_id`, `user_id`, `questionnaire_id`, `question_id`, `answer`) VALUES
(12, 10, 1, 15, 'Italian'),
(13, 10, 1, 16, 'Sweet'),
(14, 10, 1, 17, 'Pizza'),
(15, 10, 1, 18, 'Ice cream'),
(16, 10, 1, 19, 'Pancakes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `questionnaires`
--
ALTER TABLE `questionnaires`
  ADD PRIMARY KEY (`questionnaire_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `questionnaire_id` (`questionnaire_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_questionnaires`
--
ALTER TABLE `user_questionnaires`
  ADD PRIMARY KEY (`submission_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `questionnaire_id` (`questionnaire_id`),
  ADD KEY `question_id` (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `questionnaires`
--
ALTER TABLE `questionnaires`
  MODIFY `questionnaire_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_questionnaires`
--
ALTER TABLE `user_questionnaires`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaires` (`questionnaire_id`);

--
-- Constraints for table `user_questionnaires`
--
ALTER TABLE `user_questionnaires`
  ADD CONSTRAINT `user_questionnaires_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `user_questionnaires_ibfk_2` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaires` (`questionnaire_id`),
  ADD CONSTRAINT `user_questionnaires_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
