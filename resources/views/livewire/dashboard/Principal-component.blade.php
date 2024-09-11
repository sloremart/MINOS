<div>
    <!-- Contenedor principal con espaciado y bordes redondeados -->
    <div class="py-12 rounded-3xl">
        <!-- Contenedor central con máximo ancho y espaciado -->
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8 rounded-3xl">
            <!-- Contenedor con bordes redondeados y espaciado -->
            <div class="overflow-hidden sm:rounded-lg rounded-3xl p-6">
                <!-- Grid para mostrar las tarjetas de estadísticas -->
                <div
                    class="grid max-w-screen-xl grid-cols-1 gap-8 p-1 mx-auto text-gray-900 sm:grid-cols-2 md:grid-cols-4 xl:grid-cols-4 dark:text-white">
                    <!-- Tarjeta de Usuarios -->
                    <div class="flex flex-col items-center justify-center bg-white rounded-lg shadow-lg">
                        <div class="grid grid-cols-6 text-3xl font-extrabold">
                            <div class="col-span-4 row-span-4 p-2">
                                <h1 class="text-3xl">{{ $userCount }}</h1>
                                <span class="text-lg">USUARIOS</span>
                            </div>
                            <div class="col-span-2 row-span-4 p-2 flex justify-center items-center">
                                <img src="{{ asset('images/Iconos_Menu/ADMINISTRACION/Usuarios.png') }}" alt="Usuarios"
                                    class="rounded-full shadow-lg">
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta de Proveedores -->
                    <div class="flex flex-col items-center justify-center bg-white rounded-lg shadow-lg">
                        <div class="grid grid-cols-6 text-3xl font-extrabold">
                            <div class="col-span-4 row-span-4 p-2">
                                <h1 class="text-3xl">{{ $proveedorCount }}</h1>
                                <span class="text-lg">PROVEEDORES</span>
                            </div>
                            <div class="col-span-2 row-span-4 p-2 flex justify-center items-center">
                                <img src="{{ asset('images/Iconos_Menu/ADMINISTRACION/Roles.png') }}" alt="Proveedores"
                                    class="rounded-full shadow-lg">
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta de Ventas Hoy -->
                    <div class="flex flex-col items-center justify-center bg-white rounded-lg shadow-lg">
                        <div class="grid grid-cols-6 text-3xl font-extrabold">
                            <div class="col-span-4 row-span-4 p-2">
                                <h1 class="text-3xl">VENTAS HOY</h1>
                                <button
                                    class="p-2.5 ms-2 text-sm font-medium text-green bg-lime-300 rounded-lg border border-lime-300 hover:bg-lime-300 focus:ring-4 focus:outline-none dark:bg-purple-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">$
                                    0.00</button>
                            </div>
                            <div class="col-span-2 row-span-4 p-2 flex justify-center items-center">
                                <img src="{{ asset('images/Iconos_Menu/VENTAS/VENTAS.png') }}" alt="Ventas Hoy"
                                    class="rounded-full shadow-lg">
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta de Venta Mensual -->
                    <div class="flex flex-col items-center justify-center bg-white rounded-lg shadow-lg">
                        <div class="grid grid-cols-6 text-3xl font-extrabold">
                            <div class="col-span-4 row-span-4 p-2">
                                <h1 class="text-3xl">VENTA MENSUAL</h1>
                                <button
                                    class="p-2.5 ms-2 text-sm font-medium text-green bg-lime-300 rounded-lg border border-lime-300 hover:bg-lime-300 focus:ring-4 focus:outline-none dark:bg-purple-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">$
                                    0.00</button>
                            </div>
                            <div class="col-span-2 row-span-4 p-2 flex justify-center items-center">
                                <img src="{{ asset('images/Iconos_Menu/VENTAS/Ventas2.png') }}" alt="Venta Mensual"
                                    class="rounded-full shadow-lg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
            <!-- Contenedor para productos y gráfico -->
            <div class="overflow-hidden sm:rounded-lg rounded-3xl p-6">
                <div class="relative overflow-x-auto p-2 rounded-3xl">
                    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
                        <!-- Tarjeta de productos -->
                        <div class="bg-white shadow-lg rounded-lg lg:col-span-4 sm:col-span-4 lg:row-span-12">
                            <div class="w-full bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
                                <div id="fullWidthTabContent" class="border-t dark:border-gray-600">
                                    <div class="grid grid-cols-2 items-center p-2">
                                        <div class="col-span-1 p-3">
                                            <img src="{{ asset('images/Logo_Minos/LOGO.png') }}" width="40%"
                                                alt="Logo">
                                        </div>
                                        <div class="col-span-1 flex justify-end">
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
                                    <div class="p-4 rounded-lg dark:bg-gray-800" role="tabpanel"
                                        aria-labelledby="stats-tab">
                                        <div
                                            class="grid grid-cols-1 gap-4 md:grid-cols-2 xxl:grid-cols-3">
                                            @foreach ($productos as $producto)
                                            @php
                                            $class = '';
                                            if ($producto->valor <= $minPrice + $range) {
                                                $class='bg-lime-400' ; // Precio bajo
                                                } elseif ($producto->valor <= $minPrice + 2 * $range) {
                                                    $class='bg-yellow-400' ; // Precio medio
                                                    } else {
                                                    $class='bg-red-400' ; // Precio alto
                                                    }
                                                    @endphp
                                                    <div class="relative p-1 rounded-lg  border-1 border-transparent bg-gradient-to-r from-purple-400 to-blue-400 shadow-lg">
                                                    <div class="flex items-center h-full gap-2 justify-evenly  border rounded  bg-white p-1">
                                                        <div class="flex justify-center items-center w-90px h-90px flex-shrink-0 xl:w-110px xl:h-110px rounded overflow-hidden mx-20px lg:mx-30px">
                                                            <img class="object-cover max-w-24"
                                                                src="{{ asset('storage/productos/' . $producto->image) }}"
                                                                alt="{{ $producto->name }}">
                                                        </div>
                                                        <div class="flex flex-col items-end"><span
                                                                class="font-semibold text-gray-900 mb-1">
                                                                <p class="text-end">{{ $producto->name }}</p>
                                                            </span>
                                                            <p class="flex items-end">
                                                                <span
                                                                    class="text-gray-500 text-11px capitalize">{{ $producto->proveedor }}
                                                                </span>
                                                            </p>
                                                            <button class="p-2.5 ms-2 text-sm font-medium text-green mb-2{{ $class }} rounded-lg border {{ $class }} hover:bg-opacity-80 focus:ring-4 focus:outline-none">
                                                                $ {{ $producto->valor }}
                                                            </button>

                                                        </div>
                                                    </div>
                                        </div>

                                        @endforeach



                                    </div>
                                    {{ $productos->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tarjeta del gráfico de productos -->
                    <div
                        class="grid justify-center place-items-center p-2 bg-white shadow-lg rounded-lg lg:col-span-2 sm:col-span-4 lg:row-span-6">
                        <livewire:principal.products-chart>
                    </div>
                    <div
                        class="grid justify-center place-items-center p-2 bg-white shadow-lg rounded-lg lg:col-span-2 sm:col-span-4 lg:row-span-6">
                        2
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</div>