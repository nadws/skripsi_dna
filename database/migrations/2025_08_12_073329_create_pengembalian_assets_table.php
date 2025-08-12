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
        Schema::create('pengembalian_assets', function (Blueprint $table) {
            $table->id();
            $table->integer('peminjaman_id');
            $table->integer('barang_id');
            $table->integer('cabang_id');
            $table->date('tgl_pengembalian');
            $table->double('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian_assets');
    }
};
