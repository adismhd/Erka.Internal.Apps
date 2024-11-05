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
        Schema::create('tbl_aplikasis', function (Blueprint $table) {
            $table->id();
            $table->string('Regno');
            $table->string('CustomerId');
            $table->string('AuthorId');
            $table->timestamps();
        });
        
        Schema::create('tbl_document_goods', function (Blueprint $table) {
            $table->id();
            $table->string('Regno');
            $table->string('SourceDocument')->nullable();
            $table->string('PicCustomerId')->nullable();
            $table->string('PicRecipientId')->nullable();
            $table->string('AlamatInvoiceId')->nullable();
            $table->string('AlamatDeliveryId')->nullable();
            $table->string('RecipientEmail')->nullable();
            $table->string('EstimasiTime')->nullable();
            $table->string('EstimasiDate')->nullable();
            $table->timestamps();
        });

        Schema::create('tbl_item_goods', function (Blueprint $table) {
            $table->id();
            $table->string('Regno');
            $table->string('Nama');
            $table->string('Spesifikasi');
            $table->string('Qty');
            $table->string('Satuan');
            $table->string('Keterangan');
            $table->timestamps();
        });

        Schema::create('tbl_workflow_applications', function (Blueprint $table) {
            $table->id();
            $table->string('Regno');
            $table->string('WorkflowCurrentCodeId');
            $table->string('WorkflowLastCodeId');
            $table->timestamps();
        });

        Schema::create('tbl_workflow_historys', function (Blueprint $table) {
            $table->id();
            $table->string('Regno');
            $table->string('WorkflowCodeId');
            $table->timestamps();
        });

        Schema::create('ref_workflows', function (Blueprint $table) {
            $table->id();
            $table->string('CodeId');
            $table->string('Deskripsi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_aplikasis');
        Schema::dropIfExists('tbl_document_goods');
        Schema::dropIfExists('tbl_item_goods');
        Schema::dropIfExists('tbl_workflow_applications');
        Schema::dropIfExists('tbl_workflow_historys');
        Schema::dropIfExists('ref_workflows');
    }
};
