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
        Schema::create('layanan', function (Blueprint $table) {
            $table->id('id_layanan');
            $table->string('jenis_barang');
            $table->string('kategori');
            $table->decimal('harga', 10,3);
            $table->foreignId('paket_id')->references('id_paket')->on('paket')->onDelete('cascade');
            $table->foreignId('no_layanan_id')->references('id_no_layanan')->on('no_layanan')->onDelete('cascade');
            $table->foreignId('jenis_layanan_id')->references('id_jenis_layanan')->on('jenis_layanan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};
