<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Inicio
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-contenido>
                    <x-slot name="titulo">
                        Titulo 1
                    </x-slot>
                    Laravel Jetstream provides a beautiful, robust starting point for your next Laravel application. Laravel is designed
                    to help you build your application using a development environment that is simple, powerful, and enjoyable. We believe
                    you should love expressing your creativity through programming, so we have spent time carefully crafting the Laravel
                    ecosystem to be a breath of fresh air. We hope you love it.
                </x-contenido>


            </div>
        </div>
    </div>
</x-app-layout>
