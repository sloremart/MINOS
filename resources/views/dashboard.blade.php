<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="relative z-10">
         @livewire('dashboard.dashboardd-component')
    </div>

</x-app-layout>

{{-- @livewire('moda-registro-cliente-component') --}}
