<?= $this->extend('backend/layout/default') ?>

<?= $this->section('content') ?>

<div class="app-content">
  <div class="content-wrapper">
    <div class="container">

      <!-- Cards Ringkasan -->
      <div class="row g-3">
        <div class="col-xl-4">
          <div class="card widget widget-stats">
            <div class="card-body">
              <div class="widget-stats-container d-flex">
                <div class="widget-stats-icon widget-stats-icon-primary">
                  <i class="material-icons-outlined">paid</i>
                </div>
                <div class="widget-stats-content flex-fill">
                  <span class="widget-stats-title">Penjualan Hari Ini</span>
                  <span class="widget-stats-amount">
                    <?= 'Rp ' . number_format($summary['sales_today'] ?? 0,0,',','.') ?>
                  </span>
                  <span class="widget-stats-info">
                    <?= (int)($summary['orders_today'] ?? 0) ?> Transaksi
                  </span>
                </div>
                <?php if (isset($summary['sales_growth'])): ?>
                <div class="widget-stats-indicator <?= ($summary['sales_growth'] ?? 0) >= 0 ? 'widget-stats-indicator-positive' : 'widget-stats-indicator-negative' ?> align-self-start">
                  <i class="material-icons"><?= ($summary['sales_growth'] ?? 0) >= 0 ? 'keyboard_arrow_up' : 'keyboard_arrow_down' ?></i>
                  <?= abs((float)$summary['sales_growth']) ?>%
                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-4">
          <div class="card widget widget-stats">
            <div class="card-body">
              <div class="widget-stats-container d-flex">
                <div class="widget-stats-icon widget-stats-icon-warning">
                  <i class="material-icons-outlined">shopping_bag</i>
                </div>
                <div class="widget-stats-content flex-fill">
                  <span class="widget-stats-title">Jumlah Transaksi</span>
                  <span class="widget-stats-amount"><?= (int)($summary['transactions'] ?? 0) ?></span>
                  <span class="widget-stats-info text-muted">Total bayar: <?= 'Rp ' . number_format($summary['transactions_amount'] ?? 0,0,',','.') ?></span>
                </div>
                <?php if (isset($summary['trx_growth'])): ?>
                <div class="widget-stats-indicator <?= ($summary['trx_growth'] ?? 0) >= 0 ? 'widget-stats-indicator-positive' : 'widget-stats-indicator-negative' ?> align-self-start">
                  <i class="material-icons"><?= ($summary['trx_growth'] ?? 0) >= 0 ? 'keyboard_arrow_up' : 'keyboard_arrow_down' ?></i>
                  <?= abs((float)$summary['trx_growth']) ?>%
                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-4">
          <div class="card widget widget-stats">
            <div class="card-body">
              <div class="widget-stats-container d-flex">
                <div class="widget-stats-icon widget-stats-icon-danger">
                  <i class="material-icons-outlined">inventory_2</i>
                </div>
                <div class="widget-stats-content flex-fill">
                  <span class="widget-stats-title">Produk Aktif</span>
                  <span class="widget-stats-amount"><?= (int)($summary['active_products'] ?? 0) ?></span>
                  <span class="widget-stats-info">
                    <?= (int)($summary['low_stock_count'] ?? 0) ?> Hampir Habis
                  </span>
                </div>
                <div class="widget-stats-indicator align-self-start">
                  <i class="material-icons">warning_amber</i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /cards -->

      <div class="row mt-3 g-3">
        <!-- Produk Hampir Habis -->
        <div class="col-xl-6">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="mb-0">Produk Hampir Habis</h5>
              <a href="<?= base_url('backend/stok-minimum') ?>" class="btn btn-sm btn-outline-primary">Kelola Stok</a>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                  <thead class="table-light">
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
        </div>

        <!-- Aktivitas Terakhir -->
        <div class="col-xl-6">
          <div class="card h-100">
            <div class="card-header">
              <h5 class="mb-0">Aktivitas Terakhir</h5>
            </div>
            <div class="card-body">
              <?php if (!empty($activities)): ?>
                <ul class="list-group list-group-flush">
                  <?php foreach ($activities as $act): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-start px-0">
                      <div class="d-flex">
                        <span class="badge bg-<?= esc($act['color'] ?? 'secondary') ?> me-3 d-flex align-items-center justify-content-center" style="width:28px;height:28px;">
                          <i class="material-icons-outlined" style="font-size:18px;"><?= esc($act['icon'] ?? 'info') ?></i>
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

    </div><!-- /container -->
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Placeholder: jika mau ambil data live via AJAX, taruh di sini.
</script>
<?= $this->endSection() ?>
