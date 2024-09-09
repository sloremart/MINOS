<!-- resources/views/livewire/sales/create-sale.blade.php -->

<div class="py-12 flex justify-center">
    <div class="max-w-7xl mx-auto p-8 bg-white shadow-md rounded-xl grid grid-cols-2 gap-4 mt-16">
        <!-- Primera columna: Formulario -->
        <div>
            <div class="grid grid-cols-1 gap-4 mb-6">
                <!-- Fila de Select y detalles del cliente -->
                <div class="grid grid-cols-3 gap-5 items-end">
                    <!-- Select para Cliente -->
                    <div class="col-span-1">
                        <label for="clientsid" class="block text-sm font-medium text-gray-700">Cliente</label>
                        <select id="clientsid" wire:model.live="customer.id" class="block w-full mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Seleccionar Cliente</option>
                            @foreach($customers as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                        @error('customer.id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Input para Nombre -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input wire:model="customer.name" type="text" class="block w-full pl-10 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" readonly >
                        </div>
                    </div>

                    <!-- Input para Teléfono -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-400"></i>
                            </div>
                            <input wire:model="customer.phone" type="text" class="block w-full pl-10 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" readonly>
                        </div>
                    </div>

                    <!-- Input para Correo Electrónico -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input wire:model="customer.email" type="text" class="block w-full pl-10 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" readonly>
                        </div>
                    </div>

                    <!-- Input para Dirección -->
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Dirección</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                            <input wire:model="customer.address" type="text" class="block w-full pl-10 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"  readonly>
                        </div>
                    </div>
                </div>
            </div>

            @if($isCashModalOpen)
                <!-- Modal para pago en efectivo -->
                <div class="fixed z-50 inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
                    <div class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                        <div class="bg-gray-100 px-4 py-3 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Pago en Efectivo
                            </h3>
                        </div>
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <!-- Sección de Billetes -->
                            <h4 class="text-md font-semibold text-gray-800">Billetes</h4>
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                @foreach ($billQuantities as $bill => $quantity)
                                    <div>
                                        <label for="bill-{{ $bill }}" class="block text-sm font-medium text-gray-700">Billetes de ${{ number_format($bill, 0, ',', '.') }}</label>
                                        <div class="relative mt-1">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-money-bill-wave text-gray-400"></i>
                                            </div>
                                            <input type="number" id="bill-{{ $bill }}" wire:model.live="billQuantities.{{ $bill }}" min="0" class="block w-full pl-10 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Sección de Monedas -->
                            <h4 class="text-md font-semibold text-gray-800">Monedas</h4>
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                @foreach ($coinQuantities as $coin => $quantity)
                                    <div>
                                        <label for="coin-{{ $coin }}" class="block text-sm font-medium text-gray-700">Monedas de ${{ number_format($coin, 0, ',', '.') }}</label>
                                        <div class="relative mt-1">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-coins text-gray-400"></i>
                                            </div>
                                            <input type="number" id="coin-{{ $coin }}" wire:model.live="coinQuantities.{{ $coin }}" min="0" class="block w-full pl-10 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Total y Cambio -->
                            <div class="mt-4">
                                <label for="totalCash" class="block text-sm font-medium text-gray-700">Total Recibido</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-400">$</span>
                                    </div>
                                    <input type="text" id="totalCash" wire:model.live="cashGiven" readonly
                                           class="block w-full pl-7 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="change" class="block text-sm font-medium text-gray-700">Cambio</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-400">$</span>
                                    </div>
                                    <input type="text" id="change" wire:model.live="change" readonly
                                           class="block w-full pl-7 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button wire:click="closeCashModal" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">
                                Confirmar
                            </button>
                            <button wire:click="closeCashModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Modal para agregar producto -->
            @if($isModalOpen)
                <div class="fixed z-50 inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
                    <div class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full" style="background-image: url('/images/icono_central.png'); background-size: contain; background-repeat: no-repeat; background-position: center;">
                        <div class="bg-gray-100 px-4 py-3 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Agregar Producto {{$selectedProduct->name}}
                            </h3>
                        </div>
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Stock Disponible</label>
                                <input  type="number" id="quantity" wire:model="selectedProduct.quantity" min="1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" readonly>
                                @error('quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Cantidad</label>
                                <input type="number" id="quantity" wire:model.live="selectedProduct.number" min="1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" >
                                @error('selectedProduct.number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Unidad</label>
                                <input type="text" id="quantity" wire:model="unitName" min="1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" readonly>
                            </div>
                            <div class="mt-4">
                                <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                                <input type="text" id="price" wire:model="selectedProduct.price" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" readonly>
                            </div>

                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Iva</label>
                                <input type="text" id="quantity" wire:model="vatPercentage" min="1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" readonly>
                            </div>
                            <div class="mt-4">
                                <label for="price" class="block text-sm font-medium text-gray-700">Subtotal</label>
                                <input type="text" id="price" wire:model="selectedProduct.subtotal" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" readonly>
                            </div>
                            <div class="mt-4">
                                <label for="price" class="block text-sm font-medium text-gray-700">Total</label>
                                <input type="text" id="price" wire:model="selectedProduct.total" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" readonly>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button wire:click="confirmAddProductToSale" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">
                                Agregar
                            </button>
                            <button wire:click="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Productos Seleccionados -->
            <div class="mt-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                    Productos Seleccionados
                </h3>
                <div class="flex overflow-x-auto max-h-40 space-x-4">
                    <table class="bg-white rounded-lg shadow-lg overflow-hidden text-sm flex-grow" style="min-width: 0;">
                        <thead class="bg-blue-900 text-gray-200 uppercase text-xs leading-tight">
                        <tr>
                            <th class="px-2 py-2 text-left tracking-wider border-b border-gray-300" style="width: 40%;">
                                Nombre
                            </th>
                            <th class="px-2 py-2 text-left tracking-wider border-b border-gray-300" style="width: 15%;">
                                Cantidad
                            </th>
                            <th class="px-2 py-2 text-left tracking-wider border-b border-gray-300" style="width: 20%;">
                                Precio unitario
                            </th>
                            <th class="px-2 py-2 text-left tracking-wider border-b border-gray-300" style="width: 25%;">
                                Subtotal
                            </th>
                            <th class="px-2 py-2 text-left tracking-wider border-b border-gray-300" style="width: 25%;">
                                Total
                            </th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-700">
                        @if(count($selectedProducts) > 0)
                            @foreach($selectedProducts as $product)
                                <tr class="border-b border-gray-200 hover:bg-blue-100">
                                    <td class="px-2 py-2 whitespace-nowrap border-r border-gray-200">
                                        {{ $product['name'] }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap border-r border-gray-200">
                                        {{ $product['number'] }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap border-r border-gray-200">
                                        ${{ $product['price'] }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap">
                                        ${{ $product['subtotal'] }}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap">
                                        ${{ $product['total'] }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="border-b border-gray-200 ">
                                <td class="px-2 py-2 whitespace-nowrap border-r border-gray-200 text-center" colspan="5">
                                    No hay productos seleccionados
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-between items-center mt-10 space-x-3">
                    <div class="flex-grow">
                        <label class="block text-sm font-medium text-gray-700">Subtotal</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-dollar-sign text-gray-400"></i>
                            </div>
                            <input wire:model="subtotal" type="text" class="block w-full pl-10 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" readonly>
                        </div>
                    </div>

                    <div class="flex-grow">
                        <label class="block text-sm font-medium text-gray-700">Total</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-dollar-sign text-gray-400"></i>
                            </div>
                            <input wire:model="total" type="text" class="block w-full pl-10 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" readonly>
                        </div>
                    </div>

                    <div class="flex-grow">
                        <label class="block text-sm font-medium text-gray-700">Método de Pago</label>
                        <select id="payment_method" wire:model.live="paymentMethod" class="block w-full pl-3 pr-10 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Seleccionar Método de Pago</option>
                            @foreach($paymentMethods as $method)
                                <option value="{{ $method['value'] }}">{{ $method['key'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

        </div>

        <!-- Segunda columna: Tabla de productos para agregar -->
        <div class="mt-16">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-0">
                Productos
            </h3>
            <div class="bg-blue-100 rounded-lg shadow-lg">
                @include("partials.v1.table.primary-table",[
                    "filter_active" => true,
                    "search" => "search",
                    "search_1" => "search_1",
                    "search_placeholder" => $search_placeholder,
                    "search_1_placeholder" => $search_1_placeholder,
                    "table_headers" => [
                        "ID" => "id",
                        "Nombre" => "name",
                        "Código" => "code",
                        "Porcentaje de IVA" => "vatPercentage.percentage",
                        "Unidad" => "unit.name",
                        "Precio" => "activePrice.price",
                        "Stock" => "inventory.quantity",
                    ],
                    "table_actions" => [
                        "add" => "addProductToSale",
                    ],
                    "table_rows" => $data
                ])
            </div>
        </div>
        <div class="mt-6 flex justify-end space-x-4">
            <button wire:click="submitForm" class="bg-blue-900 text-white font-bold py-2 px-4 rounded shadow hover:bg-blue-700">
            </button>
            <button wire:click="cancel" class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded shadow hover:bg-gray-400">
            </button>
        </div>
    </div>
</div>
