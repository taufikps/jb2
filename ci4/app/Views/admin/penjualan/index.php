<h3>Transaksi Penjualan</h3>
<p class="text-muted">Data payload masuk dari Jubelio (webhook) untuk transaksi penjualan.</p>

<div class="card shadow-sm border-0 mb-4 table-filter-card">
    <div class="card-body">
        <div class="row g-2 align-items-end mb-3">
            <div class="col-md-4">
                <label class="form-label small text-muted">Cari data</label>
                <input type="text" class="form-control form-control-sm table-filter-search" placeholder="Cari order, customer, status, atau kata lain...">
            </div>
            <div class="col-md-3">
                <label class="form-label small text-muted">Status</label>
                <select class="form-select form-select-sm table-filter-status">
                    <option value="">Semua status</option>
                    <option value="pending">Pending</option>
                    <option value="sent">Sent</option>
                    <option value="failed">Failed</option>
                </select>
            </div>
            <div class="col-md-5 d-flex align-items-end justify-content-end gap-2">
                <button type="button" class="btn btn-outline-secondary btn-sm table-filter-reset">Reset</button>
                <button type="button" class="btn btn-outline-primary btn-sm" id="penjualan-refresh-btn">Refresh</button>
                <div class="form-check form-switch mb-0 align-self-center">
                    <input class="form-check-input" type="checkbox" id="penjualan-realtime-toggle">
                    <label class="form-check-label small text-muted" for="penjualan-realtime-toggle">Realtime</label>
                </div>
            </div>
        </div>

        <div class="table-responsive" id="penjualan-table-wrapper">
            <table class="table table-bordered table-hover bg-white align-middle mb-0 table-filter-table">
                <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Order No</th>
                    <th>Salesorder No</th>
                    <th>Invoice No</th>
                    <th>Customer Code</th>
                    <th>Customer Name</th>
                    <th>Customer Phone</th>
                    <th>Customer Email</th>
                    <th>Contact ID</th>
                    <th>Action</th>
                    <th>Status</th>
                    <th>Order Status</th>
                    <th>Internal Status</th>
                    <th>Channel Status</th>
                    <th>Source</th>
                    <th>Source Name</th>
                    <th>Store</th>
                    <th>Store Name</th>
                    <th>Store ID</th>
                    <th>Location Name</th>
                    <th>Location Code</th>
                    <th>Location ID</th>
                    <th>Sub Total</th>
                    <th>Total Disc</th>
                    <th>Total Tax</th>
                    <th>Grand Total</th>
                    <th>Shipping Cost</th>
                    <th>Insurance Cost</th>
                    <th>Shipping Tax</th>
                    <th>Shipping Disc</th>
                    <th>Marketplace Disc</th>
                    <th>Service Fee</th>
                    <th>Order Proc Fee</th>
                    <th>COD Fee</th>
                    <th>Buyer Shipping Cost</th>
                    <th>Courier</th>
                    <th>Shipper</th>
                    <th>Shipping Name</th>
                    <th>Shipping Address</th>
                    <th>Shipping Area</th>
                    <th>Shipping City</th>
                    <th>Shipping Province</th>
                    <th>Shipping Post Code</th>
                    <th>Shipping Country</th>
                    <th>Tracking No</th>
                    <th>Tracking Number</th>
                    <th>Tracking URL</th>
                    <th>Invoice Date</th>
                    <th>Transaction Date</th>
                    <th>Created Date</th>
                    <th>Last Modified</th>
                    <th>Status</th>
                    <th>Dikirim</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody id="penjualan-rows-container">
                    <?php echo view('admin/penjualan/rows', ['rows' => $rows]); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $pagination ?>
