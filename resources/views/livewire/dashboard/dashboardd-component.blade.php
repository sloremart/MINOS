<div>
    <!-- Contenedor principal con espaciado y bordes redondeados -->
    <div class="py-12 rounded-3xl">
        <!-- Contenedor central con máximo ancho y espaciado -->
        <div class=" max-w-screen-xl mx-auto  sm:px-6 lg:px-0 rounded-3xl bg-white shadow-2xl">
            <!-- Contenedor con bordes redondeados y espaciado -->
            <div class="overflow-hidden sm:rounded-lg rounded-3xl py-4  pb-10">
                <!-- Grid para mostrar las tarjetas de estadísticas -->
                <div
                    class="grid max-w-screen-xl grid-cols-1  gap-8 m-4  text-gray-900 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-3 dark:text-white">
                    <!-- Tarjeta de Usuarios -->
                    <div class="flex items-center justify-center p-2  rounded-full  shadow-2xl" style="background: #21529b;">
                        <div class="flex flex-col  justify-center  flex-grow px-10 text-white">
                            <span class="text-xl">USUARIOS</span>
                            <h1 class="text-4xl">{{ $userCount }}</h1>
                            <span class="text-xl ">ACTUALES</span>
                        </div>
                        <div class="flex items-center justify-center  p-3  rounded-r-full"
                            style="width: 30%; height: 100%; background: #2e6cb4;">
                            <img src="{{ asset('images/Iconos Menu/user.svg') }}" class="text-white" alt="">
                        </div>
                    </div>

                    <!-- Tarjeta de Proveedores -->
                    <div class="flex items-center justify-center p-2  rounded-full shadow-2xl" style="background: #662483;">
                        <div class="flex flex-col  justify-center  flex-grow px-10 text-white">
                            <span class="text-xl">CLIENTES</span>
                            <h1 class="text-4xl">{{ $Client }}</h1>
                            <span class="text-xl ">ACTUALES</span>
                        </div>
                        <div class="flex items-center justify-center b p-3  rounded-r-full"
                            style="width: 30%; height: 100%;  background: #754997;">
                            <img src="{{ asset('images/Iconos Menu/customers.svg') }}" class="text-white"
                                alt="">
                        </div>
                    </div>


                    <!-- Tarjeta de Ventas Hoy -->
                    <div class="flex items-center justify-center p-2 rounded-full  shadow-2xl" style="background: #85b9e5;">
                        <div class="flex flex-col  justify-center  flex-grow px-10 text-white">
                            <span class="text-xl"> VENTA TOTAL</span>
                            <h1 class=" text-2xl">$ {{ $totalSalesFormatted }}</h1>
                            <span class="text-xl ">ACTUALES</span>
                        </div>
                        <div class="flex items-center justify-center  p-3  rounded-r-full"
                            style="width: 30%; height: 100%; background: #a8d7f5;">
                            <img src="{{ asset('images/Iconos Menu/sale-svgrepo-com.svg') }}" class="text-white"
                                alt="">
                        </div>
                    </div>


                </div>
            </div>

            <!-- Contenedor para productos y gráfico -->
            <div class="  rounded-3xl ">
                <div class="relative overflow-x-auto rounded-3xl py-7  ">
                    <div
                        class="grid grid-cols-1 m-5 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-4 md:gap-8 sm:gap-8">
                        <!-- Tarjeta de productos -->
                        <div class="bg-gray-100  p-2   max-w-screen-xl rounded-3xl  lg:col-span-7 sm:col-span-12 max-h-[800px] sm:max-h-[380px] "
                            style="box-shadow:rgba(0, 0, 0, 0.474) 0px 4px 8px">
                            <div class="grid grid-cols-7 items-center p-2 rounded-3xl gap-2">
                                <div class="col-span-2">
                                    <img src="{{ asset('images/Logo_Minos/LOGO.png') }}" width="80%" alt="Logo">
                                </div>
                                <div class="col-span-5 pl-2">
                                    <div class="flex items-end w-full">
                                        <label for="simple-search" class="sr-only">productos</label>
                                        <div class="relative w-full">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </div>
                                            <input type="text" id="simple-search" wire:model.live="buscar" 
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-3.5    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="producto..." required="">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div
                                class="w-full bg-white rounded-3xl border-2 border-gray-400 dark:bg-gray-800 overflow-y-auto h-64">

                                <div id="fullWidthTabContent" class="border-t dark:border-gray-600 ">

                                    <div class="p-3   rounded-3xl bg-white   dark:bg-gray-800" role="tabpanel"
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
                                                        <p class="text-md text-center text-gray-500 dark:text-gray-400">
                                                            {{ $producto->supplier_name }}</p>
                                                    </div>

                                                    <!-- Indicador de estado (punto) -->
                                                    <div class="mx-4">
                                                        {{-- <span class="text-sm font-semibold text-gray-900 dark:text-white">${{ number_format($producto->valor, 0) }}</span> --}}
                                                        <p 
                                                            class="text-md text-gray-500 dark:text-gray-400">
                                                            ${{ number_format($producto->valor, 0) }}
                                                    </p>
                                                    </div>
                                                    <div class="mx-4">
                                                        {{-- <span class="text-sm font-semibold text-gray-900 dark:text-white">${{ number_format($producto->valor, 0) }}</span> --}}
                                                        <button type="button"
                                                            class="inline-block  w-4 h-4 rounded-full {{ $class }}">
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class=" grid justify-center mx">
                                {{ $productos->links('partials.v1.table.pagination-links') }}
                            </div>
                        </div>


                        <!-- Tarjeta del gráfico de productos 1 y 2 -->
                        <div class="lg:col-span-5 sm:col-span-12 grid grid-cols-1 gap-8 rounded-3xl ">
                            <div class="bg-gray-100  rounded-3xl p-2"
                                style="box-shadow:rgba(0, 0, 0, 0.474) 0px 4px 8px">
                                <livewire:dashboard.chart-component />
                            </div>
                            <div class="bg-gray-100  rounded-3xl p-2"
                                style="box-shadow:rgba(0, 0, 0, 0.474) 0px 4px 8px">
                                <livewire:dashboard.chart-inventario-component />
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>
