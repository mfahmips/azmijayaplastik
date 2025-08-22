<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>
<h5 class="mb-3"><?= esc($title) ?></h5>
<?php if(session('errors')): ?><div class="alert alert-danger"><?= implode('<br>',(array)session('errors')) ?></div><?php endif; ?>

<form method="post">
  <?= csrf_field() ?>
  <div class="row g-3">
    <div class="col-md-6"><label class="form-label">Nama</label><input name="name" class="form-control" value="<?= old('name',$item['name']??'') ?>" required></div>
    <div class="col-md-3"><label class="form-label">Telepon</label><input name="phone" class="form-control" value="<?= old('phone',$item['phone']??'') ?>"></div>
    <div class="col-md-3">
      <label class="form-label">Tipe</label>
      <select name="customer_type" class="form-select">
        <option value="retail" <?= set_select('customer_type','retail', ($item['customer_type'] ?? 'retail')==='retail') ?>>retail</option>
        <option value="wholesale" <?= set_select('customer_type','wholesale', ($item['customer_type'] ?? '')==='wholesale') ?>>wholesale</option>
      </select>
    </div>
    <div class="col-12"><label class="form-label">Alamat</label><input name="address" class="form-control" value="<?= old('address',$item['address']??'') ?>"></div>
  </div>
  <div class="mt-3">
    <a href="/backend/master/customers" class="btn btn-secondary">Kembali</a>
    <button class="btn btn-primary">Simpan</button>
  </div>
</form>
<?= $this->endSection() ?>
