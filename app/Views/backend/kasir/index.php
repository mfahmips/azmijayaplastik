<?= $this->extend('backend/layout/default') ?>

<?= $this->section('content') ?>
<div class="app-content">
  <div class="content-wrapper">
    <div class="container">

      <div class="row align-items-center mb-3">
        <div class="col">
          <div class="page-description">
            <h1>Kasir</h1>
            <p class="text-muted mb-0">Point of Sale – cepatkan transaksi di toko.</p>
          </div>
        </div>
      </div>

      <div class="row g-3">
        <!-- Kolom kiri: cari produk -->
        <div class="col-lg-7">
          <div class="card">
            <div class="card-header">
              <div class="input-group">
                <span class="input-group-text"><i class="material-icons-outlined">search</i></span>
                <input type="text" class="form-control" placeholder="Cari nama / barcode">
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table mb-0 align-middle">
                  <thead class="table-light">
                    <tr>
                      <th>Produk</th><th class="text-end">Harga</th><th class="text-center">Stok</th><th class="text-end">Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="produk-list">
                    <tr><td colspan="4" class="text-center text-muted py-4">Muat data produk…</td></tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Kolom kanan: keranjang -->
        <div class="col-lg-5">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Keranjang</h5>
              <button class="btn btn-sm btn-outline-danger" id="btn-clear-cart">
                <i class="material-icons-outlined">delete_sweep</i> Kosongkan
              </button>
            </div>
            <div class="card-body p-0">
              <ul class="list-group list-group-flush" id="cart-list">
                <li class="list-group-item text-muted">Belum ada item.</li>
              </ul>
            </div>
            <div class="card-footer">
              <div class="d-flex justify-content-between">
                <span class="fw-semibold">Total</span>
                <span class="fw-bold" id="cart-total">Rp 0</span>
              </div>
              <div class="mt-3 d-grid">
                <button class="btn btn-primary" id="btn-bayar">
                  <i class="material-icons-outlined me-1">point_of_sale</i> Bayar
                </button>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Placeholder JS – nanti diganti ambil produk & handle cart
console.log('Kasir ready at /dashboard/kasir');
</script>
<?= $this->endSection() ?>
