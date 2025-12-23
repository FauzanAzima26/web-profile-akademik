<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StrukturOrganisasi extends Model
{
    protected $table = 'struktur_organisasi';

    use SoftDeletes;

    protected $fillable = [
        'id',
        'jabatan',
        'nama',
        'foto',
        'urutan',
    ];
}
