<?php if (!($isAjax ?? false)): ?>
<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>
<?php endif ?>

<div class="app-content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="page-description">
                <h4>Data Kategori</h4>
              </div>
              <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <form class="input-group" method="get" style="max-width: 300px">
                  <input name="q" value="<?= esc($q ?? '') ?>" class="form-control" placeholder="Cari Kategori">
                  <button class="btn btn-light">Search</button>
                </form>
                <div class="d-flex flex-wrap gap-2">
                  <div class="btn-group">
                    <a href="<?= base_url('dashboard/categories/export') ?>" class="btn btn-success">Export</a>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal">Import</button>
                  </div>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal" data-mode="create">+ Tambah</button>
                </div>
              </div>
            </div>

            <div class="card-body">
              <?= view('backend/layout/partials/_flash') ?>

              <div id="category-wrapper">
                <div class="table-responsive">
                  <table class="table">
                    <thead class="table-dark">
                      <tr>
                        <th>Kode</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach (($categories ?? []) as $r): ?>
                        <tr>
                          <td><?= esc($r['code']) ?></td>
                          <td><?= esc($r['name']) ?></td>
                          <td><?= $r['is_active'] ? 'Aktif' : 'Nonaktif' ?></td>
                          <td>
                            <button class="btn btn-sm btn-primary"
                              data-bs-toggle="modal" data-bs-target="#categoryModal"
                              data-mode="edit"
                              data-id="<?= $r['id'] ?>"
                              data-name="<?= esc($r['name']) ?>"
                              data-code="<?= esc($r['code']) ?>"
                              data-description="<?= esc($r['description']) ?>"
                              data-is_active="<?= (int)$r['is_active'] ?>"
                              data-parent_id="<?= esc($r['parent_id'] ?? '') ?>"
                            >Edit</button>

                            <button class="btn btn-sm btn-danger"
                              data-bs-toggle="modal"
                              data-bs-target="#confirmDelete"
                              data-url="<?= base_url('dashboard/categories/' . $r['id'] . '/delete') ?>">
                              Hapus
                            </button>
                          </td>
                        </tr>
                      <?php endforeach; ?>

                      <?php if (empty($categories)): ?>
                        <tr><td colspan="4" class="text-center text-muted py-4">Belum ada data</td></tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>

                <!-- PAGINATION -->
                <div class="d-flex justify-content-center mt-3">
                  <?= $pager->links('cat', 'bootstrap') ?>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal: Tambah/Edit Kategori -->
<div class="modal fade" id="categoryModal" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="post">
      <?= csrf_field() ?>
      <input type="hidden" name="id" id="category-id">

      <div class="modal-header">
        <h5 class="modal-title">Tambah Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="name" id="category-name" class="form-control" required>
          </div>

          <div class="col-md-4">
            <label class="form-label">Kode Kategori</label>
            <input type="text" name="code" id="category-code" class="form-control" required>
          </div>

          <div class="col-md-4">
            <label class="form-label">Kategori Induk</label>
            <select name="parent_id" id="category-parent_id" class="form-select">
              <option value="">— Tidak ada —</option>
              <?php foreach (($categories ?? []) as $c): ?>
                <option value="<?= $c['id'] ?>"><?= esc($c['name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-md-12">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" id="category-description" class="form-control" rows="2"></textarea>
          </div>

          <div class="col-md-6">
            <label class="form-label">Status</label>
            <select name="is_active" id="category-is_active" class="form-select">
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


<!-- Modal: Import Excel -->
<div class="modal fade" id="importModal" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="post" enctype="multipart/form-data" action="<?= base_url('dashboard/categories/import') ?>">
      <?= csrf_field() ?>
      <div class="modal-header">
        <h5 class="modal-title">Import Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="file" name="file_excel" class="form-control" accept=".xlsx" required>
        <small class="text-muted d-block mt-2">Kolom: Nama | Kode | Status</small>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Import</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal: Konfirmasi Hapus -->
<div class="modal fade" id="confirmDelete" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="post" id="deleteForm">
      <?= csrf_field() ?>
      <div class="modal-header">
        <h5 class="modal-title">Hapus Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Yakin ingin menghapus kategori ini?</p>
      </div>
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
  const modal = document.getElementById('categoryModal');
  modal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const mode = button.getAttribute('data-mode');
    const form = modal.querySelector('form');

    form.reset();
    modal.querySelector('.modal-title').textContent = mode === 'edit' ? 'Edit Kategori' : 'Tambah Kategori';
    form.action = mode === 'edit' ? '<?= base_url('dashboard/categories/update') ?>' : '<?= base_url('dashboard/categories') ?>';

    if (mode === 'edit') {
      modal.querySelector('#category-id').value = button.getAttribute('data-id');
      modal.querySelector('#category-name').value = button.getAttribute('data-name');
      modal.querySelector('#category-code').value = button.getAttribute('data-code');
      modal.querySelector('#category-description').value = button.getAttribute('data-description');
      modal.querySelector('#category-is_active').value = button.getAttribute('data-is_active');
      modal.querySelector('#category-parent_id').value = button.getAttribute('data-parent_id');
    }
  });

  // Modal Delete
  const deleteModal = document.getElementById('confirmDelete');
  deleteModal.addEventListener('show.bs.modal', function (event) {
    const url = event.relatedTarget.getAttribute('data-url');
    deleteModal.querySelector('form').action = url;
  });

  // AJAX Pagination
  $(document).on('click', '.pagination a', function (e) {
    e.preventDefault();
    const url = $(this).attr('href');
    if (!url) return;

    $.get(url, function (response) {
      const content = $('<div>').html(response).find('#category-wrapper').html();
      $('#category-wrapper').html(content);
      window.history.pushState(null, '', url);
    });
  });
});
</script>

<?php if (!($isAjax ?? false)): ?>
<?= $this->endSection() ?>
<?php endif ?>
