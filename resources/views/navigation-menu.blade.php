<nav x-data="{ open: false }" class=" py-10">

     <!-- NAVEGACION PRINCIPAL DEL SOFTWARE APLICADO EN TODAS LAS VISTAS -->

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 pt-2 sm:px-6 bg-white lg:px-8 bg-gray-0 rounded-full shadow-lg"
        style=" position: relative; z-index: 1; ">
        <div class="flex justify-between h-20">
            <div class="flex pr-10">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/minos.png') }}" alt="IconoMinos" class="w-40 h-auto pb-2.5">
                    </a>
                </div>
            </div>
            <div class="flex w-full justify-evenly">
                <!-- Navigation Links -->
                <div class="hidden lg:flex sm:items-center md:flex-col md:space-y-2 px-3">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('images/Iconos Menu/INICIO/INICIO.png') }}" alt="Inicio"
                                class="w-10 h-auto pb-2.5">
                            <span>{{ __('Inicio') }}</span>
                        </div>
                    </x-nav-link>
                </div>

                <div class="hidden lg:flex sm:items-center md:flex-col md:space-y-2 px-3">
                    <x-nav-link href="{{ route('sale.list') }}" :active="request()->routeIs('sale.list')">
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('images/Iconos Menu/VENTAS/Ventas.png') }}" alt="aca va el icono"
                                class="w-10 h-auto pb-2.5">
                            <span>{{ __('Ventas') }}</span>
                        </div>
                    </x-nav-link>
                </div>

                <div class="hidden lg:flex sm:items-center md:flex-col md:space-y-2 px-3">
                    <x-nav-link href="{{ route('purchase.list') }}" :active="request()->routeIs('purchase.list')">
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('images/Iconos Menu/COMPRAS/COMPRAS.png') }}" alt="aca va el icono"
                                class="w-10 h-auto pb-2.5">
                            <span>{{ __('Compras') }}</span>
                        </div>
                    </x-nav-link>
                </div>
                <div class="hidden lg:flex sm:items-center md:flex-col md:space-y-2 px-3">
                    <x-nav-link href="{{ route('cierre_caja.list') }}" :active="request()->routeIs('cierre_caja.list')">
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('images/Iconos_Menu/CIERRE_CAJA/Cierre_Caja.png') }}"
                                alt="aca va el icono" class="h-auto pb-2.5" style="width: 4rem;">
                            <span>{{ __('Cierre Caja') }}</span>
                        </div>
                    </x-nav-link>
                </div>

                <!-- Dropdown -->

                <div class="hidden lg:flex sm:items-center md:flex-col md:space-y-2">
                    <x-dropdown width="48">
                        <x-slot name="trigger">
                            <div class="flex flex-col items-center">
                                <img src="{{ asset('images/Iconos Menu/REPORTES/REPORTES.png') }}"
                                    alt="aca va el icono" class="w-10 h-auto pb-2.5">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400  hover:text-gray-700  focus:outline-none transition ease-in-out duration-150">
                                    {{ __('Reportes') }}
                                    <div class="ms-1">
                                        <svg class="ml-auto h-5 w-5 transition-transform transform"
                                            :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="content">
                            <ul class="text-sm text-gray-700 dark:text-gray-200 relative">
                                <li class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                    :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('reportSale.list') ? 'true' : 'false' }} }">
                                    <a href="{{ route('reportSale.list') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('reportSale.list') ? 'true' : 'false' }} }">
                                        {{ __('Reportes ventas') }}
                                    </a>
                                    <img src="{{ asset('images/Iconos Menu/ADMINISTRACION/Roles.png') }}"
                                        style="width:40px; height: 40px;" alt="Icono 1" class="w-4 h-4">
                                </li>

                                <li class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                    :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('reportCust.list') ? 'true' : 'false' }} }">
                                    <a href="{{ route('reportCust.list') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('reportCust.list') ? 'true' : 'false' }} }">
                                        {{ __('Reporte venta por clientes') }}
                                    </a>
                                    <img src="{{ asset('images/Iconos Menu/ICONOS MENU ADMINISTRACION/Iconos Reportes/Grupos.png') }}"
                                        style="width:40px; height: 40px;" alt="Icono 2" class="w-4 h-4">
                                </li>

                                <li class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                    :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('reportSupplier.list') ? 'true' : 'false' }} }">
                                    <a href="{{ route('reportSupplier.list') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('reportSupplier.list') ? 'true' : 'false' }} }">
                                        {{ __('Reportes compras') }}
                                    </a>
                                    <img src="{{ asset('images/Iconos Menu/ICONOS MENU ADMINISTRACION/Iconos Reportes/Subgrupos.png') }}"
                                        style="width:40px; height: 40px;" alt="Icono 3" class="w-4 h-4">
                                </li>

                                <li class="flex justify-between items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                    :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('reportInv.list') ? 'true' : 'false' }} }">
                                    <a href="{{ route('reportInv.list') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('reportInv.list') ? 'true' : 'false' }} }">
                                        {{ __('Reporte Inventario') }}
                                    </a>
                                    <img src="{{ asset('images/Iconos Menu/ICONOS MENU ADMINISTRACION/Iconos Reportes/Unidades.png') }}"
                                        style="width:40px; height: 40px;" alt="Icono 4" class="w-4 h-4">
                                </li>
                            </ul>
                        </x-slot>
                    </x-dropdown>
                </div>
                <div class="hidden lg:flex sm:items-center md:flex-col md:space-y-2">
                    <x-dropdown width="48">
                        <x-slot name="trigger">
                            <div class="flex flex-col items-center">
                                <img src="{{ asset('images/Iconos Menu/ADMINISTRACION/ADMINISTRACION.png') }}"
                                    alt="aca va el icono" class="w-10 h-auto pb-2.5">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400  hover:text-gray-700  focus:outline-none transition ease-in-out duration-150">
                                    {{ __('Administración') }}
                                    <div class="ms-1">
                                        <svg class="ml-auto h-5 w-5 transition-transform transform"
                                            :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </x-slot>
                        <x-slot name="content">
                            <ul class="text-sm text-gray-700 dark:text-gray-200 relative">
                                <li class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                    :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('commerce_type.list') ? 'true' : 'false' }} }">
                                    <a href="{{ route('supplier.list') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('supplier.list') ? 'true' : 'false' }} }">
                                        {{ __('Proveedores') }}
                                    </a>
                                    <img src="{{ asset('images/Iconos Menu/INVENTARIO/Terceros Proveedores.png') }}"
                                        style="width:40px; height: 40px;" alt="Icono 1" class="w-4 h-4">
                                </li>

                                <li class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                    :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('commerce_type.list') ? 'true' : 'false' }} }">
                                    <a href="{{ route('customer.list') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('customer.list') ? 'true' : 'false' }} }">
                                        {{ __('Clientes') }}
                                    </a>
                                    <img src="{{ asset('images/Iconos Menu/ADMINISTRACION/Usuarios.png') }}"
                                        style="width:40px; height: 40px;" alt="Icono 1" class="w-4 h-4">
                                </li>

                                <li class="flex justify-between items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                    :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('product.list') ? 'true' : 'false' }} }">
                                    <a href="{{ route('product.list') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('product.list') ? 'true' : 'false' }} }">
                                        {{ __('Productos') }}
                                    </a>
                                    <img src="{{ asset('images/Iconos Menu/INVENTARIO/INVENTARIO.png') }}"
                                        style="width:40px; height: 40px;" alt="Icono 1" class="w-4 h-4">
                                </li>
                                <li class="flex justify-between items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                    :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('inventory.list') ? 'true' : 'false' }} }">
                                    <a href="{{ route('inventory.list') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('product.list') ? 'true' : 'false' }} }">
                                        {{ __('Inventarios') }}
                                    </a>
                                    <img src="{{ asset('images/Iconos Menu/INVENTARIO/INVENTARIO.png') }}"
                                        style="width:40px; height: 40px;" alt="Icono 1" class="w-4 h-4">
                                </li>

                            </ul>
                        </x-slot>
                    </x-dropdown>
                </div>



            </div>

            <div class="hidden md:flex sm:items-center lg:border-l border-blue-600 my-3">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-auto h-5 w-5 transition-transform transform"
                                            :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan

                                    <!-- Team Switcher -->
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200"></div>

                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>

                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}"
                                        alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}
                                        <svg class="ml-auto h-5 w-5 transition-transform transform" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Perfil') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <!-- Multinivel -->
                            <div x-data="{ open: false }" @click.away="if (open) { open = false; }">
                                <!-- Botón para abrir/cerrar el submenú -->
                                <button @click.stop="open = !open"
                                    class="flex items-center w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                                    <span>{{ __('Configuraciones') }}</span>
                                    <svg class="ml-auto h-5 w-5 transition-transform transform"
                                        :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Submenú que se despliega -->
                                <div x-show="open" class="mt-2 space-y-2 " x-transition>
                                    <ul class="text-sm text-gray-700 dark:text-gray-200 relative">

                                        <li class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                            :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('commerce_type.list') ? 'true' : 'false' }} }">
                                            <a href="{{ route('commerce_type.list') }}"class="text-left"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('commerce_type.list') ? 'true' : 'false' }} }">
                                                {{ __('Tipos de comercio') }}
                                            </a>
                                            <img src="{{ asset('images/Iconos Menu/ADMINISTRACION/Roles.png') }}"
                                                style="width:40px; height: 40px;" alt="Icono 1" class="w-4 h-4">
                                        </li>


                                        <li class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                            :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('group.list') ? 'true' : 'false' }} }">
                                            <a href="{{ route('group.list') }}"class="text-left"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('group.list') ? 'true' : 'false' }} }">
                                                {{ __('Grupos') }}
                                            </a>
                                            <img src="{{ asset('images/Iconos Menu/ICONOS MENU ADMINISTRACION/Iconos Reportes/Grupos.png') }}"
                                                style="width:40px; height: 40px;" alt="Icono 2" class="w-4 h-4">
                                        </li>

                                        <li class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                            :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('subgroup_all.list') ? 'true' : 'false' }} }">
                                            <a href="{{ route('subgroup_all.list') }}" class="text-left"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('subgroup_all.list') ? 'true' : 'false' }} }">
                                                {{ __('Subgrupos') }}
                                            </a>
                                            <img src="{{ asset('images/Iconos Menu/ICONOS MENU ADMINISTRACION/Iconos Reportes/Subgrupos.png') }}"
                                                style="width:40px; height: 40px;" alt="Icono 3" class="w-4 h-4">
                                        </li>

                                        <li class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                            :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('unit.list') ? 'true' : 'false' }} }">
                                            <a href="{{ route('unit.list') }}" class="text-left"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('unit.list') ? 'true' : 'false' }} }">
                                                {{ __('Unidades') }}
                                            </a>
                                            <img src="{{ asset('images/Iconos Menu/ICONOS MENU ADMINISTRACION/Iconos Reportes/Unidades.png') }}"
                                                style="width:40px; height: 40px;" alt="Icono 4" class="w-4 h-4">
                                        </li>

                                        <li class="flex justify-between items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                            :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('vat_percentage.list') ? 'true' : 'false' }} }">
                                            <a href="{{ route('vat_percentage.list') }}"class="text-left"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('vat_percentage.list') ? 'true' : 'false' }} }">
                                                {{ __('Porcentajes de impuesto') }}
                                            </a>
                                            <img src="{{ asset('images/Iconos Menu/ICONOS MENU ADMINISTRACION/Iconos Reportes/Porcentajes.png') }}"
                                                style="width:40px; height: 40px;" alt="Icono 5" class="w-4 h-4">
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>



            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center lg:hidden ">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div class="bg-white hidden" :class="{ 'block': open, 'hidden': !open }" >
        <div class="p-3">
            <div class="pt-2 pb-2 space-y-1 ">
                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Inicio') }}
                </x-responsive-nav-link>
            </div>
            <div class="pt-2 pb-2 space-y-1">
                <x-responsive-nav-link href="{{ route('sale.list') }}" :active="request()->routeIs('sale.list')">
                    {{ __('Ventas') }}
                </x-responsive-nav-link>
            </div>
            <div class="pt-2 pb-2 space-y-1">
                <x-responsive-nav-link href="{{ route('purchase.list') }}" :active="request()->routeIs('purchase.list')">
                    {{ __('Compras') }}
                </x-responsive-nav-link>
            </div>
            <div class="pt-2 pb-2 space-y-1">
                <x-responsive-nav-link href="{{ route('cierre_caja.list') }}" :active="request()->routeIs('cierre_caja.list')">
                    {{ __('Cierre Caja') }}
                </x-responsive-nav-link>
            </div>
            <div x-data="{ open2: false }">
                <div class="pt-2 pb-2 space-y-1">
                    <button @click="open2 = !open2"
                        class="flex items-center w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 focus:outline-none"
                        :class="{ 'text-blue-500': {{ request()->routeIs('commerce_type.list', 'group.list') ? 'true' : 'false' }} }">
                        <div class="flex flex-col items-center">
                            <span>{{ __('Reportes') }}</span>
                        </div>
                    </button>
                </div>

                <div x-show="open2" @click.away="open2 = false"
                    class="p-2 pt-0 pb-0 text-gray-900 dark:text-white rounded-md"
                    style="box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);">
                    <ul class="text-sm text-gray-700 dark:text-gray-200">
                        <li
                            class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            <a href="{{ route('reportSale.list') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('reportSale.list') ? 'true' : 'false' }} }">
                                {{ __('Reportes ventas') }}
                            </a>
                        </li>

                        <li
                            class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            <a href="{{ route('reportCust.list') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('reportCust.list') ? 'true' : 'false' }} }">
                                {{ __('Reporte venta por clientes') }}
                            </a>
                        </li>

                        <li
                            class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            <a href="{{ route('reportSupplier.list') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('reportSupplier.list') ? 'true' : 'false' }} }">
                                {{ __('Reporte compras proveedor') }}
                            </a>
                        </li>

                        <li
                            class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            <a href="{{ route('reportInv.list') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('reportInv.list') ? 'true' : 'false' }} }">
                                {{ __('Reportes de Invetario') }}
                            </a>
                        </li>


                    </ul>
                    <!-- Agrega más opciones de navegación aquí -->
                </div>
            </div>

            <div x-data="{ open2: false }">
                <div class="pt-2 pb-2 space-y-1">
                    <button @click="open2 = !open2"
                        class="flex items-center w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 focus:outline-none"
                        :class="{ 'text-blue-500': {{ request()->routeIs('commerce_type.list', 'group.list') ? 'true' : 'false' }} }">
                        <div class="flex flex-col items-center">
                            <span>{{ __('Administración') }}</span>
                        </div>
                    </button>
                </div>

                <div x-show="open2" @click.away="open2 = false"
                    class="p-2 pt-0 pb-0 text-gray-900 dark:text-white rounded-md"
                    style="box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);">
                    <ul class="text-sm text-gray-700 dark:text-gray-200">
                        <li
                            class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            <a href="{{ route('supplier.list') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('supplier.list') ? 'true' : 'false' }} }">
                                {{ __('Proveedores') }}
                            </a>
                        </li>

                        <li
                            class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            <a href="{{ route('customer.list') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('customer.list') ? 'true' : 'false' }} }">
                                {{ __('Clientes') }}
                            </a>
                        </li>

                        <li
                            class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            <a href="{{ route('product.list') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('product.list') ? 'true' : 'false' }} }">
                                {{ __('Inventario') }}
                            </a>
                        </li>
                    </ul>
                    <!-- Agrega más opciones de navegación aquí -->
                </div>
            </div>
        </div>
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Perfil') }}
                </x-responsive-nav-link>


                <div x-data="{ open2: false }">
                    <div class="pt-2 pb-2 space-y-1">
                        <button @click="open2 = !open2"
                            class="flex items-center w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 focus:outline-none"
                            :class="{ 'text-blue-500': {{ request()->routeIs('commerce_type.list', 'group.list') ? 'true' : 'false' }} }">
                            <div class="flex flex-col items-center">
                                <span>{{ __('Configuracion') }}</span>
                            </div>
                        </button>
                    </div>

                    <div x-show="open2" @click.away="open2 = false"
                        class="m-3 p-2 pt-0 pb-0 text-gray-900 dark:text-white rounded-md"
                        style="box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);">
                        <ul class="text-sm text-gray-700 dark:text-gray-200">
                            <li
                                class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <a href="{{ route('commerce_type.list') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('commerce_type.list') ? 'true' : 'false' }} }">
                                    {{ __('Tipos de comercio') }}
                                </a>
                            </li>

                            <li
                                class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <a href="{{ route('group.list') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('group.list') ? 'true' : 'false' }} }">
                                    {{ __('Grupos') }}
                                </a>
                            </li>

                            <li
                                class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <a href="{{ route('subgroup_all.list') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('subgroup_all.list') ? 'true' : 'false' }} }">
                                    {{ __('Subgrupos') }}
                                </a>
                            </li>

                            <li
                                class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <a href="{{ route('unit.list') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('unit.list') ? 'true' : 'false' }} }">
                                    {{ __('Unidades') }}
                                </a>
                            </li>

                            <li
                                class="flex justify-between items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <a href="{{ route('vat_percentage.list') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('vat_percentage.list') ? 'true' : 'false' }} }">
                                    {{ __('Porcentajes de impuesto') }}
                                </a>
                            </li>
                        </ul>
                        <!-- Agrega más opciones de navegación aquí -->
                    </div>
                </div>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                        :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <!-- Team Switcher -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>
