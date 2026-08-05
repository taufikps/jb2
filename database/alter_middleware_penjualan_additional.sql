-- Add additional storage for packages, wms_statuses, escrow_list and extra header info for middleware_penjualan
-- Run this script directly against your database.

ALTER TABLE middleware_penjualan
  ADD COLUMN IF NOT EXISTS items_payload LONGTEXT DEFAULT NULL AFTER payload,
  ADD COLUMN IF NOT EXISTS extra_info_header LONGTEXT DEFAULT NULL AFTER tracking_url;

CREATE TABLE IF NOT EXISTS middleware_penjualan_package (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  salesorder_no VARCHAR(100) DEFAULT NULL,
  package_id INT DEFAULT NULL,
  package_number VARCHAR(100) DEFAULT NULL,
  weight_kg DECIMAL(10,4) DEFAULT NULL,
  courier_code VARCHAR(100) DEFAULT NULL,
  tracking_no VARCHAR(150) DEFAULT NULL,
  created_at DATETIME DEFAULT NULL,
  INDEX idx_pkg_salesorder_no (salesorder_no)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS middleware_penjualan_wms_status (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  salesorder_no VARCHAR(100) DEFAULT NULL,
  status_code VARCHAR(100) DEFAULT NULL,
  updated_at DATETIME DEFAULT NULL,
  updated_by VARCHAR(100) DEFAULT NULL,
  created_at DATETIME DEFAULT NULL,
  INDEX idx_wms_salesorder_no (salesorder_no)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS middleware_penjualan_escrow (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  salesorder_no VARCHAR(100) DEFAULT NULL,
  escrow_id INT DEFAULT NULL,
  amount DECIMAL(18,4) DEFAULT NULL,
  settlement_status VARCHAR(100) DEFAULT NULL,
  released_date DATETIME DEFAULT NULL,
  created_at DATETIME DEFAULT NULL,
  INDEX idx_escrow_salesorder_no (salesorder_no)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
