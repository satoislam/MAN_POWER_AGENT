-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2021 at 05:41 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `man_power`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `status`) VALUES
(1, 'admin', 'admin@gmail.com', '12345', 'active'),
(2, 'sanjida', 'sanjidan1993@gmail.com', '12345', 'active'),
(3, 'rafiq', 'rafiq@gmail.com', '1234567890', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `advance`
--

CREATE TABLE `advance` (
  `id` int(11) NOT NULL,
  `workerID` bigint(20) NOT NULL,
  `monthID` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advance`
--

INSERT INTO `advance` (`id`, `workerID`, `monthID`, `amount`, `date`) VALUES
(1, 1, 1, '1000.00', '2021-09-08'),
(2, 1, 1, '500.00', '2021-09-21'),
(3, 2, 1, '1000.00', '2021-09-22');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `siteID` int(11) NOT NULL,
  `monthID` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `invoice_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `siteID`, `monthID`, `amount`, `invoice_date`) VALUES
(1, 3, 1, '615.00', '2021-10-02');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payment`
--

CREATE TABLE `invoice_payment` (
  `id` int(11) NOT NULL,
  `invoiceID` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `siteID` int(11) NOT NULL,
  `monthID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice_payment`
--

INSERT INTO `invoice_payment` (`id`, `invoiceID`, `amount`, `date`, `siteID`, `monthID`) VALUES
(1, 1, '500.00', '2021-09-29', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `generated_link` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`, `generated_link`) VALUES
(1, 'Sites', 'http://localhost/man_power_agent/sites/sites.php'),
(2, 'Sectors', 'http://localhost/man_power_agent/sectors/sectors.php'),
(3, 'Add Worker', 'http://localhost/man_power_agent/add_worker/add_worker.php'),
(4, 'Worker Assign', 'http://localhost/man_power_agent/worker_assign/worker_assign.php'),
(5, 'Advance', 'http://localhost/man_power_agent/advance/advance.php'),
(6, 'Payments', 'http://localhost/man_power_agent/payments/payments.php'),
(7, 'Month', 'http://localhost/man_power_agent/month/month.php'),
(8, 'Modules', 'http://localhost/man_power_agent/modules/modules.php'),
(9, 'User Lists', 'http://localhost/man_power_agent/user_lists/user_lists.php'),
(11, 'Worker Attendance', 'http://localhost/man_power_agent/worker_attendance/worker_attendance.php'),
(12, 'Invoice', 'http://localhost/man_power_agent/invoice/invoice.php');

-- --------------------------------------------------------

--
-- Table structure for table `month`
--

