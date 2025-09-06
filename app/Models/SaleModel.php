<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model
{
    protected $table            = 'sales';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'invoice',
        'customer_id',
        'customer_name',
        'total_price',
        'total_items',
        'paid',
        'change',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Ambil data penjualan lengkap dengan item & produk
     */
    public function getSaleWithItems($id)
    {
        $db = \Config\Database::connect();

        // ambil data penjualan
        $sale = $this->find($id);
        if (!$sale) {
            return null;
        }

        // ambil item + produk terkait
        $items = $db->table('sale_items si')
            ->select('si.*, p.sku, p.name as product_name')
            ->join('products p', 'p.id = si.product_id', 'left')
            ->where('si.sale_id', $id)
            ->get()
            ->getResultArray();

        $sale['items'] = $items;

        return $sale;
    }

    /**
     * Ambil data penjualan berdasarkan invoice lengkap dengan item
     */
    public function getSaleByInvoice($invoice)
    {
        $sale = $this->where('invoice', $invoice)->first();
        if (!$sale) {
            return null;
        }

        return $this->getSaleWithItems($sale['id']);
    }


    /**
 * Ambil semua penjualan dengan ringkasan (misalnya total item, total harga)
 * Bisa dipakai untuk halaman riwayat penjualan
 */
public function getAllSalesWithSummary($limit = 50, $offset = 0)
{
    $db = \Config\Database::connect();

    $builder = $db->table('sales s')
        ->select('
            s.id, s.invoice, s.customer_name, s.total_price, s.total_items, s.paid, s.change, s.created_at,
            COUNT(si.id) as jumlah_detail,
            SUM(si.qty) as total_qty
        ')
        ->join('sale_items si', 'si.sale_id = s.id', 'left')
        ->groupBy('s.id')
        ->orderBy('s.created_at', 'DESC')
        ->limit($limit, $offset);

    return $builder->get()->getResultArray();
}

}
