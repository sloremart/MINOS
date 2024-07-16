<!-- resources/views/livewire/components/index-models/client-index.blade.php -->
<div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($button_add)
                <div class="flex justify-end mb-4">
                    <x-button class="{{ $button_color }}" x-on:click="$dispatch('open-modal', { id: 'createSupplierModal' })">
                        {{ __($button_label) }}
                    </x-button>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mx-auto">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                            <tr>
                                @foreach($table_headers as $header)
                                    <th class="py-2 px-4 bg-gray-200 text-gray-600 font-bold uppercase text-sm text-left">{{ $header['col_name'] }}</th>
                                @endforeach
                                <th class="py-2 px-4 bg-gray-200 text-gray-600 font-bold uppercase text-sm text-left">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $row)
                                <tr>
                                    @foreach($table_headers as $header)
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $row->{$header['col_data']} }}</td>
                                    @endforeach
                                    <td class="py-2 px-4 border-b border-gray-200 ">
                                        @foreach($actions as $action)
                                            <button wire:click="{{ $action['method'] }}({{ $row->id }})" class="text-gray-600 hover:text-gray-900 " @if($action['method'] == 'insert') x-on:click="$dispatch('open-modal', { id: 'createSupplierModal' })" @endif>
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $action['icon'] }}"></path>
                                                </svg>
                                            </button>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <x-modal id="createSupplierModal" maxWidth="lg">
            <x-slot name="header">
                <h2 class="text-xl font-bold">Agregar Cliente</h2>
            </x-slot>

            <x-slot name="body">
                <form wire:submit.prevent="{{(($modelForm->id ?? null) != null)? 'edit':'save'}}">
                    <div class="m-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                        <input type="text" id="name" wire:model="modelForm.name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="m-4">
                        <label for="document" class="block text-gray-700 text-sm font-bold mb-2">Documento:</label>
                        <input type="text" id="document" wire:model="modelForm.document" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="m-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                        <input type="email" id="email" wire:model="modelForm.email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="m-4">
                        <label for="direccion" class="block text-gray-700 text-sm font-bold mb-2">Dirección:</label>
                        <input type="text" id="direccion" wire:model="modelForm.address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="m-4">
                        <label for="ciudad" class="block text-gray-700 text-sm font-bold mb-2">Ciudad:</label>
                        <input type="text" id="ciudad" wire:model="modelForm.city" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="m-4">
                        <label for="telefono" class="block text-gray-700 text-sm font-bold mb-2">Teléfono:</label>
                        <input type="text" id="telefono" wire:model="modelForm.phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </form>

            </x-slot>

            <x-slot name="footer">
                <x-button type="button" class="bg-gray-500 hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-600" x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </x-button>
                <x-button type="submit" class="bg-blue-500 hover:bg-blue-400 focus:bg-blue-400 active:bg-blue-600" wire:click="{{(($modelForm->id ?? null) != null)? 'edit':'save'}}">
                    {{(($modelForm->id ?? null) != null)? 'Actualizar':'Crear'}}
                </x-button>
            </x-slot>
        </x-modal>

    </div>

</div>
@push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('open-modal', event => {
                document.getElementById(event.id).__x.$data.show = true;
                console.log(event);
            });
            Livewire.on('close-modal', event => {
                document.getElementById(event.id).__x.$data.show = false;
            });
        });
    </script>
@endpush

