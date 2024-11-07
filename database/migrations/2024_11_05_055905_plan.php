<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_plan', function (Blueprint $table) {
            $table->id();
            $table->string('Regno');
            $table->double('ExpectedProfit')->nullable();
            $table->double('Discount')->nullable();
            $table->timestamps();
        });

        Schema::create('tbl_item_plan', function (Blueprint $table) {
            $table->id();
            $table->string('Regno');
            $table->string('ItemGoodsId')->nullable();
            $table->string('SupplierCode')->nullable();
            $table->string('SupplierId')->nullable();
            $table->double('Harga')->nullable();
            $table->double('TotalHarga')->nullable();
            $table->double('Profit')->nullable();
            $table->double('TotalProfit')->nullable();
            $table->double('Discount')->nullable();
            $table->double('HargaDiscount')->nullable();
            $table->double('TotalHargaDiscount')->nullable();
            $table->double('OngkosKirim')->nullable();
            $table->integer('Ppn')->nullable();
            $table->integer('Qty')->nullable();
            $table->double('CustomCaseVat')->nullable();
            $table->double('Vat')->nullable();
            $table->double('TotalVatItem')->nullable();
            $table->timestamps();
        });

        Schema::create('tbl_plan_detail', function (Blueprint $table) {
            $table->id();
            $table->string('Regno');
            $table->string('DetailCode')->nullable();
            $table->string('Deskripsi')->nullable();
            $table->double('Nilai')->nullable();
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_plan');
        Schema::dropIfExists('tbl_item_plan');
        Schema::dropIfExists('tbl_plan_detail');
    }
};
