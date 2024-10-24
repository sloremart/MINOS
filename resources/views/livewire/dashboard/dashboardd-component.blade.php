<div>
    <!-- Contenedor principal con espaciado y bordes redondeados -->
    <div class="pb-4 rounded-3xl">
        <!-- Contenedor central con máximo ancho y espaciado -->
        <div class=" max-w-screen-xl mx-auto  sm:px-6 lg:px-0 rounded-3xl bg-white shadow-2xl">
            <!-- Contenedor con bordes redondeados y espaciado -->
            <div class=" relative z-1  overflow-hidden sm:rounded-lg rounded-3xl">
                <!-- Grid para mostrar las tarjetas de estadísticas -->
                <div class="grid max-w-screen-xl grid-cols-1  gap-8 m-4  text-gray-900 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-3 dark:text-white">
                    <!-- Tarjeta de Usuarios -->
                    <div class="flex items-center justify-center p-2  rounded-full  shadow-2xl"
                        style="background: #21529b;">
                        <div class="flex flex-col  justify-center  flex-grow px-10 text-white">
                            <span class="text-xl">USUARIOS</span>
                            <h1 class="text-4xl">{{ $userCount }}</h1>
                            <span class="text-xl ">ACTUALES</span>
                        </div>
                        <div class="flex items-center justify-center  p-3  rounded-r-full"
                            style="width: 30%; height: 100%; background: #2e6cb4;">
                            <img src="{{ asset('images/DASHBOARD/IconoUsuarios.png') }}" class="text-white" alt="" style="width: 70%">
                        </div>
                    </div>

                    <!-- Tarjeta de Proveedores -->
                    <div class="flex items-center justify-center p-2  rounded-full shadow-2xl"
                        style="background: #662483;">
                        <div class="flex flex-col  justify-center  flex-grow px-10 text-white">
                            <span class="text-xl">CLIENTES</span>
                            <h1 class="text-4xl">{{ $Client }}</h1>
                            <span class="text-xl ">ACTUALES</span>
                        </div>
                        <div class="flex items-center justify-center b p-3  rounded-r-full"
                            style="width: 30%; height: 100%;  background: #754997;">
                            <img src="{{ asset('images/DASHBOARD/IconoClientes.png') }}" class="text-white" width="70"
                                alt="">
                        </div>
                    </div>


                    <!-- Tarjeta de Ventas Hoy -->
                    <div class="flex items-center justify-center p-2 rounded-full  shadow-2xl"
                        style="background: #85b9e5;">
                        <div class="flex flex-col  justify-center  flex-grow px-10 text-white">
                            <span class="text-xl"> VENTA TOTAL</span>
                            <h1 class=" text-2xl">$ {{ $totalSalesFormatted }}</h1>
                            <span class="text-xl ">ACTUALES</span>
                        </div>
                        <div class="flex items-center justify-center  p-3  rounded-r-full"
                            style="width: 30%; height: 100%; background: #a8d7f5;">
                            <img src="{{ asset('images/DASHBOARD/IconoVentas.png') }}" class="text-white" width="70"
                                alt="">
                        </div>
                    </div>


                </div>
            </div>

            <!-- Contenedor para productos y gráfico -->

            <div class=" overflow-x-auto   rounded-3xl " style="background: #F6F6F6">
                <div class="grid grid-cols-1 m-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-4 md:gap-8 sm:gap-8">
                    <!-- Tarjeta de productos -->
                    <div class="p-2 py-0   max-w-screen-xl rounded-3xl  lg:col-span-7 sm:col-span-12 max-h-[800px] sm:max-h-[608px]"
                        style="box-shadow:rgba(0, 0, 0, 0.474) 0px 4px 8px" style="background: #F6F6F6">
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


                        <div class="w-full bg-white rounded-3xl border-2  dark:bg-gray-800 overflow-y-auto"
                            style="border-color: #B1B7C3; height: 31rem;">

                            <div id="fullWidthTabContent" class="border-t dark:border-gray-600 ">

                                <div class="p-3   rounded-3xl bg-white   dark:bg-gray-800" role="tabpanel"
                                    aria-labelledby="stats-tab">
                                    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 gap-6">
                                        @php
                                        // Agrupar productos por nombre y proveedor
                                        $groupedProducts = [];
                                        foreach ($productos as $producto) {
                                            // Crear una clave única que combine el nombre del producto y el proveedor
                                            $key = $producto->product_name . '|' . $producto->supplier_name;
                                            $groupedProducts[$key] = $producto; // Almacenar solo una instancia del producto
                                        }
                                    @endphp
                                
                                    @foreach ($groupedProducts as $producto)
                                        @php
                                            // Determinar los precios mínimo y máximo
                                            // Aquí no necesitas calcular min y max de precios ya que solo muestras un producto por proveedor
                                            $class = '';
                                            // Asignar color según el precio del producto
                                            if ($producto->valor <= 10000) { // Aquí ajusta el valor según tu rango
                                                $class = "#3AAA35"; // Precio bajo
                                            } elseif ($producto->valor <= 20000) {
                                                $class = '#FCEA10'; // Precio medio
                                            } else {
                                                $class = '#E6332A'; // Precio alto
                                            }
                                        @endphp
                                
                                        <div class="flex items-center justify-between px-2 py-2 bg-white border-2 rounded-full shadow-md dark:bg-gray-700" style="border-color: #B1B7C3">
                                            <!-- Información del producto -->
                                            <div class="mx-1">
                                                <p class="text-sm text-gray-500 dark:text-gray-400 text-center font-bold">
                                                    {{ $producto->product_name }}
                                                </p>
                                            </div>
                                
                                            <!-- Proveedor del producto -->
                                            <div class="text-right">
                                                <p class="text-sm text-center text-gray-500 dark:text-gray-400">
                                                    <strong class="text-black">{{ $producto->supplier_name }}</strong>
                                                </p>
                                            </div>
                                
                                            <!-- Precio del producto -->
                                            <div class="mx-4">
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    <strong class="text-black">${{ number_format($producto->valor, 0) }}</strong>
                                                </p>
                                            </div>
                                
                                            <!-- Indicador de estado (punto) -->
                                            <div class="mx-4">
                                                <button type="button" class="inline-block w-4 h-4 rounded-full" style="background:{{$class}};"></button>
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