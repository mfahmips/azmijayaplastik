<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>
<div class="app-content">
  <div class="content-wrapper">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h1>Transaksi Penjualan</h1>
          <p class="text-muted">Daftar semua transaksi yang telah dilakukan.</p>
        </div>
      </div>

      <div class="card">
        <div class="card-body table-responsive p-0">
          <table class="table table-hover mb-0">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Invoice</th>
                <th>Total</th>
                <th>Dibayar</th>
                <th>Kembali</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody id="penjualan-body">
              <tr><td colspan="6" class="text-center py-4">Memuat data...</td></tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script>
$(document).ready(function () {
  $.getJSON('<?= base_url('dashboard/penjualan/data') ?>', function(data) {
    if (!data.length) {
      $('#penjualan-body').html('<tr><td colspan="6" class="text-center text-muted py-4">Belum ada transaksi.</td></tr>');
      return;
    }

    let html = '';
    data.forEach((item, i) => {
      html += `
        <tr>
          <td>${i+1}</td>
          <td>${item.invoice}</td>
          <td>Rp ${parseInt(item.total_price).toLocaleString()}</td>
          <td>Rp ${parseInt(item.paid).toLocaleString()}</td>
          <td>Rp ${parseInt(item.change).toLocaleString()}</td>
          <td>${item.created_at}</td>
        </tr>`;
    });
    $('#penjualan-body').html(html);
  });
});
</script>
<?= $this->endSection() ?>
