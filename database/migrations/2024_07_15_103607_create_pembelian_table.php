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
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 32);
            $table->bigInteger('supplier_id')->unsigned();
            $table->bigInteger('kategori_id')->unsigned();
            $table->string('nama', 60);
            $table->string('harga', 40);
            $table->string('satuan', 25);
            $table->string('qty', 40);
            $table->string('foto', 120)->nullable();
            $table->date('tanggal');
            $table->timestamps();
            $table->foreign('supplier_id')->references('id')->on('supplier')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian');
    }
};
