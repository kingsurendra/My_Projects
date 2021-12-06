-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2021 at 06:52 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tecstdportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `pecentages`
--

CREATE TABLE `pecentages` (
  `Name` varchar(20) NOT NULL,
  `Rollnum` varchar(10) NOT NULL,
  `year` varchar(1) NOT NULL,
  `semester` varchar(1) NOT NULL,
  `percentage` varchar(5) NOT NULL,
  `Department` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pecentages`
--

INSERT INTO `pecentages` (`Name`, `Rollnum`, `year`, `semester`, `percentage`, `Department`) VALUES
('Surendra', '17hu1a0548', '3', '2', '85.12', 'cse'),
('Surendra', '17hu1a0548', '4', '1', '85.25', 'cse');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `Name` varchar(20) NOT NULL,
  `Rollnum` varchar(10) NOT NULL,
  `Deptname` char(5) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Cpassword` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`Name`, `Rollnum`, `Deptname`, `Password`, `Cpassword`) VALUES
('Surendra', '17hu1a0548', 'cse', 'Suri@123', 'Suri@123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
