<!-- App Sidebar -->
<div class="app-sidebar">
  <!-- Sidebar Logo -->
  <div class="logo-box">
    <a href="<?= site_url('dashboard') ?>" class="logo-dark">
      <img src="<?= base_url('assets/images/logo-sm.png') ?>" class="logo-sm" alt="logo sm">
      <img src="<?= base_url('assets/images/logo-dark.png') ?>" class="logo-lg" alt="logo dark">
    </a>
    <a href="<?= site_url('dashboard') ?>" class="logo-light">
      <img src="<?= base_url('assets/images/logo-sm.png') ?>" class="logo-sm" alt="logo sm">
      <img src="<?= base_url('assets/images/logo-light.png') ?>" class="logo-lg" alt="logo light">
    </a>
  </div>

  <div class="scrollbar" data-simplebar>
    <ul class="navbar-nav" id="navbar-nav">

      <li class="menu-title">UTAMA</li>

      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('dashboard') ?>">
          <span class="nav-icon"><iconify-icon icon="mingcute:home-3-line"></iconify-icon></span>
          <span class="nav-text">Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('dashboard/kasir') ?>">
          <span class="nav-icon"><iconify-icon icon="mingcute:calculator-line"></iconify-icon></span>
          <span class="nav-text">Kasir</span>
        </a>
      </li>

      <li class="menu-title">MASTER DATA</li>

      <li class="nav-item">
        <a class="nav-link menu-arrow" href="#menuProduk" data-bs-toggle="collapse" role="button" aria-expanded="false">
          <span class="nav-icon"><iconify-icon icon="mingcute:box-line"></iconify-icon></span>
          <span class="nav-text">Produk & Relasi</span>
        </a>
        <div class="collapse" id="menuProduk">
          <ul class="nav sub-navbar-nav">
            <li class="sub-nav-item">
              <a class="sub-nav-link" href="<?= site_url('dashboard/products') ?>">Produk</a>
            </li>
            <li class="sub-nav-item">
              <a class="sub-nav-link" href="<?= site_url('dashboard/categories') ?>">Kategori</a>
            </li>
            <li class="sub-nav-item">
              <a class="sub-nav-link" href="<?= site_url('dashboard/suppliers') ?>">Supplier</a>
            </li>
            <li class="sub-nav-item">
              <a class="sub-nav-link" href="<?= site_url('dashboard/customers') ?>">Pelanggan</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="menu-title">STOK & INVENTORI</li>

      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('dashboard/stok') ?>">
          <span class="nav-icon"><iconify-icon icon="mingcute:stack-line"></iconify-icon></span>
          <span class="nav-text">Stok</span>
        </a>
      </li>

      <li class="menu-title">TRANSAKSI</li>

      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('dashboard/transactions') ?>">
          <span class="nav-icon"><iconify-icon icon="mingcute:receipt-line"></iconify-icon></span>
          <span class="nav-text">Transaksi Penjualan</span>
        </a>
      </li>

      <li class="menu-title">PENGATURAN</li>

      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('dashboard/store-setting') ?>">
          <span class="nav-icon"><iconify-icon icon="mingcute:settings-5-line"></iconify-icon></span>
          <span class="nav-text">Pengaturan Toko</span>
        </a>
      </li>

      <li class="menu-title">LAPORAN</li>

      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('dashboard/reports') ?>">
          <span class="nav-icon"><iconify-icon icon="mingcute:file-chart-line"></iconify-icon></span>
          <span class="nav-text">Laporan</span>
        </a>
      </li>

    </ul>
  </div>
</div>
