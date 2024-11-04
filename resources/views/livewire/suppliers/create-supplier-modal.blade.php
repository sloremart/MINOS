<div>

     <!-- VISTA PRINCIPAL DE CREAR PROVEEDOR -->

    <button wire:click="$set('showModal', true)" class="bg-green-500 hover:bg-green-400 focus:bg-green-400 active:bg-green-600 text-white px-4 py-2 rounded">
        {{ __('Crear nuevo') }}
    </button>

    @if($showModal)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    {{ __('Crear nuevo proveedor') }}
                                </h3>
                                <div class="mt-2">
                                    <form wire:submit.prevent="createSupplier">
                                        <div class="mb-4">
                                            <x-label for="name" :value="__('Nombre')" />
                                            <x-input id="name" type="text" class="block mt-1 w-full" wire:model="name" required autofocus />
                                            @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mb-4">
                                            <x-label for="document" :value="__('Documento')" />
                                            <x-input id="document" type="text" class="block mt-1 w-full" wire:model="document" required />
                                            @error('document') <span class="text-red-600">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mb-4">
                                            <x-label for="email" :value="__('Email')" />
                                            <x-input id="email" type="email" class="block mt-1 w-full" wire:model="email" required />
                                            @error('email') <span class="text-red-600">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mb-4">
                                            <x-label for="phone" :value="__('Teléfono')" />
                                            <x-input id="phone" type="text" class="block mt-1 w-full" wire:model="phone" required />
                                            @error('phone') <span class="text-red-600">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mb-4">
                                            <x-label for="address" :value="__('Dirección')" />
                                            <x-input id="address" type="text" class="block mt-1 w-full" wire:model="address" required />
                                            @error('address') <span class="text-red-600">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mb-4">
                                            <x-label for="city" :value="__('Ciudad')" />
                                            <x-input id="city" type="text" class="block mt-1 w-full" wire:model="city" required />
                                            @error('city') <span class="text-red-600">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mb-4">
                                            <x-label for="user_id" :value="__('Usuario')" />
                                            <x-input id="user_id" type="number" class="block mt-1 w-full" wire:model="user_id" required />
                                            @error('user_id') <span class="text-red-600">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mt-4">
                                            <x-button>
                                                {{ __('Crear') }}
                                            </x-button>
                                            <button type="button" wire:click="$set('showModal', false)" class="ml-4 bg-gray-500 hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-600 text-white px-4 py-2 rounded">
                                                {{ __('Cancelar') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
