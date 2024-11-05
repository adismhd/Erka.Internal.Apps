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
            $table->double('OngkosKirim')->nullable();
            $table->double('TotalHarga')->nullable();
            $table->integer('Ppn')->nullable();
            $table->integer('Qty')->nullable();
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_plan');
        Schema::dropIfExists('tbl_item_plan');
    }
};
