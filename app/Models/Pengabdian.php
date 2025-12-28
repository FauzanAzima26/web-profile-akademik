<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengabdian extends Model
{
    use SoftDeletes;

    protected $table = 'pengabdian';

    protected $fillable = [
        'judul',
        'tahun',
        'dosen_id',
        'lokasi',
        'peserta',
        'deskripsi',
        'foto_url',
        'status',
    ];

    public function dosen()
    {
        return $this->belongsTo(dosen::class, 'dosen_id');
    }
}
