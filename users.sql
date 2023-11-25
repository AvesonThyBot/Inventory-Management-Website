-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2023 at 08:35 PM
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
-- Database: `inventorydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_text` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password_text`) VALUES
(1, 'Aveson', 'b', 'a@gmail.com', 'a'),
(2, '2', '1', 'ajnkhdf@Gmail.com', '$2y$10$xL49y0Rs/9BUiO48.r4.xe4fCINczvYvsByYrjWf9hTosBSbtjRSe'),
(3, 'test', 'lasttest', 'test@email.com', '$2y$10$0PMhlneF7vr3DyzIvXc9.u/Y.ppQi/4I.UMrX0ETGuJqSeda0rlNW'),
(4, 'test', 'teste', 'testes@gmail.com', '$2y$10$MpAuCSlLhdCj6/tHMFgJEulxIB4IQhwfMBjZhuBFhFP02MQCiraPm'),
(5, 'qwerty', 'qwerty', 'good@email.com', '$2y$10$USOtGhilHwG9R9IApXd8x.XNAsZC54b9B.b74CSrdJUtyJNWWDdDW'),
(6, 'a', 'a', 'aaaa@gmail.com', '$2y$10$zzI/yN0649BHeCFU63vxw.eCXC6S1pL52j1RbTM39tEylxX3Gmak.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
