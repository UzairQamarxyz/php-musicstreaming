-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2020 at 08:01 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `album_id` int(11) NOT NULL,
  `album_name` varchar(128) NOT NULL,
  `album_loc` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`album_id`, `album_name`, `album_loc`) VALUES
(1, '198XAD', '../assets/uploads/songs/albums/198XAD.png'),
(2, '199XAD', '../assets/uploads/songs/albums/199XAD.png'),
(3, 'F♯ A♯ ∞', '../assets/uploads/songs/albums/F♯ A♯ ∞.png'),
(4, 'Flying Microtonal Banana', '../assets/uploads/songs/albums/Flying Microtonal Banana.png'),
(5, 'Seelie', '../assets/uploads/songs/albums/Seelie.png'),
(6, 'Sunbather', '../assets/uploads/songs/albums/Sunbather.png'),
(7, 'Tunes 2011-2019', '../assets/uploads/songs/albums/Tunes 2011-2019.png');

-- --------------------------------------------------------

--
-- Table structure for table `albumsxartists`
--

CREATE TABLE `albumsxartists` (
  `album_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `albumsxartists`
--

INSERT INTO `albumsxartists` (`album_id`, `artist_id`) VALUES
(1, 6),
(2, 6),
(3, 4),
(4, 5),
(5, 2),
(6, 3),
(7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `artist_id` int(11) NOT NULL,
  `artist_name` varchar(128) NOT NULL,
  `artist_desc` text DEFAULT NULL,
  `artist_loc` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`artist_id`, `artist_name`, `artist_desc`, `artist_loc`) VALUES
(1, 'Burial', 'William Emmanuel Bevan, known by his recording alias Burial, is a British electronic musician from South London. Initially remaining anonymous, Burial became the first artist signed to Kode9\'s electronic label Hyperdub in 2005.', '../assets/uploads/songs/artists/Burial.png'),
(2, 'Clann', 'CLANN is a Canadian-based band of artists and musicians behind the KIN Fables Project - a visual/musical odyssey encompassing original films/songs/artwork.', '../assets/uploads/songs/artists/Clann.png'),
(3, 'Deafheaven', 'Deafheaven is an American post-metal band formed in 2010. Originally based in San Francisco, the group began as a two-piece with singer George Clarke and guitarist Kerry McCoy, who recorded and self-released a demo album together. Following its release, Deafheaven recruited three new members and began to tour.', '../assets/uploads/songs/artists/Deafheaven.png'),
(4, 'Godspeed You! Black Emperor', 'Godspeed You! Black Emperor is a Canadian experimental music collective which originated in Montreal, Quebec in 1994. The group releases recordings through Constellation, an independent record label also located in Montreal. After the release of their debut album in 1997, the group toured regularly from 1998 to 2003.', '../assets/uploads/songs/artists/Godspeed You! Black Emperor.png'),
(5, 'King Gizzard And The Lizard Wizard', 'King Gizzard & the Lizard Wizard are an Australian rock band formed in 2010 in Melbourne, Victoria. The band consists of Stu Mackenzie, Ambrose Kenny-Smith, Cook Craig, Joey Walker, Lucas Harwood, Michael Cavanagh, and Eric Moore', '../assets/uploads/songs/artists/King Gizzard And The Lizard Wizard.png'),
(6, 'Mega Drive', 'The enigmatic artist behind the mega drive project has established himself as one of the most visionary creators in Synthwave, and early releases like VHS, hardwired, and 198XAD represent essential pillars of the Darksynth and Cyberpunk Synthwave outgrowths of the main genre. Since his first releases in 2012, mega drive has gained a Diehard following and his albums have become some of the most well-known and well-respected recordings in the entire retro synth world.', '../assets/uploads/songs/artists/Mega Drive.png');

-- --------------------------------------------------------

--
-- Table structure for table `playlists_contents`
--

CREATE TABLE `playlists_contents` (
  `user_id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL,
  `track_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `playlists_contents`
--

INSERT INTO `playlists_contents` (`user_id`, `playlist_id`, `track_id`) VALUES
(1, 1, 6),
(1, 2, 2),
(3, 1, 1),
(3, 1, 6),
(3, 2, 4);

-- --------------------------------------------------------

--
-- Stand-in structure for view `searchinfo`
-- (See below for the actual view)
--
CREATE TABLE `searchinfo` (
`track_id` int(11)
,`artist_id` int(11)
,`track_title` text
,`album_name` varchar(128)
,`artist_name` varchar(128)
,`track_loc` text
,`album_loc` varchar(500)
,`artist_loc` varchar(500)
);

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `track_id` int(11) NOT NULL,
  `track_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `artist_id` int(11) DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  `track_loc` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`track_id`, `track_title`, `artist_id`, `album_id`, `track_loc`) VALUES
