<x-guest-layout>
    <div class="relative flex items-center min-h-screen p-5 overflow-hidden bg-gray-100 min-w-screen lg:p-20">
        <div class="relative items-center flex-1 min-w-full min-h-full p-5 text-center text-gray-800 bg-white shadow-xl rounded-3xl lg:p-10 md:flex md:text-left">
            <div class="w-full md:w-1/2">
                <div class="mb-10 text-lg text-gray-600 font-montserrat md:mb-20">
                    <h1 class="mb-10 text-3xl font-black text-gray-400 capitalize font-opensans lg:text-5xl">Parece que te has perdido!</h1>
                    @if (session()->has('message'))
                        {{ session('message') }}
                    @else
                        <p>La pagina que buscas no esta disponible.</p>
                    @endif
                    <p>Intenta buscar de nuevo o utiliza el botón Volver.</p>
                    <div class="mt-10 mb-20 md:mb-0">
                        <a href="{{ url()->previous() }}">
                            <x-jet-button type="button">
                                Ir atras
                            </x-jet-button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="w-full text-center md:w-1/2">

                <img src="{{ Storage::url('img/page-not-found-' . rand(1,2) .'.png') }}" alt="">
                <div class="text-gray-300 ">

                    Illustration by <a href="https://icons8.com/illustrations/author/5c18c58a793948000f7394ce">Marina Fedoseenko</a> from <a href="https://icons8.com/illustrations">Ouch!</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
