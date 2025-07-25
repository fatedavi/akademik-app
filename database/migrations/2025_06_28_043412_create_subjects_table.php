<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Subject name (e.g., Math, English, Science)
            $table->timestamps();
            $table->foreignId('guru_id')->constrained('gurus')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
