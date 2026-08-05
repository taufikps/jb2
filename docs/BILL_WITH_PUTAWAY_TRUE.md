Bill With Putaway True - API & Storage

Overview
- Endpoint: POST /api/bill-with-putaway-true
- Purpose: Terima bill/purchase bill yang bertanda `is_putaway: true` dan simpan ke tabel middleware untuk diproses atau dikirim ke D365.

Payload (example)
```
{
  "items": [
    {
      "bill_detail_id": 20223,
      "item_id": 51,
      "description": "Kemej@ Kasu@l Pria - Pink, L",
      "invt_acct_id": 4,
      "tax_id": 1,
      "price": "20000.0000",
      "qty": "0.0000",
      "uom_id": null,
      "unit": "Buah",
      "qty_in_base": "25.0000",
      "disc": "0.00",
      "disc_amount": "0.0000",
      "tax_amount": "0.0000",
      "amount": "500000.0000",
      "is_serialnumber_printed": null,
      "purchaseorder_detail_id": 7298,
      "detail_note": null,
      "item_code": "BTL-MNM-1300-PINK",
      "item_name": "Kemej@ Kasu@l Pria",
      "buy_price": "30000.0000",
      "variant": "Pink, L",
      "item_group_id": 33,
      "original_price": "30000.0000",
      "rate": "0.00",
      "tax_name": "No Tax",
      "account_name": "1-1200 - Persediaan Barang",
      "use_serial_number": false,
      "use_batch_number": false,
      "bin_id": null,
      "bin_final_code": "",
      "thumbnail": "https://...jpg",
      "batchno": [],
      "serialno": []
    }
  ],
  "bill_id": 13213,
  "bill_no": "BIL-000013213",
  "contact_id": 504870,
  "supplier_name": "agunk",
  "transaction_date": "2026-07-10T10:46:59.146Z",
  "created_date": "2026-07-10T10:45:07.500Z",
  "due_date": "2026-07-14T10:46:59.146Z",
  "is_tax_included": false,
  "note": "",
  "sub_total": "500000.0000",
  "total_disc": "0.0000",
  "total_tax": "0.0000",
  "grand_total": "500000.0000",
  "is_putaway": true
}
```

Server behavior
- Controller: `ci4/app/Controllers/Api.php` -> method `billWithPutawayTrue()`
- Model: `ci4/app/Models/BillWithPutawayTrueModel.php`
- Storage table: `middleware_bill_with_putaway_true`
  - Header fields are saved to individual columns (e.g. `bill_id`, `bill_no`, `supplier_name`, `sub_total`, `grand_total`, `is_putaway`, ...)
  - `items` array is saved to `items_payload` (JSON string)
  - Full payload is saved to `payload` (JSON string)
  - `status` default `pending`, `response`, `sent_at` available for later D365 send

DB columns
- The schema includes (relevant subset):
  - `bill_id`, `bill_no`, `contact_id`, `supplier_name`
  - `transaction_date`, `created_date`, `due_date`
  - `sub_total`, `total_disc`, `total_tax`, `grand_total` (DECIMAL)
  - `items_payload` (LONGTEXT), `payload` (LONGTEXT)
  - `is_putaway` (TINYINT), `status`, `response`, `sent_at`
- If your DB lacks these columns, run the ALTER script added at `database/alter_add_columns_middleware_bill_with_putaway_true.sql`.

ALTER script
- File: `database/alter_add_columns_middleware_bill_with_putaway_true.sql`
- Usage (example):
```bash
mysql -u <user> -p <database> < database/alter_add_columns_middleware_bill_with_putaway_true.sql
```
- Note: script uses `ADD COLUMN IF NOT EXISTS` (MySQL 8+). If your MySQL version < 8, ask saya untuk membuat versi kompatibel.

Testing
- Example curl (adjust host/path):
```bash
curl -X POST 'http://localhost/jubelio-d365fo-middleware/api/bill-with-putaway-true' \
  -H 'Content-Type: application/json' \
  -d @sample_bill.json
```
- After insert, check DB row: `SELECT * FROM middleware_bill_with_putaway_true WHERE bill_no = 'BIL-000013213'`.

Admin UI / Debug
- Admin controller: `ci4/app/Controllers/Admin/Bill_with_putaway_true.php` (index, show, resend)
- View: `ci4/app/Views/admin/bill_with_putaway_true/show.php` (if exists) shows stored payload and response (similar pattern to Return_full)

Formatting notes
- Numeric fields in payload (prices, amounts, weights) are accepted as strings like `"72000.0000"` or numbers; server normalizes numeric values. If strict D365 formatting needed, a D365 builder will format decimals to fixed 4 decimals on send.
- `items.batchno` and `items.serialno` are stored inside `items_payload` as arrays.

If you want, saya bisa:
- menambahkan contoh `sample_bill.json` file ke repo under `docs/`;
- menambahkan view debugging di admin (if missing) untuk menampilkan built D365 payload.

