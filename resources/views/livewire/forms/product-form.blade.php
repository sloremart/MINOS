<div class="p-4 relative">
    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="fixed top-0 left-0 right-0 bg-green-500 text-white p-3 rounded shadow-md mb-6 z-50 text-center">
            {{ session('message') }}
        </div>
    @endif

    <!-- Botón para abrir el modal -->
    <div class="text-right z-20 mt-16 relative max-w-6xl mx-auto">
        <button wire:click="create" class="bg-blue-900 text-gray-200 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded inline-flex items-center shadow-md">
            <i class="fa-solid fa-circle-plus mr-2"></i>
            Crear Producto
        </button>
    </div>

    <!-- Imagen curva superior -->
    <div class="absolute top-0 left-0 w-full h-40 opacity-70 z-10">
        <img src="/images/curvas_arriba.png" alt="Top Curve" class="w-full h-40 object-cover">
    </div>

    <!-- Modal -->
    @if($isOpen)
        <div class="fixed z-50 inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-2xl sm:w-full z-10" style="background-image: url('/images/icono_central.png'); background-size: contain; background-repeat: no-repeat; background-position: center;">

                <!-- Aquí está la parte superior azul con el título centrado -->
                <div class="bg-blue-900 text-gray-200 bg-opacity-75 px-4 py-3 sm:px-6 rounded-t-lg">
                    <div class="flex flex-col items-center w-full">
                        <!-- Fecha actual -->
                        <div class="text-sm text-gray-200 mb-2 self-end">
                            {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                        </div>

                        <h3 class="text-lg leading-6 font-medium text-gray-200 text-center w-full" id="modal-title">
                            {{ $id ? 'EDITAR PRODUCTO' : 'CREAR PRODUCTO' }}
                        </h3>
                    </div>
                </div>


                <div class="bg-white bg-opacity-75 px-4 pt-5 pb-4 sm:p-6 sm:pb-4 rounded-b-lg">
                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <input type="text" wire:model="codigo_producto" placeholder="Código Producto" class="w-full p-2 border rounded-lg shadow-inner bg-blue-50">
                        @error('codigo_producto') <span class="text-red-500">{{ $message }}</span> @enderror

                        <input type="text" wire:model="grupo_producto" placeholder="Grupo Producto" class="w-full p-2 border rounded-lg shadow-inner bg-blue-50">
                        @error('grupo_producto') <span class="text-red-500">{{ $message }}</span> @enderror

                        <input type="text" wire:model="sub_grupo_producto" placeholder="Sub Grupo Producto" class="w-full p-2 border rounded-lg shadow-inner bg-blue-50">
                        @error('sub_grupo_producto') <span class="text-red-500">{{ $message }}</span> @enderror

                        <input type="text" wire:model="clase_producto" placeholder="Clase Producto" class="w-full p-2 border rounded-lg shadow-inner bg-blue-50">
                        @error('clase_producto') <span class="text-red-500">{{ $message }}</span> @enderror

                        <input type="text" wire:model="nombre_producto" placeholder="Nombre Producto" class="w-full p-2 border rounded-lg shadow-inner bg-blue-50">
                        @error('nombre_producto') <span class="text-red-500">{{ $message }}</span> @enderror

                        <input type="text" wire:model="presentacion" placeholder="Presentación" class="w-full p-2 border rounded-lg shadow-inner bg-blue-50">
                        @error('presentacion') <span class="text-red-500">{{ $message }}</span> @enderror

                        <input type="text" wire:model="tipo_unidad" placeholder="Tipo Unidad" class="w-full p-2 border rounded-lg shadow-inner bg-blue-50">
                        @error('tipo_unidad') <span class="text-red-500">{{ $message }}</span> @enderror

                        <input type="text" wire:model="valor_venta" placeholder="Valor Venta" class="w-full p-2 border rounded-lg shadow-inner bg-blue-50">
                        @error('valor_venta') <span class="text-red-500">{{ $message }}</span> @enderror

                        <input type="text" wire:model="stock" placeholder="Stock" class="w-full p-2 border rounded-lg shadow-inner bg-blue-50">
                        @error('stock') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Aquí está la parte inferior con los botones -->
                <div class=" text-gray-200 bg-opacity-75 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-lg">
                    <button wire:click="store()" type="button" class="bg-blue-900 text-gray-200 inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">
                        Guardar
                    </button>
                    <button wire:click="closeModal()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Tabla de productos -->
    <div class="overflow-x-auto mt-5 relative z-10 max-w-6xl mx-auto">
        <table class="table-auto w-full border-collapse bg-white shadow-lg rounded-lg overflow-hidden">
            <thead class="bg-blue-900 text-gray-200 uppercase text-sm leading-normal">
            <tr>
                <th class="px-4 py-2 border-b">Código Producto</th>
                <th class="px-4 py-2 border-b">Grupo Producto</th>
                <th class="px-4 py-2 border-b">Sub Grupo Producto</th>
                <th class="px-4 py-2 border-b">Clase Producto</th>
                <th class="px-4 py-2 border-b">Nombre Producto</th>
                <th class="px-4 py-2 border-b">Presentación</th>
                <th class="px-4 py-2 border-b">Tipo Unidad</th>
                <th class="px-4 py-2 border-b">Valor Venta</th>
                <th class="px-4 py-2 border-b">Stock</th>
                <th class="px-4 py-2 border-b">Acciones</th>
            </tr>
            </thead>
            <tbody class="text-gray-700 text-sm font-light">
            @foreach($products as $product)
                <tr class="border-b hover:bg-blue-100">
                    <td class="px-4 py-2 border-b">{{ $product->codigo_producto }}</td>
                    <td class="px-4 py-2 border-b">{{ $product->grupo_producto }}</td>
                    <td class="px-4 py-2 border-b">{{ $product->sub_grupo_producto }}</td>
                    <td class="px-4 py-2 border-b">{{ $product->clase_producto }}</td>
                    <td class="px-4 py-2 border-b">{{ $product->nombre_producto }}</td>
                    <td class="px-4 py-2 border-b">{{ $product->presentacion }}</td>
                    <td class="px-4 py-2 border-b">{{ $product->tipo_unidad }}</td>
                    <td class="px-4 py-2 border-b">{{ $product->valor_venta }}</td>
                    <td class="px-4 py-2 border-b">{{ $product->stock }}</td>
                    <td class="px-4 py-2 border-b flex space-x-2">

                        <button wire:click="edit({{ $product->id }})" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>


                        <button wire:click="delete({{ $product->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Imagen curva inferior derecha -->
    <div class="fixed bottom-0 right-0 opacity-70 z-0">
        <img src="/images/curvas_abajo.png" alt="Bottom Curve" class="w-full h-40 md:h-60 object-right-bottom">
    </div>
</div>