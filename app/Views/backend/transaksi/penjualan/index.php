<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>

<div class="app-content">
  <div class="content-wrapper">
    <div class="container-fluid">

      <div class="row"><div class="col">
        <div class="page-description d-flex flex-wrap gap-2 align-items-center justify-content-between">
          <h1 class="mb-0">Penjualan</h1>
          <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#penjualanModal" data-mode="create">+ Tambah Transaksi</button>
        </div>
      </div></div>

      <div class="row mt-3"><div class="col"><div class="card">
        <div class="card-body">
          <?= view('backend/layout/partials/_flash') ?>

          <div class="table-responsive">
            <table class="table table-striped align-middle">
              <thead>
                <tr>
                  <th style="width:50px">#</th>
                  <th>No Faktur</th>
                  <th>Tanggal</th>
                  <th>Pelanggan</th>
                  <th>Total</th>
                  <th class="text-end">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach (($penjualan ?? []) as $row): ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($row['no_faktur']) ?></td>
                    <td><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                    <td><?= esc($row['pelanggan']) ?></td>
                    <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                    <td class="text-end">
                      <button class="btn btn-sm btn-outline-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#penjualanModal"
                        data-mode="edit"
                        data-id="<?= $row['id'] ?>"
                        data-no_faktur="<?= esc($row['no_faktur']) ?>"
                        data-tanggal="<?= $row['tanggal'] ?>"
                        data-pelanggan="<?= esc($row['pelanggan']) ?>"
                        data-total="<?= $row['total'] ?>">
                        Edit
                      </button>

                      <button class="btn btn-sm btn-outline-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#confirmDelete"
                        data-url="/dashboard/transaksi/penjualan/<?= $row['id'] ?>/delete">
                        Hapus
                      </button>
                    </td>
                  </tr>
                <?php endforeach ?>

                <?php if (empty($penjualan)): ?>
                  <tr><td colspan="6" class="text-center text-muted py-4">Belum ada transaksi</td></tr>
                <?php endif ?>
              </tbody>
            </table>
          </div>
        </div>
      </div></div>

    </div>
  </div>
</div>

<!-- Modal Tambah/Edit Penjualan -->
<div class="modal fade" id="penjualanModal" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="post" action="<?= base_url('dashboard/transaksi/penjualan') ?>">
      <?= csrf_field() ?>
      <input type="hidden" name="id" id="penjualan-id">

      <div class="modal-header">
        <h5 class="modal-title">Tambah Penjualan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">No Faktur</label>
          <input type="text" name="no_faktur" id="penjualan-no_faktur" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Tanggal</label>
          <input type="date" name="tanggal" id="penjualan-tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Pelanggan</label>
          <input type="text" name="pelanggan" id="penjualan-pelanggan" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Total</label>
          <input type="number" name="total" id="penjualan-total" class="form-control">
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmDelete" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="post" id="deleteForm">
      <?= csrf_field() ?>
      <div class="modal-header">
        <h5 class="modal-title">Hapus Transaksi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Yakin ingin menghapus transaksi ini?</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-danger">Hapus</button>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('penjualanModal');
  modal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const mode = button.getAttribute('data-mode');
    const form = modal.querySelector('form');

    form.reset();
    modal.querySelector('.modal-title').textContent = mode === 'edit' ? 'Edit Penjualan' : 'Tambah Penjualan';
    form.action = mode === 'edit' ? '<?= base_url('dashboard/transaksi/penjualan/update') ?>' : '<?= base_url('dashboard/transaksi/penjualan') ?>';

    if (mode === 'edit') {
      modal.querySelector('#penjualan-id').value        = button.getAttribute('data-id');
      modal.querySelector('#penjualan-no_faktur').value = button.getAttribute('data-no_faktur');
      modal.querySelector('#penjualan-tanggal').value   = button.getAttribute('data-tanggal');
      modal.querySelector('#penjualan-pelanggan').value = button.getAttribute('data-pelanggan');
      modal.querySelector('#penjualan-total').value     = button.getAttribute('data-total');
    }
  });

  const deleteModal = document.getElementById('confirmDelete');
  deleteModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const url = button.getAttribute('data-url');
    deleteModal.querySelector('#deleteForm').action = url;
  });
});
</script>

<?= $this->endSection() ?>
