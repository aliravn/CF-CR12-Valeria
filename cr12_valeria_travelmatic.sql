-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 21, 2019 at 04:51 PM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr12_valeria_travelmatic`
--

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `locationID` int(11) NOT NULL,
  `zipcode` varchar(10) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `lat` decimal(11,8) NOT NULL,
  `lng` decimal(11,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`locationID`, `zipcode`, `country`, `city`, `address`, `lat`, `lng`) VALUES
(1, '111-0032', 'Japan', 'Tokyo', '2-3-1 Asakusa', '35.71482600', '139.79705200'),
(2, '612-0882', 'Japan', 'Kyoto', '68 Fukakusa Yabunouchicho', '34.96729800', '135.77267200'),
(3, '730-0051', 'Japan', 'Hiroshima', '1-10 Otemachi', '34.39710900', '132.45341000'),
(4, '612-0862', 'Japan', 'Kyoto', '294 Kiyomizu', '34.99507900', '135.78476100'),
(5, '1100', 'Austria', 'Vienna', 'Triester Strasse 64', '48.16836300', '16.34860000'),
(6, '1030', 'Austria', 'Vienna', 'Wien Mitte Mall', '48.20706100', '16.38538500'),
(7, '1020', 'Austria', 'Vienna', 'Praterstrasse 1', '48.21313500', '16.37990100'),
(8, '1020', 'Austria', 'Vienna', 'Lassallestrasse 6', '48.00000000', '16.00000000'),
(9, '123456', 'Russia', 'Moscow', 'Olimpiyskiy Prospekt, 16', '55.78286700', '37.62650500'),
(10, '1110', 'Austria', 'Vienna', 'Guglgasse 8', '48.18552000', '16.41952300'),
(11, '9020', 'Austria', 'Klagenfurt', 'Messeplatz 1', '46.63680200', '14.31480900'),
(12, '1020', 'Austria', 'Vienna', 'Meiereistrasse 7', '48.12345600', '16.98023400'),
(13, '1100', 'Austria', 'Vienna', 'Somestreet 12', '48.00000000', '25.00000000'),
(14, '1111', 'TESTCOUNTRY', 'TESTCITY', 'TESTSTREET 10', '44.93396200', '20.32746800');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postID` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `fk_location` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `homepage` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `poi_type` enum('restaurant','event','place') DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `event_when` varchar(20) DEFAULT NULL,
  `price` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `name`, `fk_location`, `image`, `created`, `homepage`, `type`, `poi_type`, `phone`, `description`, `event_when`, `price`) VALUES
