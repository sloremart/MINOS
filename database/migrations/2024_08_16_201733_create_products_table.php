<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->boolean('applies_iva');
            $table->foreignId('vat_percentage_id')->constrained('vat_percentages');
            $table->foreignId('unit_id')->constrained('units');
            $table->foreignId('category_id')->constrained('trade_categories');
            $table->foreignId('subgroup_id')->constrained('subgroups');
            $table->timestamps();
            $table->softDeletes(); // Para Soft Deletes
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
