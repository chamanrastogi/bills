{{-- resources/views/components/backend/backend_component/blog-form.blade.php --}}


{{ Form::open([
    'route' => $isEdit ? ['units.update', $unit->id] : 'units.store',
    'class' => 'forms-sample needs-validation',
    'method' => $isEdit ? 'put' : 'post',
    'novalidate' => 'novalidate',
    'files' => true,
]) }}





<div class="mb-3">
    {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
    {!! Form::text('name', $unit->name ?? null, [
        'class' => 'form-control',
        'required' => 'required',
        'placeholder' => 'Name',
    ]) !!}
    @error('name')
        <span class="text-danger pt-3">{{ $message }}</span>
    @enderror
</div>




{!! Form::submit($isEdit ? 'Update' : 'Submit', [
    'class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0',
]) !!}
{{ Form::close() }}
