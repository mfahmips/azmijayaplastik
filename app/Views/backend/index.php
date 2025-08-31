<?= $this->extend('backend/layout/default') ?>

<?= $this->section('content') ?>



<!-- Start Container Fluid -->
<div class="container-fluid">

  <!-- Ringkasan Card -->
  <div class="row">
    <div class="col-md-4">
      <div class="card card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <p class="text-muted mb-1">Penjualan Hari Ini</p>
            <h4><?= 'Rp ' . number_format($summary['sales_today'] ?? 0, 0, ',', '.') ?></h4>
            <span class="badge bg-success"><?= (int)($summary['orders_today'] ?? 0) ?> Transaksi</span>
          </div>
          <div class="avatar-md bg-soft-primary rounded">
            <iconify-icon icon="solar:wallet-outline" class="fs-32 avatar-title text-primary"></iconify-icon>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <p class="text-muted mb-1">Total Transaksi</p>
            <h4><?= (int)($summary['transactions'] ?? 0) ?></h4>
            <span class="text-muted"><?= 'Rp ' . number_format($summary['transactions_amount'] ?? 0, 0, ',', '.') ?></span>
          </div>
          <div class="avatar-md bg-soft-warning rounded">
            <iconify-icon icon="solar:archive-linear" class="fs-32 avatar-title text-warning"></iconify-icon>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <p class="text-muted mb-1">Produk Aktif</p>
            <h4><?= (int)($summary['active_products'] ?? 0) ?></h4>
            <span class="badge bg-danger"><?= (int)($summary['low_stock_count'] ?? 0) ?> Hampir Habis</span>
          </div>
          <div class="avatar-md bg-soft-danger rounded">
            <iconify-icon icon="solar:box-minimalistic-linear" class="fs-32 avatar-title text-danger"></iconify-icon>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 2 Column: Produk Hampir Habis & Aktivitas -->
  <div class="row">
    <!-- Produk Hampir Habis -->
    <div class="col-lg-6">
      <div class="card card-body h-100">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title mb-0">Produk Hampir Habis</h5>
          <a href="<?= base_url('dashboard/stok-minimum') ?>" class="btn btn-sm btn-outline-light">Kelola Stok</a>
        </div>
        <div class="table-responsive">
          <table class="table table-sm align-middle table-dark border-0">
            <thead class="text-muted">
              <tr>
                <th>Produk</th>
                <th class="text-end">Stok</th>
                <th class="text-end">Min</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($lowStocks)): ?>
                <?php foreach ($lowStocks as $item): ?>
                  <tr>
                    <td><?= esc($item['name']) ?></td>
                    <td class="text-end"><?= (int)$item['stock'] ?></td>
                    <td class="text-end"><?= (int)$item['min_stock'] ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="3" class="text-center text-muted py-4">Semua stok aman 🎉</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="col-lg-6">
      <div class="card card-body h-100">
        <h5 class="card-title mb-3">Aktivitas Terbaru</h5>
        <?php if (!empty($activities)): ?>
          <ul class="list-group list-group-flush">
            <?php foreach ($activities as $act): ?>
              <li class="list-group-item bg-transparent d-flex justify-content-between align-items-start px-0">
                <div class="d-flex">
                  <span class="badge bg-<?= esc($act['color'] ?? 'secondary') ?> me-3 d-flex align-items-center justify-content-center" style="width:28px;height:28px;">
                    <iconify-icon icon="<?= esc($act['icon'] ?? 'solar:info-circle-outline') ?>" style="font-size:18px;"></iconify-icon>

                  </span>
                  <div>
                    <div class="fw-semibold"><?= esc($act['title']) ?></div>
                    <small class="text-muted"><?= esc($act['desc'] ?? '') ?></small>
                  </div>
                </div>
                <small class="text-nowrap text-muted"><?= esc($act['time']) ?></small>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <div class="text-muted">Belum ada aktivitas.</div>
        <?php endif; ?>
      </div>
    </div>
  </div>

</div>
<!-- End Container Fluid -->

<?= $this->endSection() ?>
