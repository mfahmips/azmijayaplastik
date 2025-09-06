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
          <a class="nav-link mobile-search-button" href="javascript:;">
            <ion-icon name="search-outline"></ion-icon>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link dark-mode-icon" href="javascript:;">
            <ion-icon name="moon-outline"></ion-icon>
          </a>
        </li>

        <!-- Apps dropdown -->
        <li class="nav-item dropdown dropdown-large dropdown-apps">
          <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
            <ion-icon name="apps-outline"></ion-icon>
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
            <div class="row row-cols-3 g-3 p-3">
              <div class="col text-center">
                <div class="app-box mx-auto bg-gradient-purple text-white">
                  <ion-icon name="cart-outline"></ion-icon>
                </div>
                <div class="app-title">Orders</div>
              </div>
              <div class="col text-center">
                <div class="app-box mx-auto bg-gradient-info text-white">
                  <ion-icon name="people-outline"></ion-icon>
                </div>
                <div class="app-title">Teams</div>
              </div>
              <div class="col text-center">
                <div class="app-box mx-auto bg-gradient-success text-white">
                  <ion-icon name="shield-checkmark-outline"></ion-icon>
                </div>
                <div class="app-title">Tasks</div>
              </div>
            </div>
          </div>
        </li>

        <!-- Notifications -->
        <li class="nav-item dropdown dropdown-large">
          <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
            <div class="position-relative">
              <span class="notify-badge">8</span>
              <ion-icon name="notifications-outline"></ion-icon>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-end">
            <a href="#"><div class="msg-header"><p class="msg-header-title">Notifications</p></div></a>
            <div class="header-notifications-list">
              <a class="dropdown-item" href="#">
                <div class="d-flex align-items-center">
                  <div class="notify text-primary">
                    <ion-icon name="cart-outline"></ion-icon>
                  </div>
                  <div class="flex-grow-1">
                    <h6 class="msg-name">New Orders</h6>
                    <p class="msg-info">You have new orders</p>
                  </div>
                </div>
              </a>
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
