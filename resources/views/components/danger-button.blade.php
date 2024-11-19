<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-midium theme-btn btn-radius width-200']) }}>
    {{ $slot }}
</button>
