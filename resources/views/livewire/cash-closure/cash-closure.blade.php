<div>


<!-- VISTA PRINCIPAL DE CIERRE DE CAJA  -->
    <div class="pb-4    max-w-screen-7xl ">
        <div class="max-w-screen-7xl justify-center  place-content-center p-4" style="margin: -2% 2% 0% 2%;">
            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-4 relative z-40">
                <div class="relative z-40 bg-white col-span-2 md:col-span-1  rounded-lg shadow-md overflow-x-auto"
                    style="background-image: url('/images/icono_central.png'); background-size: contain; background-repeat: no-repeat; background-position: center;">
                    <div
                        class="w-full bg-blue-900  bg-opacity-75 rounded-t-lg p-4 pb-4 flex justify-between items-center">
                        <h2 class="text-2xl font-bold text-white">Cierre de Caja</h2>
                        <span class="text-white">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</span>
                    </div>

                    <div class="p-4 bg-white bg-opacity-75">
                        <!-- Contenedor de la cabecera -->

                        @if (session()->has('message'))
                        <div class="mb-4 text-green-600">
                            {{ session('message') }}
                        </div>
                        @endif

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Nombre del Usuario -->
                            <div class="relative">
                                <label for="text" class="text-gray-700 text-xs">Nombre responsable</label>
                                <!-- Input con espacio a la izquierda para el ícono -->
                                <span class="absolute py-4 left-0 flex items-center pl-3">
                                    <i class="fa-solid fa-user"></i>
                                </span>

                                <input list="userList" wire:model="user_name"
                                    class="mt-1 block w-full pl-10 border-gray-300 rounded-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-describedby="userNameHelp" placeholder=" Nombre responsable" />

                                <!-- Lista de opciones -->
                                <datalist id="userList">
                                    @foreach ($users as $user)
                                    <option value="{{ $user->name }}">{{ $user->name }}</option>
                                    @endforeach
                                </datalist>
                                <!-- Mensajes de error y ayuda -->
                                @error('user_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                                {{-- <small id="userNameHelp" class="text-gray-500">Seleccione su nombre de la lista.</small> --}}
                            </div>


                            <!-- Saldo Inicial -->
                            <div class="relative">
                                <label for="text" class="text-gray-700 text-xs">Saldo inicial</label>
                                <!-- Input con espacio a la izquierda para el ícono -->
                                <span class="absolute py-4 left-0 flex items-center pl-3">
                                    <i class="fa-solid fa-money-bill-1"></i>
                                </span>
                                <input wire:model="start_balance" id="start_balance" type="number" step="0.01"
                                    class="mt-1 block w-full border-gray-300 pl-10 rounded-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-describedby="startBalanceHelp" placeholder="Saldo inicial" oninput="calculateFinalBalance()"
                                    {{-- Si isDisabled es true, el campo estará deshabilitado --}} @if ($isDisabled) disabled @endif />
                                @error('start_balance')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Método de Pago -->
                            <div class="relative">
                                <label for="text" class="text-gray-700 text-xs">Metodo de pago</label>
                                <span class="absolute py-4 left-0 flex items-center pl-3">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </span>
                                <select wire:model="payment_method" id="payment_method"
                                    class="mt-1 block w-full border-gray-300  pl-10 rounded-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    wire:change="updateTotalSales" aria-describedby="paymentMethodHelp">
                                    <option value="" class="text-gray-500 hidden"> Efectivo & electrónicos</option>
                                    <option value="all">Efectivo & Tansferencia</option> <!-- Nueva opción "Todos" -->
                                </select>
                                @error('payment_method')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                                {{-- <small id="paymentMethodHelp" class="text-gray-500">Seleccione el método de pago
                                    utilizado.</small> --}}
                            </div>

                            <!-- Total Ventas Efectivo -->
                            <div class="relative">
                                <label for="text" class="text-gray-700 text-xs">Total de ventas en efectivo.</label>
                                <span class="absolute py-4 left-0 flex items-center pl-3">
                                    <i class="fa-solid fa-money-bill-1-wave"></i>
                                </span>

                                <input wire:model="total_sales_cash" type="number" step="0.01" id="total_sales_cash"
                                    class="mt-1 block w-full border-gray-300 pl-10 rounded-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    readonly aria-describedby="totalSalesCashHelp" disabled
                                    placeholder="Total de ventas en
                                    efectivo." oninput="calculateFinalBalance()" />

                                {{-- <small id="totalSalesCashHelp" class="text-gray-500">Total de ventas en
                                    efectivo.</small> --}}
                            </div>



                            <!-- Total Ventas Transferencia -->
                            <div class="relative">
                                <label for="text" class="text-gray-700 text-xs">Total de pagos electrónicos </label>
                                <span class="absolute py-4 left-0 flex items-center pl-3">
                                    <i class="fa-duotone fa-solid fa-credit-card"></i>
                                </span>

                                <input wire:model="total_sales_transfer" type="number" step="0.01" id="total_sales_transfer"
                                    class="mt-1 block w-full border-gray-300 pl-10 rounded-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    readonly aria-describedby="totalSalesTransferHelp" disabled
                                    placeholder="Total de electrónicos " />

                                {{-- <small id="totalSalesTransferHelp" class="text-gray-500">Total de ventas por
                                    transferencia.</small> --}}
                            </div>

                            <!-- Total Egresos -->
                            <div class="relative">
                                <label for="text" class="text-gray-700 text-xs">Total de egresos</label>
                                <span class="absolute py-4 left-0 flex items-center pl-3">
                                    <i class="fa-solid fa-hand-holding-dollar"></i>
                                </span>
                                {{-- <label class="block text-sm font-medium text-gray-700">Total Egresos</label> --}}
                                <input wire:model="total_expenses" type="number" step="0.01" id="total_expenses"
                                    class="mt-1 block w-full border-gray-300  pl-10 rounded-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-describedby="totalExpensesHelp" disabled placeholder="total de egresos." oninput="calculateFinalBalance()" />

                                {{-- <small id="totalExpensesHelp" class="text-gray-500">total de egresos.</small> --}}
                            </div>
                            <!-- Saldo Final Efectivo -->
                            <div class="relative">
                                <label for="text" class="text-gray-700 text-xs">Saldo final en caja</label>
                                <span class="absolute py-4 left-0 flex items-center pl-3">
                                    <i class="fa-sharp fa-solid fa-money-bill"></i>
                                </span>
                                <input wire:model="final_balance_cash" type="number" step="0.01" id="final_balance_cash"
                                    class="mt-1 block w-full border-gray-300 pl-10 rounded-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-describedby="finalBalanceCashHelp" readonly placeholder="Saldo final en efectivo." oninput="calculateFinalBalance()" disabled />
                            </div>


                            <!-- saldo proximo turno -->
                            <div class="relative">
                                <label for="next_start_balance" class="text-gray-700 text-xs">Saldo para el próximo turno</label>
                                <span class="absolute py-4 left-0 flex items-center pl-3">
                                    <i class="fa-sharp fa-solid fa-money-bill"></i>
                                </span>
                                <input wire:model="next_start_balance" type="number" step="0.01"
                                    class="mt-1 block w-full border-gray-300 rounded-full pl-10 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-describedby="nextStartBalanceHelp"
                                    placeholder="Saldo para el próximo turno."
                                   />
                                   {{-- @if (!$hasPreviousRecord) disabled @endif --}}
                                @error('next_start_balance')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="relative">
                                <label for="text" class="text-gray-700 text-xs">Total venta</label>
                                <span class="absolute py-4 left-0 flex items-center pl-3">
                                    <i class="fa-sharp fa-solid fa-money-bill"></i>
                                </span>
                                {{-- <label class="block text-sm font-medium text-gray-700">Saldo Inicial Próximo
                                    Turno</label> --}}
                                <input wire:model="total_sales" type="number" step="0.01" id="total_sales"
                                    class="mt-1 block w-full border-gray-300 rounded-full pl-10 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-describedby="nextStartBalanceHelp" disabled placeholder="Total venta" />

                                {{-- <small id="nextStartBalanceHelp" class="text-gray-500">Total venta</small> --}}
                            </div>
                            <div class="relative">
                                <label for="text" class="text-gray-700 text-xs">Total balance</label>
                                <span class="absolute py-4 left-0 flex items-center pl-3">
                                    <i class="fa-sharp fa-solid fa-money-bill"></i>
                                </span>
                                {{-- <label class="block text-sm font-medium text-gray-700">Saldo Inicial Próximo
                                    Turno</label> --}}
                                <input wire:model="final_balance" type="number" step="0.01" id="final_balance"
                                    class="mt-1 block w-full border-gray-300 pl-10 rounded-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    aria-describedby="nextStartBalanceHelp" disabled placeholder="Total balance" />

                                {{-- <small id="nextStartBalanceHelp" class="text-gray-500">Total balance</small> --}}
                            </div>
                        </div>

                        <!-- Botón Enviar -->
                        <div class="flex justify-end mt-6 gap-2">
                            <button wire:click="resetFields"
                                class="px-4 py-2 bg-gray-600 text-white rounded-full hover:bg-gray-700">
                                Cancelar
                            </button>
                            <button wire:click="store"
                                class="px-4 py-2 bg-blue-900 text-white rounded-full hover:bg-blue-900">
                                Registrar Cierre de Caja
                            </button>
                        </div>
                    </div>
                </div>
                <div class="relative z-40 bg-white col-span-1 md:col-span-2 p-4 rounded-lg shadow-md ">


                    <div class="p-1">
                        <h1 class="text-2xl font-bold mb-4">Cierre de Caja</h1>

                        <!-- Inputs de búsqueda -->
                        <div class="overflow-x-auto  relative z-10 max-w-6xl mx-auto ">
                            <div class="absoloute z-10 flex space-x-4 mb-4 ">
                                <input type="text" placeholder="buscar responsable ..."
                                    class="p-2 border border-gray-300 rounded-full" wire:model.live="search">
                                {{-- <input type="date" class="p-2 border border-gray-300 rounded-full"
                                    wire:model.live="search_1">
                                <input type="date" class="p-2 border border-gray-300 rounded-full"
                                    wire:model.live="search_2"> --}}
                            </div>
                        </div>

                        <div
                            class="w-full  text-left rtl:text-right bg-gray-100 text-gray-600 dark:text-gray-400 rounded-3xl overflow-hidden shadow-lg overflow-x-auto" >
                           
                            <!-- Añadido overflow-x-auto aquí -->
                            <table
                                class="min-w-full  text-left rtl:text-right text-gray-500 dark:text-gray-400 overflow-hidden whitespace-nowrap" style="font-size: 11px;">
                                <!-- Añadido whitespace-nowrap aquí -->
                                <thead class=" text-gray-200 h-10 uppercase dark:bg-gray-700 dark:text-gray-400" 
                                    style="background:#652581;font-size: 11px;">
                                    <tr>
                                        <th class="py-3 px-4 text-left  font-semibold" >Cerrado por</th>
                                        <th class="py-3 px-4 text-left  font-semibold" >Fecha y Hora</th>
                                        <th class="py-3 px-4 text-left  font-semibold" >Saldo Inicial</th>
                                        <th class="py-3 px-4 text-left  font-semibold" >Ingresos</th>
                                        <th class="py-3 px-4 text-left  font-semibold" >Egresos</th>
                                        <th class="py-3 px-4 text-left  font-semibold" >Saldo Final</th>
                                        <th class="py-3 px-4 text-left  font-semibold" >Saldo Siguiente</th>
                                        <th class="py-3 px-4 text-left  font-semibold" >Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                    <tr class="border-b hover:bg-gray-100">
                                        <td class="py-2 px-4">{{ $row->user->name }}</td>
                                        <td class="py-2 px-4">{{ $row->created_at }}</td>
                                        <td class="py-2 px-4">${{ number_format($row->start_balance, 0, ',', '.') }}</td>
                                        <td class="py-2 px-4">${{ number_format($row->total_sales, 0, ',', '.') }}</td>
                                        <td class="py-2 px-4">${{ number_format($row->total_expenses, 0, ',', '.') }}</td>
                                        <td class="py-2 px-4">${{ number_format($row->final_balance, 0, ',', '.') }}</td>
                                        <td class="py-2 px-4">${{ number_format($row->next_start_balance, 0, ',', '.') }}</td>
                                        
                                        <td class="py-2 px-4">
                                            <button wire:click="generatePdf({{ $row->id }})"
                                                class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-3 rounded-full"><i
                                                    class="fa-regular fa-file-pdf"></i></button>
                                            <button wire:click="Destroy({{ $row->id }})"
                                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-3 rounded-full"><i
                                                    class="text-bg-red-500 fas fa-trash"></i></button>
                                            <button wire:click="showDetails({{ $row->id }})"
                                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-3 rounded-full"><i
                                                    class="text-bg-blue-500 fas fa-sitemap"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class=" grid  pt-4 justify-center">
                            {{ $data->links('partials.v1.table.pagination-links') }}
                        </div>
                       
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
            <div class="relative bg-white bg-opacity-95 rounded-lg shadow dark:bg-gray-700 "
                style="background-image: url(/images/icono_central.png);
            background-size: contain; /* Cambiado a cover */
            background-repeat: no-repeat;
            background-position: center;">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-blue-900 bg-opacity-75">
                    <h3 class="text-xl font-semibold text-gray-100 dark:text-white">
                        Detalles de Ventas & Compras
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
                <div class="p-4 md:p-5 space-y-4 bg-white bg-opacity-75" style="max-height: 500px; overflow-y: auto;">
                    <div class="bg-white max-w-full shadow-lg rounded-xl">
                        <div
                            class="p-4 grid  grid-cols-1 md:grid-cols-1 lg:grid-cols-1 w-full bg-white border border-gray-300 rounded-lg">
                            <table class="border border-gray-300 max-w-full rounded-xl">
                                <thead>
                                    <tr>
                                        <th class="border border-gray-300 p-2 text-left rounded-tl-lg">Responsable
                                            Cierre :</th>
                                        <th class="border border-gray-300 p-2 rounded-tr-lg">{{ $this->user_name }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 p-2 text-left">Fecha de Cierre :</td>
                                        <td class="border border-gray-300 p-2">{{ $this->closing_date_time }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 p-2 text-left">Saldo Inicial :</td>
                                        <td class="border border-gray-300 p-2">${{ number_format($start_balance, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 p-2 text-left">Saldo Proximo turno :</td>
                                        <td class="border border-gray-300 p-2">${{ number_format($next_start_balance, 0, ',', '.') }}</td>
                                    </tr>      

                                    <tr>
                                        <td class="border border-gray-300 p-2 text-left">Ingresos :</td>
                                        <td class="border border-gray-300 p-2">${{ number_format($total_sales, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 p-2 text-left">Egresos Total:</td>
                                        <td class="border border-gray-300 p-2">${{ number_format($total_expenses, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 p-2 text-left rounded-bl-lg">Total Balance :
                                        </td>
                                        <td class="border border-gray-300 p-2 rounded-br-lg">${{ number_format($final_balance, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Detalles de Ventas
                    </h3>
                    <div class="bg-white max-w-full shadow-lg rounded-lg overflow-hidden" style="min-height: 12vh;">
                        <div style="max-height: 300px; overflow-y: auto;">
                            <table class="table-auto w-full border-collapse bg-white  rounded-3xl">
                                <thead class="bg-purple-900 text-gray-200 uppercase text-sm leading-normal">
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
                                        <td class="px-4 py-2 border-b text-start">{{ $detail->product->name }}
                                        </td>
                                        <td class="px-4 py-2 border-b text-center">{{ $detail->quantity }}</td>
                                      
                                        <td class="px-4 py-2 border-b text-center">  ${{ number_format($detail->unit_price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2 border-b text-end">${{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Detalles de Compras
                    </h3>
                    <div class="bg-white max-w-full shadow-lg rounded-lg overflow-hidden" style="min-height: 12vh;">
                        <div style="max-height: 300px; overflow-y: auto;">
                            <table class="table-auto w-full border-collapse bg-white  rounded-3xl">
                                <thead class="bg-purple-900 text-gray-200 uppercase text-sm leading-normal">
                                    <tr>
                                        <th class="px-4 py-2 border-b">Proveedor</th>
                                        <th class="px-4 py-2 border-b">Producto</th>
                                        <th class="px-4 py-2 border-b">cantidad</th>
                                        <th class="px-4 py-2 border-b">Precio Unitario</th>
                                        <th class="px-4 py-2 border-b">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchaseDetails as $detail)
                                    <tr>
                                        <td class="px-4 py-2 border-b text-start">{{ $detail->supplier_name }}</td>
                                        <td class="px-4 py-2 border-b text-start">{{ $detail->product_name }}</td>
                                        <td class="px-4 py-2 border-b text-center">{{ $detail->quantity }}</td>
                                        <td class="px-4 py-2 border-b text-center">  ${{ number_format($detail->unit_price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2 border-b text-end">${{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>




                </div>

                <!-- Modal footer -->
                <div
                    class="flex  justify-end gap-2 p-4 md:p-5 border-t border-gray-200 bg-white bg-opacity-95 rounded-b dark:border-gray-600">
                    <button wire:click="closeModal" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cerrar</button>

                </div>
            </div>
        </div>
    </div>


    @if ($showModal)
    <div class="modal-backdrop fade show"></div>
    @endif
    <script>
        function printDiv(divId) {
            var content = document.getElementById(divId).innerHTML;
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = content; // Reemplaza el contenido actual con el del modal
            window.print(); // Llama a la función de impresión
            document.body.innerHTML = originalContent; // Restaura el contenido original después de imprimir
        }



        function calculateFinalBalance() {
            // Obtiene los valores de los campos de entrada
            const startBalance = parseFloat(document.getElementById('start_balance').value);
            const totalSalesCash = parseFloat(document.getElementById('total_sales_cash').value) || 0;
            const totalExpenses = parseFloat(document.getElementById('total_expenses').value) || 0;

            // Verifica si el saldo inicial es un número
            if (isNaN(startBalance)) {
                // Si el saldo inicial está vacío, deja el saldo final vacío
                document.getElementById('final_balance_cash').value = ""; // Deja vacío
                return; // Salir de la función
            }

            // Calcula el saldo final en efectivo
            const finalBalanceCash = startBalance + totalSalesCash - totalExpenses;

            // Actualiza el campo de saldo final
            document.getElementById('final_balance_cash').value = finalBalanceCash.toFixed(2);
        }
    </script>




</div>