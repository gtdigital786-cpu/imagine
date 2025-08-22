-- Database setup for Imagine Your Home website
-- Compatible with MySQL/MariaDB servers including Hostinger

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Create database (uncomment and modify if needed)
-- CREATE DATABASE IF NOT EXISTS `imagine_home` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- USE `imagine_home`;

-- Table structure for table `admins`
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default admin user
INSERT INTO `admins` (`username`, `password`) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi') -- password: admin123
ON DUPLICATE KEY UPDATE username=username;

-- Table structure for table `house_plans`
CREATE TABLE IF NOT EXISTS `house_plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `submission_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for table `visitor_count`
CREATE TABLE IF NOT EXISTS `visitor_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `count_value` int(11) DEFAULT 0,
  `last_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert initial visitor count
INSERT INTO `visitor_count` (`count_value`) VALUES (0)
ON DUPLICATE KEY UPDATE count_value=count_value;

-- Create indexes for better performance
CREATE INDEX IF NOT EXISTS `idx_submission_date` ON `house_plans` (`submission_date`);
CREATE INDEX IF NOT EXISTS `idx_status` ON `house_plans` (`status`);
CREATE INDEX IF NOT EXISTS `idx_name` ON `house_plans` (`name`);
CREATE INDEX IF NOT EXISTS `idx_mobile` ON `house_plans` (`mobile`);

COMMIT;