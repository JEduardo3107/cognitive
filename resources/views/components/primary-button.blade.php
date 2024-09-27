<button {{ $attributes->merge(['type' => 'submit', 'class' => 'noDefaultStyle cursorPointerEvent']) }}>
    {{ $slot }}
</button>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/button.css') }}">
@endpush