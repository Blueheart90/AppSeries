@props(['trigger'])
<div
    class="fixed top-0 flex items-center w-full h-full bg-gray-900 bg-opacity-60"
    x-show="{{$trigger}}"
    x-on:keydown.escape.window="{{$trigger}} = false"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 "
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-end="opacity-0"
    x-cloak
    >
    <div
        {{$attributes->merge(['class' => " m-auto rounded-xl"])}}
        @click.away="{{$trigger}} = false"
        >
       {{ $slot }}
    </div>
</div>
