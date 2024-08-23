-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2024 at 01:44 PM
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
-- Database: `my_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `fyear_id` varchar(255) NOT NULL,
  `pan` varchar(255) NOT NULL,
  `party_name` varchar(255) NOT NULL,
  `address` varchar(300) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `receipt_amount` int(255) NOT NULL,
  `deposite_bank` varchar(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `ref_no` varchar(255) NOT NULL,
  `trans_date` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `user_id`, `fyear_id`, `pan`, `party_name`, `address`, `city`, `state`, `pincode`, `mobile`, `email`, `receipt_amount`, `deposite_bank`, `payment_mode`, `bank_name`, `ref_no`, `trans_date`, `created_at`, `status`) VALUES
(1, 1, '', 'A245S5D2A', 'DEMO_1', '302, Shree Kunj Heights, Makarpura GIDC Ring Road', 'bhilwara', 'Rajasthan', '311001', '01234567890', 'deno_1@gmail.com', 150000, 'Axis Bank', 'Cheque', 'sbi', '1023654789', '2024-02-04', '2024-05-02 18:30:00', 1),
(2, 1, '', '1234567809', 'Demo_2', 'address_demo_2', 'bhilwara', 'Andhra Pradesh', '311001', '01234567890', 'deno_2@gmail.com', 50200, 'Axis Bank', 'Cheque', 'sbi', '1023654789', '2024-02-20', '2024-05-02 18:30:00', 1),
(3, 1, '', '111145552d', 'Demo_3', 'address_demo_3', 'bhilwara', 'Andhra Pradesh', '311001', '01234567890', 'deno_3@gmail.com', 1050000, 'Axis Bank', 'NEFT', 'sbi', '1023654789', '2024-05-05', '2024-05-06 18:30:00', 1),
(4, 1, '', '1234567809', 'Demo_4', 'address_demo_4', 'bhilwara', 'Andhra Pradesh', '311001', '01234567890', 'deno_4@gmail.com', 150000, 'Axis Bank', 'NEFT', 'sbi', '1023654789', '2024-02-05', '2024-05-06 18:30:00', 1),
(5, 1, '2023-24', '1234567809', 'Demo_5', 'address_demo_5', 'bhilwara', 'Dadar and Nagar Haveli', '311001', '01234567890', 'deno_5@gmail.com', 1000, 'Axis Bank', 'Cheque', 'sbi', '1023654789', '2024-02-25', '2024-05-06 18:30:00', 0),
(6, 2, '2022-23', '1234567809', 'Demo_6', 'address_demo_6', 'bhilwara', 'Haryana', '311001', '01234567890', 'deno_6@gmail.com', 700, 'Axis Bank', 'NEFT', 'sbi', '1023654789', '2024-02-06', '2024-05-07 18:30:00', 0),
(7, 2, '2022-23', '111156515d', 'Demo_7', 'address_demo_7', 'bhilwara', 'Andhra Pradesh', '311001', '01234567890', 'deno_7@gmail.com', 10000, 'Axis Bank', 'RTGS', 'sbi', '1023654789', '2024-03-26', '2024-05-09 18:30:00', 0),
(8, 2, '2022-23', 'A245S5D2A', 'Demo_8', 'address_demo_8', 'bhilwara', 'Andhra Pradesh', '311001', '01234567890', 'deno_8@gmail.com', 500, 'Axis Bank', 'Cheque', 'sbi', '1023654789', '2024-12-26', '2024-05-09 18:30:00', 1),
(9, 2, '2022-23', '11iu1151841', 'Demo_9', 'address_demo_9', 'bhilwara', 'Andhra Pradesh', '311001', '01234567890', 'deno_9@gmail.com', 5000, 'Axis Bank', 'Cheque', 'sbi', '1023654789', '2024-08-04', '2024-05-09 18:30:00', 0),
(10, 2, '2022-23', '1234567809', 'Demo_10', 'address_demo_10', 'bhilwara', 'Andhra Pradesh', '311001', '01234567890', 'deno_10@gmail.com', 600, 'Axis Bank', 'Cheque', 'sbi', '1023654789', '2024-04-08', '2024-05-09 18:30:00', 0),
(11, 3, '2022-23', '1111dcvdv4', 'Demo_11', 'address_demo_11', 'bhilwara', 'Andhra Pradesh', '311001', '01234567890', 'deno_11@gmail.com', 100, 'Axis Bank', 'Cheque', 'sbi', '1023654789', '2024-06-05', '2024-05-09 18:30:00', 1),
(12, 3, '2023-24', '25416541H', 'Demo_12', 'address_demo_12', 'bhilwara', 'Gujarat', '311001', '54844565230', 'deno_12@gmail.com', 100000, 'Axis Bank', 'RTGS', 'sbi', '685653263', '2024-05-24', '2024-05-12 18:30:00', 0),
(13, 3, '2023-24', '369852147', 'DEMO_13', 'bhilwara', 'bhilwara', 'Rajasthan', '311001', '01234567890', 'demo_13@gmail.com', 10000, 'Axis Bank', 'UPI', 'sbi', '1023654789', '2024-05-24', '2024-05-13 18:30:00', 1),
(14, 3, '2022-23', '1745224', 'DEMO_14', 'demo_address', 'bhilwara', 'Rajasthan', '311001', '01234567890', 'demo_14@gmail.com', 10000, 'Axis Bank', 'Cash', 'sbi', '1023654789', '2024-05-18', '2024-05-13 18:30:00', 0),
(15, 4, '2022-23', 'A245S5D2A', 'DEMO_15', 'demo_address15', 'bhilwara', 'Jharkhand', '311001', '', '', 40000, 'Axis Bank', 'UPI', 'sbi', '1023654789', '2024-05-15', '2024-05-13 18:30:00', 0),
(16, 4, '2022-23', '1234567809', 'DEMO_71', 'demo_address123address', 'bhilwara', 'Andhra Pradesh', '313110', '01234567890', 'harshita1soni23@gmail.com', 600, 'Axis Bank', 'IMPS', 'sbi', '1023654789', '2024-05-16', '2024-05-15 18:30:00', 0),
(17, 4, '2023-24', '1234567809', 'BHARAT', 'bharat_bhilwara', 'bhilwara', 'Andhra Pradesh', '313110', '01234567890', 'harshita1soni23@gmail.com', 100000, 'Axis Bank', 'IMPS', 'sbi', '1023654789', '2024-04-17', '2024-05-15 18:30:00', 1),
(18, 4, '2022-23', 'A245S5D2A', 'BHARAT', 'asdsd', 'bhilwara', 'Andhra Pradesh', '313110', '01234567890', 'harshita1soni23@gmail.com', 100000, 'Axis Bank', 'Cheque', 'sbi', '1023654789', '2024-05-22', '2024-05-22 18:30:00', 0),
(19, 4, '2024-25', '1111', 'BHARAT', 'asdsd', 'bhilwara', 'Andhra Pradesh', '313110', '01234567890', 'harshita1soni23@gmail.com', 100000, '', 'Cheque', 'sbi', '1023654789', '2024-06-22', '2024-06-10 18:30:00', 0),
(20, 4, 'Select Financial Year', '', '', '', '', 'Andhra Pradesh', '', '', '', 0, '', 'Cheque', '', '', '', '2024-06-13 04:39:54', 0),
(21, 4, '2024-25', '', '', '', '', 'Andhra Pradesh', '', '', '', 0, '', 'Cheque', '', '', '', '2024-06-13 04:43:51', 0),
(22, 4, '2024-25', '1111', '', '', '', 'Andhra Pradesh', '', '', '', 0, '', 'Cheque', '', '', '', '2024-06-13 04:47:43', 0),
(23, 4, '', '1234567809', 'DEMO_2', 'asdsd', 'bhilwara', 'Andhra Pradesh', '313110', '01234567890', 'harshita1soni23@gmail.com', 150000, '', 'IMPS', 'sbi', '1023654789', '2024-06-29', '2024-06-13 05:05:37', 0),
(24, 4, '', '1234567809', 'VJFGJG', 'asdsd', 'bhilwara', 'Bihar', '313110', '01234567890', 'harshita1soni23@gmail.com', 600, '', 'UPI', 'sbi', '1023654789', '2024-06-21', '2024-06-13 05:06:08', 0),
(25, 4, '2024-25', '1111', 'HARSHITA', 'asdsd', 'bhilwara', 'Bihar', '313110', '01234567890', 'MUM1@GMAIL.COM', 10000, '', 'IMPS', 'sbi', '1023654789', '2024-06-06', '2024-06-13 05:13:47', 0),
(26, 4, '2024-25', '222222222', '3333333', '3333333333', 'bhilwara', 'Bihar', '313110', '01234567890', 'MUM1@GMAIL.COM', 150000, '', 'NEFT', 'sbi', '1023654789', '2024-06-13', '2024-06-13 05:16:00', 0),
(27, 4, '2024-25', '222222', '222222', 'asdsd', 'bhilwara', 'Bihar', '313110', '01234567890', 'MUM1@GMAIL.COM', 100000, '', 'Cheque', 'sbi', '1023654789', '2024-06-14', '2024-06-13 05:17:08', 1),
(28, 4, '2024-25', '666666666666', '66666666', '66666666', '6666666', 'Andaman and Nicobar Islands', '6666666', '66666666', 'harshita1soni23@gmail.com', 2147483647, '', 'RTGS', '666', '666666666', '2024-06-13', '2024-06-13 05:18:35', 1),
(29, 4, '2024-25', '1111', 'BHARAT', 'asdsd', 'bhilwara', 'Andhra Pradesh', '313110', '01234567890', 'harshita1soni23@gmail.com', 600, '', 'NEFT', 'sbi', '1023654789', '2024-06-13', '2024-06-13 05:29:32', 0),
(30, 4, '2024-25', 'A245S5D2A', '777777777', 'asdsd', 'bhilwara', 'Andhra Pradesh', '313110', '01234567890', 'harshita1soni23@gmail.com', 10000, '', 'Cheque', 'sbi', '1023654789', '2024-06-14', '2024-06-13 05:30:26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_role`, `created_at`, `status`) VALUES
(1, 'Demo_1', 'demo_1@gmail.com', '1234', 'user', '2024-05-07 16:31:48', 0),
(2, 'Demo_2', 'demo_2@gmail.com', '5678', 'admin', '2024-05-10 14:23:32', 1),
(3, 'Demo_3', 'demo_3@gmail.com', '0123', 'user', '2024-05-10 14:58:41', 1),
(4, 'harshita soni', 'admin@gmail.com', '1234', 'admin', '2024-05-16 10:46:15', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`) USING BTREE;
ALTER TABLE `receipts` ADD FULLTEXT KEY `fyear_id` (`fyear_id`,`party_name`,`pan`);
ALTER TABLE `receipts` ADD FULLTEXT KEY `trans_date` (`trans_date`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
