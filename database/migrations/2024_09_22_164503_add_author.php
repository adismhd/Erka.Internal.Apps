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
        Schema::create('tbl_authors', function (Blueprint $table) {
            $table->id();
            $table->string('Nama');
            $table->string('NoTelepon');
            $table->string('Jabatan');
            $table->timestamps();
        });

        Schema::create('tbl_perusahaans', function (Blueprint $table) {
            $table->id();
            $table->string('Nama');
            $table->string('Code')->unique();
            $table->string('Logo')->nullable();
            $table->string('Deskripsi')->nullable();
            $table->string('Alamat')->nullable();
            $table->timestamps();
        });

        Schema::create('tbl_intsruction_notes', function (Blueprint $table) {
            $table->id();
            $table->string('PerusahaanId');
            $table->string('Deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_authors');
        Schema::dropIfExists('tbl_perusahaans');
        Schema::dropIfExists('tbl_intsruction_notes');
    }
};
