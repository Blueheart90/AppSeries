<div class="flex bg-white shadow lg:flex-row">
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
                    <h1 class="mt-2 text-2xl font-bold leading-tight text-gray-700 sm:mt-4">
                        Registrate y lleva el control de tus series favoritas.
                    </h1>
                </div>
                <x-jet-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('register') }}"  novalidate>
                    @csrf

                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="username" value="{{ __('Username') }}" />
                        <x-jet-input id="username" class="block w-full mt-1" type="username" name="username" :value="old('username')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-jet-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('login') }}">
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
    <div class="flex items-center justify-center h-screen lg:w-1/2" style="
        background: linear-gradient(-45deg,
        rgba(229,93,135,.3), rgba(95,195,228,.3)),
        url({{ asset('/storage/hero-inicio.jpg') }}) center center / cover no-repeat;">
        {{-- <img class="inset-0 object-cover w-full h-full " src="{{ asset('/storage/hero-inicio.jpg') }}" alt=""> --}}
        <div class="p-4 bg-white bg-opacity-75 rounded-xl lg:w-10/12">
                <h1 class="mb-2 text-2xl font-bold leading-tight text-teal-500 sm:mt-4">
                    Agrupa las que estas mirando o las que quieres ver
                </h1>
                <p class="text-xl text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid dicta provident, minus, fugiat accusantium magnam vitae laborum, molestiae iste recusandae corporis laudantium at. Facere earum recusandae eveniet ducimus temporibus tenetur!</p>

        </div>

    </div>
</div>
