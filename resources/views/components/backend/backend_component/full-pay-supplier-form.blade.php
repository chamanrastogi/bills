{{-- resources/views/components/backend/backend_component/supplier-fullpay-form.blade.php --}}

<x-form.form
    :route="route('supplier.fullPay', $supplier->id)"
    method="POST"
    class="forms-sample needs-validation"
    novalidate
>

<div class="row">
    <div class="col-4">
         {{-- Remaining Balance --}}
    <div class="mb-3">
        <x-form.input-label for="balance" value="Remaining Balance" />
        <x-form.text-input
            name="balance"
            :value="number_format($supplier->balance)"
            readonly
        />
    </div>
    </div>
    <div class="col-4">
{{-- Payment Mode --}}
    <div class="mb-3">
        <x-form.input-label for="payment_mode" value="Payment Mode" />

        <x-form.select
            name="payment_mode"
            :options="MODE"
            placeholder="Select Payment Mode"
            required
        />

        <x-form.input-error :messages="$errors->get('payment_mode')" />
    </div>

    </div>
    <div class="col-4">

         {{-- Transaction ID --}}
    <div class="mb-3">
        <x-form.input-label for="transaction_id" value="Transaction ID (Optional)" />
        <x-form.text-input
            name="transaction_id"
            placeholder="Enter Transaction ID"
        />
        <x-form.input-error :messages="$errors->get('transaction_id')" />
    </div>
    </div>
</div>

{{-- Submit Button --}}
    <x-form.button type="submit">
        Pay Full Amount (₹{{ number_format($supplier->balance, 2) }})
    </x-form.button>

</x-form.form>
