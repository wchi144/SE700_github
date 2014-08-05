-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2014 at 04:07 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `se700_twitter`
--

-- --------------------------------------------------------

--
-- Table structure for table `networking`
--

CREATE TABLE IF NOT EXISTS `networking` (
  `user_id` bigint(20) NOT NULL,
  `friend_id` bigint(20) NOT NULL,
  `city` varchar(160) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `networking`
--

INSERT INTO `networking` (`user_id`, `friend_id`, `city`, `location_id`) VALUES
(761, 2651629326, 'San Francisco', 3518),
(922, 492016347, 'New York', 2781),
(929, 18171729, 'Seattle', 3653),
(989, 2733126149, 'Anaheim', 104),
(997, 2202249985, 'Angeles', 110),
(1013, 234905536, 'Amsterdam', 102),
(1154, 14869173, 'Evans', 1287),
(1183, 456412863, 'Florida', 1356),
(1497, 20528911, 'New York', 2781),
(1952, 164324967, 'Beaverton', 308),
(2391, 224973292, 'Belfast', 327),
(2565, 15085420, 'San Francisco', 3518),
(2623, 15474029, 'London', 2280),
(3519, 359474789, 'Colora', 866),
(3634, 2163332059, 'Ahmedabad', 28),
(3936, 55137824, 'Berkeley', 359),
(4233, 2251226166, 'Seattle', 3653),
(4666, 1032461587, 'Bangalore', 236),
(4711, 475738679, 'Brighton', 505),
(5149, 603773266, 'Anaheim', 104),
(5177, 1068890174, 'Ankara', 112),
(5212, 27819083, 'Angeles', 110),
(5357, 2597890890, 'Ada', 17),
(5791, 355136209, 'London', 2280),
(6246, 1161218640, 'Cheshire', 755),
(7512, 624534359, 'Barcelona', 254),
(7698, 66934681, 'Berkeley', 359),
(8381, 380735359, 'Seattle', 3653),
(8997, 253663760, 'Austin', 187),
(9272, 19771464, 'Ann Arbor', 113),
(9361, 318462085, 'New York', 2781),
(9433, 54703886, 'Cape Town', 637),
(9480, 253016832, 'Angeles', 110),
(10051, 48289458, 'Oregon', 2946),
(10198, 2568043026, 'Davao City', 997),
(10221, 6068, 'Barcelona', 254),
(10237, 22554025, 'Austin', 187),
(10433, 220633093, 'Cali', 608),
(10727, 2651629326, 'San Francisco', 3518),
(10904, 16485796, 'New York', 2781),
(10933, 174877698, 'San Francisco', 3518),
(11197, 1788591, 'Austin', 187),
(11214, 76013563, 'London', 2280),
(11250, 47370530, 'Altrincham', 88),
(11497, 90499255, 'Ada', 17),
(11818, 2444084383, 'London', 2280),
(12350, 2447916780, 'San Francisco', 3518),
(12504, 102029861, 'London', 2280),
(12506, 2554973395, 'Antalya', 118),
(12715, 7664642, 'San Francisco', 3518),
(12912, 1310778468, 'Anstey', 117),
(13044, 2231644160, 'Ada', 17),
(13192, 247842830, 'Amsterdam', 102),
(13263, 387553310, 'Florida', 1356),
(13265, 455110234, 'London', 2280),
(13302, 11363072, 'Bangalore', 236),
(13364, 335030382, 'Honolulu', 1788),
(13567, 2411247186, 'Athens', 172),
(13697, 542028832, 'London', 2280),
(13833, 2520910400, 'Angeles', 110),
(14563, 385860899, 'Paris', 3030),
(15253, 1915465831, 'Angeles', 110),
(16133, 2536814918, 'Albany', 45),
(16893, 169192943, 'Ontario', 2933),
(18673, 196841165, 'New Haven', 2764),
(18713, 19092099, 'Ashington', 161),
(19813, 14889308, 'Perth', 3096),
(22203, 166155468, 'Boston', 446),
(23513, 18818733, 'Bourne', 455),
(24103, 2591873671, 'Boston', 446),
(24993, 61726497, 'Colombo', 863),
(26173, 21032767, 'Cambridge', 617),
(26703, 1668100142, 'Cali', 608),
(32873, 301570862, 'Atlanta', 174),
(34163, 29699957, 'Bath', 286),
(36623, 37599351, 'Angeles', 110),
(36753, 455364872, 'Cali', 608),
(36863, 231522509, 'Boston', 446),
(42073, 241857206, 'Bangalore', 236),
(47333, 74991835, 'Dublin', 1116),
(48213, 14344764, 'Berlin', 363),
(50433, 23663732, 'Honolulu', 1788),
(50993, 2549722310, 'Bandar Seri Begawan', 233),
(51723, 16103073, 'Portsmouth', 3215),
(52833, 2337233760, 'Cedar Rapids', 698),
(56873, 6250472, 'Sydney', 3951),
(58323, 572317680, 'Saskatoon', 3607),
(60163, 2598194677, 'London', 2280),
(60203, 276028820, 'London', 2280),
(61563, 9554942, 'Ada', 17),
(61663, 2456905670, 'London', 2280),
(62783, 921733909, 'Angeles', 110),
(63803, 1918403492, 'Abuja', 13),
(64623, 17393540, 'London', 2280),
(70053, 33208389, 'Brussels', 539),
(71123, 67075609, 'Arlington', 145),
(71693, 146503710, 'Minneapolis', 2582),
(73343, 386665560, 'Boston', 446),
(75853, 98963477, 'Ada', 17),
(79773, 899731753, 'London', 2280),
(80523, 732549140, 'Amsterdam', 102),
(80973, 34486252, 'Ada', 17),
(83673, 271205923, 'Bourne', 455),
(91283, 104924891, 'Angeles', 110),
(115053, 183755449, 'Merida', 2524),
(229523, 21278138, 'Ada', 17),
(284553, 91243832, 'Las Vegas', 2167),
(355203, 15993122, 'Ashington', 161),
(356683, 24586517, 'Auckland', 182),
(383323, 182314545, 'Bourne', 455),
(397713, 154267096, 'Barrington', 269),
(416963, 2646605622, 'Oregon', 2946),
(420363, 344348446, 'Adel', 21),
(536903, 20056026, 'Bucharest', 544),
(590433, 16043114, 'Ada', 17),
(608043, 393088142, 'Singapore', 3728),
(608473, 464859826, 'Boston', 446),
(610673, 610797347, 'Angeles', 110),
(611833, 23407139, 'Bourne', 455),
(611913, 95745179, 'Seattle', 3653);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
