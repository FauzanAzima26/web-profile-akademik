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
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama_prodi')->nullable();
            $table->string('nama_fakultas')->nullable();
            $table->string('nama_universitas')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->string('alamat')->nullable();
            $table->text('footer')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->softDeletes();

            // Relasi user (siapa yang terakhir ubah pengaturan)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturans');
    }
};
