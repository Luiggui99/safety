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
        Schema::create('formularios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 25);
            $table->string('placeholder', 25);
            $table->string('identificador', 10);
            $table->boolean('requerido');
            $table->string('tipo', 15)->comment('1 = corto, 2 = largo');
            $table->string('tipo_campo', 10);
            $table->integer('orden');
            $table->boolean('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formularios');
    }
};
