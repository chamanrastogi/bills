{{-- resources/views/components/backend/backend_component/supplier-form.blade.php --}}

<x-form.form
    :route="$isEdit ? route('supplier.update', $supplier->id) : route('supplier.store')"
    :method="$isEdit ? 'PUT' : 'POST'"
    :isEdit="$isEdit"
    enctype="multipart/form-data"
    class="forms-sample needs-validation"
    novalidate
>

    {{-- Shop Name, Name, Phone --}}
    <div class="row">
        <div class="col-4">
            <div class="mb-3">
                <x-form.input-label for="shop_name" value="Shop Name" />
                <x-form.text-input
                    name="shop_name"
                    :value="$supplier->shop_name ?? ''"
                    placeholder="Shop Name"
                />
                <x-form.input-error :messages="$errors->get('shop_name')" />
            </div>
        </div>

        <div class="col-4">
            <div class="mb-3">
                <x-form.input-label for="name" value="Name" />
                <x-form.text-input
                    name="name"
                    :value="$supplier->name ?? ''"
                    required
                    placeholder="Name"
                />
                <x-form.input-error :messages="$errors->get('name')" />
            </div>
        </div>

        <div class="col-4">
            <div class="mb-3">
                <x-form.input-label for="phone" value="Phone" />
                <x-form.text-input
                    name="phone"
                    :value="$supplier->phone ?? ''"
                    required
                    placeholder="Phone"
                />
                <x-form.input-error :messages="$errors->get('phone')" />
            </div>
        </div>
    </div>


    {{-- Email, GST No, Status --}}
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <x-form.input-label for="email" value="Email" />
                <x-form.text-input
                    name="email"
                    :value="$supplier->email ?? ''"
                    placeholder="Email"
                />
                <x-form.input-error :messages="$errors->get('email')" />
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <x-form.input-label for="gst_no" value="GST No." />
                <x-form.text-input
                    name="gst_no"
                    :value="$supplier->gst_no ?? ''"
                    placeholder="GST Number"
                />
                <x-form.input-error :messages="$errors->get('gst_no')" />
            </div>
        </div>


    </div>


    {{-- Address --}}
    <div class="row mb-3">
        <div class="col-12">
            <x-form.input-label for="address" value="Shop Address" />
            <x-form.textarea
                name="address"
                rows="2"
                placeholder="Address"
            >{{ $supplier->address ?? '' }}</x-form.textarea>
            <x-form.input-error :messages="$errors->get('address')" />
        </div>
    </div>


    {{-- Bank Account --}}
    <div class="row mb-3">
        <div class="col-12">
            <x-form.input-label for="account" value="Bank Account Details" />
            <x-form.textarea
                name="account"
                rows="2"
                placeholder="Account Details"
            >{{ $supplier->account ?? '' }}</x-form.textarea>
            <x-form.input-error :messages="$errors->get('account')" />
        </div>
    </div>

    {{-- Submit Button --}}
    <x-form.button type="submit">
        {{ $isEdit ? 'Update' : 'Submit' }}
    </x-form.button>

</x-form.form>
