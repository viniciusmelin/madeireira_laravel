<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarProduto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('product')) {
            Schema::dropIfExists('product');
        }
        Schema::create('product', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('description',80);
            $table->boolean('active')->default(1);
            $table->decimal('width',10,3)->nullable();
            $table->decimal('height',10,3)->nullable();
            $table->decimal('deep',10,3)->nullable();
            $table->decimal('amount_min',10,0)->nullable();
            $table->decimal('cubing',10,3)->nullable();
            $table->decimal('amount',10,0);
            $table->decimal('price',10,2);
            $table->decimal('price_sale',10,2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
