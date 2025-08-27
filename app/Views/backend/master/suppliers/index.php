<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>

<div class="app-content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="page-description" style="padding: 15px;"><h1>Data Supplier</h1></div>
              <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <form class="input-group input-group-sm" method="get" style="max-width: 300px">
                  <input name="q" value="<?= esc($q ?? '') ?>" class="form-control" placeholder="Cari Supplier">
                  <button class="btn btn-outline-secondary">Filter</button>
                </form>
                <div class="d-flex flex-wrap gap-2">
                  <div class="btn-group btn-group-sm" role="group">
                    <a href="<?= base_url('dashboard/suppliers/export') ?>" class="btn btn-success">Export</a>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importSupplierModal">Import</button>
                  </div>
                  <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#supplierModal" data-mode="create">+ Tambah</button>
                </div>
              </div>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Kode</th>
                      <th>Nama</th>
                      <th>Kontak</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th class="text-end">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach (($suppliers ?? []) as $i => $s): ?>
                    <tr>
                      <td><?= $i + 1 ?></td>
                      <td><code><?= esc($s['code']) ?></code></td>
                      <td><?= esc($s['name']) ?></td>
                      <td><?= esc($s['phone']) ?></td>
                      <td><?= esc($s['email']) ?></td>
                      <td><?= $s['is_active'] ? 'Aktif' : 'Nonaktif' ?></td>
                      <td class="text-end">
                        <!-- tombol edit/hapus -->
                      </td>
                    </tr>
                    <?php endforeach ?>
                    <?php if (empty($suppliers)): ?>
                    <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data</td></tr>
                    <?php endif ?>
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- ... card & table supplier seperti sebelumnya ... -->

<!-- Modal: Import Excel -->
<div class="modal fade" id="importSupplierModal" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" action="<?= base_url('dashboard/suppliers/import') ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <div class="modal-header"><h5 class="modal-title">Import Supplier</h5></div>
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

<!-- Modal: Tambah/Edit Supplier -->
<div class="modal fade" id="supplierModal" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="post">
      <?= csrf_field() ?>
      <input type="hidden" name="id" id="supplier-id">

      <div class="modal-header">
        <h5 class="modal-title">Tambah Supplier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Kode</label>
            <input type="text" name="code" id="supplier-code" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Nama</label>
            <input type="text" name="name" id="supplier-name" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Telepon</label>
            <input type="text" name="phone" id="supplier-phone" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" id="supplier-email" class="form-control">
          </div>
          <div class="col-12">
            <label class="form-label">Alamat</label>
            <textarea name="address" id="supplier-address" class="form-control"></textarea>
          </div>
          <div class="col-12">
            <label class="form-label">Status</label>
            <select name="is_active" id="supplier-is_active" class="form-select">
              <option value="1">Aktif</option>
              <option value="0">Nonaktif</option>
            </select>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>


<?= $this->endSection() ?>