(1, 'Senso-ji Temple', 1, 'img/place_sensoji.jpg', '2019-08-30 22:00:00', 'http://www.senso-ji.jp', NULL, 'place', NULL, 'Completed in 645, this temple, Tokyos oldest, was built to honor Kannon, the goddess of mercy.', NULL, NULL),
(2, 'Fushimi Inari-taisha Shrine', 2, 'img/place_fushimiinari.jpg', '2018-09-19 22:00:00', 'http://inari.jp/', NULL, 'place', NULL, 'Mountainside Shinto shrine dating from 711 A.D. featuring a path with hundreds of traditional gates.', NULL, NULL),
(3, 'Atomic Bomb Dome', 3, 'img/place_atomicbombdome.jpg', '2019-08-29 22:00:00', 'http://www.city.hiroshima.lg.jp', NULL, 'place', NULL, 'Iconic remains of the Industrial Promotion Hall which was destroyed by the atomic bomb during WWII.', NULL, NULL),
(4, 'Kiyomizu-dera Temple', 4, 'img/place_kiyomizu.jpg', '2019-08-09 22:00:00', 'www.kiyomizudera.or.jp', NULL, 'place', NULL, 'Iconic Buddhist temple on Mount Otowa known for the scenic views afforded from its sizable veranda.', NULL, NULL),
(5, 'Vapiano', 5, 'img/rest_vapiano.jpg', '2019-08-31 22:00:00', 'www.mjam.net', 'italian', 'restaurant', '+43 1 6008282', 'some text here', NULL, NULL),
(6, 'Sushi Cross', 6, 'img/rest_sushicross.jpg', '2019-08-10 22:00:00', 'www.sushi-cross.at', 'asian', 'restaurant', '+43 1 2121210', 'some text here', NULL, NULL),
(7, 'el Gaucho', 7, 'img/rest_elgaucho.jpg', '2019-08-21 22:00:00', 'www.elgaucho.at', 'steakhouse', 'restaurant', '+43 680 2365804', 'some text here', NULL, NULL),
(8, 'Donburi', 8, 'img/rest_asian.jpg', '2019-09-10 22:00:00', 'www.donburiasiacuisine.at', 'asian', 'restaurant', '+43 1 7200034', 'some text here', NULL, NULL),
(9, 'BonJovi', 9, 'img/event_bonjovi.jpg', '2019-08-31 22:00:00', 'www.oeticket.at', NULL, 'event', NULL, NULL, '2019-05-31 19:00:00', '75 EUR'),
(10, 'Lindsey Stirling', 10, 'img/event_stirling.jpg', '2019-09-16 22:00:00', 'www.oeticket.at', NULL, 'event', NULL, NULL, '2019-09-16 21:00:00', '55 EUR'),
(11, 'Deep Purple', 11, 'img/event_deeppurple.jpg', '2019-08-31 22:00:00', 'www.oeticket.at', NULL, 'event', NULL, NULL, '2019-09-20 20:00:00', '100 EUR'),
(12, 'Rammstein', 12, 'img/event_rammstein.jpg', '2019-08-10 22:00:00', 'www.oeticket.at', NULL, 'event', NULL, NULL, '2019-08-23 19:00:00', '150 EUR'),
(17, 'TEST CAT BUN', 13, 'img/avatar_default.jpg', '2019-08-10 22:00:00', 'www.oeticket.at', '', 'event', '', '', '2019-08-23 19:00:00', '150 EUR'),
(27, 'TEST RESTAURANT', 13, 'https://assets.fireside.fm/file/fireside-images/podcasts/images/b/bc7f1faf-8aad-4135-bb12-83a8af679756/cover_medium.jpg', '2019-09-18 07:00:00', 'www.test.at', 'TEST CUSINE1', 'restaurant', '00000000000', 'some text here', '', ''),
(28, 'TEST EVENT', 14, 'https://assets.fireside.fm/file/fireside-images/podcasts/images/b/bc7f1faf-8aad-4135-bb12-83a8af679756/cover_medium.jpg', '2019-09-21 11:37:05', 'www.test.at', '', 'event', '', 'some text here', '2019-01-16 17:00', '150'),
(29, 'TEST PLACE', 14, 'https://assets.fireside.fm/file/fireside-images/podcasts/images/b/bc7f1faf-8aad-4135-bb12-83a8af679756/cover_medium.jpg', '2019-09-21 11:40:20', 'homepage', 'museum', 'place', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `useremail` varchar(50) DEFAULT NULL,
  `userpass` varchar(255) DEFAULT NULL,
  `userpic` varchar(255) DEFAULT 'img/avatar_default.jpg',
  `regdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `userpriv` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `useremail`, `userpass`, `userpic`, `regdate`, `userpriv`) VALUES
(3, 'Alira', 'alira@ex.org', '2785dc722d888c0b5bed8c746271ba4e67681b1e15f222ca6aecfd1e8ec356b0', 'img/avatar_alira.jpg', NULL, 1),
(4, 'alex', 'alex@ex.org', 'e052ceb5f1bcde55b3626bd9554aa96d40eb6fa80a8c6912a56c30578242cd03', 'img/avatar_alex.jpg', '2019-09-20 16:59:41', 1),
(5, 'testUser', 'test_user@ex.org', '6dcaea20baeb1cbfb8f0d7f52fe521787fad195ba3b54cdaf641a156b91f783e', 'img/avatar_default.jpg', '2019-09-20 17:34:38', 0),
(7, 'user1', 'user1@ex.org', '4e240df41bc843ee483fb59c1175242df32339a4e30d104d049c8d6f651607f6', 'img/avatar_default.jpg', '2019-09-21 13:11:32', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`locationID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `fk_location` (`fk_location`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `locationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`fk_location`) REFERENCES `locations` (`locationID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
