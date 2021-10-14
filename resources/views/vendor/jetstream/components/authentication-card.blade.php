<div {{ $attributes->merge(['class' => "min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 bg-gray-100" ]) }}>
    <div>
        {{ $logo }}
    </div>

    <div class="w-full max-w-lg px-6 py-4 mt-6 overflow-hidden bg-white rounded-lg shadow-md">
        {{ $slot }}
    </div>
</div>
