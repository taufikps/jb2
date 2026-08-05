# Dokumentasi Singkat API Middleware

Ringkasan endpoint dan contoh payload untuk pengujian lokal.

Base URL (contoh saat development):
- http://127.0.0.1:8083

GET
- /api/endpoints
  - Deskripsi: Menampilkan daftar endpoint yang tersedia.
  - Contoh:
    - curl -s http://127.0.0.1:8083/api/endpoints

POST
1) /api/penjualan
- Deskripsi: Insert transaksi penjualan (bisa single object atau array)
- Contoh payload (single):
  {
    "order_no": "TEST-001",
    "customer_code": "C001",
    "total_amount": "100000",
    "items": [
      {"item_code": "ITEM1", "item_name": "Contoh Item", "qty": "1", "price": "100000", "amount": "100000"}
    ]
  }
- Contoh curl:
  curl -X POST http://127.0.0.1:8083/api/penjualan -H 'Content-Type: application/json' -d '<JSON_PAYLOAD>'

2) /api/penjualan-cancel  (alias: /api/penjualan_cancel)
- Deskripsi: Insert data cancel penjualan beserta detail item.
- Contoh payload:
  {
    "order_no": "TEST-CANCEL-001",
    "customer_name": "Nama Pelanggan",
    "items": [
      {"item_code": "ITEM1", "item_name": "Contoh Item", "qty": "1", "price": "100000", "amount": "100000"}
    ]
  }

3) /api/return-full
- Deskripsi: Insert return full (single atau array)
- Contoh payload:
  {"order_no":"TEST-RETURN-FULL-001","return_no":"RTN-001"}

4) /api/return-partial
- Deskripsi: Insert return partial (single atau array)
- Contoh payload:
  {"order_no":"TEST-RETURN-PARTIAL-001","return_no":"RTN-002"}

5) /api/stock-opname
- Deskripsi: Insert data stock opname
- Contoh payload:
  {"warehouse_code":"WH1","total_items":2}

6) /api/product
- Deskripsi: Insert data product
- Contoh payload:
  {"idproduct":"P001","namaproduct":"Contoh Product","harga":50000}

Catatan
- Semua endpoint POST menerima single object atau array of objects.
- Contoh curl mengganti `<JSON_PAYLOAD>` dengan JSON yang sesuai (tanpa tanda kutip luar).
- Pastikan server dev berjalan (contoh: `php -S 127.0.0.1:8083 -t . index.php`) dan database XAMPP aktif.
