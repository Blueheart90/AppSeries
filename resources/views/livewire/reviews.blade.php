<div>
    <h2 class="mb-4 text-lg font-bold">{{ __('Reviews') }}</h2>
    <form wire:submit.prevent="submit()">
        <div x-data="{ trix: @entangle('content').defer }">
            <input id="content" name="content" type="hidden" value="{{$content}}" />
            <div wire:ignore>
                <trix-editor x-model.debounce.300ms="trix">
                </trix-editor>
            </div>
            @error('content') <span class="error">{{ $message }}</span> @enderror
        </div>
        <x-jet-button class="mt-2 text-sm capitalize">{{ __('Add') }}</x-jet-button>
    </form>
</div>
