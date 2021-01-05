<div class="flex lg:flex-row shadow bg-white">
    <div class="lg:w-1/2">
        <x-guest-layout>
            <x-jet-authentication-card >
                <x-slot name="logo">
                    <x-jet-authentication-card-logo />
                </x-slot>
                <div class="mb-4">
                    <p class="text-2xl text-gray-700">
                        App<span class="font-bold">Series</span>
                    </p>
                    <h1 class="mt-2 sm:mt-4 text-2xl font-bold text-gray-700 leading-tight">
                        Registrate y lleva el control de tus series favoritas.
                    </h1>
                </div>
                <x-jet-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('register') }}"  novalidate>
                    @csrf

                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-jet-button class="ml-4" color="teal">
                            {{ __('Register') }}
                        </x-jet-button>
                    </div>
                </form>
            </x-jet-authentication-card>
        </x-guest-layout>
    </div>
    <div class="lg:w-1/2 h-screen flex justify-center items-center" style="
        background: linear-gradient(-45deg,
        rgba(229,93,135,.3), rgba(95,195,228,.3)),
        url({{ asset('/storage/hero-inicio.jpg') }}) center center / cover no-repeat;">
        {{-- <img class="inset-0 h-full w-full object-cover " src="{{ asset('/storage/hero-inicio.jpg') }}" alt=""> --}}
        <div class="bg-white p-4 rounded-xl lg:w-10/12 bg-opacity-75">
                <h1 class="mb-2 sm:mt-4 text-2xl font-bold text-teal-500  leading-tight">
                    Agrupa las que estas mirando o las que quieres ver
                </h1>
                <p class="text-xl text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid dicta provident, minus, fugiat accusantium magnam vitae laborum, molestiae iste recusandae corporis laudantium at. Facere earum recusandae eveniet ducimus temporibus tenetur!</p>

        </div>

    </div>
</div>
