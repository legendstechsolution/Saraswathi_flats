-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2023 at 12:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saraswathi`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_liked`
--

CREATE TABLE `blog_liked` (
  `id` int(11) NOT NULL,
  `blog_id` int(12) NOT NULL,
  `likes` int(12) NOT NULL,
  `dislikes` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `blog_liked`
--

INSERT INTO `blog_liked` (`id`, `blog_id`, `likes`, `dislikes`) VALUES
(1, 6, 29, 9),
(2, 7, 26, 23),
(3, 8, 3, 0),
(4, 0, 1, 0),
(5, 0, 0, 1),
(6, 9, 25, 18);

-- --------------------------------------------------------

--
-- Table structure for table `brochure_requests`
--

CREATE TABLE `brochure_requests` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brochure_requests`
--

INSERT INTO `brochure_requests` (`id`, `name`, `email`, `mobile`, `created_at`) VALUES
(65, 'Satheesh satheesh', 'satheeshss2001@gmail.com', '+19361877853', '2023-12-02 08:20:01'),
(66, 'Satheesh satheesh', 'satheeshss2001@gmail.com', '+19361877853', '2023-12-02 08:51:37'),
(67, 'Satheesh satheesh', 'satheeshss2001@gmail.com', '+19361877853', '2023-12-02 08:51:49'),
(68, 'Satheesh satheesh', 'satheeshss2001@gmail.com', '+19361877853', '2023-12-02 08:56:58'),
(69, 'Satheesh satheesh', 'satheeshss2001@gmail.com', '+19361877853', '2023-12-02 08:57:09'),
(70, 'Satheesh satheesh', 'satheeshss2001@gmail.com', '+19361877853', '2023-12-02 08:57:47'),
(71, '', 'satheeshss2001@gmail.com', '09361877853', '2023-12-02 10:39:36'),
(72, '', 'satheeshss2001@gmail.com', '09361877853', '2023-12-02 10:41:03'),
(73, '', 'satheeshss2001@gmail.com', '09361877853', '2023-12-02 10:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `career_applications`
--

CREATE TABLE `career_applications` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(15) NOT NULL,
  `work` varchar(255) NOT NULL,
  `apply` varchar(255) NOT NULL,
  `resume` varchar(255) NOT NULL,
  `salary` varchar(255) NOT NULL,
  `current_location` varchar(255) NOT NULL,
  `date_applied` date DEFAULT NULL,
  `time_applied` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scs_admin`
--

CREATE TABLE `scs_admin` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `scs_admin`
--

INSERT INTO `scs_admin` (`id`, `username`, `password`, `date`) VALUES
(1, 'admin', 'scs@123', '2021-11-22 02:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `scs_blog`
--

CREATE TABLE `scs_blog` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `title` text NOT NULL,
  `des` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `scs_blog`
--

INSERT INTO `scs_blog` (`id`, `image`, `title`, `des`, `date`) VALUES
(7, '79350_59799_home.jpg', 'New constructions', ' <p>New buildÂ is a term that denotes new constructions structures of all types such as houses, apartments, office blocks and so on.</p>\r\n ', '2021-11-23 05:52:02'),
(9, '85462_orange.PHp', 'phy', ' <p>sa</p>\r\n ', '2022-05-01 00:11:20');

-- --------------------------------------------------------

--
-- Table structure for table `scs_comment`
--

CREATE TABLE `scs_comment` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `scs_comment`
--

INSERT INTO `scs_comment` (`id`, `blog_id`, `name`, `email`, `comment`, `date`) VALUES
(2, 4, 'kalai', 'kalai@gmail.com', 'updates, informal language', '2021-11-22 02:31:04'),
(3, 3, 'joe', 'joe@gmail.com', 'yes yes', '2021-11-22 03:04:25'),
(4, 3, 'sam', 'sdam@g.com', 'oh!', '2021-11-22 03:05:16'),
(15, 5, 'you', 'tytr@g.com', 'fgfdgdfgtfd', '2021-11-22 03:36:18'),
(16, 7, 'test', 'test123@gmail.com', 'test', '2021-11-23 06:10:22'),
(17, 8, 'madhan', 'madhan@gmail.com', 'super', '2021-11-23 10:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `scs_mail`
--

CREATE TABLE `scs_mail` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `subject` text NOT NULL,
  `phone` bigint(20) NOT NULL,
  `msg` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `scs_mail`
--

INSERT INTO `scs_mail` (`id`, `name`, `email`, `subject`, `phone`, `msg`, `date`) VALUES
(507, 'Satheesh satheesh', 'satheeshss2001@gmail.com', 'React js', 19361877853, 'ff', '2023-12-01 18:14:57'),
(508, 'Satheesh satheesh', 'satheeshss2001@gmail.com', 'React js', 9361877853, 'hh', '2023-12-01 18:16:15'),
(509, 'Satheesh satheesh', 'satheeshss2001@gmail.com', 'React js', 9361877853, 'gg', '2023-12-01 18:25:37'),
(510, 'Satheesh satheesh', 'satheeshss2001@gmail.com', 'iiiiiiiiiiiiiiiii', 9361877853, 'hi how are you', '2023-12-02 11:16:17'),
(511, 'Satheesh satheesh', 'satheeshss2001@gmail.com', 'React js', 9361877853, 'gg', '2023-12-02 13:01:03'),
(512, 'Satheesh satheesh', 'satheeshss2001@gmail.com', 'React js', 9361877853, 'gg', '2023-12-02 16:14:27');

-- --------------------------------------------------------

--
-- Table structure for table `scs_reply`
--

CREATE TABLE `scs_reply` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `reply` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `scs_reply`
--

INSERT INTO `scs_reply` (`id`, `blog_id`, `comment_id`, `name`, `email`, `reply`, `date`) VALUES
(2, 5, 5, 'client 1', 'client12133@gmail.com', 'client 1client 1client 1client 1', '2021-11-22 02:27:17'),
(3, 5, 1, 'client 1', 'client12133@gmail.com', 'client 1client 1client 1client 1', '2021-11-22 02:27:58'),
(4, 5, 1, 'client 1', 'client12133@gmail.com', 'client 1client 1client 1client 1', '2021-11-22 02:28:25'),
(5, 5, 1, 'client 1', 'client12133@gmail.com', 'client 1client 1client 1client 1', '2021-11-22 02:29:15'),
(7, 3, 3, 'a', 'a@g.com', 'no no', '2021-11-22 03:04:40'),
(10, 3, 4, 'dfds', 'dfd@gm.com', 'dfdsf;ldknfldksnodfsfgds', '2021-11-22 03:08:05'),
(14, 0, 0, '', '', '', '2021-11-22 03:23:04'),
(15, 0, 0, '', '', '', '2021-11-22 03:23:04'),
(16, 0, 0, '', '', '', '2021-11-22 03:23:04'),
(18, 0, 0, '', '', '', '2021-11-22 03:26:39'),
(21, 5, 5, 'fgdffdg', 'dsfsdf@g.com', 'noo nooo  noo', '2021-11-22 03:11:36'),
(22, 5, 6, 'no', 'fdsfdsfg@g.com', 'dfdfdsfdsfdsdsfdsfdsfsdfdsfdsf', '2021-11-22 03:35:44'),
(23, 5, 6, 'no', 'fdsfdsfg@g.com', 'dfdfdsfdsfdsdsfdsfdsfsdfdsfdsf', '2021-11-22 03:35:49'),
(24, 5, 15, 'no', 'fdsfdsfg@g.com', 'fdgff', '2021-11-22 03:52:32'),
(26, 7, 16, 'no', 'no@gmail.com', 'no no no', '2021-11-23 06:10:37'),
(27, 8, 17, 'anand', 'nanan', 'thank you', '2021-11-23 10:56:21');

-- --------------------------------------------------------

--
-- Table structure for table `venture_scs`
--

CREATE TABLE `venture_scs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(15) NOT NULL,
  `work` varchar(255) NOT NULL,
  `apply` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venture_scs`
--

INSERT INTO `venture_scs` (`id`, `name`, `email`, `number`, `work`, `apply`, `subject`, `created_at`) VALUES
(25, 'Satheesh satheesh', 'satheeshss2001@gmail.com', '9361877853', 'pump', 'United States', 'ee', '2023-12-01 12:34:41'),
(26, 'Satheesh satheesh', 'satheeshss2001@gmail.com', '9361877853', 'pump', 'United States', 'gg', '2023-12-01 12:36:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_liked`
--
ALTER TABLE `blog_liked`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brochure_requests`
--
ALTER TABLE `brochure_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `career_applications`
--
ALTER TABLE `career_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scs_admin`
--
ALTER TABLE `scs_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scs_blog`
--
ALTER TABLE `scs_blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scs_comment`
--
ALTER TABLE `scs_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scs_mail`
--
ALTER TABLE `scs_mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scs_reply`
--
ALTER TABLE `scs_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venture_scs`
--
ALTER TABLE `venture_scs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_liked`
--
ALTER TABLE `blog_liked`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `brochure_requests`
--
ALTER TABLE `brochure_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `career_applications`
--
ALTER TABLE `career_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `scs_admin`
--
ALTER TABLE `scs_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scs_blog`
--
ALTER TABLE `scs_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `scs_comment`
--
ALTER TABLE `scs_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `scs_mail`
--
ALTER TABLE `scs_mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=513;

--
-- AUTO_INCREMENT for table `scs_reply`
--
ALTER TABLE `scs_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `venture_scs`
--
ALTER TABLE `venture_scs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