CREATE TABLE `month` (
  `id` int(11) NOT NULL,
  `month_name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `month`
--

INSERT INTO `month` (`id`, `month_name`, `status`) VALUES
(1, '2021-09', 'active'),
(2, '2021-08', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `invoiceID` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `invoiceID`, `amount`, `date`) VALUES
(1, 1, '500.00', '2021-09-29');

-- --------------------------------------------------------

--
-- Table structure for table `salary_payment`
--

CREATE TABLE `salary_payment` (
  `id` int(11) NOT NULL,
  `workerID` bigint(20) NOT NULL,
  `monthID` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

CREATE TABLE `sectors` (
  `id` int(11) NOT NULL,
  `sector_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sectors`
--

INSERT INTO `sectors` (`id`, `sector_name`) VALUES
(1, 'Construction'),
(2, 'Civil');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `id` int(11) NOT NULL,
  `sectorID` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `sectorID`, `site_name`, `address`, `contact_no`, `status`) VALUES
(1, 1, 'Building Code', 'Lokkhibazar', '016789234', 'active'),
(2, 1, 'abc construction', 'Hatirpool', '01723838', 'active'),
(3, 2, 'demo sites', 'Rayer Bazar', '01723838', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `adminID` int(11) NOT NULL,
  `sites_edit` int(50) DEFAULT NULL,
  `sites_delete` int(50) DEFAULT NULL,
  `sectors_edit` int(50) DEFAULT NULL,
  `sectors_delete` int(50) DEFAULT NULL,
  `add_worker_edit` int(50) DEFAULT NULL,
  `add_worker_delete` int(50) DEFAULT NULL,
  `worker_assign_edit` int(50) DEFAULT NULL,
  `worker_assign_delete` int(50) DEFAULT NULL,
  `advance_edit` int(50) DEFAULT NULL,
  `advance_delete` int(50) DEFAULT NULL,
  `payments_edit` int(50) DEFAULT NULL,
  `payments_delete` int(50) DEFAULT NULL,
  `month_edit` int(50) DEFAULT NULL,
  `month_delete` int(50) DEFAULT NULL,
  `modules_edit` int(50) DEFAULT NULL,
  `modules_delete` int(50) DEFAULT NULL,
  `user_lists_edit` int(50) DEFAULT NULL,
  `user_lists_delete` int(50) DEFAULT NULL,
  `worker_attendance_edit` int(11) NOT NULL,
  `worker_attendance_delete` int(11) NOT NULL,
  `invoice_edit` int(11) NOT NULL,
  `invoice_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `adminID`, `sites_edit`, `sites_delete`, `sectors_edit`, `sectors_delete`, `add_worker_edit`, `add_worker_delete`, `worker_assign_edit`, `worker_assign_delete`, `advance_edit`, `advance_delete`, `payments_edit`, `payments_delete`, `month_edit`, `month_delete`, `modules_edit`, `modules_delete`, `user_lists_edit`, `user_lists_delete`, `worker_attendance_edit`, `worker_attendance_delete`, `invoice_edit`, `invoice_delete`) VALUES
