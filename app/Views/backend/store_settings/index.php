<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
  <div class="page-title-box">
    <h4 class="mb-0"><?= esc($title ?? 'Pengaturan Toko') ?></h4>
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
      <li class="breadcrumb-item active">Pengaturan Toko</li>
    </ol>
  </div>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>

  <div class="row">
    <!-- Navigasi Tab -->
    <div class="col-md-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="nav flex-column nav-pills" id="store-setting-tab" role="tablist">
            <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#tab-info">Info Toko</button>
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-location">Lokasi</button>
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-logo">Logo & Invoice</button>
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-preference">Preferensi Kasir</button>
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-tax">Pajak & Keuangan</button>
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-stock">Metode Stok</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Konten Tab -->
    <div class="col-md-9">
      <div class="card">
        <div class="card-body">
          <form action="<?= base_url('dashboard/store-setting/update') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= $setting['id'] ?? '' ?>">

            <div class="tab-content">

              <!-- TAB: Info Toko -->
              <div class="tab-pane fade show active" id="tab-info">
                <div class="mb-3 row align-items-center">
                  <label class="col-md-3 col-form-label text-end fw-semibold">Nama Toko</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="store_name" value="<?= esc($setting['store_name'] ?? '') ?>">
                  </div>
                </div>
                <div class="mb-3 row align-items-center">
                  <label class="col-md-3 col-form-label text-end fw-semibold">Pemilik Toko</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="store_owner" value="<?= esc($setting['store_owner'] ?? '') ?>">
                  </div>
                </div>
                <div class="mb-3 row align-items-center">
                  <label class="col-md-3 col-form-label text-end fw-semibold">Alamat</label>
                  <div class="col-md-9">
                    <textarea class="form-control" name="store_address" rows="3"><?= esc($setting['store_address'] ?? '') ?></textarea>
                  </div>
                </div>
              </div>

              <!-- TAB: Lokasi -->
              <div class="tab-pane fade" id="tab-location">
                <div class="mb-3 row align-items-center">
                  <label class="col-md-3 col-form-label text-end">Latitude</label>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="store_lat" value="<?= esc($setting['store_lat'] ?? '') ?>">
                  </div>
                  <label class="col-md-3 col-form-label text-end">Longitude</label>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="store_lng" value="<?= esc($setting['store_lng'] ?? '') ?>">
                  </div>
                </div>
                <div class="mb-3 row align-items-center">
                  <label class="col-md-3 col-form-label text-end">Negara</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="store_country" value="<?= esc($setting['store_country'] ?? '') ?>">
                  </div>
                </div>
                <div class="mb-3 row align-items-center">
                  <label class="col-md-3 col-form-label text-end">Provinsi</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="store_province" value="<?= esc($setting['store_province'] ?? '') ?>">
                  </div>
                </div>
                <div class="mb-3 row align-items-center">
                  <label class="col-md-3 col-form-label text-end">Kota/Kabupaten</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="store_city" value="<?= esc($setting['store_city'] ?? '') ?>">
                  </div>
                </div>
                <div class="mb-3 row align-items-center">
                  <label class="col-md-3 col-form-label text-end">No. Telepon</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="store_phone" value="<?= esc($setting['store_phone'] ?? '') ?>">
                  </div>
                </div>
              </div>

              <!-- TAB: Logo -->
              <div class="tab-pane fade" id="tab-logo">
                <div class="mb-3 row align-items-center">
                  <label class="col-md-3 col-form-label text-end">Logo</label>
                  <div class="col-md-9">
                    <img src="<?= base_url('uploads/logo.png') ?>" alt="Logo" class="img-thumbnail mb-2" style="max-height: 100px; background-color:#fff;">
                    <input type="file" class="form-control" name="logo" accept="image/*">
                  </div>
                </div>
              </div>

              <!-- TAB: Preferensi -->
              <div class="tab-pane fade" id="tab-preference">
                <div class="mb-3 row align-items-center">
                  <label class="col-md-3 col-form-label text-end">Bidang Usaha</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="store_business_type" value="<?= esc($setting['store_business_type'] ?? '') ?>">
                  </div>
                </div>
                <div class="mb-3 row align-items-center">
                  <label class="col-md-3 col-form-label text-end">Moto</label>
                  <div class="col-md-9">
                    <textarea class="form-control" name="store_moto" rows="2"><?= esc($setting['store_moto'] ?? '') ?></textarea>
                  </div>
                </div>
              </div>

              <!-- TAB: Pajak -->
              <div class="tab-pane fade" id="tab-tax">
                <div class="mb-3 row align-items-center">
                  <label class="col-md-3 col-form-label text-end">PPN (%)</label>
                  <div class="col-md-3">
                    <input type="number" class="form-control" name="store_ppn" value="<?= esc($setting['store_ppn'] ?? 0) ?>">
                  </div>
                  <label class="col-md-3 col-form-label text-end">Mata Uang</label>
                  <div class="col-md-3">
                    <input type="text" class="form-control" name="store_currency" value="<?= esc($setting['store_currency'] ?? '') ?>">
                  </div>
                </div>
              </div>

              <!-- TAB: Metode Stok -->
              <div class="tab-pane fade" id="tab-stock">
                <div class="mb-3 row align-items-center">
                  <label class="col-md-3 col-form-label text-end">Metode Stok</label>
                  <div class="col-md-9">
                    <select class="form-select" name="store_stock_method">
                      <option value="FIFO" <?= ($setting['store_stock_method'] ?? '') == 'FIFO' ? 'selected' : '' ?>>FIFO</option>
                      <option value="LIFO" <?= ($setting['store_stock_method'] ?? '') == 'LIFO' ? 'selected' : '' ?>>LIFO</option>
                      <option value="Average" <?= ($setting['store_stock_method'] ?? '') == 'Average' ? 'selected' : '' ?>>Average</option>
                    </select>
                  </div>
                </div>
              </div>

            </div>

            <!-- Tombol Simpan -->
            <div class="mt-4 text-end">
              <button type="submit" class="btn btn-success">
                💾 Simpan Pengaturan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
