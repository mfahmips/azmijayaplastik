<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>

<div class="page-content">

  <!-- Summary Cards -->
  <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4 g-3">

    <!-- Total Produk -->
    <div class="col">
      <div class="card radius-10 h-100">
        <div class="card-body">
          <div class="d-flex align-items-center gap-2">
            <div class="fs-5"><ion-icon name="cube-outline"></ion-icon></div>
            <div><p class="mb-0">Total Produk</p></div>
            <div class="ms-auto fs-5"><ion-icon name="ellipsis-horizontal-sharp"></ion-icon></div>
          </div>
          <h5 class="mb-0 mt-2"><?= esc($summary['active_products'] ?? 0) ?></h5>
          <div id="spark1" class="mt-2"></div>
        </div>
      </div>
    </div>

    <!-- Stok Akan Habis -->
    <div class="col">
      <div class="card radius-10 h-100">
        <div class="card-body">
          <div class="d-flex align-items-center gap-2">
            <div class="fs-5"><ion-icon name="alert-circle-outline"></ion-icon></div>
            <div><p class="mb-0">Stok Akan Habis</p></div>
            <div class="ms-auto fs-5"><ion-icon name="ellipsis-horizontal-sharp"></ion-icon></div>
          </div>
          <h5 class="mb-0 mt-2"><?= esc($summary['low_stock_count'] ?? 0) ?></h5>
          <div id="spark2" class="mt-2"></div>
        </div>
      </div>
    </div>

    <!-- Total Penjualan -->
    <div class="col">
      <div class="card radius-10 h-100">
        <div class="card-body">
          <div class="d-flex align-items-center gap-2">
            <div class="fs-5"><ion-icon name="cash-outline"></ion-icon></div>
            <div><p class="mb-0">Total Penjualan</p></div>
            <div class="ms-auto fs-5"><ion-icon name="ellipsis-horizontal-sharp"></ion-icon></div>
          </div>
          <h5 class="mb-0 mt-2">Rp <?= esc(number_format($summary['transactions_amount'] ?? 0)) ?></h5>
          <div id="spark3" class="mt-2"></div>
        </div>
      </div>
    </div>

    <!-- Transaksi Keluar -->
    <div class="col">
      <div class="card radius-10 h-100">
        <div class="card-body">
          <div class="d-flex align-items-center gap-2">
            <div class="fs-5"><ion-icon name="trending-down-outline"></ion-icon></div>
            <div><p class="mb-0">Transaksi Keluar</p></div>
            <div class="ms-auto fs-5"><ion-icon name="ellipsis-horizontal-sharp"></ion-icon></div>
          </div>
          <h5 class="mb-0 mt-2">Rp <?= esc(number_format($summary['expenses_amount'] ?? 0)) ?></h5>
          <div id="spark4" class="mt-2"></div>
        </div>
      </div>
    </div>

  </div>

</div><!--end page content-->

<!-- ApexCharts -->
<script src="<?= base_url('assets/backend/plugins/apexcharts-bundle/js/apexcharts.min.js') ?>"></script>
<script>
  function areaSpark(selector, color, seriesData) {
    return new ApexCharts(document.querySelector(selector), {
      chart: { type: "area", height: 50, sparkline: { enabled: true }, group: "sparks" },
      stroke: { curve: "smooth", width: 2 },
      fill: { opacity: 0.3, type: 'solid' },
      series: [{ data: seriesData }],
      colors: [color],
      tooltip: { enabled: false }
    });
  }

  function barSpark(selector, color, seriesData) {
    return new ApexCharts(document.querySelector(selector), {
      chart: { type: "bar", height: 50, sparkline: { enabled: true }, group: "sparks" },
      plotOptions: { bar: { columnWidth: '60%' } },
      series: [{ data: seriesData }],
      colors: [color],
      tooltip: { enabled: false }
    });
  }
</script>

<!-- Init Charts -->
<script>
  areaSpark('#spark1', '#f59e0b', <?= json_encode($chart_spark1) ?>).render(); // total produk
  areaSpark('#spark2', '#ef4444', <?= json_encode($chart_spark2) ?>).render(); // stok habis
  barSpark('#spark3', '#3b82f6', <?= json_encode($chart_spark3) ?>).render();  // penjualan
  barSpark('#spark4', '#8b5cf6', <?= json_encode($chart_spark5) ?>).render();  // transaksi keluar
</script>

<?= $this->endSection() ?>
