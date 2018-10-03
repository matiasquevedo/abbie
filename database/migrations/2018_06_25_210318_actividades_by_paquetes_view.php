<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActividadesByPaquetesView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement("CREATE VIEW actividadespaquetes AS SELECT actividades.id,  actividades.title, actividades.descripcion,
            actividades.recomendacion, actividadPaquete.actividad_id,actividadPaquete.paquete_id 
            FROM actividades, actividadPaquete 
            WHERE actividadPaquete.actividad_id = actividades.id;");
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
