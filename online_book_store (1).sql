-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2026 at 10:31 AM
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
-- Database: `online_book_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `description`, `price`, `category_id`, `image_path`, `stock`, `created_at`) VALUES
(1, 'The Great Novel', 'John Writer', 'Interesting story', 350.00, 1, '1779026054WIN_20240923_23_35_38_Pro.jpg', 12, '2026-05-16 21:15:29'),
(2, 'Space Future', 'Alex Ray', 'Sci-fi adventure', 500.00, 3, NULL, 5, '2026-05-16 21:15:29'),
(3, 'Literary World', 'Sarah Khan', 'Classic literature', 400.00, 2, NULL, 8, '2026-05-16 21:15:29');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Novel', '2026-05-16 20:54:09'),
(2, 'Literature', '2026-05-16 20:54:09'),
(3, 'Sci-Fi', '2026-05-16 20:54:09'),
(4, 'History', '2026-05-16 20:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','confirmed','shipped','delivered') DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `shipping_address`, `total_amount`, `status`, `payment_method`, `order_date`) VALUES
(1, 3, 'rajshahi', 350.00, 'delivered', NULL, '2026-05-17 21:34:52'),
(2, 3, 'Mirpur', 350.00, 'shipped', NULL, '2026-05-17 21:40:46'),
(3, 1, 'bashundhara', 500.00, '', NULL, '2026-05-18 04:10:36'),
(4, 4, 'Mirpur', 350.00, 'shipped', NULL, '2026-05-18 04:44:13');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `book_id`, `quantity`, `unit_price`) VALUES
(1, 1, 1, 1, NULL),
(2, 2, 1, 1, NULL),
(3, 3, 2, 1, NULL),
(4, 4, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `amount`, `payment_method`, `transaction_id`, `payment_date`) VALUES
(1, 1, 350.00, 'Bkash', NULL, '2026-05-17 21:34:52'),
(2, 2, 350.00, 'Card', NULL, '2026-05-17 21:40:46'),
(3, 3, 500.00, 'Bkash', NULL, '2026-05-18 04:10:36'),
(4, 4, 350.00, 'Nagad', NULL, '2026-05-18 04:44:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `role` enum('admin','customer') DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `role`, `profile_picture`, `address`, `phone`, `created_at`) VALUES
(1, 'Atik', 'foisalatik08@gmail.com', '$2y$10$Taa9eHjy.BC3lxA8xdTTNu4ACLTUbt7//V6f8NKooW0F96eU43TiO', 'customer', '1779003897WIN_20240205_20_00_56_Pro.jpg', 'rajshahi', '01791944937', '2026-05-16 21:04:53'),
(2, 'Labib', 'labib@gmail.com', '$2y$10$rrg9CXZJz1666yZghfkqiOd7KgaNuK8Jb2WWKnwTfY584s77tRkY6', 'admin', NULL, 'Mirpur', '014785454545', '2026-05-17 12:54:06'),
(3, 'nabin', '01511@gmail.com', '$2y$10$lfQRBX1DF2nDWkBucpGwLuM.ZosueM8Hb0BRp4hmwgEzgR5Ci5/8O', 'customer', NULL, 'Naogaon', '01521744746', '2026-05-17 21:29:25'),
(4, 'Nafis', 'nafis@gmail.com', '$2y$10$W3iUuNK1fZOfARwwBthoh.cheNPGnfz73Wk/ejQJWBJOaoNjmfeFG', 'customer', NULL, 'Khulna', '01948808150', '2026-05-18 04:43:38'),
(5, 'SE work', 'sework@gmail.com', '$2y$10$KxiIPYtP3Qy4UPoFsdEW2eALXotqOrDJCPOQDXraxVtW6iE4HSamK', 'customer', NULL, 'raj', '01511111182', '2026-05-18 07:23:19'),
(6, 'SE work1', 'sework1@gmail.com', '$2y$10$QFVe9KkjoGLJnxYKsPGcdOff8cbz49vbAVWwhRZAH07fG3z1T3xua', 'customer', NULL, 'raj', '01511111183', '2026-05-18 07:27:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
