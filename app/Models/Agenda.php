<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Agenda extends Model
{
    protected $table = 'agenda';

    use SoftDeletes;

    protected $fillable = [
        'judul',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi',
        'deskripsi',
        'gambar'
    ];
}
