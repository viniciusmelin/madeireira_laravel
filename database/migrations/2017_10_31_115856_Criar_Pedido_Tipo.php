<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CriarPedidoTipo extends Migration
{
       /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('order_type')) {
            Schema::dropIfExists('order_type');
        }
        Schema::create('order_type', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('description',25);
            $table->timestamps();
        });
        DB::table('order_type')->insert([
            ['description'=>"Pedido"],
            ['description'=>"Orçamento"]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_type');
    }
}
