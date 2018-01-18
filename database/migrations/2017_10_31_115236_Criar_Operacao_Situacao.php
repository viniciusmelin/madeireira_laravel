<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CriarOperacaoSituacao extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('operation_situation')) {
            Schema::dropIfExists('operation_situation');
        }
        Schema::create('operation_situation', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('operation_id')->unsigned();
            $table->integer('situation_id')->unsigned();
        });

        Schema::table('operation_situation', function (Blueprint $table) {
            
            $table->foreign('operation_id')->references('id')->on('operation');
            $table->foreign('situation_id')->references('id')->on('situation');
            $table->primary(['operation_id','situation_id']);

        });

        DB::table('operation_situation')->insert(
            [
                ['operation_id'=>1,'situation_id'=>1],
                ['operation_id'=>1,'situation_id'=>2],
                ['operation_id'=>1,'situation_id'=>3],
                ['operation_id'=>2,'situation_id'=>1],
                ['operation_id'=>2,'situation_id'=>2],
                ['operation_id'=>2,'situation_id'=>3],
                
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
        Schema::dropIfExists('operation_status');
    }
}
