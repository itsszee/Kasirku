<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function cetakStruk($id)
    {
        $transaksi = Transaksi::with('detailTransaksis.produk')->findOrFail($id);

        return view('transaksi.struk', compact('transaksi'));
    }
}