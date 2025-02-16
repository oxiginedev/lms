@isset($href)
    <a href="{{ $href }}"
        {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 border border-gray-300 font-medium text-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none']) }}
    >
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => 'inline-flex items-center px-4 h-12 border border-primary-600 font-medium text-xs uppercase tracking-widest text-white bg-primary-600 hover:bg-primary-700 focus:outline-none']) }}>
        {{ $slot }}
    </button>
@endisset