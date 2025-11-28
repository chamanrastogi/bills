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
        <div class="col-6">
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



        <div class="col-6">
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

 <div class="row pt-3">
        <div class="col-sm-10">
            @php
                $small_img = !empty($supplier->bill_image)
                    ? preg_replace('/\.(?=[^.]*$)/', '_thumb.', $supplier->bill_image)
                    : '/upload/no_image.jpg';
            @endphp

            <x-form.input-label for="bill_image" value="Bill Image" />
            <x-form.file-input name="bill_image" id="bill_image" onchange="mainThamUrl(this)"
                placeholder="Main Thumbnail" />
            <x-form.input-error :messages="$errors->get('bill_image')" />
            <img src="" id="mainThmb" class="img-thumbnail img-fluid img-responsive w-10 my-3">
        </div>

        <div class="mt-3 col-sm-2">
            <img src="{{ asset($small_img) }}" class="img-thumbnail img-fluid img-responsive w-10">
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
