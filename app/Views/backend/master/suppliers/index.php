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
                <input type="text" name="q" value="<?= esc($q ?? '') ?>" class="form-control" placeholder="Cari Supplier">
              </div>
            </form>

            <!-- Aksi -->
            <div class="d-flex gap-2">
              <div class="btn-group" role="group">
                <a href="<?= base_url('dashboard/suppliers/export') ?>" 
                   class="btn btn-success btn-sm" 
                   data-bs-toggle="tooltip" 
                   data-bs-placement="top" 
                   title="Export Supplier">
                   <i class="fadeIn animated bx bx-export"></i>
                </a>

                <button class="btn btn-warning btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#importModal"
                        data-bs-toggle="tooltip" 
                        data-bs-placement="top" 
                        title="Import Supplier">
                  <i class="fadeIn animated bx bx-import"></i>
                </button>
              </div>
              <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#supplierModal" data-mode="create">+ Tambah</button>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div id="supplier-wrapper">
            <div class="table-responsive">
              <table class="table align-middle">
                <thead class="table-secondary">
                  <tr class="text-center">
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kontak</th>
                    <th>Telepon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Metode</th>
                    <th>Termin</th>
                    <th>Rekening</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($suppliers ?? [] as $r): ?>
                    <tr class="text-center">
                      <td><?= esc($r['code']) ?></td>
                      <td><?= esc($r['name']) ?></td>
                      <td><?= esc($r['contact_person']) ?></td>
                      <td><?= esc($r['phone']) ?></td>
                      <td><?= esc($r['email']) ?></td>
                      <td><?= esc($r['address']) ?></td>
                      <td><?= ucfirst(esc($r['payment_method'])) ?></td>
                      <td><?= esc($r['default_terms']) ?> hari</td>
                      <td><?= esc($r['bank_account']) ?></td>
                      <td><?= $r['is_active'] ? 'Aktif' : 'Nonaktif' ?></td>
                      <td>
                        <button class="btn btn-sm btn-outline-primary"
                          data-bs-toggle="modal" data-bs-target="#supplierModal"
                          data-mode="edit"
                          data-id="<?= $r['id'] ?>"
                          data-code="<?= esc($r['code']) ?>"
                          data-name="<?= esc($r['name']) ?>"
                          data-contact_person="<?= esc($r['contact_person']) ?>"
                          data-phone="<?= esc($r['phone']) ?>"
                          data-email="<?= esc($r['email']) ?>"
                          data-address="<?= esc($r['address']) ?>"
                          data-payment_method="<?= esc($r['payment_method']) ?>"
                          data-default_terms="<?= esc($r['default_terms']) ?>"
                          data-bank_account="<?= esc($r['bank_account']) ?>"
                          data-is_active="<?= (int)$r['is_active'] ?>">
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

                  <?php if (empty($suppliers)): ?>
                    <tr><td colspan="11" class="text-center text-muted py-4">Belum ada data</td></tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
              <?= $pager->links('sup', 'bootstrap') ?>
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
    <form class="modal-content" action="<?= base_url('dashboard/suppliers/import') ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <div class="modal-header"><h5 class="modal-title">Import Supplier</h5></div>
      <div class="modal-body">
        <input type="file" name="file_excel" class="form-control" accept=".xlsx" required>
        <small class="text-muted d-block mt-2">Kolom: Kode | Nama | Kontak | Telepon | Email | Alamat | Metode | Termin | Rekening | Status</small>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Import</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal: Tambah/Edit Supplier -->
<div class="modal fade" id="supplierModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form class="modal-content" method="post" id="supplierForm">
      <?= csrf_field() ?>
      <input type="hidden" name="id" id="supplier-id">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Supplier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label>Kode</label>
            <input type="text" name="code" id="supplier-code" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Nama</label>
            <input type="text" name="name" id="supplier-name" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Kontak</label>
            <input type="text" name="contact_person" id="supplier-contact_person" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Telepon</label>
            <input type="text" name="phone" id="supplier-phone" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Email</label>
            <input type="email" name="email" id="supplier-email" class="form-control">
          </div>
          <div class="col-md-12">
            <label>Alamat</label>
            <textarea name="address" id="supplier-address" class="form-control"></textarea>
          </div>
          <div class="col-md-4">
            <label>Metode Pembayaran</label>
            <select name="payment_method" id="supplier-payment_method" class="form-select">
              <option value="cash">Cash</option>
              <option value="termin">Termin</option>
            </select>
          </div>
          <div class="col-md-4">
            <label>Termin (hari)</label>
            <input type="number" name="default_terms" id="supplier-default_terms" class="form-control" value="0">
          </div>
          <div class="col-md-4">
            <label>Rekening</label>
            <input type="text" name="bank_account" id="supplier-bank_account" class="form-control">
          </div>
          <div class="col-md-4">
            <label>Status</label>
            <select name="is_active" id="supplier-is_active" class="form-select">
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
        <h5 class="modal-title">Hapus Supplier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body"><p>Yakin ingin menghapus supplier ini?</p></div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-danger">Hapus</button>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // Modal Tambah/Edit
  const modal = document.getElementById('supplierModal');
  modal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const mode = button.getAttribute('data-mode');
    const form = modal.querySelector('form');

    form.reset();
    modal.querySelector('.modal-title').textContent = mode === 'edit' ? 'Edit Supplier' : 'Tambah Supplier';
    form.action = mode === 'edit' ? '<?= base_url('dashboard/suppliers/update') ?>' : '<?= base_url('dashboard/suppliers') ?>';

    if (mode === 'edit') {
      modal.querySelector('#supplier-id').value = button.getAttribute('data-id');
      modal.querySelector('#supplier-code').value = button.getAttribute('data-code');
      modal.querySelector('#supplier-name').value = button.getAttribute('data-name');
      modal.querySelector('#supplier-contact_person').value = button.getAttribute('data-contact_person');
      modal.querySelector('#supplier-phone').value = button.getAttribute('data-phone');
      modal.querySelector('#supplier-email').value = button.getAttribute('data-email');
      modal.querySelector('#supplier-address').value = button.getAttribute('data-address');
      modal.querySelector('#supplier-payment_method').value = button.getAttribute('data-payment_method');
      modal.querySelector('#supplier-default_terms').value = button.getAttribute('data-default_terms');
      modal.querySelector('#supplier-bank_account').value = button.getAttribute('data-bank_account');
      modal.querySelector('#supplier-is_active').value = button.getAttribute('data-is_active');
    }
  });

  // Modal Delete
  const deleteModal = document.getElementById('confirmDelete');
  deleteModal.addEventListener('show.bs.modal', function (event) {
    const id = event.relatedTarget.getAttribute('data-id');
    deleteModal.querySelector('form').action = '<?= base_url('dashboard/suppliers/delete') ?>/' + id;
  });
});
</script>

<?= $this->endSection() ?>
