<!--start top header-->
<header class="top-header border-bottom">
  <nav class="navbar navbar-expand gap-3">
    <div class="toggle-icon">
      <ion-icon name="menu-outline"></ion-icon>
    </div>

    <form class="searchbar">
      <div class="position-absolute top-50 translate-middle-y search-icon ms-3">
        <ion-icon name="search-outline"></ion-icon>
      </div>
      <input class="form-control" type="text" placeholder="Search for anything">
      <div class="position-absolute top-50 translate-middle-y search-close-icon">
        <ion-icon name="close-outline"></ion-icon>
      </div>
    </form>

    <div class="top-navbar-right ms-auto">
      <ul class="navbar-nav align-items-center">

        <li class="nav-item">
          <a class="nav-link dark-mode-icon" href="javascript:;">
            <ion-icon name="moon-outline"></ion-icon>
          </a>
        </li>

        <!-- Notifications -->
        <li class="nav-item dropdown dropdown-large">
          <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
            <div class="position-relative">
              <span class="notify-badge"><?= count($lowStocks ?? []) ?></span>
              <ion-icon name="notifications-outline"></ion-icon>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-end">
            <a href="#"><div class="msg-header"><p class="msg-header-title">Notifications</p></div></a>
            <div class="header-notifications-list">
              <?php if (!empty($lowStocks ?? [])): ?>
                <?php foreach ($lowStocks as $p): ?>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                      <div class="notify text-warning">
                        <ion-icon name="alert-circle-outline"></ion-icon>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="msg-name"><?= esc($p['name']) ?></h6>
                        <p class="msg-info">Stok tersisa: <?= esc($p['stock']) ?></p>
                      </div>
                    </div>
                  </a>
                <?php endforeach; ?>
              <?php else: ?>
                <div class="dropdown-item text-center text-muted">
                  <small>Tidak ada produk yang hampir habis</small>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </li>

        <!-- User dropdown -->
        <li class="nav-item dropdown dropdown-user-setting">
          <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
            <div class="user-setting">
              <img src="<?= base_url('assets/backend/images/avatars/06.png') ?>" class="user-img" alt="User">
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="#">
                <div class="d-flex align-items-center gap-2">
                  <img src="<?= base_url('assets/backend/images/avatars/06.png') ?>" class="rounded-circle" width="54" height="54">
                  <div>
                    <h6 class="mb-0 dropdown-user-name">Jhon Deo</h6>
                    <small class="text-secondary">UI Developer</small>
                  </div>
                </div>
              </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#"><ion-icon name="person-outline"></ion-icon> <span class="ms-3">Profile</span></a></li>
            <li><a class="dropdown-item" href="#"><ion-icon name="settings-outline"></ion-icon> <span class="ms-3">Settings</span></a></li>
            <li><a class="dropdown-item" href="#"><ion-icon name="log-out-outline"></ion-icon> <span class="ms-3">Logout</span></a></li>
          </ul>
        </li>

      </ul>
    </div>
  </nav>
</header>
<!--end top header-->

<style>
/* Dropdown hover agar tetap jelas meski sidebar minimize */
.top-header .dropdown-menu {
  background-color: #1e1e2d; /* warna gelap modern */
  border: 1px solid rgba(255,255,255,0.1);
  z-index: 1050; /* pastikan di atas sidebar */
  min-width: 220px; /* biar ga ketimpa icon */
}

/* Efek hover item di dropdown */
.top-header .dropdown-menu .dropdown-item {
  color: #ddd; 
  padding: 10px 15px;
  transition: background-color 0.2s ease, color 0.2s ease;
}

.top-header .dropdown-menu .dropdown-item:hover {
  background-color: rgba(13, 110, 253, 0.2); /* biru transparan */
  color: #fff;
}

/* Notifikasi item (lebih interaktif) */
.header-notifications-list .dropdown-item:hover .notify {
  transform: scale(1.2);
  transition: transform 0.2s ease;
}

/* Hover pada icon navbar */
.top-header .nav-link:hover ion-icon {
  color: #0d6efd;
}

/* User dropdown hover */
.top-header .dropdown-user-setting .dropdown-menu .dropdown-item:hover {
  background-color: rgba(255,255,255,0.08);
  color: #fff;
}

</style>
