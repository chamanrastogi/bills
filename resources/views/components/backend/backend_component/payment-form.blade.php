{{-- resources/views/components/backend/backend_component/customer-form.blade.php --}}


{{ Form::open([
    'route' => $isEdit ? ['payment.update', $payment->id] : ['payment.store', $customer_id],
    'class' => 'forms-sample needs-validation',
    'method' => $isEdit ? 'put' : 'post',
    'novalidate' => 'novalidate',
    'files' => true,    
]) }}

<div class="mb-3">
    {!! Form::label('payment_mode', 'Payment Mode', ['class' => 'form-label']) !!}
    {!! Form::select('payment_mode', $payment_modes, $payment->payment_mode ?? null, [
        'class' => 'form-control',
        'placeholder' => 'Select Payment Mode',
    ]) !!}
</div>








{!! Form::submit($isEdit ? 'Update' : 'Submit', [
    'class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0',
]) !!}
{{ Form::close() }}
