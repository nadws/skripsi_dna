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
        Schema::create('peminjaman_assets', function (Blueprint $table) {
            $table->id();
            $table->integer('karyawan_id');
            $table->integer('barang_id');
            $table->string('invoice');
            $table->date('tgl_pinjam');
            $table->double('qty');
            $table->double('qty_disposal');
            $table->double('qty_pengembalian');
            $table->double('urutan');
            $table->string('ket');
            $table->integer('cabang_id');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('ket_presiden')->nullable();
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_assets');
    }
};
