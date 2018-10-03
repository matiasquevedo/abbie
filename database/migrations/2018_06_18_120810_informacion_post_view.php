<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InformacionPostView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement("CREATE VIEW informacionespost AS SELECT informaciones.id,
            informaciones.title,
            informaciones.descripcion,
            informaciones.state,
            categories.name, 
            informaciones.created_at, informaciones.updated_at
            FROM informaciones, categories 
            WHERE state = '1'
            AND categories.id = informaciones.category_id
            ORDER BY informaciones.updated_at DESC;");
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
