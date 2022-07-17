-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2022 at 08:03 PM
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
-- Database: `tas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `username` varchar(99) NOT NULL,
  `email` varchar(99) NOT NULL,
  `password` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `username`, `email`, `password`) VALUES
(1, 'admin', 'adminfake@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendanceID` int(11) NOT NULL,
  `teacherName` varchar(99) NOT NULL,
  `attendanceDate` date NOT NULL,
  `attendanceTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacherID` int(11) NOT NULL,
  `teacherName` varchar(99) NOT NULL,
  `teacherTelNo` varchar(99) NOT NULL,
  `teacherEmail` varchar(99) NOT NULL,
  `teacherStatus` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacherID`, `teacherName`, `teacherTelNo`, `teacherEmail`, `teacherStatus`) VALUES
(40, 'Iker Casillas', '0111235541', 'casillaslegend@gmail.com', 'Tetap'),
(48, 'Frank Lampard', '0169332988', 'franklampard8@gmail.com', 'Tetap'),
(49, 'Harry Maguire', '0144447444', 'maguiretiang@gmail.com', 'Tetap'),
(50, 'John Terry', '01696965431', 'captainterry26@gmail.com', 'Pindah'),
(51, 'Kevin De Bruyne', '0199973332', 'debruyne@gmail.com', 'Tetap'),
(52, 'Kylian Mbappe', '01675888992', 'kmbappepsg@gmail.com', 'Tetap'),
(55, 'Lionel Messi', '01102487755', 'messigoat10@gmail.com', 'Tetap'),
(56, 'Luis Diaz', '0133299904', 'luizdiaz@gmail.com', 'Pindah'),
(57, 'Luiz Suarez', '0193217804', 'suarezgigit@gmail.com', 'Pindah'),
(58, 'Mason Mount', '0122121876', 'masonmount@gmail.com', 'Pindah'),
(61, 'Mohamed Salah', '01123987655', 'salahtaksalah@gmail.com', 'Tetap'),
(64, 'Ngolo Kante', '0155329985', 'kantefit@gmail.com', 'Pindah'),
(65, 'Pep Guardiola', '0177998542', 'pepguardiola@gmail.com', 'Pindah'),
(66, 'Rio Ferdinand', '0135098755', 'ferdinandsalty@gmail.com', 'Pindah'),
(67, 'Ross Barkley', '0149998754', 'rossbarkley@gmail.com', 'Pindah'),
(68, 'Sadio Mane', '01148776098', 'sadiomane@gmail.com', 'Pindah'),
(69, 'Sergio Aguero', '0149077005', 'aguerooo@gmail.com', 'Pindah'),
(70, 'Sergio Ramos', '0166669666', 'ramosredcard@gmail.com', 'Pindah'),
(72, 'Wayne Rooney', '0178099944', 'rooney@gmail.com', 'Pindah'),
(73, 'Zlatan Ibrahimovic', '0129855579', 'ibrahimovic@gmail.com', 'Pindah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendanceID`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacherID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
