<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>

<div class="page-content">
  <div class="row">

    <!-- Cash In -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h6 class="mb-0">Total Pemasukan (per hari)</h6>
          <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#transactionModal" data-type="in">
            + Tambah Pemasukan
          </button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-middle">
              <thead class="table-secondary">
                <tr class="text-center">
                  <th>Tanggal</th>
                  <th class="text-end">Total</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($cashIn as $r): ?>
                  <tr class="text-center">
                    <td><?= esc($r['date']) ?></td>
                    <td class="text-end"><?= number_format($r['total'], 0, ',', '.') ?></td>
                  </tr>
                <?php endforeach ?>
                <?php if (empty($cashIn)): ?>
                  <tr><td colspan="2" class="text-center">Belum ada data</td></tr>
                <?php endif ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Cash Out -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h6 class="mb-0">Total Pengeluaran (per hari)</h6>
          <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#transactionModal" data-type="out">
            + Tambah Pengeluaran
          </button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-middle">
              <thead class="table-secondary">
                <tr class="text-center">
                  <th>Tanggal</th>
                  <th class="text-end">Total</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($cashOut as $r): ?>
                  <tr class="text-center">
                    <td><?= esc($r['date']) ?></td>
                    <td class="text-end"><?= number_format($r['total'], 0, ',', '.') ?></td>
                  </tr>
                <?php endforeach ?>
                <?php if (empty($cashOut)): ?>
                  <tr><td colspan="2" class="text-center">Belum ada data</td></tr>
                <?php endif ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


<!-- Modal CRUD Transaksi -->
<div class="modal fade" id="transactionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method="post" action="<?= base_url('dashboard/transaksi/store') ?>">
      <?= csrf_field() ?>
      <input type="hidden" name="type" id="trx-type">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Transaksi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label>Tanggal</label>
          <input type="text" name="date" id="trx-date" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Keterangan</label>
          <input type="text" name="description" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Jumlah</label>
          <input type="number" name="amount" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>


<!-- Flatpickr Datepicker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
  flatpickr("#trx-date", {
    dateFormat: "Y-m-d",
    defaultDate: "today"
  });

  const trxModal = document.getElementById('transactionModal');
  trxModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const type = button.getAttribute('data-type');
    trxModal.querySelector('#trx-type').value = type;
    trxModal.querySelector('.modal-title').textContent =
      type === 'in' ? 'Tambah Pemasukan' : 'Tambah Pengeluaran';
  });
});
</script>

<?= $this->endSection() ?>
