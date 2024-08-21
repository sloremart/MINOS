<!-- resources/views/livewire/prices/price.blade.php -->
<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de precios') }}
        </h2>
    </x-slot>
    <div class="text-right z-20 relative max-w-6xl mx-auto">
        <button wire:click="openModal" class="bg-blue-900 text-gray-200 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded inline-flex items-center shadow-md">
            <i class="fa-solid fa-circle-plus mr-2"></i>
            Crear Precio
        </button>
    </div>

    @include("partials.v1.table.primary-table",[
               "table_headers"=>["ID"=>"id",
                                 "Producto"=>"product_id",
                                 "Usuario"=>"user_id",
                                 "Precio"=>"price",
                                 "Activo"=>"active",
                                 "Fecha de Inicio"=>"valid_from_date",
                                 "Fecha de Creación"=>"created_at",


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
            <div class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-2xl sm:w-full z-10">

                <div class="bg-blue-900 text-gray-200 bg-opacity-75 px-4 py-3 sm:px-6 rounded-t-lg">
                    <div class="flex flex-col items-center w-full">
                        <div class="text-sm text-gray-200 mb-2 self-end">
                            {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                        </div>
                        <h3 class="text-lg leading-6 font-medium text-gray-200 text-center w-full" id="modal-title">
                            {{ ($action == 'create')?'CREAR PRECIO': (($action == 'edit') ? 'EDITAR PRECIO' : 'DETALLES DEL PRECIO') }}
                        </h3>
                    </div>
                </div>

                <!-- Cuerpo del Modal -->
                @include("partials.v1.form.primary_form",[
                    "form_toast"=>false,
                    "form_grid_col"=>3,
                    "session_message"=>"message",
                    "form_submit_action"=>"submitForm",
                    "show_form_submit_action"=>false,
                    "form_inputs"=>[

                        [
                            "input_type"=>"select",
                            "input_model"=>"modelForm.product_id",
                            "icon_class"=>"fas fa-box",
                            "placeholder"=>"Producto",
                            "input_field"=>"Producto",
                            "options"=>$products, // Asume que $products es un array pasado a la vista con los productos disponibles
                            "option_value_field"=>"id",
                            "option_display_field"=>"name",
                            "col_with"=>2,
                            "required"=>true,
                            "disabled"=>$action == 'details',
                        ],
                        [
                            "input_type"=>"select",
                            "input_model"=>"modelForm.user_id",
                            "icon_class"=>"fas fa-user",
                            "placeholder"=>"Usuario",
                            "input_field"=>"Usuario",
                            "options"=>$users, // Asume que $users es un array pasado a la vista con los usuarios disponibles
                            "option_value_field"=>"id",
                            "option_display_field"=>"name",
                            "col_with"=>2,
                            "required"=>true,
                            "disabled"=>$action == 'details',
                        ],
                        [
                            "input_type"=>"text",
                            "input_model"=>"modelForm.price",
                            "icon_class"=>"fas fa-dollar-sign",
                            "placeholder"=>"Precio",
                            "input_field"=>"Precio",
                            "col_with"=>1,
                            "required"=>true,
                            "disabled"=>$action == 'details',
                        ],
                        [
                            "input_type"=>"checkbox",
                            "input_model"=>"modelForm.active",
                            "icon_class"=>"fas fa-check",
                            "placeholder"=>"Activo",
                            "input_field"=>"Activo",
                            "col_with"=>1,
                            "required"=>true,
                            "disabled"=>$action == 'details',
                        ],
                        [
                            "input_type"=>"date",
                            "input_model"=>"modelForm.valid_from_date",
                            "icon_class"=>"fas fa-calendar-alt",
                            "placeholder"=>"Fecha de Inicio",
                            "input_field"=>"Fecha de Inicio",
                            "col_with"=>1,
                            "required"=>true,
                            "disabled"=>$action == 'details',
                        ]

                    ]
                ])

                <!-- Pie del Modal -->
                <div class="text-gray-200 bg-opacity-75 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-lg">
                    @if($action != 'details')
                        <button wire:click="submitForm()" type="submit" class="bg-blue-900 text-gray-200 inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">
                            Guardar
                        </button>
                    @endif
                    <button wire:click="closeModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    @endif

</div>
