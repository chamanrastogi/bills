{{-- resources/views/components/backend/backend_component/image-preset-form.blade.php --}}

{{ Form::open([
    'route' => $isEdit ? ['image_preset.update', $imagepreset->id] : 'image_preset.store',
    'class' => 'forms-sample needs-validation',
    'novalidate' => 'novalidate',
    'method' => $isEdit ? 'put' : 'post',
    'files' => true,
]) }}


<div class="row">
    <div class="col-lg-4 mb-3">
        {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
        {!! Form::text('name', $imagepreset->name ?? null,  [
            'class' => 'form-control',
            'placeholder' => 'Name',
            'required' => 'required',
        ]) !!}
        @error('name')
            <span class="text-danger pt-3">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-lg-4 mb-3">

        {!! Form::label('width', 'Width', ['class' => 'form-label']) !!}

        {!! Form::text('width', $imagepreset->width ?? null,  [
            'class' => 'form-control',
            'required' => 'required',
            'placeholder' => 'Width',
        ]) !!}
        @error('width')
            <span class="text-danger pt-3">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-lg-4 mb-3">

        {!! Form::label('height', 'Height', ['class' => 'form-label']) !!}

        {!! Form::text('height', $imagepreset->height ?? null,  [
            'class' => 'form-control',
            'required' => 'required',
            'placeholder' => 'Height',
        ]) !!}
        @error('height')
            <span class="text-danger pt-3">{{ $message }}</span>
        @enderror
    </div>
</div>




{!! Form::submit($isEdit ? 'Update' : 'Submit', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
{{ Form::close() }}
