<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>

<div class="page-content">
  <h4>Kasir</h4>
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Daftar Belanja</span>
          <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalProdukBaru">Tambah Produk Baru</button>
        </div>
        <div class="card-body">
          <input type="text" id="cariProduk" class="form-control mb-3" placeholder="Ketik nama / scan barcode...">
          <table class="table table-sm table-dark table-bordered" id="tabelBelanja">
            <thead>
              <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
                <th></th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">Ringkasan</div>
        <div class="card-body">
          <p>Total Item: <span id="totalItems">0</span></p>
          <p>Total Harga: Rp <span id="totalHarga">0</span></p>
          <div class="mb-2">
            <label for="pembayaran">Pembayaran</label>
            <input type="number" id="pembayaran" class="form-control">
          </div>
          <p>Kembalian: Rp <span id="kembalian">0</span></p>
          <button class="btn btn-success w-100" id="btnSimpan">Simpan Transaksi</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Produk Baru -->
<div class="modal fade" id="modalProdukBaru" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Produk Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label>Nama Produk</label>
          <input type="text" id="namaProdukBaru" class="form-control">
        </div>
        <div class="mb-3">
          <label>Harga Jual</label>
          <input type="number" id="hargaProdukBaru" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" id="btnSimpanProdukBaru">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script>
let belanja = [];

$(document).ready(function () {
  // Select2 input produk (dengan input manual untuk produk baru)
  $('#cariProduk').select2({
    placeholder: 'Cari produk...',
    allowClear: true,
    tags: true,
    createTag: function (params) {
      let term = $.trim(params.term);
      if (term === '') return null;
      return {
        id: 'new:' + term,
        text: term,
        isNew: true
      };
    },
    ajax: {
      url: '<?= base_url('kasir/cariProduk') ?>',
      dataType: 'json',
      delay: 250,
      data: params => ({ q: params.term }),
      processResults: data => ({
        results: data.map(p => ({
          id: p.id,
          text: p.name,
          price: parseFloat(p.sell_price || 0),
          isNew: false
        }))
      }),
      cache: true
    },
    escapeMarkup: markup => markup
  }).on('select2:select', function (e) {
    const p = e.params.data;

    if (p.isNew) {
      // Jika input manual, buka modal produk baru
      $('#namaProdukBaru').val(p.text);
      $('#modalProdukBaru').modal('show');
    } else {
      tambahProduk(p);
    }

    $(this).val(null).trigger('change');
  });

  // Event lainnya
  $('#btnSimpan').on('click', simpanTransaksi);
  $('#pembayaran').on('input', hitungKembalian);
  $('#btnSimpanProdukBaru').on('click', simpanProdukBaru);
});

function tambahProduk(p) {
  const idx = belanja.findIndex(i => i.id == p.id);
  if (idx >= 0) {
    belanja[idx].qty++;
  } else {
    belanja.push({ ...p, qty: 1 });
  }
  renderTabel();
}

function renderTabel() {
  const tbody = $('#tabelBelanja tbody').empty();
  let total = 0, items = 0;

  belanja.forEach((item, i) => {
    const subtotal = item.qty * item.price;
    total += subtotal;
    items += item.qty;

    tbody.append(`
      <tr>
        <td>${item.text}</td>
        <td>
          <button class="btn btn-sm btn-secondary" onclick="ubahQty(${i}, -1)">-</button>
          <span class="mx-2">${item.qty}</span>
          <button class="btn btn-sm btn-secondary" onclick="ubahQty(${i}, 1)">+</button>
        </td>
        <td>Rp ${item.price.toLocaleString()}</td>
        <td>Rp ${subtotal.toLocaleString()}</td>
        <td><button class="btn btn-sm btn-danger" onclick="hapusItem(${i})">🗑</button></td>
      </tr>
    `);
  });

  $('#totalItems').text(items);
  $('#totalHarga').text(`Rp ${total.toLocaleString()}`);
  hitungKembalian();
}

function ubahQty(index, delta) {
  belanja[index].qty += delta;
  if (belanja[index].qty <= 0) belanja.splice(index, 1);
  renderTabel();
}

function hapusItem(index) {
  belanja.splice(index, 1);
  renderTabel();
}

function hitungKembalian() {
  const total = belanja.reduce((acc, i) => acc + i.qty * i.price, 0);
  const bayar = parseInt($('#pembayaran').val() || 0);
  const kembali = bayar - total;
  $('#kembalian').text(`Rp ${kembali > 0 ? kembali.toLocaleString() : 0}`);
}

function simpanTransaksi() {
  const total = belanja.reduce((acc, i) => acc + i.qty * i.price, 0);
  const bayar = parseInt($('#pembayaran').val() || 0);

  if (!belanja.length) return alert('Daftar belanja kosong!');
  if (bayar < total) return alert('Pembayaran kurang dari total.');

  const items = belanja.map(p => ({
    id: p.id,
    price: p.price,
    qty: p.qty,
    subtotal: p.qty * p.price
  }));

  fetch('<?= base_url('kasir/simpanTransaksi') ?>', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ items, total_price: total, payment: bayar })
  })
    .then(res => res.json())
    .then(res => {
      if (res.status === 'ok') {
        alert('Transaksi berhasil! Invoice: ' + res.invoice);
        location.reload();
      } else {
        alert('Gagal simpan: ' + res.message);
      }
    });
}

function simpanProdukBaru() {
  const name = $('#namaProdukBaru').val().trim();
  const price = parseInt($('#hargaProdukBaru').val()) || 0;

  if (!name || price <= 0) {
    alert('Isi nama dan harga produk.');
    return;
  }

  fetch('<?= base_url('kasir/tambahProdukBaru') ?>', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({ name, sell_price: price })
  })
    .then(res => res.json())
    .then(res => {
      if (res.status === 'ok') {
        alert('Produk berhasil ditambahkan.');
        tambahProduk({
          id: res.produk.id,
          text: res.produk.name,
          price: parseFloat(res.produk.sell_price)
        });
        $('#modalProdukBaru').modal('hide');
        $('#namaProdukBaru').val('');
        $('#hargaProdukBaru').val('');
      } else {
        alert(res.message);
      }
    });
}

</script>

<?= $this->endSection() ?>
