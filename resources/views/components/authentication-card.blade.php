<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50">
    <div>
        <a href="/">
            {{-- application logo --}}
        </a>
    </div>

    <div class="w-full sm:max-w-lg mt-6 sm:px-12 py-8 bg-white shadow-md overflow-hidden">
        {{ $slot }}
    </div>
</div>