<div
    x-data="{
        showModal: @entangle('showModal'),
        fields: @entangle('fields'),
    }"
>
    <x-modal trigger="showModal" class="px-9">
        <div class="relative">
            <figure class="min-w-full ">
                <img  src="{{ $fields['poster'] ? 'https://www.themoviedb.org/t/p/w342'. $fields['poster'] : 'https://via.placeholder.com/500x750' }}" alt="poster" class=" rounded-t-md lazyload">
            </figure>
            <div class="absolute text-gray-200 top-2 right-2">
                <a class="cursor-pointer " @click="showModal = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </a>
            </div>
        </div>
        <form
            class="flex flex-col justify-center p-4 text-gray-700 bg-gray-200 bg-opacity-75 rounded-b-md"

            {{-- x-on:submit.prevent --}}
            wire:submit.prevent="addMovieList()"
        >
            <div class="mx-auto ">
                <div class="flex mb-2 " >
                    <x-jet-label class="pr-2 text-base text-white" >Estado</x-jet-label>
                    <select
                        class="rounded-sm "
                        name="watching_state_id"
                        id="state"
                        wire:model="fields.watching_state_id"
                    >
                        <option disabled selected value='0'>Seleccione</option>
                        @foreach ($stateWatchingList as $state)
                            <option value="{{$state->id}}" >{{$state->name}}</option>
                        @endforeach

                    </select>
                </div>

                {{-- @if (isset($tvshow))

                @endif --}}
                <div class="flex mb-4">
                    <x-jet-label class="pr-2 text-base text-white">Punt.</x-jet-label>
                    <select
                        class="rounded-sm"
                        name="score_id"
                        wire:model="fields.score_id"
                    >
                        <option disabled selected value='0'>Seleccione</option>
                        @foreach ($scoreList as $score)
                            <option value="{{$score->id}}">({{$score->id}}) {{$score->name}}</option>
                        @endforeach

                    </select>
                </div>

                <x-jet-button type="button"  wire:click="updateMovieList({{ $fields['id'] }})"  class="min-w-full mb-2" color="gray">
                    {{-- SVG Update --}}
                    <svg class="w-4 mr-2 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    {{ __('Update') }}
                </x-jet-button>


                @if ($errors->any())
                    <div class="text-red-600">
                        <h2>Error, hay campos sin llenar</h2>
                        <ul class="pl-4 list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </form>
        <x-flash-messages></x-flash-messages>
    </x-modal>
</div>

