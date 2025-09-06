<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>

<div class="page-content">
  <div class="card">
    <div class="card-header d-flex justify-content-between">
      <h5>Arus Kas</h5>
      <form class="d-flex" method="get">
        <input type="date" name="start" value="<?= $start ?>" class="form-control form-control-sm">
        <input type="date" name="end" value="<?= $end ?>" class="form-control form-control-sm mx-2">
        <button class="btn btn-primary btn-sm">Filter</button>
      </form>
    </div>

    <div class="card-body">
      <div class="row mb-3">
        <div class="col-md-4">
          <div class="alert alert-success">Total Pemasukan: <b>Rp <?= number_format($total_income, 0, ',', '.') ?></b></div>
        </div>
        <div class="col-md-4">
          <div class="alert alert-danger">Total Pengeluaran: <b>Rp <?= number_format($total_expense, 0, ',', '.') ?></b></div>
        </div>
        <div class="col-md-4">
          <div class="alert alert-info">Saldo Akhir: <b>Rp <?= number_format($balance, 0, ',', '.') ?></b></div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="table-secondary">
            <tr>
              <th>Tanggal</th>
              <th>Pemasukan (Rp)</th>
              <th>Pengeluaran (Rp)</th>
              <th>Saldo Harian (Rp)</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $dates = [];
            foreach ($income as $row) $dates[$row['tgl']]['income'] = $row['total'];
            foreach ($expense as $row) $dates[$row['tgl']]['expense'] = $row['total'];

            ksort($dates);
            $running = 0;
            foreach ($dates as $tgl => $val):
              $in  = $val['income'] ?? 0;
              $out = $val['expense'] ?? 0;
              $running += ($in - $out);
            ?>
            <tr>
              <td><?= $tgl ?></td>
              <td class="text-success"><?= number_format($in, 0, ',', '.') ?></td>
              <td class="text-danger"><?= number_format($out, 0, ',', '.') ?></td>
              <td class="text-info"><?= number_format($running, 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
