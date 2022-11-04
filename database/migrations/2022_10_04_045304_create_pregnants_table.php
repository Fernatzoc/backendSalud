<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregnants', function (Blueprint $table) {
            $table->id();
            $table->string('cui');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('direccion');
            $table->string('fecha_de_nacimiento');
            $table->string('tipo_de_examen');
            $table->string('ultima_regla');
            $table->string('peso');
            $table->string('altura');
            $table->string('cmb');
            $table->tinyInteger('estado')->default(1);
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pregnants');
    }
};
