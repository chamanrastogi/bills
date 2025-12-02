{{-- resources/views/components/backend/backend_component/supplier-billing-form.blade.php --}}

<x-form.form :route="$isEdit ? route('supplier_billings.update', $billing->id) : route('supplier_billings.store')" :isEdit="$isEdit" enctype="multipart/form-data" class="forms-sample needs-validation"
    novalidate>

    {{-- Supplier ID --}}

    <div class="mb-3">
        <x-form.input-label for="supplier_id" value="Supplier ID" />
        <x-form.select name="supplier_id" id="suppliers_name" :options="$supplier" :selected="$billing->supplier_id ?? ''"
            placeholder="Select Supplier" />
        <x-form.input-error :messages="$errors->get('supplier_id')" />
    </div>

    {{-- Bill Image Upload --}}
    @php
        $small_img = !empty($billing->bill_image)
            ? explode('.', $billing->bill_image)[0] . '_thumb.' . explode('.', $billing->bill_image)[1]
            : '/upload/no_image.jpg';
    @endphp

    <div class="row">
        <div class="col-sm-10">
            <x-form.input-label for="bill_image" value="Bill Image" />
            <x-form.file-input name="bill_image" onchange="mainThamUrl(this)" />
            <x-form.input-error :messages="$errors->get('bill_image')" class="mt-2" />
            <img src="" class="img-thumbnail img-fluid w-10 my-3" id="mainThmb" />
        </div>

        <div class="col-sm-2 mt-3">
            <img src="{{ asset($small_img) }}" class="img-thumbnail img-fluid w-10" />
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            {{-- Payment --}}
            <div class="mb-3">
                <x-form.input-label for="bill_amount" value="Bill Amount" />
                <x-form.text-input type="number" name="bill_amount" :value="$billing->bill_amount ?? 0"
                    placeholder="Enter Bill Amount" />
                <x-form.input-error :messages="$errors->get('bill_amount')" class="mt-2" />
            </div>
        </div>
        <div class="col-6">
            {{-- Received --}}
            <div class="mb-3">
                <x-form.input-label for="paid" value="Paid Amount" />
                <x-form.text-input type="number" name="paid" :value="$billing->paid ?? 0" placeholder="Enter Paid Amount" />
                <x-form.input-error :messages="$errors->get('paid')" class="mt-2" />
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-6">
            {{-- Payment Mode --}}
            <div class="mb-3">
                <x-form.input-label for="payment_mode" value="Payment Mode" />

                <x-form.select name="payment_mode" :options="MODE" :selected="$billing->payment_mode ?? 0"
                    placeholder="Select Payment Mode" />

                <x-form.input-error :messages="$errors->get('payment_mode')" class="mt-2" />
            </div>
        </div>
        <div class="col-6">

            {{-- Transaction ID --}}
            <div class="mb-3">
                <x-form.input-label for="transaction_id" value="Transaction ID" />
                <x-form.text-input name="transaction_id" :value="$billing->transaction_id ?? ''" placeholder="Enter Transaction ID" />
                <x-form.input-error :messages="$errors->get('transaction_id')" class="mt-2" />
            </div>
        </div>
    </div>





    {{-- Submit Button --}}
    <x-form.button type="submit">
        {{ $isEdit ? 'Update' : 'Submit' }}
    </x-form.button>

</x-form.form>
