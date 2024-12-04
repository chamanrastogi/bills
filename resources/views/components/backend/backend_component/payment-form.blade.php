{{-- resources/views/components/backend/backend_component/payment-form.blade.php --}}

{{ Form::open([
    'route' => $isEdit ? ['payment.update', $billing->id] : ['payment.store', $id],
    'class' => 'forms-sample needs-validation',
    'method' => $isEdit ? 'patch' : 'post',
    'novalidate' => 'novalidate',
    'files' => true,
]) }}

<div class="mb-3">
    {!! Form::label('payment_mode', 'Payment Mode', ['class' => 'form-label']) !!}
    {!! Form::select('payment_mode', $modes, $billing->payment_mode ?? null, [
        'class' => 'form-control',
        'placeholder' => 'Select Payment Mode',
    ]) !!}
</div>
<div class="col-sm-12">
    <div class="mb-3">
    {!! Form::label('payment', 'Amount', ['class' => 'form-label']) !!}
    {!! Form::number('payment', $billing->payment ?? null, [
        'class' => 'form-control',
        'required' => 'required',
        'placeholder' => 'Amount',
    ]) !!}
    @error('payment')
        <span class="text-danger pt-3">{{ $message }}</span>
    @enderror
</div>
</div>








{!! Form::submit($isEdit ? 'Update' : 'Submit', [
    'class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0',
]) !!}
{{ Form::close() }}
