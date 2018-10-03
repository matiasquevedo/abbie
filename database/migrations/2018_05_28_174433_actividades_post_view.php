<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActividadesPostView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement("CREATE VIEW actividadespostview AS SELECT actividades.id,
            actividades.title,
            actividades.volanta,
            actividades.descripcion,
            actividades.recomendacion,
            actividades.duracion,
            actividades.largo,
            actividades.state,
            images.foto,
            categories.name, 
            actividades.created_at, actividades.updated_at
            FROM actividades, images, categories WHERE state = '1'
            AND categories.id = actividades.category_id
            AND images.actividad_id = actividades.id
            ORDER BY actividades.updated_at DESC;");
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
