@props(['name', 'onchange' => '', 'placeholder' => ''])

<div class="mb-3">
    <input type="file" name="{{ $name }}" class="form-control" placeholder="{{ $placeholder }}" onchange="{{ $onchange }}">
</div>
