<?= $this->extend('backend/layout/default') ?>
<?= $this->section('content') ?>

<div class="page-content">
  <div class="row mb-3">
    <div class="col-md-3">
      <label>Kasir</label>
      <input type="text" class="form-control" value="Admin" readonly>
    </div>
    <div class="col-md-3">
      <label>No. Invoice</label>
      <input type="text" id="noInvoice" class="form-control" readonly>
    </div>
    <div class="col-md-3">
      <label>Tanggal Invoice</label>
      <input type="text" class="form-control" value="<?= date('d/m/Y') ?>" readonly>
    </div>
    <div class="col-md-3">
      <label>Pelanggan</label>
      <input type="text" id="namaPelanggan" class="form-control" placeholder="Nama pelanggan">
    </div>
  </div>

  <div class="row">
    <!-- Form Tambah Produk -->
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">Tambah Produk Transaksi</div>
        <div class="card-body">
          <div class="mb-2">
            <label for="produkSelect">Cari Produk</label>
            <select id="produkSelect" class="form-select">
              <option value="">-- Pilih Produk --</option>
              <?php foreach ($produk as $p): ?>
                <?php if ($p['stock'] > 0): ?>
                  <option value="<?= $p['id'] ?>"
                          data-sku="<?= $p['sku'] ?>"
                          data-name="<?= esc($p['name']) ?>"
                          data-price="<?= $p['sell_price'] ?>">
                    <?= esc($p['name']) ?> (Stok: <?= $p['stock'] ?>)
                  </option>
                <?php else: ?>
                  <option disabled><?= esc($p['name']) ?> (Habis)</option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- hidden id + sku -->
          <input type="hidden" id="produkId">
          <input type="hidden" id="produkSku">

          <div class="mb-2">
            <label>Produk</label>
            <input type="text" id="produkNama" class="form-control" readonly>
          </div>
          <div class="mb-2">
            <label>Harga</label>
            <input type="text" id="produkHarga" class="form-control" readonly>
          </div>
          <div class="mb-2">
            <label>Jumlah</label>
            <input type="number" id="produkJumlah" class="form-control" value="1" min="1">
          </div>
          <div class="mb-2">
            <label>Total</label>
            <input type="text" id="produkTotal" class="form-control" readonly>
          </div>
          <button class="btn btn-success w-100" id="btnTambah">Tambahkan</button>
        </div>
      </div>
    </div>

    <!-- Daftar Belanja -->
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Daftar Produk Transaksi</div>
        <div class="card-body">
          <table class="table table-bordered" id="tabelBelanja">
            <thead>
              <tr>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>

          <div class="row mt-3">
            <div class="col-md-6">
              <label>Sub Total Pembelian</label>
              <input type="text" id="subTotal" class="form-control" readonly>
            </div>
            <div class="col-md-3">
              <label>Diskon (%)</label>
              <input type="number" id="diskon" class="form-control" value="0">
            </div>
            <div class="col-md-3">
              <label>Total Pembelian</label>
              <input type="text" id="grandTotal" class="form-control" readonly>
            </div>
          </div>

          <div class="mt-3">
            <label>Pembayaran</label>
            <input type="number" id="pembayaran" class="form-control mb-2">
            <p>Kembalian: Rp <span id="kembalian">0</span></p>
            <button class="btn btn-success w-100" id="btnSimpan">Simpan Transaksi</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="<?= base_url('assets/backend/js/jquery.min.js') ?>"></script>

<script>
let belanja = [];

function rupiah(n){ return (Number(n)||0).toLocaleString('id-ID'); }
function toNumber(v){ return Number((v||'0').toString().replace(/\./g,''))||0; }

function renderTabel(){
  let tbody = $('#tabelBelanja tbody').empty();
  let total = 0;
  belanja.forEach((p,i)=>{
    total += p.subtotal;
    tbody.append(`
      <tr>
        <td>${p.sku}</td>
        <td>${p.name}</td>
        <td>Rp ${rupiah(p.price)}</td>
        <td>${p.qty}</td>
        <td>Rp ${rupiah(p.subtotal)}</td>
        <td><button class="btn btn-danger btn-sm" onclick="hapusItem(${i})">Hapus</button></td>
      </tr>
    `);
  });
  $('#subTotal').val(total);
  hitungGrandTotal();
}

function hapusItem(i){
  belanja.splice(i,1);
  renderTabel();
}

function hitungGrandTotal(){
  const sub = toNumber($('#subTotal').val());
  const diskon = toNumber($('#diskon').val());
  const grand = sub - (sub * diskon / 100);
  $('#grandTotal').val(grand);
  hitungKembalian();
}

function hitungKembalian(){
  const grand = toNumber($('#grandTotal').val());
  const bayar = toNumber($('#pembayaran').val());
  $('#kembalian').text(rupiah(bayar-grand));
}

