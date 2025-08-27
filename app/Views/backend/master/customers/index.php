<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>

<div class="app-content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="page-description" style="padding: 15px;"><h1>Data Customer</h1></div>
              <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <form class="input-group input-group-sm" method="get" style="max-width: 300px">
                  <input name="q" value="<?= esc($q ?? '') ?>" class="form-control" placeholder="Cari Customer">
                  <button class="btn btn-outline-secondary">Filter</button>
                </form>
                <div class="d-flex flex-wrap gap-2">
                  <div class="btn-group btn-group-sm" role="group">
                    <a href="<?= base_url('dashboard/customers/export') ?>" class="btn btn-success">Export</a>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importCustomerModal">Import</button>
                  </div>
                  <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#customerModal" data-mode="create">+ Tambah</button>
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
                      <th>Telepon</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th class="text-end">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach (($customers ?? []) as $i => $c): ?>
                    <tr>
                      <td><?= $i + 1 ?></td>
                      <td><code><?= esc($c['code']) ?></code></td>
                      <td><?= esc($c['name']) ?></td>
                      <td><?= esc($c['phone']) ?></td>
                      <td><?= esc($c['email']) ?></td>
                      <td><?= $c['is_active'] ? 'Aktif' : 'Nonaktif' ?></td>
                      <td class="text-end">
                        <!-- tombol edit/hapus -->
                      </td>
                    </tr>
                    <?php endforeach ?>
                    <?php if (empty($customers)): ?>
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


<!-- ... card & table customer seperti sebelumnya ... -->

<!-- Modal: Import Excel -->
<div class="modal fade" id="importCustomerModal" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" action="<?= base_url('dashboard/customers/import') ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <div class="modal-header"><h5 class="modal-title">Import Customer</h5></div>
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

<!-- Modal: Tambah/Edit Customer -->
<div class="modal fade" id="customerModal" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="post">
      <?= csrf_field() ?>
      <input type="hidden" name="id" id="customer-id">

      <div class="modal-header">
        <h5 class="modal-title">Tambah Customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Kode</label>
            <input type="text" name="code" id="customer-code" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Nama</label>
            <input type="text" name="name" id="customer-name" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Telepon</label>
            <input type="text" name="phone" id="customer-phone" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" id="customer-email" class="form-control">
          </div>
          <div class="col-12">
            <label class="form-label">Alamat</label>
            <textarea name="address" id="customer-address" class="form-control"></textarea>
          </div>
          <div class="col-12">
            <label class="form-label">Status</label>
            <select name="is_active" id="customer-is_active" class="form-select">
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
