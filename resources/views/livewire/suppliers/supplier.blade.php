
<!-- resources/views/livewire/suppliers/supplier.blade.php -->
<div>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Listado de proveedores') }}
    </h2>
</x-slot>
    <div class="text-right z-20 mt-16 relative max-w-6xl mx-auto">
        <button wire:click="openModal" class="bg-blue-900 text-gray-200 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded inline-flex items-center shadow-md">
            <i class="fa-solid fa-circle-plus mr-2"></i>
            Crear Proveedor
        </button>
    </div>

    @include("partials.v1.table.primary-table",[
               "table_headers"=>["ID"=>"id",
                                 "Nombre"=>"name",
                                 "Documento"=>"document",
                                 "Telefono"=>"phone",


                ],
                 "table_actions"=>[
                                   "edit"=>"edit",
                                   "delete"=>"delete",
                                   "details"=>"details",
                                    ],

               "table_rows"=>$data
           ])

    @if($isOpen)
        <div class="fixed z-50 inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-xl sm:w-full z-10" style="background-image: url('/images/icono_central.png'); background-size: 45%; background-repeat: no-repeat; background-position: center;">

                <!-- Aquí está la parte superior azul con el título centrado -->
                <div class="bg-blue-900 text-gray-200 bg-opacity-75 px-4 py-3 sm:px-6 rounded-t-lg">
                    <div class="flex flex-col items-center w-full">
                        <!-- Fecha actual -->
                        <div class="text-sm text-gray-200 mb-2 self-end">
                            {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                        </div>

                        <h3 class="text-lg leading-6 font-medium text-gray-200 text-center w-full" id="modal-title">
                            {{ 'CREAR PROVEEDOR' }}
                        </h3>
                    </div>
                </div>

                <!-- Cuerpo del Modal con Fondo -->
                @include("partials.v1.form.primary_form",[
            "form_toast"=>false,
            "form_grid_col"=>3,
            "session_message"=>"message",
            "form_submit_action"=>"submitForm",
            "show_form_submit_action"=>true,
            "form_inputs"=>[

                             [
                                        "input_type"=>"checkbox",
                                        "input_model"=>"modelForm.name",
                                        "icon_class"=>"",
                                        "placeholder"=>"Nombre",
                                        "input_field"=>"Nombre",
                                        "col_with"=>2,
                                        "required"=>true
                            ],

                                 [
                                        "input_type"=>"text",
                                        "input_model"=>"modelForm.document",
                                        "icon_class"=>"fa-sharp fa-solid fa-address-card",
                                        "placeholder"=>"Documento",
                                        "input_field"=>"Documento",
                                        "col_with"=>1,
                                        "required"=>true
                            ],
                             [
                                        "input_type"=>"text",
                                        "input_model"=>"modelForm.phone",
                                        "icon_class"=>"fa-sharp fa-solid fa-phone-volume",
                                        "placeholder"=>"Telefono",
                                        "input_field"=>"Telefono",
                                        "col_with"=>1,
                                        "required"=>true
                            ], [
                                        "input_type"=>"text",
                                        "input_model"=>"modelForm.address",
                                        "icon_class"=>"fa-solid fa-location-dot",
                                        "placeholder"=>"Direcciòn",
                                        "input_field"=>"Direcciòn",
                                        "col_with"=>2,
                                        "required"=>true
                            ]



                         ]
                 ])

                <!-- Pie del Modal -->

            </div>
        </div>
    @endif

</div>
