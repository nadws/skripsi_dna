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
        Schema::create('permintaan_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->integer('barang_id');
            $table->integer('cabang_id');
            $table->double('jumlah');
            $table->enum('kategori', ['pembelian', 'overstock']);
            $table->string('keterangan');
            $table->timestamps();
        });
        Schema::create('pembelian_barangs', function (Blueprint $table) {
            $table->string('invoice')->primary();
            $table->integer('barang_id');
            $table->integer('cabang_id');
            $table->integer('suplier_id');
            $table->double('jumlah');
            $table->double('harga_satuan');
            $table->timestamps();
        });
        Schema::create('over_barangs', function (Blueprint $table) {
            $table->string('invoice')->primary();
            $table->integer('barang_id');
            $table->integer('ke_cabang_id');
            $table->integer('dari_cabang_id');
            $table->double('jumlah');
            $table->double('harga_satuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_barangs');
    }
};
