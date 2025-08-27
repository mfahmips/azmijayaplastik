<?php
$toastMessage = session()->getFlashdata('success') ?? session()->getFlashdata('error') ?? session()->getFlashdata('warning');
$toastType = 'bg-success';

if (session()->getFlashdata('error')) {
    $toastType = 'bg-danger';
} elseif (session()->getFlashdata('warning')) {
    $toastType = 'bg-warning text-dark';
}
?>

<?php if ($toastMessage): ?>
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1080">
  <div id="appToast" class="toast align-items-center text-white <?= $toastType ?> border-0 shadow" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        <?= $toastMessage ?>
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>
<?php endif; ?>


<?php if ($toastMessage): ?>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toastElement = document.getElementById('appToast');
    const toast = new bootstrap.Toast(toastElement, {
      delay: 4000 // 4 detik
    });
    toast.show();
  });
</script>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
