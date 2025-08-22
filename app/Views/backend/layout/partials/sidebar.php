<?php
// Helper kelas aktif & open
if (!function_exists('is_active')) {
  function is_active(string|array $patterns): string {
    $patterns = (array) $patterns;
    foreach ($patterns as $p) if (url_is($p)) return 'active';
    return '';
  }
}
if (!function_exists('is_open')) {
  function is_open(string|array $patterns): string {
    $patterns = (array) $patterns;
    foreach ($patterns as $p) if (url_is($p)) return 'open';
    return '';
  }
}
?>
<div class="app full-width-header align-content-stretch">
<div class="app-sidebar">
  <div class="logo text-center py-3">
    <a href="<?= base_url('dashboard') ?>" class="d-flex align-items-center justify-content-center text-decoration-none">
        <img src="<?= base_url('assets/backend/images/avatars/avatar.png') ?>" alt="Azmi Jaya Plastik" style="height:40px; margin-right:8px;">
    </a>
 </div>


  <div class="app-menu">
    <ul class="accordion-menu">

      <!-- ====== Menu Utama ====== -->
      <li class="sidebar-title">Utama</li>

      <li class="<?= is_active(['dashboard','backend/dashboard']) ?>">
        <a href="<?= base_url('dashboard') ?>" class="<?= is_active(['dashboard','backend/dashboard']) ?>">
          <i class="material-icons-two-tone">dashboard</i>Dashboard
        </a>
      </li>

      <li>
        <a href="<?= base_url('dashboard/kasir') ?>">
          <i class="material-icons-two-tone">point_of_sale</i>Kasir
        </a>
      </li>


      <!-- ====== Master Data ====== -->
      <li class="sidebar-title">Master Data</li>

      <li class="<?= is_open([
        'dashboard/products*',
        'dashboard/categories*',
        'dashboard/suppliers*',
        'dashboard/customers*'
      ]) ?>">
        <a href="#">
          <i class="material-icons-two-tone">inventory_2</i>
          Produk & Relasi
          <i class="material-icons has-sub-menu">keyboard_arrow_right</i>
        </a>
        <ul class="sub-menu">
          <li>
            <a class="<?= is_active('dashboard/products*') ?>" href="<?= base_url('dashboard/products') ?>">
              Produk
            </a>
          </li>
          <li>
            <a class="<?= is_active('dashboard/categories*') ?>" href="<?= base_url('dashboard/categories') ?>">
              Kategori
            </a>
          </li>
          <li>
            <a class="<?= is_active('dashboard/suppliers*') ?>" href="<?= base_url('dashboard/suppliers') ?>">
              Supplier
            </a>
          </li>
          <li>
            <a class="<?= is_active('dashboard/customers*') ?>" href="<?= base_url('dashboard/customers') ?>">
              Pelanggan
            </a>
          </li>
        </ul>
      </li>




      <!-- ====== Stok & Inventori ====== -->
      <li class="sidebar-title">Stok & Inventori</li>

      <li class="<?= is_open(['backend/stok-masuk*','backend/stok-keluar*','backend/mutasi-stok*','backend/stok-minimum*']) ?>">
        <a href="#">
          <i class="material-icons-two-tone">inventory</i>Stok
          <i class="material-icons has-sub-menu">keyboard_arrow_right</i>
        </a>
        <ul class="sub-menu">
          <li><a class="<?= is_active('backend/stok-masuk*') ?>"    href="<?= base_url('backend/stok-masuk') ?>">Stok Masuk</a></li>
          <li><a class="<?= is_active('backend/stok-keluar*') ?>"   href="<?= base_url('backend/stok-keluar') ?>">Stok Keluar</a></li>
          <li><a class="<?= is_active('backend/mutasi-stok*') ?>"   href="<?= base_url('backend/mutasi-stok') ?>">Mutasi Stok</a></li>
          <li><a class="<?= is_active('backend/stok-minimum*') ?>"  href="<?= base_url('backend/stok-minimum') ?>">Stok Hampir Habis</a></li>
        </ul>
      </li>

      <!-- ====== Transaksi ====== -->
      <li class="sidebar-title">Transaksi</li>

      <li class="<?= is_open(['backend/penjualan*','backend/pembelian*']) ?>">
        <a href="#">
          <i class="material-icons-two-tone">receipt_long</i>Transaksi
          <i class="material-icons has-sub-menu">keyboard_arrow_right</i>
        </a>
        <ul class="sub-menu">
          <li><a class="<?= is_active('backend/penjualan*') ?>" href="<?= base_url('backend/penjualan') ?>">Penjualan</a></li>
          <li><a class="<?= is_active('backend/pembelian*') ?>" href="<?= base_url('backend/pembelian') ?>">Pembelian</a></li>
        </ul>
      </li>

      <!-- ====== Laporan ====== -->
      <li class="sidebar-title">Laporan</li>

      <li class="<?= is_open(['backend/laporan/penjualan*','backend/laporan/pembelian*','backend/laporan/stok*']) ?>">
        <a href="#">
          <i class="material-icons-two-tone">analytics</i>Laporan
          <i class="material-icons has-sub-menu">keyboard_arrow_right</i>
        </a>
        <ul class="sub-menu">
          <li><a class="<?= is_active('backend/laporan/penjualan*') ?>" href="<?= base_url('backend/laporan/penjualan') ?>">Penjualan</a></li>
          <li><a class="<?= is_active('backend/laporan/pembelian*') ?>" href="<?= base_url('backend/laporan/pembelian') ?>">Pembelian</a></li>
          <li><a class="<?= is_active('backend/laporan/stok*') ?>"       href="<?= base_url('backend/laporan/stok') ?>">Stok</a></li>
        </ul>
      </li>

      <!-- ====== Pengaturan ====== -->
      <li class="sidebar-title">Pengaturan</li>

      <li class="<?= is_open(['backend/pengaturan*','backend/users*','backend/backup*']) ?>">
        <a href="#">
          <i class="material-icons-two-tone">settings</i>Pengaturan
          <i class="material-icons has-sub-menu">keyboard_arrow_right</i>
        </a>
        <ul class="sub-menu">
          <li><a class="<?= is_active('backend/pengaturan') ?>" href="<?= base_url('backend/pengaturan') ?>">Profil Toko</a></li>
          <li><a class="<?= is_active('backend/users*') ?>"     href="<?= base_url('backend/users') ?>">Pengguna & Role</a></li>
          <li><a class="<?= is_active('backend/backup*') ?>"    href="<?= base_url('backend/backup') ?>">Backup / Restore</a></li>
        </ul>
      </li>

    </ul>
  </div>
</div>
