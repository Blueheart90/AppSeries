<div x-data="{ open: true }" x-show="open">
    @if (session()->has('success'))
        <div
            class="flex items-center justify-between min-w-full p-1 my-2 text-sm text-center text-green-500 bg-green-100 border border-green-500 rounded-md "
            >
            <span class="pl-2">
                {{ session('success') }}
            </span>
            <div
                class="cursor-pointer"
                @click="open = false"
                >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
    @endif
    @if (session()->has('error'))
        <div
            class="flex items-center justify-between min-w-full p-1 my-2 text-sm text-center text-red-500 bg-red-100 border border-red-500 rounded-md "
            >
            <span class="pl-2">
                {{ session('error') }}
            </span>
            <div
                class="cursor-pointer"
                @click="open = false"
                >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
    @endif
    @if (session()->has('info'))
        <div
            class="flex items-center justify-between min-w-full p-1 my-2 text-sm text-center text-blue-500 bg-blue-100 border border-blue-500 rounded-md "
            >
            <span class="pl-2">
                {{ session('info') }}
            </span>
            <div
                class="cursor-pointer"
                @click="open = false"
                >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
    @endif
</div>
