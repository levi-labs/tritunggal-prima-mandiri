<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $guarded = ['id'];

    public function nama(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function generateKode()
    {
        $kategori = $this->count();

        if ($kategori == 0) {
            $format = '00001';
            $number = 'KTG-' . sprintf('%05s', $format);
        } else {
            $last = $this->all()->last();
            $counter = (int) substr($last->kode, 4) + 1;
            $number = 'KTG-' . sprintf('%05s', $counter);
        }

        return $number;
    }
}
