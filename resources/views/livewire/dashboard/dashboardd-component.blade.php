<div>
    <!-- Contenedor principal con espaciado y bordes redondeados -->
    <div class="py-12 rounded-3xl">
        <!-- Contenedor central con máximo ancho y espaciado -->
        <div class=" relative z-50 max-w-screen-xl mx-auto  sm:px-6 lg:px-8 rounded-3xl bg-white shadow-2xl">
            <!-- Contenedor con bordes redondeados y espaciado -->
            <div class="overflow-hidden sm:rounded-lg rounded-3xl py-4 pb-20">
                <!-- Grid para mostrar las tarjetas de estadísticas -->
                <div
                    class="grid max-w-screen-xl grid-cols-1 gap-8 p-1 mx-auto text-gray-900 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-3 dark:text-white">
                    <!-- Tarjeta de Usuarios -->
                    <div class="flex items-center justify-center p-2 bg-blue-800 rounded-full  shadow-2xl">
                        <div class="flex flex-col  justify-center  flex-grow px-10 text-white">
                            <span class="text-xl">USUARIOS</span>
                            <h1 class="text-4xl">{{ $userCount }}</h1>
                            <span class="text-xl ">ACTUALES</span>
                        </div>
                        <div class="flex items-center justify-center bg-blue-700 p-3  rounded-r-full"
                            style="width: 30%; height: 100%;">
                            <img src="{{ asset('images/Iconos Menu/user.svg') }}" class="text-white" alt="">
                        </div>
                    </div>

                    <!-- Tarjeta de Proveedores -->
                    <div class="flex items-center justify-center p-2 bg-purple-800 rounded-full shadow-2xl">
                        <div class="flex flex-col  justify-center  flex-grow px-10 text-white">
                            <span class="text-xl">CLIENTES</span>
                            <h1 class="text-4xl">{{ $Client }}</h1>
                            <span class="text-xl ">ACTUALES</span>
                        </div>
                        <div class="flex items-center justify-center bg-purple-700 p-3  rounded-r-full"
                            style="width: 30%; height: 100%;">
                            <img src="{{ asset('images/Iconos Menu/customers.svg') }}" class="text-white"
                                alt="">
                        </div>
                    </div>


                    <!-- Tarjeta de Ventas Hoy -->
                    <div class="flex items-center justify-center p-2 bg-blue-500 rounded-full  shadow-2xl">
                        <div class="flex flex-col  justify-center  flex-grow px-10 text-white">
                            <span class="text-xl"> VENTA TOTAL</span>
                            <h1 class=" text-2xl">$ {{ $totalSalesFormatted }}</h1>
                            <span class="text-xl ">ACTUALES</span>
                        </div>
                        <div class="flex items-center justify-center bg-blue-400 p-3  rounded-r-full"
                            style="width: 30%; height: 100%;">
                            <img src="{{ asset('images/Iconos Menu/sale-svgrepo-com.svg') }}" class="text-white"
                                alt="">
                        </div>
                    </div>


                </div>
            </div>

            <!-- Contenedor para productos y gráfico -->
            <div class="overflow-hidden    rounded-3xl ">
                <div class="relative overflow-x-auto rounded-3xl py-10  ">
                    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-4 md:gap-8 sm:gap-8">
                        <!-- Tarjeta de productos -->
                        <div class="bg-gray-200  p-2   max-w-screen-xl rounded-3xl lg:col-span-7 sm:col-span-12 max-h-[340px] overflow-y-auto"  style="-webkit-box-shadow: 1px 14px 22px -6px rgba(0,0,0,0.49);
                            -moz-box-shadow: 1px 14px 22px -6px rgba(0,0,0,0.49);
                            box-shadow: 1px 14px 22px -6px rgba(0,0,0,0.49);">
                            <div class="grid grid-cols-7 items-center p-2">
                                <div class="col-span-4 p-3">
                                    <img src="{{ asset('images/Logo_Minos/LOGO.png') }}" width="40%" alt="Logo">
                                </div>
                                <div class="col-span-3 flex justify-end">
                                    <div class="flex items-end">
                                        <label for="simple-search" class="sr-only">productos</label>
                                        <div class="relative w-full max-w-xs">
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <i class="fa fa-edit fa-solid"></i>
                                            </div>
                                            <input type="text" id="simple-search" wire:model.live="buscar"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="producto..." required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full bg-white rounded-3xl  dark:bg-gray-800 ">

                                <div id="fullWidthTabContent" class="border-t dark:border-gray-600">

                                    <div class="p-3  rounded-3xl bg-white  border-2 border-gray-400 dark:bg-gray-800" role="tabpanel"
                                        aria-labelledby="stats-tab">
                                        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 gap-6">
                                            @foreach ($productos as $producto)
                                                @php
                                                    $class = '';
                                                    if ($producto->valor <= $minPrice + $range) {
                                                        $class = 'bg-lime-400'; // Precio bajo
                                                    } elseif ($producto->valor <= $minPrice + 2 * $range) {
                                                        $class = 'bg-yellow-400'; // Precio medio
                                                    } else {
                                                        $class = 'bg-red-400'; // Precio alto
                                                    }
                                                @endphp
                                                <div
                                                    class="flex items-center justify-between px-2 py-2 bg-white border-2 border-gray-400 rounded-full shadow-md dark:bg-gray-700">
                                                    <!-- Imagen del producto -->
                                                    {{-- <div class="flex-shrink-0">
                                                    <img class="w-12 h-12 rounded-full object-cover" src="{{ asset('storage/productos/' . $producto->image) }}" alt="{{ $producto->product_name }}">
                                                </div> --}}

                                                    <!-- Información del producto -->
                                                    <div class="mx-4">
                                                        <p class="text-md text-gray-500 dark:text-gray-400">
                                                            {{ $producto->product_name }}</p>
                                                    </div>

                                                    <!-- Precio del producto -->
                                                    <div class="text-right">
                                                        <p class="text-md text-gray-500 dark:text-gray-400">
                                                            {{ $producto->supplier_name }}</p>
                                                    </div>

                                                    <!-- Indicador de estado (punto) -->
                                                    <div class="mx-4">
                                                        {{-- <span class="text-sm font-semibold text-gray-900 dark:text-white">${{ number_format($producto->valor, 0) }}</span> --}}
                                                        <button type="button"
                                                            class="inline-block py-2 px-4 rounded-full {{ $class }}">
                                                            ${{ number_format($producto->valor, 0) }}
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="mt-4 flex justify-center">
                                            {{ $productos->links('partials.v1.table.pagination-links') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta del gráfico de productos 1 y 2 -->
                        <div class="lg:col-span-5 sm:col-span-12 grid grid-cols-1 gap-8 ">
                            <div class="bg-gray-200  rounded-3xl p-2"
                                style="-webkit-box-shadow: 1px 14px 22px -6px rgba(0,0,0,0.49);
                                -moz-box-shadow: 1px 14px 22px -6px rgba(0,0,0,0.49);
                                box-shadow: 1px 14px 22px -6px rgba(0,0,0,0.49);">
                                <livewire:dashboard.chart-component />
                            </div>
                            <div class="bg-gray-200  rounded-3xl p-2"style="-webkit-box-shadow: 1px 14px 22px -6px rgba(0,0,0,0.49);
                                -moz-box-shadow: 1px 14px 22px -6px rgba(0,0,0,0.49);
                                box-shadow: 1px 14px 22px -6px rgba(0,0,0,0.49);">
                                <livewire:dashboard.chart-inventario-component />
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>
</div>
</div>



</div>
