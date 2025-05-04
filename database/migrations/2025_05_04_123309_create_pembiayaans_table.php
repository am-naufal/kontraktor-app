<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('pembiayaans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_user')->constrained('users')->onDelete('cascade'); // mandor
        $table->foreignId('id_proyek')->constrained('proyeks')->onDelete('cascade');
        $table->date('tanggal');
        $table->decimal('jumlah', 15, 2);
        $table->string('keterangan')->nullable();
        $table->string('bukti')->nullable(); // foto bukti
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembiayaans');
    }
};
