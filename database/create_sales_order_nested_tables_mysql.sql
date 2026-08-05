-- MySQL DDL for nested sales order structures
-- Creates: sales_order_item_serials, sales_order_packages, sales_order_wms_histories, sales_order_escrows
-- Assumes existing tables: `middleware_penjualan` (orders) and `middleware_penjualan_detail` (order items)
-- Uses InnoDB and utf8mb4

SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE IF NOT EXISTS sales_order_item_serials (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  salesorder_internal_id INT(10) UNSIGNED NOT NULL,
  salesorder_id BIGINT NULL,
  salesorder_no VARCHAR(100) NULL,
  salesorder_detail_internal_id INT(11) DEFAULT NULL,
  salesorder_detail_id BIGINT DEFAULT NULL,
  serial_id INT DEFAULT NULL,
  serial_number VARCHAR(255) NOT NULL,
  extra_info JSON DEFAULT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_so_internal (salesorder_internal_id),
  INDEX idx_so_detail_internal (salesorder_detail_internal_id),
  INDEX idx_serial_id (serial_id),
  CONSTRAINT fk_serials_so_internal FOREIGN KEY (salesorder_internal_id) REFERENCES middleware_penjualan(id) ON DELETE CASCADE,
  CONSTRAINT fk_serials_so_detail_internal FOREIGN KEY (salesorder_detail_internal_id) REFERENCES middleware_penjualan_detail(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS sales_order_packages (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  salesorder_internal_id INT(10) UNSIGNED NOT NULL,
  salesorder_id BIGINT DEFAULT NULL,
  salesorder_no VARCHAR(100) DEFAULT NULL,
  package_id INT DEFAULT NULL,
  package_number VARCHAR(100) DEFAULT NULL,
  weight_kg DECIMAL(12,4) DEFAULT NULL,
  courier_code VARCHAR(100) DEFAULT NULL,
  tracking_no VARCHAR(150) DEFAULT NULL,
  meta JSON DEFAULT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_pkg_so_internal (salesorder_internal_id),
  INDEX idx_pkg_package_id (package_id),
  CONSTRAINT fk_packages_so_internal FOREIGN KEY (salesorder_internal_id) REFERENCES middleware_penjualan(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS sales_order_wms_histories (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  salesorder_internal_id INT(10) UNSIGNED NOT NULL,
  salesorder_id BIGINT DEFAULT NULL,
  salesorder_no VARCHAR(100) DEFAULT NULL,
  status_code VARCHAR(100) DEFAULT NULL,
  updated_at DATETIME DEFAULT NULL,
  updated_by VARCHAR(255) DEFAULT NULL,
  meta JSON DEFAULT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_wms_so_internal (salesorder_internal_id),
  INDEX idx_wms_status_code (status_code),
  CONSTRAINT fk_wms_so_internal FOREIGN KEY (salesorder_internal_id) REFERENCES middleware_penjualan(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS sales_order_escrows (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  salesorder_internal_id INT(10) UNSIGNED NOT NULL,
  salesorder_id BIGINT DEFAULT NULL,
  salesorder_no VARCHAR(100) DEFAULT NULL,
  escrow_id INT DEFAULT NULL,
  amount DECIMAL(18,4) DEFAULT NULL,
  settlement_status VARCHAR(100) DEFAULT NULL,
  released_date DATETIME DEFAULT NULL,
  meta JSON DEFAULT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_escrow_so_internal (salesorder_internal_id),
  INDEX idx_escrow_escrow_id (escrow_id),
  CONSTRAINT fk_escrow_so_internal FOREIGN KEY (salesorder_internal_id) REFERENCES middleware_penjualan(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

SET FOREIGN_KEY_CHECKS=1;
