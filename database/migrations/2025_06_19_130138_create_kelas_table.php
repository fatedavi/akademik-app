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
    Schema::create('kelas', function (Blueprint $table) {
        $table->id();
        $table->string('nama'); // Misal: "X RPL 1"
        $table->foreignId('tingkat_id')->constrained('tingkat')->onDelete('cascade');
        $table->foreignId('jurusan_id')->constrained('jurusans')->onDelete('cascade');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
