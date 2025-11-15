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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('judul')->nullable(); // judul slider
            $table->text('deskripsi')->nullable(); // deskripsi singkat di slider
            $table->string('gambar')->nullable(); // path gambar slider
            $table->boolean('status')->default(true); // aktif/tidak ditampilkan
            // Kolom wajib (standar sistem)
            $table->unsignedBigInteger('user_id')->nullable();
            $table->softDeletes(); // deleted_at

            // Relasi ke users
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
