<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id', 'judul', 'penulis', 'penerbit', 'tahun', 'stok', 'cover', 'deskripsi'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
