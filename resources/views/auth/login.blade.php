<x-guest-layout>
    <x-slot name="logo">

    </x-slot>

    <div class="relative flex items-center justify-center min-h-screen">

        <div class="absolute inset-0 bg-cover bg-center bg-repeat opacity-20" style="background-image: url('/images/sena.png'); background-size: 100px;"></div>





        <div class="relative flex flex-col md:flex-row items-center bg-white p-12 rounded-lg shadow-lg w-full max-w-2xl">

            <div class="w-full md:w-2/3">
                <div class="text-center mb-6">
                <h2 class="text-lg font-bold">INICIAR SESIÓN</h2>
                    <p class="text-gray-300 text-xs">BIENVENIDOS A NUESTRO SISTEMA</p>
                </div>

                <x-validation-errors class="mb-4" />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <div class="mb-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <div class="flex items-center justify-between mb-2 w-full">
                        <label for="remember_me" class="flex items-center mr-4">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-400">{{ __('Recordar') }}</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-400 hover:text-gray-400 whitespace-nowrap" href="{{ route('password.request') }}">
                                {{ __('Olvidó su contraseña?') }}
                            </a>
                        @endif
                    </div>

                    <div class="text-center mt-4">
                    <x-button class="w-full inline-block flex justify-center bg-blue-350 text-withe-800  py-2 px-4 rounded-lg text-center text-base">
                            {{ __('INICIAR SESIÓN') }}
                        </x-button>
                    </div>
                </form>

                <div class="text-center mt-6">
                <x-button href="{{ route('register') }}" class="w-full inline-block flex justify-center bg-blue-350 text-withe-800 py-2 px-4 rounded-lg text-center text-base">
                        {{ __('REGISTRARSE') }}
                        </x-button>
                </div>
            </div>

            <div class="hidden md:flex md:items-center md:justify-center mx-6 relative">
                <div class="w-px h-64 bg-gray-200"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-2 h-24 bg-gray-200"></div> <!-- Parte central más gruesa -->
                </div>
            </div>

            <div class="w-full md:w-100 flex justify-center items-center">
                <img src="/images/minos.png" alt="MiNOS Logo" class="max-w-full h-auto md:w-90 lg:w-90">
            </div>

        </div>
    </div>
</x-guest-layout>
