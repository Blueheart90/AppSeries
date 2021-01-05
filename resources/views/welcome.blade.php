<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body>
        @php
            $color = 'blue'
        @endphp
        <div class="container mx-auto">
            <x-prueba :color="$color" class="mb-4">
                <x-slot name="titulo">
                    Titulo 1
                </x-slot>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ea quibusdam commodi doloribus, repudiandae atque ex modi tempora odit laudantium vero saepe! Culpa ratione perferendis doloribus molestiae atque velit autem enim.
            </x-prueba>
            <x-prueba class="mb-4">
                <x-slot name="titulo">
                    Titulo 2
                </x-slot>
                Esta funcionando
            </x-prueba>
            <x-prueba2 :color="$color">
                <x-slot name="titulo">
                    Titulo 3
                </x-slot>
                Componente Anonimo
            </x-prueba2>

            <x-dynamic-component component="prueba">
                <x-slot name="titulo">
                    Titulo 3
                </x-slot>
                Componente Anonimo
            </x-dynamic-component>
        </div>
    </body>
</html>
