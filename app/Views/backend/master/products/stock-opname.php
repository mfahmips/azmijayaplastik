<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>

<div class="page-content">
  <div class="row">
    <div class="col-md-12">

      <!-- Form Input Stok Opname -->
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">Stok Opname</h5>
        </div>
        <div class="card-body">
          <?= view('backend/layout/partials/_flash') ?>

          <form method="post" action="<?= base_url('dashboard/products/simpanStokOpname') ?>">
            <?= csrf_field() ?>
            <div class="table-responsive">
              <table class="table table-bordered text-center align-middle">
                <thead class="table-secondary">
                  <tr>
                    <th>Kode</th>
                    <th>Produk</th>
                    <th>Stok Sistem</th>
                    <th>Stok Fisik</th>
                    <th>Selisih</th>
                    <th>Catatan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($products as $p): ?>
                    <tr>
                      <td><?= esc($p['sku']) ?></td>
                      <td><?= esc($p['name']) ?></td>
                      <td><?= esc($p['stock']) ?></td>
                      <td>
                        <input type="number"
                               name="stock[<?= $p['id'] ?>]"
                               value="<?= $p['stock'] ?>"
                               class="form-control text-center stok-fisik"
                               data-sistem="<?= $p['stock'] ?>">
                      </td>
                      <td class="selisih fw-bold">0</td>
                      <td>
                        <input type="text"
                               name="note[<?= $p['id'] ?>]"
                               class="form-control"
                               placeholder="Catatan (opsional)">
                      </td>
                    </tr>
                  <?php endforeach; ?>

                  <?php if (empty($products)): ?>
                    <tr><td colspan="6" class="text-center text-muted py-4">Belum ada produk</td></tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>

            <div class="text-end mt-3">
              <button class="btn btn-primary">
                <i class="bx bx-save"></i> Simpan Hasil
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Riwayat Stok Opname -->
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Riwayat Stok Opname</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
              <thead class="table-secondary">
                <tr>
                  <th>Produk</th>
                  <th>Stok Sistem</th>
                  <th>Stok Fisik</th>
                  <th>Selisih</th>
                  <th>Catatan</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach (($opnames ?? []) as $o): ?>
                  <tr>
                    <td><?= esc($o['sku'].' - '.$o['name']) ?></td>
                    <td><?= esc($o['stock_system']) ?></td>
                    <td><?= esc($o['stock_real']) ?></td>
                    <td style="color: <?= $o['difference'] == 0 ? 'black' : ($o['difference'] > 0 ? 'green' : 'red') ?>">
                      <?= esc($o['difference']) ?>
                    </td>
                    <td><?= esc($o['note']) ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($o['created_at'])) ?></td>
                    <td>
                      <!-- Tombol Edit (Modal) -->
                      <button class="btn btn-sm btn-primary"
                              data-bs-toggle="modal"
                              data-bs-target="#editOpname<?= $o['id'] ?>">
                        Edit
                      </button>

                      <!-- Tombol Hapus -->
                      <a href="<?= base_url('dashboard/products/delete-opname/'.$o['id']) ?>"
                         onclick="return confirm('Yakin hapus data ini?')"
                         class="btn btn-sm btn-danger">Hapus</a>
                    </td>
                  </tr>

                  <!-- Modal Edit Opname -->
                  <div class="modal fade" id="editOpname<?= $o['id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                      <form class="modal-content" method="post" action="<?= base_url('dashboard/products/update-opname/'.$o['id']) ?>">
                        <?= csrf_field() ?>
                        <div class="modal-header">
                          <h5 class="modal-title">Edit Stok Opname</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                          <div class="mb-3">
                            <label class="form-label">Produk</label>
                            <input type="text" class="form-control" value="<?= esc($o['sku'].' - '.$o['name']) ?>" readonly>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Stok Sistem</label>
                            <input type="text" class="form-control" value="<?= esc($o['stock_system']) ?>" readonly>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Stok Fisik</label>
                            <input type="number" name="stock_real" class="form-control" value="<?= esc($o['stock_real']) ?>" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Catatan</label>
                            <textarea name="note" class="form-control"><?= esc($o['note']) ?></textarea>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                <?php endforeach; ?>

                <?php if (empty($opnames)): ?>
                  <tr><td colspan="7" class="text-center text-muted py-4">Belum ada riwayat opname</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <div class="d-flex justify-content-center mt-3">
            <?= $pager->links('opname', 'bootstrap') ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
document.querySelectorAll('.stok-fisik').forEach(input => {
  function updateSelisih(el) {
    let sistem = parseInt(el.dataset.sistem);
    let fisik  = parseInt(el.value) || 0;
    let diff   = fisik - sistem;
    let cell   = el.closest('tr').querySelector('.selisih');
    cell.innerText = diff;
    cell.style.color = diff === 0 ? 'black' : (diff > 0 ? 'green' : 'red');
  }
  updateSelisih(input);
  input.addEventListener('input', function() { updateSelisih(this); });
});
</script>

<?= $this->endSection() ?>
