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
                          data-price="<?= (int)$p['sell_price'] ?>">
                    <?= esc($p['name']) ?> (Stok: <?= $p['stock'] ?>)
                  </option>
                <?php else: ?>
                  <option disabled><?= esc($p['name']) ?> (Habis)</option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>

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
            <p>Kembalian: <span id="kembalian">Rp 0</span></p>
            <button class="btn btn-success w-100" id="btnSimpan">Simpan Transaksi</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Preview (struk) -->
<div class="modal fade" id="modalPreview" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" style="max-width:65mm">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h6 class="modal-title">Preview Struk</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-2" style="max-height:80vh; overflow-y:auto;">
        <div id="previewContent" class="p-1"></div>
      </div>
      <div class="modal-footer py-2">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-success btn-sm" id="btnSimpanTransaksi">Konfirmasi & Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="<?= base_url('assets/backend/js/jquery.min.js') ?>"></script>
<!-- Bootstrap bundle -->
<script src="<?= base_url('assets/backend/js/bootstrap.bundle.min.js') ?>"></script>

<script>
let belanja = [];

function rupiah(n){ return (Number(n)||0).toLocaleString('id-ID'); }
function toNumber(v){ return parseInt((v||'0').toString().replace(/[^0-9]/g,'')) || 0; }

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

function hapusItem(i){ belanja.splice(i,1); renderTabel(); }
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
  $('#kembalian').text('Rp ' + rupiah(bayar-grand));
}

function buatStrukHTML(data) {
  let html = `
    <div style="font-size:12px; text-align:center;">
      <strong>Azmi Jaya Plastik</strong><br>
      Jl. Contoh Alamat No.123<br>
      Telp: 0812-3456-7890
      <div style="border-top:1px dashed #000; margin:4px 0;"></div>
      <p style="text-align:left;">
        No: ${data.invoice_hint||'-'}<br>
        Tgl: ${new Date().toLocaleString()}<br>
        Pelanggan: ${data.customer_name||'Umum'}
      </p>
      <div style="border-top:1px dashed #000; margin:4px 0;"></div>
      <table style="width:100%; font-size:12px;">`;
  data.items.forEach((it,i)=>{
    html += `
      <tr>
        <td style="text-align:left;">${i+1}. ${it.name}</td>
        <td style="text-align:right;">Rp ${rupiah(it.subtotal)}</td>
      </tr>
      <tr>
        <td style="text-align:left;">${it.qty} x Rp ${rupiah(it.price)}</td>
        <td></td>
      </tr>`;
  });
  html += `</table>
      <div style="border-top:1px dashed #000; margin:4px 0;"></div>
      <p style="text-align:left;">
        Total: Rp ${rupiah(data.total_price)}<br>
        Bayar: Rp ${rupiah(data.payment)}<br>
        Kembali: Rp ${rupiah(data.payment - data.total_price)}
      </p>
      <div style="border-top:1px dashed #000; margin:4px 0;"></div>
      <p>Terima kasih<br>Telah berbelanja</p>
    </div>`;
  return html;
}

$(document).ready(function(){
  fetch('<?= base_url('dashboard/kasir/nextInvoice') ?>')
    .then(r => r.json())
    .then(res => { if(res.status==='ok'){ $('#noInvoice').val(res.invoice); } });

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
    let qty = Math.max(1, toNumber($('#produkJumlah').val()));
    if (!id || !name || price <= 0) return;

    belanja.push({id, sku, name, price, qty, subtotal: price*qty});
    renderTabel();

    $('#produkId,#produkSku,#produkNama,#produkHarga,#produkJumlah,#produkTotal').val('');
    $('#produkSelect').val('').trigger('change');
  });

  $('#btnSimpan').on('click', function(){
    if(!belanja.length) return alert('Belanja kosong!');
    const total = toNumber($('#grandTotal').val());
    const bayar = toNumber($('#pembayaran').val());
    if(bayar < total) return alert('Pembayaran kurang');

    const data = {
      items: belanja,
      total_price: total,
      payment: bayar,
      customer_name: $('#namaPelanggan').val().trim()||null,
      invoice_hint: $('#noInvoice').val()||null
    };

    $('#previewContent').html(buatStrukHTML(data));
    let modal = new bootstrap.Modal(document.getElementById('modalPreview'));
    modal.show();

    $('#btnSimpanTransaksi').off('click').on('click',function(){
      fetch('<?= base_url('dashboard/kasir/simpanTransaksi') ?>',{
        method:'POST',
        headers:{'Content-Type':'application/json'},
        body: JSON.stringify(data)
      })
      .then(r=>r.json())
      .then(res=>{
        if(res.status==='ok'){
          modal.hide();
          alert('Transaksi berhasil! Invoice: '+res.invoice);
          location.reload();
        }else{
          alert('Gagal: '+res.message);
        }
      });
    });
  });

  $('#diskon').on('input',hitungGrandTotal);
  $('#pembayaran').on('input',hitungKembalian);
});
</script>

<?= $this->endSection() ?>
