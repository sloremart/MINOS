<!-- resources/views/livewire/inventories/inventory.blade.php -->
<div>

   <!-- VISTA PRINCIPAL DE INVENTARIO -->

    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center pt-4" style="font-size: 34px;">
            {{ __('Listado de inventarios') }}
        </h2>
    <div class="text-right  z-20 relative max-w-6xl mx-auto" style="margin-left: 145px;
    margin-right: 26px;">
        <button wire:click="openModal" class="bg-blue-900 text-gray-200  mt-10 hover:bg-blue-400  font-bold py-2 px-4 rounded-full inline-flex items-center shadow-md">
            <i class="fa-solid fa-circle-plus mr-2"></i>
            Crear Inventario
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
        "Codigo producto"=>"product.code",
        "Producto"=>"product.name",
        "Cantidad"=>"quantity",
        "Fecha de actualizacion"=>"updated_at",


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
        <div class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-2xl sm:w-full z-10">

            <div class="bg-blue-900 text-gray-200 bg-opacity-75 px-4 py-3 sm:px-6 rounded-t-lg">
                <div class="flex flex-col items-center w-full">
                    <div class="text-sm text-gray-200 mb-2 self-end">
                        {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                    </div>
                    <h3 class="text-lg leading-6 font-medium text-gray-200 text-center w-full" id="modal-title">
                        {{ ($action == 'create')?'CREAR INVENTARIO': (($action == 'edit') ? 'EDITAR INVENTARIO' : 'DETALLES DEL INVENTARIO') }}
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
            "select_options"=>$action != 'create'?\App\Models\Product::all():$products, // Asume que $products es un array pasado a la vista con los productos disponibles
            "select_option_value"=>"id",
            "select_option_view"=>"name",
            "col_with"=>2,
            "required"=>true,
            "disabled"=>$action != 'create',
            ],
            [
            "input_type"=>"number",
            "input_model"=>"modelForm.quantity",
            "icon_class"=>"fas fa-sort-numeric-up-alt",
            "placeholder"=>"Cantidad",
            "input_field"=>"Cantidad",
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