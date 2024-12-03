<?php
// MIGRACION DE LA TABLA UNITS EN DE SE ALMACENARA LA INFORMACION REKACIONADA A ESTA TABLA
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
        // Insertar registros iniciales
        DB::table('units')->insert([
            [
                'name' => 'Kilogramo',
                'abbreviation' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Litro',
                'abbreviation' => 'L',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Unidad',
                'abbreviation' => 'u',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Metro',
                'abbreviation' => 'm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Caja',
                'abbreviation' => 'caja',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
    

    public function down()
    {
        Schema::dropIfExists('units');
    }
}
