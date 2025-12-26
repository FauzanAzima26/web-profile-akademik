<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BidangKeahlian extends Model
{
    protected $table = 'bidang_keahlian';

    use SoftDeletes;

    protected $fillable = [
        'nama',
        'deskripsi'
    ];
}
