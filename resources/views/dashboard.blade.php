<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    {{-- <x-welcome /> --}}
                    <span class="p-4" style="font-size: 20px;"> ESTILO 1</span>
    
                    <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-3 p-4">
                        <div class="flex flex-col">
                            <span class="p-4" style="font-size: 20px;">BOTON PARA INSERTAR DATOS  </span>
                            @livewire('boton-agregar')
                        </div>
                        <div class="flex flex-col">
                            <span class="p-4" style="font-size: 20px;">BOTON PARA CALCELAR O CERRAR </span>
    
                            @livewire('boton-cancelar')
                        </div>
                        <div class="flex flex-col">
                            <span class="p-4" style="font-size: 20px;">BOTON PARA EDITAR DATOS  </span>
                            @livewire('boton-editar')
                        </div>
    
                    </div>
    
                </div>
    
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    {{-- <x-welcome /> --}}
                    <span class="p-4" style="font-size: 20px;"> ESTILO 2 "ICONOS"</span>
    
                    <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 p-4">
                        <div class="flex flex-col">
                            <span class="p-4" style="font-size: 20px; ">BOTON PARA INSERTAR DATOS
                                </span>
                            @livewire('btn-addicono')
                        </div>
                        <div class="flex flex-col">
                            <span class="p-4" style="font-size: 20px;">BOTON PARA CANCELAR O CERRAR </span>
                            @livewire('btn-close-deleteicono')
    
                        </div>
                        <div class="flex flex-col">
                            <span class="p-4" style="font-size: 20px;">BOTON PARA EDITAR DATOS EN EL FORMULARIO O TABLAS
                                </span>
                            @livewire('btn-editicono')
                        </div>
    
                    </div>
                </div>
    
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    {{-- <x-welcome /> --}}
                    <span class="p-4" style="font-size: 20px;"> ESTILO 3 BOTON OUTLINE </span>
    
                    <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 p-4">
                        <div class="flex flex-col">
                            <span class="p-4" style="font-size: 20px; ">BOTON PARA INSERTAR DATOS 
                                </span>
                            @livewire('btn-add-outline')
    
                        </div>
                        <div class="flex flex-col">
                            <span class="p-4" style="font-size: 20px;">BOTON PARA CANCELAR O CERRAR </span>
    
                            @livewire('btn-close-delete-outline')
                        </div>
                        <div class="flex flex-col">
                            <span class="p-4" style="font-size: 20px;">BOTON PARA EDITAR DATOS EN EL FORMULARIO
                                </span>
                            @livewire('btn-edit-outline')
                        </div>
    
                    </div>
                </div>
    
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    {{-- <x-welcome /> --}}
                    <span class="p-4" style="font-size: 20px;"> ESTILO 4 BOTON OUTLINE "ICONOS"</span>
    
                    <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 p-4">
                        <div class="flex flex-col">
                            <span class="p-4" style="font-size: 20px; ">BOTON PARA INSERTAR DATOS 
                                </span>
                                    @livewire('btn-add-outline-icono')
                           
                        </div>
                        <div class="flex flex-col">
                            <span class="p-4" style="font-size: 20px;">BOTON PARA CANCELAR O CERRAR </span>
                          @livewire('btn-close-delete-outline-icono')
                        </div>
                        <div class="flex flex-col">
                            <span class="p-4" style="font-size: 20px;">BOTON PARA EDITAR DATOS EN EL FORMULARIO  O TABLAS
                                </span>
                                @livewire('btn-edit-outline-icono')
                        </div>
    
                    </div>
                </div>
    
            </div>
        </div>
    </div>

</x-app-layout>
@livewire('modales-component')
{{-- @livewire('moda-registro-cliente-component') --}}
