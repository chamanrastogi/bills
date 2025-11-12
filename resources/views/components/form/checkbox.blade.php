@props([
    'name',
    'id' => null,
    'value' => '1',
    'checked' => false,
    'disabled' => false,
])

<input 
    type="checkbox" 
    name="{{ $name }}" 
    id="{{ $id ?? $name }}" 
    value="{{ $value }}"
    @checked($checked) 
    @disabled($disabled)
    {{ $attributes->merge(['class' => 'form-check-input']) }} 
/>
