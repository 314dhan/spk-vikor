<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vikor_calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alternatif_id')->constrained('alternatifs')->onDelete('cascade');
            $table->decimal('nilai_s', 10, 4);
            $table->decimal('nilai_r', 10, 4);
            $table->decimal('nilai_q', 10, 4);
            $table->unsignedInteger('ranking')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vikor_calculations');
    }
};
