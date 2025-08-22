<?php

namespace App\Controllers\Backend\Transaksi;

use App\Controllers\BaseController;
use App\Models\PenjualanModel;

class Penjualan extends BaseController
{
    protected $penjualan;

    public function __construct()
    {
        $this->penjualan = new PenjualanModel();
    }

    public function index()
    {
        $data['penjualan'] = $this->penjualan
            ->orderBy('tanggal_transaksi', 'DESC')
            ->findAll();

        return view('backend/transaksi/penjualan/index', $data);
    }

    public function create()
    {
        $data = $this->request->getPost();

        if ($this->validate([
            'no_faktur' => 'required|is_unique[transaksi_penjualan.no_faktur]',
            'tanggal'   => 'required',
        ])) {
            $this->penjualan->insert([
                'no_faktur' => $data['no_faktur'],
                'tanggal'   => $data['tanggal'],
                'pelanggan' => $data['pelanggan'] ?? null,
                'total'     => $data['total'] ?? 0,
            ]);
            return redirect()->back()->with('msg', 'Transaksi berhasil ditambahkan');
        }

        return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
    }

    public function update()
    {
        $data = $this->request->getPost();

        if (!isset($data['id'])) {
            return redirect()->back()->with('errors', ['ID tidak valid']);
        }

        $this->penjualan->update($data['id'], [
            'no_faktur' => $data['no_faktur'],
            'tanggal'   => $data['tanggal'],
            'pelanggan' => $data['pelanggan'] ?? null,
            'total'     => $data['total'] ?? 0,
        ]);

        return redirect()->back()->with('msg', 'Transaksi berhasil diperbarui');
    }

    public function delete($id = null)
    {
        if ($id && $this->penjualan->find($id)) {
            $this->penjualan->delete($id);
            return redirect()->back()->with('msg', 'Transaksi berhasil dihapus');
        }

        return redirect()->back()->with('errors', ['Transaksi tidak ditemukan']);
    }
}
