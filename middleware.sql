-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 22, 2026 at 03:05 AM
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
-- Database: `middleware`
--

-- --------------------------------------------------------

--
-- Table structure for table `log_penjualan`
--

CREATE TABLE `log_penjualan` (
  `id` int(11) NOT NULL,
  `source_id` int(11) DEFAULT NULL,
  `action` varchar(64) NOT NULL,
  `message` text DEFAULT NULL,
  `meta` text DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_penjualan`
--

INSERT INTO `log_penjualan` (`id`, `source_id`, `action`, `message`, `meta`, `ip`, `user_agent`, `created_at`) VALUES
(5, 2004, 'resend_initiated', 'Admin requested resend', '{\"payload\":{\"action\":\"update-salesorder\",\"status\":\"INVOICED\",\"salesorder_id\":501039,\"salesorder_no\":\"SO-000501039\",\"invoice_id\":58852,\"invoice_no\":\"INV-000058852\",\"invoice_date\":\"2026-07-14T09:06:10.531Z\",\"contact_id\":39784,\"customer_name\":\"punyarahel\",\"customer_phone\":\"099xxx88\",\"customer_email\":\"raheljube@jubelio.com\",\"transaction_date\":\"2026-07-14T09:06:10.531Z\",\"created_date\":\"2026-07-14T09:06:11.073Z\",\"last_modified\":\"2026-07-15T08:04:04.105Z\",\"internal_status\":\"PROCESSING\",\"channel_status\":\"Processing\",\"source\":\"INTERNAL\",\"source_name\":\"INTERNAL\",\"store\":\"Toko Default\",\"store_name\":\"Toko Default\",\"store_id\":-100,\"location_id\":-1,\"location_name\":\"Pusat\",\"location_code\":\"123\",\"sub_total\":\"67000.0000\",\"total_disc\":\"0.0000\",\"total_tax\":\"0.0000\",\"grand_total\":\"67000.0000\",\"shipping_cost\":\"0.0000\",\"insurance_cost\":\"0.0000\",\"shipping_tax\":\"0.0000\",\"shipping_cost_discount\":\"0.0000\",\"buyer_shipping_cost\":\"0.0000\",\"shipping_full_name\":\"o\",\"shipping_phone\":\"099xxx88\",\"shipping_address\":\"Jalan MCC\",\"shipping_area\":\"\",\"shipping_city\":\"\",\"shipping_province\":\"\",\"shipping_post_code\":\"\",\"shipping_country\":\"\",\"courier\":\"Teman Express\",\"shipper\":\"Teman Express\",\"tracking_no\":\"\",\"tracking_number\":null,\"tracking_url\":null,\"picklist_no\":\"PICK-000011225\",\"picked_in\":11225,\"wms_status\":\"FINISH_PACK\",\"total_weight_in_kg\":\"2.150\",\"is_paid\":true,\"is_tax_included\":false,\"is_acknowledge\":true,\"is_label_printed\":true,\"label_printed_count\":1,\"package_count\":1,\"is_cod\":false,\"is_shipped\":null,\"use_shipping_insurance\":false,\"items\":[{\"salesorder_detail_id\":62507,\"item_id\":18885,\"item_code\":\"!POHON2\",\"item_name\":\"POHON racul kiyowo\",\"description\":\"POHON racul kiyowo\",\"barcode\":\"4905083062197\",\"qty\":\"1.0000\",\"qty_in_base\":\"1.0000\",\"unit\":\"Buah\",\"uom_id\":null,\"price\":\"11000.0000\",\"sell_price\":\"11000.0000\",\"original_price\":\"11000.0000\",\"amount\":\"11000.0000\",\"disc\":\"0.00\",\"disc_amount\":\"0.0000\",\"disc_marketplace\":\"0.0000\",\"tax_id\":1,\"tax_name\":\"No Tax\",\"tax_amount\":\"0.0000\",\"rate\":\"0.00\",\"weight_in_gram\":\"450.0000\",\"item_group_id\":10267,\"loc_id\":-1,\"loc_name\":\"Pusat\",\"thumbnail\":\"https:\\/\\/file-service.3smqg.upcloudobjects.com\\/images\\/ndnmuriwr1sspttrd3ddig\\/ec625bef-afeb-473c-a00a-66093ee4280a_thumb.jpeg\",\"is_bundle\":false,\"is_fbm\":false,\"fbm\":\"\",\"serials\":[]},{\"salesorder_detail_id\":62508,\"item_id\":18886,\"item_code\":\"!PUPUK1\",\"item_name\":\"Pupuk Organik Premium\",\"description\":\"Pupuk Organik Premium\",\"barcode\":\"8991234567890\",\"qty\":\"2.0000\",\"qty_in_base\":\"2.0000\",\"unit\":\"Sak\",\"uom_id\":null,\"price\":\"15000.0000\",\"sell_price\":\"15000.0000\",\"original_price\":\"15000.0000\",\"amount\":\"30000.0000\",\"disc\":\"0.00\",\"disc_amount\":\"0.0000\",\"disc_marketplace\":\"0.0000\",\"tax_id\":1,\"tax_name\":\"No Tax\",\"tax_amount\":\"0.0000\",\"rate\":\"0.00\",\"weight_in_gram\":\"500.0000\",\"item_group_id\":10267,\"loc_id\":-1,\"loc_name\":\"Pusat\",\"thumbnail\":\"\",\"is_bundle\":false,\"is_fbm\":false,\"fbm\":\"\",\"serials\":[]},{\"salesorder_detail_id\":62509,\"item_id\":18887,\"item_code\":\"!POT001\",\"item_name\":\"Pot Tanaman Besar\",\"description\":\"Pot Tanaman Besar\",\"barcode\":\"8999876543210\",\"qty\":\"2.0000\",\"qty_in_base\":\"2.0000\",\"unit\":\"Buah\",\"uom_id\":null,\"price\":\"13000.0000\",\"sell_price\":\"13000.0000\",\"original_price\":\"13000.0000\",\"amount\":\"26000.0000\",\"disc\":\"0.00\",\"disc_amount\":\"0.0000\",\"disc_marketplace\":\"0.0000\",\"tax_id\":1,\"tax_name\":\"No Tax\",\"tax_amount\":\"0.0000\",\"rate\":\"0.00\",\"weight_in_gram\":\"600.0000\",\"item_group_id\":10267,\"loc_id\":-1,\"loc_name\":\"Pusat\",\"thumbnail\":\"\",\"is_bundle\":false,\"is_fbm\":false,\"fbm\":\"\",\"serials\":[]}],\"extra_info\":[],\"extra_info_header\":[]}}', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-21 08:02:11'),
(6, 2004, 'resend_result', 'Result of admin resend', '{\"success\":false,\"body\":\"Konfigurasi D365 belum diisi.\",\"status_code\":0}', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-21 08:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `log_penjualan_cancel`
--

CREATE TABLE `log_penjualan_cancel` (
  `id` int(11) NOT NULL,
  `source_id` int(11) DEFAULT NULL,
  `action` varchar(64) NOT NULL,
  `message` text DEFAULT NULL,
  `meta` text DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_penjualan_cancel`
--

INSERT INTO `log_penjualan_cancel` (`id`, `source_id`, `action`, `message`, `meta`, `ip`, `user_agent`, `created_at`) VALUES
(3, 8, 'resend_initiated', 'Admin requested resend', '{\"payload\":{\"order_no\":\"SO-000500114\",\"salesorder_no\":\"SO-000500114\",\"customer_name\":\"punyarahel\",\"items\":[{\"item_id\":\"1708\",\"item_code\":\"TBB1\",\"item_name\":\"Test Barang Batch\",\"qty\":\"0.0000\",\"price\":\"10000.0000\",\"amount\":\"10000.0000\"},{\"item_id\":\"12714\",\"item_code\":\"TSN-WMS\",\"item_name\":\"TEST-SERIAL-WMS-2\",\"qty\":\"0.0000\",\"price\":\"12000.0000\",\"amount\":\"12000.0000\"}]}}', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-21 09:56:53'),
(4, 8, 'resend_result', 'Result of admin resend', '{\"success\":false,\"body\":\"Konfigurasi D365 belum diisi.\"}', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-21 09:56:53');

-- --------------------------------------------------------

--
-- Table structure for table `log_return_full`
--

CREATE TABLE `log_return_full` (
  `id` int(11) NOT NULL,
  `source_id` int(11) DEFAULT NULL,
  `action` varchar(64) NOT NULL,
  `message` text DEFAULT NULL,
  `meta` text DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_return_partial`
--

CREATE TABLE `log_return_partial` (
  `id` int(11) NOT NULL,
  `source_id` int(11) DEFAULT NULL,
  `action` varchar(64) NOT NULL,
  `message` text DEFAULT NULL,
  `meta` text DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_stock_opname`
--

CREATE TABLE `log_stock_opname` (
  `id` int(11) NOT NULL,
  `source_id` int(11) DEFAULT NULL,
  `action` varchar(64) NOT NULL,
  `message` text DEFAULT NULL,
  `meta` text DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `middleware_d365_config`
--

CREATE TABLE `middleware_d365_config` (
  `id` int(10) UNSIGNED NOT NULL,
  `tenant_id` varchar(100) NOT NULL,
  `client_id` varchar(100) NOT NULL,
  `client_secret` varchar(255) NOT NULL,
  `grant_type` varchar(64) NOT NULL DEFAULT 'client_credentials',
  `resource` varchar(255) NOT NULL COMMENT 'contoh: https://namaenv.operations.dynamics.com',
  `login_url` varchar(255) NOT NULL COMMENT 'https://login.microsoftonline.com/{tenantId}/oauth2/token',
  `base_url` varchar(255) NOT NULL COMMENT 'Base URL environment D365 F&O',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `middleware_d365_endpoint`
--

CREATE TABLE `middleware_d365_endpoint` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_type` varchar(50) NOT NULL COMMENT 'penjualan, penjualan_cancel, return_full, return_partial, stock_opname, bill_with_putaway_true',
  `endpoint_path` varchar(255) DEFAULT NULL COMMENT 'contoh: /data/SalesOrders',
  `http_method` varchar(10) NOT NULL DEFAULT 'POST',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `middleware_d365_endpoint`
--

INSERT INTO `middleware_d365_endpoint` (`id`, `transaction_type`, `endpoint_path`, `http_method`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'penjualan', '', 'POST', 1, '2026-07-16 06:56:37', '2026-07-16 06:56:37'),
(2, 'penjualan_cancel', '', 'POST', 1, '2026-07-16 06:56:37', '2026-07-16 06:56:37'),
(3, 'return_full', '', 'POST', 1, '2026-07-16 06:56:37', '2026-07-16 06:56:37'),
(4, 'return_partial', '', 'POST', 1, '2026-07-16 06:56:37', '2026-07-16 06:56:37'),
(5, 'stock_opname', '', 'POST', 1, '2026-07-16 06:56:37', '2026-07-16 06:56:37'),
(6, 'bill_with_putaway_true', '', 'POST', 1, '2026-07-22 00:00:00', '2026-07-22 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `middleware_penjualan`
--

CREATE TABLE `middleware_penjualan` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_no` varchar(100) NOT NULL,
  `customer_code` varchar(100) DEFAULT NULL,
  `total_amount` decimal(18,2) DEFAULT 0.00,
  `action` varchar(100) DEFAULT NULL,
  `order_status` varchar(100) DEFAULT NULL,
  `salesorder_id` int(11) DEFAULT NULL,
  `salesorder_no` varchar(100) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `invoice_no` varchar(100) DEFAULT NULL,
  `invoice_date` datetime DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(50) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `transaction_date` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `internal_status` varchar(100) DEFAULT NULL,
  `channel_status` varchar(100) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `source_name` varchar(100) DEFAULT NULL,
  `store` varchar(100) DEFAULT NULL,
  `store_name` varchar(150) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `location_name` varchar(150) DEFAULT NULL,
  `location_code` varchar(100) DEFAULT NULL,
  `sub_total` decimal(18,2) DEFAULT NULL,
  `total_disc` decimal(18,2) DEFAULT NULL,
  `total_tax` decimal(18,2) DEFAULT NULL,
  `grand_total` decimal(18,2) DEFAULT NULL,
  `shipping_cost` decimal(18,2) DEFAULT NULL,
  `insurance_cost` decimal(18,2) DEFAULT NULL,
  `shipping_tax` decimal(18,2) DEFAULT NULL,
  `shipping_cost_discount` decimal(18,2) DEFAULT NULL,
  `discount_marketplace` decimal(18,2) DEFAULT NULL,
  `service_fee` decimal(18,2) DEFAULT NULL,
  `order_processing_fee` decimal(18,2) DEFAULT NULL,
  `cod_fee` decimal(18,2) DEFAULT NULL,
  `buyer_shipping_cost` decimal(18,2) DEFAULT NULL,
  `shipping_full_name` varchar(255) DEFAULT NULL,
  `shipping_phone` varchar(50) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `shipping_area` varchar(150) DEFAULT NULL,
  `shipping_city` varchar(150) DEFAULT NULL,
  `shipping_province` varchar(150) DEFAULT NULL,
  `shipping_post_code` varchar(50) DEFAULT NULL,
  `shipping_country` varchar(100) DEFAULT NULL,
  `courier` varchar(150) DEFAULT NULL,
  `shipper` varchar(150) DEFAULT NULL,
  `tracking_no` varchar(150) DEFAULT NULL,
  `tracking_number` varchar(150) DEFAULT NULL,
  `tracking_url` varchar(255) DEFAULT NULL,
  `payload` longtext DEFAULT NULL,
  `status` enum('pending','sent','failed') NOT NULL DEFAULT 'pending',
  `response` longtext DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `middleware_penjualan`
--

INSERT INTO `middleware_penjualan` (`id`, `order_no`, `customer_code`, `total_amount`, `action`, `order_status`, `salesorder_id`, `salesorder_no`, `invoice_id`, `invoice_no`, `invoice_date`, `contact_id`, `customer_name`, `customer_phone`, `customer_email`, `transaction_date`, `created_date`, `last_modified`, `internal_status`, `channel_status`, `source`, `source_name`, `store`, `store_name`, `store_id`, `location_id`, `location_name`, `location_code`, `sub_total`, `total_disc`, `total_tax`, `grand_total`, `shipping_cost`, `insurance_cost`, `shipping_tax`, `shipping_cost_discount`, `discount_marketplace`, `service_fee`, `order_processing_fee`, `cod_fee`, `buyer_shipping_cost`, `shipping_full_name`, `shipping_phone`, `shipping_address`, `shipping_area`, `shipping_city`, `shipping_province`, `shipping_post_code`, `shipping_country`, `courier`, `shipper`, `tracking_no`, `tracking_number`, `tracking_url`, `payload`, `status`, `response`, `sent_at`, `created_at`, `updated_at`) VALUES
(2004, 'SO-000501039', '39784', 67000.00, 'update-salesorder', 'INVOICED', 501039, 'SO-000501039', 58852, 'INV-000058852', '2026-07-14 09:06:10', 39784, 'punyarahel', '099xxx88', 'raheljube@jubelio.com', '2026-07-14 09:06:10', '2026-07-14 09:06:11', '2026-07-15 08:04:04', 'PROCESSING', 'Processing', 'INTERNAL', 'INTERNAL', 'Toko Default', 'Toko Default', -100, -1, 'Pusat', '123', 67000.00, 0.00, 0.00, 67000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'o', '099xxx88', 'Jalan MCC', '', '', '', '', '', 'Teman Express', 'Teman Express', '', NULL, NULL, '{\"action\":\"update-salesorder\",\"status\":\"INVOICED\",\"salesorder_id\":501039,\"salesorder_no\":\"SO-000501039\",\"invoice_id\":58852,\"invoice_no\":\"INV-000058852\",\"invoice_date\":\"2026-07-14T09:06:10.531Z\",\"contact_id\":39784,\"customer_name\":\"punyarahel\",\"customer_phone\":\"099xxx88\",\"customer_email\":\"raheljube@jubelio.com\",\"transaction_date\":\"2026-07-14T09:06:10.531Z\",\"created_date\":\"2026-07-14T09:06:11.073Z\",\"last_modified\":\"2026-07-15T08:04:04.105Z\",\"internal_status\":\"PROCESSING\",\"channel_status\":\"Processing\",\"source\":\"INTERNAL\",\"source_name\":\"INTERNAL\",\"store\":\"Toko Default\",\"store_name\":\"Toko Default\",\"store_id\":-100,\"location_id\":-1,\"location_name\":\"Pusat\",\"location_code\":\"123\",\"sub_total\":\"67000.0000\",\"total_disc\":\"0.0000\",\"total_tax\":\"0.0000\",\"grand_total\":\"67000.0000\",\"shipping_cost\":\"0.0000\",\"insurance_cost\":\"0.0000\",\"shipping_tax\":\"0.0000\",\"shipping_cost_discount\":\"0.0000\",\"buyer_shipping_cost\":\"0.0000\",\"shipping_full_name\":\"o\",\"shipping_phone\":\"099xxx88\",\"shipping_address\":\"Jalan MCC\",\"shipping_area\":\"\",\"shipping_city\":\"\",\"shipping_province\":\"\",\"shipping_post_code\":\"\",\"shipping_country\":\"\",\"courier\":\"Teman Express\",\"shipper\":\"Teman Express\",\"tracking_no\":\"\",\"tracking_number\":null,\"tracking_url\":null,\"picklist_no\":\"PICK-000011225\",\"picked_in\":11225,\"wms_status\":\"FINISH_PACK\",\"total_weight_in_kg\":\"2.150\",\"is_paid\":true,\"is_tax_included\":false,\"is_acknowledge\":true,\"is_label_printed\":true,\"label_printed_count\":1,\"package_count\":1,\"is_cod\":false,\"is_shipped\":null,\"use_shipping_insurance\":false,\"items\":[{\"salesorder_detail_id\":62507,\"item_id\":18885,\"item_code\":\"!POHON2\",\"item_name\":\"POHON racul kiyowo\",\"description\":\"POHON racul kiyowo\",\"barcode\":\"4905083062197\",\"qty\":\"1.0000\",\"qty_in_base\":\"1.0000\",\"unit\":\"Buah\",\"uom_id\":null,\"price\":\"11000.0000\",\"sell_price\":\"11000.0000\",\"original_price\":\"11000.0000\",\"amount\":\"11000.0000\",\"disc\":\"0.00\",\"disc_amount\":\"0.0000\",\"disc_marketplace\":\"0.0000\",\"tax_id\":1,\"tax_name\":\"No Tax\",\"tax_amount\":\"0.0000\",\"rate\":\"0.00\",\"weight_in_gram\":\"450.0000\",\"item_group_id\":10267,\"loc_id\":-1,\"loc_name\":\"Pusat\",\"thumbnail\":\"https:\\/\\/file-service.3smqg.upcloudobjects.com\\/images\\/ndnmuriwr1sspttrd3ddig\\/ec625bef-afeb-473c-a00a-66093ee4280a_thumb.jpeg\",\"is_bundle\":false,\"is_fbm\":false,\"fbm\":\"\",\"serials\":[]},{\"salesorder_detail_id\":62508,\"item_id\":18886,\"item_code\":\"!PUPUK1\",\"item_name\":\"Pupuk Organik Premium\",\"description\":\"Pupuk Organik Premium\",\"barcode\":\"8991234567890\",\"qty\":\"2.0000\",\"qty_in_base\":\"2.0000\",\"unit\":\"Sak\",\"uom_id\":null,\"price\":\"15000.0000\",\"sell_price\":\"15000.0000\",\"original_price\":\"15000.0000\",\"amount\":\"30000.0000\",\"disc\":\"0.00\",\"disc_amount\":\"0.0000\",\"disc_marketplace\":\"0.0000\",\"tax_id\":1,\"tax_name\":\"No Tax\",\"tax_amount\":\"0.0000\",\"rate\":\"0.00\",\"weight_in_gram\":\"500.0000\",\"item_group_id\":10267,\"loc_id\":-1,\"loc_name\":\"Pusat\",\"thumbnail\":\"\",\"is_bundle\":false,\"is_fbm\":false,\"fbm\":\"\",\"serials\":[]},{\"salesorder_detail_id\":62509,\"item_id\":18887,\"item_code\":\"!POT001\",\"item_name\":\"Pot Tanaman Besar\",\"description\":\"Pot Tanaman Besar\",\"barcode\":\"8999876543210\",\"qty\":\"2.0000\",\"qty_in_base\":\"2.0000\",\"unit\":\"Buah\",\"uom_id\":null,\"price\":\"13000.0000\",\"sell_price\":\"13000.0000\",\"original_price\":\"13000.0000\",\"amount\":\"26000.0000\",\"disc\":\"0.00\",\"disc_amount\":\"0.0000\",\"disc_marketplace\":\"0.0000\",\"tax_id\":1,\"tax_name\":\"No Tax\",\"tax_amount\":\"0.0000\",\"rate\":\"0.00\",\"weight_in_gram\":\"600.0000\",\"item_group_id\":10267,\"loc_id\":-1,\"loc_name\":\"Pusat\",\"thumbnail\":\"\",\"is_bundle\":false,\"is_fbm\":false,\"fbm\":\"\",\"serials\":[]}],\"extra_info\":[],\"extra_info_header\":[]}', 'failed', NULL, NULL, '2026-07-21 07:47:09', '2026-07-21 08:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `middleware_penjualan_cancel`
--

CREATE TABLE `middleware_penjualan_cancel` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_no` varchar(100) NOT NULL,
  `salesorder_id` int(11) DEFAULT NULL,
  `salesorder_no` varchar(100) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(50) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `transaction_date` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `is_tax_included` tinyint(1) DEFAULT 0,
  `note` text DEFAULT NULL,
  `sub_total` decimal(18,4) DEFAULT NULL,
  `total_disc` decimal(18,4) DEFAULT NULL,
  `total_tax` decimal(18,4) DEFAULT NULL,
  `grand_total` decimal(18,4) DEFAULT NULL,
  `ref_no` varchar(100) DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `is_canceled` tinyint(1) DEFAULT 0,
  `cancel_reason` varchar(255) DEFAULT NULL,
  `cancel_reason_detail` varchar(255) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `is_paid` tinyint(1) DEFAULT 0,
  `channel_status` varchar(100) DEFAULT NULL,
  `shipping_cost` decimal(18,4) DEFAULT NULL,
  `insurance_cost` decimal(18,4) DEFAULT NULL,
  `shipping_full_name` varchar(255) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `shipping_area` varchar(150) DEFAULT NULL,
  `shipping_city` varchar(150) DEFAULT NULL,
  `shipping_province` varchar(150) DEFAULT NULL,
  `shipping_post_code` varchar(50) DEFAULT NULL,
  `shipping_country` varchar(100) DEFAULT NULL,
  `shipping_phone` varchar(50) DEFAULT NULL,
  `tracking_number` varchar(150) DEFAULT NULL,
  `courier` varchar(150) DEFAULT NULL,
  `service_fee` decimal(18,4) DEFAULT NULL,
  `buyer_shipping_cost` decimal(18,4) DEFAULT NULL,
  `package_count` int(11) DEFAULT NULL,
  `wms_status` varchar(100) DEFAULT NULL,
  `shipping_cost_discount` decimal(18,4) DEFAULT NULL,
  `discount_marketplace` decimal(18,4) DEFAULT NULL,
  `internal_cancel_date` datetime DEFAULT NULL,
  `tracking_url` varchar(255) DEFAULT NULL,
  `cod_fee` decimal(18,4) DEFAULT NULL,
  `total_weight_in_kg` decimal(18,4) DEFAULT NULL,
  `internal_status` varchar(100) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `invoice_no` varchar(100) DEFAULT NULL,
  `invoice_date` datetime DEFAULT NULL,
  `salesmen_name` varchar(255) DEFAULT NULL,
  `tracking_no` varchar(150) DEFAULT NULL,
  `source_name` varchar(100) DEFAULT NULL,
  `store_name` varchar(150) DEFAULT NULL,
  `location_name` varchar(150) DEFAULT NULL,
  `location_code` varchar(100) DEFAULT NULL,
  `picklist_no` varchar(100) DEFAULT NULL,
  `channel_id` int(11) DEFAULT NULL,
  `store` varchar(100) DEFAULT NULL,
  `cancel_date` datetime DEFAULT NULL,
  `payload` longtext DEFAULT NULL,
  `items_payload` longtext DEFAULT NULL,
  `status` enum('pending','sent','failed') NOT NULL DEFAULT 'pending',
  `response` longtext DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `middleware_penjualan_cancel`
--

INSERT INTO `middleware_penjualan_cancel` (`id`, `order_no`, `salesorder_id`, `salesorder_no`, `contact_id`, `customer_name`, `customer_phone`, `customer_email`, `transaction_date`, `created_date`, `last_modified`, `is_tax_included`, `note`, `sub_total`, `total_disc`, `total_tax`, `grand_total`, `ref_no`, `payment_method`, `location_id`, `is_canceled`, `cancel_reason`, `cancel_reason_detail`, `source`, `is_paid`, `channel_status`, `shipping_cost`, `insurance_cost`, `shipping_full_name`, `shipping_address`, `shipping_area`, `shipping_city`, `shipping_province`, `shipping_post_code`, `shipping_country`, `shipping_phone`, `tracking_number`, `courier`, `service_fee`, `buyer_shipping_cost`, `package_count`, `wms_status`, `shipping_cost_discount`, `discount_marketplace`, `internal_cancel_date`, `tracking_url`, `cod_fee`, `total_weight_in_kg`, `internal_status`, `invoice_id`, `invoice_no`, `invoice_date`, `salesmen_name`, `tracking_no`, `source_name`, `store_name`, `location_name`, `location_code`, `picklist_no`, `channel_id`, `store`, `cancel_date`, `payload`, `items_payload`, `status`, `response`, `sent_at`, `created_at`, `updated_at`) VALUES
(6, 'SO-000500114', 500114, 'SO-000500114', 39784, 'punyarahel', '099xxx88', 'raheljube@jubelio.com', '2026-07-08 07:44:46', '2026-07-08 07:44:46', '2026-07-08 07:45:58', 0, '', 22000.0000, 0.0000, 0.0000, 22000.0000, '', '', -1, 1, 'Stok Habis', NULL, 'INTERNAL', 1, 'canceled', 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"order_no\":\"SO-000500114\",\"salesorder_no\":\"SO-000500114\",\"customer_name\":\"punyarahel\",\"items\":[{\"item_id\":\"1708\",\"item_code\":\"TBB1\",\"item_name\":\"Test Barang Batch\",\"qty\":\"0.0000\",\"price\":\"10000.0000\",\"amount\":\"10000.0000\"},{\"item_id\":\"12714\",\"item_code\":\"TSN-WMS\",\"item_name\":\"TEST-SERIAL-WMS-2\",\"qty\":\"0.0000\",\"price\":\"12000.0000\",\"amount\":\"12000.0000\"}]}', NULL, 'pending', NULL, NULL, '2026-07-21 07:47:26', '2026-07-21 14:58:12'),
(7, 'SO-000500114', 500114, 'SO-000500114', 39784, 'punyarahel', '099xxx88', 'raheljube@jubelio.com', '2026-07-08 07:44:46', '2026-07-08 07:44:46', '2026-07-08 07:45:58', 0, '', 22000.0000, 0.0000, 0.0000, 22000.0000, '', '', -1, 1, 'Stok Habis', NULL, 'INTERNAL', 1, 'canceled', 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"order_no\":\"SO-000500114\",\"salesorder_no\":\"SO-000500114\",\"customer_name\":\"punyarahel\",\"items\":[{\"item_id\":\"1708\",\"item_code\":\"TBB1\",\"item_name\":\"Test Barang Batch\",\"qty\":\"0.0000\",\"price\":\"10000.0000\",\"amount\":\"10000.0000\"},{\"item_id\":\"12714\",\"item_code\":\"TSN-WMS\",\"item_name\":\"TEST-SERIAL-WMS-2\",\"qty\":\"0.0000\",\"price\":\"12000.0000\",\"amount\":\"12000.0000\"}]}', NULL, 'pending', NULL, NULL, '2026-07-21 07:50:49', '2026-07-21 14:58:12'),
(8, 'SO-000500114', 500114, 'SO-000500114', 39784, 'punyarahel', '099xxx88', 'raheljube@jubelio.com', '2026-07-08 07:44:46', '2026-07-08 07:44:46', '2026-07-08 07:45:58', 0, '', 22000.0000, 0.0000, 0.0000, 22000.0000, '', '', -1, 1, 'Stok Habis', NULL, 'INTERNAL', 1, 'canceled', 0.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"order_no\":\"SO-000500114\",\"salesorder_no\":\"SO-000500114\",\"customer_name\":\"punyarahel\",\"items\":[{\"item_id\":\"1708\",\"item_code\":\"TBB1\",\"item_name\":\"Test Barang Batch\",\"qty\":\"0.0000\",\"price\":\"10000.0000\",\"amount\":\"10000.0000\"},{\"item_id\":\"12714\",\"item_code\":\"TSN-WMS\",\"item_name\":\"TEST-SERIAL-WMS-2\",\"qty\":\"0.0000\",\"price\":\"12000.0000\",\"amount\":\"12000.0000\"}]}', NULL, 'failed', NULL, NULL, '2026-07-21 07:53:32', '2026-07-21 09:56:53');

-- --------------------------------------------------------

--
-- Table structure for table `middleware_penjualan_cancel_detail`
--

CREATE TABLE `middleware_penjualan_cancel_detail` (
  `id` int(11) NOT NULL,
  `cancel_id` int(11) NOT NULL,
  `salesorder_detail_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_code` varchar(100) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `qty` decimal(18,4) DEFAULT NULL,
  `qty_in_base` decimal(18,4) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `uom_id` int(11) DEFAULT NULL,
  `price` decimal(18,4) DEFAULT NULL,
  `sell_price` decimal(18,4) DEFAULT NULL,
  `original_price` decimal(18,4) DEFAULT NULL,
  `amount` decimal(18,4) DEFAULT NULL,
  `disc` decimal(18,4) DEFAULT NULL,
  `disc_amount` decimal(18,4) DEFAULT NULL,
  `disc_marketplace` decimal(18,4) DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `tax_name` varchar(100) DEFAULT NULL,
  `tax_amount` decimal(18,4) DEFAULT NULL,
  `rate` decimal(18,4) DEFAULT NULL,
  `weight_in_gram` decimal(18,4) DEFAULT NULL,
  `item_group_id` int(11) DEFAULT NULL,
  `loc_id` int(11) DEFAULT NULL,
  `loc_name` varchar(150) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `is_bundle` tinyint(1) DEFAULT 0,
  `is_fbm` tinyint(1) DEFAULT 0,
  `fbm` varchar(50) DEFAULT NULL,
  `serials` text DEFAULT NULL,
  `is_canceled_item` tinyint(1) DEFAULT 0,
  `status` varchar(100) DEFAULT NULL,
  `pick_scanned_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `middleware_penjualan_cancel_detail`
--

INSERT INTO `middleware_penjualan_cancel_detail` (`id`, `cancel_id`, `salesorder_detail_id`, `item_id`, `item_code`, `item_name`, `description`, `barcode`, `qty`, `qty_in_base`, `unit`, `uom_id`, `price`, `sell_price`, `original_price`, `amount`, `disc`, `disc_amount`, `disc_marketplace`, `tax_id`, `tax_name`, `tax_amount`, `rate`, `weight_in_gram`, `item_group_id`, `loc_id`, `loc_name`, `thumbnail`, `is_bundle`, `is_fbm`, `fbm`, `serials`, `is_canceled_item`, `status`, `pick_scanned_date`, `created_at`, `updated_at`) VALUES
(1, 1, 62443, 1708, 'TBB1', 'Test Barang Batch', 'Test Barang Batch', NULL, 0.0000, 1.0000, 'Buah', NULL, 10000.0000, 10000.0000, 10000.0000, 10000.0000, 0.0000, 0.0000, 0.0000, 1, 'No Tax', 0.0000, 0.0000, 10.0000, 777, -1, 'Pusat', 'https://assets-alpha.ass8c.upcloudobjects.com/ndnmuriwr1sspttrd3ddig/images/thumb_rug-1688630523187-0.jpg', 0, 0, '', '[{\"picked_serial_number_id\":6154,\"picklist_detail_id\":30190,\"pick_scanned_date\":\"2026-07-08T07:45:43.402198+00:00\",\"batch_no\":\"qwer\",\"serial_no\":null,\"bin_id\":1,\"qty\":1,\"expired_date\":\"2024-10-24T17:00:00+00:00\"},{\"picked_serial_number_id\":6155,\"picklist_detail_id\":30190,\"pick_scanned_date\":null,\"batch_no\":\"qwer\",\"serial_no\":null,\"bin_id\":1,\"qty\":-1,\"expired_date\":\"2024-10-24T17:00:00+00:00\"},{\"picked_serial_number_id\":6156,\"picklist_detail_id\":30190,\"pick_scanned_date\":null,\"batch_no\":\"qwer\",\"serial_no\":null,\"bin_id\":1,\"qty\":-1,\"expired_date\":\"2024-10-24T17:00:00+00:00\"},{\"picked_serial_number_id\":6157,\"picklist_detail_id\":30190,\"pick_scanned_date\":null,\"batch_no\":\"qwer\",\"serial_no\":null,\"bin_id\":1,\"qty\":1,\"expired_date\":\"2024-10-24T17:00:00+00:00\"}]', 1, NULL, '2026-07-08 09:45:43', '2026-07-17 04:37:47', '2026-07-17 04:37:47'),
(2, 1, 62444, 12714, 'TSN-WMS', 'TEST-SERIAL-WMS-2', 'TEST-SERIAL-WMS-2', NULL, 0.0000, 1.0000, 'Buah', NULL, 12000.0000, 12000.0000, 12000.0000, 12000.0000, 0.0000, 0.0000, 0.0000, 1, 'No Tax', 0.0000, 0.0000, 210.0000, 7628, -1, 'Pusat', 'https://assets-alpha.ass8c.upcloudobjects.com/ndnmuriwr1sspttrd3ddig/images/ndnmuriwr1sspttrd3ddig/thumb_gocar.jpeg', 0, 0, '', '[]', 1, NULL, NULL, '2026-07-17 04:37:47', '2026-07-17 04:37:47'),
(3, 4, NULL, NULL, 'ITEM1', 'Contoh Item', NULL, NULL, 1.0000, NULL, NULL, NULL, 100000.0000, NULL, NULL, 100000.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(4, 5, NULL, NULL, 'ITEM1', 'Contoh Item', NULL, NULL, 1.0000, NULL, NULL, NULL, 100000.0000, NULL, NULL, 100000.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(5, 6, NULL, 1708, 'TBB1', 'Test Barang Batch', NULL, NULL, 0.0000, NULL, NULL, NULL, 10000.0000, NULL, NULL, 10000.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(6, 6, NULL, 12714, 'TSN-WMS', 'TEST-SERIAL-WMS-2', NULL, NULL, 0.0000, NULL, NULL, NULL, 12000.0000, NULL, NULL, 12000.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(7, 7, NULL, 1708, 'TBB1', 'Test Barang Batch', NULL, NULL, 0.0000, NULL, NULL, NULL, 10000.0000, NULL, NULL, 10000.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(8, 7, NULL, 12714, 'TSN-WMS', 'TEST-SERIAL-WMS-2', NULL, NULL, 0.0000, NULL, NULL, NULL, 12000.0000, NULL, NULL, 12000.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(9, 8, NULL, 1708, 'TBB1', 'Test Barang Batch', NULL, NULL, 0.0000, NULL, NULL, NULL, 10000.0000, NULL, NULL, 10000.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(10, 8, NULL, 12714, 'TSN-WMS', 'TEST-SERIAL-WMS-2', NULL, NULL, 0.0000, NULL, NULL, NULL, 12000.0000, NULL, NULL, 12000.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `middleware_penjualan_detail`
--

CREATE TABLE `middleware_penjualan_detail` (
  `id` int(11) NOT NULL,
  `salesorder_no` varchar(100) NOT NULL,
  `salesorder_detail_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_code` varchar(100) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `qty` decimal(18,4) DEFAULT NULL,
  `qty_in_base` decimal(18,4) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `uom_id` int(11) DEFAULT NULL,
  `price` decimal(18,4) DEFAULT NULL,
  `sell_price` decimal(18,4) DEFAULT NULL,
  `original_price` decimal(18,4) DEFAULT NULL,
  `amount` decimal(18,4) DEFAULT NULL,
  `disc` decimal(18,4) DEFAULT NULL,
  `disc_amount` decimal(18,4) DEFAULT NULL,
  `disc_marketplace` decimal(18,4) DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `tax_name` varchar(100) DEFAULT NULL,
  `tax_amount` decimal(18,4) DEFAULT NULL,
  `rate` decimal(18,4) DEFAULT NULL,
  `weight_in_gram` decimal(18,4) DEFAULT NULL,
  `item_group_id` int(11) DEFAULT NULL,
  `loc_id` int(11) DEFAULT NULL,
  `loc_name` varchar(150) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `is_bundle` tinyint(1) DEFAULT 0,
  `is_fbm` tinyint(1) DEFAULT 0,
  `fbm` varchar(50) DEFAULT NULL,
  `serials` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `middleware_penjualan_detail`
--

INSERT INTO `middleware_penjualan_detail` (`id`, `salesorder_no`, `salesorder_detail_id`, `item_id`, `item_code`, `item_name`, `description`, `barcode`, `qty`, `qty_in_base`, `unit`, `uom_id`, `price`, `sell_price`, `original_price`, `amount`, `disc`, `disc_amount`, `disc_marketplace`, `tax_id`, `tax_name`, `tax_amount`, `rate`, `weight_in_gram`, `item_group_id`, `loc_id`, `loc_name`, `thumbnail`, `is_bundle`, `is_fbm`, `fbm`, `serials`, `created_at`, `updated_at`) VALUES
(4005, 'SO-000501039', 62507, 18885, '!POHON2', 'POHON racul kiyowo', 'POHON racul kiyowo', '4905083062197', 1.0000, 1.0000, 'Buah', NULL, 11000.0000, 11000.0000, 11000.0000, 11000.0000, 0.0000, 0.0000, 0.0000, 1, 'No Tax', 0.0000, 0.0000, 450.0000, 10267, -1, 'Pusat', 'https://file-service.3smqg.upcloudobjects.com/images/ndnmuriwr1sspttrd3ddig/ec625bef-afeb-473c-a00a-66093ee4280a_thumb.jpeg', 0, 0, '', '[]', NULL, NULL),
(4006, 'SO-000501039', 62508, 18886, '!PUPUK1', 'Pupuk Organik Premium', 'Pupuk Organik Premium', '8991234567890', 2.0000, 2.0000, 'Sak', NULL, 15000.0000, 15000.0000, 15000.0000, 30000.0000, 0.0000, 0.0000, 0.0000, 1, 'No Tax', 0.0000, 0.0000, 500.0000, 10267, -1, 'Pusat', '', 0, 0, '', '[]', NULL, NULL),
(4007, 'SO-000501039', 62509, 18887, '!POT001', 'Pot Tanaman Besar', 'Pot Tanaman Besar', '8999876543210', 2.0000, 2.0000, 'Buah', NULL, 13000.0000, 13000.0000, 13000.0000, 26000.0000, 0.0000, 0.0000, 0.0000, 1, 'No Tax', 0.0000, 0.0000, 600.0000, 10267, -1, 'Pusat', '', 0, 0, '', '[]', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `middleware_return_full`
--

CREATE TABLE `middleware_return_full` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_no` varchar(100) NOT NULL,
  `return_no` varchar(100) DEFAULT NULL,
  `return_date` datetime DEFAULT NULL,
  `salesorder_id` int(11) DEFAULT NULL,
  `salesorder_no` varchar(100) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(100) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `transaction_date` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `internal_status` varchar(100) DEFAULT NULL,
  `channel_status` varchar(100) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `source_name` varchar(100) DEFAULT NULL,
  `store` varchar(255) DEFAULT NULL,
  `store_name` varchar(255) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `location_name` varchar(255) DEFAULT NULL,
  `location_code` varchar(100) DEFAULT NULL,
  `sub_total` decimal(15,4) DEFAULT NULL,
  `total_disc` decimal(15,4) DEFAULT NULL,
  `total_tax` decimal(15,4) DEFAULT NULL,
  `grand_total` decimal(15,4) DEFAULT NULL,
  `shipping_cost` decimal(15,4) DEFAULT NULL,
  `insurance_cost` decimal(15,4) DEFAULT NULL,
  `shipping_tax` decimal(15,4) DEFAULT NULL,
  `shipping_full_name` varchar(255) DEFAULT NULL,
  `shipping_phone` varchar(100) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `shipping_area` varchar(255) DEFAULT NULL,
  `shipping_city` varchar(255) DEFAULT NULL,
  `shipping_province` varchar(255) DEFAULT NULL,
  `shipping_post_code` varchar(50) DEFAULT NULL,
  `shipping_country` varchar(255) DEFAULT NULL,
  `courier` varchar(255) DEFAULT NULL,
  `shipper` varchar(255) DEFAULT NULL,
  `tracking_no` varchar(255) DEFAULT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `tracking_url` text DEFAULT NULL,
  `payload` longtext DEFAULT NULL,
  `status` enum('pending','sent','failed') NOT NULL DEFAULT 'pending',
  `response` longtext DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `middleware_return_full`
--

INSERT INTO `middleware_return_full` (`id`, `order_no`, `return_no`, `return_date`, `payload`, `status`, `response`, `sent_at`, `created_at`, `updated_at`) VALUES
(1, 'TEST-RETURN-FULL-001', 'RTN-001', '2026-07-21 05:57:28', '{\"order_no\":\"TEST-RETURN-FULL-001\",\"return_no\":\"RTN-001\"}', 'pending', NULL, NULL, '2026-07-21 05:57:28', '2026-07-21 05:57:28');

-- --------------------------------------------------------

--
-- Table structure for table `middleware_return_partial`
--

CREATE TABLE `middleware_return_partial` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_no` varchar(100) NOT NULL,
  `return_no` varchar(100) DEFAULT NULL,
  `return_date` datetime DEFAULT NULL,
  `salesorder_id` int(11) DEFAULT NULL,
  `salesorder_no` varchar(100) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(100) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `transaction_date` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `internal_status` varchar(100) DEFAULT NULL,
  `channel_status` varchar(100) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `source_name` varchar(100) DEFAULT NULL,
  `store` varchar(255) DEFAULT NULL,
  `store_name` varchar(255) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `location_name` varchar(255) DEFAULT NULL,
  `location_code` varchar(100) DEFAULT NULL,
  `sub_total` decimal(15,4) DEFAULT NULL,
  `total_disc` decimal(15,4) DEFAULT NULL,
  `total_tax` decimal(15,4) DEFAULT NULL,
  `grand_total` decimal(15,4) DEFAULT NULL,
  `shipping_cost` decimal(15,4) DEFAULT NULL,
  `insurance_cost` decimal(15,4) DEFAULT NULL,
  `shipping_tax` decimal(15,4) DEFAULT NULL,
  `shipping_full_name` varchar(255) DEFAULT NULL,
  `shipping_phone` varchar(100) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `shipping_area` varchar(255) DEFAULT NULL,
  `shipping_city` varchar(255) DEFAULT NULL,
  `shipping_province` varchar(255) DEFAULT NULL,
  `shipping_post_code` varchar(50) DEFAULT NULL,
  `shipping_country` varchar(255) DEFAULT NULL,
  `courier` varchar(255) DEFAULT NULL,
  `shipper` varchar(255) DEFAULT NULL,
  `tracking_no` varchar(255) DEFAULT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `tracking_url` text DEFAULT NULL,
  `payload` longtext DEFAULT NULL,
  `status` enum('pending','sent','failed') NOT NULL DEFAULT 'pending',
  `response` longtext DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `middleware_return_partial`
--

INSERT INTO `middleware_return_partial` (`id`, `order_no`, `return_no`, `return_date`, `payload`, `status`, `response`, `sent_at`, `created_at`, `updated_at`) VALUES
(1, 'TEST-RETURN-PARTIAL-001', 'RTN-002', '2026-07-21 05:57:28', '{\"order_no\":\"TEST-RETURN-PARTIAL-001\",\"return_no\":\"RTN-002\"}', 'pending', NULL, NULL, '2026-07-21 05:57:28', '2026-07-21 05:57:28');

-- --------------------------------------------------------

--
-- Table structure for table `middleware_stock_opname`
--

CREATE TABLE `middleware_stock_opname` (
  `id` int(10) UNSIGNED NOT NULL,
  `warehouse_code` varchar(100) NOT NULL,
  `opname_date` datetime DEFAULT NULL,
  `total_items` int(11) DEFAULT 0,
  `payload` longtext DEFAULT NULL,
  `status` enum('pending','sent','failed') NOT NULL DEFAULT 'pending',
  `response` longtext DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `middleware_stock_opname`
--

INSERT INTO `middleware_stock_opname` (`id`, `warehouse_code`, `opname_date`, `total_items`, `payload`, `status`, `response`, `sent_at`, `created_at`, `updated_at`) VALUES
(1, 'WH1', '2026-07-21 05:57:28', 2, '{"warehouse_code":"WH1","total_items":"2"}', 'pending', NULL, NULL, '2026-07-21 05:57:28', '2026-07-21 05:57:28');

-- --------------------------------------------------------

--
-- Table structure for table `log_bill_with_putaway_true`
--

CREATE TABLE `log_bill_with_putaway_true` (
  `id` int(11) NOT NULL,
  `source_id` int(11) DEFAULT NULL,
  `action` varchar(64) NOT NULL,
  `message` text DEFAULT NULL,
  `meta` text DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `middleware_bill_with_putaway_true`
--

CREATE TABLE `middleware_bill_with_putaway_true` (
  `id` int(10) UNSIGNED NOT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `bill_no` varchar(100) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `supplier_name` varchar(255) DEFAULT NULL,
  `transaction_date` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `is_tax_included` tinyint(1) DEFAULT 0,
  `note` text DEFAULT NULL,
  `sub_total` decimal(18,4) DEFAULT NULL,
  `total_disc` decimal(18,4) DEFAULT NULL,
  `total_tax` decimal(18,4) DEFAULT NULL,
  `grand_total` decimal(18,4) DEFAULT NULL,
  `ref_no` varchar(100) DEFAULT NULL,
  `is_opening_balance` tinyint(1) DEFAULT 0,
  `payment` decimal(18,4) DEFAULT NULL,
  `payment_acct_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `purchaseorder_id` int(11) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `is_consignment` tinyint(1) DEFAULT 0,
  `created_by` varchar(100) DEFAULT NULL,
  `payment_term` varchar(100) DEFAULT NULL,
  `auto_placement` tinyint(1) DEFAULT 0,
  `attachment` text DEFAULT NULL,
  `add_cost` decimal(18,4) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `tag_ids` text DEFAULT NULL,
  `header_note` text DEFAULT NULL,
  `is_closed` tinyint(1) DEFAULT 0,
  `purchaseorder_no` varchar(100) DEFAULT NULL,
  `location_name` varchar(255) DEFAULT NULL,
  `payment_amount` decimal(18,4) DEFAULT NULL,
  `add_cost_detail` longtext DEFAULT NULL,
  `is_putaway` tinyint(1) DEFAULT 0,
  `items_payload` longtext DEFAULT NULL,
  `payload` longtext DEFAULT NULL,
  `status` enum('pending','sent','failed') NOT NULL DEFAULT 'pending',
  `response` longtext DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) UNSIGNED NOT NULL,
  `idproduct` varchar(50) DEFAULT NULL,
  `namaproduct` varchar(100) DEFAULT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `idproduct`, `namaproduct`, `harga`) VALUES
(16933, 'P001', 'Laptop Lenovo', 15000000),
(16934, 'P001', 'Laptop Lenovo', 15000000),
(16935, 'P001', 'Contoh Product', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `shift_request`
--

CREATE TABLE `shift_request` (
  `id` int(11) NOT NULL,
  `retail_channel_id` varchar(50) DEFAULT NULL,
  `open_store` varchar(20) DEFAULT NULL,
  `close_store` varchar(20) DEFAULT NULL,
  `dataareaid` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shift_request`
--

INSERT INTO `shift_request` (`id`, `retail_channel_id`, `open_store`, `close_store`, `dataareaid`, `created_at`) VALUES
(17, '000310', '1736850600460', '', 'USMF', '2026-05-28 04:29:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_penjualan`
--
ALTER TABLE `log_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `source_id` (`source_id`),
  ADD KEY `action` (`action`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `log_penjualan_cancel`
--
ALTER TABLE `log_penjualan_cancel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `source_id` (`source_id`),
  ADD KEY `action` (`action`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `log_return_full`
--
ALTER TABLE `log_return_full`
  ADD PRIMARY KEY (`id`),
  ADD KEY `source_id` (`source_id`),
  ADD KEY `action` (`action`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `log_return_partial`
--
ALTER TABLE `log_return_partial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `source_id` (`source_id`),
  ADD KEY `action` (`action`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `log_stock_opname`
--
ALTER TABLE `log_stock_opname`
  ADD PRIMARY KEY (`id`),
  ADD KEY `source_id` (`source_id`),
  ADD KEY `action` (`action`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `middleware_d365_config`
--
ALTER TABLE `middleware_d365_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `middleware_d365_endpoint`
--
ALTER TABLE `middleware_d365_endpoint`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_transaction_type` (`transaction_type`);

--
-- Indexes for table `middleware_penjualan`
--
ALTER TABLE `middleware_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `middleware_penjualan_cancel`
--
ALTER TABLE `middleware_penjualan_cancel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `middleware_penjualan_cancel_detail`
--
ALTER TABLE `middleware_penjualan_cancel_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_cancel_id` (`cancel_id`);

--
-- Indexes for table `middleware_penjualan_detail`
--
ALTER TABLE `middleware_penjualan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_salesorder_no` (`salesorder_no`);

--
-- Indexes for table `middleware_return_full`
--
ALTER TABLE `middleware_return_full`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `middleware_return_partial`
--
ALTER TABLE `middleware_return_partial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `middleware_stock_opname`
--
ALTER TABLE `middleware_stock_opname`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_bill_with_putaway_true`
--
ALTER TABLE `log_bill_with_putaway_true`
  ADD PRIMARY KEY (`id`),
  ADD KEY `source_id` (`source_id`),
  ADD KEY `action` (`action`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `middleware_bill_with_putaway_true`
--
ALTER TABLE `middleware_bill_with_putaway_true`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_no` (`bill_no`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shift_request`
--
ALTER TABLE `shift_request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_penjualan`
--
ALTER TABLE `log_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `log_penjualan_cancel`
--
ALTER TABLE `log_penjualan_cancel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `log_return_full`
--
ALTER TABLE `log_return_full`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_return_partial`
--
ALTER TABLE `log_return_partial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_bill_with_putaway_true`
--
ALTER TABLE `log_bill_with_putaway_true`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_stock_opname`
--
ALTER TABLE `log_stock_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `middleware_d365_config`
--
ALTER TABLE `middleware_d365_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `middleware_d365_endpoint`
--
ALTER TABLE `middleware_d365_endpoint`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `middleware_penjualan`
--
ALTER TABLE `middleware_penjualan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2005;

--
-- AUTO_INCREMENT for table `middleware_penjualan_cancel`
--
ALTER TABLE `middleware_penjualan_cancel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `middleware_penjualan_cancel_detail`
--
ALTER TABLE `middleware_penjualan_cancel_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `middleware_penjualan_detail`
--
ALTER TABLE `middleware_penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4008;

--
-- AUTO_INCREMENT for table `middleware_return_full`
--
ALTER TABLE `middleware_return_full`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `middleware_return_partial`
--
ALTER TABLE `middleware_return_partial`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `middleware_stock_opname`
--
ALTER TABLE `middleware_stock_opname`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `middleware_bill_with_putaway_true`
--
ALTER TABLE `middleware_bill_with_putaway_true`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16936;

--
-- AUTO_INCREMENT for table `shift_request`
--
ALTER TABLE `shift_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