(1, 'Ashtray Wasp', 1, 7, '../assets/uploads/songs/songs/Burial - Ashtray Wasp.mp3'),
(2, 'Closer', 2, 5, '../assets/uploads/songs/songs/Clann - Closer.mp3'),
(3, 'Irresistible', 3, 6, '../assets/uploads/songs/songs/Deafheaven - Irresistible.mp3'),
(4, 'East Hastings', 4, 3, '../assets/uploads/songs/songs/Godspeed You! Black Emperor - East Hastings.mp3'),
(5, 'Billabong Valley', 5, 4, '../assets/uploads/songs/songs/King Gizzard And The Lizard Wizard - Billabong Valley.mp3'),
(6, 'Nuclear Fusion', 5, 4, '../assets/uploads/songs/songs/King Gizzard And The Lizard Wizard - Nuclear Fusion.mp3'),
(7, 'Sleep Drifter', 5, 4, '../assets/uploads/songs/songs/King Gizzard And The Lizard Wizard - Sleep Drifter.mp3'),
(8, 'Acid Spit', 6, 1, '../assets/uploads/songs/songs/Mega Drive - Acid Spit.mp3'),
(9, 'Crypt Diver', 6, 2, '../assets/uploads/songs/songs/Mega Drive - Crypt Diver.mp3');

-- --------------------------------------------------------

--
-- Stand-in structure for view `track_likes_details`
-- (See below for the actual view)
--
CREATE TABLE `track_likes_details` (
`track_id` int(11)
,`track_title` text
,`total_likes` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_pfp` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '../assets/uploads/pfps/default.png',
  `user_banner` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '../assets/uploads/banners/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_pfp`, `user_banner`) VALUES
(1, 'user1', 'user1@asd.com', '$2y$10$8MUjyyROpGvTnpL/Le9Xh.WbMMChPQ.HAE3WWMjRJg9FHRDusNNNC', '../assets/uploads/pfps/user1.png', '../assets/uploads/banners/user1.png'),
(2, 'user11', 'user11@asd.com', '$2y$10$Qnz0f8VvTcqQoOvLKpR41uUkRNS4QwEP9pYB0DJUtTVvEkJyNRpi2', '../assets/uploads/pfps/user11.png', '../assets/uploads/banners/user11.png'),
(3, 'mutahhar123', 'bmutahhar@gmail.com', '$2y$10$yC18zAi8FeUgeuRWv0NBD.q8i8LR42vMjYEzJ1JzulYA9sY2UNzyq', '../assets/uploads/pfps/mutahhar123.png', '../assets/uploads/banners/default.png');

-- --------------------------------------------------------

--
-- Table structure for table `users_playlists`
--

