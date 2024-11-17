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
        Schema::create('komposisi_sampah', function (Blueprint $table) {
            $table->id();
            $table->string('kategori'); // Organik, Anorganik/Plastik, Residu
            $table->integer('jumlah'); // Jumlah sampah
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komposisi_sampah');
    }
};
