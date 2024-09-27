@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'form-container__status']) }}>
        {{ $status }}
    </div>
@endif
