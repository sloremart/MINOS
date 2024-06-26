
<!-- resources/views/livewire/suppliers/supplier.blade.php -->
<div>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Listado de proveedores') }}
    </h2>
</x-slot>


<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end mb-4">
            <a href="">
                <x-button class="bg-green-500 hover:bg-green-400 focus:bg-green-400 active:bg-green-600">
                    {{ __('Crear nuevo') }}
                </x-button>
            </a>
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container mx-auto">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                        <tr>
                            <th class="py-2 px-4 bg-gray-200 text-gray-600 font-bold uppercase text-sm text-left">ID</th>
                            <th class="py-2 px-4 bg-gray-200 text-gray-600 font-bold uppercase text-sm text-left">Nombre</th>
                            <th class="py-2 px-4 bg-gray-200 text-gray-600 font-bold uppercase text-sm text-left">Email</th>
                            <th class="py-2 px-4 bg-gray-200 text-gray-600 font-bold uppercase text-sm text-left">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $user)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $user->id }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $user->name }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $user->email }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    <a href="" class="text-blue-600 hover:text-blue-900">Editar</a>
                                    <form action="" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
