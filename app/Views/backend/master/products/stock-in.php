<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>

<div class="page-content">

  <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>
  <?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
  <?php endif; ?>

  <!-- Card Riwayat Barang Masuk -->
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Riwayat Barang Masuk</h5>
      <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddStockIn">
        + Tambah Barang Masuk
      </button>
    </div>
    <div class="card-body">

      <div class="accordion" id="accordionStockIn">
        <?php if (!empty($stock_group)): ?>
          <?php $i=0; foreach ($stock_group as $date => $rows): $i++; ?>
            <div class="accordion-item">
              <h2 class="accordion-header" id="heading<?= $i ?>">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse<?= $i ?>"
                        aria-expanded="false" aria-controls="collapse<?= $i ?>">
                  <?= strftime('%A, %d %b %Y', strtotime($date)) ?>
                  <span class="badge bg-info ms-2"><?= count($rows) ?> Produk Masuk</span>
                  
                </button>
              </h2>
              <div id="collapse<?= $i ?>" class="accordion-collapse collapse"
                   aria-labelledby="heading<?= $i ?>" data-bs-parent="#accordionStockIn">
                <div class="accordion-body">
                  <div class="table-responsive">
                    <table class="table align-middle">
                      <thead class="table-secondary">
                        <tr>
                          <th>Produk</th>
                          <th>Supplier</th>
                          <th>Qty</th>
                          <th>Harga Beli</th>
                          <th>Total</th>
                          <th>Catatan</th>
                          <th>Waktu</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($rows as $row): ?>
                          <tr>
                            <td><?= esc($row['product_name']) ?></td>
                            <td><?= esc($row['supplier_name'] ?? '-') ?></td>
                            <td><?= (int)$row['qty'] ?></td>
                            <td>Rp <?= number_format((int)$row['cost_price'], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format((int)($row['cost_price'] * $row['qty']), 0, ',', '.') ?></td>
                            <td><?= esc($row['note']) ?></td>
                            <td><?= date('H:i', strtotime($row['created_at'])) ?></td>
                            <td>
                              <button class="btn btn-sm btn-warning"
                                      data-bs-toggle="modal"
                                      data-bs-target="#modalEditStockIn<?= $row['id'] ?>">
                                Edit
                              </button>
                              <button class="btn btn-sm btn-danger"
                                      data-bs-toggle="modal"
                                      data-bs-target="#modalDeleteStockIn<?= $row['id'] ?>">
                                Hapus
                              </button>
                            </td>
                          </tr>

                          <!-- Modal Edit -->
                          <div class="modal fade" id="modalEditStockIn<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                              <form method="post" action="<?= base_url('dashboard/products/stock-in/update/' . $row['id']) ?>">
                                <?= csrf_field() ?>
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Edit Barang Masuk</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                  </div>
                                  <div class="modal-body row g-3">
                                    <div class="col-md-6">
                                      <label class="form-label">Produk</label>
                                      <select name="product_id" class="form-control">
                                        <?php foreach($products as $p): ?>
                                          <option value="<?= $p['id'] ?>" <?= $row['product_id']==$p['id']?'selected':'' ?>>
                                            <?= esc($p['name']) ?>
                                          </option>
                                        <?php endforeach; ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <label class="form-label">Supplier</label>
                                      <select name="supplier_id" class="form-control">
                                        <option value="">-- Pilih Supplier --</option>
                                        <?php foreach($suppliers as $s): ?>
                                          <option value="<?= $s['id'] ?>" <?= $row['supplier_id']==$s['id']?'selected':'' ?>>
                                            <?= esc($s['name']) ?>
                                          </option>
                                        <?php endforeach; ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <label class="form-label">Qty</label>
                                      <input type="number" name="qty" value="<?= (int)$row['qty'] ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                      <label class="form-label">Harga Beli</label>
                                      <input type="number" name="cost_price" value="<?= (int)$row['cost_price'] ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-12">
                                      <label class="form-label">Catatan</label>
                                      <input type="text" name="note" value="<?= esc($row['note']) ?>" class="form-control">
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>

                          <!-- Modal Delete -->
                          <div class="modal fade" id="modalDeleteStockIn<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                              <form method="post" action="<?= base_url('dashboard/products/stock-in/delete/' . $row['id']) ?>">
                                <?= csrf_field() ?>
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Hapus Barang Masuk</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                  </div>
                                  <div class="modal-body">
                                    Apakah yakin ingin menghapus <b><?= esc($row['product_name']) ?></b> (Qty: <?= (int)$row['qty'] ?>)?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>

                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="text-muted">Belum ada data barang masuk.</p>
        <?php endif; ?>
      </div>

    </div>
  </div>
</div>

<!-- Modal Tambah Barang Masuk -->
<div class="modal fade" id="modalAddStockIn" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="<?= base_url('dashboard/products/stock-in/save') ?>">
      <?= csrf_field() ?>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Barang Masuk</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body row g-3">
          <div class="col-md-6">
            <label class="form-label">Produk</label>
            <select name="product_id" class="form-control">
              <option value="">-- Pilih Produk --</option>
              <?php foreach($products as $p): ?>
                <option value="<?= $p['id'] ?>"><?= esc($p['name']) ?> (Stok: <?= (int)$p['stock'] ?>)</option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Produk Baru (Ops)</label>
            <input type="text" name="new_product" class="form-control" placeholder="Isi jika produk belum ada">
          </div>
          <div class="col-md-6">
            <label class="form-label">Supplier</label>
            <select name="supplier_id" class="form-control">
              <option value="">-- Pilih Supplier --</option>
              <?php foreach($suppliers as $s): ?>
                <option value="<?= $s['id'] ?>"><?= esc($s['name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Qty</label>
            <input type="number" name="qty" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Harga Beli</label>
            <input type="number" name="cost_price" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Catatan</label>
            <input type="text" name="note" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>
