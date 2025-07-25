<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stokin extends Model
{
    protected $fillable = [
        'produk_id',
        'jumlah',
        'keterangan',
        'tgl_masuk',
    ];

    protected $table = 'stokins';

    public static $rules = [
        'produk_id' => 'required|exists:produks,id',
        'jumlah' => 'required|integer|min:0',
        'keterangan' => 'nullable|string|max:255',
        'tgl_masuk' => 'nullable|date',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
    
}
