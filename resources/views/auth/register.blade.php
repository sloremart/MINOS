<x-guest-layout>
    <x-slot name="logo">
        <!-- Aquí puedes añadir el logo si es necesario -->
    </x-slot>
    <div class="relative flex items-center justify-center min-h-screen">
        <div class="absolute inset-0 bg-cover bg-center bg-repeat opacity-20" style="background-image: url('/images/icono_central.png'); background-size: 100px;"></div>

        <div class="relative flex flex-col items-center bg-white p-12 rounded-lg shadow-lg w-full max-w-xl">
            <form method="POST" action="{{ route('register') }}" class="w-full">
                @csrf

                <div class="text-center mb-6 relative">
                    <div class="flex justify-center mb-2">
                        <img src="/images/sena.png" alt="SENA Logo" class="w-24 h-24">
                    </div>
                    <h1 class="text-2xl font-bold">REGISTRO</h1>
                    <p class="text-gray-300 text-base">SISTEMA MINOS</p>
                </div>

                <div class="space-y-4">
                    <div>
                        <x-label for="name" value="{{ __('Nombre Completo') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <div>
                        <x-label for="email" value="{{ __('Correo Electrónico') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    </div>

                    <div>
                        <x-label for="password" value="{{ __('Contraseña') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div>
                        <x-label for="password_confirmation" value="{{ __('Confirme Contraseña') }}" />
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    <div>
                        <x-label for="commerce_type" value="{{ __('Tipo de Comercio') }}" />
                        <select name="commerce_type_id" id="commerce_type_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            @foreach(App\Models\CommerceType::all() as $commerceType)
                                <option value="{{ $commerceType->id }}">{{ $commerceType->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div>
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required />

                                    <div class="ml-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                            {{ __('Ya te encuentras registrado?') }}
                        </a>

                        <x-button class="ml-4">
                            {{ __('Registrar') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
