<x-guest-layout>
    <div class="grid grid-cols-1 bg-white shadow lg:grid-cols-3 ">

        <div class="items-center hidden h-screen lg:flex " style="
            background: linear-gradient(-45deg,
            rgba(229,93,135,.3), rgba(95,195,228,.3)),
            url({{ asset('/storage/hero-inicio.jpg') }}) center center / cover no-repeat;">

            <div class="flex flex-col p-4 m-10 bg-white bg-opacity-75 rounded-xl ">

                    <h1 class="my-4 text-4xl font-bold text-teal-500">
                        Lleva el control de tus series y peliculas
                    </h1>
                    <p class="mb-2 text-xl leading-normal ">
                        Comparte tus opiniones, califica y crea tus propias listas.
                    </p>
                    <p class="mb-8 text-xl leading-normal">
                        Millones de películas y programas de televisión por descubrir. Explora ahora.
                    </p>
            </div>

        </div>

        <div class="col-span-2 min">
            
            <div class="flex flex-col items-center justify-center min-h-screen pt-6 bg-gray-100 sm:pt-0" >
                <div class="hidden sm:block">
                    <x-jet-authentication-card-logo />
                </div>
                <div class="max-w-lg px-6 py-4 mt-6 overflow-hidden bg-white rounded-lg shadow-md">
                    <div class="mb-4">
                        <p class="text-2xl text-gray-700">
                            App<span class="font-bold">Series</span>
                        </p>
                        <h1 class="mt-2 text-2xl font-bold leading-tight text-gray-700 sm:mt-4">
                            Registrate y lleva el control de tus series favoritas.
                        </h1>
                    </div>
                    <x-jet-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('register') }}"  novalidate>
                        @csrf

                        <div>
                            <x-jet-label for="name" value="{{ __('Name') }}" />
                            <x-jet-input id="name" class="block w-full mt-1 border" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="email" value="{{ __('Email') }}" />
                            <x-jet-input id="email" class="block w-full mt-1 border" type="email" name="email" :value="old('email')" required />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="username" value="{{ __('Username') }}" />
                            <x-jet-input id="username" class="block w-full mt-1 border" type="username" name="username" :value="old('username')" required />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="password" value="{{ __('Password') }}" />
                            <x-jet-input id="password" class="block w-full mt-1 border" type="password" name="password" required autocomplete="new-password" />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                            <x-jet-input id="password_confirmation" class="block w-full mt-1 border" type="password" name="password_confirmation" required autocomplete="new-password" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <x-jet-button class="ml-4">
                                {{ __('Register') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
