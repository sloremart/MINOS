
<!-- resources/views/livewire/suppliers/supplier.blade.php -->
<div>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Listado de proveedores') }}
    </h2>
</x-slot>

    @livewire('components.index-models.supplier-index', [
        'data' => $data,
        'button_add' => true,
        'button_label' => 'Crear nuevo',
        'button_color' => 'bg-green-500 hover:bg-green-400 focus:bg-green-400 active:bg-green-600',
        'table_headers' => [
              [
                   "col_name" =>"ID",
                   "col_data" =>"id"
               ],
               [
                   "col_name" =>"Documento",
                   "col_data" =>"document"
               ],
               [
                   "col_name" =>"Nombre",
                   "col_data" =>"name"
               ],
               [
                   "col_name" =>"Correo electronico",
                   "col_data" =>"email"
               ],
               [
                   "col_name" =>"Telefono",
                   "col_data" =>"phone"
               ],
                ],
        'actions' => [
            [
                'method' => 'insert',
                'icon' => 'M5 13l4 4L19 7', // Icono de editar (Heroicons)
            ],
            [
                'method' => 'delete',
                'icon' => 'M6 18L18 6M6 6l12 12', // Icono de eliminar (Heroicons)
            ],
        ],
    ])

<
