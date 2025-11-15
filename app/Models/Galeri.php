<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galeri extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'galeris';

    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
