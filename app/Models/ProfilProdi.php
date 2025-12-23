<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilProdi extends Model
{
    protected $table = 'profil';

    use SoftDeletes;

    protected $fillable = [
        'nama_prodi',
        'akreditasi',
        'tahun_berdiri',
        'visi',
        'misi',
        'tujuan',
    ];
}
