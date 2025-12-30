{{-- resources/views/components/backend/backend_component/payment-form.blade.php --}}

<x-form.form
    :route="$isEdit ? route('payment.update', $billing->id) : route('payment.store', $id)"
    :method="$isEdit ? 'PATCH' : 'POST'"
    :isEdit="$isEdit"
    enctype="multipart/form-data"
    class="forms-sample needs-validation"
    novalidate
>

    {{-- Payment Mode --}}
    <div class="mb-3">
        <x-form.input-label for="payment_mode" value="Payment Mode" />
        <x-form.select
            name="payment_mode"
            :options="$modes"
            :selected="$billing->payment_mode ?? null"
            placeholder="Select Payment Mode"
        />
        <x-form.input-error :messages="$errors->get('payment_mode')" />
    </div>

    {{-- Payment Amount --}}
    <div class="col-sm-12">
        <div class="mb-3">
            <x-form.input-label for="payment" value="Amount" />
            <x-form.text-input
                type="number"
                name="payment"
                :value="$billing->payment ?? ''"
                required
                placeholder="Amount"
            />
            <x-form.input-error :messages="$errors->get('payment')" />
        </div>
    </div>
    <div class="col-sm-12">
        <div class="mb-3">
            <x-form.input-label for="transaction_no" value="Transaction No" />
            <x-form.text-input
                type="text"
                name="transaction_no"
                :value="$billing->transaction_no ?? ''"

                placeholder="Transaction No"
            />

        </div>
    </div>

    {{-- Submit Button --}}
    <x-form.button type="submit">
        {{ $isEdit ? 'Update' : 'Submit' }}
    </x-form.button>

</x-form.form>
