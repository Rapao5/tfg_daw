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
        Schema::create('clase_alumno_curso', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ordernador_clase_id')->constrained('ordenador_clase')->onDelete('cascade');
            $table->foreignId('alumno_curso_id')->constrained('alumno_curso')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clase_alumno_curso');
    }
};
