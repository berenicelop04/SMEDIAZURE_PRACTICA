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
        Schema::create('ubicacion_antenas', function (Blueprint $table) {
            $table->id('id_antena');
            $table->unsignedBigInteger('id_localidad');
            $table->unsignedBigInteger('id_municipio');
            $table->unsignedBigInteger('id_estado_energia');
            $table->unsignedBigInteger('id_dispositivo');
            $table->string('ip');
            $table->string('latitud');
            $table->string('longitud');
            $table->timestamps();

            $table->foreign('id_localidad')->references('id_localidad')->on('localidades');
            $table->foreign('id_municipio')->references('id_municipio')->on('municipios');
            $table->foreign('id_estado_energia')->references('id_estado_energia')->on('estado_energia');
            $table->foreign('id_dispositivo')->references('id_dispositivo')->on('dispositivos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubicacion_antenas');
    }
};
