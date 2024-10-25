<!-- resources/views/livewire/purchases/create-purchase.blade.php -->

<div class="pb-4 flex justify-center"> <!-- Contenedor principal con márgenes y flex para centrar -->

    <div class="max-w-screen-2xl w-full mx-auto p-8 bg-white shadow-md rounded-xl grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4  relative z-10" style="margin: 0% 2% 0% 2%;">
        <!-- Ajuste de ancho máximo y padding -->
        <!-- Primera columna: Formulario -->
        <div class="col-span-2">
            <div class="grid grid-cols-1 gap-4 mb-6">
                <!-- Fila de Select y detalles del proveedor -->
                <div class="grid grid-cols-2 gap-5 items-end">
                    <!-- Select para Proveedor -->
                    <div class="col-span-1">
                        <label for="supplier_id" class="block text-sm font-medium text-gray-700">Proveedor</label>
                        <select id="supplier_id" wire:model.live="modelForm.supplier_id"
                            class="block w-full mt-1 bg-white border border-gray-300 rounded-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Seleccionar Proveedor</option>
                            @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                        @error('modelForm.supplier_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Input para Nombre del Proveedor -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Nombre del Proveedor</label>
                        <input type="text" value="{{ $selectedSupplier ? $selectedSupplier->name : '' }}"
                            class="block w-full mt-1 bg-gray-100 border border-gray-300 rounded-full shadow-sm sm:text-sm"
                            readonly>
                    </div>

                    <!-- Input para Nombre del Proveedor -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Metodo de Pago</label>
                        <select wire:model="payment_method"
                            class="mt-1 block w-full border-gray-300 rounded-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            aria-describedby="paymentMethodHelp">
                            <option value="">Seleccione</option>
                            <option value="Efectivo">Efectivo</option>
                            <option value="Transferencia">Transferencia</option>
                        </select>
                    </div>
                    <!-- Input para Teléfono del Proveedor -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="text" value="{{ $selectedSupplier ? $selectedSupplier->phone : '' }}"
                            class="block w-full mt-1 bg-gray-100 border border-gray-300 rounded-full shadow-sm sm:text-sm"
                            readonly>
                    </div>
                </div>

                <!-- Fila para Dirección y Documento -->
                <div class="grid grid-cols-2 gap-5 items-end">
                    <!-- Input para Dirección del Proveedor -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Dirección</label>
                        <input type="text" value="{{ $selectedSupplier ? $selectedSupplier->address : '' }}"
                            class="block w-full mt-1 bg-gray-100 border border-gray-300 rounded-full shadow-sm sm:text-sm"
                            readonly>
                    </div>

                    <!-- Input para Documento del Proveedor -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Documento</label>
                        <input type="text" value="{{ $selectedSupplier ? $selectedSupplier->document : '' }}"
                            class="block w-full mt-1 bg-gray-100 border border-gray-300 rounded-full shadow-sm sm:text-sm"
                            readonly>
                    </div>
                </div>
            </div>

            <!-- Productos seleccionados -->
            <div class="mt-6 relative z-10">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Productos Seleccionados</h3>
                <div class="w-full text-sm text-left rtl:text-right bg-gray-100 text-gray-600 dark:text-gray-400 rounded-3xl overflow-hidden shadow-lg overflow-x-auto"> <!-- Añadido overflow-x-auto aquí -->
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 overflow-hidden whitespace-nowrap"> <!-- Añadido whitespace-nowrap aquí -->
                        <thead class="text-xs text-gray-200 h-10 uppercase dark:bg-gray-700 dark:text-gray-400" style="background:#652581;">
                            <tr>
                                <th class="px-4 py-2 text-left">Producto</th>
                                <th class="px-4 py-2 text-left">Cantidad</th>
                                <th class="px-4 py-2 text-left">Precio Unitario</th>
                                <th class="px-4 py-2 text-left">Subtotal</th>
                                {{-- <th class="px-4 py-2 text-left">Eliminar</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($selectedProducts as $index => $product)
                            <tr>
                                <td class="border px-4 py-2">{{ $product['name'] }}</td>
                                <td class="border px-4 py-2">{{ $product['number'] }}</td>
                                <td class="border px-4 py-2">${{ number_format($product['price'], 2) }}</td>
                                <td class="border px-4 py-2">${{ number_format($product['subtotal'], 2) }}</td>
                                {{-- <td class="border px-4 py-2">
                                    <button 
                                        class="bg-red-500 rounded-full px-2 py-2 hover:bg-red-700 text-white font-bold py-1 px-3 rounded" 
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="Eliminar" 
                                        wire:click="deleteProduct({{ $index }})">
                                <i class="text-bg-red-500 fas fa-trash"></i>
                                </button>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-4">
                <button wire:click="submitForm"
                    class="bg-blue-900 text-white font-bold py-2 px-4 rounded-full shadow hover:bg-blue-700">Guardar
                    Compra</button>
                <button wire:click="cancel"
                    class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-full shadow hover:bg-gray-400">Cancelar</button>
            </div>
        </div>

        <!-- Segunda columna: Tabla de productos para agregar -->
        <div class="mt-0  col-span-4">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-0">Productos Disponibles</h3>
            <div class="bg-blue-100 rounded-lg shadow-lg overflow-hidden">
                @include('partials.v1.table.primary-table', [
                'filter_active' => true,
                'search' => 'search',
                'search_1' => 'search_1',
                'search_placeholder' => $search_placeholder,
                'search_1_placeholder' => $search_1_placeholder,
                'table_headers' => [
                'ID' => 'id',
                'Nombre' => 'name',
                'Código' => 'code',
                'Unidad' => 'unit.name',
                'Precio' => 'activePrice.price',
                'Stock' => 'inventory.quantity',
                ],
                'table_actions' => [
                'add' => 'addProductToPurchase',
                ],
                'table_rows' => $data,
                ])
            </div>
        </div>
    </div>

    <!-- Modal para ingresar la cantidad y el precio del producto -->
    @if ($isModalOpen)
    <div class="fixed z-50 inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full"
            style="background-image: url('/images/icono_central.png'); background-size: contain; background-repeat: no-repeat; background-position: center;">
            <div class="bg-blue-900 px-4 py-3 sm:px-6 bg-opacity-90">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Agregar Producto: {{ $selectedProduct->name ?? '' }}
                </h3>
            </div>
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 bg-opacity-75">
                <div class="mt-2">
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Cantidad</label>
                    <input type="number" id="quantity" wire:model.live="selectedProductQuantity" min="1"
                        class="block w-full mt-1 border border-gray-300 rounded-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="mt-2">
                    <label for="price" class="block text-sm font-medium text-gray-700">Precio Unitario</label>
                    <input type="number" id="price" wire:model.live="selectedProductPrice" min="0"
                        step="0.01"
                        class="block w-full mt-1 border border-gray-300 rounded-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse bg-opacity-90">
                <button wire:click="confirmAddProductToPurchase"
                    class="w-full inline-flex justify-center rounded-full border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">
                    Confirmar
                </button>
                <button wire:click="closeModal"
                    class="mt-3 w-full inline-flex justify-center rounded-full border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
    @endif
</div>