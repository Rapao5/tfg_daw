<?php

use App\Enums\IncidenciaStatus;
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
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->timestamp('fecha');
            $table->foreignId('ordenador_id')->constrained('ordenadores')->cascadeOnDelete();
            $table->enum("status", IncidenciaStatus::values())->default(IncidenciaStatus::PENDIENTE);
            $table->boolean('resuelto')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidencias');
    }
};