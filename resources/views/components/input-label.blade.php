@props(['value'])

<label {{ $attributes->merge(['class' => 'form-container__input-label unselectable']) }}>
    {{ $value ?? $slot }}
</label>