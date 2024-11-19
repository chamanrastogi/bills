@props(['messages'])

@if ($messages)
<div class="error-list">
    <ul {{ $attributes->merge(['class' => 'text-center']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
    </div>
@endif
