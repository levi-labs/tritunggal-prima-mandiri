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
    public function reportPenjualan()
    {
        $data = DB::table('penjualan')
            ->join('barang', 'penjualan.barang_id', '=', 'barang.id')
            ->join('gudang', 'barang.gudang_id', '=', 'gudang.id')
            ->join('barang', 'barang.pembelian_id', '=', 'pembelian.id')
            ->select(
                'penjualan.*',

                'barang.*',
                'gudang.*',
                'pembelian.nama',
            )
            ->get();
        return $data;
    }
}
