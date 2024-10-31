<?php
// MIGRACION DE LA TABLA VAT PERCENTAGES EN DE SE ALMACENARA LA INFORMACION REKACIONADA A ESTA TABLA
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVatPercentagesTable extends Migration
{
    public function up()
    {
        Schema::create('vat_percentages', function (Blueprint $table) {
            $table->id();
            $table->decimal('percentage', 5, 2);
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Para Soft Deletes
        });
    }

    public function down()
    {
        Schema::dropIfExists('vat_percentages');
    }
}
