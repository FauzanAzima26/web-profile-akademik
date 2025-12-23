<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dosen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dosens';

    protected $fillable = [
        'nidn',
        'nama',
        'gelar_depan',
        'gelar_belakang',
        'foto',
        'jabatan',
        'bidang_keahlian',
        'email',
        'telepon',
        'status',
    ];
}
