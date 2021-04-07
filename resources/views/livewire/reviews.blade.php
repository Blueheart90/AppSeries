<div x-data="{
    trix: @entangle('content').defer,
    recommended: @entangle('recommended')
}">
    {{-- @dump($apiId) --}}
    {{-- <h2 class="mb-4 text-lg font-bold">{{ __('Reviews') }}</h2> --}}
    <div class="mb-4 ">
        <img class="float-left object-cover w-20 h-20 mr-4 rounded-full " src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
        <div>
            <h2 class="text-lg font-bold text-teal-400">Escribe una reseña sobre Path of Exile</h2>
            <p class="text-gray-500 ">
                Describe lo que te ha gustado o no de esta serie/pelicula y si se lo recomendarías a otros.
                Recuerda ser educado/a y seguir las Normas y directrices.
            </p>
        </div>
    </div>
    <form wire:submit.prevent="submit()">
        <div>
            <input id="content" name="content" type="hidden" value="{{$content}}" />
            <div wire:ignore>
                <trix-editor x-model.debounce.300ms="trix">
                </trix-editor>
            </div>
            @error('content') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-between mt-2">
            <div>
                <p class="mb-1">¿Recomiendas esta serie?</p>
                <x-jet-button type="button" @click="recommended = true" class="text-sm capitalize">
                    <x-like-svg class="mr-2 text-white" x-bind:class="{ ' text-green-400 animate-bounce' : recommended === true }" ></x-like-svg>
                    <span x-bind:class="{ 'text-green-400' : recommended === true }">Si</span>
                </x-jet-button>
                <x-jet-button type="button" @click="recommended = false" class="text-sm capitalize">
                    <x-dislike-svg class="mr-2 text-gray-200 " x-bind:class="{ ' text-red-400 animate-bounce ' : recommended === false }" ></x-dislike-svg>
                    <span x-bind:class="{ 'text-red-400' : recommended === false }">No</span>
                </x-jet-button>
            </div>
            <x-jet-button class="self-end h-10 text-sm capitalize">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                </svg>
                {{ __('Add') }}
            </x-jet-button>
        </div>

    </form>
    <x-jet-button wire:click="update(1)">Update</x-jet-button>
</div>
