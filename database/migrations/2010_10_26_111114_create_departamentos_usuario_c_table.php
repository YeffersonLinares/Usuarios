<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartamentosUsuarioCTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('centralizado')->create('departamentos_usuario', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->bigInteger('tipo_documento')->unsigned();
            $table->bigInteger('id_departamento')->unsigned();
            $table->foreign('id_departamento')->references('id')->on('departamentos');
            $table->bigInteger('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id')->on('usuarios');
            $table->boolean('estado')->default(1);
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
        Schema::connection('centralizado')->dropIfExists('departamentos_usuario');
    }
}
