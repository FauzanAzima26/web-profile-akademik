<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\KategoriBerita;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berita extends Model
{
    protected $table = 'berita';
    use SoftDeletes;

    protected $fillable = [
        'kategori_id',
        'judul',
        'slug',
        'konten',
        'gambar',
        'penulis',
        'views',
        'is_published',
        'published_at'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_id');
    }
}
