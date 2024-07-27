<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // if (!auth()->check()) {
        //     return redirect()->route('login');
        // }
        $title = 'Halaman Dashboard';
        $sales = DB::table('penjualan')->select(DB::raw('SUM(subtotal) as total'))->first();
        $penjualan = DB::table('penjualan')->count();
        $pembelian = DB::table('pembelian')->count();
        $supplier = DB::table('supplier')->count();

        $chartPembelian = DB::table('pembelian')->get();
        $chartPenjualan = DB::table('penjualan')
            ->join('barang', 'penjualan.barang_id', '=', 'barang.id')
            ->join('pembelian', 'barang.pembelian_id', '=', 'pembelian.id')
            ->select('pembelian.nama', 'penjualan.qty')
            ->get();
        // dd($chartPenjualan);
        return view('pages.dashboard.index', compact(
            'title',
            'penjualan',
            'pembelian',
            'supplier',
            'sales',
            'chartPembelian',
            'chartPenjualan'
        ));
    }
}