CREATE TABLE `users_playlists` (
  `user_id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL,
  `playlist_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_playlists`
--

INSERT INTO `users_playlists` (`user_id`, `playlist_id`, `playlist_name`) VALUES
(1, 1, 'Ambient'),
(3, 1, 'Rock'),
(1, 2, 'Workout'),
(3, 2, 'Metal'),
(3, 3, 'Bass');

-- --------------------------------------------------------

--
-- Table structure for table `userxartists`
--

CREATE TABLE `userxartists` (
  `user_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userxartists`
--

INSERT INTO `userxartists` (`user_id`, `artist_id`) VALUES
(1, 3),
(1, 6),
(3, 1),
(3, 4),
(3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `userxlikes`
--

CREATE TABLE `userxlikes` (
  `user_id` int(11) NOT NULL,
  `track_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userxlikes`
--

INSERT INTO `userxlikes` (`user_id`, `track_id`) VALUES
(1, 5),
(2, 3),
(3, 3),
(3, 5),
(3, 6);

-- --------------------------------------------------------

--
-- Structure for view `searchinfo`
--
DROP TABLE IF EXISTS `searchinfo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `searchinfo`  AS  select `tracks`.`track_id` AS `track_id`,`artists`.`artist_id` AS `artist_id`,`tracks`.`track_title` AS `track_title`,`albums`.`album_name` AS `album_name`,`artists`.`artist_name` AS `artist_name`,`tracks`.`track_loc` AS `track_loc`,`albums`.`album_loc` AS `album_loc`,`artists`.`artist_loc` AS `artist_loc` from (((`tracks` join `albums`) join `albumsxartists`) join `artists` on(`tracks`.`album_id` = `albums`.`album_id` and `albums`.`album_id` = `albumsxartists`.`album_id` and `albumsxartists`.`artist_id` = `artists`.`artist_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `track_likes_details`
--
DROP TABLE IF EXISTS `track_likes_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `track_likes_details`  AS  select `tracks`.`track_id` AS `track_id`,`tracks`.`track_title` AS `track_title`,`track_likes`.`total_likes` AS `total_likes` from (`tracks` left join (select `userxlikes`.`track_id` AS `track_id`,count(`userxlikes`.`user_id`) AS `total_likes` from `userxlikes` group by `userxlikes`.`track_id`) `track_likes` on(`track_likes`.`track_id` = `tracks`.`track_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`album_id`);

--
-- Indexes for table `albumsxartists`
--
ALTER TABLE `albumsxartists`
  ADD PRIMARY KEY (`album_id`,`artist_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indexes for table `playlists_contents`
--
ALTER TABLE `playlists_contents`
  ADD UNIQUE KEY `user_id` (`user_id`,`playlist_id`,`track_id`),
  ADD KEY `track_id` (`track_id`),
  ADD KEY `playlist_id` (`playlist_id`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`track_id`),
  ADD KEY `artist_id` (`artist_id`),
  ADD KEY `album_id` (`album_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_playlists`
--
ALTER TABLE `users_playlists`
  ADD PRIMARY KEY (`playlist_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `userxartists`
--
ALTER TABLE `userxartists`
  ADD PRIMARY KEY (`user_id`,`artist_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `userxlikes`
--
ALTER TABLE `userxlikes`
  ADD PRIMARY KEY (`user_id`,`track_id`),
  ADD KEY `track_id` (`track_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
  MODIFY `track_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albumsxartists`
--
ALTER TABLE `albumsxartists`
  ADD CONSTRAINT `albumsxartists_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `albumsxartists_ibfk_2` FOREIGN KEY (`album_id`) REFERENCES `albums` (`album_id`) ON DELETE CASCADE;

--
-- Constraints for table `playlists_contents`
--
ALTER TABLE `playlists_contents`
  ADD CONSTRAINT `playlists_contents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `playlists_contents_ibfk_2` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`track_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `playlists_contents_ibfk_3` FOREIGN KEY (`playlist_id`) REFERENCES `users_playlists` (`playlist_id`) ON DELETE CASCADE;

--
-- Constraints for table `tracks`
--
ALTER TABLE `tracks`
  ADD CONSTRAINT `tracks_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `albums` (`album_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tracks_ibfk_2` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`) ON DELETE CASCADE;

--
-- Constraints for table `users_playlists`
--
ALTER TABLE `users_playlists`
  ADD CONSTRAINT `users_playlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `userxartists`
--
ALTER TABLE `userxartists`
  ADD CONSTRAINT `userxartists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `userxartists_ibfk_2` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`) ON DELETE CASCADE;

--
-- Constraints for table `userxlikes`
--
ALTER TABLE `userxlikes`
  ADD CONSTRAINT `userxlikes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userxlikes_ibfk_2` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`track_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
