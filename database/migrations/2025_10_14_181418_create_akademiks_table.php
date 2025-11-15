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
        Schema::create('akademiks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('judul'); // contoh: Kurikulum 2021, Jadwal Kuliah, dll
            $table->text('konten'); // isi halaman
            $table->string('file')->nullable(); // jika ada file PDF kurikulum
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akademiks');
    }
};
