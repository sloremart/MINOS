<div class="p-4 relative">
    <!-- Botón para abrir el modal -->
    <div class="text-right z-20 mt-16 relative">
        <button wire:click="openModal" class="bg-blue-900 text-gray-200 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded inline-flex items-center shadow-md">
            <i class="fa-solid fa-circle-plus mr-2"></i>
            Crear Proveedor
        </button>
    </div>

    <!-- Imagen curva superior -->
    <div class="absolute top-0 left-0 w-full h-40 opacity-70 z-10">
        <img src="/images/curvas_arriba.png" alt="Top Curve" class="w-full h-40 object-cover">
    </div>

    <!-- Modal -->
    @if($isOpen)
        <div class="fixed z-50 inset-0 flex items-center justify-center bg-gray-900 bg-opacity-80" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-xl sm:w-full z-10" style="background-image: url('/images/icono_central.png'); background-size: contain; background-repeat: no-repeat; background-position: center;">

                <!-- Encabezado del Modal -->
                <div class="bg-blue-900 text-gray-200 bg-opacity-75 px-4 py-3 sm:px-6 rounded-t-lg">
                    <div class="flex flex-col items-center w-full">
                        <!-- Fecha actual -->
                        <div class="text-sm text-gray-200 mb-2 self-end">
                            {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                        </div>

                        <h3 class="text-lg leading-6 font-medium text-gray-200 text-center w-full" id="modal-title">
                            {{ $id ? 'EDITAR PROVEEDOR' : 'CREAR PROVEEDOR' }}
                        </h3>
                    </div>
                </div>

                <!-- Cuerpo del Modal con Fondo -->
                <div class="bg-white bg-opacity-75 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <input type="text" wire:model="document" placeholder="Documento" class="w-full p-2 border rounded-lg shadow-inner bg-blue-50">
                        @error('document') <span class="text-red-500">{{ $message }}</span> @enderror

                        <input type="text" wire:model="name" placeholder="Nombre Proveedor" class="w-full p-2 border rounded-lg shadow-inner bg-blue-50">
                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

                        <input type="email" wire:model="email" placeholder="Correo Electrónico" class="w-full p-2 border rounded-lg shadow-inner bg-blue-50">
                        @error('email') <span class="text-red-500">{{ $message }}</span> @enderror

                        <input type="text" wire:model="phone" placeholder="Teléfono" class="w-full p-2 border rounded-lg shadow-inner bg-blue-50">
                        @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror

                        <input type="text" wire:model="address" placeholder="Dirección" class="w-full p-2 border rounded-lg shadow-inner bg-blue-50">
                        @error('address') <span class="text-red-500">{{ $message }}</span> @enderror

                        <input type="text" wire:model="city" placeholder="Ciudad" class="w-full p-2 border rounded-lg shadow-inner bg-blue-50">
                        @error('city') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Pie del Modal -->
                <div class="bg-blue-900 text-gray-200 bg-opacity-75 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-lg">
                    <button wire:click="store" type="button" class="bg-blue-900 text-gray-200 inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">
                        Guardar
                    </button>
                    <button wire:click="closeModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Tabla de proveedores -->
    <div class="overflow-x-auto mt-5 relative z-10">
        <table class="table-auto w-full border-collapse bg-white shadow-lg rounded-lg overflow-hidden">
            <thead class="bg-blue-900 text-gray-200 uppercase text-sm leading-normal">
            <tr>
                <th class="px-4 py-2 border-b">Documento</th>
                <th class="px-4 py-2 border-b">Nombre Proveedor</th>
                <th class="px-4 py-2 border-b">Correo Electrónico</th>
                <th class="px-4 py-2 border-b">Teléfono</th>
                <th class="px-4 py-2 border-b">Dirección</th>
                <th class="px-4 py-2 border-b">Ciudad</th>
                <th class="px-4 py-2 border-b">Acciones</th>
            </tr>
            </thead>
            <tbody class="text-gray-700 text-sm font-light">
            @foreach($suppliers as $supplier)
                <tr class="border-b hover:bg-blue-100">
                    <td class="px-4 py-2 border-b">{{ $supplier->document }}</td>
                    <td class="px-4 py-2 border-b">{{ $supplier->name }}</td>
                    <td class="px-4 py-2 border-b">{{ $supplier->email }}</td>
                    <td class="px-4 py-2 border-b">{{ $supplier->phone }}</td>
                    <td class="px-4 py-2 border-b">{{ $supplier->address }}</td>
                    <td class="px-4 py-2 border-b">{{ $supplier->city }}</td>
                    <td class="px-4 py-2 border-b flex space-x-2">
                        <!-- Botón de editar con ícono de lápiz -->
                        <button wire:click="insert({{ $supplier->id }})" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                        <!-- Botón de eliminar con ícono de basurero -->
                        <button wire:click="delete({{ $supplier->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
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
