-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2020 at 07:06 AM
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
-- Database: `agency`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `contact_num` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `birthday` varchar(30) DEFAULT NULL,
  `course` varchar(30) DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `educ_level` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'New Applicant',
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `name`, `contact_num`, `address`, `gender`, `birthday`, `course`, `experience`, `educ_level`, `status`, `image`) VALUES
(3, 'Ron JAmes', '324234234234', 'Looc', 'Male', '2020-11-20', '4324324', '4234324234234234', 'College Graduate', 'New Applicant', '23112020075539pexels-andrea-piacquadio-3783229.jpg'),
(4, 'Jame Reid', '94545454', 'Plaridel', 'Male', '2020-11-20', 'BS IT', 'None', 'College Graduate', 'New Applicant', '25112020080832cropped-rsz_smalllogobw-192x192.png');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `ref_no` int(11) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `job_description` text DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `educ_level` varchar(100) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `qualification` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Active',
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`ref_no`, `company_name`, `job_description`, `count`, `gender`, `experience`, `educ_level`, `course`, `qualification`, `status`, `date`) VALUES
(3, 'Lazada', 'Seller', 10, 'All', 'None', '', 'None', 'Nine', 'Closed', '2020-11-14 12:05:53'),
(4, 'ewqewqe', 'dasdsad', 2, 'Male', 'dasdsad', 'dsadasd', 'dsad', 'dasdasd', 'Active', '2020-11-14 12:41:02'),
(5, 'Paglaun', 'Clerk', 10, 'All', '1 Year of experience', 'College Graduate', 'BS IT', 'Curabitur aliquet quam id dui posuere blandit. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vivamus suscipit tortor eget felis porttitor volutpat. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.', 'Active', '2020-11-17 16:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `referral`
--

CREATE TABLE `referral` (
  `id` int(11) NOT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `job_no` int(11) DEFAULT NULL,
  `date` varchar(50) NOT NULL DEFAULT current_timestamp(),
  `status` varchar(30) DEFAULT 'Referred'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `username` text DEFAULT NULL,
  `activity` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `username`, `activity`, `status`) VALUES
(9, 'admin', 'rwerwerewr', 'Doned'),
(10, 'admin', 'rewrewrewrsasas', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT 'Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `user_type`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `username` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `profile_img` varchar(100) DEFAULT NULL,
  `education` varchar(50) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact_no` int(11) DEFAULT NULL,
  `notes` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`username`, `name`, `profile_img`, `education`, `location`, `email`, `contact_no`, `notes`) VALUES
('admin', 'Juan Dela Cruz', '121120201123342020-11-alfa-dealership.jpg', 'BSIT', 'Looc', 'cajanr02@gmail.com', 9213213, 'Grapo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`ref_no`);

--
-- Indexes for table `referral`
--
ALTER TABLE `referral`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referral_ibfk_1` (`applicant_id`),
  ADD KEY `referral_ibfk_2` (`job_no`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `ref_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `referral`
--
ALTER TABLE `referral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `referral`
--
ALTER TABLE `referral`
  ADD CONSTRAINT `referral_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `referral_ibfk_2` FOREIGN KEY (`job_no`) REFERENCES `jobs` (`ref_no`) ON DELETE CASCADE;

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
