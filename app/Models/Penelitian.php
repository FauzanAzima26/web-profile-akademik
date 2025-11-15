<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penelitian extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penelitians';

    protected $fillable = [
        'judul',
        'peneliti',
        'tahun',
        'file',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
