<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    protected $fillable = [
        'nama_barang',         // String
        'stok',                // Integer
        'kategori',            // String
        'kondisi',             // Enum
        'gambar',              // File (image path)
        'tanggal_masuk',       // Date
        'tersedia',            // Boolean
    ];

    protected $casts = [
        'kondisi' => 'string',     // Enum: 'baru', 'bekas', 'rusak'
        'tersedia' => 'boolean',
    ];

    // Relasi One-to-Many dengan model Penjualan
    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'barang_id');
    }
}
