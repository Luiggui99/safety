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
        Schema::create('section_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained()->onDelete('cascade');
            $table->string('titulo')->nullable();
            $table->string('subtitulo')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('contenido')->nullable();
            $table->string('imagen')->nullable();
            $table->string('boton_nombre')->nullable();
            $table->string('boton_color')->nullable();
            $table->string('boton_icon')->nullable();
            $table->string('boton_url')->nullable();
            $table->boolean('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_items');
    }
};
