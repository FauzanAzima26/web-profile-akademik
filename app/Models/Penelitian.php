<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penelitian extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penelitian';

    protected $fillable = [
        'judul',
        'jenis',
        'tahun',
        'abstrak',
        'file_url',
        'status',
    ];

    public function dosen()
    {
        return $this->belongsToMany(Dosen::class, 'penelitian_dosen', 'penelitian_id', 'dosen_id')->withPivot('peran');
    }
}
