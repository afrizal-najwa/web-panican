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
        Schema::create('timbulan_sampah', function (Blueprint $table) {
            $table->id();
            $table->string('kategori'); // Desa, Perumahan, Wilayah Lain
            $table->string('nama'); // Nama Desa atau Perumahan
            $table->integer('jumlah'); // Timbulan sampah dalam ton
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timbulan_sampah');
    }
};
