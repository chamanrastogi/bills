{{-- resources/views/components/backend/backend_component/blog-form.blade.php --}}


{{ Form::open([
    'route' => $isEdit ? ['customers.update', $customer->id] : 'customers.store',
    'class' => 'forms-sample needs-validation',
    'method' => $isEdit ? 'put' : 'post',
    'novalidate' => 'novalidate',
    'files' => true,
]) }}


<div class="row">
    <div class="col-6">
        <div class="mb-3">
            {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
            {!! Form::text('name', $customer->name ?? null, [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Name',
            ]) !!}
            @error('name')
                <span class="text-danger pt-3">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
            {!! Form::text('email', $customer->email ?? null, [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Email',
            ]) !!}

        </div>
    </div>
</div>




<div class="mb-3">
    {!! Form::label('phone', 'Phone', ['class' => 'form-label']) !!}
    {!! Form::text('phone', $customer->phone ?? null, [
        'class' => 'form-control',
        'required' => 'required',
        'placeholder' => 'Phone',
    ]) !!}

</div>

<div class="row mb-3">
   <div class="col-6">
        {!! Form::label('address', 'Address', ['class' => 'form-label']) !!}
        {!! Form::textarea('address', $customer->address ?? null, [
            'class' => 'form-control',
            'rows' => 2,
            'placeholder' => 'Address',
        ]) !!}

    </div>
    <div class="col-6">
        {!! Form::label('bill_address', 'Billing Address', ['class' => 'form-label']) !!}
        {!! Form::textarea('bill_address', $customer->bill_address ?? null, [
            'class' => 'form-control',
            'rows' => 2,
            'placeholder' => 'Billing Address',
        ]) !!}

    </div>
</div>




{!! Form::submit($isEdit ? 'Update' : 'Submit', [
    'class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0',
]) !!}
{{ Form::close() }}
