<!doctype html>
<html lang="en" class="dark-theme">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php
  $storeModel = new \App\Models\StoreSettingModel();
  $store = $storeModel->first();
  ?>
  <link rel="icon" type="image/png" href="<?= base_url($store['store_logo'] ?? 'assets/images/default-favicon.png') ?>">



  <!-- Title -->
  <title><?= esc($title ?? 'Dashboard') ?></title>

  <!-- Loader -->
  <link href="<?= base_url('assets/backend/css/pace.min.css') ?>" rel="stylesheet" />
  <script src="<?= base_url('assets/backend/js/pace.min.js') ?>"></script>

  <!-- Plugins -->
  <link href="<?= base_url('assets/backend/plugins/simplebar/css/simplebar.css') ?>" rel="stylesheet" />
  <link href="<?= base_url('assets/backend/plugins/perfect-scrollbar/css/perfect-scrollbar.css') ?>" rel="stylesheet" />
  <link href="<?= base_url('assets/backend/plugins/metismenu/css/metisMenu.min.css') ?>" rel="stylesheet" />
  <link rel="stylesheet" href="<?= base_url('assets/backend/plugins/apexcharts-bundle/css/apexcharts.css') ?>">


  <!-- Core CSS -->
  <link href="<?= base_url('assets/backend/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/backend/css/bootstrap-extended.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/backend/css/style.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/backend/css/icons.css') ?>" rel="stylesheet">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

  <!-- Theme Styles -->
  <link href="<?= base_url('assets/backend/css/dark-theme.css') ?>" rel="stylesheet" />
  <link href="<?= base_url('assets/backend/css/semi-dark.css') ?>" rel="stylesheet" />
  <link href="<?= base_url('assets/backend/css/header-colors.css') ?>" rel="stylesheet" />

  <!-- jQuery UI CSS -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">


</head>

<body>

  <!-- Overlay -->
  <div class="overlay nav-toggle-icon"></div>

  <!-- Header -->
  <?= $this->include('backend/layout/partials/header') ?>

  <!-- Sidebar -->
  <?= $this->include('backend/layout/partials/sidebar') ?>


<!-- start page content wrapper-->
    <div class="page-content-wrapper">
    <?= $this->renderSection('content') ?>


     <!--Start Back To Top Button-->
     <a href="javaScript:;" class="back-to-top"><ion-icon name="arrow-up-outline"></ion-icon></a>
     <!--End Back To Top Button-->

  <!-- JS Scripts -->
  <script src="<?= base_url('assets/backend/js/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/backend/plugins/simplebar/js/simplebar.min.js') ?>"></script>
  <script src="<?= base_url('assets/backend/plugins/metismenu/js/metisMenu.min.js') ?>"></script>
  <script src="<?= base_url('assets/backend/js/bootstrap.bundle.min.js') ?>"></script>

  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

  <!-- Plugins -->
  <script src="<?= base_url('assets/backend/plugins/perfect-scrollbar/js/perfect-scrollbar.js') ?>"></script>
  <script src="<?= base_url('assets/backend/plugins/apexcharts-bundle/js/apexcharts.min.js') ?>"></script>
  <script src="<?= base_url('assets/backend/plugins/easyPieChart/jquery.easypiechart.js') ?>"></script>
  <script src="<?= base_url('assets/backend/plugins/chartjs/chart.min.js') ?>"></script>
  <script src="<?= base_url('assets/backend/js/index.js') ?>"></script>
  <!-- Notifikasi (Lobibox) -->
  <script src="<?= base_url('assets/backend/plugins/notifications/js/lobibox.min.js') ?>"></script>
  <script src="<?= base_url('assets/backend/plugins/notifications/js/notifications.min.js') ?>"></script>
  <script src="<?= base_url('assets/backend/plugins/notifications/js/notification-custom-script.js') ?>"></script>

  
  <script src="<?= base_url('assets/backend/js/widgets.js') ?>"></script>
  <script src="<?= base_url('assets/backend/plugins/apexcharts-bundle/js/apexcharts.min.js') ?>"></script>

<!-- jQuery UI JS -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <!-- Main -->
  <script src="<?= base_url('assets/backend/js/main.js') ?>"></script>

</body>
</html>
