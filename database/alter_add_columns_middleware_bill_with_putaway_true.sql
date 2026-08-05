-- Safe ALTER script to add missing columns to middleware_bill_with_putaway_true
-- Uses ADD COLUMN IF NOT EXISTS (MySQL 8+). Remove IF NOT EXISTS if running older MySQL.

ALTER TABLE middleware_bill_with_putaway_true
  ADD COLUMN IF NOT EXISTS items_payload LONGTEXT NULL,
  ADD COLUMN IF NOT EXISTS payload LONGTEXT NULL,
  ADD COLUMN IF NOT EXISTS status ENUM('pending','sent','failed') NOT NULL DEFAULT 'pending',
  ADD COLUMN IF NOT EXISTS response LONGTEXT NULL,
  ADD COLUMN IF NOT EXISTS sent_at DATETIME NULL,
  ADD COLUMN IF NOT EXISTS created_at DATETIME NULL,
  ADD COLUMN IF NOT EXISTS updated_at DATETIME NULL,
  ADD COLUMN IF NOT EXISTS payment_amount DECIMAL(18,4) NULL,
  ADD COLUMN IF NOT EXISTS add_cost_detail LONGTEXT NULL,
  ADD COLUMN IF NOT EXISTS is_putaway TINYINT(1) DEFAULT 0;

-- Add an index on bill_no if missing
ALTER TABLE middleware_bill_with_putaway_true
  ADD INDEX IF NOT EXISTS idx_bill_no (bill_no);

-- End of script
