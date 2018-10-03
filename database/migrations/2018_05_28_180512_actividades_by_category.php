<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActividadesByCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement("CREATE VIEW categoryactividadespost AS SELECT actividades.id 
                        AS actividades, 
                        images.foto, 
                        actividades.state, 
                        actividades.title,
                        actividades.precioPublico,
                        actividades.descuento, 
                        categories.name, 
                        categories.id 
                        AS category_id, 
                        actividades.created_at 
                        FROM actividades, categories, images 
                        WHERE state = '1' 
                        AND categories.id = actividades.category_id 
                        AND images.actividad_id = actividades.id 
                        ORDER BY actividad_id DESC;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
