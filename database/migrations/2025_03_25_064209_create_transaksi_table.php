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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->string('nama_lengkap');
            $table->text('alamat');
            $table->string('no_telp');
            $table->decimal('jumlah_harga', 10, 3);
            $table->enum('status', ['pending','sedang dalam pengerjaan', 'selesai', 'diantar']);
            $table->foreignId('user_id')->references('id_user')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
