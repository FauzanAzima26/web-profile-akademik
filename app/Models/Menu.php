<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    // Nama tabel (opsional, biar eksplisit)
    protected $table = 'menus';

    // Kolom yang boleh diisi massal
    protected $fillable = [
        'nama_menu',
        'slug',
        'icon',
        'urutan',
        'parent_id',
        'is_active',
        'user_id',
    ];

    /**
     * Relasi ke user (siapa yang terakhir ubah menu)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke menu induk (jika menu ini adalah submenu)
     */
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    /**
     * Relasi ke submenu (jika menu ini punya anak)
     */
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
