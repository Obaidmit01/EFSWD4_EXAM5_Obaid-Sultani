-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2025 at 07:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `efswd4_exam5_animal_adoption_sultani`
--

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `size` enum('small','large') DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `vaccinated` tinyint(1) DEFAULT NULL,
  `breed` varchar(100) DEFAULT NULL,
  `status` enum('Available','Adopted') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`id`, `name`, `photo`, `location`, `description`, `size`, `age`, `vaccinated`, `breed`, `status`) VALUES
(1, 'Max', 'max.jpg', 'Praterstrasse 23', 'Friendly senior dog.', 'large', 10, 1, 'Golden Retriever', 'Available'),
(2, 'Bella', 'bella.jpg', 'Main Street 5', 'Playful kitten.', 'small', 2, 1, 'Siamese', 'Available'),
(3, 'Rocky', 'rocky.jpg', 'Elm Avenue', 'Energetic dog.', 'large', 3, 1, 'Beagle', 'Available'),
(4, 'Daisy', 'daisy.jpg', 'Park Lane', 'Older poodle.', 'small', 12, 1, 'Poodle', 'Available'),
(5, 'Nibbles', 'nibbles.jpg', 'River Road', 'Tiny hamster.', 'small', 1, 1, 'Hamster', 'Available'),
(6, 'Buddy', 'buddy.jpg', 'Lakeview', 'Senior dog loves naps.', 'large', 9, 1, 'Labrador', 'Available'),
(7, 'Milo', 'milo.jpg', 'High Street', 'Small rabbit.', 'small', 2, 1, 'Dwarf Rabbit', 'Available'),
(8, 'Coco', 'coco.jpg', 'Forest Road', 'Colorful parrot.', 'small', 3, 1, 'Parrot', 'Available'),
(9, 'Shadow', 'shadow.jpg', 'Sunset Blvd', 'Big fluffy cat.', 'large', 8, 1, 'Maine Coon', 'Available'),
(10, 'Luna', 'luna.jpg', 'Hilltop', 'Calm senior cat.', 'small', 10, 1, 'Persian', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `animal_id` int(11) DEFAULT NULL,
  `adoption_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `picture`, `password`, `is_admin`) VALUES
(2, 'Admin', 'User', 'obaidsultani@gmail.com', NULL, NULL, NULL, 'iamadmin', 1),
(3, 'Check', 'user', 'checkuser@gmail.com', NULL, NULL, NULL, 'user', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `animal_id` (`animal_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
