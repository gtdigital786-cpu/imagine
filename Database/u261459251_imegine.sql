-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 22, 2025 at 04:10 AM
-- Server version: 10.11.10-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u261459251_imegine`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'hariom', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-08-21 14:19:03'),
(2, 'admin', '$2y$10$p3CfCcR1T0ymsuK6bQ5eH.JjuceyK0pvNRB88e97trAxoXju3O.EK', '2025-08-21 14:27:11');

-- --------------------------------------------------------

--
-- Table structure for table `house_plans`
--

CREATE TABLE `house_plans` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `plot_shape` text DEFAULT NULL,
  `plot_length` varchar(50) DEFAULT NULL,
  `plot_width` varchar(50) DEFAULT NULL,
  `plot_radius` varchar(50) DEFAULT NULL,
  `margin_right` varchar(50) DEFAULT NULL,
  `margin_left` varchar(50) DEFAULT NULL,
  `margin_back` varchar(50) DEFAULT NULL,
  `margin_front` varchar(50) DEFAULT NULL,
  `road_direction` text DEFAULT NULL,
  `front_facing` varchar(20) DEFAULT NULL,
  `entry_gate` varchar(20) DEFAULT NULL,
  `main_door` varchar(20) DEFAULT NULL,
  `gf_parking` int(11) DEFAULT 0,
  `gf_porch` int(11) DEFAULT 0,
  `gf_hall` int(11) DEFAULT 0,
  `gf_duplex_hall` int(11) DEFAULT 0,
  `gf_kitchen` int(11) DEFAULT 0,
  `gf_washing` int(11) DEFAULT 0,
  `gf_store` int(11) DEFAULT 0,
  `gf_bedroom` int(11) DEFAULT 0,
  `gf_bedroom_balcony` int(11) DEFAULT 0,
  `gf_master_bedroom` int(11) DEFAULT 0,
  `gf_master_balcony` int(11) DEFAULT 0,
  `gf_toilet` int(11) DEFAULT 0,
  `gf_bathroom` int(11) DEFAULT 0,
  `gf_puja` int(11) DEFAULT 0,
  `gf_guest` int(11) DEFAULT 0,
  `gf_theater` int(11) DEFAULT 0,
  `gf_courtyard` int(11) DEFAULT 0,
  `gf_staircase` int(11) DEFAULT 0,
  `gf_staircase_hall` int(11) DEFAULT 0,
  `ff_parking` int(11) DEFAULT 0,
  `ff_porch` int(11) DEFAULT 0,
  `ff_hall` int(11) DEFAULT 0,
  `ff_duplex_hall` int(11) DEFAULT 0,
  `ff_kitchen` int(11) DEFAULT 0,
  `ff_washing` int(11) DEFAULT 0,
  `ff_store` int(11) DEFAULT 0,
  `ff_bedroom` int(11) DEFAULT 0,
  `ff_bedroom_balcony` int(11) DEFAULT 0,
  `ff_master_bedroom` int(11) DEFAULT 0,
  `ff_master_balcony` int(11) DEFAULT 0,
  `ff_toilet` int(11) DEFAULT 0,
  `ff_bathroom` int(11) DEFAULT 0,
  `ff_puja` int(11) DEFAULT 0,
  `ff_guest` int(11) DEFAULT 0,
  `ff_theater` int(11) DEFAULT 0,
  `ff_courtyard` int(11) DEFAULT 0,
  `ff_staircase` int(11) DEFAULT 0,
  `ff_staircase_hall` int(11) DEFAULT 0,
  `sf_parking` int(11) DEFAULT 0,
  `sf_porch` int(11) DEFAULT 0,
  `sf_hall` int(11) DEFAULT 0,
  `sf_duplex_hall` int(11) DEFAULT 0,
  `sf_kitchen` int(11) DEFAULT 0,
  `sf_washing` int(11) DEFAULT 0,
  `sf_store` int(11) DEFAULT 0,
  `sf_bedroom` int(11) DEFAULT 0,
  `sf_bedroom_balcony` int(11) DEFAULT 0,
  `sf_master_bedroom` int(11) DEFAULT 0,
  `sf_master_balcony` int(11) DEFAULT 0,
  `sf_toilet` int(11) DEFAULT 0,
  `sf_bathroom` int(11) DEFAULT 0,
  `sf_puja` int(11) DEFAULT 0,
  `sf_guest` int(11) DEFAULT 0,
  `sf_theater` int(11) DEFAULT 0,
  `sf_courtyard` int(11) DEFAULT 0,
  `sf_staircase` int(11) DEFAULT 0,
  `sf_staircase_hall` int(11) DEFAULT 0,
  `total_ground` int(11) DEFAULT 0,
  `total_first` int(11) DEFAULT 0,
  `total_second` int(11) DEFAULT 0,
  `submission_date` timestamp NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `house_plans`
--

INSERT INTO `house_plans` (`id`, `name`, `mobile`, `email`, `city`, `plot_shape`, `plot_length`, `plot_width`, `plot_radius`, `margin_right`, `margin_left`, `margin_back`, `margin_front`, `road_direction`, `front_facing`, `entry_gate`, `main_door`, `gf_parking`, `gf_porch`, `gf_hall`, `gf_duplex_hall`, `gf_kitchen`, `gf_washing`, `gf_store`, `gf_bedroom`, `gf_bedroom_balcony`, `gf_master_bedroom`, `gf_master_balcony`, `gf_toilet`, `gf_bathroom`, `gf_puja`, `gf_guest`, `gf_theater`, `gf_courtyard`, `gf_staircase`, `gf_staircase_hall`, `ff_parking`, `ff_porch`, `ff_hall`, `ff_duplex_hall`, `ff_kitchen`, `ff_washing`, `ff_store`, `ff_bedroom`, `ff_bedroom_balcony`, `ff_master_bedroom`, `ff_master_balcony`, `ff_toilet`, `ff_bathroom`, `ff_puja`, `ff_guest`, `ff_theater`, `ff_courtyard`, `ff_staircase`, `ff_staircase_hall`, `sf_parking`, `sf_porch`, `sf_hall`, `sf_duplex_hall`, `sf_kitchen`, `sf_washing`, `sf_store`, `sf_bedroom`, `sf_bedroom_balcony`, `sf_master_bedroom`, `sf_master_balcony`, `sf_toilet`, `sf_bathroom`, `sf_puja`, `sf_guest`, `sf_theater`, `sf_courtyard`, `sf_staircase`, `sf_staircase_hall`, `total_ground`, `total_first`, `total_second`, `submission_date`, `status`) VALUES
(1, '', '', '', '', 'Square', '', '10', '', '1', '3', '5', '6', 'West', 'West', 'North', 'West', 0, 2, 0, 0, 0, 0, 4, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150, 100, 200, '2025-08-21 14:23:57', 'pending'),
(2, 'vishal', '7767834383', 'vishak@yahoo.com', 'nashik', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-08-21 14:25:00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_count`
--

CREATE TABLE `visitor_count` (
  `id` int(11) NOT NULL,
  `count_value` int(11) DEFAULT 0,
  `last_updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitor_count`
--

INSERT INTO `visitor_count` (`id`, `count_value`, `last_updated`) VALUES
(1, 82, '2025-08-22 02:04:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `house_plans`
--
ALTER TABLE `house_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor_count`
--
ALTER TABLE `visitor_count`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `house_plans`
--
ALTER TABLE `house_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visitor_count`
--
ALTER TABLE `visitor_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
