<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarContaReceber extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (Schema::hasTable('account_recive')) {
            Schema::dropIfExists('account_recive');
        }

           Schema::create('account_recive',function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('birth_pay');
            $table->date('date_lan');
            $table->date('date_ven');
            $table->integer('account_status_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('salesman_id')->unsigned();
            $table->unsignedInteger('order_id')->nullable();
            $table->unsignedInteger('type_payment_id')->nullable();
            $table->unsignedInteger('discounts_id')->nullable();
            $table->integer('account_type_id')->unsigned();
            $table->decimal('amount',10,2);
            $table->decimal('descont',10,2);
            $table->decimal('amount_pay',10,2);
            $table->timestamps();
        });
        
        
        Schema::table('account_recive',function(Blueprint $table){
            $table->foreign('account_status_id')->references('id')->on('account_status');
            $table->foreign('client_id')->references('people_id')->on('client');
            $table->foreign('salesman_id')->references('people_id')->on('salesman');
            $table->foreign('order_id')->references('id')->on('order');
            $table->foreign('type_payment_id')->references('id')->on('type_payment');
            $table->foreign('discounts_id')->references('id')->on('discounts');
            $table->foreign('account_type_id')->references('id')->on('account_type');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('account_recive',function(Blueprint $table){
            $table->dropForeign('account_status_id');
            $table->dropForeign('people_id');
            $table->dropForeign('salesmen_id');
            $table->dropForeign('order_id');
            $table->dropForeign('type_payment_id');
            $table->dropForeign('account_source_id');
            
        });

        
        
       Schema::dropIfExists('account_recive');
    }
}
