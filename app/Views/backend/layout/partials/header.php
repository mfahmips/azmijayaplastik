<!-- Topbar Start -->
<header class="app-topbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <div class="d-flex align-items-center gap-2">

        <!-- Menu Toggle Button -->
        <div class="topbar-item">
          <button type="button" class="button-toggle-menu topbar-button">
            <iconify-icon icon="solar:hamburger-menu-outline" class="fs-24 align-middle"></iconify-icon>
          </button>
        </div>

      </div>

      <div class="d-flex align-items-center gap-2">

        <!-- Theme Switch (Light/Dark) -->
        <div class="topbar-item">
          <button type="button" class="topbar-button" id="light-dark-mode">
            <iconify-icon icon="solar:moon-outline" class="fs-22 align-middle light-mode"></iconify-icon>
            <iconify-icon icon="solar:sun-2-outline" class="fs-22 align-middle dark-mode"></iconify-icon>
          </button>
        </div>

        <!-- Notifikasi (Opsional Aktif) -->
        <div class="dropdown topbar-item">
          <button type="button" class="topbar-button position-relative" data-bs-toggle="dropdown">
            <iconify-icon icon="solar:bell-bing-outline" class="fs-22 align-middle"></iconify-icon>
            <span class="position-absolute topbar-badge fs-10 translate-middle badge bg-danger rounded-pill">1</span>
          </button>
          <div class="dropdown-menu dropdown-menu-end dropdown-lg p-3">
            <h6 class="mb-2 fw-bold">Notifikasi</h6>
            <div style="max-height: 200px;" data-simplebar>
              <a href="#" class="dropdown-item d-flex align-items-center py-2">
                <div class="avatar-sm me-3">
                  <span class="avatar-title bg-soft-warning text-warning rounded-circle">
                    <iconify-icon icon="solar:warning-outline"></iconify-icon>
                  </span>
                </div>
                <div>
                  <p class="mb-0">Stok produk <strong>Gelas Plastik</strong> hampir habis.</p>
                </div>
              </a>
            </div>
            <div class="mt-2 text-center">
              <a href="<?= site_url('dashboard/stok') ?>" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
            </div>
          </div>
        </div>

        <!-- User Dropdown -->
        <div class="dropdown topbar-item">
          <a class="topbar-button" data-bs-toggle="dropdown" href="#">
            <img class="rounded-circle" src="<?= base_url('assets/images/users/avatar-1.jpg') ?>" width="32" alt="User">
          </a>
          <div class="dropdown-menu dropdown-menu-end">
            <h6 class="dropdown-header">Selamat datang!</h6>

            <a class="dropdown-item" href="#">
              <iconify-icon icon="solar:user-outline" class="me-2"></iconify-icon>
              Akun Saya
            </a>
            <div class="dropdown-divider my-1"></div>
            <a class="dropdown-item text-danger" href="<?= site_url('auth/logout') ?>">
              <iconify-icon icon="solar:logout-3-outline" class="me-2"></iconify-icon>
              Keluar
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>
</header>
<!-- Topbar End -->
