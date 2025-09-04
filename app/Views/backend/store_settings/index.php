<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>

<!-- start page content-->
<div class="page-content">

  <!--start breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Pengaturan</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0 align-items-center">
          <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>"><ion-icon name="home-outline"></ion-icon></a></li>
          <li class="breadcrumb-item active" aria-current="page">Pengaturan Toko</li>
        </ol>
      </nav>
    </div>
  </div>
  <!--end breadcrumb-->

  <div class="row">
    <div class="col-lg-8 mx-auto">
      <div class="card radius-10">
        <div class="card-body">

          <!-- Session Flash Message -->
          <?php if (session()->getFlashdata('success')): ?>
            <script>
              document.addEventListener("DOMContentLoaded", function () {
                Lobibox.notify('success', {
                  msg: "<?= session()->getFlashdata('success') ?>"
                });
              });
            </script>
          <?php elseif (session()->getFlashdata('error')): ?>
            <script>
              document.addEventListener("DOMContentLoaded", function () {
                Lobibox.notify('error', {
                  msg: "<?= session()->getFlashdata('error') ?>"
                });
              });
            </script>
          <?php endif; ?>


          <form action="<?= site_url('dashboard/store-setting/update') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= $store['id'] ?>">

            <h5 class="mb-3">Informasi Toko</h5>
            <div class="mb-4 d-flex flex-column gap-3 align-items-center justify-content-center">
              <div class="user-change-photo shadow">
                <img src="<?= base_url($store['store_logo'] ?? 'assets/images/default-logo.png') ?>" alt="Logo">
              </div>
              <div>
                <label for="store_logo" class="form-label">Ubah Logo</label>
                <input type="file" class="form-control" name="store_logo" id="store_logo">
              </div>
            </div>

            <h5 class="mb-0 mt-4">Detail Toko</h5>
            <hr>
            <div class="row g-3">
              <div class="col-6">
                <label class="form-label">Nama Toko</label>
                <input type="text" class="form-control" name="store_name" value="<?= esc($store['store_name']) ?>">
              </div>
              <div class="col-6">
                <label class="form-label">Pemilik Toko</label>
                <input type="text" class="form-control" name="store_owner" value="<?= esc($store['store_owner']) ?>">
              </div>
              <div class="col-6">
                <label class="form-label">Kategori Toko</label>
                <input type="text" class="form-control" name="store_category" value="<?= esc($store['store_category']) ?>">
              </div>
              <div class="col-6">
                <label class="form-label">No. Telepon</label>
                <input type="text" class="form-control" name="store_phone" value="<?= esc($store['store_phone']) ?>">
              </div>
              <div class="col-12">
                <label class="form-label">Alamat</label>
                <input type="text" class="form-control" name="store_address" value="<?= esc($store['store_address']) ?>">
              </div>
              <div class="col-12">
                <label class="form-label">Deskripsi Toko</label>
                <textarea class="form-control" name="store_description" rows="4" placeholder="Ceritakan tentang toko Anda..."><?= esc($store['store_description']) ?></textarea>
              </div>
            </div>

            <h5 class="mb-0 mt-4">Media Sosial</h5>
            <hr>
            <div class="row g-3">
              <div class="col-6">
                <label class="form-label">Facebook</label>
                <input type="text" class="form-control" name="store_facebook" value="<?= esc($store['store_facebook']) ?>">
              </div>
              <div class="col-6">
                <label class="form-label">Instagram</label>
                <input type="text" class="form-control" name="store_instagram" value="<?= esc($store['store_instagram']) ?>">
              </div>
              <div class="col-6">
                <label class="form-label">TikTok</label>
                <input type="text" class="form-control" name="store_tiktok" value="<?= esc($store['store_tiktok']) ?>">
              </div>
              <div class="col-6">
                <label class="form-label">Website</label>
                <input type="text" class="form-control" name="store_website" value="<?= esc($store['store_website']) ?>">
              </div>
            </div>

            <div class="text-start mt-4">
              <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div><!--end row-->

</div>
<!-- end page content-->
</div>

<!-- Include SweetAlert2 if not yet -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $this->endSection() ?>
