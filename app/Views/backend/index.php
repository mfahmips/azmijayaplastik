<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>

<div class="page-content">

  <!--start breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Dashboard</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0 align-items-center">
          <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>"><ion-icon name="home-outline"></ion-icon></a></li>
          <li class="breadcrumb-item active" aria-current="page">eCommerce</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <div class="btn-group">
        <button type="button" class="btn btn-outline-primary">Settings</button>
        <button type="button" class="btn btn-outline-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
          <span class="visually-hidden">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Separated link</a>
        </div>
      </div>
    </div>
  </div>
  <!--end breadcrumb-->

  <!-- Summary Cards -->
  <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4 g-3">

  <!-- Followers -> Total Produk -->
  <div class="col">
    <div class="card radius-10 h-100">
      <div class="card-body">
        <div class="d-flex align-items-center gap-2">
          <div class="fs-5"><ion-icon name="people-outline"></ion-icon></div>
          <div><p class="mb-0">Total Produk</p></div>
          <div class="ms-auto fs-5"><ion-icon name="ellipsis-horizontal-sharp"></ion-icon></div>
        </div>
        <h5 class="mb-0 mt-2"><?= esc($summary['active_products'] ?? 0) ?></h5>
        <div id="spark1" class="mt-2"></div>
      </div>
    </div>
  </div>

  <!-- Likes -> Kategori -->
  <div class="col">
    <div class="card radius-10 h-100">
      <div class="card-body">
        <div class="d-flex align-items-center gap-2">
          <div class="fs-5"><ion-icon name="heart-outline"></ion-icon></div>
          <div><p class="mb-0">Kategori</p></div>
          <div class="ms-auto fs-5"><ion-icon name="ellipsis-horizontal-sharp"></ion-icon></div>
        </div>
        <h5 class="mb-0 mt-2"><?= esc($summary['total_kategori'] ?? 0) ?></h5>
        <div id="spark2" class="mt-2"></div>
      </div>
    </div>
  </div>

  <!-- Comments -> Supplier -->
  <div class="col">
    <div class="card radius-10 h-100">
      <div class="card-body">
        <div class="d-flex align-items-center gap-2">
          <div class="fs-5"><ion-icon name="chatbox-outline"></ion-icon></div>
          <div><p class="mb-0">Supplier</p></div>
          <div class="ms-auto fs-5"><ion-icon name="ellipsis-horizontal-sharp"></ion-icon></div>
        </div>
        <h5 class="mb-0 mt-2"><?= esc($summary['total_supplier'] ?? 0) ?></h5>
        <div id="spark3" class="mt-2"></div>
      </div>
    </div>
  </div>

  <!-- Messages -> Total Penjualan (bar) -->
  <div class="col">
    <div class="card radius-10 h-100">
      <div class="card-body">
        <div class="d-flex align-items-center gap-2">
          <div class="fs-5"><ion-icon name="mail-outline"></ion-icon></div>
          <div><p class="mb-0">Total Penjualan</p></div>
          <div class="ms-auto fs-5"><ion-icon name="ellipsis-horizontal-sharp"></ion-icon></div>
        </div>
        <h5 class="mb-0 mt-2">Rp <?= esc(number_format($summary['transactions_amount'] ?? 0)) ?></h5>
        <div id="spark4" class="mt-2"></div>
      </div>
    </div>
  </div>

</div>


</div><!--end page content-->

<script src="<?= base_url('assets/backend/plugins/apexcharts-bundle/js/apexcharts.min.js') ?>"></script>
<script>
  function areaSpark(selector, color, seriesData) {
    return new ApexCharts(document.querySelector(selector), {
      chart: {
        type: "area",
        height: 50,
        sparkline: { enabled: true },
        group: "sparks"
      },
      stroke: { curve: "smooth", width: 2 },
      fill: { opacity: 0.3, type: 'solid' },
      series: [{ data: seriesData }],
      colors: [color],
      tooltip: { enabled: false }
    });
  }

  function barSpark(selector, color, seriesData) {
    return new ApexCharts(document.querySelector(selector), {
      chart: {
        type: "bar",
        height: 50,
        sparkline: { enabled: true },
        group: "sparks"
      },
      plotOptions: {
        bar: {
          columnWidth: '60%'
        }
      },
      series: [{ data: seriesData }],
      colors: [color],
      tooltip: { enabled: false }
    });
  }
</script>

<!-- ApexCharts Sparkline Init -->
<script>
  const spark1Data = <?= json_encode($chart_spark1) ?>;
  areaSpark('#spark1', '#f59e0b', spark1Data).render();

  const spark2Data = <?= json_encode($chart_spark2) ?>;
  areaSpark('#spark2', '#10b981', spark2Data).render();

  const spark3Data = <?= json_encode($chart_spark3) ?>;
  areaSpark('#spark3', '#3b82f6', spark3Data).render();

  const spark4Data = <?= json_encode($chart_spark4) ?>;
  barSpark('#spark4', '#8b5cf6', spark4Data).render();
</script>


<?= $this->endSection() ?>
