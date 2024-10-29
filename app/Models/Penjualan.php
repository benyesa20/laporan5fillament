<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',           // Integer (foreign key)
        'jumlah_penjualan',    // Integer
        'total_harga',         // Integer
        'jenis_pembayaran',    // Enum
        'tanggal_penjualan',   // Date
        'bukti_transaksi',     // File (upload path for transaction proof)
    ];

    protected $casts = [
        'jenis_pembayaran' => 'string', // Enum: 'tunai', 'kredit', 'debit'
    ];

    // Relasi dengan model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
