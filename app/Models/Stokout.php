<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stokout extends Model
{
    protected $fillable = [
        'produk_id',
        'jumlah',
        'keterangan',
        'tgl_keluar',
    ];
    
    protected $table = 'stokouts';

    public static $rules = [
        'produk_id' => 'required|exists:produks,id',
        'jumlah' => 'required|integer|min:1',
        'keterangan' => 'required|string|max:100',
        'tgl_keluar' => 'nullable|date',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
