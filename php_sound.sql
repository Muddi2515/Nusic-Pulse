-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2024 at 10:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_sound`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `Name`, `Email`, `Password`, `Phone`) VALUES
(4, 'Anas Sheikh', 'Anas@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '03337843810'),
(5, 'Mudasir', 'mudasiradmin@gmail.com', '123456', '12345678901'),
(6, 'Malik', 'malikadmin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0000200002');

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Image` varchar(100) NOT NULL,
  `About` varchar(50) NOT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`Id`, `Name`, `Image`, `About`, `genre`, `language`, `created_at`, `updated_at`) VALUES
(1, 'Sidhu Moosa Wala', '../img/artists/sidhu-mose-wala.jpeg', 'Punjabi Singer', NULL, NULL, '2024-10-03 20:29:11', '2024-10-03 21:05:28'),
(2, 'Atif-Aslam', '../img/artists/atif-aslam.webp', 'Urdu Singer', NULL, NULL, '2024-10-03 20:29:11', '2024-10-03 21:05:24'),
(3, 'Ed-Sheeran', '../img/artists/edward-sheeran.jpg', 'English Singer', NULL, NULL, '2024-10-03 20:29:11', '2024-10-03 21:05:20'),
(4, 'Harry-Styles', '../img/artists/harry-style.jpg', 'English Singer', NULL, NULL, '2024-10-03 20:29:11', '2024-10-03 21:05:12'),
(5, 'Adele', '../img/artists/adele.jpg', 'English Singer', NULL, NULL, '2024-10-03 20:29:11', '2024-10-03 21:05:08'),
(6, 'Asim-Azhar', '../img/artists/asim-azhar.webp', 'Urdu Singer', NULL, NULL, '2024-10-03 20:29:11', '2024-10-03 21:05:04'),
(7, 'Shubh', '../img/artists/shubh.webp', 'Punjabi Singer', NULL, NULL, '2024-10-03 20:29:11', '2024-10-03 21:04:57'),
(8, 'George-Micheal', '../img/artists/george-michael.jpg', 'English Singer', NULL, NULL, '2024-10-03 20:29:11', '2024-10-03 21:04:44'),
(12, 'Yo Yo Honey Singh', '../img/artists/yoyo honey singh.jpg', 'Rapper, Hip Hoper, Indian Rapper', 'Hip Hop', 'punjabi', '2024-10-03 21:03:46', '2024-10-03 21:03:46'),
(13, 'Arijt Singh', '../img/artists/arjistSingh.jpg', 'Deep Music Singer', 'Hip Hop', 'urdu', '2024-10-09 18:38:47', '2024-10-09 18:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `Id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `music_id` int(11) DEFAULT NULL,
  `video_id` int(11) DEFAULT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`Id`, `user_id`, `music_id`, `video_id`, `added_at`) VALUES
