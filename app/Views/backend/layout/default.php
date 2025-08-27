<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    
    <!-- Title -->
    <title><?= esc($title ?? 'Azmi Jaya Plastik') ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">

    <!-- Plugins CSS -->
    <link href="<?= base_url('assets/backend/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/backend/plugins/perfectscroll/perfect-scrollbar.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/backend/plugins/pace/pace.css') ?>" rel="stylesheet">

    <!-- Theme Styles -->
    <link href="<?= base_url('assets/backend/css/main.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/backend/css/darktheme.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/backend/css/custom.css') ?>" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/backend/images/neptune.png') ?>" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/backend/images/neptune.png') ?>" />

    <?= $this->renderSection('styles') ?>
</head>
<body>

  
  <?= $this->include('backend/layout/partials/sidebar') ?>
  <?= $this->include('backend/layout/partials/header') ?>
  
  <?= view('backend/layout/partials/_flash') ?>
  <?= $this->renderSection('content') ?>

    <!-- Javascripts -->
    <script src="<?= base_url('assets/backend/plugins/jquery/jquery-3.5.1.min.js') ?>"></script>
    <script src="<?= base_url('assets/backend/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/backend/plugins/perfectscroll/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?= base_url('assets/backend/plugins/pace/pace.min.js') ?>"></script>
    <script src="<?= base_url('assets/backend/plugins/apexcharts/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('assets/backend/js/main.min.js') ?>"></script>
    <script src="<?= base_url('assets/backend/js/custom.js') ?>"></script>
    <script src="<?= base_url('assets/backend/js/pages/dashboard.js') ?>"></script>

  <?= $this->renderSection('scripts') ?>
</body>
</html>
