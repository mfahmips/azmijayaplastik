<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_id', 'qty', 'price', 'subtotal', 'user_id', 'created_at'];
    protected $useTimestamps = true;

    /**
     * Ambil semua isi keranjang untuk user tertentu.
     */
    public function getKeranjang($userId)
    {
        return $this->db->table($this->table)
            ->select('keranjang.*, products.nama AS nama_barang, products.sku, products.harga, users.name AS kasir')
            ->join('products', 'products.id = keranjang.product_id')
            ->join('users', 'users.id = keranjang.user_id')
            ->where('keranjang.user_id', $userId)
            ->get()
            ->getResultArray();
    }

    /**
     * Hitung total keseluruhan keranjang untuk user tertentu.
     */
    public function getTotalHarga($userId)
    {
        return $this->db->table($this->table)
            ->selectSum('subtotal')
            ->where('user_id', $userId)
            ->get()
            ->getRow()->subtotal ?? 0;
    }

    /**
     * Kosongkan keranjang user.
     */
    public function resetKeranjang($userId)
    {
        return $this->where('user_id', $userId)->delete();
    }

    /**
     * Hapus satu item dari keranjang.
     */
    public function hapusItem($id)
    {
        return $this->delete($id);
    }

    /**
     * Update jumlah barang.
     */
    public function updateJumlah($id, $jumlah, $harga)
    {
        $subtotal = $jumlah * $harga;
        return $this->update($id, [
            'qty' => $jumlah,
            'subtotal' => $subtotal
        ]);
    }
}
