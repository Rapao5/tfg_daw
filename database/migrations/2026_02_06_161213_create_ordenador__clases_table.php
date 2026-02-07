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
        Schema::create('ordenador_clase', function (Blueprint $table) {
            $table->id();
            $table->foreignId("ordenador_id")->constrained("ordenador")->onDelete("cascade");
            $table->foreignId("clase_id")->constrained("clase")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenador__clase');
    }
};
