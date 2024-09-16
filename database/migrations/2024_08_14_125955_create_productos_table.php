<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('categoria');
            $table->string('name', 255);
            $table->integer('stock');
            $table->string('unidadMedida');
            $table->decimal('valorU', 10, 2)->default(0);
            $table->decimal('valorT', 10, 2)->default(0);
            $table->string('barcode', 25)->nullable();
            $table->string('image', 100)->nullable();
            $table->unsignedBigInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
