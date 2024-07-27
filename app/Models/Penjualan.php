<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Penjualan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'penjualan';

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public  function generateKode()
    {
        $penjualan = $this->count();

        if ($penjualan == 0) {
            $counter = '0001';
            $number  = 'PJL-' . sprintf('%04s', $counter);
        } else {
            $last = $this->all()->last();
            $counter = (int) substr($last->kode, 4) + 1;
            $number  = 'PJL-' . sprintf('%04s', $counter);
        }

        return $number;
    }
    public function reportPenjualan($from, $to)
    {
        if ($from !== null && $to === null) {
            $data = DB::table('penjualan')
                ->join('barang', 'penjualan.barang_id', '=', 'barang.id')
                ->join('gudang', 'barang.gudang_id', '=', 'gudang.id')
                ->join('pembelian', 'barang.pembelian_id', '=', 'pembelian.id')
                ->join('kategori', 'pembelian.kategori_id', '=', 'kategori.id')
                ->select(
                    'penjualan.*',

                    'barang.*',
                    'gudang.*',
                    'pembelian.nama',
                    'pembelian.satuan',
                    'kategori.nama as kategori',
                )
                ->where('penjualan.tanggal', '>=', $from)
                ->get();
            return $data;
        } elseif ($from === null && $to !== null) {
            $data = DB::table('penjualan')
                ->join('barang', 'penjualan.barang_id', '=', 'barang.id')
                ->join('gudang', 'barang.gudang_id', '=', 'gudang.id')
                ->join('pembelian', 'barang.pembelian_id', '=', 'pembelian.id')
                ->join('kategori', 'pembelian.kategori_id', '=', 'kategori.id')
                ->select(
                    'penjualan.*',

                    'barang.*',
                    'gudang.*',
                    'pembelian.nama',
                    'pembelian.satuan',
                    'kategori.nama as kategori',

                )
                ->where('penjualan.tanggal', '<=', $to)
                ->get();
            return $data;
        } elseif ($from !== null && $to !== null) {
            $data = DB::table('penjualan')
                ->join('barang', 'penjualan.barang_id', '=', 'barang.id')
                ->join('gudang', 'barang.gudang_id', '=', 'gudang.id')
                ->join('pembelian', 'barang.pembelian_id', '=', 'pembelian.id')
                ->join('kategori', 'pembelian.kategori_id', '=', 'kategori.id')
                ->select(
                    'penjualan.*',

                    'barang.*',
                    'gudang.*',
                    'pembelian.nama',
                    'pembelian.satuan',
                    'kategori.nama as kategori',

                )
                ->whereBetween('penjualan.tanggal', [$from, $to])
                ->get();
            return $data;
        }
    }
}
