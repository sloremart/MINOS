<?php
// MIGRACION DE LA TABLA SALES EN DE SE ALMACENARA LA INFORMACION REKACIONADA A ESTA TABLA
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('user_id')->constrained('users');
            $table->date('sale_date');
            $table->decimal('total_amount', 10, 2);
            $table->text('details')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Para Soft Deletes
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
