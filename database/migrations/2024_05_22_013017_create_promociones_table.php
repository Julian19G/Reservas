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
        Schema::create('promociones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_paquete');
            $table->integer('descuento');
            $table->datetime('fecha_inicio');
            $table->datetime('fecha_fin');
            $table->timestamps();

            
            $table->foreign('id_paquete')
            ->references('id')
            ->on('paquetes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promociones');
    }
};
