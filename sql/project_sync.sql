-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2022 at 05:47 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_sync`
--

-- --------------------------------------------------------

--
-- Table structure for table `gebruikers`
--

CREATE TABLE `gebruikers` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `wachtwoord` varchar(50) NOT NULL,
  `soort` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gebruikers`
--

INSERT INTO `gebruikers` (`id`, `naam`, `email`, `wachtwoord`, `soort`) VALUES
(2, 'consultant01', 'consultant01@mail.com', '12345678', 'consultant'),
(3, 'consultant02', 'consultant02@mail.com', '12345678', 'consultant'),
(4, 'admin', 'admin@mail.com', '12345678', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `kostenomschrijving`
--

CREATE TABLE `kostenomschrijving` (
  `id` int(11) NOT NULL,
  `omschrijving` varchar(50) NOT NULL,
  `kostencode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kostenomschrijving`
--

INSERT INTO `kostenomschrijving` (`id`, `omschrijving`, `kostencode`) VALUES
(1, 'reiskosten', '100'),
(2, 'boeken', '101'),
(3, 'mobiele telefoon', '200'),
(4, 'laptop', '201'),
(5, 'pr', '300'),
(6, 'lease-auto', '301');

-- --------------------------------------------------------

--
-- Table structure for table `projectkosten`
--

CREATE TABLE `projectkosten` (
  `id` int(11) NOT NULL,
  `consultant` varchar(50) NOT NULL,
  `project` varchar(50) NOT NULL,
  `omschrijving` varchar(50) NOT NULL,
  `kilometers` varchar(50) NOT NULL,
  `kosten` varchar(50) NOT NULL,
  `declaratie` varchar(50) NOT NULL,
  `datum` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projectkosten`
--

INSERT INTO `projectkosten` (`id`, `consultant`, `project`, `omschrijving`, `kilometers`, `kosten`, `declaratie`, `datum`) VALUES
(1, 'tim', 'KPN 002', 'reiskosten', 'N.v.t.', '50', '50', '15-02-2022'),
(2, 'consultant01', 'KPN 002', 'boeken', 'N.v.t.', '50', '50', '15-02-2022'),
(3, 'consultant01', 'KPN 002', 'mobiele telefoon', 'N.v.t.', '100', '100', '15-02-2022'),
(4, 'consultant02', 'ING', 'reiskosten', 'N.v.t.', '100', '100', '15-02-2022'),
(5, 'consultant02', 'RAI', 'boeken', 'N.v.t.', '55', '55', '15-02-2022');

-- --------------------------------------------------------

--
-- Table structure for table `projectomschrijving`
--

CREATE TABLE `projectomschrijving` (
  `id` int(11) NOT NULL,
  `projectcode` varchar(50) NOT NULL,
  `project` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projectomschrijving`
--

INSERT INTO `projectomschrijving` (`id`, `projectcode`, `project`) VALUES
(2, '101', 'KPN 002'),
(3, '111', 'KLM - rood'),
(4, '202', 'Tele2'),
(5, '222', 'Schiphol'),
(6, '303', 'ING'),
(7, '333', 'RAI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kostenomschrijving`
--
ALTER TABLE `kostenomschrijving`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projectkosten`
--
ALTER TABLE `projectkosten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projectomschrijving`
--
ALTER TABLE `projectomschrijving`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kostenomschrijving`
--
ALTER TABLE `kostenomschrijving`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `projectkosten`
--
ALTER TABLE `projectkosten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `projectomschrijving`
--
ALTER TABLE `projectomschrijving`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
