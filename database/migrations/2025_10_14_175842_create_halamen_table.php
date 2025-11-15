<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('halamen', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('judul'); // contoh: Visi & Misi, Sejarah, Tujuan, dsb
            $table->text('konten'); // isi halaman
            $table->string('slug')->unique(); // untuk url, misal: visi-misi
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('halamen');
    }
};
