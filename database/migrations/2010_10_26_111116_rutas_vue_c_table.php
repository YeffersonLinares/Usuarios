<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RutasVueCTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('centralizado')->create('rutas_vue', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('path');
            $table->string('name');
            $table->string('component');
            $table->string('variable')->nullable();
            $table->boolean('estado')->default('1');
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
        Schema::connection('centralizado')->dropIfExists('rutas_vue');
    }
}
