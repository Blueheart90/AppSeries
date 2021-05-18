<div
    x-data="{
        open: @entangle('open'),
        editMode: @entangle('editMode'),
        oldData: @entangle('oldData'),
        fields: @entangle('fields'),
    }"
>
    <div
        class="flex px-2 py-1 mt-2 bg-gray-700 border border-gray-200 rounded-t-md"
        :class="{ 'rounded-b-md' : open === false }"
    >
        <svg
            class="w-6 mr-2 text-green-500 bg-white rounded-full"
            x-show="editMode"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
            fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        <span class="flex-grow select-none" x-text="editMode ? 'Editar estado' : 'Añadir a mi lista'"></span>

        <svg
            class="w-6 transition duration-500 ease-in-out cursor-pointer "
            :class="{'transform rotate-180 ' : open}"
            xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 24 24"
            stroke="currentColor"
            @click="open = !open"
            >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </div>

    <form
        class="p-4 text-sm text-gray-700 bg-gray-200 bg-opacity-75 rounded-b-md"
        x-show="open"
        wire:submit.prevent="addMovieList()"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 "
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-end="opacity-0"
    >

        <div class="flex mb-2" >
            <x-jet-label class="pr-2 text-white" >Estado</x-jet-label>
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
        <div class="flex mb-4">
            <x-jet-label class="pr-2 text-white">Punt.</x-jet-label>
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
        @if ($editMode)
            <x-jet-button type="button"  wire:click="updateMovieList({{ $oldData->id }})" class="min-w-full mb-2" color="gray">
                {{-- SVG Update --}}
                <svg class="w-4 mr-2 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                {{ __('Update') }}
            </x-jet-button>
        @else
            <x-jet-button  class="min-w-full mb-2" color="gray">
                {{-- SVG add --}}
                <svg class="w-4 mr-2 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ __('Add') }}
            </x-jet-button>
        @endif
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
    </form>
    <x-flash-messages></x-flash-messages>
</div>
