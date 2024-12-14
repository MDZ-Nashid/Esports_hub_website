-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 06:12 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esports_hub_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$39rJc2hYUP1h2VhmCBTT2OkbTdfWSz3ohiRRWhD7RG6twEjkgijK2', '2024-12-14 13:55:27'),
(3, 'rabby', '$2y$10$QfdSlyAVRQUZ7O/PIC/q1eNK8byNhWocVK8xx6EewhiSU0fHAF92m', '2024-12-14 16:59:39');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `game_name` varchar(255) NOT NULL,
  `game_image` varchar(255) NOT NULL,
  `game_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `game_name`, `game_image`, `game_description`) VALUES
(1, 'Valorant', 'images/valorant_image.jpg', 'A tactical first-person shooter game with unique characters and abilities.'),
(2, 'League of Legends', 'images/lol_image.jpg', 'A multiplayer online battle arena game where players control champions.'),
(3, 'CS:GO', 'images/csgo_image.jpg', 'A multiplayer first-person shooter game known for its competitive nature.'),
(4, 'Marvel Rivals', 'images/rivals.jpg', 'A multiplayer online battle arena game where players control marvel heroes.'),
(6, 'Once human', 'images/once_human.jpg', 'A multiplayer zombie survival game.'),
(18, 'Apex Legends', 'images/apex.jpg', 'A multiplayer online battle arena game where players control marvel heroes.');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `full_details` text NOT NULL,
  `news_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `full_details`, `news_time`) VALUES
(1, 'Valorant Champions Finals', 'The most awaited finals of Valorant is here...', 'Full details about the Valorant Champions Finals...', '2024-12-01 14:30:00'),
(2, 'League of Legends Update', 'A new update for League of Legends is rolling out...', 'Full patch notes and updates for League of Legends...', '2024-12-05 10:00:00'),
(3, 'CS:GO Major Tournament', 'The CS:GO Major is set to take place in Paris...', 'Detailed insights about the upcoming CS:GO Major Tournament...', '2024-12-10 16:45:00'),
(4, 'Dota 2 TI Updates', 'The International is shaping up to be an amazing event...', 'Full breakdown of teams and schedules for The International...', '2024-12-12 12:00:00'),
(5, 'Overwatch 2 New Hero', 'Blizzard has announced a new hero for Overwatch 2...', 'Complete details about the new Overwatch 2 hero...', '2024-12-15 08:15:00'),
(6, 'PUBG Global Championship', 'The PUBG Global Championship is heating up...', 'See which teams are leading the pack...', '2024-12-18 11:45:00'),
(7, 'Apex Legends Season Launch', 'The new season of Apex Legends is almost here...', 'Full preview of the upcoming Apex Legends season...', '2024-12-20 15:00:00'),
(8, 'Rocket League Esports Expansion', 'Rocket League expands its esports tournaments...', 'How Rocket League is changing its esports landscape...', '2024-12-22 13:30:00'),
(9, 'FIFA eWorld Cup News', 'The FIFA eWorld Cup qualifiers have begun...', 'Everything you need to know about the qualifiers...', '2024-12-25 18:30:00'),
(10, 'Minecraft Competitive Leagues', 'Minecraft is entering the competitive gaming scene...', 'Detailed information about Minecraft esports leagues...', '2024-12-28 09:00:00'),
(11, 'Call of Duty Warzone Update', 'Big changes are coming to Warzone this season...', 'Full patch notes and improvements in Warzone...', '2024-12-30 10:30:00'),
(12, 'Halo Infinite Tournaments', 'Halo Infinite’s competitive season begins...', 'Detailed schedules and team previews for Halo Infinite...', '2025-01-02 14:00:00'),
(13, 'Fortnite Winter Royale', 'Fortnite announces its Winter Royale event...', 'Full breakdown of the Fortnite Winter Royale tournament...', '2025-01-05 17:45:00'),
(14, 'GTA Online Expansion', 'Rockstar introduces new content for GTA Online...', 'Everything included in the GTA Online expansion...', '2025-01-08 11:30:00'),
(15, 'Riot Games New IP', 'Riot Games teases its new project...', 'Full details about Riot Games’ mysterious new IP...', '2025-01-10 19:30:00'),
(16, 'Mobile Legends Esports Growth', 'Mobile Legends continues to grow in esports...', 'How Mobile Legends is taking the world by storm...', '2025-01-12 15:00:00'),
(17, 'Smash Bros Competitive Scene', 'Smash Bros tournaments grow more competitive...', 'Everything about the competitive Smash Bros scene...', '2025-01-15 14:15:00'),
(18, 'Hearthstone New Expansion', 'Blizzard announces a new Hearthstone expansion...', 'Detailed preview of Hearthstone’s new content...', '2025-01-18 16:45:00'),
(19, 'Clash of Clans World Finals', 'Clash of Clans gears up for the World Finals...', 'Detailed schedules and team previews for Clash of Clans...', '2025-01-20 10:00:00'),
(20, 'Rainbow Six Siege Invitational', 'Rainbow Six Siege announces its Invitational...', 'Everything you need to know about the Invitational...', '2025-01-22 12:00:00'),
(22, 'Valorant has a new Update', 'kshadgbjgasidfghidsfhasdhklofsd', 'seadfasiugfgasefjighsdajklfhklsadhfjlisaf', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `game` varchar(50) NOT NULL,
  `igl_name` varchar(100) NOT NULL,
  `member1_name` varchar(100) DEFAULT NULL,
  `member2_name` varchar(100) DEFAULT NULL,
  `member3_name` varchar(100) DEFAULT NULL,
  `member4_name` varchar(100) DEFAULT NULL,
  `member5_name` varchar(100) DEFAULT NULL,
  `coach_name` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `team_name`, `game`, `igl_name`, `member1_name`, `member2_name`, `member3_name`, `member4_name`, `member5_name`, `coach_name`, `user_id`) VALUES
