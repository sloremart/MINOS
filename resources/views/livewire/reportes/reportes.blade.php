<div>
    <!-- resources/views/livewire/suppliers/supplier.blade.php -->
    <div >

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Reportes') }}
            </h2>
        </x-slot>
        <!-- <div class="text-right mt-4 z-20 relative max-w-6xl mx-auto">
    <button wire:click="openModal" class="bg-blue-900 text-gray-200 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded inline-flex items-center shadow-md">
        <i class="fa-solid fa-circle-plus mr-2"></i>
        Crear Proveedor
    </button>
</div> -->


        @include("partials.v1.table.primary-table-reporte",[
        "filter_active" => true,
        "search" => "search",
        "search_1" => "search_1",
        "search_placeholder"=>$search_placeholder,
        "search_1_placeholder"=>$search_1_placeholder,
        "table_headers"=>["ID"=>"id",
        "Nombre"=>"name",
        "Documento"=>"document",
        "Correo Electrónico"=>"email",
        "Teléfono"=>"phone",
        "Dirección"=>"address",

        ],
        "table_rows"=>$data
        ])
    </div>

</div>