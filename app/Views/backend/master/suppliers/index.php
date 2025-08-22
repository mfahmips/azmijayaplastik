<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>
<div class="app-content"><div class="content-wrapper"><div class="container-fluid">

  <div class="row"><div class="col">
    <div class="page-description d-flex flex-wrap gap-2 align-items-center justify-content-between">
      <h1 class="mb-0">Supplier</h1>
      <div class="d-flex flex-wrap gap-2">
        <div class="btn-group">
          <a href="<?= base_url('dashboard/suppliers/export') ?>" class="btn btn-success btn-sm">Export</a>
          <button type="button" class="btn btn-warning btn-sm text-dark" data-bs-toggle="modal" data-bs-target="#importModal">Import</button>
        </div>
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#supplierModal" data-mode="create">+ Tambah</button>
      </div>
    </div>
  </div></div>

  <div class="row"><div class="col-md-12"><div class="card">
    <div class="card-header d-flex flex-wrap gap-2 align-items-center justify-content-between">
      <h5 class="card-title mb-0">Daftar Supplier</h5>
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
            <th style="width:60px">#</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th class="text-end" style="width:180px">Aksi</th>
          </tr></thead>
          <tbody>
          <?php
            $page = $pager->getCurrentPage() ?? 1;
            $perPage = $pager->getPerPage() ?? 10;
            $no = 1 + ($page - 1) * $perPage;
            foreach (($rows ?? []) as $r):
          ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= esc($r['name']) ?></td>
              <td><?= esc($r['email'] ?? '-') ?></td>
              <td><?= esc($r['phone'] ?? '-') ?></td>
              <td><?= esc($r['address'] ?? '-') ?></td>
              <td class="text-end">
                <button class="btn btn-sm btn-outline-primary"
                        data-bs-toggle="modal" data-bs-target="#supplierModal"
                        data-mode="edit"
                        data-id="<?= $r['id'] ?>"
                        data-name="<?= esc($r['name']) ?>"
                        data-email="<?= esc($r['email']) ?>"
                        data-phone="<?= esc($r['phone']) ?>"
                        data-address="<?= esc($r['address']) ?>">Edit</button>

                <button class="btn btn-sm btn-outline-danger"
                        data-bs-toggle="modal" data-bs-target="#confirmDelete"
                        data-url="<?= base_url('dashboard/suppliers/'.$r['id'].'/delete') ?>">Hapus</button>
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
    <form action="<?= base_url('dashboard/suppliers/import') ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <div class="modal-header"><h5 class="modal-title">Import Supplier</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
        <div class="mb-3"><label class="form-label">File (.xlsx/.csv)</label><input type="file" name="file" accept=".xlsx,.csv" class="form-control" required></div>
      </div>
      <div class="modal-footer"><button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button><button class="btn btn-warning text-dark">Import</button></div>
    </form>
  </div></div>
</div>

<!-- Modal Form -->
<div class="modal fade" id="supplierModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <form id="supplierForm" method="post" action="<?= base_url('dashboard/suppliers') ?>">
      <?= csrf_field() ?>
      <div class="modal-header"><h5 class="modal-title" id="supplierModalTitle">Tambah Supplier</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6"><label class="form-label">Nama</label><input name="name" class="form-control" required></div>
          <div class="col-md-6"><label class="form-label">Email</label><input name="email" type="email" class="form-control"></div>
          <div class="col-md-6"><label class="form-label">Telepon</label><input name="phone" class="form-control"></div>
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

document.getElementById('supplierModal').addEventListener('show.bs.modal', e => {
  const b = e.relatedTarget, f = document.getElementById('supplierForm'), t = document.getElementById('supplierModalTitle');
  if (b?.dataset.mode === 'edit') {
    t.textContent = 'Edit Supplier';
    f.action = '<?= base_url('dashboard/suppliers') ?>/' + b.dataset.id + '/update';
    f.name.value = b.dataset.name || '';
    f.email.value = b.dataset.email || '';
    f.phone.value = b.dataset.phone || '';
    f.address.value = b.dataset.address || '';
  } else {
    t.textContent = 'Tambah Supplier';
    f.action = '<?= base_url('dashboard/suppliers') ?>';
    f.reset();
  }
});
</script>

<?= $this->endSection() ?>
