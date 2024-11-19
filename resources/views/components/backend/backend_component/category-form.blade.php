{{-- resources/views/components/backend/backend_component/category-form.blade.php --}}

{{ Form::open([
    'route' => $isEdit ? ['category.update', $category->id] : 'category.store',
    'class' => 'forms-sample needs-validation',
    'novalidate' => 'novalidate',
    'method' => $isEdit ? 'put' : 'post',    
]) }}


<div class="col-sm-12">
    <div class="mb-3">
        {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
        {!! Form::text('name', $category->name ?? null, [
            'class' => 'form-control',
            'required' => 'required',
            'placeholder' => 'Name',
        ]) !!}
        @error('name')
            <span class="text-danger pt-3">{{ $message }}</span>
        @enderror
    </div>
</div>



{!! Form::submit($isEdit ? 'Update' : 'Submit', [
    'class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0',
]) !!}
{{ Form::close() }}
