<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>

<div class="page-content">
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <form class="input-group" method="get" style="max-width: 400px;">
            <input name="q" value="<?= esc($q ?? '') ?>" class="form-control" placeholder="Cari Kategori">
            <button class="btn btn-light"><ion-icon name="search-outline"></ion-icon></button>
          </form>

          <div class="btn-group">
            <a href="<?= base_url('dashboard/categories/export') ?>" class="btn btn-success btn-sm">
              <i class="bx bx-export"></i> Export
            </a>
            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">
              <i class="bx bx-import"></i> Import
            </button>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
              + Tambah
            </button>
          </div>
        </div>

        <div class="card-body">
          <?= view('backend/layout/partials/_flash') ?>

          <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
              <thead class="table-secondary">
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
                      <!-- Tombol Edit -->
                      <button class="btn btn-sm btn-primary"
                              data-bs-toggle="modal"
                              data-bs-target="#editModal<?= $r['id'] ?>">Edit</button>

                      <!-- Tombol Delete -->
                      <form action="<?= base_url('dashboard/categories/'.$r['id'].'/delete') ?>"
                            method="post" class="d-inline">
                        <?= csrf_field() ?>
                        <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin hapus kategori ini?')">Hapus</button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>

                <?php if (empty($categories)): ?>
                  <tr><td colspan="4" class="text-center text-muted py-4">Belum ada data</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <div class="d-flex justify-content-center mt-3">
            <?= $pager->links('cat', 'bootstrap') ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit untuk setiap row -->
<?php foreach (($categories ?? []) as $r): ?>
<div class="modal fade" id="editModal<?= $r['id'] ?>" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <form class="modal-content" method="post" action="<?= base_url('dashboard/categories/update/'.$r['id']) ?>">
      <?= csrf_field() ?>
      <div class="modal-header">
        <h5 class="modal-title">Edit Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Nama</label>
          <input type="text" name="name" value="<?= esc($r['name']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Kode</label>
          <input type="text" name="code" value="<?= esc($r['code']) ?>" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Status</label>
          <select name="is_active" class="form-select">
            <option value="1" <?= $r['is_active'] ? 'selected' : '' ?>>Aktif</option>
            <option value="0" <?= !$r['is_active'] ? 'selected' : '' ?>>Nonaktif</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
<?php endforeach; ?>

<!-- Modal Tambah -->
<div class="modal fade" id="createModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <form class="modal-content" method="post" action="<?= base_url('dashboard/categories/store') ?>">
      <?= csrf_field() ?>
      <div class="modal-header">
        <h5 class="modal-title">Tambah Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Nama</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Kode</label>
          <input type="text" name="code" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Status</label>
          <select name="is_active" class="form-select">
            <option value="1">Aktif</option>
            <option value="0">Nonaktif</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Import -->
<div class="modal fade" id="importModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <form class="modal-content" method="post" enctype="multipart/form-data" action="<?= base_url('dashboard/categories/import') ?>">
      <?= csrf_field() ?>
      <div class="modal-header">
        <h5 class="modal-title">Import Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
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

<?= $this->endSection() ?>