(1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(4, 2, 0, 0, 0, 1, 1, 0, 0, 1, 1, 0, 1, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE `worker` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `iqama_number` varchar(255) NOT NULL,
  `local_number` varchar(255) NOT NULL,
  `whatsapp_number` varchar(150) NOT NULL,
  `photo` text NOT NULL,
  `iqama_photo` text NOT NULL,
  `current_address` text NOT NULL,
  `working_place` text NOT NULL,
  `daily_basic_salary` decimal(10,2) NOT NULL,
  `ot_rate` decimal(10,2) NOT NULL,
  `passport_number` varchar(100) NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `worker`
--

INSERT INTO `worker` (`id`, `name`, `iqama_number`, `local_number`, `whatsapp_number`, `photo`, `iqama_photo`, `current_address`, `working_place`, `daily_basic_salary`, `ot_rate`, `passport_number`, `status`) VALUES
(1, 'Karim', '0919282', '0189223939', '0189223939', 'Karim.jpg', '0919282.jpg', 'Lokkhibazar', ' Hatirpool', '200.00', '2.00', '092380320', 'active'),
(2, 'Rahim', '8973293', '01780253738', '01780253738', 'Rahim.jpg', '8973293.jpg', 'Lokkhibazar', ' Hatirpool', '100.00', '3.00', '974982798', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `worker_assign`
--

CREATE TABLE `worker_assign` (
  `id` bigint(20) NOT NULL,
  `siteID` int(11) NOT NULL,
  `workerID` bigint(20) NOT NULL,
  `per_day_salary` decimal(10,2) NOT NULL,
  `ot_rate` decimal(10,2) NOT NULL,
  `type` enum('resident','non_resident') NOT NULL,
  `monthID` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `worker_assign`
--

INSERT INTO `worker_assign` (`id`, `siteID`, `workerID`, `per_day_salary`, `ot_rate`, `type`, `monthID`, `status`) VALUES
(1, 2, 1, '200.00', '2.00', 'resident', 1, 'active'),
(2, 3, 2, '100.00', '2.00', 'non_resident', 1, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `worker_attendance`
--

CREATE TABLE `worker_attendance` (
  `id` bigint(20) NOT NULL,
  `wrokerID` bigint(20) NOT NULL,
  `status` enum('present','absent') NOT NULL,
  `date` date NOT NULL,
  `monthID` int(11) NOT NULL,
  `over_time` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `worker_attendance`
--

INSERT INTO `worker_attendance` (`id`, `wrokerID`, `status`, `date`, `monthID`, `over_time`) VALUES
(1, 2, 'present', '2021-09-01', 1, '2.00'),
(2, 2, 'present', '2021-09-02', 1, '0.00'),
(3, 2, 'present', '2021-09-04', 1, '0.00'),
(4, 2, 'present', '2021-09-04', 1, '0.00'),
(5, 2, 'present', '2021-09-05', 1, '2.00'),
(6, 2, 'present', '2021-09-06', 1, '1.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advance`
--
ALTER TABLE `advance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workerID` (`workerID`),
  ADD KEY `monthID` (`monthID`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `monthID` (`monthID`),
  ADD KEY `siteID` (`siteID`);

--
-- Indexes for table `invoice_payment`
--
ALTER TABLE `invoice_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoiceID` (`invoiceID`),
  ADD KEY `monthID` (`monthID`),
  ADD KEY `siteID` (`siteID`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `month`
--
ALTER TABLE `month`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoiceID` (`invoiceID`);

--
-- Indexes for table `salary_payment`
--
ALTER TABLE `salary_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workerID` (`workerID`),
  ADD KEY `monthID` (`monthID`);

--
-- Indexes for table `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sectorID` (`sectorID`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adminID` (`adminID`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `worker_assign`
--
ALTER TABLE `worker_assign`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siteID` (`siteID`),
  ADD KEY `workerID` (`workerID`),
  ADD KEY `monthID` (`monthID`);

--
-- Indexes for table `worker_attendance`
--
ALTER TABLE `worker_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wrokerID` (`wrokerID`),
  ADD KEY `monthID` (`monthID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `advance`
--
ALTER TABLE `advance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice_payment`
--
ALTER TABLE `invoice_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `month`
--
ALTER TABLE `month`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salary_payment`
--
ALTER TABLE `salary_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sectors`
--
ALTER TABLE `sectors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `worker`
--
ALTER TABLE `worker`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `worker_assign`
--
ALTER TABLE `worker_assign`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `worker_attendance`
--
ALTER TABLE `worker_attendance`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advance`
--
ALTER TABLE `advance`
  ADD CONSTRAINT `advance_ibfk_1` FOREIGN KEY (`monthID`) REFERENCES `month` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `advance_ibfk_2` FOREIGN KEY (`workerID`) REFERENCES `worker` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`monthID`) REFERENCES `month` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`siteID`) REFERENCES `sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice_payment`
--
ALTER TABLE `invoice_payment`
  ADD CONSTRAINT `invoice_payment_ibfk_1` FOREIGN KEY (`invoiceID`) REFERENCES `invoice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_payment_ibfk_2` FOREIGN KEY (`monthID`) REFERENCES `month` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_payment_ibfk_3` FOREIGN KEY (`siteID`) REFERENCES `sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`invoiceID`) REFERENCES `invoice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salary_payment`
--
ALTER TABLE `salary_payment`
  ADD CONSTRAINT `salary_payment_ibfk_1` FOREIGN KEY (`monthID`) REFERENCES `month` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salary_payment_ibfk_2` FOREIGN KEY (`workerID`) REFERENCES `worker` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sites`
--
ALTER TABLE `sites`
  ADD CONSTRAINT `sites_ibfk_1` FOREIGN KEY (`sectorID`) REFERENCES `sectors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `worker_assign`
--
ALTER TABLE `worker_assign`
  ADD CONSTRAINT `worker_assign_ibfk_1` FOREIGN KEY (`monthID`) REFERENCES `month` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worker_assign_ibfk_2` FOREIGN KEY (`siteID`) REFERENCES `sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worker_assign_ibfk_3` FOREIGN KEY (`workerID`) REFERENCES `worker` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `worker_attendance`
--
ALTER TABLE `worker_attendance`
  ADD CONSTRAINT `worker_attendance_ibfk_1` FOREIGN KEY (`monthID`) REFERENCES `month` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `worker_attendance_ibfk_2` FOREIGN KEY (`wrokerID`) REFERENCES `worker` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
