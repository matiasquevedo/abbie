nnnnn<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('state',['0','1','2'])->default('0');
            $table->string('title');
            $table->string('volanta');
            $table->string('duracion');
            $table->string('largo');
            $table->longText('descripcion');

            $table->longText('recomendacion'); 

            $table->string('precioPublico');
            $table->string('descuento');
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();

            //llaves foraneas
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('actividades');
    }
}