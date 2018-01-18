<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarEndereco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('address')) {
            Schema::dropIfExists('address');
        }
        Schema::create('address', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('people_id')->unsigned();
            $table->string('street');
            $table->smallInteger('number');
            $table->string('complement')->nullable();
            $table->string('neighborhood');
            $table->string('zip_code');
            $table->string('city');
            $table->timestamps();
        });

        Schema::table('address', function (Blueprint $table) {
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
        Schema::dropIfExists('address');
    }
}
