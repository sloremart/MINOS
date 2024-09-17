<!-- resources/views/livewire/groups/group.blade.php -->
<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de grupos') }}
        </h2>
    </x-slot>
    <div class="text-right mt-4 z-20 relative max-w-6xl mx-auto">
        <button wire:click="openModal" class="bg-blue-900 text-gray-200 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded inline-flex items-center shadow-md">
            <i class="fa-solid fa-circle-plus mr-2"></i>
            Crear Grupo
        </button>
    </div>

    @include("partials.v1.table.primary-table",[
    "filter_active" => true,
               "search" => "search",
               "search_1" => "search_1",
               "search_placeholder"=>$search_placeholder,
               "search_1_placeholder"=>$search_1_placeholder,
               "table_headers"=>["ID"=>"id",
                                 "Nombre"=>"name",
                                 "Codigo"=>"code",
                                 "Descripción"=>"description",
                                 "Fecha de Creación"=>"created_at",


                ],
                 "table_actions"=>[
                                   "edit"=>"edit",
                                   "delete"=>"delete",
                                   "details"=>"details",
                                   "customs"=>[
                                                [
                                                   "redirect"=>[
                                                               "route"=>"group.list",
                                                               "binding"=>"group"
                                                         ],
                                                       "button_color"=>"bg-blue-500",
                                                     "button_hover"=>"bg-blue-700",
                                                     "icon_color"=>"bg-blue-500",
                                                       "icon"=>"fas fa-sitemap",
                                                       "tooltip_title"=>"Subgrupos",
                                                 ],
                                                 ]
                                    ],

               "table_rows"=>$data
           ])

    @if($isOpen)
        <div class="fixed z-50 inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-2xl sm:w-full z-10"
            style="background-image: url('/images/icono_central.png'); background-size: contain; background-repeat: no-repeat; background-position: center;">
                <div class="bg-blue-900 text-gray-200 bg-opacity-75 px-4 py-3 sm:px-6 rounded-t-lg">
                    <div class="flex flex-col items-center w-full">
                        <div class="text-sm text-gray-200 mb-2 self-end">
                            {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                        </div>
                        <h3 class="text-lg leading-6 font-medium text-gray-200 text-center w-full" id="modal-title">
                            {{ ($action == 'create')?'CREAR GRUPO': (($action == 'edit') ? 'EDITAR GRUPO' : 'DETALLES DEL GRUPO') }}
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
                            "input_type"=>"text",
                            "input_model"=>"modelForm.name",
                            "icon_class"=>"fas fa-object-group",
                            "placeholder"=>"Nombre",
                            "input_field"=>"Nombre",
                            "col_with"=>3,
                            "required"=>true,
                            "disabled"=>$action == 'details',
                        ],
                        [
                            "input_type"=>"text",
                            "input_model"=>"modelForm.description",
                            "icon_class"=>"fas fa-align-left",
                            "placeholder"=>"Descripción",
                            "input_field"=>"Descripción",
                            "col_with"=>3,
                            "required"=>true,
                            "disabled"=>$action == 'details',
                            "input_rows" => 3
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
