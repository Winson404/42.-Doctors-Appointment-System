-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2024 at 02:10 AM
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
-- Database: `db_appointment`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appt_ID` int(11) NOT NULL,
  `patient_ID` int(11) NOT NULL,
  `doctor_ID` int(11) NOT NULL,
  `purpose` text NOT NULL,
  `appt_date` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Approved, 2=Rejected, 3=Missed',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0=False, 1=True',
  `rejection_msg` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_history`
--

CREATE TABLE `log_history` (
  `log_Id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `login_datetime` datetime NOT NULL,
  `logout_datetime` datetime NOT NULL,
  `logout_remarks` int(11) NOT NULL DEFAULT 0 COMMENT '0=Logged out successfully, 1=Unable to logout last login'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `sched_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `schedule` datetime NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_Id` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `suffix` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `birthplace` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `civilstatus` varchar(20) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `house_no` varchar(50) DEFAULT NULL,
  `street_name` varchar(100) DEFAULT NULL,
  `purok` varchar(50) DEFAULT NULL,
  `zone` varchar(50) DEFAULT NULL,
  `barangay` varchar(50) DEFAULT NULL,
  `municipality` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `clinic_name` varchar(255) DEFAULT NULL,
  `clinic_services` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` int(11) DEFAULT 0 COMMENT '0=Patient, 1=Secretary, 2=Doctor, 3=Administrator',
  `verification_code` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_Id`, `firstname`, `middlename`, `lastname`, `suffix`, `dob`, `age`, `email`, `contact`, `birthplace`, `gender`, `civilstatus`, `occupation`, `religion`, `house_no`, `street_name`, `purok`, `zone`, `barangay`, `municipality`, `province`, `region`, `specialization`, `clinic_name`, `clinic_services`, `image`, `password`, `user_type`, `verification_code`, `created_at`) VALUES
(66, 'Admin', '', 'Admin', 'Admin', '1995-03-02', 28, 'admin@gmail.com', '9359428963', 'Female', 'Male', 'Single', 'Admin', 'Iglesia Ni Cristo', 'Dsas', 'Admin', 'Admin', 'Dsa', 'Admin', 'Admin', 'Ds', 'Admins', '', '', '', '2.jpg', '0192023a7bbd73250516f069df18b500', 3, 0, '2022-11-24 16:00:00'),
(72, 'User', 'User', 'User', 'Jr', '2022-12-21', 1, 'doctor@gmail.com', '9359428963', 'Gfdgfdg', 'Male', 'Married', 'Gfdgfdgd', 'Buddhist', 'Gfdg', 'Fdg', 'Gdfgdg', 'Gfdg', 'Dfgd', 'Fdgdg', 'Province', 'Region', 'Specializations', 'Clinic Servicess', 'Clinic Servicess', 'testimonials-1.jpg', '0192023a7bbd73250516f069df18b500', 2, 295016, '2022-12-26 16:00:00'),
(86, 'Sample', 'Sample', 'Sample', 'Sample', '2008-02-27', 15, 'user@gmail.com', '9123456789', 'Samplef Fsdfsd', 'Male', 'Single', 'Sampleff Fsdfds', 'Evangelical Christianity', 'Fdfds Fdsf', 'Fsfsdfsdds ', 'Sf Fsdff', 'Fsdfsdfsdfs Fdsf Sfs', 'Fdsfd Fsfs Fs', 'Fdsfds', 'Fsdffdsf', 'Sdfsd', '', '', '', 'pexels-photo-2379005.jpeg', '0192023a7bbd73250516f069df18b500', 0, 0, '2023-12-18 11:19:29'),
(87, 'Lestesd', 'Leste', 'Leste', 'Leste', '1986-02-26', 37, 'secretary@gmail.com', '9123456789', 'Leste', 'Female', 'Widow/ER', 'Leste', 'Iglesia Ni Cristo', 'Leste', 'Leste', 'Leste', 'Leste', 'Leste', 'Leste', 'Fdsf', 'Lestes', '', '', '', 'pexels-photo-1855582.jpeg', '0192023a7bbd73250516f069df18b500', 1, 192273, '2023-12-18 11:22:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appt_ID`);

--
-- Indexes for table `log_history`
--
ALTER TABLE `log_history`
  ADD PRIMARY KEY (`log_Id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`sched_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appt_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `log_history`
--
ALTER TABLE `log_history`
  MODIFY `log_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sched_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
