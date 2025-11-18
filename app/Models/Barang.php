<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kategori_id',
        'nama_barang',
        'stok',
        'harga',
        'foto'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
