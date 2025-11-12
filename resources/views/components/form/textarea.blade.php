@props([
    'name',
    'disabled' => false,
    'rows' => 3,
    'value' => '',
])

@php
    $content = trim($slot) ?: old($name, $value);
@endphp

<textarea
    name="{{ $name }}"
    rows="{{ $rows }}"
    @if($disabled) disabled @endif
    {{ $attributes->merge(['class' => 'form-control']) }}
>{{ $content }}</textarea>