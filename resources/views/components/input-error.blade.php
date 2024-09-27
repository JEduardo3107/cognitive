@props(['messages'])

@if ($messages)
    @foreach ((array) $messages as $message)
        <span {{ $attributes->merge(['class' => 'form-container__error-element']) }}>
            {{ $message }}
        </span>
    @endforeach
@endif