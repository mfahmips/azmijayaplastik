<?= $this->extend('backend/layout/default') ?>

<?= $this->section('content') ?>
<div class="app-content">
  <div class="content-wrapper">
    <div class="container">
      <div class="row align-items-center mb-3">
        <div class="col">
          <div class="page-description">
            <h1>Kasir</h1>
            <p class="text-muted mb-0">Point of Sale – cepatkan transaksi di toko.</p>
          </div>
        </div>
      </div>

      <div class="row g-3">
        <!-- Kolom kiri: cari produk -->
        <div class="col-lg-7">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <div class="flex-grow-1 me-2">
                <div class="input-group">
                  <span class="input-group-text"><i class="material-icons-outlined">search</i></span>
                  <input type="text" class="form-control" placeholder="Cari Produk" id="input-cari">
                </div>
              </div>
              <button class="btn btn-outline-primary" onclick="bukaModalTambahProduk()">
                <i class="material-icons-outlined">add</i> Tambah Produk
              </button>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table mb-0 align-middle">
                  <thead class="table-light">
                    <tr>
                      <th>Produk</th><th class="text-end">Harga</th><th class="text-center">Stok</th><th class="text-end">Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="produk-list">
                    <tr><td colspan="4" class="text-center text-muted py-4">Muat data produk…</td></tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Kolom kanan: keranjang -->
        <div class="col-lg-5">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Keranjang</h5>
              <button class="btn btn-sm btn-outline-danger" id="btn-clear-cart">
                <i class="material-icons-outlined">delete_sweep</i> Kosongkan
              </button>
            </div>
            <div class="card-body p-0">
              <ul class="list-group list-group-flush" id="cart-list">
                <li class="list-group-item text-muted">Belum ada item.</li>
              </ul>
            </div>
            <div class="card-footer">
              <div class="d-flex justify-content-between">
                <span class="fw-semibold">Total</span>
                <span class="fw-bold" id="cart-total">Rp 0</span>
              </div>
              <div class="mt-3 d-grid">
                <button class="btn btn-primary" id="btn-bayar">
                  <i class="material-icons-outlined me-1">point_of_sale</i> Bayar
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<<!-- Modal Tambah Produk -->
<div class="modal fade" id="modal-tambah-produk" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" id="form-tambah-produk">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Produk Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="newName" class="form-label">Nama Produk</label>
          <input type="text" class="form-control" name="name" id="newName" required>
        </div>
        <div class="mb-2">
          <label for="newSellPrice" class="form-label">Harga Jual</label>
          <input type="number" class="form-control" name="sell_price" id="newSellPrice" min="0" step="1" placeholder="0">
          <small class="text-muted">Biarkan 0 jika belum ada harga.</small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
let produkList = [];
let cart = [];

function loadProduk(keyword = '') {
  $('#produk-list').html('<tr><td colspan="4" class="text-center text-muted py-4">Memuat...</td></tr>');

  $.get('<?= base_url('dashboard/kasir/cariProduk') ?>', { q: keyword }, function(res) {
    produkList = res;
    if (!res.length) {
      $('#produk-list').html(`<tr><td colspan="4" class="text-center text-muted py-3">Tidak ditemukan.</td></tr>`);
      return;
    }

    let html = '';
    res.forEach(prod => {
      html += `
        <tr>
          <td>${prod.name}</td>
          <td class="text-end">Rp ${parseInt(prod.sell_price || 0).toLocaleString()}</td>
          <td class="text-center">${prod.stock || 0}</td>
          <td class="text-end">
            <button class="btn btn-sm btn-success" onclick="tambahKeKeranjang(${prod.id})">
              <i class="material-icons-outlined">add_shopping_cart</i>
            </button>
          </td>
        </tr>`;
    });
    $('#produk-list').html(html);
  });
}

function tambahKeKeranjang(id) {
  const produk = produkList.find(p => p.id == id);
  if (!produk) return;

  const exist = cart.find(item => item.id == id);
  if (exist) {
    exist.qty += 1;
    exist.subtotal = exist.qty * exist.price;
  } else {
    cart.push({
      id: produk.id,
      name: produk.name,
      price: parseInt(produk.sell_price || 0),
      qty: 1,
      subtotal: parseInt(produk.sell_price || 0)
    });
  }
  renderCart();
}

