<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h5 class="mb-0">Produk & Relasi • Produk</h5>
  <a href="/backend/master/products/create" class="btn btn-primary btn-sm">+ Tambah</a>
</div>

<form class="row g-2 mb-3">
  <div class="col-sm-5"><input name="q" value="<?= esc($q) ?>" class="form-control" placeholder="Cari nama / SKU"></div>
  <div class="col-sm-4">
    <select name="category_id" class="form-select">
      <option value="">— Semua Kategori —</option>
      <?php foreach($categories as $c): ?>
        <option value="<?= $c['id'] ?>" <?= $category_id==$c['id']?'selected':'' ?>><?= esc($c['name']) ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="col-sm-3"><button class="btn btn-outline-secondary w-100">Filter</button></div>
</form>

<?php if(session('errors')): ?><div class="alert alert-danger"><?= implode('<br>',(array)session('errors')) ?></div><?php endif; ?>
<?php if(session('msg')): ?><div class="alert alert-success"><?= esc(session('msg')) ?></div><?php endif; ?>

<div class="table-responsive">
<table class="table table-sm table-hover align-middle">
  <thead class="table-dark"><tr>
    <th>#</th><th>SKU</th><th>Nama</th><th>Kategori</th><th>Base</th><th>Harga</th><th>Stok</th><th class="text-end">Aksi</th>
  </tr></thead>
  <tbody>
  <?php $no = 1 + (max(1,(int)($_GET['page']??1))-1)*15; foreach($rows as $r): ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><code><?= esc($r['sku']) ?></code></td>
      <td><?= esc($r['name']) ?> <?= !$r['is_active']?'<span class="badge bg-secondary">nonaktif</span>':'' ?></td>
      <td><?= esc($r['category_name'] ?? '-') ?></td>
      <td><?= esc($r['base_short'] ?? '-') ?></td>
      <td>Rp <?= number_format($r['price_retail'] ?? 0,0,',','.') ?></td>
      <td><?= (float)$r['stock_qty'] ?></td>
      <td class="text-end">
        <a class="btn btn-sm btn-outline-primary" href="/backend/master/products/<?= $r['id'] ?>/edit">Edit</a>
        <form class="d-inline" method="post" action="/backend/master/products/<?= $r['id'] ?>/delete" onsubmit="return confirm('Hapus produk ini?')">
          <?= csrf_field() ?><button class="btn btn-sm btn-outline-danger">Hapus</button>
        </form>
      </td>
    </tr>
  <?php endforeach; if(empty($rows)): ?>
    <tr><td colspan="8" class="text-center text-muted py-4">Belum ada data</td></tr>
  <?php endif; ?>
  </tbody>
</table>
</div>
<?= $pager->links() ?>
<?= $this->endSection() ?>
