<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pembelian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'pembelian';

    public function nama(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtoupper($value),
        );
    }
    public function barang()
    {
        return $this->hasOne(Barang::class, 'pembelian_id', 'id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function generateKode()
    {
        $pembelian = $this->count();

        if ($pembelian == 0) {
            $counter = '0001';
            $number  = 'PBL-' . sprintf('%04s', $counter);
        } else {
            $last = $this->all()->last();
            $counter = (int) substr($last->kode, 4) + 1;
            $number  = 'PBL-' . sprintf('%04s', $counter);
        }

        return $number;
    }

    public function reportPembelian($from, $to)
    {
        if ($from !== null && $to === null) {
            $data  = DB::table('pembelian')
                ->join('supplier', 'pembelian.supplier_id', '=', 'supplier.id')
                ->join('kategori', 'pembelian.kategori_id', '=', 'kategori.id')
                ->select('pembelian.*', 'supplier.nama as supplier', 'kategori.nama as kategori')
                ->where('pembelian.tanggal', '>=', $from)
                ->get();
            return $data;
        } elseif ($from === null && $to !== null) {
            $data  = DB::table('pembelian')
                ->join('supplier', 'pembelian.supplier_id', '=', 'supplier.id')
                ->join('kategori', 'pembelian.kategori_id', '=', 'kategori.id')
                ->select('pembelian.*', 'supplier.nama as supplier', 'kategori.nama as kategori')
                ->where('pembelian.tanggal', '<=', $to)
                ->get();
            return $data;
        } elseif ($from !== null && $to !== null) {
            $data  = DB::table('pembelian')
                ->join('supplier', 'pembelian.supplier_id', '=', 'supplier.id')
                ->join('kategori', 'pembelian.kategori_id', '=', 'kategori.id')
                ->select('pembelian.*', 'supplier.nama as supplier', 'kategori.nama as kategori')
                ->whereBetween('pembelian.tanggal', [$from, $to])
                ->get();
            return $data;
        }
    }
}
