<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prestasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'prestasis';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tahun',
        'gambar',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
