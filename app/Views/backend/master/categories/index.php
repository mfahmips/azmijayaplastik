<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>
<div class="app-content"><div class="content-wrapper"><div class="container-fluid">

  <div class="row"><div class="col">
    <div class="page-description d-flex flex-wrap gap-2 align-items-center justify-content-between">
      <h1 class="mb-0">Kategori</h1>
      <div class="d-flex flex-wrap gap-2">
        <div class="btn-group">
          <a href="<?= base_url('dashboard/categories/export') ?>" class="btn btn-success btn-sm">Export</a>
          <button type="button" class="btn btn-warning btn-sm text-dark" data-bs-toggle="modal" data-bs-target="#importModal">Import</button>
        </div>
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#categoryModal" data-mode="create">+ Tambah</button>
      </div>
    </div>
  </div></div>

  <div class="row"><div class="col-md-12"><div class="card">
    <div class="card-header d-flex flex-wrap gap-2 align-items-center justify-content-between">
      <h5 class="card-title mb-0">Daftar Kategori</h5>
      <form class="d-flex gap-2" method="get">
        <input name="q" value="<?= esc($q ?? '') ?>" class="form-control form-control-sm" placeholder="Cari nama/slug" style="width:240px">
        <button class="btn btn-outline-secondary btn-sm">Cari</button>
      </form>
    </div>

    <div class="card-body">
      <?= view('backend/layout/partials/_flash') ?>
      <div class="table-responsive">
        <table class="table table-striped align-middle mb-0">
          <thead>
            <tr>
              <th style="width:60px">#</th>
              <th>Kategori</th>
              <th>Sub Kategori</th>
              <th class="text-end" style="width:180px">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $no = 1 + (max(1, (int)($_GET['page'] ?? 1)) - 1) * 15;
              $categoriesMap = [];
              foreach (($rows ?? []) as $r) {
                $categoriesMap[$r['id']] = $r['name'];
              }

              foreach (($rows ?? []) as $r): 
            ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= esc($r['name']) ?></td>
              <td>
                <?php 
                  echo isset($categoriesMap[$r['parent_id']]) 
                    ? esc($categoriesMap[$r['parent_id']]) 
                    : '<span class="text-muted">-</span>'; 
                ?>
              </td>
              <td class="text-end">
                <button class="btn btn-sm btn-outline-primary"
                        data-bs-toggle="modal" data-bs-target="#categoryModal"
                        data-mode="edit"
                        data-id="<?= $r['id'] ?>"
                        data-name="<?= esc($r['name']) ?>"
                        data-slug="<?= esc($r['slug']) ?>"
                        data-parent_id="<?= esc($r['parent_id']) ?>">Edit</button>
                <button class="btn btn-sm btn-outline-danger"
                        data-bs-toggle="modal" data-bs-target="#confirmDelete"
                        data-id="<?= $r['id'] ?>">Hapus</button>
              </td>
            </tr>
            <?php endforeach; if (empty($rows)): ?>
              <tr><td colspan="4" class="text-center text-muted py-4">Belum ada data</td></tr>
            <?php endif; ?>
          </tbody>
        </table>

      </div>
      <div class="mt-3">
        <?php if (isset($pager) && $pager instanceof \CodeIgniter\Pager\Pager): ?>
          <?= backend_pagination($pager, $group ?? 'default', 'sm', 'end') ?>
        <?php endif; ?>

      </div>
    </div>
  </div></div></div>

</div></div></div>

<!-- Modal Import -->
<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <form action="<?= base_url('dashboard/categories/import') ?>" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <div class="modal-header"><h5 class="modal-title">Import Kategori</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">File (.xlsx/.csv)</label>
          <input type="file" name="file" accept=".xlsx,.csv" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button>
        <button class="btn btn-warning text-dark">Import</button>
      </div>
    </form>
  </div></div>
</div>

<!-- Modal Form (Create/Edit) -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <form id="categoryForm" method="post" action="<?= base_url('dashboard/categories') ?>">
      <?= csrf_field() ?>
      <div class="modal-header">
        <h5 class="modal-title" id="categoryModalTitle">Tambah Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Nama</label>
          <input name="name" class="form-control" required>
        </div>
        <input type="hidden" name="slug">
        <div class="mb-3">
          <label class="form-label">Parent (opsional)</label>
          <select name="parent_id" class="form-select">
            <option value="">— Tidak ada —</option>
            <?php foreach (($parents ?? []) as $p): ?>
              <option value="<?= $p['id'] ?>"><?= esc($p['name']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div></div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="confirmDelete" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <form method="post" id="formDelete" action="#">
      <?= csrf_field() ?>
      <div class="modal-header"><h5 class="modal-title">Konfirmasi</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">Yakin ingin menghapus data ini?</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-danger">Hapus</button>
      </div>
    </form>
  </div></div>
</div>

<script>
document.getElementById('confirmDelete').addEventListener('show.bs.modal', e => {
  const id = e.relatedTarget?.dataset.id;
  document.getElementById('formDelete').setAttribute('action', '<?= base_url('dashboard/categories') ?>/' + id + '/delete');
});

document.getElementById('categoryModal').addEventListener('show.bs.modal', e => {
  const btn = e.relatedTarget;
  const form = document.getElementById('categoryForm');
  const title = document.getElementById('categoryModalTitle');

  if (btn?.dataset.mode === 'edit') {
    title.textContent = 'Edit Kategori';
    form.action = '<?= base_url('dashboard/categories') ?>/' + btn.dataset.id + '/update';
    form.name.value = btn.dataset.name || '';
    form.slug.value = btn.dataset.slug || '';
    form.parent_id.value = btn.dataset.parent_id || '';
  } else {
    title.textContent = 'Tambah Kategori';
    form.action = '<?= base_url('dashboard/categories') ?>';
    form.reset();
  }
});
</script>
<?= $this->endSection() ?>
