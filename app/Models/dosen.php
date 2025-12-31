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
        'email',
        'telepon',
        'status',
        'bidang_keahlian_id',
    ];

    public function bidangKeahlian()
    {
        return $this->belongsTo(BidangKeahlian::class, 'bidang_keahlian_id');
    }

    public function penelitian()
    {
        return $this->belongsToMany(
            penelitian::class,
            'penelitian_dosen',
            'dosen_id',
            'penelitian_id'
        )
            ->withPivot('peran');
    }

    public function jadwalKuliah()
    {
        return $this->hasMany(jadwalKuliah::class);
    }
}
