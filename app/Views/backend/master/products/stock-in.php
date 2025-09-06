<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>

<div class="page-content">

  <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>
  <?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
  <?php endif; ?>

  <!-- Card Riwayat Barang Masuk -->
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Riwayat Barang Masuk</h5>
      <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddStockIn">
        + Tambah Barang Masuk
      </button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table align-middle">
          <thead class="table-secondary">
            <tr>
              <th>Tanggal</th>
              <th>Produk</th>
              <th>Qty</th>
              <th>Harga Beli</th>
              <th>Total</th>
              <th>Catatan</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($stock_in as $row): ?>
              <tr>
                <td><code><?= $row['created_at'] ?></code></td>
                <td><?= $row['product_name'] ?></td>
                <td><?= $row['qty'] ?></td>
                <td><?= number_format($row['cost_price'], 0, ',', '.') ?></td>
                <td><?= number_format($row['cost_price'] * $row['qty'], 0, ',', '.') ?></td>
                <td><?= $row['note'] ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Barang Masuk -->
<div class="modal fade" id="modalAddStockIn" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="<?= base_url('dashboard/products/stock-in/save') ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Barang Masuk</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">

            <!-- Produk Lama -->
            <div class="col-md-6">
              <label class="form-label">Produk</label>
              <select name="product_id" class="form-control">
                <option value="">-- Pilih Produk --</option>
                <?php foreach($products as $p): ?>
                  <option value="<?= $p['id'] ?>"><?= $p['name'] ?> (Stok: <?= $p['stock'] ?>)</option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Produk Baru -->
            <div class="col-md-6">
              <label class="form-label">Produk Baru (Ops)</label>
              <input type="text" name="new_product" class="form-control" placeholder="Isi jika produk belum ada">
            </div>

            <!-- Supplier -->
            <div class="col-md-6">
              <label class="form-label">Supplier</label>
              <select name="supplier_id" class="form-control">
                <option value="">-- Pilih Supplier --</option>
                <?php foreach($suppliers as $s): ?>
                  <option value="<?= $s['id'] ?>"><?= $s['name'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Catatan -->
            <div class="col-md-6">
              <label class="form-label">Catatan</label>
              <input type="text" name="note" class="form-control">
            </div>


            <!-- Qty -->
            <div class="col-md-6">
              <label class="form-label">Qty</label>
              <input type="number" name="qty" class="form-control" required>
            </div>

            <!-- Harga Beli -->
            <div class="col-md-6">
              <label class="form-label">Harga Beli</label>
              <input type="number" name="cost_price" class="form-control" required>
            </div>

            
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Modal Tambah Produk Baru -->
<div class="modal fade" id="modalAddProduct" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="<?= base_url('products/store') ?>" method="post">
      <div class="modal-content bg-dark text-white">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Produk Baru</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body row g-3">
          <div class="col-md-6">
            <label>SKU</label>
            <input type="text" name="sku" class="form-control" placeholder="SKU (kosongkan untuk auto)">
          </div>
          <div class="col-md-6">
            <label>Nama Produk</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Kategori</label>
            <select name="category_id" class="form-control">
              <option value="">-- Pilih Kategori --</option>
              <?php foreach($categories as $c): ?>
                <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6">
            <label>Supplier</label>
            <select name="supplier_id" class="form-control">
              <option value="">-- Pilih Supplier --</option>
              <?php foreach($suppliers as $s): ?>
                <option value="<?= $s['id'] ?>"><?= $s['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6">
            <label>Harga Beli</label>
            <input type="number" name="cost_price" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Harga Jual</label>
            <input type="number" name="sell_price" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Stok Awal</label>
            <input type="number" name="stock" class="form-control" value="0">
          </div>
          <div class="col-md-6">
            <label>Keterangan</label>
            <input type="text" name="description" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Produk</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>
