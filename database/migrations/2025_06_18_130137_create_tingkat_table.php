<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tingkat', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Contoh: "X", "XI", "XII"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tingkat');
    }
};
