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
        Schema::create('tbl_glosariums', function (Blueprint $table) {
            $table->id();
            $table->string('Code')->unique();
            $table->string('Perusahaan');
            $table->string('Pic');
            $table->string('NoTelepon');
            $table->timestamps();
        });

        Schema::create('tbl_alamats', function (Blueprint $table) {
            $table->id();
            $table->string('CodeId');
            $table->string('Deskripsi');
            $table->string('Alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_glosariums');
        Schema::dropIfExists('tbl_alamats');
    }
};
