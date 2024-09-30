<div>
    <div class="py-12  max-w-screen-2xl">
        <div class="  max-w-screen-7xl justify-center  place-content-center p-4  pt-8  ">
            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-4 relative z-40">
                <div class="relative z-40 bg-white col-span-2 md:col-span-1 p-4 rounded-lg shadow-md overflow-x-auto">
                    <div class="max-w-2xl mx-auto p-4 bg-white shadow-md rounded-lg">
                        <h2 class="text-2xl font-bold mb-4">Cierre de Caja</h2>

                        @if (session()->has('message'))
                            <div class="mb-4 text-green-600">
                                {{ session('message') }}
                            </div>
                        @endif

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Nombre del Usuario -->
                            <div>
                                <input list="userList" wire:model="user_name"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-describedby="userNameHelp" />
                                <datalist id="userList">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                                    @endforeach
                                </datalist>
                                @error('user_name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                                <small id="userNameHelp" class="text-gray-500">Seleccione su nombre de la lista.</small>
                            </div>

                            <!-- Fecha y Hora del Cierre -->
                            <div>
                                {{-- <label class="block text-sm font-medium text-gray-700">Fecha y Hora del Cierre</label> --}}
                                <input type="datetime-local" wire:model="closing_date_time"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-describedby="closureTimeHelp" />
                                @error('closing_date_time')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                                <small id="closureTimeHelp" class="text-gray-500">Ingrese la fecha y hora del
                                    cierre.</small>
                            </div>

                            <!-- Saldo Inicial -->
                            <div>
                                {{-- <label class="block text-sm font-medium text-gray-700">Saldo Inicial</label> --}}
                                <input wire:model="start_balance" type="number" step="0.01"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-describedby="startBalanceHelp" />
                                @error('start_balance')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                                <small id="startBalanceHelp" class="text-gray-500">Ingrese el saldo inicial.</small>
                            </div>

                            <!-- Método de Pago -->
                            <div>
                                {{-- <label class="block text-sm font-medium text-gray-700">Método de Pago</label> --}}
                                <select wire:model="payment_method"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    wire:change="updateTotalSales" aria-describedby="paymentMethodHelp">
                                    <option value="">Seleccione</option>
                                    <option value="cash">Efectivo</option>
                                    <option value="transfer">Transferencia</option>
                                </select>
                                @error('payment_method')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                                <small id="paymentMethodHelp" class="text-gray-500">Seleccione el método de pago
                                    utilizado.</small>
                            </div>

                            <!-- Total Ventas Efectivo -->
                            <div>
                                {{-- <label class="block text-sm font-medium text-gray-700">Total Ventas Efectivo</label> --}}
                                <input wire:model="total_sales_cash" type="number" step="0.01"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    readonly aria-describedby="totalSalesCashHelp" disabled/>
                                   
                                <small id="totalSalesCashHelp" class="text-gray-500">Total de ventas en
                                    efectivo.</small>
                            </div>

                            <!-- Total Ventas Tarjeta -->
                                {{-- <div>
                                    <input wire:model="total_sales_card" type="number" step="0.01"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        readonly aria-describedby="totalSalesCardHelp" />
                                        @error('total_sales_card')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                    <small id="totalSalesCardHelp" class="text-gray-500">Total de ventas con
                                        tarjeta.</small>
                                </div> --}}

                            <!-- Total Ventas Transferencia -->
                            <div>
                                {{-- <label class="block text-sm font-medium text-gray-700">Total Ventas
                                    Transferencia</label> --}}
                                <input wire:model="total_sales_transfer" type="number" step="0.01"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    readonly aria-describedby="totalSalesTransferHelp" disabled/>
                                   
                                <small id="totalSalesTransferHelp" class="text-gray-500">Total de ventas por
                                    transferencia.</small>
                            </div>

                            <!-- Total Egresos -->
                            <div>
                                {{-- <label class="block text-sm font-medium text-gray-700">Total Egresos</label> --}}
                                <input wire:model="total_expenses" type="number" step="0.01"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-describedby="totalExpensesHelp" disabled/>
                              
                                <small id="totalExpensesHelp" class="text-gray-500">Ingrese el total de egresos.</small>
                            </div>

                            <!-- Saldo Final Efectivo -->
                            <div>
                                {{-- <label class="block text-sm font-medium text-gray-700">Saldo Final Efectivo</label> --}}
                                <input wire:model="final_balance_cash" type="number" step="0.01"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-describedby="finalBalanceCashHelp" disabled/>
                               
                                <small id="finalBalanceCashHelp" class="text-gray-500">Ingrese el saldo final en
                                    efectivo.</small>
                            </div>

                            <!-- Saldo Inicial Próximo Turno -->
                            <div>
                                {{-- <label class="block text-sm font-medium text-gray-700">Saldo Inicial Próximo
                                    Turno</label> --}}
                                <input wire:model="next_start_balance" type="number" step="0.01"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-describedby="nextStartBalanceHelp" />
                                @error('next_start_balance')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                                <small id="nextStartBalanceHelp" class="text-gray-500">Ingrese el saldo inicial para el
                                    próximo turno.</small>
                            </div>
                            <div>
                                {{-- <label class="block text-sm font-medium text-gray-700">Saldo Inicial Próximo
                                    Turno</label> --}}
                                <input wire:model="total_sales" type="number" step="0.01"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-describedby="nextStartBalanceHelp" disabled/>
                              
                                <small id="nextStartBalanceHelp" class="text-gray-500">Total venta</small>
                            </div>
                            <div>
                                {{-- <label class="block text-sm font-medium text-gray-700">Saldo Inicial Próximo
                                    Turno</label> --}}
                                <input wire:model="final_balance" type="number" step="0.01"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-describedby="nextStartBalanceHelp" disabled/>
                               
                                <small id="nextStartBalanceHelp" class="text-gray-500">Total balance</small>
                            </div>
                        </div>

                        <!-- Botón Enviar -->
                        <div class="flex justify-end mt-6">
                            <button wire:click="store"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                Registrar Cierre de Caja
                            </button>
                        </div>
                    </div>


                </div>
                <div class="relative z-40 bg-white col-span-1 md:col-span-2 p-4 rounded-lg shadow-md overflow-x-auto">
                    @include('partials.v1.table.primary-table', [
                        'filter_active' => true,
                        'search' => 'search',
                        'search_1' => 'search_1',
                        'search_2' => 'search_2',
                        'search_placeholder' => $search_placeholder,
                        'search_1_placeholder' => $search_1_placeholder,
                        'search_2_placeholder' => $search_2_placeholder,
                        'table_headers' => [
                            'Cerrado por' => 'user.name', // Accede al nombre del usuario
                            'Fecha y Hora' => 'created_at',
                            'Saldo Inicial' => 'start_balance',
                            'Ingresos' => 'total_sales',
                            'Egresos' => 'total_expenses',
                            'Saldo Final' => 'final_balance',
                            'Acciones' => 'actions', // O el campo que refleje acciones
                        ],
                        'table_rows' => $data,
                    ])
                </div>

            </div>
        </div>

    </div>
</div>
