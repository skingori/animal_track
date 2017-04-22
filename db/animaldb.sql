-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 22, 2017 at 07:39 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `animaldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `animal_device_table`
--

CREATE TABLE `animal_device_table` (
  `animal_device_id` int(11) NOT NULL,
  `animal_device_animal_id` varchar(20) NOT NULL,
  `animal_device_device_id` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `animal_device_table`
--

INSERT INTO `animal_device_table` (`animal_device_id`, `animal_device_animal_id`, `animal_device_device_id`) VALUES
(5, '08976', '2434324');

-- --------------------------------------------------------

--
-- Table structure for table `animal_location`
--

CREATE TABLE `animal_location` (
  `animal_location_id` int(11) NOT NULL,
  `animal_location_animal_device_id` int(11) NOT NULL,
  `animal_location_acquisition_time` datetime NOT NULL,
  `animal_xcoordinate` varchar(20) NOT NULL,
  `animal_ycoordinate` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `animal_location`
--

INSERT INTO `animal_location` (`animal_location_id`, `animal_location_animal_device_id`, `animal_location_acquisition_time`, `animal_xcoordinate`, `animal_ycoordinate`) VALUES
(1, 8976, '2017-04-22 04:26:59', '34343434', '-3434343');

-- --------------------------------------------------------

--
-- Table structure for table `animal_table`
--

CREATE TABLE `animal_table` (
  `animal_id` varchar(20) NOT NULL,
  `animal_name` varchar(20) NOT NULL,
  `animal_description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `animal_table`
--

INSERT INTO `animal_table` (`animal_id`, `animal_name`, `animal_description`) VALUES
('08976', 'Hyena', 'The hyena'),
('123451', 'Elephant', 'Lives in Mount kenya forest');

-- --------------------------------------------------------

--
-- Table structure for table `device_table`
--

CREATE TABLE `device_table` (
  `device_id` varchar(20) NOT NULL,
  `device_name` varchar(20) NOT NULL,
  `device_description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device_table`
--

INSERT INTO `device_table` (`device_id`, `device_name`, `device_description`) VALUES
('2434324', 'Hp', 'sadsdasdas');

-- --------------------------------------------------------

--
-- Table structure for table `login_table`
--

CREATE TABLE `login_table` (
  `admin_id` int(11) NOT NULL,
  `admin_user` varchar(20) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `login_rank` smallint(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_table`
--

INSERT INTO `login_table` (`admin_id`, `admin_user`, `admin_password`, `login_rank`) VALUES
(2, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 1);

-- --------------------------------------------------------

--
-- Table structure for table `markers`
--

CREATE TABLE `markers` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `address` varchar(80) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `markers`
--

INSERT INTO `markers` (`id`, `name`, `address`, `lat`, `lng`, `type`) VALUES
(9, 'Hyena', '135-101 Nairobi', -13.434340, 33.656559, 'Mammals'),
(10, 'Hyena', '355-232 Kiambu', 0.023600, 17.906200, 'Mammals'),
(11, 'Hyena', '2323-888 Maasai Mara', -1.416667, 34.916668, 'Mammals'),
(12, 'Hyena', '125- 90909 Mount Kenya', 0.150000, 37.316700, 'Mammals');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal_device_table`
--
ALTER TABLE `animal_device_table`
  ADD PRIMARY KEY (`animal_device_id`);

--
-- Indexes for table `animal_location`
--
ALTER TABLE `animal_location`
  ADD PRIMARY KEY (`animal_location_id`);

--
-- Indexes for table `animal_table`
--
ALTER TABLE `animal_table`
  ADD PRIMARY KEY (`animal_id`);

--
-- Indexes for table `device_table`
--
ALTER TABLE `device_table`
  ADD PRIMARY KEY (`device_id`);

--
-- Indexes for table `login_table`
--
ALTER TABLE `login_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal_device_table`
--
ALTER TABLE `animal_device_table`
  MODIFY `animal_device_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `animal_location`
--
ALTER TABLE `animal_location`
  MODIFY `animal_location_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `login_table`
--
ALTER TABLE `login_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `markers`
--
ALTER TABLE `markers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
