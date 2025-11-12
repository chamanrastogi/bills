@props([
    'options' => [],               // List of options to display in the dropdown
    'selected' => null,             // Pre-selected values (array or string)
    'placeholder' => 'Select...',   // Placeholder text for the dropdown
    'disabled' => false             // Whether the dropdown should be disabled
])

<select {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => 'form-select mb-3']) }}>
    <option value="">{{ $placeholder }}</option>
    @foreach($options as $key => $value)
        <option value="{{ $key }}" 
            {{ (in_array($key, (array) $selected) || old($attributes['name'], (array) $selected) == $key) ? 'selected' : '' }}>
            {{ $value }}
        </option>
    @endforeach
</select>
