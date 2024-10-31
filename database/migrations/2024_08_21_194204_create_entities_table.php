<?php
// MIGRACION DE LA TABLA ENTITIES EN DE SE ALMACENARA LA INFORMACION REKACIONADA A ESTA TABLA
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitiesTable extends Migration
{
    public function up()
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->id();
            $table->string('entity_type', 50);
            $table->string('name', 255);
            $table->string('tax_id', 100)->nullable(); // Número de identificación fiscal
            $table->text('legal_address')->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('email', 255)->nullable();
            $table->unsignedBigInteger('morphable_id');
            $table->string('morphable_type');

            // Información de auditoría
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('entities');
    }
}
