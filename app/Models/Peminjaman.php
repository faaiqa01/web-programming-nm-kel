<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';

    protected $fillable = [
        'user_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'denda',
    ];

    // Konversi otomatis tanggal jadi objek Carbon
    protected $casts = [
        'tanggal_pinjam' => 'datetime',
        'tanggal_kembali' => 'datetime',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke buku
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    // Hitung denda otomatis (property tambahan)
    public function getHitungDendaAttribute()
    {
        if (!$this->tanggal_pinjam) return 0;

        $batas_hari = 7; // contoh: batas pinjam 7 hari
        $tanggal_kembali = $this->tanggal_kembali ?? now();

        $selisih = $this->tanggal_pinjam->diffInDays($tanggal_kembali);
        return $selisih > $batas_hari ? ($selisih - $batas_hari) * 1000 : 0;
    }

    // Format tanggal untuk tampilan (opsional)
    public function getTanggalPinjamFormattedAttribute()
    {
        return $this->tanggal_pinjam ? $this->tanggal_pinjam->format('d M Y') : '-';
    }

    public function getTanggalKembaliFormattedAttribute()
    {
        return $this->tanggal_kembali ? $this->tanggal_kembali->format('d M Y') : '-';
    }
}
