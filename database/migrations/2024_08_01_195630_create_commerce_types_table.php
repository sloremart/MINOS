<?php
// MIGRACION DE LA TABLA CREATE COMERCE TUPES EN DE SE ALMACENARA LA INFORMACION REKACIONADA A ESTA TABLA
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCommerceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commerce_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
        // Insertar el registro genérico
        DB::table('commerce_types')->insert([
            'name' => 'Tienda de barrio',
            'created_at' => now(), // Fecha y hora actuales
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commerce_types');
    }
}

