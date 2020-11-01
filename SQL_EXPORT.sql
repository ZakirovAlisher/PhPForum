-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2020 at 10:23 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flash`
--

-- --------------------------------------------------------

--
-- Table structure for table `horse_quoe`
--

CREATE TABLE `horse_quoe` (
  `user_id` int(11) NOT NULL,
  `op_id` int(11) NOT NULL,
  `ready1` int(11) NOT NULL DEFAULT 0,
  `ready2` int(11) NOT NULL DEFAULT 0,
  `game_id` int(11) NOT NULL,
  `mass1` int(11) NOT NULL,
  `mass2` int(11) NOT NULL,
  `speed1` int(11) NOT NULL,
  `speed2` int(11) NOT NULL,
  `bet1` int(11) NOT NULL,
  `bet2` int(11) NOT NULL,
  `speed3` int(11) NOT NULL,
  `mass3` int(11) NOT NULL,
  `speed4` int(11) NOT NULL,
  `mass4` int(11) NOT NULL,
  `speed5` int(11) NOT NULL,
  `mass5` int(11) NOT NULL,
  `speed6` int(11) NOT NULL,
  `mass6` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `post_content` text NOT NULL,
  `post_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `topic_id`, `post_content`, `post_date`) VALUES
(1, 1, 48, ' :radost:  :ok:  :ok:  :ok:  :ok: ', '1st  November 2020 03:09 PM'),
(2, 1, 48, ' |>citata<(=author= Алишер Закиров =)> :radost:    :ok:    :ok:    :ok:    :ok:      <||\r\nцитата', '1st  November 2020 03:09 PM'),
(3, 1, 48, ' |>citata<(=author= Алишер Закиров =)>|>citata<(=author=  Алишер Закиров  =)>  :radost:      :ok:      :ok:      :ok:      :ok:       <||\r\nцитата    <||\r\nмультицитата', '1st  November 2020 03:09 PM'),
(5, 1, 48, ' |>citata<(=author= Алишер Закиров =)> |>citata<(=author=  Алишер Закиров  =)>|>citata<(=author=   Алишер Закиров   =)>   :radost:        :ok:        :ok:        :ok:        :ok:        <||\r\nцитата    <||\r\nмультицитата   <||\r\nеще мультицитата', '1st  November 2020 03:10 PM'),
(6, 1, 48, ' |>citata<(=author= Алишер Закиров =)>  |>citata<(=author=  Алишер Закиров  =)> |>citata<(=author=   Алишер Закиров   =)>|>citata<(=author=    Алишер Закиров    =)>    :radost:          :ok:          :ok:          :ok:          :ok:         <||\r\nцитата    <||\r\nмультицитата   <||\r\nеще мультицитата    <||\r\nи еще', '1st  November 2020 03:11 PM'),
(7, 34, 48, ' |>citata<(=author= Алишер Закиров =)>|>citata<(=author=  Алишер Закиров  =)>  |>citata<(=author=   Алишер Закиров   =)> |>citata<(=author=    Алишер Закиров    =)>|>citata<(=author=     Алишер Закиров     =)>     :radost:            :ok:            :ok:            :ok:            :ok:          <||\r\nцитата    <||\r\nмультицитата   <||\r\nеще мультицитата    <||\r\nи еще    <||\r\n :xz: ', '1st  November 2020 03:21 PM');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_name` text NOT NULL,
  `topic_content` text NOT NULL,
  `count` int(11) NOT NULL,
  `topic_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `user_id`, `topic_name`, `topic_content`, `count`, `topic_date`) VALUES
(48, 1, 'Вставка картинок', '[IMG SOURCE-URL:\" https://avatarko.ru/img/kartinka/33/multfilm_lyagushka_32117.jpg\"]\r\n', 8, '1st  November 2020 03:08 PM');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(180) NOT NULL,
  `surname` varchar(180) NOT NULL,
  `email` varchar(180) NOT NULL,
  `password` varchar(180) NOT NULL,
  `avatar` text NOT NULL,
  `balance` bigint(20) NOT NULL DEFAULT 50000,
  `status` varchar(100) NOT NULL DEFAULT 'User',
  `count_post` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `surname`, `email`, `password`, `avatar`, `balance`, `status`, `count_post`) VALUES
(1, 'Алишер', 'Закиров', '1@', 'ba71f8e7f3b18d6bcd642a90e641b85a', 'avatars/fdae662342fc3b212d5bb935da2746ec', 77777593777, 'Admin', 7),
(34, 'Name', 'Surname', '2@', 'ba71f8e7f3b18d6bcd642a90e641b85a', 'avatars/1a1cf9722e94fd8e5a183fe3b6101711', 50000, 'User', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `horse_quoe`
--
ALTER TABLE `horse_quoe`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `horse_quoe`
--
ALTER TABLE `horse_quoe`
  ADD CONSTRAINT `horse_quoe_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`);

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
