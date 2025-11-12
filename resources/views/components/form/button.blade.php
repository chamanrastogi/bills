@props([
    'type' => 'submit',
    'value' => null,
])

<button type="{{ $type }}" {{ $attributes->merge(['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) }}>
    {{ $value ?? $slot }}
</button>
