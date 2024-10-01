<div>
    <div class="py-12  max-w-screen-7xl">
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
                                <input type="date" wire:model="closing_date_time"
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

                                <select wire:model="payment_method"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    wire:change="updateTotalSales" aria-describedby="paymentMethodHelp">
                                    <option value="">Seleccione</option>
                                    <option value="cash">Efectivo</option>
                                    <option value="transfer">Transferencia</option>
                                    <option value="all">Todos</option> <!-- Nueva opción "Todos" -->
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
                                    readonly aria-describedby="totalSalesCashHelp" disabled />

                                <small id="totalSalesCashHelp" class="text-gray-500">Total de ventas en
                                    efectivo.</small>
                            </div>



                            <!-- Total Ventas Transferencia -->
                            <div>
                                {{-- <label class="block text-sm font-medium text-gray-700">Total Ventas
                                    Transferencia</label> --}}
                                <input wire:model="total_sales_transfer" type="number" step="0.01"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    readonly aria-describedby="totalSalesTransferHelp" disabled />

                                <small id="totalSalesTransferHelp" class="text-gray-500">Total de ventas por
                                    transferencia.</small>
                            </div>

                            <!-- Total Egresos -->
                            <div>
                                {{-- <label class="block text-sm font-medium text-gray-700">Total Egresos</label> --}}
                                <input wire:model="total_expenses" type="number" step="0.01"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-describedby="totalExpensesHelp" disabled />

                                <small id="totalExpensesHelp" class="text-gray-500">Ingrese el total de egresos.</small>
                            </div>

                            <!-- Saldo Final Efectivo -->
                            <div>
                                {{-- <label class="block text-sm font-medium text-gray-700">Saldo Final Efectivo</label> --}}
                                <input wire:model="final_balance_cash" type="number" step="0.01"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-describedby="finalBalanceCashHelp" disabled />

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
                                    aria-describedby="nextStartBalanceHelp" disabled />

                                <small id="nextStartBalanceHelp" class="text-gray-500">Total venta</small>
                            </div>
                            <div>
                                {{-- <label class="block text-sm font-medium text-gray-700">Saldo Inicial Próximo
                                    Turno</label> --}}
                                <input wire:model="final_balance" type="number" step="0.01"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-describedby="nextStartBalanceHelp" disabled />

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
                <div class="relative z-40 bg-white col-span-1 md:col-span-2 p-4 rounded-lg shadow-md ">


                    <div class="p-6">
                        <h1 class="text-2xl font-bold mb-4">Cierre de Caja</h1>

                        <!-- Inputs de búsqueda -->
                        <div class="overflow-x-auto  relative z-10 max-w-6xl mx-auto ">
                            <div class="absoloute z-10 flex space-x-4 mb-4 ml-8">
                                <input type="text" placeholder="{{ $search_1 }}"
                                    class="p-2 border border-gray-300 rounded-md" wire:model="search">
                                <input type="date" placeholder="{{ $search_placeholder }}"
                                    class="p-2 border border-gray-300 rounded-md" wire:model="search_placeholder">
                                <input type="date" placeholder="{{ $search_placeholder }}"
                                    class="p-2 border border-gray-300 rounded-md" wire:model="search_1_placeholder">
                            </div>
                        </div>

                        <div class="overflow-x-auto mt-5 relative z-10 max-w-6xl mx-auto">
                            <table
                                class="table-auto w-full border-collapse bg-white shadow-lg rounded-lg overflow-hidden">
                                <thead class="bg-blue-900 text-gray-200 uppercase text-sm leading-normal">
                                    <tr>
                                        <th class="py-3 px-4 text-left text-sm font-semibold">Cerrado por</th>
                                        <th class="py-3 px-4 text-left text-sm font-semibold">Fecha y Hora</th>
                                        <th class="py-3 px-4 text-left text-sm font-semibold">Saldo Inicial</th>
                                        <th class="py-3 px-4 text-left text-sm font-semibold">Ingresos</th>
                                        <th class="py-3 px-4 text-left text-sm font-semibold">Egresos</th>
                                        <th class="py-3 px-4 text-left text-sm font-semibold">Saldo Final</th>
                                        <th class="py-3 px-4 text-left text-sm font-semibold">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr class="border-b hover:bg-gray-100">
                                            <td class="py-2 px-4">{{ $row->user->name }}</td>
                                            <td class="py-2 px-4">{{ $row->created_at }}</td>
                                            <td class="py-2 px-4">${{ $row->start_balance }}</td>
                                            <td class="py-2 px-4">${{ $row->total_sales }}</td>
                                            <td class="py-2 px-4">${{ $row->total_expenses }}</td>
                                            <td class="py-2 px-4">${{ $row->final_balance }}</td>
                                            <td class="py-2 px-4">
                                                <button wire:click="edit({{ $row->id }})"
                                                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded"><i
                                                        class="text-bg-green-500 fas fa-pencil"></i></button>
                                                <button wire:click="Destroy({{ $row->id }})"
                                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded"><i
                                                        class="text-bg-red-500 fas fa-trash"></i></button>
                                                <button wire:click="showDetails({{ $row->id }})"
                                                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded"><i
                                                        class="text-bg-blue-500 fas fa-sitemap"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $data->links('partials.v1.table.pagination-links') }}
                    </div>

                </div>

            </div>
        </div>

    </div>



    <!-- Modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="{{ $showModal ? 'fixed' : 'hidden' }} flex z-50 inset-0 items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white bg-opacity-95 rounded-lg shadow dark:bg-gray-700 "style="background-image: url(/images/icono_central.png);
            background-size: contain; /* Cambiado a cover */
            background-repeat: no-repeat;
            background-position: center;">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-blue-900 bg-opacity-75">
                    <h3 class="text-xl font-semibold text-gray-100 dark:text-white">
                        Detalles de Ventas
                    </h3>
                    <button type="button"
                        class="text-gray-100 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        wire:click="closeModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Cerrar modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4 bg-white bg-opacity-75">
                    <div class="bg-white max-w-full shadow-lg rounded-lg">
                        <div class="p-4 grid  grid-cols-2 md:grid-cols-2 lg:grid-cols-2 w-full bg-white border border-gray-300">
                            <div class="border border-gray-300 p-2">Responsable Cierre :</div>
                            <div class="border border-gray-300 p-2">{{$this->user_name}}</div>
                            <div class="border border-gray-300 p-2">Fecha de Cierre :</div>
                            <div class="border border-gray-300 p-2">{{$this->closing_date_time}}</div>
                            <div class="border border-gray-300 p-2">Saldo Inicial :</div>
                            <div class="border border-gray-300 p-2">$ {{$this->start_balance}}</div>
                            <div class="border border-gray-300 p-2">Ingresos :</div>
                            <div class="border border-gray-300 p-2">$ {{$this->total_sales}}</div>
                            <div class="border border-gray-300 p-2">Egresos Total:</div>
                            <div class="border border-gray-300 p-2">$ {{$this->total_expenses}}</div>
                            <div class="border border-gray-300 p-2">Total Balance :</div>
                            <div class="border border-gray-300 p-2">$ {{$this->final_balance}}</div>
                        </div>

                        <table class="table-auto w-full border-collapse bg-white  overflow-hidden">
                            <thead class="bg-blue-900 text-gray-200 uppercase text-sm leading-normal">
                                <tr>
                                    <th class="px-4 py-2 border-b">Producto</th>
                                    <th class="px-4 py-2 border-b">Cantidad</th>
                                    <th class="px-4 py-2 border-b">Precio Unitario</th>
                                    <th class="px-4 py-2 border-b">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salesDetails as $detail)
                                    <tr>
                                        <td class="px-4 py-2 border-b text-start">{{ $detail->product->name }}</td>
                                        <td class="px-4 py-2 border-b text-center">{{ $detail->quantity }}</td>
                                        <td class="px-4 py-2 border-b text-center">{{ $detail->unit_price }}</td>
                                        <td class="px-4 py-2 border-b text-end">{{ $detail->sub_total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>

                <!-- Modal footer -->
                <div
                    class="flex  justify-end gap-2 p-4 md:p-5 border-t border-gray-200 bg-white bg-opacity-75 rounded-b dark:border-gray-600">
                    <button wire:click="closeModal" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cerrar</button>
                    <button wire:click="closeModal" type="button"
                        class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Imprimir</button>
                </div>
            </div>
        </div>
    </div>


    @if ($showModal)
        <div class="modal-backdrop fade show"></div>
    @endif



</div>
