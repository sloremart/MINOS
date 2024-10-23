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
        Schema::create('cash_closures', function (Blueprint $table) {
            $table->id(); // ID único del cierre de caja
            $table->unsignedBigInteger('user_id'); // ID del cajero (relacionado con la tabla users o employees)
            $table->decimal('start_balance', 10, 2)->nullable(); // Saldo inicial al comenzar el turno o día
            $table->decimal('total_sales_cash', 10, 2)->default(0); // Total de ventas en efectivo
            $table->decimal('total_sales_card', 10, 2)->default(0); // Total de ventas con tarjeta
            $table->decimal('total_sales_transfer', 10, 2)->default(0); // Total de ventas por transferencia
            $table->decimal('total_expenses', 10, 2)->default(0); // Total de egresos
            $table->decimal('final_balance_cash', 10, 2)->nullable(); // Saldo final en efectivo
            $table->decimal('final_balance_card', 10, 2)->nullable(); // Saldo final esperado de tarjetas
            $table->decimal('final_balance_transfer', 10, 2)->nullable(); // Saldo final esperado de transferencias
            $table->decimal('total_sales', 10, 2)->nullable(); // Ajusta según sea necesario
            $table->decimal('final_balance', 10, 2)->nullable(); // Ajusta según sea necesario
            $table->timestamp('closing_date_time')->useCurrent();// Fecha y hora del cierre de caja
            $table->decimal('next_start_balance', 10, 2)->nullable(); // Saldo inicial para el próximo turno
            $table->timestamps(); // created_at y updated_at

            // Relación con la tabla de usuarios (cashier_id)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_closures');
    }
};
