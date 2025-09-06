<!--start wrapper-->
<div class="wrapper">

  <!--start sidebar -->
  <aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
      <div>
        <h4 class="fw-semibold text-light" title="<?= esc($store_info['store_name']) ?>">
          <?= esc($store_info['store_name']) ?>
        </h4>
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
            <a href="<?= base_url('dashboard/products/stock-out') ?>">
              <ion-icon name="ellipse-outline"></ion-icon>Stok Keluar
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

      <!-- Support -->
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
