<!--start wrapper-->
<div class="wrapper">

  <!--start sidebar -->
  <aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header d-flex align-items-center">
      <!-- Logo saat sidebar collapse -->
      <a href="<?= base_url('dashboard') ?>" class="logo-icon">
        <?php if (!empty($store_info['store_logo'])): ?>
          <img src="<?= base_url($store_info['store_logo']) ?>"
           alt="Logo"
           style="height:35px;">
        <?php else: ?>
          <img src="<?= base_url('assets/images/default-logo.png') ?>"
               alt="Logo"
               class="img-fluid"
               style="height:35px;">
        <?php endif; ?>
      </a>

      <!-- Nama Toko saat sidebar expand -->
      <span class="logo-text fw-semibold text-light ms-2" 
            title="<?= esc($store_info['store_name']) ?>">
        <?= esc($store_info['store_name']) ?>
      </span>
    </div>

    <!--navigation-->
    <ul class="metismenu" id="menu">

      <!-- Dashboard -->
      <li>
        <a href="<?= base_url('dashboard') ?>">
          <div class="parent-icon"><ion-icon name="home-outline"></ion-icon></div>
          <div class="menu-title">Dashboard</div>
        </a>
      </li>

      <!-- Kasir -->
      <li>
        <a href="<?= base_url('dashboard/kasir') ?>">
          <div class="parent-icon"><ion-icon name="cash-outline"></ion-icon></div>
          <div class="menu-title">Kasir</div>
        </a>
      </li>

      <!-- Master Data -->
      <li class="menu-label">Master Data</li>

      <!-- Produk -->
      <li>
        <a href="javascript:;" class="has-arrow">
          <div class="parent-icon"><ion-icon name="cube-outline"></ion-icon></div>
          <div class="menu-title">Produk</div>
        </a>
        <ul>
          <li>
            <a href="<?= base_url('dashboard/products') ?>">
              <ion-icon name="ellipse-outline"></ion-icon>Data
            </a>
          </li>
          <li>
            <a href="<?= base_url('dashboard/products/stock-in') ?>">
              <ion-icon name="ellipse-outline"></ion-icon>Stok Masuk
            </a>
          </li>
          <li>
            <a href="<?= base_url('dashboard/products/stock-opname') ?>">
              <ion-icon name="ellipse-outline"></ion-icon>Stok Opname
            </a>
          </li>
        </ul>
      </li>

      <!-- Kategori -->
      <li>
        <a href="<?= base_url('dashboard/categories') ?>">
          <div class="parent-icon"><ion-icon name="albums-outline"></ion-icon></div>
          <div class="menu-title">Kategori</div>
        </a>
      </li>

      <!-- Supplier -->
      <li>
        <a href="<?= base_url('dashboard/suppliers') ?>">
          <div class="parent-icon"><ion-icon name="business-outline"></ion-icon></div>
          <div class="menu-title">Supplier</div>
        </a>
      </li>

      <!-- Reports -->
      <li class="menu-label">Reports</li>

      <!-- Cashflow -->
      <li>
        <a href="<?= base_url('dashboard/cashflow') ?>">
          <div class="parent-icon"><ion-icon name="cash-outline"></ion-icon></div>
          <div class="menu-title">Cashflow</div>
        </a>
      </li>

      <!-- Transaksi -->
      <li>
        <a href="<?= base_url('dashboard/transaksi') ?>">
          <div class="parent-icon"><ion-icon name="swap-horizontal-outline"></ion-icon></div>
          <div class="menu-title">Transaksi</div>
        </a>
      </li>

      <!-- Settings -->
      <li class="menu-label">Settings</li>

      <!-- Profil Toko -->
      <li>
        <a href="<?= base_url('dashboard/store-setting') ?>">
          <div class="parent-icon"><ion-icon name="storefront-outline"></ion-icon></div>
          <div class="menu-title">Profil Toko</div>
        </a>
      </li>

    </ul>
    <!--end navigation-->

  </aside>
  <!--end sidebar-->

<style>
  .sidebar-header img,
  .logo-icon img {
    filter: none !important;
    opacity: 1 !important;
  }

  /* Atur ukuran logo sidebar */
.sidebar-logo {
  height: 40px;       /* lebih besar dari sebelumnya */
  width: auto;        /* biar proporsional */
  object-fit: contain;
}

/* Supaya teks sejajar dengan logo */
.sidebar-header {
  gap: 10px;          /* jarak antara logo dan teks */
}

/* Atur teks logo di sidebar */
.logo-text {
  font-size: 6px;          /* cukup mungil, masih terbaca */
  font-weight: 500;
  line-height: 1;
  max-width: 50px;         /* batasi lebar maksimal */
  overflow: hidden;
  text-overflow: ellipsis; /* pakai "..." jika terlalu panjang */
  white-space: nowrap;
  display: inline-block;
  vertical-align: middle;
}


</style>
