<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('user_id')->constrained('users');
            $table->decimal('price', 10, 2);
            $table->boolean('active')->default(false);
            $table->date('valid_from_date');
            $table->timestamps();
            $table->softDeletes(); // Para Soft Deletes
        });
    }

    public function down()
    {
        Schema::dropIfExists('prices');
    }
}
