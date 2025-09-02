<!--start wrapper-->
<div class="wrapper">

  <!--start sidebar -->
  <aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
      <div>
        <img src="<?= base_url('assets/backend/images/logo-icon-2.png') ?>" class="logo-icon" alt="logo icon">
      </div>
      <div>
        <h4 class="logo-text">Azmi Jaya</h4>
      </div>
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
        <a href="<?= base_url('dashboard/sales/create') ?>">
          <div class="parent-icon"><ion-icon name="cash-outline"></ion-icon></div>
          <div class="menu-title">Kasir</div>
        </a>
      </li>

      <!-- Master Data -->
      <li class="menu-label">Master Data</li>

      <li>
        <a href="<?= base_url('dashboard/products') ?>">
          <div class="parent-icon"><ion-icon name="cube-outline"></ion-icon></div>
          <div class="menu-title">Produk</div>
        </a>
      </li>
      <li>
        <a href="<?= base_url('dashboard/categories') ?>">
          <div class="parent-icon"><ion-icon name="albums-outline"></ion-icon></div>
          <div class="menu-title">Kategori</div>
        </a>
      </li>
      <li>
        <a href="<?= base_url('dashboard/suppliers') ?>">
          <div class="parent-icon"><ion-icon name="business-outline"></ion-icon></div>
          <div class="menu-title">Supplier</div>
        </a>
      </li>

      <!-- Pengaturan -->
      <li class="menu-label">Settings</li>

      <li>
        <a href="<?= base_url('dashboard/store-setting') ?>">
          <div class="parent-icon"><ion-icon name="storefront-outline"></ion-icon></div>
          <div class="menu-title">Profil Toko</div>
        </a>
      </li>

      <li>
        <a href="<?= base_url('dashboard/support') ?>">
          <div class="parent-icon"><ion-icon name="help-circle-outline"></ion-icon></div>
          <div class="menu-title">Support</div>
        </a>
      </li>

    </ul>
    <!--end navigation-->

  </aside>
  <!--end sidebar-->
