<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarVendedor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('salesman')) {
            Schema::dropIfExists('salesman');
        }
        Schema::create('salesman', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('people_id')->unsigned();
            $table->timestamp('date_register');
            $table->timestamps();
        });

        Schema::table('salesman', function (Blueprint $table) {
            $table->primary('people_id');
            $table->foreign('people_id')->references('id')->on('people')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salesman');
    }
}
