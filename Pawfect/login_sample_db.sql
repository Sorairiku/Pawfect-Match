-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2024 at 08:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_sample_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `adopt`
--

CREATE TABLE `adopt` (
  `id` int(11) NOT NULL,
  `reservation_id` bigint(20) NOT NULL,
  `pet_name` varchar(255) NOT NULL,
  `pet_type` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `identification` varchar(255) NOT NULL,
  `id_img` varchar(255) NOT NULL,
  `adopt_date` date DEFAULT NULL,
  `street` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `postal` int(11) NOT NULL,
  `adult` varchar(255) NOT NULL,
  `children` varchar(255) NOT NULL,
  `names` text NOT NULL,
  `household` varchar(255) NOT NULL,
  `adopter_id` bigint(20) NOT NULL,
  `adopter_img` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adopt`
--

INSERT INTO `adopt` (`id`, `reservation_id`, `pet_name`, `pet_type`, `fname`, `mname`, `lname`, `occupation`, `phone`, `email`, `identification`, `id_img`, `adopt_date`, `street`, `country`, `city`, `state`, `postal`, `adult`, `children`, `names`, `household`, `adopter_id`, `adopter_img`, `date`) VALUES
(1, 0, 'Lucky', 'Dog', 'Kenyon', 'Clemente', 'Sison', 'Student', '09959280684', 'kenyonsison18@gmail.com', 'Passport', '', NULL, '25 POTSDAM STREET CUBAO', 'Philippines', 'QUEZON CITY', 'METRO MANILA', 1102, '2', '0', 'dasdfsdga', 'Active', 0, '', '2024-03-19 11:23:33'),
(2, 0, 'Lucky', 'Dog', 'Russel', 'Padilla', 'Asuncion', 'Student', '2123423423', 'rednuht@gmail.com', 'Drivers License', '', NULL, 'tech', 'Philippines', 'Quezon City', 'metro manila', 1103, '2', '0', 'sdffafasdf', 'Noisy', 0, '', '2024-03-19 12:38:57'),
(3, 0, 'Picnic', 'Fish', 'Kenyon', 'Clemente', 'Sison', 'Student', '09959280684', 'kenyonsison18@gmail.com', 'Drivers License', '', NULL, '25 POTSDAM STREET CUBAO', 'Philippines', 'QUEZON CITY', 'METRO MANILA', 1102, '2', '0', '31231432423', 'Quiet', 0, '', '2024-03-19 12:43:18'),
(4, 0, 'Picnic', 'Fish', 'Kenyon', 'Clemente', 'Sison', 'Student', '09959280684', 'kenyonsison18@gmail.com', 'Drivers License', '', NULL, '25 POTSDAM STREET CUBAO', 'Philippines', 'QUEZON CITY', 'METRO MANILA', 1102, '2', '3', 'fsdfsd', 'Noisy', 0, '', '2024-03-19 12:50:52'),
(5, 0, 'Picnic', 'Fish', 'Kenyon', 'Clemente', 'Sison', 'dsa', '09959280684', 'kenyonsison18@gmail.com', 'Drivers License', '', NULL, '25 POTSDAM STREET CUBAO', 'ph', 'Quezon City', 'manila', 1102, 'dasd', 'dasda', 'dasda', 'Calm', 0, '', '2024-03-19 12:56:13'),
(6, 0, 'Picnic', 'Fish', 'Kenyon', 'Clemente', 'Sison', 'dasd', '09959280684', 'kenyonsison18@gmail.com', 'SSS', '', NULL, '25 POTSDAM STREET CUBAO', 'Philippines', 'QUEZON CITY', 'METRO MANILA', 1102, 'asd', 'dasd', 'dasd', 'Quiet', 733270376, '65f7143dc7c009.98335483.jpg', '2024-03-19 17:38:12'),
(7, 94113710446522, 'Killua', 'Dog', 'Mariel', 'Silvestre', 'Rotone', 'hfghfg', '546234525', 'hera@gmail.com', 'Passport', '', '2024-05-01', 'Navotas', 'hgf', 'Manila', 'dasd', 4923, 'dasd', 'dasd', 'ada', 'Noisy', 43253676875724856, '65f7143dc7c009.98335483.jpg', '2024-03-19 17:38:17'),
(8, 434234591, 'Picnic', 'Fish', 'Kenyon', 'Clemente', 'Sison', 'Student', '09959280684', 'kenyonsison18@gmail.com', 'SSS', 'icon-image.png', '0000-00-00', '25 POTSDAM STREET CUBAO', 'Philippines', 'QUEZON CITY', 'METRO MANILA', 1102, '1', 'N/A', 'Kenyon Sison', 'Quiet', 733270376, '65f4318c2e4f80.46038044.jpg', '2024-03-19 17:50:16');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` bigint(255) NOT NULL,
  `outgoing_msg_id` bigint(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(2, 79275141136, 733270376, 'hey'),
(3, 79275141136, 733270376, 'hello'),
(5, 79275141136, 733270376, 'hi'),
(6, 79275141136, 733270376, 'hello'),
(7, 733270376, 79275141136, 'hello'),
(8, 79275141136, 733270376, 'ano ginagawa mo'),
(12, 79275141136, 733270376, 'pre'),
(13, 79275141136, 733270376, 'fsdfdsdaf'),
(14, 79275141136, 733270376, 'fasdfasfasfasfasdfsdfdsfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff'),
(15, 79275141136, 733270376, 'fddddddddddddddddddddddddddddddddddsdddddddddddd'),
(16, 79275141136, 733270376, 'pre'),
(17, 733270376, 79275141136, 'tangina mo'),
(18, 733270376, 79275141136, 'jeffers');

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` bigint(20) NOT NULL,
  `pet_id` bigint(20) NOT NULL,
  `pet_name` varchar(255) NOT NULL,
  `pet_owner` varchar(255) NOT NULL,
  `pet_owner_image` varchar(255) NOT NULL,
  `pet_owner_id` bigint(20) NOT NULL,
  `pet_location` varchar(255) NOT NULL,
  `pet_address` varchar(255) NOT NULL,
  `pet_type` varchar(255) NOT NULL,
  `pet_breed` varchar(255) NOT NULL,
  `pet_gender` varchar(255) NOT NULL,
  `pet_age` int(11) NOT NULL,
  `pet_image` varchar(100) NOT NULL,
  `pet_description` longtext NOT NULL,
  `availability` varchar(100) NOT NULL,
  `reservation` int(11) NOT NULL,
  `reservation_id` bigint(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `pet_id`, `pet_name`, `pet_owner`, `pet_owner_image`, `pet_owner_id`, `pet_location`, `pet_address`, `pet_type`, `pet_breed`, `pet_gender`, `pet_age`, `pet_image`, `pet_description`, `availability`, `reservation`, `reservation_id`, `date`) VALUES
(17, 6200781719, 'Killua', 'Kenyon', '65f7143dc7c009.98335483.jpg', 43253676875724856, 'Quezon City', '25 potsdam', 'Dog', 'Siberian Husky', 'Male', 5, '65f44c5e921401.64021072.png', 'A Friendly and Caring Companion!', 'Adopted', 0, 0, '2024-03-19 17:51:08'),
(18, 2266333578, 'Lucky', 'Kenyon', '65f4318c2e4f80.46038044.jpg', 733270376, 'Quezon City', '', 'Dog', 'Labrador x Golden Retriever', 'Male', 3, '65f44c89286de6.50154508.jpg', 'A brave bestfriend that always need attention and care but be careful!', 'Available', 0, 0, '2024-03-17 18:28:28'),
(19, 2209808546, 'Birdy', 'Kenyon', '65f4318c2e4f80.46038044.jpg', 733270376, 'Quezon City', '', 'Bird', 'Cockatoo', 'Female', 1, '65f45f89a4c921.25682079.png', 'White Bird, Grumpy but sometimes Playful!', 'Available', 0, 0, '2024-03-17 18:28:43'),
(20, 2068345275, 'Paprika', 'Mariel', '65f7143dc7c009.98335483.jpg', 43253676875724856, 'Taguig', '', 'Dog', 'Belgian Maliniois', 'Female', 1, '65f59e99b4a218.10205646.png', 'Gentle Giant. She is trained and intelligent', 'Adopted', 0, 0, '2024-03-17 19:12:53'),
(21, 1004213149, 'Picnic', 'Kenyon', '65f4318c2e4f80.46038044.jpg', 733270376, 'Taguig', '', 'Fish', 'Flower Horn', 'Male', 3, '65f59fad164626.82583080.png', 'Very Aggressive Fish!!!', 'Available', 1, 0, '2024-03-19 18:01:35'),
(22, 7112373810, 'Tofu', 'Russel', '65f6a8af136cf0.04270100.png', 79275141136, 'Quezon City', '23 Scout Ybardolaza Corner Scout Fuentebella, 1103', 'Dog', 'Golden Retriever', 'Female', 1, '65f7162e885024.55781073.png', 'Energetic and Photogenic Doggo', 'Available', 0, 0, '2024-03-17 18:29:23'),
(23, 245283960966525486, 'Layla', 'Angel', '65f713f7eda838.68355202.png', 61524, 'Makati', 'G/F Trans-Phil House, Pasong Tamo', 'Dog', 'Border Collie', 'Female', 9, '65f7a782846be9.76934362.png', 'Very smart, attentive and sweet dog', 'Available', 0, 0, '2024-03-18 02:34:26'),
(24, 1344632622088676014, 'Piper', 'Angel', '65f713f7eda838.68355202.png', 61524, 'Manila', '1067 Felipe II Stret, Binondo', 'Dog', 'Shih Tzu', 'Male', 6, '65f7a8cf1f2229.10242713.png', 'A playful yet obedient dog', 'Adopted', 0, 0, '2024-03-18 07:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(11) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `first_login` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `email`, `password`, `date`, `fname`, `lname`, `mname`, `gender`, `user_image`, `status`, `address`, `city`, `postal_code`, `phone`, `dob`, `first_login`) VALUES
(22, 79275141136, 'rednuht@gmail.com', '$2y$10$sxqDucAGLL.jJSVIVeX8L.bgSgeuAcpSF3mXHvdiUexgrHY2wl0f6', '2024-03-19 12:39:02', 'Russel', 'Asuncion', 'Padilla', 'Male', '65f7aa2a204a19.91584260.png', 'Offline', 'tech', 'Quezon City', '1103', '2123423423', '2024-03-11', 23),
(24, 733270376, 'kenyonsison18@gmail.com', '$2y$10$H3DMhqzpy7wuU9giHFdnOO2luYCLSyfZGh6J8Tod2IyHklyI/f272', '2024-03-19 18:34:29', 'Kenyon', 'Sison', 'Clemente', 'male', '65f4318c2e4f80.46038044.jpg', 'Active now', '25 POTSDAM STREET CUBAO', 'Quezon City', '1102', '09959280684', '2003-04-25', 54),
(27, 43253676875724856, 'hera@gmail.com', '$2y$10$R7mGSXyg4vg2SYkAmsMsMOv5hA/u1qtmdOxWUmMhNW4mFhpJGJXmm', '2024-03-19 17:52:03', 'Mariel', 'Rotone', 'Silvestre', 'female', '65f7143dc7c009.98335483.jpg', 'Offline', 'Navotas', 'Manila', '4923', '546234525', '2003-06-10', 6),
(39, 61524, 'angel@gmail.com', '$2y$10$nVEpRcAb/0MC1XrnOARy1udEcGImljVkW3RlZJBNs5BrSkMjGViGO', '2024-03-18 17:07:11', 'Angel', 'Caguiat', '', 'female', '65f713f7eda838.68355202.png', 'Offline', 'Bulacan', 'Makati', '3213', '31242342345', '2002-04-21', 4),
(40, 662198401142056, 'sd@gmail.com', '$2y$10$6QQNAQlU4vzJ2/7nTNLyx.t2AYKHCgdM4MbMBXedtejZgrEB8GFui', '2024-03-18 17:07:13', 'Jeffers', 'Snake Dragon', '', 'not-specified', '65f5a2e6104842.97717663.png', 'Offline', 'Feu Tech', 'Manila', '1104', '09777806742', '2003-04-25', 2),
(41, 8772882, 'lj@gmail.com', '$2y$10$.7jePs7oBCqTzF4Jw/0YJ.snbUn3rj1hTgPiFKuqAKij4BLc8pMSO', '2024-03-18 17:07:15', 'Lance', 'Cortaga', '', 'not-specified', '1710587341blank.png', 'Offline', '', 'Caloocan', '', '', '0000-00-00', 0),
(45, 9223372036854775807, 'mk@gmail.com', '$2y$10$57m2.OoiJS6SeKk510OTw.3qmOOpcLEOuqeIHWJL0BiTd9PZuCjES', '2024-03-18 17:07:18', 'Mykel', 'Kirst', '', 'not-specified', '1710661732blank.png', 'Offline', '', 'Manila', '', '', '0000-00-00', 1),
(46, 39100680785647511, 'rc@gmail.com', '$2y$10$24GBN19oUbjdSiqj/UdIkODcC/wMciGbHLM.hZtUUPqOkpov5Ws1m', '2024-03-18 17:07:20', 'Ruhi', 'Cute', '', 'not-specified', '1710752064blank.png', 'Offline', '', 'Quezon city', '', '', '0000-00-00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adopt`
--
ALTER TABLE `adopt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `date` (`date`),
  ADD KEY `email` (`email`(768)),
  ADD KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adopt`
--
ALTER TABLE `adopt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
