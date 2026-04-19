-- FindIt Digital Lost & Found Platform
-- Complete Database Schema

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `findit_db`
--
CREATE DATABASE IF NOT EXISTS `findit_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `findit_db`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `campus_location` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `roll_number` varchar(50) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `is_verified` tinyint(1) DEFAULT 0,
  `status` enum('active','suspended') DEFAULT 'active',
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` enum('lost','found') NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(50) NOT NULL,
  `color` varchar(30) DEFAULT NULL,
  `brand` varchar(80) DEFAULT NULL,
  `date_occurred` date NOT NULL,
  `location_text` varchar(200) NOT NULL,
  `location_lat` decimal(10,8) DEFAULT NULL,
  `location_lng` decimal(11,8) DEFAULT NULL,
  `reward_offered` varchar(100) DEFAULT NULL,
  `item_currently_at` varchar(150) DEFAULT NULL,
  `contact_name` varchar(100) DEFAULT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `owner_question` text DEFAULT NULL,
  `status` enum('active','matched','verified','returned','rejected') DEFAULT 'active',
  `admin_approved` tinyint(1) DEFAULT 0,
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`item_id`),
  KEY `user_id` (`user_id`),
  KEY `idx_type_status` (`type`, `status`),
  KEY `idx_category` (`category`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_images`
--

CREATE TABLE `item_images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_primary` tinyint(1) DEFAULT 0,
  `uploaded_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`image_id`),
  KEY `item_id` (`item_id`),
  FOREIGN KEY (`item_id`) REFERENCES `items`(`item_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

CREATE TABLE `claims` (
  `claim_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `claimant_user_id` int(11) NOT NULL,
  `answer_1` text DEFAULT NULL,
  `answer_2` text DEFAULT NULL,
  `answer_3` text DEFAULT NULL,
  `proof_file` varchar(255) DEFAULT NULL,
  `additional_notes` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `submitted_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`claim_id`),
  KEY `item_id` (`item_id`),
  KEY `claimant_user_id` (`claimant_user_id`),
  FOREIGN KEY (`item_id`) REFERENCES `items`(`item_id`) ON DELETE CASCADE,
  FOREIGN KEY (`claimant_user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verification_questions`
--

CREATE TABLE `verification_questions` (
  `q_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `expected_answer` text NOT NULL,
  PRIMARY KEY (`q_id`),
  KEY `item_id` (`item_id`),
  FOREIGN KEY (`item_id`) REFERENCES `items`(`item_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `message_text` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `sent_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`message_id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`),
  KEY `item_id` (`item_id`),
  FOREIGN KEY (`sender_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
  FOREIGN KEY (`receiver_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
  FOREIGN KEY (`item_id`) REFERENCES `items`(`item_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `match_id` int(11) NOT NULL AUTO_INCREMENT,
  `lost_item_id` int(11) NOT NULL,
  `found_item_id` int(11) NOT NULL,
  `match_score` decimal(5,2) DEFAULT NULL,
  `is_confirmed` tinyint(1) DEFAULT 0,
  `created_at` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`match_id`),
  KEY `lost_item_id` (`lost_item_id`),
  KEY `found_item_id` (`found_item_id`),
  FOREIGN KEY (`lost_item_id`) REFERENCES `items`(`item_id`) ON DELETE CASCADE,
  FOREIGN KEY (`found_item_id`) REFERENCES `items`(`item_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- DEMO DATA INSERTIONS
-- --------------------------------------------------------

-- Default password for all seed accounts is: password123
-- Hash: $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi

INSERT INTO `users` (`full_name`, `email`, `phone`, `password_hash`, `campus_location`, `role`, `is_verified`) VALUES
('System Admin', 'admin@findit.local', '1234567890', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Main Campus', 'admin', 1),
('Arman Khan', 'arman.student@azamcampus.com', '0987654321', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Abeda Inamdar College', 'user', 1),
('Fatima Shaikh', 'fatima.student@azamcampus.com', '5551234567', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'AIMS Department', 'user', 1);

INSERT INTO `items` (`user_id`, `type`, `title`, `description`, `category`, `color`, `brand`, `date_occurred`, `location_text`, `status`, `admin_approved`) VALUES
(2, 'lost', 'Blue Puma Backpack', 'Lost my blue Puma backpack. Contains some notebooks and a water bottle.', 'Bags', 'Blue', 'Puma', '2026-04-10', 'Abeda Inamdar Library Reading Room', 'active', 1),
(3, 'found', 'Scientific Calculator', 'Found a Casio scientific calculator near the main canteen.', 'Electronics', 'Black', 'Casio', '2026-04-12', 'Main Campus Canteen', 'active', 1);

INSERT INTO `item_images` (`item_id`, `image_path`, `is_primary`) VALUES
(1, '/assets/img/placeholder.jpg', 1),
(2, '/assets/img/placeholder.jpg', 1);

COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
