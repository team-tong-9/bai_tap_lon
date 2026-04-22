-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2026 at 02:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_motovn`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-04-05 20:12:42', '2026-04-05 20:12:42'),
(2, 2, '2026-04-05 21:09:27', '2026-04-05 21:09:27'),
(3, 4, '2026-04-14 17:49:10', '2026-04-14 17:49:10');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(7, 3, 6, 1, '2026-04-14 17:53:04', '2026-04-14 17:53:04'),
(8, 3, 4, 1, '2026-04-14 17:53:11', '2026-04-14 17:53:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_04_05_150513_create_products_table', 1),
(6, '2026_04_05_150522_add_phone_address_admin_to_users_table', 1),
(7, '2026_04_05_150527_create_carts_table', 1),
(8, '2026_04_05_150528_create_cart_items_table', 1),
(9, '2026_04_05_150534_create_orders_table', 1),
(10, '2026_04_05_150535_create_order_items_table', 1),
(11, '2026_04_15_024907_add_payment_fields_to_orders_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `total_amount` decimal(15,0) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) NOT NULL DEFAULT 'cod',
  `payment_method_detail` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `payment_date` varchar(255) DEFAULT NULL,
  `shipping_address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `invoice_number`, `total_amount`, `status`, `payment_method`, `payment_method_detail`, `payment_status`, `payment_date`, `shipping_address`, `phone`, `notes`, `admin_notes`, `created_at`, `updated_at`) VALUES
(1, 1, 'ORD-69D32B0E64E76', NULL, 38900000, 'pending', 'cod', NULL, 'unpaid', NULL, 'hà nội', '0123567843', NULL, NULL, '2026-04-05 20:39:58', '2026-04-05 20:39:58'),
(2, 2, 'ORD-69D3320CA0289', 'INV-20260417-7950', 153690000, 'completed', 'cod', NULL, 'refunded', NULL, 'hà nội', '0123567843', NULL, NULL, '2026-04-05 21:09:48', '2026-04-16 20:15:51'),
(3, 4, 'ORD-69DEE09264628', 'INV-20260415-5223', 34855000, 'completed', 'cod', 'Tiền Mặt', 'paid', '2026-04-15 02:57:49', '212', '0987321456', NULL, 'ok', '2026-04-14 17:49:22', '2026-04-14 19:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(15,0) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(15,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `price`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'Honda Vision', 38900000, 1, 38900000, '2026-04-05 20:39:58', '2026-04-05 20:39:58'),
(2, 2, 6, 'SH 350i', 153690000, 1, 153690000, '2026-04-05 21:09:48', '2026-04-05 21:09:48'),
(3, 3, 8, 'Yamaha PG-1', 34855000, 1, 34855000, '2026-04-14 17:49:22', '2026-04-14 17:49:22');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `price` decimal(15,0) NOT NULL,
  `engine_cc` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `brand`, `model`, `year`, `price`, `engine_cc`, `color`, `description`, `image`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'Honda Winner X', 'Honda', 'Winner X', 2024, 45900000, '150cc', 'Đen - Đỏ', 'Xe côn tay thể thao với động cơ DOHC 150cc, thiết kế thể thao, tiết kiệm nhiên liệu.', '/images/products/1775448407_honda-winner-x.jpg', 10, '2026-04-05 08:21:31', '2026-04-05 21:06:47'),
