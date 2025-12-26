<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kurikulum extends Model
{
    use SoftDeletes;

    protected $table = 'kurikulum';

    protected $fillable = [
        'nama',
        'tahun',
        'total_sks',
        'deskripsi',
        'file_pdf',
    ];
}
