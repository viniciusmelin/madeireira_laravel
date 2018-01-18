<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarPedidoItem extends Migration
{   
     /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
       if (Schema::hasTable('order_item')) {
           Schema::dropIfExists('order_item');
       }
       Schema::create('order_item', function (Blueprint $table) {
           $table->engine = 'InnoDB';
           $table->increments('id');
           $table->integer('product_id')->unsigned();
           $table->integer('order_id')->unsigned();
           $table->decimal('amount',8,2);
           $table->decimal('price',8,2);
           $table->timestamps();
       });

       Schema::table('order_item', function (Blueprint $table) {
           $table->foreign('product_id')->references('id')->on('product');
           $table->foreign('order_id')->references('id')->on('order');
       });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
       Schema::dropIfExists('order_item');
   }
}