function tambahKeKeranjangSetelahTambah(produk) {
  cart.push({
    id: produk.id,
    name: produk.name,
    price: 0,
    qty: 1,
    subtotal: 0
  });
  renderCart();
}

function renderCart() {
  if (!cart.length) {
    $('#cart-list').html('<li class="list-group-item text-muted">Belum ada item.</li>');
    $('#cart-total').text('Rp 0');
    return;
  }

  let html = '';
  let total = 0;

  cart.forEach((item, i) => {
    total += item.subtotal;
    html += `
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="me-auto">
          <div class="fw-bold">${item.name}</div>
          <small>${item.qty} x Rp ${item.price.toLocaleString()} = Rp ${item.subtotal.toLocaleString()}</small>
        </div>
        <div class="btn-group btn-group-sm">
          <button class="btn btn-outline-secondary" onclick="ubahQty(${i}, -1)">-</button>
          <button class="btn btn-outline-secondary" onclick="ubahQty(${i}, 1)">+</button>
          <button class="btn btn-outline-danger" onclick="hapusItem(${i})">&times;</button>
        </div>
      </li>`;
  });

  $('#cart-list').html(html);
  $('#cart-total').text('Rp ' + total.toLocaleString());
}

function ubahQty(index, delta) {
  cart[index].qty += delta;
  if (cart[index].qty <= 0) {
    cart.splice(index, 1);
  } else {
    cart[index].subtotal = cart[index].qty * cart[index].price;
  }
  renderCart();
}

function hapusItem(index) {
  cart.splice(index, 1);
  renderCart();
}

function bukaModalTambahProduk() {
  $('#form-tambah-produk')[0].reset();
  $('#modal-tambah-produk').modal('show');
}

$('#form-tambah-produk').on('submit', function(e) {
  e.preventDefault();

  const name = $('#newName').val().trim();
  const sellPrice = parseInt($('#newSellPrice').val() || 0, 10);

  if (!name) {
    alert('Nama produk wajib diisi.');
    return;
  }

  const payload = { name: name, sell_price: sellPrice };

  $.post('<?= base_url('dashboard/kasir/tambahProdukBaru') ?>', payload, function(res) {
    if (res.status === 'ok') {
      $('#modal-tambah-produk').modal('hide');
      const p = res.produk;
      cart.push({
        id: p.id,
        name: p.name,
        price: parseInt(p.sell_price || 0, 10),
        qty: 1,
        subtotal: parseInt(p.sell_price || 0, 10)
      });
      renderCart();
    } else {
      alert(res.message || 'Gagal menyimpan produk.');
    }
  });
});


$('#input-cari').on('keyup', function() {
  loadProduk(this.value);
});

$('#btn-clear-cart').on('click', function() {
  if (confirm('Kosongkan keranjang?')) {
    cart = [];
    renderCart();
  }
});

$('#btn-bayar').on('click', function () {
  if (!cart.length) {
    alert('Keranjang masih kosong.');
    return;
  }

  const total = cart.reduce((sum, item) => sum + item.subtotal, 0);
  const payment = prompt('Masukkan jumlah pembayaran:', total);

  if (!payment || isNaN(payment) || parseInt(payment) < total) {
    alert('Pembayaran tidak valid atau kurang.');
    return;
  }

  const payload = {
    items: cart,
    total_price: total,
    payment: parseInt(payment)
  };

  console.log('Kirim data:', payload); // ⬅ Tambahkan ini

  $.ajax({
    url: '<?= base_url('dashboard/kasir/simpanTransaksi') ?>',
    method: 'POST',
    contentType: 'application/json',
    data: JSON.stringify(payload),
    success: function (res) {
      console.log('Respon:', res); // ⬅ Tambahkan ini

      if (res.status === 'ok') {
        alert('Transaksi berhasil disimpan.\nInvoice: ' + res.invoice);
        cart = [];
        renderCart();
        loadProduk();
      } else {
        alert(res.message || 'Terjadi kesalahan.');
      }
    },
    error: function (xhr) {
      console.error('AJAX Error:', xhr.responseText); // ⬅ Tangkap error backend
      alert('Gagal menyimpan transaksi (500).');
    }
  });
});


$(document).ready(function() {
  loadProduk();
});
</script>
<?= $this->endSection() ?>
