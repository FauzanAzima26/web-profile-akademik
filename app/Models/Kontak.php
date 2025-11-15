<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kontak extends Model
{
    use HasFactory, SoftDeletes;

    // Nama tabel (opsional, tapi diset biar eksplisit)
    protected $table = 'kontaks';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'alamat',
        'email',
        'telepon',
        'lokasi_embed',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'user_id',
    ];

    /**
     * Relasi ke user (siapa yang terakhir ubah kontak)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
