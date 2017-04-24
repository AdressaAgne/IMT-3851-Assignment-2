-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 20, 2017 at 07:00 PM
-- Server version: 5.6.34
-- PHP Version: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `oblig2`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `source` int(11) NOT NULL,
  `thumbnail` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `image_id` int(11) NOT NULL,
  `style` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `image_id`, `style`, `time`) VALUES
(1, 6, 'Title yaya', 'lorem ipsum dolor sit amet, lorem ipsum dolor sit amet\r\nlorem ipsum dolor sit ametvv\r\nvlorem ipsum dolor sit ametv lorem ipsum dolor sit amet v v v vlorem ipsum dolor sit amet', 1, 'post', '0000-00-00'),
(2, 0, 'This is a post', 'this is very awesome LOL!', 0, 'post', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `rating` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `post_id`, `rating`) VALUES
(18, 4, 2, 0),
(24, 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `name`, `surname`, `mail`, `password`, `token`) VALUES
(1, 'agne', 'ødegaard', 'mail@mail.mail', '123123', '123li2yewutyfjv'),
(2, 'navn', 'etternavn', 'mail', 'pw', 'token'),
(3, 'halla', 'ball', 'mail@mail.no', '$2y$10$XcLHYq68kzE81gV0yqPho.6l89wutJeIXkqAINnKUNEbs1uttE.X6', ''),
(4, '123', '123', '123', '$2y$10$w7VcqM.joe8Gre4WAGQfc.iZPC2FcCJ0bekeeLHEpYb0X30.frbhe', ''),
(5, 'hei', 'asd', 'agne@agne.no', '$2y$10$OG2VGysqShh3nfyrHq7QuOkBkwv/j6dKAuy31s.jq3OEtvIoa.A3a', ''),
(6, 'Agne', 'Odegaard', 'agne240@me.com', '$2y$10$3ZHIG9vJriUolldUh1l4Y.KVIsuVebaIeTUcT5agbYy0GdYFn7TPO', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `ratings`
  ADD CONSTRAINT ratings_user_post
     UNIQUE (post_id, user_id) ;

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;