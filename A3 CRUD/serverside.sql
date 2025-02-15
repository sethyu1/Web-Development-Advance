-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2025 at 06:34 PM
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
-- Database: `serverside`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(140) NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `content`, `timestamp`) VALUES
(10, 'Exploring the Future of Cryptocurrencies', 'Dive into the evolving landscape of cryptocurrencies, discussing emerging trends, regulatory challenges, and the potential impact on global finance.', '2025-02-08 16:58:06'),
(11, 'The Rise of NFTs: Beyond Digital Art', 'Explore how Non-Fungible Tokens (NFTs) are revolutionizing industries beyond art, from gaming and music to real estate, and their implications for digital ownership.', '2025-02-08 16:58:33'),
(12, 'Decentralized Finance (DeFi) Explained', 'A comprehensive guide to DeFi, covering its key concepts, benefits, risks, and the projects leading the charge in reshaping traditional finance.', '2025-02-08 16:58:48'),
(13, 'Privacy in the Age of Surveillance Capitalism', 'Discuss the growing concerns around online privacy, surveillance capitalism, and the technologies and strategies individuals can use to protect their digital footprint.', '2025-02-08 16:59:03'),
(14, 'Blockchain Beyond Bitcoin: Real-World Applications', 'Highlight practical uses of blockchain technology beyond cryptocurrencies, from supply chain management and voting systems to healthcare and identity verification.', '2025-02-08 16:59:17'),
(15, 'The Future of AI in Cybersecurity', 'As cyber threats continue to evolve, artificial intelligence is playing an increasingly vital role in cybersecurity. Explore how AI is enhancing threat detection, automating responses, and improving overall security strategies in a rapidly changing digital landscape.', '2025-02-08 16:59:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
