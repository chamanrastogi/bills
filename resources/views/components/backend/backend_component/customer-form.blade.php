{{-- resources/views/components/backend/backend_component/customer-form.blade.php --}}

<x-form.form
    :route="$isEdit ? route('customers.update', $customer->id) : route('customers.store')"
    :method="$isEdit ? 'PUT' : 'POST'"
    :isEdit="$isEdit"
    enctype="multipart/form-data"
    class="forms-sample needs-validation"
    novalidate
>

    {{-- Name & Email --}}
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <x-form.input-label for="name" value="Name" />
                <x-form.text-input
                    name="name"
                    :value="$customer->name ?? ''"
                    required
                    placeholder="Name"
                />
                <x-form.input-error :messages="$errors->get('name')" />
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <x-form.input-label for="email" value="Email" />
                <x-form.text-input
                    name="email"
                    :value="$customer->email ?? ''"
                    placeholder="Email"
                />
                <x-form.input-error :messages="$errors->get('email')" />
            </div>
        </div>
    </div>

    {{-- Phone & Opening Balance --}}
    <div class="row">
        <div class="col-4">
            <div class="mb-3">
                <x-form.input-label for="phone" value="Phone" />
                <x-form.text-input
                    name="phone"
                    :value="$customer->phone ?? ''"
                    required
                    placeholder="Phone"
                />
                <x-form.input-error :messages="$errors->get('phone')" />
            </div>
        </div>
  <div class="col-4">
            <div class="mb-3">
                <x-form.input-label for="opening_balance" value="Opening Balance" />
                <x-form.text-input
                    name="opening_balance"
                    :value="$customer->opening_balance ?? ''"
                    required
                    placeholder="Opening Balance"
                />
                <x-form.input-error :messages="$errors->get('opening_balance')" />
            </div>
        </div>
        <div class="col-4">
            <div class="mb-3">
                <x-form.input-label
                    for="adhar_no"
                    value="Adhar No"
                />
                <x-form.text-input
                    type="text"
                    name="adhar_no"
                    :value="$customer->adhar_no ?? ''"
                    placeholder="Opening Balance"
                />
                <x-form.input-error :messages="$errors->get('adhar_no')" />
            </div>
        </div>
    </div>

    {{-- Address & Billing Address --}}
    <div class="row mb-3">
        <div class="col-12">
            <x-form.input-label for="address" value="Address" />
            <x-form.textarea
                name="address"
                rows="2"
                placeholder="Address"
            >{{ $customer->address ?? '' }}</x-form.textarea>
            <x-form.input-error :messages="$errors->get('address')" />
        </div>


    </div>

    {{-- Submit Button --}}
    <x-form.button type="submit">
        {{ $isEdit ? 'Update' : 'Submit' }}
    </x-form.button>

</x-form.form>
