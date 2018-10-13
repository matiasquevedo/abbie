<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaquetesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('paquetes', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('state',['0','1','2'])->default('0');
            $table->string('title');
            $table->longText('descripcion');
            $table->string('precioCliente');
            $table->string('descuento');
            $table->string('fechaInicio');
            $table->string('fechaTermino');
            $table->integer('user_id')->unsigned();
            

            //llaves foraneas
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        //
        Schema::dropIfExists('paquetes');
    }
}
