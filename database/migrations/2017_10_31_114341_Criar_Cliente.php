<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('client')) {
            Schema::dropIfExists('client');
        }
        Schema::create('client',function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->integer('people_id')->unsigned();
            $table->timestamp('birth_register');
            $table->date('birth_date');
            $table->decimal('limitmin',12,2)->nullable();
            $table->decimal('limitmax',12,2)->nullable();
            
        });
        
        Schema::table('client',function(Blueprint $table){
            
            $table->foreign('people_id')->references('id')->on('people')->onDelete('cascade');
            $table->primary('people_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client');
    }
}
