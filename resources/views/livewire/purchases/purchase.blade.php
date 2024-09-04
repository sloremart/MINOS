<!-- resources/views/livewire/purchases/purchase.blade.php -->
<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de compras') }}
        </h2>
    </x-slot>
    <div class="text-right mt-4 z-20 relative max-w-6xl mx-auto">
        <button wire:click="openModal" class="bg-blue-900 text-gray-200 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded inline-flex items-center shadow-md">
            <i class="fa-solid fa-circle-plus mr-2"></i>
            Crear Compra
        </button>
    </div>

    @include("partials.v1.table.primary-table",[
    "filter_active" => true,
               "search" => "search",
               "search_1" => "search_1",
               "search_placeholder"=>$search_placeholder,
               "search_1_placeholder"=>$search_1_placeholder,
               "table_headers"=>["ID"=>"id",
                                 "Proveedor"=>"supplier_id",
                                 "Usuario"=>"user_id",
                                 "Fecha de Compra"=>"purchase_date",
                                 "Monto Total"=>"total_amount",
                                 "Detalles"=>"details",
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
                            {{ ($action == 'create')?'CREAR COMPRA': (($action == 'edit') ? 'EDITAR COMPRA' : 'DETALLES DE LA COMPRA') }}
                        </h3>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 mb-6">
                    <!-- Select para Cliente -->
                    <div class="col-span-1">
                        <label for="supplier_id" class="block text-sm font-medium text-gray-700">Proveedor</label>
                        <select id="supplier_id" wire:model.live="modelForm.supplier_id" class="block w-full mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Seleccionar Proveedor</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                        @error('modelForm.supplier_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <!-- Input para Nombre -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Nombre del Proveedor</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input wire:model="supplier.name" type="text" class="block w-full pl-10 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" readonly>
                        </div>
                    </div>

                    <!-- Input para Teléfono del Proveedor -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Teléfono del Proveedor</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-400"></i>
                            </div>
                            <input wire:model="supplier.phone" type="text" class="block w-full pl-10 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" readonly>
                        </div>
                    </div>

                    <!-- Input para Correo Electrónico del Proveedor -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Correo Electrónico del Proveedor</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input wire:model="supplier.email" type="text" class="block w-full pl-10 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" readonly>
                        </div>
                    </div>

                    <!-- Input para Dirección del Proveedor -->
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Dirección del Proveedor</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                            <input wire:model="supplier.address" type="text" class="block w-full pl-10 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" readonly>
                        </div>
                    </div>


                </div>




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
