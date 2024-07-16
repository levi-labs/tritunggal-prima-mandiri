<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
