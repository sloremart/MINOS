<?php
// MIGRACION DE LA TABLA UNITS EN DE SE ALMACENARA LA INFORMACION REKACIONADA A ESTA TABLA
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('abbreviation');
            $table->timestamps();
            $table->softDeletes(); // Para Soft Deletes
        });
    }

    public function down()
    {
        Schema::dropIfExists('units');
    }
}
