<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>

<div class="page-content">
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
          <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-3 mb-3">

            <!-- Filter -->
            <form id="filter-form" class="d-flex gap-2 align-items-center" method="get" style="max-width: 400px;">
              <div class="input-group">
                <span class="input-group-text"><ion-icon name="search-outline"></ion-icon></span>
                <input type="text" name="q" value="<?= esc($q ?? '') ?>" class="form-control" placeholder="Cari Produk">

                <select name="category_id" class="form-select">
                  <option value="">-- Semua Kategori --</option>
                  <?php foreach ($categories ?? [] as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= ($category_id == $cat['id']) ? 'selected' : '' ?>>
                      <?= esc($cat['name']) ?>
                    </option>
                  <?php endforeach ?>
                </select>

              </div>
            </form>

            <!-- Aksi -->
            <div class="d-flex gap-2">
              <div class="btn-group" role="group">
                <a href="<?= base_url('dashboard/products/export') ?>" 
                   class="btn btn-success btn-sm" 
                   data-bs-toggle="tooltip" 
                   title="Export Produk">
                   <i class="fadeIn animated bx bx-export"></i>
                </a>

                <button class="btn btn-warning btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#importModal"
                        title="Import Produk">
                  <i class="fadeIn animated bx bx-import"></i>
                </button>
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
                    <th>Satuan</th>
                    <th>Harga Jual</th>
                    <th>Harga Grosir</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($products ?? [] as $r): ?>
                    <tr class="text-center">
                      <td><code><?= esc($r['sku']) ?></code></td>
                      <td><?= esc($r['name']) ?></td>
                      <td><?= esc($r['unit']) ?></td>
                      <td>Rp <?= number_format($r['sell_price'], 0, ',', '.') ?></td>
                      <td>
                        <?php if (!empty($pricesMap[$r['id']]) && $pricesMap[$r['id']] !== '-'): ?>
                          <a href="#"
                             class="text-decoration-none"
                             data-bs-toggle="modal"
                             data-bs-target="#wholesaleModal"
                             data-product-id="<?= $r['id'] ?>"
                             data-unit="<?= esc($r['grosir_unit'] ?? '') ?>"
                             data-min_qty="<?= esc($r['grosir_min_qty'] ?? '') ?>"
                             data-price="<?= esc($r['grosir_price'] ?? '') ?>">
                            <?= $pricesMap[$r['id']] ?>
                          </a>
                        <?php else: ?>
                          <button class="btn btn-sm btn-outline-success"
                                  data-bs-toggle="modal"
                                  data-bs-target="#wholesaleModal"
                                  data-product-id="<?= $r['id'] ?>">
                            + Tambah
                          </button>
                        <?php endif ?>
                      </td>



                      <td>
                        <button class="btn btn-sm btn-outline-primary"
                          data-bs-toggle="modal" data-bs-target="#productModal"
                          data-mode="edit"
                          data-id="<?= $r['id'] ?>"
                          data-sku="<?= esc($r['sku']) ?>"
                          data-name="<?= esc($r['name']) ?>"
                          data-brand="<?= esc($r['brand']) ?>"
                          data-category_id="<?= $r['category_id'] ?>"
                          data-supplier_id="<?= $r['supplier_id'] ?>"
                          data-unit="<?= esc($r['unit']) ?>"
                          data-barcode="<?= esc($r['barcode']) ?>"
                          data-min_stock="<?= $r['min_stock'] ?>"
                          data-cost_price="<?= $r['cost_price'] ?>"
                          data-sell_price="<?= $r['sell_price'] ?>"
                          data-stock="<?= $r['stock'] ?>"
                          data-description="<?= esc($r['description']) ?>"
                          data-is_active="<?= $r['is_active'] ?>">
                          Edit
                        </button>

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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Import</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal: Harga Grosir -->
<div class="modal fade" id="wholesaleModal" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="post" action="<?= base_url('dashboard/products/save-wholesale') ?>">
      <?= csrf_field() ?>
      <input type="hidden" name="product_id" id="wholesale-product-id">

      <div class="modal-header">
        <h5 class="modal-title">Harga Grosir Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Satuan</label>
          <input type="text" name="unit" id="wholesale-unit" class="form-control" placeholder="pcs/pack/dus" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Minimal Qty</label>
          <input type="number" name="min_qty" id="wholesale-min_qty" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Harga Grosir</label>
          <input type="number" name="price" id="wholesale-price" class="form-control" min="0" step="0.01" required>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>


<!-- Modal: Tambah/Edit Produk -->
<div class="modal fade" id="productModal" tabindex="-1">
  <div class="modal-dialog modal-lg"> <!-- perbesar modal -->
    <form class="modal-content" method="post" id="productForm">
      <?= csrf_field() ?>
      <input type="hidden" name="id" id="product-id">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="row g-3">
          <!-- SKU -->
          <div class="col-md-4">
            <label>SKU</label>
            <input type="text" name="sku" id="product-sku" class="form-control" readonly>
          </div>

          <!-- Nama -->
          <div class="col-md-4">
            <label>Nama</label>
            <input type="text" name="name" id="product-name" class="form-control" required>
          </div>

          <!-- Merk -->
          <div class="col-md-4">
            <label>Merk</label>
            <input type="text" name="brand" id="product-brand" class="form-control">
          </div>

          <!-- Kategori -->
          <div class="col-md-4">
            <label>Kategori</label>
            <select name="category_id" id="product-category_id" class="form-select">
              <option value="">— Pilih Kategori —</option>
              <?php foreach ($categories ?? [] as $cat): ?>
                <option value="<?= $cat['id'] ?>" data-code="<?= esc($cat['code']) ?>">
                  <?= esc($cat['name']) ?>
                </option>
              <?php endforeach ?>
            </select>
          </div>


          <!-- Supplier -->
          <div class="col-md-4">
            <label>Supplier</label>
            <select name="supplier_id" id="product-supplier_id" class="form-select">
              <option value="">— Pilih Supplier —</option>
              <?php foreach ($suppliers ?? [] as $sup): ?>
                <option value="<?= $sup['id'] ?>"><?= esc($sup['name']) ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <!-- Barcode -->
          <div class="col-md-4">
            <label>Barcode</label>
            <input type="text" name="barcode" id="product-barcode" class="form-control">
          </div>

          <!-- Unit -->
          <div class="col-md-4">
            <label>Satuan</label>
            <input type="text" name="unit" id="product-unit" class="form-control" required>
          </div>

          <!-- Harga Beli -->
          <div class="col-md-4">
            <label>Harga Beli</label>
            <input type="number" name="cost_price" id="product-cost_price" class="form-control" step="0.01">
          </div>

          <!-- Harga Jual Utama -->
          <div class="col-md-4">
            <label>Harga Jual (Default)</label>
            <input type="number" name="sell_price" id="product-sell_price" class="form-control" step="0.01">
          </div>

          <!-- Stok -->
          <div class="col-md-4">
            <label>Stok</label>
            <input type="number" name="stock" id="product-stock" class="form-control">
          </div>

          <!-- Min Stok -->
          <div class="col-md-4">
            <label>Minimal Stok</label>
            <input type="number" name="min_stock" id="product-min_stock" class="form-control">
          </div>

          <!-- Status -->
          <div class="col-md-4">
            <label>Status</label>
            <select name="is_active" id="product-is_active" class="form-select">
              <option value="1">Aktif</option>
              <option value="0">Nonaktif</option>
            </select>
          </div>

          <!-- Deskripsi -->
          <div class="col-12">
            <label>Deskripsi</label>
            <textarea name="description" id="product-description" class="form-control"></textarea>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-danger">Hapus</button>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const productModal = document.getElementById('productModal');
  const productForm  = document.getElementById('productForm');

  // Modal edit Produk
  productModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const mode   = button.getAttribute('data-mode');
    const modalTitle = productModal.querySelector('.modal-title');

    productForm.reset();

    if (mode === 'edit') {
      const id = button.getAttribute('data-id');
      modalTitle.textContent = 'Edit Produk';
      productForm.action = '<?= base_url('dashboard/products/update') ?>/' + id;

      document.getElementById('product-id').value = id;
      document.getElementById('product-sku').value = button.getAttribute('data-sku');
      document.getElementById('product-name').value = button.getAttribute('data-name');
      document.getElementById('product-brand').value = button.getAttribute('data-brand');
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
      productForm.action = '<?= base_url('dashboard/products/store') ?>';
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

  // AJAX filter form
  $(document).on('submit', '#filter-form', function(e) {
    e.preventDefault();
    $.get("<?= base_url('dashboard/products') ?>", $(this).serialize(), function(response) {
      let content = $('<div>').html(response).find('#product-wrapper').html();
      $('#product-wrapper').html(content);
    });
  });

  // AJAX pagination
  $(document).on('click', '#product-wrapper .pagination a', function(e) {
    e.preventDefault();
    let url = $(this).attr('href');
    $.get(url, $('#filter-form').serialize(), function(response) {
      let content = $('<div>').html(response).find('#product-wrapper').html();
      $('#product-wrapper').html(content);
      window.history.pushState(null, '', url);
    });
  });

  // Auto filter on category change
  $(document).on('change', '#filter-form select[name="category_id"]', function() {
    $('#filter-form').submit();
  });

  // Auto filter on enter key
  $(document).on('keyup', '#filter-form input[name="q"]', function(e) {
    if (e.keyCode === 13) {
      $('#filter-form').submit();
    }
  });

  // Modal Harga Grosir
const wholesaleModal = document.getElementById('wholesaleModal');
wholesaleModal.addEventListener('show.bs.modal', function (event) {
  const button = event.relatedTarget;

  // Ambil data dari tombol
  const productId = button.getAttribute('data-product-id');
  const unit = button.getAttribute('data-unit') || '';
  const minQty = button.getAttribute('data-min_qty') || '';
  const price = button.getAttribute('data-price') || '';

  // Isi nilai ke dalam input modal
  document.getElementById('wholesale-product-id').value = productId;
  document.getElementById('wholesale-unit').value = unit;
  document.getElementById('wholesale-min_qty').value = minQty;
  document.getElementById('wholesale-price').value = price;
});



// SKU generator (preview)
function generateSku() {
  let category = document.getElementById('product-category_id');
  let categoryCode = category.options[category.selectedIndex]?.dataset.code || 'CAT';
  let numberPreview = "0001";
  document.getElementById('product-sku').value = "AJP-" + categoryCode + "-" + numberPreview;
}

document.getElementById('product-category_id').addEventListener('change', generateSku);
window.addEventListener('DOMContentLoaded', generateSku);
</script>


<?= $this->endSection() ?>