(2, 'Yamaha Exciter 155', 'Yamaha', 'Exciter 155 VVA', 2024, 48900000, '155cc', 'Xanh - Đen', 'Xe côn tay thể thao với công nghệ VVA, thiết kế thể thao mạnh mẽ.', '/images/products/1775448389_yamaha-exciter-155.jpg', 8, '2026-04-05 08:21:31', '2026-04-05 21:06:29'),
(3, 'Honda Air Blade', 'Honda', 'Air Blade', 2024, 42900000, '125cc', 'Đen - Xám', 'Xe tay ga thể thao bán chạy nhất Việt Nam, động cơ eSP 125cc.', '/images/products/1775448378_honda-air-blade.jpg', 15, '2026-04-05 08:21:31', '2026-04-05 21:06:18'),
(4, 'Yamaha NVX 155', 'Yamaha', 'NVX 155', 2024, 53900000, '155cc', 'Đen - Xanh', 'Xe tay ga thể thao, động cơ VVA 155cc, thiết kế thể thao.', '/images/products/1775448367_yamaha-nvx-155.jpg', 12, '2026-04-05 08:21:31', '2026-04-05 21:06:07'),
(5, 'Honda Vision', 'Honda', 'Vision', 2024, 38900000, '110cc', 'Trắng - Hồng', 'Xe tay ga nhỏ gọn, tiết kiệm nhiên liệu, phù hợp với phái nữ.', '/images/products/1775448322_honda-vision.jpg', 19, '2026-04-05 08:21:31', '2026-04-05 21:05:22'),
(6, 'SH 350i', 'Honda', 'SH 350i', 2025, 153690000, '329cc', 'Màu trắng, đỏ, đen nhám, xám bạc.', 'Honda SH350i 2025 là dòng xe tay ga cao cấp nhập khẩu/lắp ráp trong nước, nổi bật với thiết kế châu Âu sang trọng, động cơ eSP+ 330cc mạnh mẽ đạt tiêu chuẩn Euro 4. Xe trang bị phanh ABS 2 kênh, HSTC (kiểm soát lực xoắn), khóa thông minh, và đèn LED toàn bộ', '/images/products/1775448225_sh-350i.jpg', 103, '2026-04-05 21:03:45', '2026-04-05 21:09:48'),
(7, 'Honda AVD350', 'Honda', 'Honda AVD350', 2021, 165990000, '330cc', 'Đen - Xám', 'Honda ADV350 được trang bị động cơ eSP+ xi-lanh đơn, 4 van, làm mát bằng dung dịch, có dung tích thực là 330cc (phân khối). Xe sản sinh công suất tối đa khoảng 28,8 - 29,3 mã lực và mô-men xoắn cực đại 31,5 - 31,8 Nm, mang lại hiệu suất vận hành mạnh mẽ', '/images/products/1775450959_honda-avd350.jpg', 12, '2026-04-05 21:49:19', '2026-04-05 21:49:19'),
(8, 'Yamaha PG-1', 'Honda', 'Yamaha PG-1', 2023, 34855000, '113,7cc', 'Đen - Xám', 'Yamaha PG-1 ABS mới dành cho thế hệ yêu tự do và đam mê dịch chuyển. Với thiết kế mang phong cách scrambler pha retro - hiện đại, PG-1 ABS mới khiến mỗi chuyến đi của bạn đều trở thành hành trình tận hưởng, từ phố thị đến ngoại thành, kết nối trọn vẹn với những sắc màu văn hóa trong cuộc sống hằng ngày.', '/images/products/1775616846_yamaha-pg-1.jpg', 35, '2026-04-07 19:54:06', '2026-04-14 17:49:22'),
(9, 'YZF-R15', 'Yamaha', 'YZF-R15', 2008, 78000000, '155cc', 'Xanh GP', 'Yamaha YZF-R15 là mẫu xe thể thao dung tích xy lanh 155cc, sở hữu những đường nét thừa hưởng DNA từ \"đàn anh\" YZF-R1. Xe được trang bị nhiều công nghệ hiện đại, hệ thống phun xăng điện tử và van biến thiên VVA giúp xe vừa tiết kiệm nhiên liệu, vừa phát huy được khả năng vận hành bền bỉ, đem lại các trải nghiệm phấn khích cho các tay lái.', '/images/products/1776395675_yzf-r15.jpg', 36, '2026-04-16 20:14:35', '2026-04-16 20:14:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `avatar`, `is_admin`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@shopmotovn.com', NULL, NULL, NULL, 1, NULL, '$2y$12$WoZiDMGpvDMWNIxkCxglUuBmLk1oRJtiEHSPWaVc8f7y4ZcnJaZsG', NULL, '2026-04-05 08:21:53', '2026-04-05 08:21:53'),
(2, 'MaiDucTrung', 'maiductrung123@gmail.com', NULL, NULL, NULL, 0, NULL, '$2y$12$74cfqCX3XwjOgo96DjdNqu4MhkFBsCtom6acdkDyu/Zp9.2.4LvFW', NULL, '2026-04-05 21:09:05', '2026-04-05 21:09:05'),
(4, 'VuTheMinh', 'vutheminh@gmail.com', '0987321456', NULL, NULL, 0, NULL, '$2y$12$emeGuA5SLIthrseA5EfY/enpLAur9XrxdtPb0GgDEpSlS6YHI.Uv6', NULL, '2026-04-14 17:48:31', '2026-04-14 17:48:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
