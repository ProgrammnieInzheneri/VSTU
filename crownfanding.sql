-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2019 at 05:52 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crownfanding`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `login` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`, `name`) VALUES
(12, 'admin', '71bbd5ec794791be9df2d33b39bb33f6ddbfa985f3ea31f6b0f27f1e622f5d20', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL DEFAULT 0,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `requestedFunds` float NOT NULL,
  `currentFunds` float NOT NULL,
  `tStamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `period` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `userId`, `name`, `description`, `requestedFunds`, `currentFunds`, `tStamp`, `period`) VALUES
(2, 0, 'Дипломная работа', 'Требуется собрать средства на заказ дипломной работы Требуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работы', 1000000, 0, '2019-10-15 14:27:50', 999),
(3, 4, 'Вфцвфв фцвфвцвфцфц', 'Требуется собрать средства на заказ дипломной работы Требуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работы Требуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работы Требуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работы Требуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работыТребуется собрать средства на заказ дипломной работы', 100000, 0, '2019-11-14 18:03:19', -1),
(4, 4, 'awdawdwawda', 'awdawdwada', 0, 0, '2019-11-14 18:26:29', 0),
(5, 5, 'wdadawd', 'awdwada', 2112, 0, '2019-11-14 18:32:18', 12),
(6, 5, 'lkjlkjlkjkl', 'efreferf', 64565, 0, '2019-11-14 18:32:57', 56);

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE `updates` (
  `id` int(11) NOT NULL,
  `tableName` varchar(128) NOT NULL,
  `operation` varchar(128) NOT NULL,
  `rowId` int(11) NOT NULL,
  `tStamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `updates`
--

INSERT INTO `updates` (`id`, `tableName`, `operation`, `rowId`, `tStamp`) VALUES
(55, 'projects', 'delete', 1, '2019-10-08 06:55:30'),
(57, 'projects', 'edit', 2, '2019-11-14 13:38:10'),
(58, 'projects', 'add', 3, '2019-11-14 18:03:19'),
(59, 'projects', 'add', 4, '2019-11-14 18:26:29'),
(60, 'projects', 'add', 5, '2019-11-14 18:32:18'),
(61, 'projects', 'add', 6, '2019-11-14 18:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `login` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `adress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `password`, `email`, `phone`, `adress`) VALUES
(2, 'Зелибоба иБусинка', 'Habrabro', 'b895a3a12c9ae30234ecfd4bec0347a30640b9e23195a6f5b7c4edab46a31be5', 'habrabro@gmail.com', 89054343348, 'г. Волгоград, ул. Аллея Героев'),
(3, 'awdawd', 'awd', 'bc1a9378afb03fbcb3cc53d851b16abc0d996fc6e88c04aaaafb0a662cf3fd08', 'habrabro@gmail.com', 0, 'awd'),
(4, 'Ненавижу блять Людей', 'hate', 'ca05ab5a595ca0b36ea5c403bfc6779e33a8f6be8f8376294d7d71436a987d5b', 'fuckyou@gmail.com', 0, ''),
(5, 'Зелибоба иКоржик', 'admin', '71bbd5ec794791be9df2d33b39bb33f6ddbfa985f3ea31f6b0f27f1e622f5d20', 'habrabro@gmail.com', 89053993134, 'г. Волгоград, ул. Аллея Героев, 14, 88');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `updates`
--
ALTER TABLE `updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
