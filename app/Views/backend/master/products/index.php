<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>

<div class="page-content">


      <div class="row">
        <div class="col-md-12">

          <div class="card">
            <div class="card-header">

              <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-3 mb-3">
                <!-- Filter -->
                <!-- Filter -->
              <form class="d-flex gap-2 align-items-center" method="get" style="max-width: 400px;">
                <div class="input-group">
                  <input type="text" name="q" value="<?= esc($q ?? '') ?>" class="form-control" placeholder="Cari Produk">
                  <select name="category_id" class="form-select">
                    <option value="">-- Kategori --</option>
                    <?php foreach ($categories ?? [] as $cat): ?>
                      <option value="<?= $cat['id'] ?>" <?= ($category_id == $cat['id']) ? 'selected' : '' ?>>
                        <?= esc($cat['name']) ?>
                      </option>
                    <?php endforeach ?>
                  </select>
                  <button class="btn btn-primary">Filter</button>
                </div>
              </form>

                <!-- Aksi -->
                <div class="d-flex gap-2">
                  <div class="btn-group" role="group">
                    <a href="<?= base_url('dashboard/products/export') ?>" class="btn btn-success">Export</a>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal">Import</button>
                  </div>
                  <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#productModal" data-mode="create">+ Tambah</button>
                </div>
              </div>
            </div>

            <div class="card-body">
              <div id="product-wrapper">
                <div class="table-responsive">
                  <table class="table align-middle">
                    <thead class="table-secondary">
                      <tr class="text-center">
                        <th>SKU</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($products ?? [] as $r): ?>
                        <tr class="text-center">
                          <td><code><?= esc($r['sku']) ?></code></td>
                          <td><?= esc($r['name']) ?></td>
                          <td><?= esc($r['category_name'] ?? '-') ?></td>
                          <td><?= esc($r['unit']) ?></td>
                          <td class="text-end">Rp <?= number_format($r['cost_price'], 0, ',', '.') ?></td>
                          <td class="text-end">Rp <?= number_format($r['sell_price'], 0, ',', '.') ?></td>
                          <td class="text-end"><?= number_format($r['stock'], 0, ',', '.') ?></td>
                          <td class="text-end">
                            <button class="btn btn-sm btn-outline-primary"
                              data-bs-toggle="modal" data-bs-target="#productModal"
                              data-mode="edit"
                              data-id="<?= $r['id'] ?>"
                              data-sku="<?= esc($r['sku']) ?>"
                              data-name="<?= esc($r['name']) ?>"
                              data-category_id="<?= $r['category_id'] ?>"
                              data-supplier_id="<?= $r['supplier_id'] ?>"
                              data-unit="<?= esc($r['unit']) ?>"
                              data-barcode="<?= esc($r['barcode']) ?>"
                              data-min_stock="<?= $r['min_stock'] ?>"
                              data-cost_price="<?= $r['cost_price'] ?>"
                              data-sell_price="<?= $r['sell_price'] ?>"
                              data-stock="<?= $r['stock'] ?>"
                              data-description="<?= esc($r['description']) ?>"
                              data-is_active="<?= $r['is_active'] ?>"
                            >Edit</button>

                            <button class="btn btn-sm btn-outline-danger"
                              data-bs-toggle="modal"
                              data-bs-target="#confirmDelete"
                              data-id="<?= $r['id'] ?>">
                              Hapus
                            </button>
                          </td>
                        </tr>
                      <?php endforeach; ?>

                      <?php if (empty($products)): ?>
                        <tr><td colspan="9" class="text-center text-muted py-4">Belum ada data</td></tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                  <?= $pager->links('prod', 'bootstrap') ?>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal: Import -->
<div class="modal fade" id="importModal" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" action="<?= base_url('dashboard/products/import') ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <div class="modal-header"><h5 class="modal-title">Import Produk</h5></div>
      <div class="modal-body">
        <input type="file" name="file_excel" class="form-control" accept=".xlsx" required>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Import</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal: Tambah/Edit Produk -->
