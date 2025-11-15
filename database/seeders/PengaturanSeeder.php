<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengaturan;

class PengaturanSeeder extends Seeder
{
    public function run(): void
    {
        Pengaturan::create([
            'nama_prodi' => 'Teknik Informatika',
            'nama_fakultas' => 'Fakultas Teknik',
            'nama_universitas' => 'Universitas Malikussaleh',
            'email' => 'informatika@unimal.ac.id',
            'telepon' => '+62.645.41373',
            'alamat' => 'Kampus Utama Bukit Indah,Muara Satu, Kota Lhokseumawe,Provinsi Aceh, Indonesia',
            'footer' => '© 2025 Teknik Informatika UNIMAL',
            'user_id' => 1,
        ]);
    }
}
