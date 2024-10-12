<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ref_supplier', function (Blueprint $table) {
            $table->id();
            $table->string('CodeId');
            $table->string('Deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('tbl_supplier', function (Blueprint $table) {
            $table->id();
            $table->string('Regno');
            $table->string('SupplierCode')->nullable();
            $table->timestamps();
        });

        Schema::create('tbl_supplier_link', function (Blueprint $table) {
            $table->id();
            $table->string('ItemGoodsId');
            $table->string('Supplier')->nullable();
            $table->string('Alamat')->nullable();
            $table->string('Pic')->nullable();
            $table->string('NoTelepon')->nullable();
            $table->string('Link')->nullable();
            $table->double('Harga')->nullable();
            $table->double('TotalHarga')->nullable();
            $table->string('Ppn')->nullable();
            $table->string('Keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ref_supplier');
        Schema::dropIfExists('tbl_supplier');
        Schema::dropIfExists('tbl_supplier_link');
    }
};
