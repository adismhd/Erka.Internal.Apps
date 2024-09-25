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
        Schema::create('tbl_customers', function (Blueprint $table) {
            $table->id();
            $table->string('Code')->unique();
            $table->string('Perusahaan');
            $table->timestamps();
        });

        Schema::create('tbl_alamats', function (Blueprint $table) {
            $table->id();
            $table->string('CodeId');
            $table->string('Deskripsi');
            $table->string('Alamat');
            $table->timestamps();
        });
        
        Schema::create('tbl_pic_customers', function (Blueprint $table) {
            $table->id();
            $table->string('CodeId');
            $table->string('Nama');
            $table->string('NoTelepon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_customers');
        Schema::dropIfExists('tbl_alamats');
        Schema::dropIfExists('tbl_pic_customers');
    }
};
