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
        Schema::create('perbaikan_assets', function (Blueprint $table) {
            $table->id();
            $table->integer('barang_id');
            $table->integer('cabang_id');
            $table->integer('vendor_id');
            $table->integer('karyawan_id')->nullable();
            $table->double('jumlah');
            $table->double('biaya');
            $table->text('keterangan');
            $table->enum('from', ['cabang', 'user']);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->date('tgl_perbaikan');
            $table->date('tgl_estimasi');
            $table->string('ket_presiden')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbaikan_assets');
    }
};
