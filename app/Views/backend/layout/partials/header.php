<div class="app-container">
            <div class="search">
                <form>
                    <input class="form-control" type="text" placeholder="Type here..." aria-label="Search">
                </form>
                <a href="#" class="toggle-search"><i class="material-icons">close</i></a>
            </div>
            <div class="app-header">
                <nav class="navbar navbar-light navbar-expand-lg">
                    <div class="container-fluid">
                        <div class="navbar-nav" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link hide-sidebar-toggle-button" href="#"><i class="material-icons">first_page</i></a>
                                </li>
                            </ul>
            
                        </div>
                        <div class="d-flex">
                            <ul class="navbar-nav">
                                <!-- Dropdown User Profile -->
								<li class="nav-item dropdown">
								    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								        <img src="<?= base_url('assets/backend/images/avatars/' . ($user['avatar'] ?? 'avatar.png')) ?>" 
								             alt="User Avatar" 
								             class="rounded-circle me-2" width="35" height="35">
								    </a>
								    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
									    <li class="dropdown-header text-center">
									        <strong><?= esc($user['name'] ?? 'Pengguna') ?></strong><br>
									        <small><?= esc($user['role'] ?? 'User') ?></small>
									    </li>
									    <li><hr class="dropdown-divider"></li>

									    <li>
									        <a class="dropdown-item d-flex align-items-center" href="<?= base_url('user/profile') ?>">
									            <i class="material-icons-two-tone me-2" style="font-size:20px;">account_circle</i>
									            <span>Profil</span>
									        </a>
									    </li>

									    <li>
									        <a class="dropdown-item d-flex align-items-center" href="<?= base_url('user/settings') ?>">
									            <i class="material-icons-two-tone me-2" style="font-size:20px;">settings</i>
									            <span>Pengaturan</span>
									        </a>
									    </li>

									    <li><hr class="dropdown-divider"></li>

									    <li>
									        <a class="dropdown-item d-flex align-items-center text-danger" href="<?= base_url('logout') ?>">
									            <i class="material-icons-two-tone me-2" style="font-size:20px;">logout</i>
									            <span>Keluar</span>
									        </a>
									    </li>
									</ul>

								</li>


                            </ul>
                        </div>
                    </div>
                </nav>
            </div>