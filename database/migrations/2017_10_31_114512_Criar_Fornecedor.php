<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarFornecedor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // if (Schema::hasTable('provider')) {
        //     Schema::dropIfExists('provider');
        // }
        // Schema::create('provider', function (Blueprint $table) {
        //     $table->integer('people_id')->unsigned();
        //     $table->string('ie');
        //     $table->timestamp('date_register');
        //     $table->timestamps();
        // });
        // Schema::table('provider', function (Blueprint $table) {
        //     $table->primary('people_id');
        //     $table->foreign('people_id')->references('id')->on('people')->OnDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('provider');
    }
}
