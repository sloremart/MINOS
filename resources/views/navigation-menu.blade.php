<nav x-data="{ open: false }" class="bg-white py-10">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 pt-2  sm:px-6 bg-white lg:px-8 bg-gray-0 rounded-full shadow-lg"
        style=" position: relative; z-index: 1; ">
        <div class="flex justify-between h-20">
            <div class="flex ">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/minos.png') }}" alt="IconoMinos" class="w-40 h-auto pb-2.5">
                    </a>
                </div>
            </div>
            <div class="flex w-full justify-end">
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
                    <x-nav-link href="{{ route('supplier.list') }}" :active="request()->routeIs('supplier.list')">
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('images/Iconos Menu/INVENTARIO/Terceros Proveedores.png') }}"
                                alt="aca va el icono" class="w-10 h-auto pb-2.5">
                            <span>{{ __('Provedores') }}</span>
                        </div>
                    </x-nav-link>
                </div>

                <div class="hidden lg:flex sm:items-center md:flex-col md:space-y-2 px-3">
                    <x-nav-link href="{{ route('product.list') }}" :active="request()->routeIs('product.list')">
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('images/Iconos Menu/INVENTARIO/INVENTARIO.png') }}" alt="aca va el icono"
                                class="w-10 h-auto pb-2.5">
                            <span>{{ __('Productos') }}</span>
                        </div>
                    </x-nav-link>
                </div>

                <div class="hidden lg:flex sm:items-center md:flex-col md:space-y-2 px-3">
                    <x-nav-link href="{{ route('customer.list') }}" :active="request()->routeIs('customer.list')">
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('images/Iconos Menu/ADMINISTRACION/Usuarios.png') }}"
                                alt="aca va el icono" class="w-10 h-auto pb-2.5">
                            <span>{{ __('Clietes') }}</span>
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

                <!-- Dropdown -->
                <div class="z-10 flex font-normal bg-white divide-y divide-gray-100 space-x-8 rounded-lg dark:bg-gray-700 dark:divide-gray-600"
                    x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center text-gray-500 hover:text-gray-700 focus:outline-none"
                        :class="{ 'text-blue-500': {{ request()->routeIs('commerce_type.list', 'group.list') ? 'true' : 'false' }} }">
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('images/Iconos Menu/ADMINISTRACION/ADMINISTRACION.png') }}"
                                alt="aca va el icono" class="w-10 h-auto pb-2.5">
                            <span>{{ __('Admitraciones') }}</span>
                        </div>
                        {{-- <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg> --}}
                    </button>


                    <div x-show="open" @click.away="open = false"
                        class="absolute mt-20 w-48 bg-white rounded-md shadow-lg z-20">
                        <ul class="text-sm text-gray-700 dark:text-gray-200">
                            <li
                                class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <a href="{{ route('commerce_type.list') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('commerce_type.list') ? 'true' : 'false' }} }">
                                    {{ __('Tipos de comercio') }}
                                </a>
                                <img src="{{ asset('') }}"
                                    style="width:40px; height: 40px;" alt="Icono 1" class="w-4 h-4">
                            </li>

                            <li
                                class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <a href="{{ route('commerce_type.list') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('commerce_type.list') ? 'true' : 'false' }} }">
                                    {{ __('Grupos') }}
                                </a>
                                <img src="{{ asset('') }}"
                                    style="width:40px; height: 40px;" alt="Icono 2" class="w-4 h-4">
                            </li>

                            <li
                                class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <a href="{{ route('commerce_type.list') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('commerce_type.list') ? 'true' : 'false' }} }">
                                    {{ __('Subgrupos') }}
                                </a>
                                <img src="{{ asset('') }}"
                                    style="width:40px; height: 40px;" alt="Icono 3" class="w-4 h-4">
                            </li>

                            <li
                                class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <a href="{{ route('commerce_type.list') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('commerce_type.list') ? 'true' : 'false' }} }">
                                    {{ __('Unidades') }}
                                </a>
                                <img src="{{ asset('') }}"
                                    style="width:40px; height: 40px;" alt="Icono 4" class="w-4 h-4">
                            </li>
                            
                            <li
                                class="flex justify-between border-b-2 items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <a href="{{ route('commerce_type.list') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    :class="{ 'bg-blue-100 text-blue-700': {{ request()->routeIs('commerce_type.list') ? 'true' : 'false' }} }">
                                    {{ __('Porcentajes de impuesto') }}
                                </a>
                                <img src="{{ asset('') }}"
                                    style="width:40px; height: 40px;" alt="Icono 5" class="w-4 h-4">
                            </li>
                        </ul>
                        <!-- Agrega más opciones de navegación aquí -->
                    </div>
                </div>
            </div>

            <div class="hidden md:flex sm:items-center sm:ms-6 border-l-2 border-blue-700">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
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

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
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
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

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
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden ">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
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
                    {{ __('Profile') }}
                </x-responsive-nav-link>

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
