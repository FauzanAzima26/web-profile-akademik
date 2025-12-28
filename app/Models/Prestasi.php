<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prestasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'prestasi_mahasiswa';

    protected $fillable = [
        'judul',
        'kategori',
        'tingkat',
        'tahun',
        'mahasiswa',
        'deskripsi',
        'foto',
    ];
}
