<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>
<div class="app-content"><div class="content-wrapper"><div class="container-fluid">

  <div class="row"><div class="col">
    <div class="page-description d-flex flex-wrap gap-2 align-items-center justify-content-between">
      <h1 class="mb-0">Pelanggan</h1>
      <div class="d-flex flex-wrap gap-2">
        <div class="btn-group">
          <a href="<?= base_url('dashboard/customers/export') ?>" class="btn btn-success btn-sm">Export</a>
          <button type="button" class="btn btn-warning btn-sm text-dark" data-bs-toggle="modal" data-bs-target="#importModal">Import</button>
        </div>
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#customerModal" data-mode="create">+ Tambah</button>
      </div>
    </div>
  </div></div>

  <div class="row"><div class="col-md-12"><div class="card">
    <div class="card-header d-flex flex-wrap gap-2 align-items-center justify-content-between">
      <h5 class="card-title mb-0">Daftar Pelanggan</h5>
      <form class="d-flex gap-2" method="get">
        <input name="q" value="<?= esc($q ?? '') ?>" class="form-control form-control-sm" placeholder="Cari nama/telepon" style="width:240px">
        <button class="btn btn-outline-secondary btn-sm">Cari</button>
      </form>
    </div>

    <div class="card-body">
      <?= view('backend/layout/partials/_flash') ?>
      <div class="table-responsive">
        <table class="table table-striped align-middle mb-0">
          <thead><tr>
            <th style="width:60px">#</th><th>Nama</th><th>Telepon</th><th style="width:120px">Tipe</th><th>Alamat</th><th class="text-end" style="width:180px">Aksi</th>
          </tr></thead>
          <tbody>
          <?php $no = 1 + (max(1, (int)($_GET['page'] ?? 1)) - 1) * 10; foreach (($rows ?? []) as $r): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= esc($r['name']) ?></td>
              <td><?= esc($r['phone'] ?? '-') ?></td>
              <td><span class="badge bg-secondary"><?= esc($r['customer_type'] ?? 'retail') ?></span></td>
              <td><?= esc($r['address'] ?? '-') ?></td>
              <td class="text-end">
                <button class="btn btn-sm btn-outline-primary"
                        data-bs-toggle="modal" data-bs-target="#customerModal"
                        data-mode="edit"
                        data-id="<?= $r['id'] ?>"
                        data-name="<?= esc($r['name']) ?>"
                        data-phone="<?= esc($r['phone']) ?>"
                        data-customer_type="<?= esc($r['customer_type'] ?? 'retail') ?>"
                        data-address="<?= esc($r['address']) ?>">Edit</button>

                <button class="btn btn-sm btn-outline-danger"
                        data-bs-toggle="modal" data-bs-target="#confirmDelete"
                        data-url="<?= base_url('dashboard/customers/'.$r['id'].'/delete') ?>">Hapus</button>
              </td>
            </tr>
          <?php endforeach; if (empty($rows)): ?>
            <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data</td></tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>

      <?php if (isset($pager)) : ?>
        <div class="mt-3"><?= $pager->links() ?></div>
      <?php endif; ?>
    </div>
  </div></div></div>

</div></div></div>

<!-- Modal Import -->
<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <form action="<?= base_url('dashboard/customers/import') ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <div class="modal-header"><h5 class="modal-title">Import Pelanggan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
        <div class="mb-3"><label class="form-label">File (.xlsx/.csv)</label><input type="file" name="file" accept=".xlsx,.csv" class="form-control" required></div>
      </div>
      <div class="modal-footer"><button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button><button class="btn btn-warning text-dark">Import</button></div>
    </form>
  </div></div>
</div>

<!-- Modal Form -->
<div class="modal fade" id="customerModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <form id="customerForm" method="post" action="<?= base_url('dashboard/customers') ?>">
      <?= csrf_field() ?>
      <div class="modal-header"><h5 class="modal-title" id="customerModalTitle">Tambah Pelanggan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6"><label class="form-label">Nama</label><input name="name" class="form-control" required></div>
          <div class="col-md-6"><label class="form-label">Telepon</label><input name="phone" class="form-control"></div>
          <div class="col-md-6">
            <label class="form-label">Tipe</label>
            <select name="customer_type" class="form-select">
              <option value="retail">retail</option>
              <option value="wholesale">wholesale</option>
            </select>
          </div>
          <div class="col-md-6"><label class="form-label">Alamat</label><input name="address" class="form-control"></div>
        </div>
      </div>
      <div class="modal-footer"><button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button><button class="btn btn-primary">Simpan</button></div>
    </form>
  </div></div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="confirmDelete" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <form method="post" id="formDelete"><?= csrf_field() ?>
      <div class="modal-header"><h5 class="modal-title">Konfirmasi</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">Yakin ingin menghapus data ini?</div>
      <div class="modal-footer"><button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button><button class="btn btn-danger">Hapus</button></div>
    </form>
  </div></div>
</div>

<script>
document.getElementById('confirmDelete').addEventListener('show.bs.modal', e => {
  const url = e.relatedTarget?.dataset.url;
  document.getElementById('formDelete').setAttribute('action', url);
});

document.getElementById('customerModal').addEventListener('show.bs.modal', e => {
  const b = e.relatedTarget,
        f = document.getElementById('customerForm'),
        t = document.getElementById('customerModalTitle');

  if (b?.dataset.mode === 'edit') {
    t.textContent = 'Edit Pelanggan';
    f.action = '<?= base_url('dashboard/customers') ?>/' + b.dataset.id + '/update';
    f.name.value = b.dataset.name || '';
    f.phone.value = b.dataset.phone || '';
    f.customer_type.value = b.dataset.customer_type || 'retail';
    f.address.value = b.dataset.address || '';
  } else {
    t.textContent = 'Tambah Pelanggan';
    f.action = '<?= base_url('dashboard/customers') ?>';
    f.reset();
  }
});
</script>

<?= $this->endSection() ?>
