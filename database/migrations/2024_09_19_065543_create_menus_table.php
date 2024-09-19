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
        Schema::create('ref_menus', function (Blueprint $table) {
            $table->id();
            $table->string('Nama');
            $table->string('Deskripsi');
            $table->string('Role')->nullable();
            $table->integer('Order')->nullable();
            $table->string('Link')->nullable();
            $table->string('Icon')->nullable();
            $table->string('Module')->nullable();
            $table->string('ParentId')->nullable();
            $table->string('IsActive');
            $table->timestamps();
        });
        
        Schema::create('ref_menus_modules', function (Blueprint $table) {
            $table->id();
            $table->string('Deskripsi');
            $table->string('IsActive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_menus');
        Schema::dropIfExists('ref_menus_module');
    }
};
