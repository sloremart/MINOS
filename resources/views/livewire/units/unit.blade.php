<!-- resources/views/livewire/units/unit.blade.php -->
<div>

    
    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center" style="font-size: 34px">
        {{ __('Listado de unidades') }}
    </h2>
    <div class="text-right z-20 relative max-w-6xl mx-auto">
        <button wire:click="openModal" class="bg-blue-900 mt-10 text-gray-200 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded inline-flex items-center shadow-md" >
            <i class="fa-solid fa-circle-plus mr-2"></i>
            Crear Unidad
        </button>
    </div>
    <div class=" sm:pl-10 sm:pr-10 md:pl-10 md:pr-10  lg:pl-52 lg:pr-52  relative z-10">
    @include("partials.v1.table.primary-table",[
    "filter_active" => true,
               "search" => "search",
               "search_1" => "search_1",
               "search_placeholder"=>$search_placeholder,
               "search_1_placeholder"=>$search_1_placeholder,
               "table_headers"=>["ID"=>"id",
                                 "Nombre"=>"name",
                                 "Abreviatura"=>"abbreviation",
                                 "Fecha de Creación"=>"created_at",
                                 "Fecha de Actualización"=>"updated_at",
                ],
                 "table_actions"=>[
                                   "edit"=>"edit",
                                   "delete"=>"delete",
                                   "details"=>"details",
                                    ],
               "table_rows"=>$data
           ])
    </div>

    @if($isOpen)
        <div class="fixed z-50 inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-2xl sm:w-full z-10" style="background-image: url('/images/icono_central.png'); background-size: contain; background-repeat: no-repeat; background-position: center;">

                <!-- Aquí está la parte superior azul con el título centrado -->
                <div class="bg-blue-900 text-gray-200 bg-opacity-75 px-4 py-3 sm:px-6 rounded-t-lg">
                    <div class="flex flex-col items-center w-full">
                        <!-- Fecha actual -->
                        <div class="text-sm text-gray-200 mb-2 self-end">
                            {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                        </div>

                        <h3 class="text-lg leading-6 font-medium text-gray-200 text-center w-full" id="modal-title">
                            {{ ($action == 'create')?'CREAR UNIDAD': (($action == 'edit') ? 'EDITAR UNIDAD' : 'DETALLES DE LA UNIDAD') }}
                        </h3>
                    </div>
                </div>

                <!-- Cuerpo del Modal con Fondo -->
                @include("partials.v1.form.primary_form",[
                    "form_toast"=>false,
                    "form_grid_col"=>3,
                    "session_message"=>"message",
                    "form_submit_action"=>"submitForm",
                    "show_form_submit_action"=>false,
                    "form_inputs"=>[

                         [
                                "input_type"=>"text",
                                "input_model"=>"modelForm.name",
                                "icon_class"=>"fas fa-ruler",
                                "placeholder"=>"Nombre",
                                "input_field"=>"Nombre",
                                "col_with"=>2,
                                "required"=>true,
                                "disabled"=>$action == 'details',
                         ],
                         [
                                "input_type"=>"text",
                                "input_model"=>"modelForm.abbreviation",
                                "icon_class"=>"fas fa-font",
                                "placeholder"=>"Abreviatura",
                                "input_field"=>"Abreviatura",
                                "col_with"=>1,
                                "required"=>true,
                                "disabled"=>$action == 'details',
                         ],

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
