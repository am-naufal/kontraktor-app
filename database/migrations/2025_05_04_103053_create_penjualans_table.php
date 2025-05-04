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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_proyek')->constrained('proyeks')->onDelete('cascade');
            $table->date('tanggal_penjualan');
            $table->integer('total_barang');
            $table->decimal('total_harga', 12, 2);
            $table->string('foto')->nullable(); // untuk upload bukti/foto penjualan
            $table->text('keterangan')->nullable(); // catatan tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
