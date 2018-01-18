<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CriarSituacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('situation')) {
            Schema::dropIfExists('situation');
        }

        Schema::create('situation', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('description',20);
            $table->timestamps();
        });

        DB::table('situation')->insert(
            [
                ['description'=>'Cancelado'],
                ['description'=>'Aberto'],
                ['description'=>'Finalizado'],

            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('situation');
    }
}