(1, 'Rhaegal Wings', 'valorant', 'rabbi', 'jaheen', 'biplob', 'fahim', 'sohan', 'saki', 'nashid', 2),
(2, 'Rhaegal Wings', 'valorant', 'rabbi', 'jaheen', 'biplob', 'fahim', 'sohan', 'saki', 'nashid', 2),
(3, 'Rhaegal Wings', 'valorant', 'rabbi', 'jaheen', 'biplob', 'fahim', 'sohan', 'saki', 'nashid', 2),
(4, 'Rhaegal Wings', 'valorant', 'rabbi', 'jaheen', 'biplob', 'fahim', 'sohan', 'saki', 'nashid', 2),
(5, 'Rhaegal Wings', 'valorant', 'rabbi', 'jaheen', 'biplob', 'fahim', 'sohan', 'saki', 'nashid', 3),
(6, 'Rhaegal Wings', 'valorant', 'rabbi', 'jaheen', 'biplob', 'fahim', 'sohan', 'saki', 'nashid', 3),
(7, 'Rhaegal Wings', 'valorant', 'rabbi', 'jaheen', 'biplob', 'fahim', 'sohan', 'saki', 'nashid', 3),
(8, 'Rhaegal Wings', 'valorant', 'rabbi', 'jaheen', 'biplob', 'fahim', 'sohan', 'saki', 'nashid', 3),
(9, 'Rhaegal Wings', 'valorant', 'rabbi', 'jaheen', 'biplob', 'fahim', 'sohan', 'saki', 'nashid', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tournaments`
--

CREATE TABLE `tournaments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `game` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tournaments`
--

INSERT INTO `tournaments` (`id`, `name`, `game`, `image`) VALUES
(1, 'Valorant Champions', 'Valorant', 'images/valorant.jpg'),
(2, 'League Championship', 'League of Legends', 'images/lol.jpg'),
(3, 'CSGO Blast', 'CSGO', 'images/csgo.jpg'),
(14, 'Marvel Rivals Championship', 'Marvel Rivals', 'images/rivals2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tournament_details`
--

CREATE TABLE `tournament_details` (
  `id` int(11) NOT NULL,
  `game` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `prizepool` varchar(100) NOT NULL,
  `hosted_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tournament_details`
--

INSERT INTO `tournament_details` (`id`, `game`, `name`, `date`, `prizepool`, `hosted_by`) VALUES
(1, 'valorant', 'Valorant Champions 2024', '2024-06-15', '$1,000,000', 'Riot Games'),
(2, 'valorant', 'Valorant Masters 2024', '2024-04-30', '$500,000', 'Riot Games'),
(3, 'lol', 'League of Legends World Championship 2024', '2024-10-05', '$2,000,000', 'Riot Games'),
(4, 'lol', 'League of Legends Mid-Season Invitational', '2024-05-01', '$250,000', 'Riot Games'),
(5, 'csgo', 'CS:GO Major Championship 2024', '2024-07-10', '$1,000,000', 'Valve'),
(6, 'csgo', 'BLAST Premier Fall Finals 2024', '2024-11-20', '$600,000', 'BLAST Premier');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'MdzBeast', 'zunainenashid@gmail.com', '$2y$10$aHRf.boPhSsdoXcGc6EQP.74quaA1Elpg8Eb0W295MNyluvOmv88W', '2024-12-14 07:18:17'),
(2, 'MdzBeast2', 'zunainenashid3@gmail.com', '$2y$10$N/4rLwZvNJXYoQyEnAKpdO7MhSVMsMTSFlZHpgNb1MlOv2Qu3n2Am', '2024-12-14 07:29:12'),
(3, 'MdzBeast1', 'zunainenashid2@gmail.com', '$2y$10$GERtSVcWSNxeawbdo72nde7js7yjHb0jxvFjA2DoPztpuyPhEO18e', '2024-12-14 10:24:29'),
(4, 'fahim', 'fahim@gmail.com', '$2y$10$d9devasDt.KKOmsmVnHAPekj4pztabujbFt2wfvb0n.5A.QVtJgbO', '2024-12-14 11:43:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tournament_details`
--
ALTER TABLE `tournament_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `game` (`game`,`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tournaments`
--
ALTER TABLE `tournaments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tournament_details`
--
ALTER TABLE `tournament_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
