<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartamentosCTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('centralizado')->create('departamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',255);
            $table->string('nombre_db',255);
            $table->string('url_logo',255)->nullable();
            $table->string('url_produccion',255)->nullable();
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
        Schema::connection('centralizado')->dropIfExists('departamentos');
    }
}
