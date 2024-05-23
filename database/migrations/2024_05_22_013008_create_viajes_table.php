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
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_paquete');
            $table->unsignedBigInteger('id_cliente');
            $table->datetime('fecha_reserva');
            $table->integer('cantidad_personas');
            $table->integer('total');
            $table->string('estado');
            $table->timestamps();

            $table->foreign('id_cliente')
            ->references('id')
            ->on('clientes');

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
        Schema::dropIfExists('viajes');
    }
};
