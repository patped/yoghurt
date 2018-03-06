-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 02. Mar, 2018 11:26 AM
-- Server-versjon: 5.7.21
-- PHP Version: 5.6.33-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `v18db125`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `BrukerDatabase`
--

CREATE TABLE `BrukerDatabase` (
  `brukerid` smallint(6) NOT NULL,
  `passord` varchar(10) DEFAULT NULL,
  `fornavn` varchar(14) DEFAULT NULL,
  `etternavn` varchar(14) DEFAULT NULL,
  `telefonnummer` int(11) DEFAULT NULL,
  `adminrettighet` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `BrukerDatabase`
--

INSERT INTO `BrukerDatabase` (`brukerid`, `passord`, `fornavn`, `etternavn`, `telefonnummer`, `adminrettighet`) VALUES
(1, 'mik', 'kim', 'næss', 97640345, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `BrukerDatabase`
--
ALTER TABLE `BrukerDatabase`
  ADD PRIMARY KEY (`brukerid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
