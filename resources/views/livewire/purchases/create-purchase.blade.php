<!-- resources/views/livewire/purchases/create-purchase.blade.php -->

<div class="py-12 flex justify-center"> <!-- Contenedor principal con márgenes y flex para centrar -->

    <div class="max-w-screen-xl w-full mx-auto p-8 bg-white shadow-md rounded-xl grid grid-cols-2 gap-4 mt-16"> <!-- Ajuste de ancho máximo y padding -->
        <!-- Primera columna: Formulario -->
        <div>
            <div class="grid grid-cols-1 gap-4 mb-6">
                <!-- Fila de Select y detalles del proveedor -->
                <div class="grid grid-cols-3 gap-5 items-end">
                    <!-- Select para Proveedor -->
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

                    <!-- Input para Nombre del Proveedor -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Nombre del Proveedor</label>
                        <input type="text" value="{{ $selectedSupplier ? $selectedSupplier->name : '' }}" class="block w-full mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-sm sm:text-sm" readonly>
                    </div>

                    <!-- Input para Teléfono del Proveedor -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="text" value="{{ $selectedSupplier ? $selectedSupplier->phone : '' }}" class="block w-full mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-sm sm:text-sm" readonly>
                    </div>
                </div>

                <!-- Fila para Dirección y Documento -->
                <div class="grid grid-cols-2 gap-5 items-end">
                    <!-- Input para Dirección del Proveedor -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Dirección</label>
                        <input type="text" value="{{ $selectedSupplier ? $selectedSupplier->address : '' }}" class="block w-full mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-sm sm:text-sm" readonly>
                    </div>

                    <!-- Input para Documento del Proveedor -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Documento</label>
                        <input type="text" value="{{ $selectedSupplier ? $selectedSupplier->document : '' }}" class="block w-full mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-sm sm:text-sm" readonly>
                    </div>
                </div>
            </div>

            <!-- Productos seleccionados -->
            <div class="mt-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Productos Seleccionados</h3>
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Producto</th>
                        <th class="px-4 py-2 text-left">Cantidad</th>
                        <th class="px-4 py-2 text-left">Precio Unitario</th>
                        <th class="px-4 py-2 text-left">Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($selectedProducts as $product)
                        <tr>
                            <td class="border px-4 py-2">{{ $product['name'] }}</td>
                            <td class="border px-4 py-2">{{ $product['number'] }}</td>
                            <td class="border px-4 py-2">${{ number_format($product['price'], 2) }}</td>
                            <td class="border px-4 py-2">${{ number_format($product['subtotal'], 2) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-end space-x-4">
                <button wire:click="submitForm" class="bg-blue-900 text-white font-bold py-2 px-4 rounded shadow hover:bg-blue-700">Guardar Compra</button>
                <button wire:click="cancel" class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded shadow hover:bg-gray-400">Cancelar</button>
            </div>
        </div>

        <!-- Segunda columna: Tabla de productos para agregar -->
        <div class="mt-16">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-0">Productos Disponibles</h3>
            <div class="bg-blue-100 rounded-lg shadow-lg">
                @include("partials.v1.table.primary-table", [
                    "filter_active" => true,
                    "search" => "search",
                    "search_1" => "search_1",
                    "search_placeholder" => $search_placeholder,
                    "search_1_placeholder" => $search_1_placeholder,
                    "table_headers" => [
                        "ID" => "id",
                        "Nombre" => "name",
                        "Código" => "code",
                        "Unidad" => "unit.name",
                        "Precio" => "activePrice.price",
                        "Stock" => "inventory.quantity",
                    ],
                    "table_actions" => [
                        "add" => "addProductToPurchase",
                    ],
                    "table_rows" => $data
                ])
            </div>
        </div>
    </div>

    <!-- Modal para ingresar la cantidad y el precio del producto -->
    @if($isModalOpen)
        <div class="fixed z-50 inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-gray-100 px-4 py-3 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Agregar Producto: {{ $selectedProduct->name ?? '' }}
                    </h3>
                </div>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mt-2">
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Cantidad</label>
                        <input type="number" id="quantity" wire:model.live="selectedProductQuantity" min="1" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="mt-2">
                        <label for="price" class="block text-sm font-medium text-gray-700">Precio Unitario</label>
                        <input type="number" id="price" wire:model.live="selectedProductPrice" min="0" step="0.01" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="confirmAddProductToPurchase" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">
                        Confirmar
                    </button>
                    <button wire:click="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
