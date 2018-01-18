<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTelefone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('phone')) {
            Schema::dropIfExists('phone');
        }
        Schema::create('phone', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->decimal('number',13,0);
            $table->boolean('main')->default(0);
            $table->integer('phone_type_id')->unsigned();
            $table->integer('people_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('phone', function (Blueprint $table) {
            $table->foreign('phone_type_id')->references('id')->on('phone_type');
            $table->foreign('people_id')->references('id')->on('people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phone');
    }
}
