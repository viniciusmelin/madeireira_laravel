<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CriarContasReceberTipo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->enum('type',['Receber','Pagar']);
            $table->timestamps();
        });

        DB::table('account_type')->insert([
            ['description'=>"Pedido",'type'=>'Receber'],
            ['description'=>"Outros",'type'=>'Receber']
        ]);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_type');
    }
}
