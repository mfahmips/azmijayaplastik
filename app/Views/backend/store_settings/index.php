<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>

<div class="page-content">
  <div class="card">
    <div class="card-body">
      <form action="<?= base_url('dashboard/store-setting/update') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= esc($store['id']) ?>">

        <div id="stepper3" class="bs-stepper gap-4 vertical">
          <div class="bs-stepper-header" role="tablist">

            <!-- Step 1 -->
            <div class="step" data-target="#step-1">
              <div class="step-trigger" role="tab" id="stepper3trigger1" aria-controls="step-1">
                <div class="bs-stepper-circle"><i class='bx bx-store fs-4'></i></div>
                <div>
                  <h5 class="mb-0 steper-title">Informasi Toko</h5>
                  <p class="mb-0 steper-sub-title">Detail utama toko</p>
                </div>
              </div>
            </div>

            <!-- Step 2 -->
            <div class="step" data-target="#step-2">
              <div class="step-trigger" role="tab" id="stepper3trigger2" aria-controls="step-2">
                <div class="bs-stepper-circle"><i class='bx bx-image fs-4'></i></div>
                <div>
                  <h5 class="mb-0 steper-title">Media & Logo</h5>
                  <p class="mb-0 steper-sub-title">Identitas toko</p>
                </div>
              </div>
            </div>

            <!-- Step 3 -->
            <div class="step" data-target="#step-3">
              <div class="step-trigger" role="tab" id="stepper3trigger3" aria-controls="step-3">
                <div class="bs-stepper-circle"><i class='bx bx-phone fs-4'></i></div>
                <div>
                  <h5 class="mb-0 steper-title">Kontak</h5>
                  <p class="mb-0 steper-sub-title">Nomor & Website</p>
                </div>
              </div>
            </div>

            <!-- Step 4 -->
            <div class="step" data-target="#step-4">
              <div class="step-trigger" role="tab" id="stepper3trigger4" aria-controls="step-4">
                <div class="bs-stepper-circle"><i class='bx bxl-facebook fs-4'></i></div>
                <div>
                  <h5 class="mb-0 steper-title">Sosial Media</h5>
                  <p class="mb-0 steper-sub-title">Link sosial media</p>
                </div>
              </div>
            </div>

          </div>

          <!-- Step Content -->
          <div class="bs-stepper-content">

            <!-- Step 1 -->
            <div id="step-1" class="bs-stepper-pane fade" role="tabpanel" aria-labelledby="stepper3trigger1">
              <h5 class="mb-3">Informasi Toko</h5>
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Nama Toko</label>
                  <input type="text" name="store_name" class="form-control" value="<?= esc($store['store_name']) ?>" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Pemilik</label>
                  <input type="text" name="store_owner" class="form-control" value="<?= esc($store['store_owner']) ?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Kategori Usaha</label>
                  <input type="text" name="store_category" class="form-control" value="<?= esc($store['store_category']) ?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Alamat</label>
                  <textarea name="store_address" class="form-control"><?= esc($store['store_address']) ?></textarea>
                </div>
              </div>
              <div class="mt-4 d-flex justify-content-end">
                <button type="button" class="btn btn-primary px-4" onclick="stepper3.next()">Next →</button>
              </div>
            </div>

            <!-- Step 2 -->
            <div id="step-2" class="bs-stepper-pane fade" role="tabpanel" aria-labelledby="stepper3trigger2">
              <h5 class="mb-3">Media & Logo</h5>
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Logo Toko</label>
                  <input type="file" name="store_logo" class="form-control">
                  <?php if (!empty($store['store_logo'])): ?>
                    <div class="mt-2">
                      <img src="<?= base_url($store['store_logo']) ?>" alt="Logo" height="60">
                    </div>
                  <?php endif; ?>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Deskripsi</label>
                  <textarea name="store_description" class="form-control"><?= esc($store['store_description']) ?></textarea>
                </div>
              </div>
              <div class="mt-4 d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary" onclick="stepper3.previous()">← Previous</button>
                <button type="button" class="btn btn-primary" onclick="stepper3.next()">Next →</button>
              </div>
            </div>

            <!-- Step 3 -->
            <div id="step-3" class="bs-stepper-pane fade" role="tabpanel" aria-labelledby="stepper3trigger3">
              <h5 class="mb-3">Kontak</h5>
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">No. Telepon</label>
                  <input type="text" name="store_phone" class="form-control" value="<?= esc($store['store_phone']) ?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Website</label>
                  <input type="text" name="store_website" class="form-control" value="<?= esc($store['store_website']) ?>">
                </div>
              </div>
              <div class="mt-4 d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary" onclick="stepper3.previous()">← Previous</button>
                <button type="button" class="btn btn-primary" onclick="stepper3.next()">Next →</button>
              </div>
            </div>

            <!-- Step 4 -->
            <div id="step-4" class="bs-stepper-pane fade" role="tabpanel" aria-labelledby="stepper3trigger4">
              <h5 class="mb-3">Sosial Media</h5>
              <div class="row g-3">
                <div class="col-md-4">
                  <label class="form-label">Facebook</label>
                  <input type="text" name="store_facebook" class="form-control" value="<?= esc($store['store_facebook']) ?>">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Instagram</label>
                  <input type="text" name="store_instagram" class="form-control" value="<?= esc($store['store_instagram']) ?>">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Tiktok</label>
                  <input type="text" name="store_tiktok" class="form-control" value="<?= esc($store['store_tiktok']) ?>">
                </div>
              </div>
              <div class="mt-4 d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary" onclick="stepper3.previous()">← Previous</button>
                <button type="submit" class="btn btn-success">Simpan</button>
              </div>
            </div>

          </div>
        </div>

      </form>
    </div>
  </div>
</div>

<!-- bs-stepper JS -->
<script src="<?= base_url('assets/backend/plugins/bs-stepper/js/bs-stepper.min.js') ?>"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper3 = new Stepper(document.querySelector('#stepper3'), {
      linear: false,
      animation: true
    });
  });
</script>

<?= $this->endSection() ?>
