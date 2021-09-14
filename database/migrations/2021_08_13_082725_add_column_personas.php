<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPersonas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('centralizado')->table('personas', function (Blueprint $table)
        {
            $table->string('tarjeta_profesional', 60)
                ->after('numero_documento')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('centralizado')->table('personas', function (Blueprint $table) {
            $table->dropColumn('tarjeta_profesional');
        });
    }
}