$(document).ready(function(){

  // pilih produk → isi form
  $('#produkSelect').on('change', function(){
    let opt = $(this).find(':selected');
    if(!opt.val()) return;
    $('#produkId').val(opt.val());
    $('#produkSku').val(opt.data('sku'));
    $('#produkNama').val(opt.data('name'));
    $('#produkHarga').val(opt.data('price'));
    $('#produkJumlah').val(1);
    $('#produkTotal').val(opt.data('price'));
  });

  // jumlah diubah → total update
  $('#produkJumlah').on('input', function(){
    let harga = toNumber($('#produkHarga').val());
    let qty = toNumber($(this).val());
    $('#produkTotal').val(harga*qty);
  });

  // tombol tambahkan
  $('#btnTambah').on('click', function(){
  const id = $('#produkId').val();
  const sku = $('#produkSku').val();
  const name = $('#produkNama').val();
  const price = toNumber($('#produkHarga').val());
  const qty = Math.max(1, toNumber($('#produkJumlah').val()));

  // langsung skip tanpa alert kalau belum ada produk
  if (!id || !name || price <= 0) return;

  const subtotal = qty * price;

  belanja.push({ id, kode: sku||'-', name, price, qty, subtotal });

  // reset form setelah masuk
  $('#produkId,#produkSku,#produkNama,#produkHarga,#produkJumlah,#produkTotal').val('');
  $('#produkSelect').val('').trigger('change');

  renderTabel();
});


  // kalkulasi realtime
  $('#diskon').on('input',hitungGrandTotal);
  $('#pembayaran').on('input',hitungKembalian);

  // simpan transaksi
  $('#btnSimpan').on('click', function(){
    if(!belanja.length) return alert('Belanja kosong!');
    const total = toNumber($('#grandTotal').val());
    const bayar = toNumber($('#pembayaran').val());
    if(bayar < total) return alert('Pembayaran kurang');

    fetch('<?= base_url('dashboard/kasir/simpanTransaksi') ?>',{
      method:'POST',
      headers:{'Content-Type':'application/json'},
      body:JSON.stringify({
        items: belanja,
        total_price: total,
        payment: bayar,
        customer_name: $('#namaPelanggan').val().trim()||null,
        invoice_hint: $('#noInvoice').val()||null
      })
    })
    .then(r=>r.json())
    .then(res=>{
      if(res.status==='ok'){
        alert('Transaksi berhasil! Invoice: '+res.invoice);
        window.open('<?= base_url('dashboard/kasir/cetak') ?>/'+res.invoice,'_blank');
        location.reload();
      } else {
        alert('Gagal: '+res.message);
      }
    });
  });
});

$(document).ready(function(){

  // Panggil nomor invoice dari backend
  fetch('<?= base_url('dashboard/kasir/nextInvoice') ?>')
    .then(r => r.json())
    .then(res => {
      if(res.status === 'ok'){
        $('#noInvoice').val(res.invoice);
      } else {
        // fallback kalau gagal
        let today = new Date();
        let dd = String(today.getDate()).padStart(2,'0');
        let mm = String(today.getMonth()+1).padStart(2,'0');
        let yyyy = today.getFullYear();
        $('#noInvoice').val('INV-'+dd+mm+yyyy+'-0001');
      }
    });

  // === existing code ===
  $('#produkSelect').on('change', function(){
    let opt = $(this).find(':selected');
    if(!opt.val()) return;
    $('#produkId').val(opt.val());
    $('#produkSku').val(opt.data('sku'));
    $('#produkNama').val(opt.data('name'));
    $('#produkHarga').val(opt.data('price'));
    $('#produkJumlah').val(1);
    $('#produkTotal').val(opt.data('price'));
  });

  $('#produkJumlah').on('input', function(){
    let harga = toNumber($('#produkHarga').val());
    let qty = toNumber($(this).val());
    $('#produkTotal').val(harga*qty);
  });

  $('#btnTambah').on('click', function(){
    let id = $('#produkId').val();
    let sku = $('#produkSku').val();
    let name = $('#produkNama').val();
    let price = toNumber($('#produkHarga').val());
    let qty = toNumber($('#produkJumlah').val());

    // langsung skip tanpa alert kalau belum ada produk
  if (!id || !name || price <= 0) return;

    let subtotal = price*qty;
    belanja.push({id, sku, name, price, qty, subtotal});
    renderTabel();

    $('#produkId,#produkSku,#produkNama,#produkHarga,#produkJumlah,#produkTotal').val('');
    $('#produkSelect').val('').trigger('change');
  });

  $('#diskon').on('input',hitungGrandTotal);
  $('#pembayaran').on('input',hitungKembalian);

  $('#btnSimpan').on('click', function(){
    if(!belanja.length) return alert('Belanja kosong!');
    const total = toNumber($('#grandTotal').val());
    const bayar = toNumber($('#pembayaran').val());
    if(bayar < total) return alert('Pembayaran kurang');

    fetch('<?= base_url('dashboard/kasir/simpanTransaksi') ?>',{
      method:'POST',
      headers:{'Content-Type':'application/json'},
      body:JSON.stringify({
        items: belanja,
        total_price: total,
        payment: bayar,
        customer_name: $('#namaPelanggan').val().trim()||null,
        invoice_hint: $('#noInvoice').val()||null
      })
    })
    .then(r=>r.json())
    .then(res=>{
      if(res.status==='ok'){
        alert('Transaksi berhasil! Invoice: '+res.invoice);
        window.open('<?= base_url('dashboard/kasir/cetak') ?>/'+res.invoice,'_blank');
        location.reload();
      } else {
        alert('Gagal: '+res.message);
      }
    });
  });

});

</script>

<?= $this->endSection() ?>
