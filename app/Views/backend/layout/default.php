<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title Meta -->
    <meta charset="utf-8" />
    <title><?= $title ?? 'Dashboard' ?> | Toko Plastik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Toko Plastik Azmi Jaya" />
    <meta name="author" content="PropertyPlace" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="theme-color" content="#1e1e2f">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/backend/images/favicon.ico') ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="<?= base_url('assets/backend/css/vendor.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/backend/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />

    <!-- App CSS -->
    <link href="<?= base_url('assets/backend/css/style.min.css') ?>" rel="stylesheet" type="text/css" />

    <!-- Custom -->
    <link href="<?= base_url('assets/backend/style.css') ?>" rel="stylesheet" type="text/css" />

    <!-- Theme Config -->
    <script src="<?= base_url('assets/backend/js/config.js') ?>"></script>
</head>

<body>

    <!-- Wrapper Start -->
    <div class="app-wrapper">

        <?= $this->include('backend/layout/partials/header') ?>
        <?= $this->include('backend/layout/partials/sidebar') ?>

        <div class="page-content">
        <?= $this->renderSection('content') ?>

    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    &copy; <script>document.write(new Date().getFullYear())</script> - Sistem Toko Plastik by <strong>Azmi Jaya Plastik</strong>.
                </div>
            </div>
        </div>
    </footer>

    </div>
    <!-- Wrapper End -->

    <!-- Vendor JS -->
    <script src="<?= base_url('assets/backend/js/vendor.min.js') ?>"></script>

    <!-- App JS -->
    <script src="<?= base_url('assets/backend/js/app.js') ?>"></script>

    <!-- Plugin: Vector Map -->
    <script src="<?= base_url('assets/backend/vendor/jsvectormap/js/jsvectormap.min.js') ?>"></script>
    <script src="<?= base_url('assets/backend/vendor/jsvectormap/maps/world-merc.js') ?>"></script>
    <script src="<?= base_url('assets/backend/vendor/jsvectormap/maps/world.js') ?>"></script>

    <!-- Dashboard Page JS -->
    <script src="<?= base_url('assets/backend/js/pages/dashboard.js') ?>"></script>

    <!-- iconify-icon -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>


</body>

</html>