(47, 6, 23, NULL, '2024-08-22 16:10:42'),
(149, 8, 10, NULL, '2024-10-13 01:05:24'),
(150, 8, 31, NULL, '2024-10-13 01:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `music_table`
--

CREATE TABLE `music_table` (
  `music_id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `artist` varchar(30) DEFAULT NULL,
  `album` varchar(30) DEFAULT NULL,
  `genre` varchar(20) DEFAULT NULL,
  `Year` date DEFAULT NULL,
  `language` varchar(20) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `cover_image_path` varchar(150) DEFAULT NULL,
  `audio_path` varchar(150) DEFAULT NULL,
  `release_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `music_table`
--

INSERT INTO `music_table` (`music_id`, `title`, `artist`, `album`, `genre`, `Year`, `language`, `description`, `cover_image_path`, `audio_path`, `release_date`) VALUES
(5, 'Goat', 'Sidhu Moosa Wala', 'Sidhu Moosa Wala', 'Hip Hop', '2024-03-22', 'punjabi', 'Goal song...', '../audio/goal.jpg', '../audio/goal.mp3', '2024-03-22'),
(6, 'So High', 'Sidhu Moosa Wala', 'Sidhu Moosa Wala', 'Pop', '2024-02-29', 'punjabi', 'So high song...', '../audio/so-high.jpg', '../audio/so-high.mp3', '2024-02-29'),
(7, 'Never Fold', 'Sidhu Moosa Wala', 'Sidhu Moosa Wala', 'Rock', '2024-03-15', 'english', 'never fold song..', '../audio/never-fold.jpg', '../audio/never-fold.mp3', '2024-03-15'),
(8, 'Dill Mera Na Sune', 'Atif-Aslam', 'Atif-Aslam', 'Pop', '2024-03-09', 'urdu', 'dil mera na sune song...', '../audio/dil-mera-na-sune.jpg', '../audio/dil-mera-na-sune.mp3', '2024-03-09'),
(9, 'Tera Hone Laga Hoon', 'Atif-Aslam', 'Atif-Aslam', 'Electronic', '2024-03-30', 'urdu', 'tera hone laga hn song...', '../audio/tera-hone-laga-hoon.jpg', '../audio/tera-hone-laga-hoon.mp3', '2024-03-30'),
(10, 'Bulleya', 'Atif-Aslam', 'Atif-Aslam', 'Pop', '2024-03-21', 'urdu', 'bulleya song...', '../audio/bulleya.jpg', '../audio/bulleya.mp3', '2024-03-21'),
(11, 'Perfect', 'Ed-Sheeran', 'Ed-Sheeran', 'hiphop', '2024-01-31', 'english', 'This is perfect song...', '../audio/perfect.jpg', '../audio/perfect.mp3', '2024-01-31'),
(12, 'Photograph', 'Ed-Sheeran', 'Ed-Sheeran', 'jazz', '2024-03-05', 'english', 'This is photograph song', '../audio/photograph.jpg', '../audio/photograph.mp3', '2024-03-05'),
(13, 'Shivers', 'Ed-Sheeran', 'Ed-Sheeran', 'hiphop', '2024-03-19', 'english', 'Shiverse song...', '../audio/shiverse.jpg', '../audio/Shivers.mp3', '2024-03-19'),
(14, 'Shape Of You', 'Ed-Sheeran', 'Ed-Sheeran', 'Rock', '2024-03-07', 'english', 'shape of you song', '../audio/shape-of-you.jpg', '../audio/Shape-of-You.mp3', '2024-03-07'),
(15, 'As it was', 'Harry-Styles', 'Harry-Styles', 'popular', '2024-03-03', 'english', 'as it was song', '../audio/as-it-was.jpg', '../audio/As-It-Was.mp3', '2024-03-03'),
(16, 'Setellite', 'Harry-Styles', 'Harry-Styles', 'jazz', '2024-02-27', 'english', 'Setellite music', '../audio/setellite.jpg', '../audio/settelite.mp3', '2024-02-27'),
(17, 'Late Night Talking', 'Harry-Styles', 'Harry-Styles', 'hiphop', '2024-03-15', 'english', 'Late night song', '../audio/late-night-talking.jpg', '../audio/late-night.mp3', '2024-03-15'),
(18, 'Sign Of The Time', 'Harry-Styles', 'Harry-Styles', 'hiphop', '2024-03-05', 'english', 'sign of the time...', '../audio/sign-of-the-time.jpg', '../audio/Sign-of-the-Times.mp3', '2024-03-05'),
(19, 'Hello', 'Adele', 'Adele', 'popular', '2024-03-05', 'english', 'hello song', '../audio/hello.jpg', '../audio/Hello.mp3', '2024-03-05'),
(20, 'Rolling In The Deep', 'Adele', 'Adele', 'jazz', '2024-03-13', 'english', 'Rolling in deep..', '../audio/rolling-in-the-deep.jpg', '../audio/Rolling-in-the-Deep.mp3', '2024-03-13'),
(21, 'Some One Like You', 'Adele', 'Adele', 'hiphop', '2024-03-05', 'english', 'Some one like you song...', '../audio/someone-like-you.jpg', '../audio/Someone-Like-You.mp3', '2024-03-05'),
(22, 'Cheque', 'Shubh', 'Shubh', 'Rock', '2024-03-04', 'punjabi', 'Cheque song...', '../audio/cheques.jpg', '../audio/cheques.mp3', '2024-03-04'),
(23, 'One Love', 'Shubh', 'Shubh', 'Pop', '2024-03-11', 'punjabi', 'one love song...', '../audio/one-love.jpg', '../audio/one-love.mp3', '2024-03-11'),
(24, 'No Love', 'Shubh', 'Shubh', 'jazz', '2024-03-25', 'punjabi', 'No love song...', '../audio/No-Love.jpg', '../audio/No-Love.mp3', '2024-03-25'),
(25, 'King Shit', 'Shubh', 'Shubh', 'Rock', '2024-02-07', 'punjabi', 'King shit', '../audio/king-shit.jpg', '../audio/king-shit.mp3', '2024-02-07'),
(26, 'Father-figure', 'George-Micheal', 'George-Micheal', 'jazz', '2024-03-11', 'english', 'Father figure song', '../audio/Father- Figure.jpg', '../audio/Father- Figure.mp3', '2024-03-11'),
(27, 'Jesus-To-A-Child', 'George-Micheal', 'George-Micheal', 'country', '2024-03-10', 'english', 'Jesus-To-A-Child song...', '../audio/Jesus-To-A-Child.jpg', '../audio/Jesus-To-A-Child.mp3', '2024-03-10'),
(28, 'White-Light', 'George-Micheal', 'George-Micheal', 'popular', '2024-03-14', 'english', 'white-light song..', '../audio/white-light.jpg', '../audio/White-Light.mp3', '2024-03-14'),
(29, 'Pehli-Dafa', 'Atif-Aslam', 'Atif-Aslam', 'jazz', '2024-03-12', 'urdu', 'Pehli-Dafa', '../audio/pehli-dafa.jpg', '../audio/Pehli-Dafa.mp3', '2024-03-12'),
(30, 'Rafta-Rafta', 'Atif-Aslam', 'Atif-Aslam', 'hiphop', '2024-03-05', 'urdu', 'Rafta-rafta song', '../audio/Rafta-rafta.jpg', '../audio/Rafta-rafta.mp3', NULL),
(31, 'Jo-Tu-Na-Mila', 'Asim-Azhar', 'Asim-Azhar', 'Pop', '2024-03-20', 'urdu', 'jo-tu-na-mile song', '../audio/jo-tu-na-mile.jpg', '../audio/jo-tu-na-mile.mp3', NULL),
(32, 'Dard', 'Asim-Azhar', 'Asim-Azhar', 'hiphop', '2024-03-11', 'urdu', 'dard song', '../audio/dard.jpg', '../audio/dard.mp3', NULL),
(36, 'Lut Put Gaya', 'Arijt Singh', 'Dunki', 'popular', '2024-10-10', 'urdu', 'Lut Put Gaya - Dunki ', '../audio/Lut Put Gaya.jpeg', '../audio/Lutput - Dunki - Arijit Singh.mp3', '2024-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `music_id` int(11) DEFAULT NULL,
  `video_id` int(11) DEFAULT NULL,
  `rating` varchar(40) DEFAULT NULL,
  `comment` varchar(50) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `user_img` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `Name`, `Email`, `Password`, `Phone`, `user_img`) VALUES
(6, 'Anas Sheikh', 'Anas@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '03337843810', NULL),
(7, 'Hassan', 'hassan@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '033252116', NULL),
(8, 'Mudasir', 'mudasir@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '00000000000', './img/users/adv_hamza.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `video_table`
--

CREATE TABLE `video_table` (
  `video_id` int(11) NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `artist` varchar(30) DEFAULT NULL,
  `album` varchar(30) DEFAULT NULL,
  `genre` varchar(30) DEFAULT NULL,
  `year` date DEFAULT NULL,
  `language` varchar(20) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `cover_image_path` varchar(150) DEFAULT NULL,
  `video_path` varchar(200) DEFAULT NULL,
  `release_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video_table`
--

INSERT INTO `video_table` (`video_id`, `title`, `artist`, `album`, `genre`, `year`, `language`, `description`, `cover_image_path`, `video_path`, `release_date`) VALUES
(4, 'Sinf e Aahan', 'Asim-Azhar', 'Asim-Azhar', 'Rock', '2024-03-30', 'urdu', '', '../video/sinf e aahan.jpg', '../video/Sinf E Aahan _ OST _ Ft. Asim Azhar _ Official Video _ ARY Digital.mp4', '2024-03-30'),
(5, 'Pehli Dafa ', 'Atif-Aslam', 'Atif-Aslam', 'Rock', '2024-03-29', 'urdu', '', '../video/pehli dafa.jpg', '../video/Atif Aslam_ Pehli Dafa Song (Video) _ Ileana D’Cruz _ Latest Hindi Song 2017 _ T.mp4', '2024-03-29\n'),
(6, 'Tera Hone Laga Hoon', 'Atif-Aslam', 'Atif-Aslam', 'Rock', '2024-03-28', 'urdu', '', '../video/tera hone laga hoon.jpg', '../video/Tera Hone Laga Hoon _ Atif Aslam _ Alisha Chinai _ Ajab Prem Ki Ghazab Kahani _ .mp4', '2024-03-28'),
(7, 'Perfect', 'Ed-Sheeran', 'Ed-Sheeran', 'Rock', '2024-03-27', 'english', '', '../video/perfect.jpg', '../video/Ed Sheeran - Perfect (Official Music Video).mp4', '2024-03-27'),
(8, 'Shape Of You', 'Ed-Sheeran', 'Ed-Sheeran', 'Rock', '2024-03-26', 'english', '', '../video/shape of you.jpg', '../video/Ed Sheeran - Shape of You (Official Music Video).mp4', '2024-03-26'),
(10, 'So High', 'Sidhu Moosa Wala', 'Sidhu Moosa Wala', 'Rock', '2024-03-24', 'punjabi', '', '../video/so high.jpg', '../video/So High _ Official Music Video _ Sidhu Moose Wala ft. BYG BYRD _ Humble Music _.mp4', '2024-03-24'),
(11, 'Satellite', 'Harry-Styles', 'Harry-Styles', 'Rock', '2024-03-23', 'english', '', '../video/satellite.jpg', '../video/Harry Styles - Satellite (Official Video).mp4', '2024-03-23'),
(12, 'Late Night Talking', 'Harry-Styles', 'Harry-Styles', 'Rock', '2024-03-22', 'english', '', '../video/late night talking.jpg', '../video/Harry Styles - Late Night Talking (Official Video).mp4', '2024-03-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `music_id` (`music_id`),
  ADD KEY `video_id` (`video_id`);

--
-- Indexes for table `music_table`
--
ALTER TABLE `music_table`
  ADD PRIMARY KEY (`music_id`),
  ADD KEY `music_id` (`music_id`);

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD KEY `review_id` (`review_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `video_table`
--
ALTER TABLE `video_table`
  ADD PRIMARY KEY (`video_id`),
  ADD KEY `video_id` (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `music_table`
--
ALTER TABLE `music_table`
  MODIFY `music_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `video_table`
--
ALTER TABLE `video_table`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `favourites_ibfk_2` FOREIGN KEY (`music_id`) REFERENCES `music_table` (`music_id`),
  ADD CONSTRAINT `favourites_ibfk_3` FOREIGN KEY (`video_id`) REFERENCES `video_table` (`video_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
