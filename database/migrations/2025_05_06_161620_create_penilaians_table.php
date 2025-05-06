<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaiansTable extends Migration
{
    public function up()
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alternatif_id')->constrained()->onDelete('cascade');
            $table->foreignId('kriteria_id')->constrained()->onDelete('cascade');
            $table->float('nilai');
            $table->timestamps();

            $table->unique(['alternatif_id', 'kriteria_id']); // Untuk mencegah duplikasi penilaian
        });
    }

    public function down()
    {
        Schema::dropIfExists('penilaians');
    }
}
