@isset($href)
    <a href="{{ $href }}"
        {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 border border-gray-300 font-medium text-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none']) }}
    >
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 border border-gray-300 font-medium text-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none']) }}>
        {{ $slot }}
    </button>
@endisset