<div class="modal fade" id="productModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form class="modal-content" method="post" id="productForm">
      <?= csrf_field() ?>
      <input type="hidden" name="id" id="product-id">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label>SKU</label>
            <input type="text" name="sku" id="product-sku" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Nama</label>
            <input type="text" name="name" id="product-name" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Kategori</label>
            <select name="category_id" id="product-category_id" class="form-select">
              <option value="">— Pilih Kategori —</option>
              <?php foreach ($categories ?? [] as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= esc($cat['name']) ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="col-md-6">
            <label>Supplier</label>
            <select name="supplier_id" id="product-supplier_id" class="form-select">
              <option value="">— Pilih Supplier —</option>
              <?php foreach ($suppliers ?? [] as $sup): ?>
                <option value="<?= $sup['id'] ?>"><?= esc($sup['name']) ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="col-md-6">
            <label>Barcode</label>
            <input type="text" name="barcode" id="product-barcode" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Unit</label>
            <input type="text" name="unit" id="product-unit" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Harga Beli</label>
            <input type="number" name="cost_price" id="product-cost_price" class="form-control" step="0.01">
          </div>
          <div class="col-md-6">
            <label>Harga Jual</label>
            <input type="number" name="sell_price" id="product-sell_price" class="form-control" step="0.01">
          </div>
          <div class="col-md-6">
            <label>Stok</label>
            <input type="number" name="stock" id="product-stock" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Minimal Stok</label>
            <input type="number" name="min_stock" id="product-min_stock" class="form-control">
          </div>
          <div class="col-12">
            <label>Deskripsi</label>
            <textarea name="description" id="product-description" class="form-control"></textarea>
          </div>
          <div class="col-md-6">
            <label>Status</label>
            <select name="is_active" id="product-is_active" class="form-select">
              <option value="1">Aktif</option>
              <option value="0">Nonaktif</option>
            </select>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal: Hapus -->
<div class="modal fade" id="confirmDelete" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="post" id="deleteForm">
      <?= csrf_field() ?>
      <div class="modal-header">
        <h5 class="modal-title">Hapus Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body"><p>Yakin ingin menghapus produk ini?</p></div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-danger">Hapus</button>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const productModal = document.getElementById('productModal');
  const productForm  = document.getElementById('productForm');

  productModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const mode   = button.getAttribute('data-mode');
    const modalTitle = productModal.querySelector('.modal-title');

    productForm.reset();

    if (mode === 'edit') {
      const id = button.getAttribute('data-id');
      modalTitle.textContent = 'Edit Produk';
      productForm.action = '<?= base_url('dashboard/products/update') ?>/' + id;

      // isi field dari data-attribute
      document.getElementById('product-id').value = id;
      document.getElementById('product-sku').value = button.getAttribute('data-sku');
      document.getElementById('product-name').value = button.getAttribute('data-name');
      document.getElementById('product-category_id').value = button.getAttribute('data-category_id');
      document.getElementById('product-supplier_id').value = button.getAttribute('data-supplier_id');
      document.getElementById('product-unit').value = button.getAttribute('data-unit');
      document.getElementById('product-barcode').value = button.getAttribute('data-barcode');
      document.getElementById('product-min_stock').value = button.getAttribute('data-min_stock');
      document.getElementById('product-cost_price').value = button.getAttribute('data-cost_price');
      document.getElementById('product-sell_price').value = button.getAttribute('data-sell_price');
      document.getElementById('product-stock').value = button.getAttribute('data-stock');
      document.getElementById('product-description').value = button.getAttribute('data-description');
      document.getElementById('product-is_active').value = button.getAttribute('data-is_active');
    } else {
      modalTitle.textContent = 'Tambah Produk';
      productForm.action = '<?= base_url('products') ?>'; // store
    }
  });

  // Modal hapus
  const deleteModal = document.getElementById('confirmDelete');
  const deleteForm  = document.getElementById('deleteForm');
  deleteModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const id = button.getAttribute('data-id');
    deleteForm.action = '<?= base_url('dashboard/products/delete') ?>/' + id;
  });
});
</script>


<?= $this->endSection() ?>
