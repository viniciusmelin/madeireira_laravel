<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarPedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
   
        Schema::dropIfExists('order');
        Schema::create('order', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('operation_id')->unsigned();
            $table->integer('situation_id')->unsigned();
            $table->integer('salesman_id')->unsigned();
            $table->text('observation')->nullable();
            $table->decimal('amount')->nullable();
            $table->timestamps();
        });

        Schema::table('order', function (Blueprint $table) {
            $table->foreign('client_id')->references('people_id')->on('client');
            $table->foreign('operation_id')->references('operation_id')->on('operation_situation');
            $table->foreign('situation_id')->references('situation_id')->on('operation_situation');
            $table->foreign('salesman_id')->references('people_id')->on('salesman');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
