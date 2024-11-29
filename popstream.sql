-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 12:09 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie-hunter`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `overview` text DEFAULT NULL,
  `trailer_key` varchar(255) DEFAULT NULL,
  `poster_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `user_id`, `movie_id`, `title`, `overview`, `trailer_key`, `poster_path`, `created_at`) VALUES
(12, '', 1022796, 'Wish', NULL, 'EeLJLpU8PGI', 'https://image.tmdb.org/t/p/w500/AcoVfiv1rrWOmAdpnAMnM56ki19.jpg', '2024-02-01 06:58:41'),
(13, '', 799155, 'Attack', NULL, 'KnC-XvFGflM', 'https://image.tmdb.org/t/p/w500/5jGKbYuZtdxSNOocI6ZziQeiY4n.jpg', '2024-02-01 07:01:56'),
(14, '', 940551, 'Migration', NULL, '_8CbazcjJYw', 'https://image.tmdb.org/t/p/w500/ldfCF9RhR40mppkzmftxapaHeTo.jpg', '2024-02-01 07:06:47'),
(15, '', 940551, 'Migration', NULL, '_8CbazcjJYw', 'https://image.tmdb.org/t/p/w500/ldfCF9RhR40mppkzmftxapaHeTo.jpg', '2024-02-01 07:07:07'),
(16, '', 609681, 'The Marvels', NULL, 'ZaTUatY-UoU', 'https://image.tmdb.org/t/p/w500/9GBhzXMFjgcZ3FdR9w3bUMMTps5.jpg', '2024-02-01 07:08:11'),
(18, '6', 940551, 'Migration', NULL, '_8CbazcjJYw', 'https://image.tmdb.org/t/p/w500/ldfCF9RhR40mppkzmftxapaHeTo.jpg', '2024-02-01 07:16:22'),
(19, '', 940551, 'Migration', NULL, '_8CbazcjJYw', 'https://image.tmdb.org/t/p/w500/ldfCF9RhR40mppkzmftxapaHeTo.jpg', '2024-02-01 08:55:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
