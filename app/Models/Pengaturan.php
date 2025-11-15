<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengaturan extends Model
{
    use HasFactory, SoftDeletes;

    // Nama tabel (opsional, kalau nama model beda dari nama tabel)
    protected $table = 'pengaturans';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'nama_prodi',
        'nama_fakultas',
        'nama_universitas',
        'logo',
        'favicon',
        'email',
        'telepon',
        'alamat',
        'footer',
        'facebook',
        'instagram',
        'youtube',
        'twitter',
        'user_id',
    ];

    /**
     * Relasi ke model User
     * Setiap pengaturan dicatat oleh user tertentu
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
