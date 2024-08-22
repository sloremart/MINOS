@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 leading-tight mb-6 text-center">AGREGAR VENTA</h2>

            <!-- Formulario para seleccionar e ingresar el nombre del cliente -->
            <div class="grid grid-cols-3 gap-4 mb-6">

                <!-- Select para buscar cliente -->
                <div class="col-span-2">
                    <x-input.label for="customer_id">
                        <x-slot name="label">Cliente</x-slot>
                        <x-input.select
                            id="customer_id"
                            wire:model="selectedCustomer"
                            :options="$customers"
                            option-value-field="id"
                            option-display-field="name"
                            placeholder="Buscar cliente"
                        />
                    </x-input.label>
                </div>

                <!-- Input para el nombre del cliente -->
                <div class="col-span-1">
                    <x-input.label for="customer_name">
                        <x-slot name="label">Nombre</x-slot>
                        <x-input.text id="customer_name" wire:model="customerName" placeholder="Nombre del Cliente" />
                    </x-input.label>
                </div>

            </div>

            <!-- Botón para continuar o procesar la venta -->
            <div class="mt-6 flex justify-end space-x-4">
                <button class="bg-blue-900 text-white font-bold py-2 px-4 rounded shadow">
                    Continuar
                </button>
            </div>

        </div>
    </div>
@endsection
