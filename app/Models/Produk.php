<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'nama',
        'keterangan', 
        'stok',
        'harga'
    ];
    protected $guarded = [];
    protected $table = 'produks';

    public function stokin() {
      return $this->hasMany(Stokin::class);
    }

    public function stokout() {
      return $this->hasMany(Stokout::class);
    }
}
