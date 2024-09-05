-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2021 at 04:15 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `input`
--

-- --------------------------------------------------------

--
-- Table structure for table `input_data`
--

CREATE TABLE `input_data` (
  `id` int(11) NOT NULL,
  `sic` int(3) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `waktu` varchar(255) NOT NULL,
  `time_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `input_data`
--

INSERT INTO `input_data` (`id`, `sic`, `tanggal`, `waktu`, `time_update`) VALUES
(1, 141, '2021-07-12 20:00:00', '19:00:00', '2021-07-12 14:07:08'),
(2, 142, '', '', '2021-07-11 11:12:22'),
(3, 143, '', '', '2021-07-11 11:12:22'),
(4, 144, '', '', '2021-07-11 11:12:22'),
(5, 145, '', '', '2021-07-11 11:12:22'),
(6, 146, '', '', '2021-07-11 11:12:22'),
(7, 147, '', '', '2021-07-11 11:12:22'),
(8, 148, '', '', '2021-07-11 11:12:22'),
(9, 149, '', '', '2021-07-11 11:12:22'),
(10, 150, '', '', '2021-07-11 11:12:22'),
(11, 151, '', '', '2021-07-11 11:12:22'),
(12, 152, '', '', '2021-07-11 11:12:22'),
(13, 153, '', '', '2021-07-11 11:12:22'),
(14, 154, '', '', '2021-07-11 11:12:22'),
(15, 155, '', '', '2021-07-11 11:12:22'),
(16, 156, '', '', '2021-07-11 11:12:22'),
(17, 157, '', '', '2021-07-11 11:12:22'),
(18, 158, '', '', '2021-07-11 11:12:22'),
(19, 159, '', '', '2021-07-11 11:12:22'),
(20, 160, '', '', '2021-07-11 11:12:22'),
(21, 161, '', '', '2021-07-11 11:12:22'),
(22, 162, '', '', '2021-07-11 11:12:22'),
(23, 163, '', '', '2021-07-11 11:12:22'),
(24, 164, '', '', '2021-07-11 11:12:22'),
(25, 165, '', '', '2021-07-11 11:12:22'),
(26, 166, '', '', '2021-07-11 11:12:22'),
(27, 167, '', '', '2021-07-11 11:12:22'),
(28, 168, '', '', '2021-07-11 11:12:22'),
(29, 169, '', '', '2021-07-11 11:12:22');

--
-- Triggers `input_data`
--
DELIMITER $$
CREATE TRIGGER `after_input_data_update` AFTER UPDATE ON `input_data` FOR EACH ROW update
	maps
inner join input_data on
	maps.sic = input_data.sic set
	maps.status = 'OK'
where
	input_data.time_update = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `maps`
--

CREATE TABLE `maps` (
  `id` int(11) NOT NULL,
  `groundStation` varchar(100) NOT NULL,
  `sic` varchar(3) NOT NULL,
  `sac` varchar(2) NOT NULL,
  `altitude` varchar(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maps`
--

INSERT INTO `maps` (`id`, `groundStation`, `sic`, `sac`, `altitude`, `latitude`, `longitude`, `status`, `keterangan`) VALUES
(1, 'Pangkalan Bun', '141', '32', '275 Ft', '-2.704861', '111.669167', 'OFF', 'UPDATE'),
(2, 'Palu', '142', '32', '607 Ft', '-0.680278', '119.729722', 'OFF', 'UPDATE'),
(3, 'Sorong', '143', '32', '331 Ft', '-0.891111', '131.286944', 'OFF', 'UPDATE'),
(4, 'Malino', '144', '32', '5043 Ft', '-5.244444', '119.899167', 'OFF', 'UPDATE'),
(5, 'Waingapu', '145', '32', '1994 Ft', '-9.668333', '120.176944', 'OFF', 'UPDATE'),
(6, 'Saumlaki', '146', '32', '412 Ft', '-7.989167', '131.302500', 'OFF', 'UPDATE'),
(7, 'Kintamani', '147', '32', '5812 Ft', '-8.206667', '115.330000', 'OFF', 'UPDATE'),
(8, 'Tarakan', '148', '32', '262 Ft', '3.326389', '117.569722', 'OFF', 'UPDATE'),
(9, 'Galela', '149', '32', '375 Ft', '1.837500', '127.787778', 'OFF', 'UPDATE'),
(10, 'Alor', '150', '32', '256 Ft', '-8.135000', '124.594167', 'OFF', 'UPDATE'),
(11, 'Ambon', '151', '32', '1906 Ft', '-3.729722', '128.163056', 'OFF', 'UPDATE'),
(12, 'Kendari', '152', '32', '581 Ft', '-4.045556', '122.414722', 'OFF', 'UPDATE'),
(13, 'Timika', '153', '32', '381 Ft', '-4.532778', '136.885833', 'OFF', 'UPDATE'),
(14, 'Merauke', '154', '32', '0 Ft', '-8.510278', '140.410833', 'OFF', 'UPDATE'),
(15, 'Kupang', '155', '32', '108 Ft', '-10.167500', '123.670556', 'OFF', 'UPDATE'),
(16, 'Manado', '156', '32', '3843 Ft', ' 1.321667', '124.756389', 'OFF', 'UPDATE'),
(17, 'Surabaya', '157', '32', '156 Ft', ' -7.374444', '112.800556', 'OFF', 'UPDATE'),
(18, 'Banjarmasin', '158', '32', '225 Ft', '-3.441944', '114.734444', 'OFF', 'UPDATE'),
(19, 'Balikpapan', '159', '32', '268 Ft', '-1.257222', '116.913889', 'OFF', 'UPDATE'),
(20, 'Biak', '160', '32', '325 Ft', '-1.188056', '136.113056', 'OFF', 'UPDATE'),
(21, 'Semarang', '161', '32', '543 Ft', '-7.021389', '110.429167', 'OFF', 'UPDATE');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `web_title` varchar(100) NOT NULL,
  `web_description` text NOT NULL,
  `map_zoom` int(4) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`web_title`, `web_description`, `map_zoom`, `updated_at`) VALUES
('ADS-B Status', 'Sistem Monitoring ADS-B Ground Station', 5, '2021-06-19 10:11:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(8) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`) VALUES
(1, 'Rakin Ghiyat N', 'admin', '$2y$10$DyHK6sokP6zes8VGD7j5Ue5Z3FRTQjRx.t0A8CupIaT2MhI0KXiO2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `input_data`
--
ALTER TABLE `input_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maps`
--
ALTER TABLE `maps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `input_data`
--
ALTER TABLE `input_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `maps`
--
ALTER TABLE `maps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `event_time_update_input_data_off` ON SCHEDULE EVERY 30 SECOND STARTS '2021-07-12 21:11:34' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE maps inner join input_data on maps.sic = input_data.sic SET maps.status = 'OFF' where input_data.time_update < DATE_SUB(NOW(), INTERVAL 30 SECOND)$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
