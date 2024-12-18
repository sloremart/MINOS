<?php
// MIGRACION DE LA TABLA INVENTORIES EN DE SE ALMACENARA LA INFORMACION REKACIONADA A ESTA TABLA
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->integer('quantity');
            $table->date('last_updated_date');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
            $table->softDeletes(); // Para Soft Deletes
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
