<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>

<div class="app-content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

          <div class="card">
            <div class="card-header">
              <h1 class="card-title">Data Produk</h1>

              <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-3">
                <!-- Filter -->
                <form class="d-flex gap-2 align-items-center" method="get" style="max-width: 300px;">
                  <input type="text" name="q" value="<?= esc($q ?? '') ?>" class="form-control form-control-sm" placeholder="Cari Produk">
                  <select name="category_id" class="form-select form-select-sm">
                    <option value="">Kategori</option>
                    <?php foreach ($categories ?? [] as $cat): ?>
                      <option value="<?= $cat['id'] ?>" <?= ($category_id == $cat['id']) ? 'selected' : '' ?>>
                        <?= esc($cat['name']) ?>
                      </option>
                    <?php endforeach ?>
                  </select>
                  <button class="btn btn-light btn-sm">Filter</button>
                </form>

                <!-- Aksi -->
                <div class="d-flex gap-2">
                  <div class="btn-group" role="group">
                    <a href="<?= base_url('dashboard/products/export') ?>" class="btn btn-success btn-sm">Export</a>
                    <button class="btn btn-warning btn-sm text-dark" data-bs-toggle="modal" data-bs-target="#importModal">Import</button>
                  </div>
                  <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#productModal" data-mode="create">+ Tambah</button>
                </div>
              </div>
            </div>

            <div class="card-body">
              <div id="product-wrapper">
                <div class="table-responsive">
                  <table class="table table-striped align-middle mb-0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>SKU</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th class="text-end">Harga</th>
                        <th class="text-end">Stok</th>
                        <th class="text-end">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($products ?? [] as $r): ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><code><?= esc($r['sku']) ?></code></td>
                          <td><?= esc($r['name']) ?></td>
                          <td><?= esc($r['category_name'] ?? '-') ?></td>
                          <td><?= esc($r['unit']) ?></td>
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
                              data-unit="<?= esc($r['unit']) ?>"
                              data-barcode="<?= esc($r['barcode']) ?>"
                              data-min_stock="<?= $r['min_stock'] ?>"
                              data-purchase_price="<?= $r['cost_price'] ?>"
                              data-sell_price="<?= $r['sell_price'] ?>"
                              data-description="<?= esc($r['description']) ?>"
                              data-is_active="<?= $r['is_active'] ?>"
                            >Edit</button>

                            <button class="btn btn-sm btn-outline-danger"
                              data-bs-toggle="modal"
                              data-bs-target="#confirmDelete"
                              data-url="<?= base_url('dashboard/products/' . $r['id'] . '/delete') ?>">
                              Hapus
                            </button>
                          </td>
                        </tr>
                      <?php endforeach; ?>

                      <?php if (empty($products)): ?>
                        <tr><td colspan="8" class="text-center text-muted py-4">Belum ada data</td></tr>
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
    <form class="modal-content" method="post">
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
            <select name="category_id" id="product-category_id" class="form-select" required>
              <option value="">— Pilih Kategori —</option>
              <?php foreach ($categories ?? [] as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= esc($cat['name']) ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="col-md-6">
            <label>Unit</label>
            <input type="text" name="unit" id="product-unit" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Barcode</label>
            <input type="text" name="barcode" id="product-barcode" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Minimal Stok</label>
            <input type="number" name="min_stock" id="product-min_stock" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Harga Beli</label>
            <input type="number" name="purchase_price" id="product-purchase_price" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Harga Jual</label>
            <input type="number" name="sell_price" id="product-sell_price" class="form-control">
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

<!-- Script untuk modal dan AJAX -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('productModal');
  modal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const mode = button.getAttribute('data-mode');
    const form = modal.querySelector('form');

    form.reset();
    modal.querySelector('.modal-title').textContent = mode === 'edit' ? 'Edit Produk' : 'Tambah Produk';
    form.action = mode === 'edit' ? '<?= base_url('dashboard/products/update') ?>' : '<?= base_url('dashboard/products') ?>';

    if (mode === 'edit') {
      modal.querySelector('#product-id').value = button.getAttribute('data-id');
      modal.querySelector('#product-sku').value = button.getAttribute('data-sku');
      modal.querySelector('#product-name').value = button.getAttribute('data-name');
      modal.querySelector('#product-category_id').value = button.getAttribute('data-category_id');
      modal.querySelector('#product-unit').value = button.getAttribute('data-unit');
      modal.querySelector('#product-barcode').value = button.getAttribute('data-barcode');
      modal.querySelector('#product-min_stock').value = button.getAttribute('data-min_stock');
      modal.querySelector('#product-purchase_price').value = button.getAttribute('data-purchase_price');
      modal.querySelector('#product-sell_price').value = button.getAttribute('data-sell_price');
      modal.querySelector('#product-description').value = button.getAttribute('data-description');
      modal.querySelector('#product-is_active').value = button.getAttribute('data-is_active');
    }
  });

  const deleteModal = document.getElementById('confirmDelete');
  deleteModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const url = button.getAttribute('data-url');
    deleteModal.querySelector('#deleteForm').action = url;
  });

  // AJAX Pagination
  $(document).on('click', '.pagination a', function(e) {
    e.preventDefault();
    let url = $(this).attr('href');
    $.get(url, function(response) {
      const dom = $('<div>').html(response);
      const newContent = dom.find('#product-wrapper').html();
      $('#product-wrapper').html(newContent);
      window.history.pushState(null, '', url);
    });
  });
});
</script>

<?= $this->endSection() ?>
