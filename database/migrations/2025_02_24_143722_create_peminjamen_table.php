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
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constained('users')->ondelete('cascade');
            $table->foreignId('barang_id')->constained('barangs')->ondelete('cascade');
            $table->string('quantity');
            $table->enum('status', ['Pinjam', 'Selesai'])->default('Pinjam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
